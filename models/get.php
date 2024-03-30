<?php
// include_once '../../../config/database.php';
include_once '../config/database.php';


class Get
{
    public $conn;
    public $response;

    function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }


    public function select_users()
    {
        $query = "SELECT * FROM users";
        $result = mysqli_query($this->conn, $query);
        $temp = array();
        while ($row = $result->fetch_assoc()) {
            $temp[] = $row;
        }
        return $temp;
    }
    public function admin_login($email, $password)
    {
        $query = "SELECT * FROM admin WHERE Email='$email'";
        $result = mysqli_query($this->conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $stored_password = $row['Password'];

            if ($password === $stored_password) {
                return true;
            } else {
                return false;
            }
        } else {
            return 'No Email Found';
        }
    }

    public function otp_verify($otp)
    {
        $string = $otp;
        $query = "SELECT * FROM otp WHERE otp = '$string'";
        $result = mysqli_query($this->conn, $query);
        
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $otpTime = strtotime($row['time']);
            $currentTime = strtotime("now");
            $fiveMinutesLater = strtotime("+5 minutes", $otpTime); 
    
            if ($currentTime <= $fiveMinutesLater) {
                return true; 
            } else {
                return false; 
            }
        } else {
            return false; 
        }
    }
    
    public function select_payment()
    {
        $query = "SELECT * FROM paymenthistory";
        $result = mysqli_query($this->conn, $query);
        $temp = array();
        while ($row = $result->fetch_assoc()) {
            $temp[] = $row;
        }
        return $temp;
    }

    public function Select_Profie($id)
    {
        $query = "SELECT * FROM users WHERE id='$id'";
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);

        return $row;
    }

    public function select_email()
    {
        $query = "SELECT * From admin";
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);

        return $row['Email'];
    }

    public function download_users($ids)
    {
        $sanitized_ids = implode(',', array_map('intval', $ids));
        $query = "SELECT * FROM users WHERE id IN ($sanitized_ids)";
        $result = mysqli_query($this->conn, $query);
        if (!$result) {
            return false;
        }
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
    
        return $rows;
    }
    
    


}
?>