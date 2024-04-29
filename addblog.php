<?php include('connect.php') ?>
<?php
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Use prepared statement to prevent SQL injection
    $query3 = "SELECT userID FROM users WHERE username=?";
    $stmt = mysqli_prepare($connect, $query3);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result3 = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result3) > 0) {
        while ($row = mysqli_fetch_assoc($result3)) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $userID = $row['userID'];
                $title = isset($_POST['title']) ? $_POST['title'] : '';
                $content = isset($_POST['content']) ? $_POST['content'] : '';
                date_default_timezone_set('Asia/Karachi');
                $time = date("Y-m-d H:i:s");
                $query = "INSERT INTO blogs (title, content, created_at, userID) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_prepare($connect, $query);
                mysqli_stmt_bind_param($stmt, "sssi", $title, $content, $time, $userID);
                mysqli_stmt_execute($stmt);
            }
        }
    }
} else {
    header("Location: sign-up.php");
    exit; // Ensure that script stops execution after redirection
}
?>
<?php include('header.php') ?>
<form class="m-5" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
    <div class="form-group mb-3">
        <label for="">Title</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Write Blog Title Here!!" name="title">
    </div>
    <div class="form-group mb-3">
        <label for="exampleFormControlSelect1">Categories</label>
        <select class="form-control" id="exampleFormControlSelect1" name='category'>
            <?php
            $query2 = "select title from categories";
            $result2 = mysqli_query($connect, $query2);
            if (mysqli_num_rows($result2)) {
                # code...
                while ($row = mysqli_fetch_assoc($result2)) {
                    # code...
            ?>
                    <option value=""><?php echo $row['title'] ?></option>
            <?php
                }
            }
            ?>
        </select>
    </div>
    <div class="form-group mb-3">
        <label for="exampleFormControlTextarea1">Example textarea</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" name="content"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php include('footer.php') ?>