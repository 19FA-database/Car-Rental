<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="styles.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<title>Customers</title>
</head>
<body>
  <div class="topnav">
    <a href="show_rentals.php">Rentals</a>
    <a href="show_cars.php">Cars</a>
    <a href="search_cars.html">Search Cars</a>
    <a href="new_rental.php">New Rental</a>
    <a href="new_customer.html">New Customer</a>
    <a class="active" href="show_customer.php">Customers</a>
  </div>

    <main role="main" class="container-fluid">
        <h1>Customers</h1>
<?php
    @$db = new mysqli('localhost', 'carRental', 'test', 'carRental');

    if ($db->connect_error) {
        die('Connect Error ' . $db->connect_errno . ': ' . $db->connect_error);
    }

    $query="SELECT * FROM customer";

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
                $customerId = $row[$i];
              }
              echo "<td>".$row[$i]."</td>";
            }
            echo "<td><a href='delete_customer.php?customerId=$customerId'>Delete</a></td>";
            echo "</tr>";
        }

        $result->close();
        echo "</table>";
    }

    $db->close();

?>

<form action="new_customer.html">
  <button type="submit" class="btn btn-primary"> New Customer </button>
</form>

</main>
</body>
</html>
