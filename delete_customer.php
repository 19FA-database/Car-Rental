<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="styles.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<title>Delete Customer</title>
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
      <?php
        @$customerId = $_GET["customerId"];
        if (!$customerId) {
          echo "Error";
          exit;
        }

        @$mysql = new mysqli('localhost', 'carRental', 'test', 'carRental');
        if ($mysql->connect_error) {
          die("Connect Error");
        }

        $query = "DELETE FROM customer WHERE customerId = ?";
        $stmt = $mysql->prepare($query);
        $stmt->bind_param("i", $customerId);
        $stmt->execute();
        if ($stmt->affected_rows == 1) {
          echo "Customer Deleted";
        }

      ?>
      <br/><a href="show_customer.php">Show Customers</a>
    </main>
</body>
</html>
