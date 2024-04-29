<?php include('connect.php') ?>
<?php
$query = 'SELECT * FROM blogs';
$result = mysqli_query($connect, $query);
// echo $_SESSION['username'];
?>
<?php include('header.php') ?>
<div class="row mx-3">
    <?php
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
    ?>

            <?php
            $userid = $row['userID'];
            $query2 = "SELECT username FROM users WHERE userID=$userid";
            $result2 = mysqli_query($connect, $query2);
            if (mysqli_num_rows($result2) > 0) {
                while ($row2 = mysqli_fetch_assoc($result2)) {
            ?>
                    <div class="col-md-4">
                        <div class="card mt-5">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['title'] ?></h5>
                                <p class="card-text line-clamp"><?php echo $row['content'] ?></p>
                                <a href="full_blog.php?blogID=<?php echo $row['blogID'] ?>" class="card-link">View Full Blog</a>
                                <?php
                                if (isset($_SESSION['username'])) {
                                    # code...
                                    if ($_SESSION['username'] == $row2['username']) {
                                        try {
                                    ?>
                                            <a href="deleted.php?blogID=<?php echo $row['blogID'] ?>" class="card-link">Delete</a>
                                            <a href="update.php?blogID=<?php echo $row['blogID'] ?>" class="card-link">Update</a>
                                        <?php
    
                                        } catch (\Throwable $th) {
                                            echo $th;
                                        }
                                        ?>
                                    <?php
                                    }
                                }else {
                                    ?>
                                    <a href="login.php" class="mx-3">Login</a>
                                    <?php
                                }
                                    ?>
                                <h6 class="mt-2"><?php echo " Writen By: " . $row2['username'] ?></h6>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>

    <?php
        }
    }
    ?>
</div>
<?php include('footer.php') ?>