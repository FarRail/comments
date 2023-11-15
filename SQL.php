<link rel="stylesheet" href="backend/style.css">
<?php
include_once "header.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <style>
        h2 {
            display: block;
            justify-content: center;
            margin: auto;
        }
    </style>
    <link rel="stylesheet" href="backend/style.css">
</head>
<body>
    <div class="welcome">
        <?php
        if (isset($_SESSION["useruid"])) {
            echo '<h1 class="welcome">Hello, ' , $_SESSION["useruid"] , '!</h1>';
        }
        ?>
    </div>
    <h1>Title</h1>
    <p>comment</p>
    <div>    
        <h2>sub categories</h2>
        <section class="Ielm">
            <div>
                <h3>sub cat 1</h3>
            </div>
            <div>
                <h3>sub cat 2</h3>
            </div>
            <div>
                <h3>sub cat 3</h3>
            </div>
            <div>
                <h3>sub cat 4</h3>
            </div>
        </section>
    </div>
    <!-- <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "farreldb";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            ?> -->
</body>

</html>