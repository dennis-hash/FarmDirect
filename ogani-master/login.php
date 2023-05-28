<?php
//require_once 'index.php';
if(isset($_POST['submit'])){

    //grabing the data
    $username = $_POST['user'];
    $pass = $_POST['pass'];
    
    //instantiate singup controller class
    include "../classes/dbConnect.class.php";
    include "../classes/login.classes.php";
   // include "../classes/loginController.php";

    $singup = new Login($username, $pass);
    $singup->loginUsers();
    //going back to front page
    //header("loaction: ../index.php?error=none");
}
?>
<!DOCTYPE html>
<html>
   
    <head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="site.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    </head>
         <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="img/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>$150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Spanis</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div>
            <div class="header__top__right__auth">
                <a href="#"><i class="fa fa-user"></i> Login</a>
            </div>
        </div>
        
       <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <!-- <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                <li>Free Shipping for all Order of $99</li>
            </ul>
        </div> -->
    </div>

    <!-- Header Section Begin -->
    <header class="header">
        
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./index.html"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <nav class="header__menu">
                        <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="blog.php">Blogs</a></li>
                        <li><a href="messages.php">Messages</a></li>
                        <li><a href="myAccount.php">Account</a></li>
                        <li><a href="AddProducts.php">SELL</a></li>
                        <li>
                            <?php if ($loggedin) : ?>
                            <a href="logout.php">Logout</a>
                            <?php else : ?>
                            <a href="login.php">Login</a>
                            <?php endif; ?></li>
                        </ul>
                    </nav>
                </div>
                
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

     <!-- Hero Section Begin -->
     <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Categories</span>
                        </div>
                        <ul>
                            <li><a href="#">Agroproducts</a></li>
                            <li><a href="#">Farm Machinery</a></li>
                            <li><a href="#">Feeds & Supplements</a></li>
                            <li><a href="#">Livestock & Poultry</a></li>
                            <li><a href="#">Fertilizers</a></li>
                            <li><a href="#">Pesticides & insecticides</a></li>
                            <li><a href="#">Agroservices</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                   
                    <div class="hero__item set-bg" data-setbg="img/hero/banner.jpg">
                    <div class ="log">
           <?php
     
            $login_check = $_GET['error'];
            if($login_check == "usernotfound"){
                echo "<p class = 'error' >Unable to login with provided credentials</p>";
                //exit();
            } elseif($login_check == "emptyInputs"){
                echo "<p class = 'error'>Fill all fields </p>";
                //exit();
            }
            

            ?>
            <div class="loginbox">
                <div class="box">
                
                        <h2>xyz</h2>
                        <h1 class="g">Account login</h1>
                    
                   <form action="" method = "POST">
                       <p>Username</p>
                       <input type="text" name="user" placeholder="Enter Username">
                       <p>Password</p>
                       <input type="password" name="pass" placeholder="Enter Password">
                       
                       <p class = "terms"><a href="" >Forgot password?</a></p><br>
                       <input type="submit" name="submit" placeholder="Login" value="Login">
                       
                        <h1 class="g">Create account</h1>
                        </form>
                    <form action="singup.php">
                        <input type="submit" name="signup" value="Register">
                   </form>
                   </div>
            </div>
            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
       
      
    
</html>

