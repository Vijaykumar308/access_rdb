<?php
    session_start();
    if(!isset($_SESSION['host'])){
        header("Location:index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RDB</title>

    <!--CDN LINKS FOR FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@300;400&family=Roboto:wght@300;400;500&display=swap"  rel="stylesheet">

    <!-- CDN LINKS FOR BOOTSTRAP -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- CDN LINKS FOR SWEET ALERTS -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        html{
            height: 100vh;
        }
        body {
            height: 80vh !important;
        }
        .myContainer{
            max-width: 93%;
            margin: auto;
            height: 75vh;
        }
        #outputHeader{
            position: sticky;
            top: 0;
        }
        .error:empty{
            display:none;
        }
        .error {
            width: 100%;
            background: #ff8213;
            padding: 18px;
            color: #fff;
            font-size: 23px;
            font-weight: 400;
        }
    </style>
</head>

<body>

    <!-- Navbar Start -->
    <nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 left-0 border-b border-gray-200 dark:border-gray-600">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="http://localhost/index.html" class="flex items-center">
            <img src="images/logo.png" class="h-8 mr-3" alt="Flowbite Logo">
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">RDB</span>
        </a>
        <div class="flex md:order-2">
            <a href="logout.php">
                <button type="button" class="text-white bg-orange-400 hover:bg-orange-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 connectionButton">Close Connection with <?php echo $_SESSION['dbname']; ?></button>
            </a>
        </div>
        </div>
    </nav>  
    <!-- Navbar End -->

    <!-- Query Section Starts -->
    <div class="mx-24 sticky top-20">
        <label for="chat" class="sr-only">Your message</label>
        <div class="flex items-center px-3 py-4 rounded-lg bg-red-300 dark:bg-gray-700">
            <p>Type Query</p>
            <textarea id="query" rows="1" class="block mx-8 p-2.5 w-full text-xl  bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="execute query..."
            >Select * from customers</textarea>

            <button type="submit" class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600" id="querySubmitButton">
                <svg aria-hidden="true" class="w-6 h-6 rotate-90" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
            <span class="sr-only">Send message</span>
            </button>
        </div>
    </div>
    <!-- Query Section Ends -->

    <!-- Table Result Section Starts -->
    
    <div class="relative overflow-x-auto mx-20 my-28 myContainer">
        <table class="w-full text-lg text-left text-gray-500 dark:text-gray-400 myTable">
            <div class="error"></div>
            <thead id="outputHeader" class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
               
            </thead>
            <tbody id="outputRows">
              
            </tbody>
        </table>
    </div>

    <!-- Table Result Section Ends -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="query.js?v=3"></script>
</body>
</html>
