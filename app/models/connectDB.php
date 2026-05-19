<?php
class ConnectDB{
    public static function Connect(){
        $server="localhost";
        $user="root";
        $password="";
        $db="qlsv";

        $conn = new mysqli($server, $user, $password, $db);
        if ($conn->connect_error){
            die("Loi ket noi:".$conn->connect_error);
        }
        echo "Ket noi thanh cong";
        return $conn;
    }
}
?>