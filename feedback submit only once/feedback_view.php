<!-- Hello! -->

<?php require_once '../../utilities/functions.php'; ?>

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
    <link href="../../stylesheets/feedback_view.css" rel="stylesheet">

    <title>NSCC Job Fair Website</title>


</head>

<body>
<header id="header"></header>

<main role="main">
    <div class="card feedbackform mb-5 col-md-8">
        <div class="card-header color_header">
            <h4 class="card-title font-weight-bold">Feedback </h4>
        </div>
        <div class="card-body">
            <form name="feedbackform" method="post" action="submit_feedback.php" id="feedbackform" data-parsley-validate="">
                <div class="form-group">

                    <label for="name" class="form-inline">
                        <strong><span class="col-md-6">Name:</strong></span>
                        <input type="text" class="form-control col-md-6" id="name" name="name"
                               placeholder="">
                    </label>

                </div>


                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="th-lg " colspan="2">Part1: Please indicate your level of
                                    agreement with the following statements.
                                </th>
                                <th class="th-lg"></th>

                            </tr>
                            </thead>

                            <tbody>

                            <?php
                            $conn = connect();
                            //                            select the rating questions
                            $sql = "SELECT questionText FROM question where questionType=1";
                            $result = mysqli_query($conn, $sql);  //start to search(select)

                            //$countID = mysqli_query($conn,"SELECT COUNT(*) FROM question");
                            //                            $countID = mysqli_fetch_array($result);
                            //                            echo "<h1>" . $countID['questionText'] . "</h1>";
                            //
                            //                            $countID = mysqli_fetch_array($result);
                            //                            echo "<h1>" . $countID['questionText'] . "</h1>";
                            //
                            //                            $countID = mysqli_fetch_array($result);
                            //                            echo "<h1>" . $countID['questionText'] . "</h1>";

                            $num_row = 1;

                            while ($row = mysqli_fetch_assoc($result)) { // seperate php with html tag
                                $rating_row_num = "rating" . $num_row;
                                ?>
                                <tr>
                                    <td><?= $row['questionText'] ?></td>
                                    <td>
                                        <div class="wrapper">
                                                <span class="rating">
                                                    <input id="<?= $rating_row_num . "5" ?>" type="radio"
                                                           name="<?= $rating_row_num ?>" value="5">
                                                    <label for="<?= $rating_row_num . "5" ?>">5</label>
                                                    <input id="<?= $rating_row_num . "4" ?>" type="radio"
                                                           name="<?= $rating_row_num ?>" value="4">
                                                    <label for="<?= $rating_row_num . "4" ?>">4</label>
                                                    <input id="<?= $rating_row_num . "3" ?>" type="radio"
                                                           name="<?= $rating_row_num ?>" value="3">
                                                    <label for="<?= $rating_row_num . "3" ?>">3</label>
                                                    <input id="<?= $rating_row_num . "2" ?>" type="radio"
                                                           name="<?= $rating_row_num ?>" value="2">
                                                    <label for="<?= $rating_row_num . "2" ?>">2</label>
                                                    <input id="<?= $rating_row_num . "1" ?>" type="radio"
                                                           name="<?= $rating_row_num ?>" value="1">
                                                    <label for="<?= $rating_row_num . "1" ?>">1</label>
                                                </span>
                                        </div>
                                    </td>
                                </tr>

                                <?php
                                $num_row++;
                            }

                            //                            ?>


                            </tbody>

                        </table>

                    </div>

                    <div class="form-group">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="th-lg">Part2: Please answer these questions.
                                </th>

                            </tr>
                            </thead>

                            <tbody>

                            <?php
                            //                           echo "<h1>Hello, connented</h1>"; //test
                            $sql2 = "SELECT questionText FROM question where questionType=2";
                            $result_answer = mysqli_query($conn, $sql2);
                            $num_row_answer = 1;
                            while ($row_answer = mysqli_fetch_assoc($result_answer)) { // seperate php with html tag
                                $answer_row_name = "answer_text" . $num_row_answer;
                                ?>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label for="<?= $answer_row_name ?>"><?= $row_answer['questionText'] ?></label>
                                            <textarea class="form-control" id="<?= $answer_row_name ?>"
                                                      name="<?= $answer_row_name ?>"
                                                      rows="3"></textarea>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                $num_row_answer++;
                            }
                            mysqli_close($conn);
                            ?>

                            </tbody>

                        </table>
                    </div>
                </div>
                <hr>

                <div class="submitButton text-center">
                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                </div>
            </form>
        </div>

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
<script>

    $(document).ready(function () {
        $('#submit').click(function (e) {
            var isValid = true;
            $('textarea').each(function () {
                if ($.trim($(this).val()) == '') {
                    isValid = false;
                    $(this).css({
                        "border": "1px solid red",
                        "background": "#FFCECE"
                    });
                }
                else {
                    $(this).css({
                        "border": "",
                        "background": ""
                    });
                }
            });

            if (!isValid == false || $("input").is(':checked'))
                // alert('Thank you for submitting');
            else

                e.preventDefault();

        });

    });

</script>
</body>

</html>