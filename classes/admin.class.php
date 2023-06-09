<?php
include_once "dbConnect.class.php";
$admin = new Admin();
$admin->get_data();

class Admin{
    public function __construct(){
        $db=new DB();
        $this->DB = $db->dbConnection();
       

    }
    public function get_data(){
       // echo "<h1>elete</h1>";
       $d=1;
        if($_POST['action']==='view_users'){
           $this->getUsers();
            
        }
       if($_GET['action']==='delete_users'){
            $this->deleteUser($_GET['id']);
            $this->getUsers();
       
       }elseif($_GET['action']=='view_prod'){
            $this-> view_products();
       }elseif($_GET['action']=='view_prod'){
        $this-> view_products();
       }elseif($_GET['action']=='delete_product'){
        $this-> delete_product($_GET['id']);
       }elseif($_GET['action']=='add_article'){
        $this-> add_article();
       // $this->updateUser($_GET['id']);

       }elseif($_GET['action']=='full_article'){
        $this-> full_article($_GET['id']);
       // $this->updateUser($_GET['id']);

       }elseif($_POST['action']=='add_admin'){
          
          $this->add_admin($_POST['user'],$_POST['email'],$_POST['phone'],$_POST['pass']);
 
        }
    }
  

    public function getUsers(){
        
        $query = "SELECT * FROM `users`";
       $stmt = $this->DB->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        echo"<div class='profile_Records'> <div class='dispRecords'>
        <div class = 'records_heading'>Users</div>
        <table >
        <tr>
            <th>User_id</th>
            <th>Username</th>
            <th>Email</th>
            <th>PhoneNO</th>
            <th>Password</th>
            <th>User_role</th>
            <th>edit</th>
            <th>delete</th>
            
        </tr>";
       foreach($result as $row){
             $prodid=$row['userID'];
             
              echo '<tr>';
              echo '<td>'.$row['userID'].'</td>';
              echo '<td>'.$row['username'].'</td>';
              echo '<td>'.$row['email'].'</td>';
              echo '<td>'.$row['phoneNO'].'</td>';
              echo '<td>'.$row['password'].'</td>';
              echo '<td>'.$row['user_role'].'</td>';
              echo '<td><button style="background-color:green; color:white; border-radius:5px;" onclick="edit_user('.$row['userID'].')">Edit</button></td>';
              echo '<td><button style="background-color:red; color:white; border-radius:5px;" onclick="delete_user('.$row['userID'].')">Delete</button></td>';
             // echo "<td><form action='#' > <button type='submit' name='edit' value='$prodid'>edit</button> <br>
              //<button type='submit' name='delete' value='$prodid'>delete</button> </form></td>";
              echo '</tr>';
              echo'</div>';
              

       }
       echo"</table>";
       echo'</div> </div>';
    }
   
    public function deleteUser($userID){
        $query = "DELETE FROM `users` WHERE `userID` = :userID";
        $stmt = $this->DB->prepare($query);
        $stmt->execute(array(':userID' => $userID));
       
    }
    public function updateUser($userID,$name,$phone,$email,$password){
        $query = "UPDATE `users` SET `username`=:name,`phoneNO`=:phone,`email`=:email,`password`=:password WHERE `userID`=:userID";
        $stmt = $this->DB->prepare($query);
        $stmt->execute(array(':name' => $name, ':phone'=>$phone,':email' => $email, ':password' => $password,':userID'=>$userID));
        header("location: admin.php?success=userupdated");
        exit();
    }
    
    public function view_products(){
        $query = "SELECT * FROM `products`";
        $stmt = $this->DB->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
       
        foreach($result as $row){
            $this->id=$row['userID'];
           $this->productName = $row['productName'];
           $this->productPrice = $row['price'];
           $this->productImage = $row['imagePath'];
           $this->productDescription = $row['productDescription'];
           $this->county = $row['County'];
           $this->subcounty = $row['SubCounty'];
           $this->category = $row['prodCategory'];
           $this->difference = $row['difference'];
           $this->created_at = $row['created_at'];

           $created_at = new DateTime(date('Y-m-d H:i:s', strtotime($this->created_at)));
           $curr_time=new DateTime(date('Y-m-d H:i:s'));
           $this->difference=$created_at->diff($curr_time);
           $this->difference = $this->difference->format('%H');
           echo"<div class='product'>

               <!-- <div class = 'prodImage'> <img src='$this->productImage' alt='$this->productName'> </div>-->
               <div class='prod'>
               <div class = 'prodImage'> <img src='$this->productImage' alt='$this->productName'> </div>
               <div class = 'prodname'>  <p>$this->productName </p></div>
               <div class = 'prodprice'> <p>Ksh $this->productPrice </p></div>
               <div class = 'prodcategory'> <p>Category: $this->category </p></div>
               <div class = 'proddesc'> <p>$this->productDescription</p></div>
               <div class = 'prodlocation'> <p><img class = 'icon' src='../images/location-dot-solid.svg' alt=''>$this->county, $this->subcounty </p></div>
               <div class = 'prodtime'><button onclick='delete_product(".$row['productID'].")' style='background-color:red; color:white; border-radius:5px;'>DELETE</button></div>
               </div>
           </div>";
       }
       echo"</table>";
       echo '</div>';
    }
    public function delete_product($id){
       $query = "DELETE FROM `products` WHERE `productID` = :id";
       $stmt = $this->DB->prepare($query);
       $stmt->execute(array(':id' => $id));
       
    }
    public function add_admin($username,$email,$phone,$pass){
        if(empty($username) || empty($email) || empty($phone) || empty($pass)){
            
            echo "Please enter all fields";
            exit();
        }
        else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            echo "Please enter a valid email";
            exit();
        }
        else{
            $query = "SELECT * FROM `users` WHERE `username`=:username OR `email`=:email OR `phoneNO`=:phone";
            $stmt = $this->DB->prepare($query);
            $stmt->execute(array(':username' => $username, ':email'=>$email,':phone'=>$phone));
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($result)){
               echo "Username or email or phone number already exists";
                exit();
            }
            else{
                $query = "INSERT INTO `users`(`username`,`phoneNO`, `email`, `password`,`user_role`) VALUES (:username, :phone ,:email, :password,:user_role)";
                $stmt = $this->DB->prepare($query);
                $stmt->execute(array(':username' => $username, ':phone'=>$phone,':email' => $email, ':password' => $pass,':user_role'=>'admin'));
                echo "Admin added successfully";
                exit();
            }
        }
        //$query = "INSERT INTO `users`(`username`,`phoneNO`, `email`, `password`,`user_role`) VALUES (:name, :phone ,:email, :password,:user_role)";
        //$stmt = $this->DB->prepare($query);
        //$stmt->execute(array(':name' => $username, ':phone'=>$phone,':email' => $email, ':password' => $pass,':user_role'=>'admin'));
        //echo "Added Successfully";
       
    }
    public function add_article(){
        echo "
        <div class='add_article'>
        <form  class='add_article_form' action='/' method='post' name='form' target='_blank'
        onSubmit='insert_article(this); return false;'enctype='multipart/form-data'>
            <div class='a1'>
            <p>Article Title</p>
            <input type='text' id='title' name='title' placeholder='Article Title'>
            </div>
            <div  class='a1'>
            <p>Article Content</p>
            <textarea id='content' name='content' placeholder='Article Content'  cols='160' rows='20'></textarea>
            </div>
            <div  class='a1'>
            <p>Article Image</p>
            <input type='file' id='image' name='image' placeholder='Article Image'>
            </div>
            <div  class='a1'>
            <p>Author</p>
            <input type='text' id='author' name='author' placeholder='Author'>
            </div>
            <div  class='a1'>
            <p>Date</p>
            <input type='date' id='date' name='date'>
            </div>
            <div  class='a1'>
            <input type='submit' name='submit' value='Add Article'>
            </div>

        </form>
        </div>

        ";

    }
    public function full_article($id){
        $query = "SELECT * FROM `articles` WHERE `id`=:id";
        $stmt = $this->DB->prepare($query);
        $stmt->execute(array(':id' => $id));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $this->articleID = $row['articleID'];
            $this->title = $row['title'];
            $this->content = $row['content'];
            $this->image = $row['imagepath'];
            $this->author = $row['author'];
            $this->date = $row['date'];
            $this->created_at = $row['created_at'];
        }
        echo "
        <div class='full_article'>
        <div class='article_image'>
        <img src='$this->image' alt='$this->title'>
        </div>
        <div class='article_content'>
        <h1>$this->title</h1>
        <pre>$this->content</pre>
        <p>Author:$this->author</p>
        <p>Date:$this->created_at</p>
        </div>
        </div>
        ";
    }
 
}
?>

