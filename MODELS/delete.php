<?php

include_once '../../../config/database.php';


class Delete
{
    public $conn;

    function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function delete_users($ids) {
        try {
            $id_list = implode(',', $ids);
            
            $query = "DELETE FROM users WHERE id IN ($id_list)";
            
            $result = mysqli_query($this->conn, $query);
    
            if ($result) {
                return "success";
            } else {
                return "Error: " . mysqli_error($this->conn);
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    
    
}
?>