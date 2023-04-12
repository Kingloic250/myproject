<?php
include 'menu.php';
include 'connection.php';
error_reporting(0);
$success = [];
$select = "SELECT *FROM employee";
$sql = mysqli_query($connect,$select);
?>
<title>Employees | MegaConst</title>
<div class="dash-content">
    <div class="activity">
        <div class="title">
            <i class="fas fa-clock"></i>
            <span class="text">List of Employees</span>
        </div>
    </div>
        <div class="activity-data">
                    <table width="100%">
                        <tr >
                            <th class="data-title">Names</th>
                            <th class="data-title">Email</th>
                            <th class="data-title">Phone Number</th>
                            <th class="data-title">Employee Role</th>
                            <th class="data-title">Date Joined</th>
                            <th class="data-title" colspan="2">Action</th>
                        </tr>
                        <?php
                            while ($fetch = mysqli_fetch_assoc($sql)) {
                                echo "<tr>";
                                echo "<td align='center'>".$fetch['fullname']."</td>";
                                echo "<td align='center'>".$fetch['email']."</td>";
                                echo "<td align='center'>+".$fetch['phone']."</td>";
                                echo "<td align='center'>".$fetch['role']."</td>";
                                echo "<td align='center'>".$fetch['date']."</td>";
                                echo "<td align='center'><a href='update.php?id=$fetch[employee_id]'><i class='fas fa-edit'></i></a></td>";
                                echo "<td align='center'><a href='delete.php?id=$fetch[employee_id]'><i class='fas fa-trash'></i></a></td>";
                                echo "</tr>";
                            }
                        ?>
                    </table>
                </div>
            </div>
<script src="script.js"></script>
<link rel="stylesheet" href="employee.css">

