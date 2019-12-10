<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>New Rental</title>
</head>

<body>
  <div class="topnav">
    <a href="show_rentals.php">Rentals</a>
    <a href="show_cars.php">Cars</a>
    <a href="search_cars.html">Search Cars</a>
    <a class="active" href="new_rental.php">New Rental</a>
  </div>

    <main role="main" class="container-fluid">
        <h1>  New Rental </h1>

        <form action="insert_rental.php" method="post">
            <div class="form-group">
              <label for="type">Select Customer</label>
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
                  echo "<option value=".$row["customerId"].">".$row["name"]."</option>";
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
                  echo "<option value=".$row["carNo"].">".$row["make"]." ".$row["model"]."</option>";
                }

                $result->free();
                $db->close();
                ?>
              </select>

              <label for="type">Start Date</label><br/>
              <input type="date" id="start" name="start" value="2019-12-10"> <br/>

              <label for="type">End Date</label><br/>
              <input type="date" id="end" name="end" value="2019-12-25"><br/>

            </div>

            <input type="submit" name="submit" value="Add Rental" class="btn btn-primary" />
        </form>
    </main>
</body>

</html>
