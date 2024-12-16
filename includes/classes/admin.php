<?php
class general
{
    public $connect;
    public $user_id;

    public function __construct($connect)
    {
        $this->connect = $connect;
    }

    public function collectUserID()
    {
        if (isset($_SESSION["admin_id"])) {
            $this->user_id = $_SESSION["admin_id"];
        } else {
            header("location:../login.php");
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
}

class dashboard extends general
{
    public $noOfExaminees;
    public $noOfAuthorized;
    public $noOfQuestions;
    public $noOfExamsTaken;


    public function selectNoOfExaminees()
    {
        $sql = $this->connect->query("SELECT COUNT(examinee_id) AS noOfExaminee FROM `examinee`");
        $result = $sql->fetch_assoc();
        $this->noOfExaminees = $result["noOfExaminee"];
    }

    public function selectNoOfAuthorized()
    {
        $sql = $this->connect->query("SELECT COUNT(examinee_id) AS noOfAuthorized FROM `examinee` WHERE can_take_exam = 1");
        $result = $sql->fetch_assoc();
        $this->noOfAuthorized = $result["noOfAuthorized"];
    }

    public function selectNoOfQuestions()
    {
        $sql = $this->connect->query("SELECT COUNT(ques_id) AS noOfQuestions FROM `questions`");
        $result = $sql->fetch_assoc();
        $this->noOfQuestions = $result["noOfQuestions"];
    }

    public function selectNoOfExamsTaken()
    {
        $sql = $this->connect->query("SELECT COUNT(exams_id) AS noOfExamsTaken FROM `exams`");
        $result = $sql->fetch_assoc();
        $this->noOfExamsTaken = $result["noOfExamsTaken"];
    }
}

class questions extends general
{
    public $ques;
    public $option_a;
    public $option_b;
    public $option_c;
    public $option_d;
    public $answer;


    public function selectExamQuestions()
    {
        $sql = $this->connect->query("SELECT * FROM `questions`");
        return $sql;
    }

    public function collectFormInputs()
    {
        $this->ques = $this->validateInput($_POST["question"]);
        $this->option_a = $this->validateInput($_POST["option_a"]);
        $this->option_b = $this->validateInput($_POST["option_b"]);
        $this->option_c = $this->validateInput($_POST["option_c"]);
        $this->option_d = $this->validateInput($_POST["option_d"]);
        $this->answer = $this->validateInput($_POST["answer"]);
    }

    public function insertIntoDB()
    {
        $sql = $this->connect->query("INSERT INTO `questions` (ques,option_a,option_b,option_c,option_d,answer) VALUES ('$this->ques','$this->option_a','$this->option_b','$this->option_c','$this->option_d','$this->answer')");

        if ($sql) {
            $this->displaySuccessMessage("Question Added!");
        } else {
            $this->errorMessage($this->connect->error);
        }
    }
}

class examinees extends general
{
    public function selectExaminees()
    {
        $sql = $this->connect->query("SELECT * FROM `examinee`");
        return $sql;
    }

    public function changeExamEligibilityStatus($examinee_id, $can_take_exam)
    {
        $sql = $this->connect->query("UPDATE `examinee` SET can_take_exam = $can_take_exam WHERE examinee_id = $examinee_id");
        if ($sql) {
            header("location:examinees.php");
            die();
        }
    }
}

class scores extends general
{
    public function selectExamineesScores()
    {
        $sql = $this->connect->query("SELECT * FROM `exams` INNER JOIN `examinee` ON `exams`.examinee_id = `examinee`.examinee_id");
        return $sql;
    }
}
