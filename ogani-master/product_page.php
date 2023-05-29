<?php

session_start();
include "header.php";
if(!isset($_SESSION['user'])){
    header('location: login.php?error=notLoggedIn ');
    exit();
}
?>





<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- CSS -->
    <link href="css/test.css" rel="stylesheet">
    <meta name="robots" content="noindex,follow" />

  </head>

<body>
  <?php
    $user = $_SESSION['user'];
    $user_id = $_SESSION['user_id'];
  ?>
<div class="containerr">
  <div class="a"> </div>
  <div class="right">
  <!-- <div class="contacts"> </div> -->

  <div class="modal" id="modal">
    <div class="modal-header">
      <div class="title"></div>
      <button data-close-button class="close-button" onclick="closeModal()">&times;</button>
    </div>
    <div class="modal-body">
     A request has been sent!
    </div>
  </div>
  <div id="overlay"></div>

  
 
  </div>
</div>
  
</body>
<script>
  
    var page_url = window.location.href;
    var page_url_array = page_url.split('=');
    var title = page_url_array[1];
    var created_at = page_url_array[2];
    var seller_id = page_url_array[3];
    var prod_id = page_url_array[4];
 
    console.log("prrr"+prod_id);
   post_data();
   $('.chat').hide();
    function post_data(){
     
      url = '../classes/product_page.class.php';
      var page_url = window.location.href;
      var page_url_array = page_url.split('=');
      var title = page_url_array[1];
      var created_at = page_url_array[2];
      var prod_id = page_url_array[4];
   
      var posting = $.post( url, { action: 'pageurl', id1:title ,id2:created_at });
      posting.done(function( data ) {
           $('.a').html(data);
           
      });
      //getchat();
      //var posting_to_chat = $.post( url2, { action: 'pageurl', id1:title ,id2:created_at });
      //posting_to_chat.done(function( data ) {
      //     $('.chat').html(data);
      //     
      //});

    
    }


  //getprice_offer();
  function getprice_offer(){
  $.get('../classes/product_page.class.php',{ action:'getprice_offer'})
      .done(function(data){
      $('.priceOffer').html(data);
      });
  }
  

  getcontacts();
  function getcontacts(){
    $.get('../classes/product_page.class.php',{ action:'getcontacts'})
      .done(function(data){
      $('.contacts').html(data);
      });
  } 
  //getpayment();
  function getpayment(){
    $.get('../classes/product_page.class.php',{ action:'getpayment'})
      .done(function(data){
      $('.payment').html(data);
      });
  } 
  //get_chat()
  function get_chat(){
    
    $('.chat').toggle(/*change text of button to hide chat */ function(){
      let text = $('#mybutton').html();
      if(text == 'Hide Chat'){
        $('#mybutton').html('Chat with Farmer');
      }else{
        $('#mybutton').html('Hide Chat');
      }

    });
      
    
    var page_url = window.location.href;
    var page_url_array = page_url.split('=');
    var seller_id = page_url_array[3];
    var prod_id = page_url_array[4];
    var sender_id = $('#sender_id').val();
    var seller_id = seller_id ;
    console.log("prod id"+prod_id);
    var url = '../classes/chat.class.php';
    var posting = $.post( url, { action: 'getchat', sender_id:sender_id, seller_id:seller_id });
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
     get_chat()
    });
    function send(url,action){
      var formData = new FormData($('form')[0]);
      formData.append('message', $('#message').val());
      formData.append('sender_id', $('#sender_id').val());
      formData.append('action', action);
      formData.append('seller_id', seller_id);
      formData.append('prod_id', prod_id);
   
      $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        async: false,
        success: function (data) {
          $('.chat-box').html(data);
        },
        cache: false,
        contentType: false,
        processData: false
      });
     
      //chatBox = document.querySelector(".chat-box");
      //chatBox.scrollBottom = chatBox.scrollHeight;
      
    }

    function buy(){
     console.log("sell");
     var posting = $.post( url, { action: 'buy'});
      posting.done(function( data ) {
          
          $('.a').html(data);

          
      });
      //$('.a').load(" .a");
    }
    function handleFormSubmit(){
    
        console.log("handle");
       
        var formData = new FormData();
        formData.append('sender_id', $('#sender_id').val());
        formData.append('name', $('#productname').val());
        formData.append('amount', $('#quantity').val());
        formData.append('phone', $('#phone').val());
        formData.append('email', $('#email').val());
        formData.append('address', $('#address').val());
        formData.append('total', $('#total').val());
        formData.append('payment', $('.radio').val());
        formData.append('action', 'send_buy_product_message');
        formData.append('seller_id', seller_id);
        formData.append('prod_id', prod_id);
        var s = $('#radio').val();
        console.log("Radio="+s);
        if( $('#mpesa').is(':checked')){
          if (modal == null) return
          modal.classList.add('active')
          overlay.classList.add('active')
          var phone_number=  $('#phone').val();
          var phone_number = '254' + phone_number;
          var amount =  $('#total').val();
         
          console.log("phone:"+phone_number,"Ksh"+amount)
         var mpesa_payment = $.post( '../Mpesa/stk_initiate.php?', { action: 'mpesa', phone:phone_number ,amount:amount ,seller_id:seller_id, prod_id:prod_id });
          mpesa_payment.done(function( data ) {
           
          });
          $.ajax({
            url: '../classes/chat.class.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
                $('.error').html(data);
                //alert(data);
                //window.location.href = "../pages/addProduct.php";
            }
        });
        }
        $.ajax({
            url: '../classes/chat.class.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
                $('.error').html(data);
                //alert(data);
                //window.location.href = "../pages/addProduct.php";
            }
        });
       
      
    }
 function addPrice(price){
  
  
   var amount = $('#quantity').val()
   console.log("price:"+price,"amount:"+amount)
  var total = price * amount;
  $('#total').val(total);
 }

 function closeModal() {
  if (modal == null) return
  modal.classList.remove('active')
  overlay.classList.remove('active')
}
</script>
</html>