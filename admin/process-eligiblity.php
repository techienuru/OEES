<?php
session_start();
include_once "../includes/connect.php";
include_once "../includes/classes/admin.php";

$object = new examinees($connect);

$object->collectUserID();

if (isset($_GET["change_exam_status"])) {
    $examinee_id = $_GET["examinee_id"];
    $exam_eligibility_status = $_GET["change_exam_status"];

    // Changing Exam Eligibility Status to the opposite of the current one
    switch ($exam_eligibility_status) {
        case "Eligible":
            $exam_eligibility_status = 0;
            break;

        case "Not eligible":
            $exam_eligibility_status = 1;
            break;
    }
    $object->changeExamEligibilityStatus($examinee_id, $exam_eligibility_status);
}
