<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	  <title>Update Car</title>
</head>

<body>
  <div class="topnav">
    <a href="show_rentals.php">Rentals</a>
    <a href="show_cars.php">Cars</a>
    <a href="search_cars.html">Search Cars</a>
    <a href="new_rental.php">New Rental</a>
  </div>

    <main role="main" class="container-fluid">
	<h1> Car Update Results </h1>
<?php
    $carNo = $_POST["carNo"];
    $modelId = $_POST["modelId"];
    $mileage = $_POST["mileage"];
    $price = $_POST["price"];
    $licensePlate = $_POST["licensePlate"];

    if (!$carNo || !$modelId || !$mileage || !$price || !$licensePlate) {
        echo "You have not entered all required details.  Please go back and try again.";
        exit;
    }

    $carNo = intval($carNo);
    $modelId = intval($modelId);
    $mileage = intval($mileage);
    $price = floatval($price);

    //connect to the database
    @$db = new mysqli('localhost', 'carRental', 'test', 'carRental');


    if ($db->connect_error) {
        die('Connect Error ' . $db->connect_errno . ': ' . $db->connect_error);
    }

    $query = "UPDATE car SET mileage=?, licensePlate=?, price=? WHERE carNo = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("isdi", $mileage, $licensePlate, $price, $carNo);
    $stmt->execute();
    echo $stmt->affected_rows." car updated in database";

    $db->close();
?>
    <br/
    ><a href="show_cars.php">Show Cars</a>
</main>
</body>

</html>
