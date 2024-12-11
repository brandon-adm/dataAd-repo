<?php
include("connect.php");

$sortOrder = $_GET['ticketPriceSelect'] ?? 'DESC';

$airlineQuery = "SELECT * FROM flightlogs ORDER BY ticketPrice $sortOrder";

$airlineResults = executeQuery($airlineQuery);

$newSortOrder = ($sortOrder == 'ASC') ? 'DESC' : 'ASC';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Flight Log</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="Icon" type="image/png" href="img/PUPLogo.png">
</head>
<style>
body {
  background-color: #fff;
}
</style>



<body>

<nav class="navbar" style="background-color: maroon;">
  <div class="container-fluid text-light">
    <a class="navbar-brand text-light" href="" >
      <img src="img/PUPLogo.png" alt="Logo" width="30" class="d-inline-block align-text-top text-light" >
      PUP Airport
    </a>
  </div>
</nav>

  <div class="container">
    <div class="card p-4 m-4 shadow-lg rounded-4">
      <div class="row">
        <div class="col">
          <h3 class="display-5">Records</h3>
        </div>
      </div>

      <div class="row m-3 justify-content-end">
        <div class="col-auto">
          <div class="d-flex align-items-center">
            <label for="ticketPriceSelect" class="me-2">Sort by Ticket Price</label>
            <form method="GET" class="d-flex">
              <select id="ticketPriceSelect" name="ticketPriceSelect" class="form-control me-4" style="width: auto;">
                <option value="DESC" <?php echo ($sortOrder == 'DESC') ? 'selected' : ''; ?>>Highest to Lowest</option>
                <option value="ASC" <?php echo ($sortOrder == 'ASC') ? 'selected' : ''; ?>>Lowest to Highest</option>
              </select>
              <button type="submit" class="btn btn-primary">Sort</button>
            </form>
          </div>
        </div>
      </div>

      <div class="container my-4">
        <div class="row">
          <div class="col">
            <div class="table-responsive">
              <table class="table table-hover mt-3">
                <thead class="table">
                  <tr>
                    <th scope="col">Flight Number</th>
                    <th scope="col">Airline Name</th>
                    <th scope="col">Airline Type</th>
                    <th scope="col">Passenger Count</th>
                    <th scope="col">Departure Date</th>
                    <th scope="col">Flight Duration</th>
                    <th scope="col">Ticket Price</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (mysqli_num_rows($airlineResults) > 0) {
                    while ($airlineRows = mysqli_fetch_assoc($airlineResults)) {
                      echo "<tr>
                          <td>{$airlineRows['flightNumber']}</td>
                          <td>{$airlineRows['airlineName']}</td>
                          <td>{$airlineRows['aircraftType']}</td>
                          <td>{$airlineRows['passengerCount']}</td>
                          <td>{$airlineRows['departureDatetime']}</td>
                          <td>" . floor($airlineRows['flightDurationMinutes'] / 60) . "h " . ($airlineRows['flightDurationMinutes'] % 60) . "m</td>
                          <td>{$airlineRows['ticketPrice']}</td>
                        </tr>";
                    }
                  } else {
                    echo "<tr><td colspan='7'>No records found</td></tr>";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>