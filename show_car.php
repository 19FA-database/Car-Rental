<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Car Update</title>
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
        <h1> Car Details </h1>
        <?php
        @$carNo = $_GET["carNo"];
        if (!$carNo) {
          echo "<p>Error!</p>";
          exit;
        }

        @$db = new mysqli('localhost', 'carRental', 'test', 'carRental');
        if ($db->connect_error) {
          die("Connect Error".$db->connect_errno.": ".$db->connect_error);
        }

        $carNo = intval($carNo);

        $query = "SELECT * FROM car WHERE carNo = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("i", $carNo);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result) {
          $row = $result->fetch_assoc();
          $modelId = $row["modelId"];
          $mileage = $row["mileage"];
          $licensePlate = $row["licensePlate"];
          $price = $row["price"];
        }
        ?>

        <form action="update_car.php" method="post">
            <p>Model Number <input type="text" name="modelId" maxlength="5" size="15" value=<?php echo "'".$modelId."'"; ?> readonly/></p>
            <p>Car Number <input type="text" name="carNo" maxlength="5" size="15" value=<?php echo "'".$carNo."'"; ?> readonly/></p>
            <p>Mileage <input type="text" name="mileage" maxlength="13" size="30" value=<?php echo "'".$mileage."'"; ?> /></p>
            <p>License Plate <input type="text" name="licensePlate" maxlength="30" size="30" value=<?php echo "'".$licensePlate."'"; ?> /></p>
            <p>Price $<input type="text" name="price" maxlength="7" size="7" value=<?php echo "'".$price."'"; ?> /></p>

            <input type="submit" name="submit" value="Update Car" />
        </form>
    </main>
</body>

</html>
