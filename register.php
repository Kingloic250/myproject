<?php
include 'menu.php';
include 'connection.php';
include 'function.php';
$errors = [];
$success = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $type = $_POST['type'];
    if (!is_numeric($fname) && !is_numeric($email)) {

        $user_id = random_num(20);

        $select = "SELECT *FROM employee WHERE email='$email'";
        $sql = mysqli_query($connect,$select);
        if (mysqli_num_rows($sql) != 1) {
            $retreive = "SELECT *FROM employee WHERE phone = '$phone'";
            $query = mysqli_query($connect,$retreive);
            if (mysqli_num_rows($query) != 1) {
                $insert = "INSERT INTO employee (employee_id,fullname,email,role,phone) VALUES ('$user_id','$fname','$email','$type','$phone')";
                $check = mysqli_query($connect,$insert);
                $success[] = '<h4>✔ '.$fname.' have been registered.</h4>';
            }
            else{
                $errors[] = '<h4>❌ This Phone number have been taken.</h4>';
            }
        }
        else {
            $errors[] = '<h4>❌ This Email have been taken.</h4>';
        }
    }
    else {
        $errors[] = '<h4>❌ Email and Names can not be numeric.</h4>';
    }
}
?>
<title>Register | MegaConst</title>
<link rel="stylesheet" href="register1.css">
<div class="dash-content">
    <div class="activity">
        <div class="title">
            <i class="fas fa-clock"></i>
            <span class="text">Registration Form</span>
        </div>
        <div class="activity-data">
            <div class="container">
                <div class="content">
                    <form method="post">
                        <div class="user-details">
                            <div class="input-box">
                                <span class="details">Full Name</span>
                                <input type="text" name="fname" placeholder="Enter your name" required>
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
                                <span class="details">Select user</span>
                                <div class="custom-select" style="width:300px;">
                                    <select name="type" class="select-selected">
                                    <option >Mason</option>
                                    <option >Manpower</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="button">
                            <input type="submit" value="Register">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="boxx">
            <?php if (!empty($success)): ?>
                <div class="success">
                    <?php foreach ($success as $succes): ?>
                        <?php echo $succes; ?>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
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
    </div>
</div>    
<script src="script.js"></script>