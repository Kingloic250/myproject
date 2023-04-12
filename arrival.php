<?php
include 'menu.php';
include 'connection.php';
$errors = [];
$success = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $status = $_POST['status'];
    if (!is_numeric($name)) {
        $in = date("h:i:sa");
        $out = date("h:i:sa");
        $date = date('y-m-d');
        $select = "SELECT *FROM employee WHERE fullname = '$name'";
        $query = mysqli_query($connect,$select);
        if (mysqli_num_rows($query) == 1) {
            if ($status == "in") {
                $retreive = "SELECT *FROM attendance WHERE fullname = '$name' AND date='$date' AND time_in IS NOT NULL";
                $check = mysqli_query($connect,$retreive);
                if (mysqli_num_rows($check) > 0) {
                    $errors[] = '<h4>'.$name.' You are timed in for today</h4>';
                }
                else {
                    $lognow = date('H:i:s');
                    $insert = "INSERT INTO attendance (fullname,time_in,date) VALUES ('$name','$in',now())";
                    $sql = mysqli_query($connect,$insert);
                    $success[] ='<h4>'.$name.' has arrived at work at '.$in.'</h4>';
                }
            }
            else {
                $get = "SELECT *, attendance.fullname AS fname FROM attendance LEFT JOIN employee ON employee.fullname=attendance.fullname WHERE attendance.fullname = '$name' AND date = now()";
                $now = mysqli_query($connect,$get);
                if (mysqli_num_rows($now) < 1) {
                    $errors[] = '<h4>'.$name.' Can not Timeout. No Timein.</h4>';
                }
                else {
                    $row = mysqli_fetch_assoc($now);
                    if ($row['time_out'] != '00:00:00') {
                        $errors[] = '<h4>'.$name.' You have timed out for today.</h4>';
                    }
                    else {
                        $update = "UPDATE attendance SET time_out = '$out' WHERE fullname='".$row['fname']."'";
                        if (mysqli_query($connect,$update)) {
                            $sussess[] = '<h4>'.$name.' Departured from work.</h4>';
                        }
                    }
                }
            }
        }
        else {
            $errors[] ='<h4>'.$name.' is not registered in our database.</h4>';
        }
    }
    else {
        $errors[] = '<h4>Names can not be numbers only.</h4>';
    }
}
?>
<title>Attendance | MegaConst</title>
<link rel="stylesheet" href="register1.css">
<div class="dash-content">
    <div class="activity">
        <div class="title">
            <i class="fas fa-clock"></i>
            <span class="text">Arrival & Departure</span>
        </div>
        <div class="activity-data">
            <div class="container">
                <div class="content">
                    <form method="post">
                        <div class="user-details">
                            <div class="input-box">
                                <span class="details">Employee Names</span>
                                <input type="text" name="name" placeholder="Enter your Names" required>
                            </div>
                            <div class="input-box">
                                <span class="details">Arrival/Departure</span>
                                <div class="custom-select" style="width:300px;">
                                    <select class="select-selected" name="status">
                                    <option value="in">Time in</option>
                                    <option value="out">Time out</option>
                                    </select>
                                </div>
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