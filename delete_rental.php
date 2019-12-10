<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="styles.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<title>Delete Rental</title>
</head>
<body>
  <div class="topnav">
    <a href="show_rentals.php">Rentals</a>
    <a href="show_cars.php">Cars</a>
    <a href="search_cars.html">Search Cars</a>
    <a href="new_rental.php">New Rental</a>
  </div>

    <main role="main" class="container-fluid">
      <?php
        @$rentalId = $_GET["rentalId"];
        if (!$rentalId) {
          echo "Error";
          exit;
        }

        @$mysql = new mysqli('localhost', 'carRental', 'test', 'carRental');
        if ($mysql->connect_error) {
          die("Connect Error");
        }

        $query = "DELETE FROM rental WHERE rentalId = ?";
        $stmt = $mysql->prepare($query);
        $stmt->bind_param("i", $rentalId);
        $stmt->execute();
        if ($stmt->affected_rows == 1) {
          echo "Rental Deleted";
        }

      ?>
      <br/
      ><a href="show_rentals.php">Show Rentals</a>
    </main>
</body>
</html>
