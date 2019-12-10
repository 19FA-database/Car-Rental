<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="styles.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title> Search Results </title>

</head>

  <body>
    <div class="topnav">
      <a href="show_rentals.php">Rentals</a>
      <a href="show_cars.php">Cars</a>
      <a href="search_cars.html">Search Cars</a>
      <a href="new_rental.php">New Rental</a>
    </div>

    <h1> Search Results </h1>
    <?php
      $searchtype = $_POST["searchtype"];
      $searchterm = trim($_POST["searchterm"]);

      if (!$searchtype || !$searchterm) {
        echo "You have not entered search details. Please go back and try again.";
        exit;
      }

      @$db = new mysqli('localhost', 'carRental', 'test', 'carRental');

      if ($db->connect_error) {
        die('Connect Error '.$db->connect_errno.": ".$db->connect_error);
      }

      $query = "SELECT * FROM car c JOIN model m WHERE $searchtype LIKE '%$searchterm%' AND c.modelId = m.modelId";
      $result = $db->query($query);

      $num_results = $result->num_rows;
      echo "<p>Number of cars found: $num_results<br/><br/>";

      for ($i=0; $i<$num_results; $i++) {
        $row = $result->fetch_assoc();
        echo "<strong>Make: ";
        echo htmlspecialchars($row["make"]);
        echo "</strong>";
        echo "<br/>";
        echo "Model: ".$row["model"];
        echo "<br/>";
        echo "Year: ".$row["year"];
        echo "<br/>";
        echo "Mileage: ".$row["mileage"];
        echo "<br/>";
        echo "Price: $".$row["price"];
        echo "</p>";
      }

      $result->free();
      $db->close();
    ?>

</main>
  </body>
</html>
