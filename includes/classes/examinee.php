<?php
class general
{
    public $connect;
    public $user_id;

    public $fullname;
    public $email;
    public $phone_number;
    public $dob;
    public $gender;
    public $last_institution;
    public $can_take_exam;
    public $exam_status;

    public $noOfQuestions;

    public function __construct($connect)
    {
        $this->connect = $connect;
    }

    public function collectUserID()
    {
        if (isset($_SESSION["examinee_id"])) {
            $this->user_id = $_SESSION["examinee_id"];
            $this->collectUserDetails();
        } else {
            header("location:../login.php");
            die();
        }
    }

    public function collectUserDetails()
    {
        $sql = $this->connect->query("SELECT * FROM `examinee` WHERE examinee_id = $this->user_id");
        $result = $sql->fetch_assoc();

        $this->fullname = $result["fullname"];
        $this->email = $result["email"];
        $this->phone_number = $result["phone_number"];
        $this->dob = $result["dob"];
        $this->gender = $result["gender"];
        $this->last_institution = $result["last_institution"];
        $this->can_take_exam = $result["can_take_exam"];

        if ($this->can_take_exam) {
            $this->exam_status = "Welcome to your exam journey. Let's excel together!";
        } else {
            $this->exam_status = "You are not eligible for the entrance exam. Contact The Admin, please!";
        }
    }

    protected function validateInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function displaySuccessMessage($message)
    {
        echo '
        <div class="alert alert-success position-absolute top-0 end-0 js-alert">
            ' . $message . ' 
            <button type="button" class="close" aria-label="Close" data-bs-dismiss="alert">
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

    public function errorMessage($message)
    {
        echo '
        <div class="alert alert-danger position-absolute top-0 end-0 js-alert">
            ' . $message . ' 
            <button type="button" class="close" aria-label="Close" data-bs-dismiss="alert">
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

    public function noOfQuestions()
    {
        $sql = $this->connect->query("SELECT COUNT(ques_id) AS noOfQuestions FROM `questions`");
        $result = $sql->fetch_assoc();
        $this->noOfQuestions = $result["noOfQuestions"];
    }
}

class dashboard extends general
{
    public $noOfExamsTaken;
    public $noOfExamsPassed;
    public $noOfExamsFailed;

    public function noOfExamsTaken()
    {
        $sql = $this->connect->query("SELECT COUNT(exams_id) AS noOfExamsTaken FROM `exams` WHERE examinee_id = $this->user_id");
        $result = $sql->fetch_assoc();
        $this->noOfExamsTaken = $result["noOfExamsTaken"];
    }

    public function noOfExamsPassed()
    {
        $sql = $this->connect->query("SELECT COUNT(exams_id) AS noOfExamsPassed FROM `exams` WHERE examinee_id = $this->user_id AND score >= 50");
        $result = $sql->fetch_assoc();
        $this->noOfExamsPassed = $result["noOfExamsPassed"];
    }

    public function noOfExamsFailed()
    {
        $sql = $this->connect->query("SELECT COUNT(exams_id) AS noOfExamsFailed FROM `exams` WHERE examinee_id = $this->user_id AND score < 50");
        $result = $sql->fetch_assoc();
        $this->noOfExamsFailed = $result["noOfExamsFailed"];
    }
}
class take_exam extends general {}

class start_exam extends general
{
    public $answers_array;
    public $total_questions;
    public $correct_answers;
    public $scores;


    public function isExamineeEligible()
    {
        if ($this->can_take_exam) {
            return true;
        } else {
            echo "
                <script>
                    alert(`You are not eligible to take exams!
Please Contact the Admin.`);
                    location.href='../examinee/take-exam.php';
                </script>
            ";
            die();
            return false;
        }
    }

    public function processExam()
    {
        $this->answers_array = $_POST['answer'];
        $this->total_questions = count($this->answers_array);

        $this->correct_answers = 0;

        foreach ($this->answers_array as $question_id => $selected_option) {
            $sql = $this->connect->query("SELECT answer FROM `questions` WHERE ques_id = $question_id");
            $result = $sql->fetch_assoc();
            $correct_option = $result["answer"];

            if ($selected_option == $correct_option) {
                $this->correct_answers++;
            }
        }

        $this->scores = ($this->correct_answers / $this->total_questions) * 100;

        $insert_into_exams = $this->connect->query("INSERT INTO `exams` (examinee_id,score,total_questions,correct_answers) VALUES ($this->user_id,$this->scores,$this->total_questions,$this->correct_answers)");

        if ($insert_into_exams) {
            header("location:../examinee/exam-score.php");
        } else {
            echo "
                <script>
                    alert(`" . $this->connect->error . "`);
                </script>
            ";
        }
    }
}

class exam_score extends general
{
    public function selectExamScore()
    {
        $sql = $this->connect->query("SELECT * FROM `exams` WHERE examinee_id = $this->user_id");
        return $sql;
    }
}

class edit_profile extends general
{
    public $fullname;
    public $email;
    public $phone_number;
    public $dob;
    public $gender;
    public $last_institution;
    public $password;
    public $can_take_exam;

    public function collectUserID()
    {
        if (isset($_SESSION["examinee_id"])) {
            $this->user_id = $_SESSION["examinee_id"];
            $this->collectUserDetails();
        } else {
            header("location:../login.php");
            die();
        }
    }

    public function collectUserDetails()
    {
        $sql = $this->connect->query("SELECT * FROM `examinee` WHERE examinee_id = $this->user_id");
        $result = $sql->fetch_assoc();

        $this->fullname = $result["fullname"];
        $this->email = $result["email"];
        $this->phone_number = $result["phone_number"];
        $this->dob = $result["dob"];
        $this->gender = $result["gender"];
        $this->last_institution = $result["last_institution"];
        $this->password = $result["password"];
        $this->can_take_exam = $result["can_take_exam"];
    }

    public function processEditProfile()
    {
        // Collect Inputs
        $fullname = $_POST["fullname"];
        $email = $_POST["email"];
        $phone_number = $_POST["phone_number"];
        $dob = $_POST["dob"];
        $gender = $_POST["gender"];
        $last_institution = $_POST["last_institution"];
        $previous_password = $_POST["previous_password"] ?? null;
        $new_password = $_POST["new_password"] ?? null;

        // Update Profile with password
        if ($previous_password && $new_password) {
            if ($this->isPasswordPassed($previous_password)) {

                // Hash the password
                $new_password = password_hash($new_password, PASSWORD_BCRYPT);

                $sql = $this->connect->query("UPDATE `examinee` SET fullname = '$fullname', email = '$email', phone_number = '$phone_number', dob = '$dob', gender = '$gender', last_institution = '$last_institution', password = '$new_password' WHERE examinee_id=$this->user_id");
                $this->displaySQLMessage($sql);
            } else {
                $sql = null;
            }
        } else {
            // Update Profile without password
            $sql = $this->connect->query("UPDATE `examinee` SET fullname = '$fullname', email = '$email', phone_number = '$phone_number', dob = '$dob', gender = '$gender', last_institution = '$last_institution' WHERE examinee_id=$this->user_id");
            $this->displaySQLMessage($sql);
        }
    }

    // Displaying Success Message after inserting into DB
    public function displaySQLMessage($sql)
    {
        if ($sql) {
            $this->displaySuccessMessage("Profile Updated");
        } else {
            $this->errorMessage($this->connect->error);
        }
    }

    public function isPasswordPassed($previous_password)
    {
        if (password_verify($previous_password, $this->password)) {
            return true;
        } else {
            $this->errorMessage("Oops! That's not your previous password");
            return false;
        }
    }

    public function displaySuccessMessage($message)
    {
        echo '
        <div class="alert alert-success position-absolute top-0 end-0 js-alert">
            ' . $message . ' 
            <button type="button" class="close" aria-label="Close" data-bs-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        ';
        echo '
            <script>
                setInterval(()=>{
                    let invalidCredentialElement = document.querySelector(".js-alert");

                    //invalidCredentialElement.style.display="none";
                    window.location.href="edit-profile.php";
                },2500);

            </script>
        ';
    }
}
