<?php 
include("db.php");

if (isset($_POST['car_name'])) {
//    echo "RECIEVED";
$car_name = $_POST['car_name'];
$query = "INSERT INTO cars(title) VALUES('$car_name')";
$query_car_name = mysqli_query($connect, $query);

header("Location: index.html");

if (!$query_car_name) {
    die("QUERY FAILED");
}

}

?>