<?php

include_once '../../../config/database.php';


class Put
{
  public $conn;

  function __construct()
  {
    $db = new Database();
    $this->conn = $db->connect();
  }


  public function update_admin($password, $email)
  {
    $query = "SELECT * FROM admin WHERE Email='$email'";
    $result = mysqli_query($this->conn, $query);
    if (mysqli_num_rows($result) == 1) {
      $query = "UPDATE admin SET Password ='$password' WHERE Email ='$email'";
      $result = mysqli_query($this->conn, $query);
      if ($result) {
        return true;
      } else {
        return false;
      }
    }else{
      return 0;
    }
  }

  public function update_renewal($id, $renewalDate, $Amount) 
  {
    $query = "SELECT * FROM users WHERE id='$id'";
    $result = mysqli_query($this->conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row['ExDate'] < $renewalDate) {
        $userName = $row['Name'];
        $userProfile = $row['Profile'];
        $update = "UPDATE users SET ExDate ='$renewalDate' WHERE id ='$id'";
        $updateResult = mysqli_query($this->conn, $update);
        if ($updateResult) {
            $insert = "INSERT INTO `paymenthistory`(`Name`, `Amount`, `Date`, `Profile`) VALUES ('$userName','$Amount',NOW(),'$userProfile')";
            $insertResult = mysqli_query($this->conn, $insert);
            if ($insertResult) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
        
    } else {
        return 0;
    }
  }

  public function Edit_Profile($id,$name,$contactNumber,$city,$gender){
    $put="UPDATE users SET Name ='$name',contactNumber='$contactNumber',city='$city',Gender='$gender' WHERE id='$id'";
    $updateResult = mysqli_query($this->conn, $put);

    if($updateResult){
      return true;
    }else{
      return false;
    }

  }

  public function update_otp() {
    $current_time = date("H:i:s");
    $otp = mt_rand(1000, 9999);

    $select = "SELECT * FROM admin LIMIT 1"; 
    $selectQuery = mysqli_query($this->conn, $select);
    $row = mysqli_fetch_assoc($selectQuery);
    $email = $row['Email'];

    $query = "UPDATE `otp` SET `otp`='$otp', `time`='$current_time' WHERE 1";
    $result = mysqli_query($this->conn, $query);
    
    if ($result) {
        $mailed = mail($email, "Your OTP", "Your OTP is: $otp");
        if ($mailed) {
            return true;
        } else {
          return false;
        }
    } else {
        return false;
    }
}



}
?>