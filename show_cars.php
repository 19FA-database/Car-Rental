<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="styles.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<title>Cars</title>
</head>
<body>
  <div class="topnav">
    <a href="show_rentals.php">Rentals</a>
    <a class="active" href="show_cars.php">Cars</a>
    <a href="search_cars.html">Search Cars</a>
    <a href="new_rental.php">New Rental</a>
  </div>

    <main role="main" class="container-fluid">
        <h1>Available Cars</h1>
<?php
    @ $db = new mysqli('localhost', 'carRental', 'test', 'carRental');


    if ($db->connect_error) {
        die('Connect Error ' . $db->connect_errno . ': ' . $db->connect_error);
    }

    $query="SELECT c.carNo, m.make, m.model, m.year, c.mileage, c.price, c.licensePlate FROM car c JOIN model m WHERE c.modelId = m.modelId ORDER BY c.carNo";

    if ($result = $db->query($query)) {

        $num_results = $result->num_rows;
        $num_fields = $result->field_count;

        echo "<table class='table table-responsive'>";
        echo "<tr>";

        $dbinfo = $result->fetch_fields();


        foreach ($dbinfo as $val) {
            echo "<th>".ucwords($val->name)."</th>";
        }

        echo "</tr>";

        while ($row = $result->fetch_row()) {
            echo "<tr>";
            for ($i=0; $i<$num_fields; $i++) {
              if ($i == 0) {
                $carNo = $row[$i];
                echo "<td><a href='show_car.php?carNo=$carNo'>$carNo</a></td>";
              } else {
                echo "<td>".$row[$i]."</td>";
              }
            }
            echo "<td><a href='delete_car.php?carNo=$carNo'>Delete</a></td>";
            echo "</tr>";
        }

        $result->close();
        echo "</table>";
    }

    $db->close();

?>

</main>
</body>
</html>
