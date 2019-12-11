<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="styles.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title> Add Customer </title>

</head>

  <body>
    <div class="topnav">
      <a href="show_rentals.php">Rentals</a>
      <a href="show_cars.php">Cars</a>
      <a href="search_cars.html">Search Cars</a>
      <a href="new_rental.php">New Rental</a>
      <a class="active" href="new_customer.html">New Customer</a>
      <a href="show_customer.php">Customers</a>
    </div>

    <?php
      $name = $_POST["name"];
      $email = $_POST["email"];
      $address = $_POST["address"];

      if (!$name || !$email || !$address) {
          echo "You have not entered all required details.  Please go back and try again.";
          exit;
      }

      @$db = new mysqli('localhost', 'carRental', 'test', 'carRental');

      if ($db->connect_error) {
          die('Connect Error ' . $db->connect_errno . ': ' . $db->connect_error);
      }

      $query = "INSERT INTO customer VALUES (NULL, ?, ?, ?)";
      $stmt = $db->prepare($query);
      $stmt->bind_param("sss", $name, $address, $email);
      $stmt->execute();
      echo $stmt->affected_rows." customer inserted into database";

      $db->close();
    ?>
    <br/><a href="show_customer.php">Show Customers</a>

</main>
  </body>
</html>
