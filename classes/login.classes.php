<?php
class Login extends DB{
    private $userName;
    private $passWord;

    public function __construct($Uname, $pass)
    {
        $this->userName = $Uname;
        $this->passWord = $pass;
        
    }
    private function emptyInputs()
    {
        
        if(empty($this->userName)  || empty($this->passWord) ){
            $results = 8;
        }
        else{
            $results = 4; 
        }
        return $results;
    }
    
   
    protected function getUser($userName, $passWord){ 
       
        $query = "SELECT * FROM `users` WHERE `username` = :username AND `password` = :password";
        $stmt = $this->dbConnection()->prepare($query);
        $stmt->execute(array(':username' => $userName, ':password' => $passWord));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
       
       
        if($stmt->rowCount() == 0){

            $results =NULL;
            header("location: login.php?error=usernotfound");
            exit();
        }
     
        else{
            foreach($result as $row){
               
                $user_id = $row['userID'];
                $user_role = $row['user_role'];
            }
           
           session_start();
            $_SESSION['user'] = $userName;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_role'] = $user_role;
           
            if($_SESSION['user_role']=='admin'){
                header("location: admin.php?success=loggedin");
                exit();
          
            }else{
                header("location: index.php?success=loggedin");
                exit();
            }
           
        }
    }
    public function loginUsers()
    {
      
        if($this->emptyInputs() == 8){
           header("location: ../includes/login.php?error=emptyInputs");
           exit();
        }else{
            $this->getUser($this->userName,$this->passWord ); 
        }
        
    }

    


}