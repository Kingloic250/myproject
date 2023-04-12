<?php
include 'connection.php';
include 'menu.php';
$errors = [];
$success = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $amount = $_POST['money'];
    if (!empty($amount)) {
        if (is_numeric($amount)) {
            $select = "SELECT *FROM employee WHERE employee_id = '$id'";
            $sql = mysqli_query($connect,$select);
            if (mysqli_num_rows($sql) == 1) {
                $user_data = mysqli_fetch_assoc($sql);
                $_SESSION['fname'] = $user_data['fullname'];
                if ($user_data['role'] == 'Manpower') {
                    $money = 5000;
                    if ($amount == $money) {
                        $insert = "INSERT INTO employee_payroll (employee_id,amount) VALUES ('$id','$amount')";
                        $query = mysqli_query($connect,$insert);
                        $success[] = '<h4> You have successfuly paid '.$_SESSION['fname'].'.</h4>';
                    }
                    else {
                        $errors[] = '<h4>'. $_SESSION['fname'].' can not be paid above or below 5,000FRW.</h4>';
                    }
                }
                else {
                    $money_mason = 10000;
                    if ($amount == $money_mason) {
                        $insert = "INSERT INTO employee_payroll (employee_id,amount) VALUES ('$id','$amount')";
                        $query = mysqli_query($connect,$insert);
                        $success[] = '<h4> You have successfuly paid '.$_SESSION['fname'].'.</h4>';
                    }
                    else {
                        $errors[] = '<h4>'.$_SESSION['fname'].' can not be paid above or below 10,000FRW.</h4>';
                    }
                }
            }
            else {
                $errors[] = '<h4>Invalid Names.</h4>';
            }
        }
        else {
            $errors[] = '<h4>Money have to be numeric.</h4>';
        }
    }
    else {
        $errors[] = 'Amount can not be empty.';
    }
}
?>


<title>Manage Accounts | MegaConst</title>
<link rel="stylesheet" href="register1.css">
<div class="dash-content">
    <div class="activity">
        <div class="title">
            <i class="fas fa-clock"></i>
            <span class="text">Employee Payment</span>
        </div>
        <div class="activity-data">
            <div class="container">
                <div class="content">
                    <form method="post">
                        <div class="user-details">
                            <div class="input-box">
                                <span class="details">Select Employee Names</span>
                                <div class="custom-select" style="width:300px;">
                                    <select class="select-selected" name="id">
                                    <?php
                                        $get = "SELECT employee_id,fullname FROM employee";
                                        $check = mysqli_query($connect,$get);
                                        while ($fetch = mysqli_fetch_assoc($check)) {
                                            echo "<option value ='".$fetch['employee_id']."'>".$fetch['fullname']."</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                            </div>
                            <div class="input-box">
                                <span class="details">Enter Ammount</span>
                                <input type="text" name="money" placeholder="Enter Amount" required>
                            </div>
                        </div>
                        <div class="button">
                            <input type="submit" value="Continue">
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