<?php
    include "../dbconn.php";
    $conn = get_db("localhost","root","", "crudapp");
    $res = mysqli_query($conn,"select id, name,age from customers");

    while($row = mysqli_fetch_assoc($res)){
        echo $row['id']." ";
        echo $row['name']." ";
        echo $row['age']."<br>";
    }

    $res = mysqli_query($conn, "update customers set age = '25' where id = '2'");
    echo mysqli_affected_rows($conn);





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