<?php include('connect.php') ?>
<?php include('header.php') ?>
<?php
$update_blog_id = $_GET['blogID'];
$q = "SELECT * FROM blogs WHERE blogID=$update_blog_id";
$result = mysqli_query($connect, $q);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
        <form class="m-5" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <div class="form-group mb-3">
                <label for="">Title</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="<?php echo $row['title'] ?>" name="title">
            </div>
            <div class="form-group mb-3">
                <label for="exampleFormControlSelect1">Categories</label>
                <select class="form-control" id="exampleFormControlSelect1" name='category'>
                    <?php
                    $query2 = "select title from categories";
                    $result2 = mysqli_query($connect, $query2);
                    if (mysqli_num_rows($result2)) {
                        # code...
                        while ($row1 = mysqli_fetch_assoc($result2)) {
                            # code...
                    ?>
                            <option value=""><?php echo $row1['title'] ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="exampleFormControlTextarea1">Example textarea</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" name="content" placeholder="<?php echo $row['content'] ?>"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
<?php
    }
}
?>

<?php
$update_query="UPDATE blogs SET title = '$_POST[title]', content = '$_POST[content]' WHERE blogID = $update_blog_id";
if(mysqli_query($connect, $update_query)){
    echo "Blog Updated";
}else {
    echo "Blog cannot be Updated".mysqli_error($connect);
}
?>
<?php include('footer.php') ?>