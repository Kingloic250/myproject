<?php
session_start();
include 'connection.php';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uname = $_POST['uname'];
    $password = $_POST['password'];
    $_SESSION['uname'] = $uname;
    if (!empty($uname) && !empty($password)) {
        $select = "SELECT *FROM admin WHERE username = '$uname'";
        $sql = mysqli_query($connect,$select);
        if (mysqli_num_rows($sql) == 1) {
            $user_data = mysqli_fetch_assoc($sql);
            if ($user_data['password'] == $password) {
              $_SESSION['user_id'] = $user_data['user_id'];
               echo '<script>alert("Welcome Please.");window.location=\'index.php\';</script>';
            }
            else{
                $errors[] = '<h4>Wrong Password.<h4>';
            }
        }
        else{
            $errors[] = '<h4>Wrong Username.<h4>';
        }
    }
    else{
        $errors[] = '<h4>Fields are empty.<h4>';
    }
}


?>
<!DOCTYPE html>
<!-- Designined by CodingLab - youtube.com/codinglabyt -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Registration Form | MegaConst </title>
    <link rel="stylesheet" href="login.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <div class="title">Sign In</div>
    <div class="content">
      <form action="#" method="POST">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" name="uname" placeholder="Enter your username" required>
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" name="password" placeholder="Enter your password" required>
          </div>
        </div>
        <p>Don't have an account yet ? <a href="sign.php">Register</a></p>
        <div class="button">
          <input type="submit" value="Sign in">
        </div>
        <div class="boxx">
    <?php if (!empty($errors)): ?>
        <div class="danger">
            <?php foreach ($errors as $error): ?>
                <?php echo $error; ?>
            <?php endforeach ?>
        </div>
    <?php endif ?>
</div>
      </form>
    </div>
    
  </div>
</body>
</html>
