<?php
require_once '../../utilities/functions.php';

$conn = connect();
// delete all records from question table.

//if(mysqli_query($conn, $sql)){
//    // echo "Record was deleted successfully.";
//}
//else{
//    echo "Failed to deleted records";
//}


if($_POST['submit']) {
    //delete all records from question table.
    $sql = "DELETE FROM question";
    mysqli_query($conn, $sql);

    $jobFairYear = getJobFairYear();
    $questions = $_REQUEST['questions'];
    $type = $_REQUEST['type'];
    $questionID = $_REQUEST['questionID'];

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
        $sql = "INSERT INTO question (questionID,jobFairYear,questionText,questionType) VALUES ('$questionID[$index]','$jobFairYear','$question','$type[$index]')";
        $erro_check = doQuery($conn, $sql);
        if (!$erro_check) {
            echo "Fail";
        } else {
            echo "success";
        }
    }


}

if($_POST['delete']){

    //delete the row
    $deleteID = $_POST['deleteID'];
    $sql = "DELETE FROM question WHERE questionID=$deleteID";
    $erro_check = doQuery($conn, $sql);
    if (!$erro_check) {
        echo "Fail";
    } else {
        echo "success";
    }

    // get the total number of the row
    $sql = "SELECT count(*) as total from question";
    $erro_check = doQuery($conn, $sql);
    $row = mysqli_fetch_array($erro_check);
    if (!$erro_check) {
        echo "Fail";
    } else {
        echo "success";
    }


    // update the id from deleteID
    $x = $_POST['deleteID'];
    while($x<=$row['total']) {

        $ID_current = $x + 1;

        $sql = "UPDATE question SET questionID = $x WHERE questionID = $ID_current";
        $erro_check = doQuery($conn, $sql);

        if (!$erro_check) {
            echo "Fail";
        } else {
            echo "success";
        }

        $x++;

    }

}


// locate the page and refresh
header("location:feedback_questions.php");

echo "<h1>You have saved your questions.</h1>";

mysqli_close($conn);

?>