<?php
require_once '../../utilities/functions.php';
$conn = connect();
// delete all records from question table.
$sql = "DELETE FROM question";
if(mysqli_query($conn, $sql)){
    // echo "Record was deleted successfully.";
}
else{
    echo "Failed to deleted records";
}
if(isset($_POST['submit'])) {
    //echo "Test";
    $jobFairYear = getJobFairYear();
    $questions = $_REQUEST['questions'];
    $type = $_REQUEST['type'];
    foreach ($questions as &$value) {
        //echo $value . "<br>";
    }
    // change rating to 1 and change text to 2
    foreach ($type as &$value) {
        if ($value == "Rating") {
            $value = 1;
        } else {
            $value = 2;
        }
    }
    // insert all questions
    foreach ($questions as $index => $question) {
        $sql = "INSERT INTO question (jobFairYear,questionText,questionType) VALUES ('$jobFairYear','$question','$type[$index]')";
        $erro_check = doQuery($conn, $sql);
        if (!$erro_check) {
            //echo "Fail";
        } else {
            //echo "success";
        }
    }
}
// locate the page and refresh
header("location:feedback_questions.php");
echo "<h1>You have saved your questions.</h1>";
mysqli_close($conn);
?>