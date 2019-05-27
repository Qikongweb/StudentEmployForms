<?php
require_once '../../utilities/functions.php';
require_once '../../utilities/path.php';
checkCredentials();
$conn = connect();

$sql = "SELECT MAX(jobFairYear) as maxYear FROM jobFairInfo";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$this_year = $row['maxYear'];
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
              integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
              crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
              integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
              crossorigin="anonymous">
        <link rel="stylesheet" href="../../stylesheets/internal_pages.css">

        <!-- <link rel="stylesheet" href="main.css"> -->
        <title>Dashboard</title>
        <!-- TABLE FONT STYLE -->
        <style>
            #reportTable1 th:nth-of-type(1) {
                width: 2%;
            }

            #reportTable2 th:nth-of-type(1) {
                width: 2%;
            }
            #reportTable1 th:nth-of-type(2){
                width:23%;
            }
            #reportTable2 th:nth-of-type(2){
                width:23%;
            }

            #reportTable1 th:nth-of-type(3), th:nth-of-type(4), th:nth-of-type(5), th:nth-of-type(6), th:nth-of-type(7) {
                width: 8%;
            }

            #reportTable1 th:nth-of-type(8), th:nth-of-type(8), th:nth-of-type(9), th:nth-of-type(10), th:nth-of-type(11) {
                width: 5%;
            }

            #reportTable2 th:nth-of-type(3) {
                /*width: 40%;*/
                width: 100px;
            }
            td {

                word-break:break-all;

            }

        </style>
    </head>

    <body>
    <!-- NAVIGATION -->

    <?php include_once "./admin_navigation.php"; ?>

    <!-- HEADER -->
    <header id="main-header" class="py-2 bg-primary text-white mb-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <h2>Stats on Feedback</h2>
                </div>
            </div>
        </div>
    </header>


    <!-- BUTTONS ON THE LEFT SIDE -->
    <section>
        <div class="container-fluid">
            <div class="row margin-bottom justify-content-center">

                <!--Include Admin Sidebar-->
                <?php include_once('admin_sidebar.php') ?>

                <!-- TABLE -->
                <div class="col-md-8">
                    <div class="container-fluid">
                        <div class="row justify-content-between mb-5">
                            <div class="col">
                                <h4>
                                    <?php
                                    if (!isset($_GET['year'])) {
                                        echo $this_year;
                                    } else {
                                        echo $_GET['year'];
                                    }
                                    ?> Feedback Reports</h4>
                            </div>
                            <div class="text-center mr-3">
                                <button type="button" class="btn btn-secondary"
                                        onclick="exportTableToExcel('reportTable')">Save to file
                                </button>
                            </div>
                            <div class="form text-center mr-3">
                                <form action="#" method="post">
                                    <?php
                                    $sql = "SELECT DISTINCT jobFairYear FROM student ORDER BY jobFairYear desc";
                                    $result = mysqli_query($conn, $sql);
                                    $select_form = '<select class="form-control" id="selectYear" name="selectYear" onchange="location = this.value;">';
                                    $select_form .= '<option value="feedback_report.php?year=' . $this_year . '">Select Year</option>';
                                    while ($row = mysqli_fetch_array($result)) {
                                        $select_form .= '<option value="feedback_report.php?year=' . $row['jobFairYear'] . '">' . $row['jobFairYear'] . '</option>';
                                    }

                                    echo $select_form;

                                    $selected_year = $_GET['year'];
                                    ?>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>

                    <?php
                    if (!isset($selected_year)) $selected_year = $this_year;

                    $count = "SELECT sum(case when studentGraduatingYear > '$selected_year' then 1 else 0 end) as 1st_year,
                                 sum(case when studentGraduatingYear = '$selected_year' then 1 else 0 end) as 2nd_year,
                                 sum(case when studentGraduatingYear < '$selected_year' then 1 else 0 end) as etc,
                                 count(*) as total
                            FROM student WHERE jobFairYear = '$selected_year'";

                    $result = mysqli_query($conn, $count);
                    $row = mysqli_fetch_assoc($result);


                    ?>


                    <?php
                    // select columns to sort


                    if ($part1 = $conn->query("select questionID,round(avg(rating),2) as average,count(rating) as total, 
               sum(case when rating=1 then 1 else 0 end) rating1,
               sum(case when rating=2 then 1 else 0 end) rating2,
               sum(case when rating=3 then 1 else 0 end) rating3,
               sum(case when rating=4 then 1 else 0 end) rating4,
               sum(case when rating=5 then 1 else 0 end) rating5,
             ((select count(distinct feedbackId) from feedback where jobFairYear = '2020') -
              (select count(distinct(feedbackID)) from feedback B
                where B.jobFairYear = '2020'
                  and B.questionID = A.questionID
                  and B.rating > 0)) noanswer_person,  
              (select count(distinct feedbackId) from feedback where jobFairYear = '2020') total_person
              from feedback A 
             where jobFairYear = '2020'
               and questionID in (select questionID from question where questionType = '1')
               and rating > 0 
             group by questionID")){

                    ?>
                    <div class="table-responsive mt-5">
                        <span>Part1: Rating questions stats.</span>
                        <table id="reportTable1" class="table table table-hover table-condensed">

                            <thead class="thead-dark">
                            <tr>
                                <th>No.</th>
                                <th>Questions</th>
                                <th>Strongly Agree</th>
                                <th>Agree</th>
                                <th>Neutral</th>
                                <th>Disagree</th>
                                <th>Strongly Disagree</th>
                                <th>Average</th>
                                <th>Total Responses</th>
                                <th>Not answered</th>
                                <th>Responses Rate</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php while ($row = $part1->fetch_assoc()) { ?>

                                <tr>
                                    <td><?php echo $row['questionID']; ?></td>
                                    <td><?php
                                        $questextID = $row['questionID'];
                                        $sql = 'SELECT questionText as text FROM question WHERE questionID=' . $questextID;
                                        $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                                        echo $result['text'];
                                        ?></td>
                                    <td><?php echo round($row['rating5'] / $row['total_person'], 3) * 100 . " %"; ?></td>
                                    <td><?php echo round($row['rating4'] / $row['total_person'], 3) * 100 . " %"; ?></td>
                                    <td><?php echo round($row['rating3'] / $row['total_person'], 3) * 100 . " %"; ?></td>
                                    <td><?php echo round($row['rating2'] / $row['total_person'], 3) * 100 . " %"; ?></td>
                                    <td><?php echo round($row['rating1'] / $row['total_person'], 3) * 100 . " %"; ?></td>
                                    <td><?php echo $row['average'] ?></td>
                                    <td><?php echo $row['total_person'] ?></td>
                                    <td><?php echo $row['noanswer_person'] ?></td>
                                    <td><?php echo round(($row['total_person'] - $row['noanswer_person']) / $row['total_person'], 4) * 100 . " %"; ?></td>
                                </tr>

                            <?php }
                            } ?>
                            </tbody>
                        </table>
                        <table id="reportTable2" class="table table table-hover table-condensed">
                            <span>Part2: Answered questions stats.</span>
                            <thead class="thead-dark">
                            <tr>
                                <th>No.</th>
                                <th>Question</th>
                                <th>Answer</th>
                                <th>Total Responses</th>
                                <th>Not answered</th>
                                <th>Responses Rate</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($part2 = $conn->query("select questionID,count(answer) as total, 
               
                             ((select count(distinct feedbackId) from feedback where jobFairYear = '2020') -
                              (select count(distinct(feedbackID)) from feedback B
                                where B.jobFairYear = '2020'
                                  and B.questionID = A.questionID and B.answer is NOT NULL and B.answer <> ''
                                  )) noanswer_person,  
                              (select count(distinct feedbackId) from feedback where jobFairYear = '2020') total_answer
                              from feedback A 
                             where jobFairYear = '2020'
                               and questionID in (select questionID from question where questionType = '2')
                              and A.answer is NOT NULL and A.answer <> ''
                             group by questionID")) {


                                while ($row = $part2->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['questionID'] ?></td>
                                        <td><?php
                                            $questextID = $row['questionID'];
                                            $sql = 'SELECT questionText as text FROM question WHERE questionID=' . $questextID;
                                            $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                                            echo $result['text'];
                                            ?></td>
                                        <td>
<!--                                            <ul>-->
                                            <?php
                                            if ($answerID = $conn->query('SELECT answer FROM feedback WHERE questionID=' . $row['questionID'])) {
                                                while ($row2 = $answerID->fetch_assoc()) {

                                                    if (strlen($row2['answer']) > 0) {

                                                        echo " <p>" . $row2['answer'] . "</p>";
                                                    }

                                                }
                                            }
                                            ?>
<!--                                            </ul>-->
                                        </td>
                                        <td><?php echo $row['total_answer'] ?></td>
                                        <td><?php echo $row['noanswer_person'] ?></td>
                                        <td><?php echo round(($row['total_answer'] - $row['noanswer_person']) / $row['total_answer'], 4) * 100 . " %"; ?></td>
                                    </tr>


                                    <?php
                                }

                            }
                            ?>


                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer id="main-footer" class="bg-dark text-white mt-5 p-5">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-1 pr-0">
                    <img src="../../images/bird_logo_black.png" width="60" alt="Black bird Logo">
                </div>
                <div class="col-md-8 pl-0">
                    <p>&copy; 2019 Blackbird Project &middot; <a href="../../pages/html/privacy_policy.html">Privacy</a>
                        &middot; <a href="../../pages/html/terms_and_conditions.html">Terms</a></p>
                </div>
                <div class="col-md-3">
                    <p class="float-right"><a href="#">Back to top</a></p>
                </div>
            </div>
        </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
            integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
            crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>


    </body>

    </html>
<?php
$result->free();


?>