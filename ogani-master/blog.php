<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani | Template</title>

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
</head>

<body>
   


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
                            <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </nav>
                    </div>
                   
                </div>
                <div class="humberger__open">
                    <i class="fa fa-bars"></i>
                </div>
            </div>
        </header>

    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
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
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->



    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="blog__sidebar">
                        <div class="blog__sidebar__search">
                            <form action="#">
                                <input type="text" placeholder="Search...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>Categories</h4>
                            <ul>
                                <li><a href="#">All</a></li>
                                <li><a href="#">Life Style</a></li>
                                <li><a href="#">Food</a></li>
                                <li><a href="#">Life Style</a></li>
                                <li><a href="#">Travel</a></li>
                            </ul>
                        </div>
      
        
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="row">
                        
                    <div class="col-lg-12">
                            <div class="blog__item">
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
                                        <a onclick='full_article($id)'>View Article<span class='arrow_right'></span></a>
                                    </div>
                                    </div>
                            
                                    ";
                                
                                }

                                ?>
                                
                        </div>
                        <div class="col-lg-12">
                            <div class="product__pagination blog__pagination">
                                <a href="#">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->

   

    <!-- Js Plugins -->
    <script>

function full_article(id){
    
    $.get('../classes/admin.class.php',{ action:'full_article', id:id})
    .done(function(data){
        $('.blog__item').html(data);
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