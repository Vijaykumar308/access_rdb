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

 
    function check_sql_syntax($query,) {
        // Create a new mysqli object
        $mysqli = new mysqli("localhost", "username", "password", "database");
    
        // Check if the connection was successful
        if ($mysqli->connect_error) {
        echo "Error connecting to MySQL: " . $mysqli->connect_error;
        exit();
        }
    
        // Prepare the query
        $stmt = $mysqli->prepare($query);
    
        // Execute the query
        if ($stmt->execute()) {
        // The query was successful
        return true;
        } else {
        // The query failed
        return false;
        }
    
        // Close the connection
        $mysqli->close();
    }
    
?>