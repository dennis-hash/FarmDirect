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

                    echo "
                    <main class='container'>

                    <!-- Left Column / Headphones Image -->
                    <div class='left-column'>
                
                      <img data-image='red' class='active' src='$this->productImage' alt=''>
                    </div>
              
              
                    <!-- Right Column -->
                    <div class='right-column'>
              
                      <!-- Product Description -->
                      <div class='product-description'>
                        <span>Category: $this->category </span>
                        <h1>$this->productName</h1>
                        <p>$this->productDescription</p>
                      </div>
              
                      <!-- Product Configuration -->
                      <div class='product-configuration'>
              
                        <!-- Product Color -->
                        <div class='product-color'>
                          <span>Quantity: $this->quantity</span>
              
              
                        </div>
              
                        <!-- Cable Configuration -->
                        <div class='cable-config'>
                          <span>Location</span>
              
                          <div class='cable-choose'>
                            <button>$this->county</button>
                            <button>$this->subcounty</button>
                            
                          </div>
              
                          <a href='#'>Posted:$this->difference Hrs ago</a>
                        </div>
                      </div>
              
                      <!-- Product Pricing -->
                      <div class='product-price'>
                        <span>Ksh $this->productPrice</span>
                        <a onclick='buy()' class='cart-btn'>Buy</a>
                      </div>
                    </div>
                  </main>
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
        <main class='container'>

                    <!-- Left Column / Headphones Image -->
                    <div class='left-column'>
                
                      <img data-image='red' class='active' src='$this->productImage' alt=''>
                    </div>
              
              
                    <!-- Right Column -->
                    <div class='right-column'>
              
                      <!-- Product Description -->
                      <div class='product-description'>
                        <span>Category: $this->category </span>
                        <h1>$this->productName</h1>
                        <p>$this->productDescription</p>
                      </div>
              
                      <!-- Product Configuration -->
                      <div class='product-configuration'>
              
                        <!-- Product Color -->
                        <div class='product-color'>
                          <span>Quantity: $this->quantity</span>
                        </div>

                        <form class='buy_form' action='/' method='post' name='form' target='_blank'
                        onSubmit='handleFormSubmit(this); return false;'>
                        <input type='text' name='phone' id='phone' value='$this->userPhone'required>
                        <p>Confirm Email<a style='color:red;'> *</a></p>
                        <input type='text' name='email' id='email' value='$this->userEmail'required>
                        <p>Delivery Location<a style='color:red;'> *</a></p>
                        <input type='text' name='address' id='address' value='$this->userAddress'required>
                       
                        </label></p>
                        <p>Total Amount</p>
                        <input type='text' name='total' id='total' value='$this->productPrice' disabled>
                        <p></p>
                        <input class='cart-btn' type='submit' value='Send Request' >
                        </form>         
                    </div>
                  </main>





        ";


      
    }
    

 
}
?>


