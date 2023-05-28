<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('location: login.php?error=notLoggedIn ');
        exit();
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

            </div>
        </div>
    </section>
   
    <div class="profile_Records">
  
        <div class="prof"></div>
       
        <div class="adispRecords">
         
        </div>  
    </div>
      <div class="sales">
          <h1>Sales</h1>
        <table >
        <thead>
                  <tr>
                      <th scope="col">Transaction NO</th>
                      <th scope="col">Phone Number</th>
                      <th scope="col">Transaction ID</th>
                      <th scope="col">Amount</th>
                  </tr>
                </thead>
                <tbody>
          <?php
          $conn = mysqli_connect("localhost","dennis","12414-Denn!s","projectDB");

          $query1= mysqli_query($conn,"SELECT*from payment_info");
          while($row=mysqli_fetch_array($query1))
          {
              ?>
                          <tr>
                              <td style="color:black;"><?php echo $row['CheckoutRequestID']; ?></td>
                              <td style="color:green;"><?php echo $row['PhoneNumber']; ?></td>
                              <td style="color:crimson;"><?php echo $row['MpesaReceiptNumber']; ?></td>
                              <td style="color:green;"><?php echo $row['amount']; ?></td>
      
                          </tr>
      
                          <?php } ?>
                      </tbody>
                  </table>
          
       

    </div> 
</body>
<script>
  var error;
    getall();
    function getall(){
    
  //url = '../classes/myaccount.class.php';
  //var page_url = window.location.search.substring(1);
  //var parameter = page_url.split('=');
  //var action = parameter[0];
  //var index = parameter[1];
//
  //var posting = $.post( url, { action:'edit', a:action ,index:index });
  //posting.done(function( data ) {
  //     $('.dispRecords').html(data);   
  //});
    
   
  $.get('../classes/myaccount.class.php',{ action:'myPoducts'})
  .done(function(data){
    $('.adispRecords').html(data);
  });

  
  console.log(error);
  }
  function edit(id){
    
    var posting = $.post( '../classes/myaccount.class.php', { action:'edit',prodid:id});
    posting.done(function( data ) {
        $('.adispRecords').html(data);   
    });
    //$('.dispRecords').load(" .dispRecords");
  }
  function update_prod(prodid){
    //product_name = $('#product_name').val();
    //product_price = $('#product_price').val();
    //product_description = $('#product_description').val();
    //textarea = $('#textarea').val();
    //product_quantity = $('#product_quantity').val();
    //category = $('#category').val();
    //county = $('#county').val();
    //subcounty = $('#subcounty').val();
    
        var file= $('#image')[0].files;
        var formData = new FormData();
        formData.append('image', file[0]);
        formData.append('product_name', $('#product_name').val());
        formData.append('product_quantity', $('#product_quantity').val());
        formData.append('product_price', $('#product_price').val());
        formData.append('textarea', $('#textarea').val());
        formData.append('category', $('#category').val());
        formData.append('county', $('#county').val());
        formData.append('subcounty', $('#subcounty').val());
        formData.append('index', prodid);
        formData.append('edit', 'edit');
        ;
        $.ajax({
            url: "../classes/products.classes.php",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
               
                $('.err').html(data);
                error = data;
                $('#county').val('');
                $('#subcounty').val('');
                $('#product_name').val('');
                $('#product_quantity').val('');
                $('#product_price').val('');
                $('#textarea').val('');
                $('#category').val('');
                $('#image').val('');
                $('#county').val('');
                $('#subcounty').val('');
                $('.adispRecords').load('.adispRecords')
              
            }
        });
  }

</script>
</html>