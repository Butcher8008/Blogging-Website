<?php include('connect.php') ?>
<?php include('header.php') ?>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    # code...
    $blogid = $_GET['blogID'];
    $query = "select * from blogs where blogID=$blogid";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 0) {
        # code...
        while ($row = mysqli_fetch_assoc($result)) {
            $userid = $row['userID'];
            $query2 = "select * from users where userID = $userid";
            $result2 = mysqli_query($connect, $query2);
            if (mysqli_num_rows($result2) > 0) {
                # code...
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    # code...
?>
                    <div class="mt-5 mx-5 ">
                        <h2><?php echo $row['title'] ?></h2>
                        <p class="mt-3"><?php echo $row['content'] ?></p>
                        <?php
                        if (isset($_SESSION['username'])) {
                            # code...
                            if ($_SESSION['username'] == $row2['username']) {
                                # code...
                        ?>
                                <a href="deleted.php?blogID=<?php echo $blogid ?>" class="card-link" >Delete</a>
                                <a href="update.php?blogID=<?php echo $blogid ?>" class="card-link mx-3" onclick="">Update</a>
                        <?php
                            }
                        }
                        ?>
                    </div>
            <?php
                }
            }
            ?>
<?php
        }
    }
}
?>

<?php include('footer.php') ?>