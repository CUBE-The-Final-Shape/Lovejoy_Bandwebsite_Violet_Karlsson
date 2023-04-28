<?php
session_start();
require('components/connect.php');

include('components/head.php');
include('components/navbar.php');

if(isset($_SESSION['username'])){
  $username = $_SESSION['username'];
  $auth = $_SESSION['auth'];
}

echo"<div class='p-5'>
    <h1>Lovejoy Forums</h1><hr>
    </div>";

    if (isset($_SESSION['username'])) {
    // Display "Add Post" button
    echo '<a href="add_post.php" class="btn btn-primary mb-3">Add Post</a>';
}

    $sql = "SELECT posts.postID, posts.title, posts.content, accounts.username FROM posts JOIN accounts ON posts.userID = accounts.id"; // Modify the query to join the "posts" and "users" tables
    $result = $connection->query($sql);

    // Display the posts
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Create a clickable div for each post that redirects to the post.php page with the postID parameter
            echo "<a href='post.php?postID=". $row["postID"] ."' style='text-decoration: none; color: black;'>";
            echo "<div class='post'>";
            echo "<h2>" . $row["title"] . "</h2>";
            echo "<p>" . $row["content"] . "</p>";
            echo "<p>Author: " . $row["username"] . "</p>"; // Display the author's username
            echo "</div>";
            echo "</a>";
        }
    } else {
        echo "0 results";
    }


echo"
  <div class='footer'>
    <footer class='py-3 footer'>
      <ul class='nav justify-content-center border-bottom pb-3 mb-3'>
        <li class='nav-item'><a href='Index.php#' class='nav-link px-2 text-muted'>Index</a></li>
        <li class='nav-item'><a href='Index.php#albums' class='nav-link px-2 text-muted'>Music</a></li>
        <li class='nav-item'><a href='Index.php#about' class='nav-link px-2 text-muted'>This is Lovejoy</a></li>
        <li class='nav-item'><a href='Index.php#concerts' class='nav-link px-2 text-muted'>Concerts</a></li>
      </ul>
    <span class='mb-3 ms-5 mb-md-0 text-muted'>© 2023 Violet Karlsson</span>
  </div>
</footer>
</div>
</body>
</html> ";

?>
