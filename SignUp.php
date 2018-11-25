<?php
include_once "config/core.php";

//page title
$page_title = "Sign Up";
include_once "login_checker.php";

//include classes
include_once "config/database.php";
include_once "object/user.php";
include_once "libs/php/utils.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>E-Life</title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">

        

        <!-- ***** Navbar Area ***** -->
        <div class="alazea-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="alazeaNav">

                        <!-- Nav Brand -->
                        <!--<a href="index.php" class="nav-brand"><img src="img/logo.png" style="width: 100px;"></a>-->

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">

                            <!-- Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Navbar Start -->
                            <div class="classynav font-cursive">
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="#">Catalogue</a>
                                        <ul class="dropdown">
                                            <li><a href="E-Life_Computer_Accessories.php">Computer Peripherals</a></li>   
                                            <li><a href="Project_Accessories.php">Project Accessories</a></li>
                                            <li><a href="E-Life_Book_Store.php">Book Store</a></li>
                                            <li><a href="Stationary_Store.php">Stationary Store</a></li>
                                            <li><a href="E-Life_Grocery_Store.php">Grocery Store</a></li>           
                                            <li><a href="Men's_Fashion.php">Men's Fashion</a></li>
                                            <li><a href="Women's_Fashion.php">Women's Fashion</a></li> 
                                            <li><a href="E-Life_Special.php">E-Life Special</a></li>
                                        </ul>
                                    </li>
                                    
                                </ul>
                            </div>
                            <!-- Navbar End -->
                        </div>
                    </nav>

                    <!-- Search Form -->
                    <div class="search-form">
                        <form action="#" method="get">
                            <input type="search" name="search" id="search" placeholder="Type keywords &amp; press enter...">
                            <button type="submit" class="d-none"></button>
                        </form>
                        <!-- Close Icon -->
                        <div class="closeIcon"><i class="fa fa-times" aria-hidden="true"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->

    <!-- form was submitted will be there-->
<?php
//if form submitted
if($_POST){
    //get databse connection
    $database = new Database();
    $db = $database->getConnection();

    //initializing objects
    $user = new User($db);
    $utils = new Utils();

    $user->email = $_POST['email'];

    if($user->emailExists()){
        echo"<div class='alert alert-danger'>";
             echo "Email is already registered.Please try again or<a href = 'login.php'> login.</a>";
        echo "</div>";
    }
    else{
        // if email already exist
        //set object values
        $user->firstname=$_POST['firstname'];
        $user->lastname=$_POST['lastname'];
        $user->password=$_POST['password'];
        $user->phone=$_POST['phone'];
        $user->access_level='Customer';
        $user->status =1;
        //create user
        if($user->create()){
            echo"<div class='alert alert-danger'>";
             echo "Successfully registered. <a href = '{$home_url}login'>Please login</a>.";
        echo "</div>";
        //empty posted values
        $_POST =array();
        }
        else{
            echo "<div class='alert alert-danger' role='alert'>Unable to register.Try again.</div>";
        }
    }
}

?>
    <!-- ##### Hero Area Start ##### -->
    <section class="hero-area">
        <div class="hero-post-slides owl-carousel">

            <!-- Single Hero Post -->
            <div class="single-hero-post bg-overlay">
                <!-- Post Image -->
                <div class="slide-img bg-img" style="background-image: url(img/bgsignup.jpg);"></div>
                <div class="container">
                    <div class="row h-100 align-items-center">
                        <div class="col-12">
                            <!-- Post Content -->
                            <div class="hero-slides-content font-cursive">
                                <h2>Sign Up Form!</h2>
                                <div class="row mt-30">
                                    <div class="col-md-8 col-sm-12">
                                        <form action="SignUp.php" id="SignUp" method="post">
                                            <div class="form-group">
                                                <label for="fname"><div class="font-clr">Firstname:</div></label>
                                                <input type="text" name="firstname" class="form-control" id="" placeholder="Enter firstname" name="" required value ="<?php echo isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname'], ENT_QUOTES) : ""; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="fname"><div class="font-clr">Lastname:</div></label>
                                                <input type="text" name="lastname" class="form-control" id="" placeholder="Enter lastname" name="" required value ="<?php echo isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname'], ENT_QUOTES) : ""; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="email"><div class="font-clr">Email:</div></label>
                                                <input type="email" name="email" class="form-control" id="" placeholder="Enter Email" name="" required value ="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES) : ""; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="password"><div class="font-clr">Password:</div></label>
                                                <input type="password"  name="password" class="form-control" id="" placeholder="Enter password" name="" required id ='passwordInput'>
                                            </div>
                                            <div class="form-group">
                                                <label for="phnumber"><div class="font-clr">Phone Number:</div></label>
                                                <input type="text"  name="phone" class="form-control" id="" placeholder="Enter phone number" name="" required value ="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone'], ENT_QUOTES) : ""; ?>">
                                            </div>
                                            <br>
                                            <button type="submit" value="signup"  name="signup" class="btn btn-default">Create Account</button>
                                        </form>
                                        <br>
                                        <h5 class="font-clr">Already have an account!<a href="login.php"><h5 class="font-clr">Log In!</h5></a></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Hero Area End ##### -->


    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area bg-img font-cursive" style="background-image: url(img/footer.jpg);">
        <!-- Main Footer Area -->
        <div class="main-footer-area">
            <div class="container">
                <div class="row">

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget">
                            <div class="widget-title">
                                <h5>E-Life</h5>
                            </div>
                            <p>Join Us</p>
                            <div class="social-info">
                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget">
                            <div class="widget-title">
                                <h5>CONTACT</h5>
                            </div>

                            <div class="contact-information">
                                <p><span>Address:</span> UET, Lahore</p>
                                <p><span>Phone:</span> +92 322 4375787</p>
                                <p><span>Email:</span> elife@gmail.com</p>
                                <p><span>Open hours:</span> 24/7</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom Area -->
        <div class="footer-bottom-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="border-line"></div>
                    </div>
                    <!-- Copywrite Text -->
                    <div class="col-12 col-md-6">
                        <div class="copywrite-text">
                            <p>&copy; <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- ##### All Javascript Files ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>
</body>

</html>