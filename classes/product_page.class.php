<?php
require_once 'dbConnect.class.php';
session_start();

$d = new dd();

if($_POST['action'] === 'pageurl'){
  $title = $_POST['id1'];
  $date_time = $_POST['id2'];
  $_SESSION['title']=$title;
  $_SESSION['date_time']=$date_time;

  $d->searched_prod($title,$date_time);


}
if($_GET['action']==='getcontacts'){
  
    $title= $_SESSION['title'];
    $date_time=$_SESSION['date_time'];
    $d->getcontacts($title,$date_time);
}
if($_POST['action'] === 'buy'){
    $title= $_SESSION['title'];
    $date_time=$_SESSION['date_time'];
    $d->buy($title,$date_time);
}
 
class dd {
    private $productName;
    private $id;
    private $productPrice;
    private $productDescription;
    private $county;
    private $subcounty;
    private $category;
    private $productImage;
    private $difference;
    private $created_at;
    private $output;
    public function __construct(){
        $db=new DB();
        $this->DB = $db->dbConnection();
        
    }
    public function getproduct($title,$date_time){
        $date_time=str_replace("%20"," " ,$date_time);
        $sql = "SELECT * FROM `products` WHERE `productName` = :prodName AND `created_at` = :date_time ";
          $stmt = $this->DB->prepare($sql);
         
         $stmt->execute(array(':prodName' => $title, ':date_time' => $date_time));
          
        $result = $stmt->fetchAll();
        return $result;
    }
    
    
  public function searched_prod($title,$date_time){
     // $date_time=str_replace("%20"," " ,$date_time);
     // $sql = "SELECT * FROM `products` WHERE `productName` = :prodName AND `created_at` = :date_time ";
     //   $stmt = $this->DB->prepare($sql);
     //  
     //  $stmt->execute(array(':prodName' => $title, ':date_time' => $date_time));
     //   
     // $result = $stmt->fetchAll();
     //   $num_rows = $stmt->rowCount();  
     $result=$this->getproduct($title,$date_time);
       foreach($result as $row) {
       
                  
                    $this->productName = $row['productName'];
                    $this->productPrice = $row['price'];
                    $this->id = $row['productID'];
                    $this->productImage = $row['imagePath'];
                    $this->productDescription = $row['productDescription'];
                    $this->county = $row['County'];
                    $this->subcounty = $row['SubCounty'];
                    $this->category = $row['prodCategory'];
                    $this->quantity = $row['prodQuantity'];
                    $this->difference = $row['difference'];
                    $this->created_at = $row['created_at'];
                    session_start();
                    $_SESSION['prod_id']=$this->id;
                    echo "<div class='products'>
               
                            <div class='prods'>
                            <div class = 'prodImage'> <img src='$this->productImage' alt='$this->productName'> </div>
                            <div class = 'prodname'>  <p>$this->productName </p></div>
                            <div class = 'prodprice'> <p>Ksh $this->productPrice </p></div>
                            <div class = 'prodcategory'> <p>Category: $this->category </p></div>
                            <div class = 'proddesc'> <p>Description:$this->productDescription</p></div>
                            <!--<div class = 'prodquan'> <p>Quantity: $this->quantity</p></div>-->
                            <div class = 'prodlocation'> <p><img class = 'icon' src='../images/location-dot-solid.svg' alt=''>$this->county, $this->subcounty </p></div>
                            <div class = 'prodtime'><p> Posted:$this->difference Hrs ago</p></div>
                            <div class = 'prodquan'> <p>Quantity: $this->quantity</p></div>
                            <!--<div class = 'buy'><p><button onclick='buy()'> Buy</button></p></div>-->
                   </div>
                   <div class = 'buy'><p><button onclick='buy()'> Buy</button></p></div>
                   ";
                }
              
    } 
  
    public function getcontacts($title,$date_time){
     
     
        $date_time=str_replace("%20"," ",$date_time);
        $query ="SELECT users.userID,users.email,users.phoneNO,products.userID,products.created_at FROM users JOIN products ON users.userID = products.userID WHERE products.productName = :prodName AND products.created_at = :date_time";
        $stmt = $this->DB->prepare($query);
        $stmt->execute(array(':prodName' =>$title,':date_time'=>$date_time));
        $result = $stmt->fetchAll();
        $num_rows = $stmt->rowCount();
        foreach($result as $row) {
            $this->userID = $row['userID'];
            $this->userEmail = $row['email'];
            $this->userPhone = $row['phoneNO'];
           
            echo "<div class='contact'>
                    
                    <div class='contactinfoC'><p class='contactinfoC'>Contact Info</p></div>
                    <div class='contactinfoE'><p><img class='icon' src='../images/envelope-solid.svg' alt=''> $this->userEmail</p></div>
                    <div class='contactinfoP'>   <p><img class='icon' src='../images/phone-solid.svg' alt=''>$this->userPhone</p></div>
                   
                </div>";
        }
       
    }
    public function buy($title,$date_time){
        $result=$this->getproduct($title,$date_time);
        foreach($result as $row) {
            $this->productImage = $row['imagePath'];
            $this->productName = $row['productName'];
            $this->productPrice = $row['price'];
            $this->quantity = $row['prodQuantity'];
            $this->category = $row['prodCategory'];
        }
        $user=$_SESSION['user'];
        $userID=$_SESSION['user_id'];
        $sql = "SELECT * FROM users WHERE username = :username AND userID = :userID";
        $stmt = $this->DB->prepare($sql);
        $stmt->execute(array(':username' => $user,':userID'=>$userID));
        $result = $stmt->fetchAll();
        $num_rows = $stmt->rowCount();
        foreach($result as $row) {
            $this->userID = $row['userID'];
            $this->userEmail = $row['email'];
            $this->userPhone = $row['phoneNO'];
            $this->userName = $row['username'];
           
        }
        echo "
        <div class='buy_form'>
        <form class='buy_form' action='/' method='post' name='form' target='_blank'
        onSubmit='handleFormSubmit(this); return false;'>
        <div class = 'img'> <img src='$this->productImage' > </div>
        <div class = 'name'>  <p>$this->productName </p></div>
        <div class = 'price'> <p>Ksh $this->productPrice &nbsp &nbsp &nbsp </p></div>
        
        <p>Quantity:</p>
        <input type='text' name='phone' id='productname' value='$this->productName'hidden>
        <input type='text' name='phone' id='sender_id' value='$this->userID'hidden>
        <input type='number' name='quantity' id='quantity' value='1'  onchange='addPrice($this->productPrice)' min='1'required>
        <p>Confirm Phone<a style='color:red;'>*</a></p>
        <input type='text' name='phone' id='phone' value='$this->userPhone'required>
        <p>Confirm Email<a style='color:red;'>*</a></p>
        <input type='text' name='email' id='email' value='$this->userEmail'required>
        <p>Delivery Location<a style='color:red;'>*</a></p>
        <input type='text' name='address' id='address' value='$this->userAddress'required>
        <p>Payment Method<a style='color:red;'>*</a></p>
        <p><label class='container'>Pay On Delivery
        <input type='radio' id='pod' name='radio' value='pod'>
        <span class='checkmark'></span>
        </label>
        <label class='container'>Mpesa
        <input type='radio' id='mpesa' name='radio' value='mpesa'>
        <span class='checkmark'></span>
        </label></p>
       
      
        <p>Total Amount</p>
        <input type='text' name='total' id='total' value='$this->productPrice' disabled>
        <p></p>
        <input class='button' type='submit' value='Send Request' >
        </form>
        </div>
        ";


      
    }
    

 
}
?>


