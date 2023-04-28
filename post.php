<?php
require('components/connect.php');

include('components/head.php');
include('components/navbar.php');

if(isset($_SESSION['username'])){
  $username = $_SESSION['username'];
}

if (isset($_GET['postID'])) {
    $postID = $_GET['postID'];

    // SQL code to select the post with the given ID
    $sql_post = "SELECT posts.postID, posts.title, posts.content, accounts.username FROM posts JOIN accounts ON posts.userID = accounts.id WHERE postID = $postID";

    $result_post = $connection->query($sql_post);

    // Display the post
    if ($result_post->num_rows > 0) {
        $row_post = $result_post->fetch_assoc();
        echo "<div class='p-5'>
            <h1>" . $row_post["title"] . "</h1><hr>
            <p>" . $row_post["content"] . "</p>
            <p>Author: " . $row_post["username"] . "</p>
            </div>";

        // SQL code to select the replies to the post with the given ID
        $sql_replies = "SELECT replies.replyID, replies.postID, accounts.username, replies.content
                        FROM replies
                        JOIN accounts ON replies.userID = accounts.id
                        WHERE replies.postID = $postID";
        $result_replies = $connection->query($sql_replies);

        // Display the replies
        if ($result_replies->num_rows > 0) {
            while($row_reply = $result_replies->fetch_assoc()) {
                echo "<div class='p-3'>
                    <p>" . $row_reply["content"] . "</p>
                    <p>Author: " . $row_reply["username"] . "</p>
                    </div>";
            }
        } else {
            echo "<div class='p-3'>No replies found.</div>";
        }
    } else {
        echo "<div class='p-3'>Post not found.</div>";
    }
} else {
    echo "<div class='p-3'>Invalid post ID.</div>";
}

echo"
  <div class='footer'>
    <footer class='py-3 footer'>
      <ul class='nav justify-content-center border-bottom pb-3 mb-3>
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
</html>";
?>
