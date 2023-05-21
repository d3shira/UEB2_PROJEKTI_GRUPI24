<?php
require_once "../database.php";

$sql = "SELECT u.user_id, u.first_name, u.last_name, u.username, u.email, sp.profession, u.date_time
        FROM tbl_users u
        INNER JOIN tbl_staff_profiles sp ON u.user_id = sp.user_id";

$res = mysqli_query($conn, $sql);
$staffData = [];

if ($res) {
    if (mysqli_num_rows($res) > 0) {
        while ($rows = mysqli_fetch_assoc($res)) {
            // Get individual data
            $id = $rows['user_id'];
            $first_name = $rows['first_name'];
            $last_name = $rows['last_name'];
            $username = $rows['username'];
            $email = $rows['email'];
            $profession = $rows['profession'];
            $date_time = $rows['date_time'];

            // Add staff data to the array
            $staffData[] = [
                'id' => $id,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'username' => $username,
                'email' => $email,
                'profession' => $profession,
                'date_time' => $date_time
            ];
        }
    }
}

// Send the staff data as JSON response
header('Content-Type: application/json');
echo json_encode($staffData);
?>
