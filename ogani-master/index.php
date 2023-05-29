<?php
    session_start();
    if (isset($_SESSION['user']))
    {
        $user = $_SESSION['user'];
        $loggedin = TRUE;  
    }
    if($_SESSION['user_role'] === 'admin'){
        $admin = TRUE;
    }
    else{
        $admin = FALSE;
    }
    
   

?>
<!DOCTYPE html>
<html lang="zxx">

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body>
    <!-- Page Preloder -->
    <!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->

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
    <!-- Humberger End -->

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
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <div class="hero__search__categories">
                                    Categories
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" placeholder="What do yo u need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                       
                    </div>
                    <div class="hero__item set-bg" data-setbg="img/hero/banner.jpg">
                        <div class="hero__text">
                            
                            <h2>Farm Products</h2>
                            <p>We offer a wide variety of farm products</p>
                            <a href="#" class="primary-btn">SHOP NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            <li data-filter=".oranges">Farm Machinery</li>
                            <li data-filter=".fresh-meat">Feeds & Supplements</li>
                            <li data-filter=".vegetables">Fertilizers</li>
                            <li data-filter=".fastfood">Agroservices</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
               
                    <div class="featured__item"></div>
            </div>
        </div>
    </section>
    

    <!-- Blog Section Begin -->
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>From The Blog</h2>
                    </div>
                </div>
            </div>
            
                
                    <div class='blog__item'>
                    <?php
                    include_once '../classes/dbConnect.class.php';

                    $db = new DB();
                    $DB = $db->dbConnection();
                    $sql = "SELECT * FROM articles";
                    $result = $DB->query($sql);

                    $result->execute();
                    $result->setFetchMode(PDO::FETCH_ASSOC);
                    $articles = $result->fetchAll();
                    foreach ($articles as $article) {
                        $id = $article['id'];
                        echo "
                        <div class = 's' onclick='full_article($id)'>
                        <div class='blog__item__pic'>
                            <img src=". $article['imagepath'] ." >
                        </div>
                        <div class='blog__item__text'>
                            <ul>
                                <li><i class='fa fa-calendar-o'></i> " . $article['created_at'] . "</li>
                               
                            </ul>
                            <h5><a href='#'>" . $article['title'] . "</a></h5>
                            <p>" . $article['content'] . " </p>
                        </div>
                        </div>
                   
                        ";
                       
                    }

                    ?>
                    
                
            </div>
        </div>
    </section>
    <!-- Blog Section End -->

    <!-- Js Plugins -->
    <script>
        getall();
        function getall(){
            console.log('getall');
    $.get('../classes/index.class.php',{ action:'display_products'})
        .done(function(data){
            console.log(data);
        $('.featured__item').html(data);
        });
    }
    </script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>



</body>

</html>