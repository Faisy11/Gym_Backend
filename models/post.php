<?php

include_once '../../../config/database.php';


class Post
{
    public $conn;

    function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function insert_users($name, $age, $gender, $joinDate, $city, $contactNumber, $duration, $trainer, $paymentMode, $profile,$Amount,$exDate)
    {
        $query = "INSERT INTO `users`(`Name`, `Age`, `Gender`, `JoinDate`, `City`, `contactNumber`, `Duration`, `Trainer`, `PaymentMode`, `Profile`,`Amount`,`ExDate`) 
              VALUES ('$name', '$age', '$gender', '$joinDate', '$city', '$contactNumber', '$duration', '$trainer', '$paymentMode', '$profile','$Amount','$exDate')";
        $result = mysqli_query($this->conn, $query);
        return "success";
    }

    public function insert_payment($name, $profile, $amount, $date) {
        $query = "INSERT INTO `paymenthistory`(`Name`, `Amount`, `Date`, `Profile`) VALUES ('$name','$amount','$date','$profile')";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
?>