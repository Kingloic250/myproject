<?php
include 'connection.php';
include 'function.php';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = $_POST['fname'];
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $type = $_POST['type'];
    $gender = $_POST['gender'];
    

    if (!empty($phone) && !empty($uname) && !empty($fname) && !empty($password) && !empty($email) && !empty($confirm) && !empty($type) && !empty($gender)) {
        //save to database
        $user_id = random_num(20);

        if (is_numeric($fname)) {
            $errors[] = '<h4>Your fullname can not be numeric.</h4>';
        }
        elseif (is_numeric($uname)) {
            $errors[] = '<h4>Your username can not be numeric.</h4>';
        }
        elseif (strlen($phone) != 10){
            $errors[] = '<h4>Your Phone number can not be under or above 10 numbers.</h4>';
        }
        else {
            if ($password == $confirm) {
                if (strlen($password) >= 4) {
                    $select = "SELECT *FROM admin WHERE email = '$email'";
                    $sql = mysqli_query($connect, $select);
                    if ( mysqli_num_rows($sql) > 0) {
                        $errors[] = '<h4>The email you are trying to use already exist.</h4>';
                    }
                    else {
                        $check = "SELECT *FROM admin WHERE username = '$uname'";
                        $set = mysqli_query($connect, $check);
                        if ( mysqli_num_rows($set) > 0) {
                            $errors[] = '<h4>The username you are trying to use have been taken.</h4>';
                        }
                        else {
                            $image = $_FILES['image']['name'];
                            $size = $_FILES['image']['size'];
                            $tmp = $_FILES['image']['tmp_name'];
                            $error = $_FILES['image']['error'];

                            if ($error === 0) {
                                # code...
                                if ($size > 12500000) {
                                    $em = "Sorry, your file is too large.";
                                    header("location:insert.php?error=$em");
                                } else {
                                    $img_ex = pathinfo($image, PATHINFO_EXTENSION);
                                    $img_ex_lc = strtolower($img_ex);
                                    $allowed_exs = array("jpg", "jpeg", "png");
                                    if (in_array($img_ex_lc, $allowed_exs)) {
                                        $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                                        $img_upload_path = 'new_upload/' . $new_img_name;
                                        move_uploaded_file($tmp, $img_upload_path);
                                        $insert = "INSERT INTO admin (user_id,fullname,username,email,phone,password,type,img,gender) VALUES ('$user_id','$fname','$uname','$email',
                                                    '$phone','$password','$type','$new_img_name','$gender')";
                                        $sql = mysqli_query($connect, $insert) or die("Error");
                                        echo '<script>alert("Thanks for Signing up.");window.location=\'login.php\';</script>';
                                    } else {
                                        $em = "You can't upload file of this type";
                                        header("location:sign.php?error=$em");
                                    }
                                }
                            } 
                            else {
                              $em = "unknown error occurred!";
                              header("location:sign.php?error=$em");
                            }
                        }
                    }
                }
                else {
                    $errors[] = '<h4>Your Password must have 4 minimum characters.</h4>';
                }
            }
            else {
                $errors[] = '<h4>Password not matching.</h4>';
            }
        }
    }
    else{
        $errors[] = '<h4>Field can not be empty.</h4>';
    }
}

?>

<!DOCTYPE html>
<!-- Designined by CodingLab - youtube.com/codinglabyt -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Registration Form | MegaConst </title>
    <link rel="stylesheet" href="style1.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
<div class="boxx">
    <?php if (!empty($errors)): ?>
        <div class="danger">
            <?php foreach ($errors as $error): ?>
                <?php echo $error; ?>
            <?php endforeach ?>
        </div>
    <?php endif ?>
</div>
  <div class="container">
    <div class="title">Registration</div>
    <p>Already have an account ? <a href="login.php">Sign In</a></p>
    <div class="content">
      <form method="POST" enctype="multipart/form-data">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Full Name</span>
            <input type="text" name="fname" placeholder="Enter your name" required>
          </div>
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" name="uname" placeholder="Enter your username" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" name="email" placeholder="Enter your email" required>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" name="phone" placeholder="Enter your number" required>
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" name="password" placeholder="Enter your password" required>
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="password" name="confirm" placeholder="Confirm your password" required>
          </div>
          <div class="input-box">
              <span class="details">Select user</span>
              <div class="custom-select" style="width:300px;">
                <select name="type" class="select-selected">
                  <option >Manager</option>
                  <option >Supervisor</option>
                </select>
              </div>
          </div>
          <div class="input-box">
            <span class="details">Choose Image</span>
            <input type="file" name="image" required>
          </div>
        </div>
        <div class="gender-details">
          <input type="radio" name="gender" value="1" id="dot-1">
          <input type="radio" name="gender" value="2" id="dot-2">
          <input type="radio" name="gender" value="3" id="dot-3">
          <span class="gender-title">Gender</span>
          <div class="category">
            <label for="dot-1">
            <span class="dot one"></span>
            <span class="gender">Male</span>
          </label>
          <label for="dot-2">
            <span class="dot two"></span>
            <span class="gender">Female</span>
          </label>
          <label for="dot-3">
            <span class="dot three"></span>
            <span class="gender">Prefer not to say</span>
            </label>
          </div>
        </div>
        <div class="button">
          <input type="submit" value="Register">
        </div>
      </form>
    </div>
  </div>

</body>
</html>
