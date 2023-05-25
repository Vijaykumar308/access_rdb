<?php
    include "../dbconn.php";
    $conn = get_db("localhost","root","", "crudapp");
    $res = mysqli_query($conn,"select id, name from customers");

    while($row = mysqli_fetch_assoc($res)){
        echo $row['id']." ";
        echo $row['name']."<br>";
    }

    $res = mysqli_query($conn,"delete FROM customers WHERE id in ('102','103')");
    var_dump($res);





    // ====== 1. Help Full Code ======
    // try {
    //     $conn = get_db("localhost","root","", "crudapp");
    //     $res = mysqli_query($conn,"select id, name, from customers");
    //     $response['message'] = "query executed successfully";
    // } catch (mysqli_sql_exception $e) {
    //     $response['message'] = $e->getMessage();
    // }
    // pre($response['message']);
     // ====== 1. Help Full Code ======

?>