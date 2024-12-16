<?php

// Start of PHPMailer - That processes Email
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require "phpmailer/src/PHPMailer.php";
require "phpmailer/src/Exception.php";
require "phpmailer/src/SMTP.php";
// End of PHPMailer

class general
{
    public $connect;

    public function __construct($connect)
    {
        $this->connect = $connect;
    }

    protected function validateInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function displaySuccessMessage($href)
    {
        echo '
        <div class="position-absolute w-100 h-100  d-flex justify-content-center align-items-center success-message">
            <img src="./images/success gif.gif" class="w-25" alt="Success Message">
        </div>
            ';
        echo "
            <script>
                setInterval(()=>{
                    window.location.href='" . $href . "';
                },3000);
            </script>
        ";
    }

    public function errorMessage($message)
    {
        echo '
        <div class="alert alert-danger position-absolute top-0 end-0 js-alert">
            ' . $message . ' 
            <button type="button" class="btn" aria-label="Close" data-bs-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        ';
        echo '
            <script>
                setInterval(()=>{
                    let invalidCredentialElement = document.querySelector(".js-alert");

                    invalidCredentialElement.style.display="none";
                },2500);

            </script>
        ';
    }

    public function sendEmail($email, $subject, $message)
    {

        $custommsg = "
            <div>
               <h3>Dear Candidate</h3>
               <p>
                   Your registration is successfull. Below are your credentials to login to your dashboard
               </p>
               <p>Email: The one you provided during registration</p>
               <p>Password: $message</p>
               <p>Wishing you a successful journey in your entrance exam.</p>
               <br>
               <p>Best regards,</p>
               <p>OEES</p>
            </div>
           ";



        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "ibrahimnurudeenshehu1447@gmail.com"; //SMTP Username
        $mail->Password = "tbmbznxctivbddye"; //Your gmail app password
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->setFrom("$email"); //Gmail of sender and name of sender
        $mail->addReplyTo($email); //Gmail of sender and name of sender
        $mail->addAddress("$email"); // REciever of the gmail
        $mail->isHTML(true);
        $mail->Subject = $subject; //Subject of the message
        $mail->Body = $custommsg; //Message to send
        $result = $mail->send();

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}


class register extends general
{
    public $fullname;
    public $email;
    public $phone_number;
    public $dob;
    public $gender;
    public $last_institution;
    public $password;
    public $encrypted_password;


    public function collectInputs()
    {
        $this->fullname = $this->validateInput($_POST["fullname"]);
        $this->email = $this->validateInput($_POST["email"]);
        $this->phone_number = $this->validateInput($_POST["phone_number"]);
        $this->dob = $this->validateInput($_POST["dob"]);
        $this->gender = $this->validateInput($_POST["gender"]);
        $this->last_institution = $this->validateInput($_POST["last_institution"]);
    }

    public function checkIfEmailExist()
    {
        $sql = $this->connect->query("SELECT * FROM `examinee` WHERE email = '$this->email'");
        if ($sql->num_rows > 0) {
            $this->errorMessage("Email Exist!");
            return true;
        } else {
            return false;
        }
    }

    public function generatePassword()
    {
        // Geerate password (5 digits) 
        $generated_password = rand(0, 99999);
        $this->password = $generated_password;

        // Hash the generated password
        $generated_password = password_hash($generated_password, PASSWORD_BCRYPT);
        $this->encrypted_password = $generated_password;
    }

    public function insertIntoDB()
    {
        // send the generated password to user(Examinee) email
        $send_email = $this->sendEmail($this->email, "OEES - Login Credentials", $this->password);

        if ($send_email) {
            $sql = $this->connect->query("INSERT INTO `examinee` (fullname,email,phone_number,dob,gender,last_institution,password) VALUES ('$this->fullname','$this->email','$this->phone_number','$this->dob','$this->gender','$this->last_institution','$this->encrypted_password')");

            if ($sql) {
                $this->displaySuccessMessage('./login.php');
            }
        }
    }
}


class login extends general
{
    public $email;
    public $password;
    public $email_err;
    public $password_err;
    public $whoIsPassed;

    public function collectInputs()
    {
        $this->email = $this->validateInput($_POST["email"]);
        $this->password = $this->validateInput($_POST["password"]);
    }

    public function authorizeFromAdmin()
    {
        $select_from_admin = $this->connect->query("SELECT * FROM `admin` WHERE email = '$this->email'");
        $result = $select_from_admin->fetch_assoc() ?? null;
        $admin_password = $result["password"] ?? null;


        if (!$select_from_admin->num_rows > 0) {
            $this->email_err = "Email not registered";
        } else {
            if (password_verify($this->password, $admin_password)) {
                $_SESSION["admin_id"] = $result["admin_id"];
                $this->whoIsPassed = "admin";
                $this->redirection();
            } else {
                $this->password_err = "Incorrect password";
            }
            return true;
        }
        return false;
    }

    public function authorizeFromExaminee()
    {
        $select_from_examinee = $this->connect->query("SELECT * FROM `examinee` WHERE email = '$this->email'");
        $result = $select_from_examinee->fetch_assoc() ?? null;
        $examinee_password = $result["password"] ?? null;


        if (!$select_from_examinee->num_rows > 0) {
            $this->email_err = "Email not registered";
            return false;
        } else {
            // Setting the email(email_err) that was checked in AuthorizeFromAdmin to null
            $this->email_err = null;
            if (password_verify($this->password, $examinee_password)) {
                $_SESSION["examinee_id"] = $result["examinee_id"];
                $this->whoIsPassed = "examinee";
                $this->redirection();
            } else {
                $this->password_err = "Incorrect password";
            }
        }
    }

    public function redirection()
    {
        switch ($this->whoIsPassed) {
            case 'admin':
                $this->displaySuccessMessage('./admin/dashboard.php');
                break;

            case 'examinee':
                $this->displaySuccessMessage('./examinee/dashboard.php');
                break;
        }
    }
}
