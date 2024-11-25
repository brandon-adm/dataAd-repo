<?php
include("connect.php");

if (isset($_POST['submit'])) {
  $userID = $_POST['userID'];
  $content = $_POST['content'];

  $query = "INSERT INTO posts (userID, content, dateTime) 
            SELECT '$userID', '$content', NOW() 
            FROM userInfo 
            WHERE userInfo.userID = '$userID'";
  executeQuery(query: $query);
}

if (isset($_GET['deleteID'])) {
  $deleteID = $_GET['deleteID'];
  $deleteQuery = "DELETE FROM posts WHERE postID = '$deleteID'";
  executeQuery(query: $deleteQuery);
}

if (isset($_POST['update'])) {
  $postID = $_POST['postID'];
  $updatedContent = $_POST['updatedContent'];

  $updateQuery = "UPDATE posts SET content = '$updatedContent' WHERE postID = '$postID'";
  executeQuery(query: $updateQuery);
}

$query = "SELECT * FROM posts LEFT JOIN userInfo ON posts.userID = userInfo.userID";
$results = executeQuery(query: $query);

$editID = isset($_GET['editID']) ? $_GET['editID'] : null;
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Post Chuchu</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container">
    <div class="row mt-5">
      <div class="col mb-3">
        <div class="display-3">Feed</div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <form method="POST" action="">
          <div class="mb-3">
            <input type="text" name="userID" class="form-control" placeholder="Enter user ID" required>
          </div>
          <div class="mb-3">
            <input type="text" name="content" class="form-control" placeholder="Make a new post..." required>
          </div>
          <button type="submit" name="submit" class="btn btn-primary">Post</button>
        </form>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <?php
        if (mysqli_num_rows($results) > 0) {
          while ($post = mysqli_fetch_assoc($results)) {
            ?>
            <div class="card my-5 p-5 shadow-sm">
              <div class="card-body">
                <h5 class="card-title"><?php echo $post['firstName'] . " " . $post['lastName']; ?></h5>
                <h6 class="card-subtitle text-secondary"><?php echo $post['dateTime']; ?></h6>
              </div>
              <div class="card-body">
                <?php
                if ($editID == $post['postID']) { ?>
                  <form method="POST" action="">
                    <input type="hidden" name="postID" value="<?php echo $post['postID']; ?>">
                    <div class="mb-3">
                      <textarea name="updatedContent" class="form-control" required><?php echo $post['content']; ?></textarea>
                    </div>
                    <button type="submit" name="update" class="btn btn-success">Save</button>
                    <a href="?" class="btn btn-secondary">Cancel</a>
                  </form>
                <?php } else { ?>
                  <p class="card-text"><?php echo $post['content']; ?></p>
                  <a href="?editID=<?php echo $post['postID']; ?>" class="btn btn-secondary shadow-sm">Edit</a>
                <?php } ?>
              </div>
              <div class="card-body">
                <button class="btn btn-primary shadow-sm">Like</button>
                <button class="btn btn-primary shadow-sm">Comment</button>
                <button class="btn btn-primary shadow-sm">Share</button>
                <a href="?deleteID=<?php echo $post['postID']; ?>" class="btn btn-danger shadow-sm">Delete</a>
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
    crossorigin="anonymous"></script>
</body>

</html>