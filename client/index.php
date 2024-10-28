<?php
include("connect.php");

$query = "SELECT * FROM posts LEFT JOIN userInfo ON posts.userID = userInfo.userID";
$results = executeQuery(query: $query);
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <div class="row mt-5">
      <div class="col">
        <div class="display-3">
          Feed
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">

        <?php
        if (mysqli_num_rows($results) > 0) {
          while ($post = mysqli_fetch_assoc($results)) {
            ?>

            <div class="card my-5 p-5 shadow">
              <div class="card-body">
                <h5 class="card-title"><?php echo $post['firstName']." ".$post['lastName'] ?></h5>
                <h6 class="card-subtitle text-secondary"><?php echo $post['dateTime'] ?></h6>
              </div>
              <div class="card-body">
                <p class="card-text"><?php echo $post['content'] ?></p>
              </div>
              <div class="card-body">
                <button class="btn btn-primary shadow">Like</button>
                <button class="btn btn-primary shadow">Comment</button>
                <button class="btn btn-primary shadow">Share</button>
              </div>
            </div>

            <?php
          }
        }
        ?>

      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>