<?php
require_once '../../utilities/functions.php';
checkCredentials();
$conn = connect();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
          crossorigin="anonymous">
    <link rel="stylesheet" href="../../stylesheets/internal_pages.css">
    <title>Dashboard</title>

<!--    for table icon-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../../stylesheets/feedback_question.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>

<body>

<?php include_once "./admin_navigation.php";?>


<!-- HEADER -->
<header id="main-header" class="py-2 bg-primary text-white mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>
                    <i class="fas fa-pencil-alt"></i> Edit feedback questions</h2>
            </div>
        </div>
    </div>
</header>


<!-- BUTTONS ON THE LEFT SIDE -->
<section>

            <div class="container-fluid">
                <div class="row margin-bottom justify-content-center">
                    <?php include_once('admin_sidebar.php')?>


            <!-- TABLE -->
            <div class="col-md-8">
                <div class="container">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-8">
                                    <h2> <b>Feedback Questions</b></h2>
                                </div>
                                <div class="col-sm-4">
                                    <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button>
                                </div>
                            </div>
                        </div>
                        <form action="edit_feedback_questions.php" method="post" >
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Num</th>
                                <th>Type <span class="star">*</span></th>
                                <th>Questions</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            function load_data()
                            {

                                $conn = connect();
                                //  select all texts from table
                                $sql = "SELECT * FROM question";
                                $result = mysqli_query($conn, $sql);  //start to search(select)

                                while ($row = mysqli_fetch_assoc($result)) { // seperate php with html tag


                                    ?>

                                    <tr>
                                        <td><input type="text" name="questionID[]" class="qu_id" value="<?= $row['questionID'] ?>"
                                                   readonly></td>
                                        <td>
                                            <select name="type_orginal" disabled="disabled"
                                                    class="form-control status_change type">
                                                <?php
                                                // change type number to text
                                                if ($row['questionType'] == 1) {
                                                    echo "<option selected>Rating</option><option>Text</option>";
                                                    ?>
                                                        </select>
                                                        <input type="hidden" name="type[]" class="type_middle" value="Rating">
                                                    <?php
                                                } else {
                                                    echo "<option>Rating</option><option selected>Text</option>";
                                                    ?>
                                                        </select>
                                                        <input type="hidden" name="type[]" class="type_middle" value="Text">
                                                    <?php
                                                }
                                                ?>


                                        </td>
                                        <td><input type="text" name="questions[]" class="qu_id status_change"
                                                   value="<?= $row['questionText'] ?>" readonly></td>
                                        <td>
                                            <a title="Add" data-toggle="tooltip">
<!--                                                <button type="button" class="add" name="submit_add"-->
<!--                                                        value="Done">Done-->
<!--                                                </button>-->
                                                <input type="submit" class="btn btn-success add" id="save-btn" name="submit" value="Submit">
                                            </a>
                                            <a title="Edit" data-toggle="tooltip">
                                                <button type="button" class="btn btn-secondary edit" value="Edit">Edit</button>
                                            </a>
                                            <a title="Delete" data-toggle="tooltip">
<!--                                                <button type="button" class="delete" name="delete"-->
<!--                                                        value="Delete">Delete-->
<!--                                                </button>-->
                                                <input type="submit" class="btn btn-danger delete" name="delete" value="Delete">
                                            </a>
                                        </td>
                                    </tr>
                                    <?php

                                }
                                mysqli_close($conn);
                            }
                            load_data();
                            ?>

                            </tbody>
                        </table>
<!--                            <input type="submit" class="btn btn-success" id="save-btn" name="submit" value="Save your change">-->
                            <input type="hidden" id="save_delete_id" name="deleteID" value="">
                            <input type="hidden" id="save_edit_id" name="editID" value="">

                        </form>


                    </div>
                    <div class="type_explain">
                        <strong><span class="star">*</span>Type has two kinds of questions. Rating: Theses questions are required a 1-5 star rating.</strong><br>
                        <strong>Text: Theses questions are required an answer with typing.</strong>
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
                <img src="../../images/white_bird_logo.png" width="60" alt="Black bird Logo">
            </div>
            <div class="col-md-8 pl-0">
                <p>&copy; 2019 Blackbird Project &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
            </div>
            <div class="col-md-3">
                <p class="float-right"><a href="#">Back to top</a></p>
            </div>
        </div>
    </div>
    </div>
</footer>

<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
        crossorigin="anonymous"></script>
<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>

<script type="text/javascript">
    $(document).ready( function() {
        $('#adminNav').load("./admin_navigation.php");
    });
</script>

<script src="../../scripts/feedback_questions.js"></script>

</body>

</html>