<?php
include 'menu.php';
include 'connection.php';
$select = "SELECT *FROM employee JOIN attendance ON (employee.fullname = attendance.fullname)";
$sql = mysqli_query($connect,$select);
?>
<title>Attendance | MegaConst</title>
<link rel="stylesheet" href="employee.css">
<link rel="stylesheet" href="register1.css">
<div class="dash-content">
    <div class="activity">
        <div class="title">
            <i class="fas fa-clock"></i>
            <span class="text">Attendance List</span>
        </div>
    </div>
    <form action="" method="post">
    <div class="activity-data">
                    <table width="100%">
                        <tr >
                            <th class="data-title">Employee ID</th>
                            <th class="data-title">Fullname</th>
                            <th class="data-title">Phone Number</th>
                            <th class="data-title">Time In</th>
                            <th class="data-title">Status</th>
                        </tr>
                        <?php
                            while ($fetch = mysqli_fetch_assoc($sql)) {
                                echo "<tr>";
                                echo "<td align='center'>".$fetch['employee_id']."</td>";
                                echo "<td align='center'>".$fetch['fullname']."</td>";
                                echo "<td align='center'>+".$fetch['phone']."</td>";
                                echo "<td align='center'>".$fetch['time_in']."</td>";
                                
                                echo "<td align='center'>
                                    <input type='checkbox'>
                                    <span class='checkmark'></span></td>";
                                echo "</tr>";
                            }
                        ?>
                    </table>
                    <div class="button">
                        <input type="submit" value="Continue">
                    </div>
                </div>
                </form>
</div>
<script src="script.js"></script>
<style>
    body.dark{
    --primary-color: #9b59b6;
    --panel-color: #242526;
    --text-color: #CCC;
    --black-light-color: #CCC;
    --border-color: #4D4C4C;
    --toggle-color: #FFF;
    --box1-color: #3A3B3C;
    --box2-color: #3A3B3C;
    --box3-color: #3A3B3C;
    --title-icon-color: #CCC;
}
    .containe {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        margin-left: 90px;
        cursor: pointer;
        font-size: 22px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
    .containe input[type='checkbox'] {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        border-radius: 5px;
        background-color: var(--text-color);
    }
    .containe:hover input[type='checkbox'] ~ .checkmark {
        background-color: #ccc;
    }
    .containe input[type='checkbox']:checked ~ .checkmark {
        background-color: #2196F3;
    }
    .containe input[type='checkbox']:checked::after{
        content: "";
        position: absolute;
        display: none;
    }
    .checkmark::after {
        content: "";
        position: absolute;
        display: none;
    }
    .containe input[type='checkbox']:checked ~ .checkmark::after {
        display: block;
    }
    .containe .checkmark::after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
}   
</style>
