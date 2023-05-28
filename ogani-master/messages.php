    <?php
        
        session_start();
        if (isset($_SESSION['user'])) {
            $user_id=$_SESSION['user_id'];

        }

        include_once '../classes/dbConnect.class.php';
        $db = new DB();
        $DB = $db->dbConnection();
        $sql = "SELECT * FROM messages WHERE incoming_msg_id = :in_id  ORDER BY id";
        $stmt = $DB->prepare($sql);
        $stmt->execute(array(':in_id'=>$user_id));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $a=array();

    ?>
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
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
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



    <div class="connn">
        <div class="no_chats">
            <?php
                include_once '../classes/dbConnect.class.php';
                $db = new DB();
                $DB = $db->dbConnection();
                $sql = "SELECT * FROM messages WHERE incoming_msg_id = :in_id  ORDER BY id";
                $stmt = $DB->prepare($sql);
                $stmt->execute(array(':in_id'=>$user_id));
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $a=array();
                foreach($result as $row){
                        $prod_id = $row['prod_id'];
                        $out_id =$row['outgoing_msg_id'];
                        $in_id =$row['incoming_msg_id'];
                        array_push($a,$out_id);
                     
                }
                $num_unique = array_unique($a);
             

                foreach($num_unique as $num){
                   
                    $sql = "SELECT * FROM users WHERE userID = :id";
                    $stmt = $DB->prepare($sql);
                    $stmt->execute(array(':id'=>$num));
                    $result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $noRows= $stmt->rowCount();
                    foreach($result2 as $row2){
                        $username=$row2['username'];
                       
                        $user_id=$row2['userID'];
                    }
                    if($noRows = 0){
                        echo "<p>No available chats</p>";
                    }
                    echo "<a href='#' onclick='show_chat(".$user_id.','.$in_id."); return false;'><div class='no_chats'>
                    <div class='sent_msg'>
                    
                    <p>$username</p>
                    </div>
                    </div></a>";
                }
            ?>
        </div>
        <div class="chat_area">
        <div class="chat-box">
                <p style="text-align: center;">Select Chat to view conversation</p>

        </div>
        <form action="../classes/chat.class.php" class="typing-area" name="form" id="form" method="post">
        <input type="text" id="sender_id" class="" name="" value="<?php echo $in_id?>" hidden>
          <input type="text" id="seller_id" class="" name="" value="<?php echo $user_id?>" hidden>
          <input type="text" id="prod_id" class="" name="" value="<?php echo $prod_id?>" hidden>
          <input type="text" id="message" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
          <input type="submit" class="icon"  value="send" style="width: 55px; background: #0D5BE1;">
          
        </form>
        </div>

    </div>

<script>
   function show_chat(sender_id,my_id){
       
       var url = '../classes/chat.class.php';
        var posting = $.get( url, { action: 'getchat', sender_id:sender_id, seller_id:my_id });
        posting.done(function( data ) {
        
        $('.chat-box').html(data);

         
    });
   } 
   $('form').submit(function(event){
    event.preventDefault();
    var $form = $(this);
    url = $form.attr('action');
    var action = 'send_message';
     send(url, action);
     show_chat(sender_id,my_id)
    });
    function send(url,action){
        console.log($('#sender_id').val());
        console.log($('#seller_id').val());

      var formData = new FormData($('form')[0]);
      formData.append('message', $('#message').val());
      formData.append('sender_id', $('#sender_id').val());
      formData.append('seller_id', $('#seller_id').val());
      formData.append('prod_id', $('#prod_id').val());
      formData.append('action', action);
      //formData.append('seller_id', seller_id);
      //formData.append('prod_id', prod_id);
   
      $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        async: false,
        success: function (data) {
          //$('.chat-box').html(data);
        },
        cache: false,
        contentType: false,
        processData: false
      });

      chatBox = document.querySelector(".chat-box");
      chatBox.scrollBottom = chatBox.scrollHeight;
      
    }

</script>

  

   

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