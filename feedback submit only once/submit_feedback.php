<?php
// Import functions.php file from utils
require_once '../../utilities/functions.php';

$conn = connect();

$jobFairYear = getJobFairYear();
$name = mysqli_real_escape_string($conn,$_POST['name']);

// count of questions from question table
//$result = mysqli_query($conn,"SELECT COUNT(*) as total FROM question where questionType = 1");
//$result2 = mysqli_query($conn,"SELECT COUNT(*) as total FROM question where questionType = 2");


$question_rate = mysqli_query($conn,"SELECT * FROM question where questionType = 1");
$question_answer = mysqli_query($conn,"SELECT * FROM question where questionType = 2");

$num_rate = 1;

//insert rating answer into table
while ($question_rate_qu = mysqli_fetch_assoc($question_rate)) {

    $question_rate_id = $question_rate_qu['questionID'];
    $rate = mysqli_real_escape_string($conn,$_POST['rating'.$num_rate]);

    $sql = "INSERT INTO feedback (jobFairYear,questionID,name, rating, answer) VALUES ('$jobFairYear','$question_rate_id','$name','$rate','')";

    $erro_check = doQuery($conn, $sql);
    if(!$erro_check){
        //echo "Fail";
    }
    else{
        //echo "success";
    }

    $num_rate++;
}
// insert the answers from all the questions
$num_answer = 1;
while ($question_answer_qu = mysqli_fetch_assoc($question_answer)) {

    $question_answer_id = $question_answer_qu['questionID'];

    $answer = mysqli_real_escape_string($conn,$_POST['answer_text'.$num_answer]);

    $sql = "INSERT INTO feedback (jobFairYear,questionID,name, rating, answer) VALUES ('$jobFairYear','$question_answer_id','$name','0','$answer')";

    $erro_check = doQuery($conn, $sql);
    if(!$erro_check){
        //echo "Fail";
    }
    else{
        //echo "success";
    }

    $num_answer++;
}


//doQuery($conn, $sql);
//$rows_affected = mysqli_affected_rows($conn);
//
//if($rows_affected > 0) {
//    echo "Worked";
//}
//else {
//    echo "Failed miserably";
//}

mysqli_close($conn);

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../stylesheets/bootstrap.css">
    <link href="../../stylesheets/carousel.css" rel="stylesheet">
    <link href="../../stylesheets/styles.css" rel="stylesheet">
    <link href="../../stylesheets/form_reg.css" rel="stylesheet">

    <title>NSCC Job Fair Website</title>

    <style>
        main {
            margin-top: 70px;
            clear: both;
        }

        .color_header{
            background-color: #214365;
            color: white;
            background: #A8C0D8 -webkit-gradient(linear, right top, right bottom, from(#214365), to(#A8C0D8)) no-repeat;
            /*Mozilla,Firefox/Gecko */
            background: #A8C0D8 -moz-linear-gradient(top, #214365, #A8C0D8) no-repeat;
        }
        #submit_finish{
            width: 50%;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            padding-bottom: 10em;
            padding-top:2em;
        }
        #submit_finish > img{
            width: 10em;

        }

    </style>

</head>

<body>
<header id="header"></header>

<main role="main">
    <div id="submit_finish">
        <img src="../../images/smile_face.png" alt="Smiley face" >
        <h1>Thank you for your submitting.</h1>
    </div>

    <!-- FOOTER -->
    <footer id="footer" class="footer-bar"></footer>
</main>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="../../scripts/form_validation_student.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#header').load("header.php");
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#footer').load("footer.php");
    });
</script>
</body>

</html>
