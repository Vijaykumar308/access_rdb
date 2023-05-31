<?php
    function get_db($server, $user, $pass, $db){
        try {
           return mysqli_connect($server,$user,$pass,$db);
        }
        catch(Exception $e) {
            return "connection failed";
        }
    }

    function pre($arr) {
        echo "<pre>"; print_r($arr); echo "</pre>";
    }

 
    function check_sql_syntax($conn, $query) {
        try {
            $res = mysqli_query($conn,$query);
            $response['message'] = "query executed successfully";
            $response['result'] = $res;
        } 
        catch (mysqli_sql_exception $e) {
            $response['message'] = $e->getMessage();
        }
        return $response;
    }
    
?>