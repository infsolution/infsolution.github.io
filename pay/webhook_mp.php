<?php
require_once("../env/getenv.php");

$env = new GetEnv();

$content = trim(file_get_contents("php://input"));
$post = json_decode($content);
if($post){
    $conn = mysqli_connect($_ENV["DB_HOST"], $_ENV["DB_USER"], $_ENV["DB_PASSWORD"], $_ENV["DB_NAME"], $_ENV["DB_PORT"], null);
    if (mysqli_connect_error()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
      }else{
        $text = json_encode($post);
        $sql = "INSERT INTO payment_logs (data_value) VALUES ('$text')";
        if (mysqli_query($conn, $sql)) {
        echo "Log save.";
        }else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
      }
      mysqli_close($conn);
}
