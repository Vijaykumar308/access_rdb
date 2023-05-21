<?php
    /**
     * Query will execute here and then send response;
     * TYPE: POST
     * Params: query, conn object
    */
    require_once('dbconn.php');

    session_start();
    $v = json_decode(file_get_contents("php://input"));
    $status = $v->status;

    if($status === "create connection") {
        $server = $v->host;
        $username = $v->username;
        $password = $v->password;
        $dbname = $v->dbname;

        $_SESSION['host']     = $server;
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['dbname']   = $dbname;


        $conn = get_db($server,$username,$password,$dbname);

        print_r($conn);
    }

    if($status === "run query") {   
        $sqlQuery = $v->query;
        // $isValidQuery = check_sql_syntax($sqlQuery);

        // if(!$isValidQuery) {
        //     echo "please check query syntax"; 
        //     exit;
        // }

        $conn = get_db($_SESSION['host'],$_SESSION['username'], $_SESSION['password'],$_SESSION['dbname']);

        $res = mysqli_query($conn, $sqlQuery);
        
        $queryResult = array();
        $response = array();
        if(is_object($res)) {
            while($row = mysqli_fetch_assoc($res)){
                $queryResult[] = $row;
            }
            $header = col_header($queryResult[0]);

            array_push($response, $header);
            array_push($response, $queryResult);

            echo json_encode($response);

        }else{
            echo "there is some error in query";
        }
    }

    function col_header($data){
        $header = array();
        foreach($data as $key => $val){
            array_push($header,$key);
        } 
        return $header;
    }
?>