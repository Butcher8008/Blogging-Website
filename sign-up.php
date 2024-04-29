<?php include('connect.php') ?>
<?php include('header.php') ?>
<div>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
                                    <form class="mx-1 mx-md-4" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <input type="text" id="form3Example1c" class="form-control" name="username" />
                                                <label class="form-label" for="form3Example1c">Your Name</label>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <input type="email" id="form3Example3c" class="form-control" name="email" />
                                                <label class="form-label" for="form3Example3c">Your Email</label>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <input type="password" id="form3Example4c" class="form-control" name="password" />
                                                <label class="form-label" for="form3Example4c">Password</label>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <input type="password" id="form3Example4cd" class="form-control" name="repeated-password" />
                                                <label class="form-label" for="form3Example4cd">Repeat your password</label>
                                            </div>
                                        </div>
                                        <div class="form-check d-flex justify-content-center mb-5">
                                            <!-- <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" /> -->
                                            <label class="form-check-label" for="form2Example3">
                                                Already have an account ?<a href="login.php">Login</a>
                                            </label>
                                        </div>
                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" class="btn btn-primary" id="sign-up-button">
                                                Sign Up
                                            </button>
                                            <!-- <button type="button"  id="sign-up-button" onclick="OpenModel" class="btn btn-primary btn-lg">Register</button> -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
$username = $email = $password = $repeated_password = '';
if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    # code...
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeated_password = $_POST['repeated-password'];
    date_default_timezone_set('Asia/Karachi');
    $time = date("Y-m-d H:i:s");
    if ($repeated_password != $password || empty($email) || empty($username) || empty($password) || empty($repeated_password)) {
        # code...
        die('Fill all the Field!!');
    } else {
        $query = $connect->prepare("INSERT INTO users (username, email,password,time) VALUES(?,?,?,?)");
        $query->bind_param('ssss', $username, $email, $password, $time);
        if ($query->execute()) {
            # code...
            echo "<h1>User have Successfully sign up</> <br>";
            echo "<a href='login.php' >Now Go to login page to login</>";
        } else {
            die("Sign Up failed");
        }
    }
}
?>
<?php include('footer.php') ?>