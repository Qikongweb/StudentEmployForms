<?php

//    if(isset($_POST['errors'])){
//        echo "there are errors";
//    }

//    echo $_GET['error'];
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
    <script src="./../../scripts/login_validation.js" async></script>

    <title>NSCC Job Fair Website</title>
    <style>
        @import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");

        .login-block {
            background: #D5E6F1;
            /* fallback for old browsers */
            background: -webkit-linear-gradient(to bottom, #D5E6F1, #3D8DC0);
            /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to bottom, #D5E6F1, #3D8DC0);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            float: left;
            width: 100%;
            padding: 50px 0;
        }

        .banner-sec {
            /* background: url(https://static.pexels.com/photos/33972/pexels-photo.jpg) no-repeat left bottom; */
            background-size: cover;
            min-height: 500px;
            border-radius: 0 10px 10px 0;
            padding: 0;
        }

        .container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 15px 20px 0px rgba(0, 0, 0, 0.1);
        }

        .carousel-inner {
            border-radius: 0 10px 10px 0;
        }

        .carousel-caption {
            text-align: left;
            left: 5%;
        }

        #carouselExampleIndicators {
            margin: 0;
        }

        .login-sec {
            padding: 50px 30px;
            position: relative;
        }

        .login-sec .copy-text {
            position: absolute;
            width: 80%;
            bottom: 20px;
            font-size: 13px;
            text-align: center;
        }

        .login-sec .copy-text i {
            color: #FEB58A;
        }

        .login-sec .copy-text a {
            color: #E36262;
        }

        .login-sec h2 {
            margin-bottom: 30px;
            font-weight: 800;
            font-size: 30px;
            color: #DE6262;
        }

        .login-sec h2:after {
            content: " ";
            width: 100px;
            height: 5px;
            background: #FEB58A;
            display: block;
            margin-top: 20px;
            border-radius: 3px;
            margin-left: auto;
            margin-right: auto
        }

        .btn-login-admi {
            background: #DE6262;
            color: #fff;
            font-weight: 600;
        }

        .banner-text {
            width: 70%;
            position: absolute;
            bottom: 40px;
            padding-left: 20px;
        }

        .banner-text h2 {
            color: #E36262;
            font-weight: 600;
        }

        .banner-text h2:after {
            content: " ";
            width: 100px;
            height: 5px;
            background: #FFF;
            display: block;
            margin-top: 20px;
            border-radius: 3px;
        }

        .banner-text p {
            color: #000;
        }
    </style>
</head>

<body>
    <header id="header"></header>

    <main role="main">
<!--        <div class="container" style="margin-top:250px">-->
<!--            <div class="row justify-content-md-center">-->
<!--                <div class="col-md-6">-->
<!---->
<!--                    <div class="card">-->
<!--                        <div class="card-header"><h2 style="margin:0px"><strong>Log In</strong></h2></div>-->
<!--                        <div class="card-body">-->
<!--                            <form role="form" action="./../php/login.php" method="post">-->
<!--                                <div class="form-group">-->
<!--                                    <label for="userName" class="h4">Username</label>-->
<!--                                    <input type="text" class="form-control form-control-lg" id="userName" name="userName" placeholder="Username"-->
<!--                                        --><?php //if(isset($_POST['userName'])){echo "value=".$_POST['userName'];} ?><!-->-->
<!--                                </div>-->
<!--                                <div class="form-group">-->
<!--                                    <label for="userPassword" class="h4">Password <!--<a href="/sessions/forgot_password">(forgot password)</a> --></label>-->
<!--                                    <input type="password" class="form-control form-control-lg" name="userPassword" id="userPassword" placeholder="Password">-->
<!--                                    --><?php //if(isset($_GET['error'])){
//                                        echo '<span id="wrongPassword" style="color:red">Incorrect Username or password</span>';
//                                    }?>
<!---->
<!--                                </div>-->
<!--                                <button type="submit" class="btn btn-outline-secondary btn-login btn-lg mt-3" class="btn-login-admi">Log In</button>-->
<!--                            </form>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

        <div class="login-block">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 login-sec">
                        <h2 class="text-center">Login Now</h2>
                        <form class="login-form">
                            <div class="form-group">
                                <label for="userName" class="text-uppercase">Username</label>
                                <input type="text" class="form-control " id="userName" name="userName" placeholder=""
                                    <?php if(isset($_POST['userName'])){echo "value=".$_POST['userName'];} ?>>

                            </div>
                            <div class="form-group">
                                <label for="userPassword" class="text-uppercase">Password <!--<a href="/sessions/forgot_password">(forgot password)</a> --></label>
                                <input type="password" class="form-control" name="userPassword" id="userPassword" placeholder="">
                                <?php if(isset($_GET['error'])){
                                    echo '<span id="wrongPassword" style="color:red">Incorrect Username or password</span>';
                                }?>
                            </div>
                            <!-- New test -->
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                </div>
                                <input type="password" class="form-control" placeholder="password">
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                </div>
                                <input type="text" name="" class="form-control" placeholder="username or email"/>
                            </div><br />

                            <div class="forgot">
                                <a href="reset.html">Forgot password?</a>
                            </div>

                            <button type="submit" class="btn btn-login float-right btn-login-admi">Login</button>

                        </form>

                    </div>
                    <div class="col-md-8 banner-sec">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active">
                                    <img class="d-block img-fluid"
                                         src="https://static.pexels.com/photos/33972/pexels-photo.jpg" alt="First slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <div class="banner-text">
                                            <h2>Administrator account</h2>
                                            <p>Only Administrators, Backup Operators have rights to login.</p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer id="footer" class="container"></footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready( function() {
            $('#header').load("../php/header.php");
        });
        $(document).ready( function() {
            $('#footer').load("../php/footer.php");
        });
    </script>

</body>

</html>