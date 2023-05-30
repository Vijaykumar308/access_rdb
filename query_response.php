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
        $conn = get_db($server,$username,$password,$dbname);

        $_SESSION['host']     = $server;
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['dbname']   = $dbname;
        print_r($conn);
    }

    if($status === "run query") {   
        $sqlQuery = $v->query;
        $conn = get_db($_SESSION['host'],$_SESSION['username'], $_SESSION['password'],$_SESSION['dbname']);

        $isValid = check_sql_syntax($conn, $sqlQuery); 
        
        $queryResult = array();
        $response = array();

        if($isValid['message'] !== 'query executed successfully'){
            $response['status'] = "failed";
            $response['error'] = $isValid['message'];
            echo json_encode($response);
            exit;
        }
        else{
            $res = mysqli_query($conn, $sqlQuery);
            $affected_rows = mysqli_affected_rows($conn); // affected rows not working;
            if(is_object($res)) {
                while($row = mysqli_fetch_assoc($res)){
                    $queryResult[] = $row;
                }
                $header = col_header($queryResult[0]);

                array_push($response, $header);
                array_push($response, $queryResult);
                $response['status'] = "success";
                echo json_encode($response);

            }else { 
                echo json_encode(["msg" => "update rows ".$affected_rows, "status" => 'other operations']);
            }
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