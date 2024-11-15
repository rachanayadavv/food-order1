<?php include('../config/constants.php'); ?>
<html>

<head>
    <title>Login - FOOD ORDER SYSTEM</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br><br>

        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if(isset($_SESSION['no-login-message']))
        {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        ?>
        <br><br>

        <!--Login form starts here -->
        <form action="" method="POST" class="text-center">
            Username:<br>
            <input type="text" id="username" name="username" placeholder="Enter Username"><br><br>

            Password:<br>
            <input type="password" id="password" name="password" placeholder="Enter Password"><br><br>
            <input type="submit" id="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
        </form>
        <!--Login form ends here -->

        <p class="text-center">Created by - <a href="https://www.linkedin.com/in/rachana-yadav-5b056b217/">Rachana Yadav</a></p>
    </div>
</body>

</html>

<?php
// Check whether the submit button is clicked or not
if (isset($_POST['submit'])) {
    // Process for login
    // 1. Get the data from login form
    // $username = $_POST['username'];
    $username =mysqli_real_escape_string($conn,$_POST['username']); 

    // $password = md5($_POST['password']);

    $raw_password = md5($_POST['password']);
    $password=mysqli_real_escape_string($conn,$raw_password);


    // 2. SQL to check whether the user with username and password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    // // 3. Execute the query
    $res = mysqli_query($conn, $sql);

    // 4. count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        // User available and login success
        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
        $_SESSION['user'] = $username; //to check whether the user is logged in or not and logout will unset it

        // Redirect to home page/dashboard
        header('location:' . SITEURL . 'admin/');
    } else {
        // User not available and login fail
        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
        // Redirect to login page
        header('location:' . SITEURL . 'admin/login.php');
    }
    
}
?>