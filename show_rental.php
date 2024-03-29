<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Rental Update</title>
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
        <h1> Rental Details </h1>
        <?php
        @$rentalId = $_GET["rentalId"];
        if (!$rentalId) {
          echo "<p>Error!</p>";
          exit;
        }

        @$db = new mysqli('localhost', 'carRental', 'test', 'carRental');
        if ($db->connect_error) {
          die("Connect Error".$db->connect_errno.": ".$db->connect_error);
        }

        $rentalId = intval($rentalId);

        $query = "SELECT * FROM rental WHERE rentalId = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("i", $rentalId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result) {
          $row = $result->fetch_assoc();
          $rentalId = $row["rentalId"];
          $carNo = $row["carNo"];
          $start = $row["dateRented"];
          $end = $row["dateReturn"];
          $customerId = $row["customerId"];
        }
        ?>

        <form action="update_rental.php" method="post">
            <p>Rental ID <input type="text" name="rentalId" maxlength="5" size="15" value=<?php echo "'".$rentalId."'"; ?> readonly/></p>
            <p>Start Date <input type="date" name="start" maxlength="13" size="30" value=<?php echo "'".$start."'"; ?> /></p>
            <p>End Date <input type="date" name="end" maxlength="30" size="30" value=<?php echo "'".$end."'"; ?> /></p>

            <label for="type">Customer</label>
            <select class="form-control" id="customerId" name="customerId">
              <?php
              @$db = new mysqli('localhost', 'carRental', 'test', 'carRental');
              if ($db->connect_error) {
                  die('Connect Error ' . $db->connect_errno . ': ' . $db->connect_error);
              }
              $query="SELECT * FROM customer";
              $result = $db->query($query);
              $num_results = $result->num_rows;

              for ($i=0; $i<$num_results; $i++) {
                $row = $result->fetch_assoc();
                if ($row["customerId"] == $customerId) {
                  echo "<option value=".$row["customerId"]." selected>".$row["name"]."</option>";
                } else {
                  echo "<option value=".$row["customerId"].">".$row["name"]."</option>";
                }
              }
              $result->free();
              $db->close();
              ?>
            </select>

            <label for="type">Select Car</label>
            <select class="form-control" id="carNo" name="carNo">
              <?php
              @$db = new mysqli('localhost', 'carRental', 'test', 'carRental');
              if ($db->connect_error) {
                  die('Connect Error ' . $db->connect_errno . ': ' . $db->connect_error);
              }
              $query="SELECT * FROM car c, model m WHERE c.modelId = m.modelId";
              $result = $db->query($query);
              $num_results = $result->num_rows;

              for ($i=0; $i<$num_results; $i++) {
                $row = $result->fetch_assoc();
                if ($row["carNo"] == $carNo) {
                  echo "<option value=".$row["carNo"]." selected>".$row["make"]." ".$row["model"]."</option>";
                } else {
                  echo "<option value=".$row["carNo"].">".$row["make"]." ".$row["model"]."</option>";
                }
              }
              $result->free();
              $db->close();
              ?>
            </select>
            <br/>

            <input type="submit" name="submit" value="Update Car" class="btn btn-primary" />
        </form>
    </main>
</body>

</html>
