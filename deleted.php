<?php include('connect.php')?>
<?php include('header.php')?>
<?php
$blogid=$_GET['blogID'];
echo htmlspecialchars($_SERVER['PHP_SELF']);
$q = "DELETE FROM blogs WHERE blogID=$blogid";
if (mysqli_query($connect, $q)) {
    # code...
    echo "Query Deleted";
}
// $Delete_result=mysqli_query($connect, $q); 
header("Location: index.php");                               
?>
<?php include('footer.php')?>