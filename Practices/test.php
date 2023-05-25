<?php
    include "dbconn.php";
    try {
        $conn = get_db("localhost","root","", "crudapp");
        $res = mysqli_query($conn,"select id, name, from customers");
        $response['message'] = "query executed successfully";
    } catch (mysqli_sql_exception $e) {
        $response['message'] = $e->getMessage();
    }

    pre($response['message']);
?>