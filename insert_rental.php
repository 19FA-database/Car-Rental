<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="styles.css">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<title>Rental Entry Results</title>


</head>

<body>
  <div class="topnav">
    <a href="show_rentals.php">Rentals</a>
    <a href="show_cars.php">Cars</a>
    <a href="search_cars.html">Search Cars</a>
    <a href="new_rental.php">New Rental</a>
    <a href="new_customer.html">New Customer</a>
    <a href="show_customer.php">Customers</a>
  </div>

    <main role="main" class="container-fluid">
	<h1> Rental Entry Results </h1>
<?php
    $carNo=$_POST["carNo"];
    $customerId=$_POST["customerId"];
    $start=$_POST["start"];
    $end=$_POST["end"];

    if (!$carNo || !$customerId || !$start || !$end) {
        echo "You have not entered all required details.  Please go back and try again.";
        exit;
    }

    $carNo = intval($carNo);
    $customerId = intval($customerId);

    @$db = new mysqli('localhost', 'carRental', 'test', 'carRental');

    if ($db->connect_error) {
        die('Connect Error ' . $db->connect_errno . ': ' . $db->connect_error);
    }

    $query = "INSERT INTO rental VALUES (NULL, ?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ssii", $start, $end, $carNo, $customerId);
    $stmt->execute();
    echo $stmt->affected_rows." rental inserted into database";

    $db->close();
?>
    <br/
    ><a href="show_rentals.php">Show Rentals</a>
</main>
</body>

</html>
