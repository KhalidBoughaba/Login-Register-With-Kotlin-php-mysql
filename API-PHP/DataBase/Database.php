<?php

    class Database{
        private $con;
        public function Connection(){
            $this->con =null;
            try{
                $this->con = new PDO('mysql:host=localhost;dbname=db_kt_loginsignup',"root","");
                $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $this->con;
            }catch(Exception $e){ 
                echo "Connection Erreur ! ".$e->getMessage();
                exit;
            }
        }

        public function Message($success,$status,$message)
        {
            echo json_encode(array(
                'success'=>$success,
                'status'=>$status,
                'message'=>$message
            ));
        }

        public function Login($email,$password)
        {
            $sql='SELECT * FROM users WHERE Email="'.$email.'" AND Password="'.$password.'"';
            $stmt=$this->con->prepare($sql);
            $stmt->execute();
            if($stmt->rowCount()):
                $row=$stmt->fetch(PDO::FETCH_ASSOC);
                    return $row["UserName"];
                // $checkPass=password_verify($password,$row['Password']);

                // if($checkPass):
                //     return $row["UserName"];
                // endif;

            endif;

            return null;
        }

        public function Register($username,$email,$password)
        {   
            $sql='INSERT INTO users (UserName,Email,Password) VALUES("'.$username.'","'.$email.'","'.$password.'");';
            $stmt=$this->con->prepare($sql);
            if($stmt->execute()):
                return true;
            endif;
            echo ''.$stmt->error;
            return false;
        }

        public function SelectedByEmail($email)
        {
            $sql='SELECT * FROM users WHERE Email="'.$email.'"';
            $stmt=$this->con->prepare($sql);
            $stmt->execute();
            if($stmt->rowCount()):
                return true;
            endif;
            return false;
        }
    }
?>