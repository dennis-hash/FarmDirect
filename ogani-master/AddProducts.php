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
    <link rel="stylesheet" href="style2.css" type="text/css">
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
       <section class="blog">
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
                <div class="col-lg-9 ">
                <div class='error'></div>
   <div class = "contain">
   
    <div class="addProduct">
        <form  action="" method="post" enctype="multipart/form-data">
         <div class = "grid">
             <div class ='data'>
          <p>Category</p>
              <select id="category" name="category">
                <option value="">--select-- </option>
                <option value="Farm Machinery & Equipments">Farm Machinery & Equipments</option>
                <option value="Feeds, Supplements & Seeds">Feeds, Supplements & Seeds</option>                  
                <option value="Livestock & Poultry">Livestock & Poultry</option>
                <option value="Fertilizers & Chemicals">Fertilizers & Chemicals</option>
                <option value="Pesticides & Insecticides">Pesticides & Insecticides</option>
                <option value="Agro-Processing">Agro-Processing</option>
                <option value="Agro-Services">Agro-Services</option>

              </select>
              </div>
              <!--<div class ='data'>
          <p>Sub Category</p>
              <select name="subcategory">
                <option value="">--select-- </option>
                <option value="Farm Machinery & Equipments">Farm Machinery & Equipments</option>
                <option value="Feeds, Supplements & Seeds">Feeds, Supplements & Seeds</option>                  
                <option value="Livestock & Poultry">Livestock & Poultry</option>
                <option value="Fertilizers & Chemicals">Fertilizers & Chemicals</option>
                <option value="Pesticides & Insecticides">Pesticides & Insecticides</option>
                <option value="Agro-Processing">Agro-Processing</option>
                <option value="Agro-Services">Agro-Services</option>

              </select>
              </div>-->
              <div class="data">
            <p>County</p>
            <select required name="county" id="county" onchange="populate()">
                <option value="">--select-- </option>
                <option value="Mombasa">Mombasa </option>                  
                <option value="Kwale">Kwale</option>
                <option value="Kilifi">Kilifi</option>
                <option value="Tana River">Tana River</option>
                <option value="Lamu">Lamu </option>
                <option value="Taita Taveta">Taita Taveta </option>
                <option value="Garissa">Garissa</option>
                <option value="Wajir"> Wajir</option>
                <option value="Mandera"> Mandera</option>
                <option value="Marsabit"> Marsabit</option>
                <option value="Isiolo"> Isiolo</option>
                <option value="Meru"> Meru </option>
                <option value="Tharaka Nithi"> Tharaka Nithi </option>
                <option value="Embu">  Embu</option>
                <option value="Kitui">  Kitui</option>
                <option value="Machakos">  Machakos</option>
                <option value="Makueni">  Makueni</option>
                <option value="Nyandarua">  Nyandarua </option>
                <option value="Nyeri">  Nyeri</option>
                <option value="Kirinyaga">  Kirinyaga </option>
                <option value="Muranga">  Murang’a </option>
                <option value="Kiambu">  Kiambu</option>
                <option value="Turkana">   Turkana </option>
                <option value="West Pokot">   West Pokot</option>
                <option value="Samburu">   Samburu </option>
                <option value="Trans Nzoia">   Trans-Nzoia </option>
                <option value="Uasin Gishu">   Uasin Gisshu</option>
                <option value="Elgo Marakwet">   Elgeyo Marakwet</option>
                <option value="Nandi">   Nandi</option>
                <option value="Baringo">   Baringo</option>
                <option value="Laikipia">   Laikipia</option>
                <option value="Nakuru">   Nakuru</option>
                <option value="Narok">   Narok</option>
                <option value="Kajiado">   Kajiado</option>
                <option value="Kericho">   Kericho</option>
                <option value="Bomet">   Bomet</option>
                <option value="Kakamega">   Kakamega</option>
                <option value="Vihiga">   Vihiga </option>
                <option value="Bungoma">   Bungoma </option>
                <option value="Busia">   Busia </option>
                <option value="Siaya">   Siaya </option>
                <option value="Kisumu">   Kisumu </option>
                <option value=" Homa Bay">   Homa Bay </option>
                <option value="Migori">   Migori</option>
                <option value="Kisii">   Kisii </option>
                <option value="Nyamira">   Nyamira</option>
                <option value="Nairobi">   Nairobi</option>
            </select>
            </div>
            <div class="data">
                <p>Sub County</p>
                 <select required name="subcounty" id="subcounty">
                <option value="">--select-- </option>
                <select>
            </div>
            <div class="data">
                <p>Title</p>
                <input type="text" placeholder="Title" id="product_name" name="product_name">
            </div>
            <div class="data">
                <p>Quantity in Kgs</p>
                <input type="text" placeholder="Quantity" id="product_quantity" name="product_quantity">
            </div>
            <div class="data">
                <p>Price</p>
                <input type="text" placeholder="Product price" id="product_price" name="product_price">
            </div>
            <div class="data">
                <p>Upload file</p>
                <input class = "file" type="file" id='image' name='image'>
            </div>
            </div>
            <div class = "textarea">
                <p>Description</p>
                <textarea  name="textarea" id="textarea" cols="30" rows="7" placeholder="Type here..."></textarea>
            </div>
            <div class="datasubmit">
                <input type="submit" name="add" value="ADD">
            </div>
           
        </form>
    </div>
    </div>
            </div>
        </div>
    </section>
   

   
   
</body>
<!--<script>
 function initMap(){
 	var input = document.getElementById('search');
 	var autocomplete =  new google.maps.places.Autocomplete(input);
 }
</script>
<script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtYtYPbBn1IhLM2gzqftYPb6s1SBlVjT8&libraries=places&callback=initMap">
</script>-->
<script src="addProduct.js"></script>

<script>
    //add

    //update 
    $('form').submit(function(event){
    event.preventDefault();
    var $form = $(this),
    url = "../classes/products.classes.php";
    var action = 'insert';
     insert(url, action);
   
    });

    function insert(url,action){
        var page_url = window.location.search.substring(1);
        var parameter = page_url.split('=');
        var action2 = parameter[0];
        var index = parameter[1];
       
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
        formData.append('index', index);
        formData.append('edit', action2);
        formData.append('action', action);
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
                $('.error').html(data);
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
               
                //alert(data);
                //window.location.href = "../pages/addProduct.php";
            }
        });
    }




</script>
</html>



