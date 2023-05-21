<?php
    session_start();
    require_once("dbconn.php");
    $_SESSION['msg'] = 'connection successfully';
    /***
     * Create Connection API
     * TYPE: POST
     * Params: server, username, password, dbname 
     * 
    */
    $v = json_decode(file_get_contents("php://input"));

    // $server = $v->host;
    // $username = $v->username;
    // $password = $v->password;
    // $dbname = $v->dbname;

    // $conn =  get_db($server,$username,$password,$dbname);
    // $_SESSION['conn'] = $conn;

    // print_r($conn);
?>