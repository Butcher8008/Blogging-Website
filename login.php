<?php include('connect.php');
// session_start();
?>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE username=? AND password=?";
    $stmt = $connect->prepare($query);

    if ($stmt) {
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {

            echo "Login successful!";
            $_SESSION['username']=$username;
            header("Location: index.php");
            exit();
        } else {
            $loginError= "Login failed. Invalid username or password.";
        }
        $stmt->close();
    } else {
        $loginError= "Failed to prepare the statement.";
    }
}
?>


<?php include('header.php') ?>

<div class="container" id="login-container">
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                    <ul class="nav nav-pills nav-justified mb-5" id="ex1" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="tab-login" data-mdb-pill-init href="" role="tab" aria-controls="pills-login" aria-selected="true">Login</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active mx-2" id="tab-register" data-mdb-pill-init href="sign-up.php" role="tab" aria-controls="pills-register" aria-selected="true">Register</a>
                                        </li>
                                    </ul>
                                    <form class="mx-1 mx-md-4 mt-8" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <input type="text" id="form3Example1c" class="form-control" name="username" />
                                                <label class="form-label" for="form3Example1c">Your Name</label>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <input type="password" id="form3Example4c" class="form-control" name="password" />
                                                <label class="form-label" for="form3Example4c">Password</label>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" class="btn btn-primary" data-mdb-button-init data-mdb-ripple-init data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                Login
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
if (isset($loginError)) {
    # code...
    echo $loginError;
}
?>
<? include('footer.php') ?>