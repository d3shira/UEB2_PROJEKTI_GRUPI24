<?php
require_once "../database.php";

$sql = "SELECT u.user_id, u.first_name, u.last_name, u.username, u.email, u.date_time
        FROM tbl_users u
        INNER JOIN tbl_client_profiles cp ON u.user_id = cp.user_id";

// Execute the query
$res = mysqli_query($conn, $sql);

if ($res) {
    $html = "";
    $sn = 1;

    while ($rows = mysqli_fetch_assoc($res)) {
        $id = $rows['user_id'];
        $first_name = $rows['first_name'];
        $last_name = $rows['last_name'];
        $username = $rows['username'];
        $email = $rows['email'];
        $date_time = $rows['date_time'];

        $html .= '<tr>';
        $html .= '<td>' . $sn++ . '</td>';
        $html .= '<td>' . $id . '</td>';
        $html .= '<td>' . $first_name . '</td>';
        $html .= '<td>' . $last_name . '</td>';
        $html .= '<td>' . $username . '</td>';
        $html .= '<td>' . $email . '</td>';
        $html .= '<td>' . $date_time . '</td>';
        $html .= '<td>';
        $html .= '<a class="update-button" href="http://localhost/UEB2_PROJEKTI/admin/update-client.php?user_id=' . $id . '">Update Client</a>';
        $html .= '<a class="delete-button" href="http://localhost/UEB2_PROJEKTI/admin/delete-client.php?user_id=' . $id . '">Delete Client</a>';
        $html .= '</td>';
        $html .= '</tr>';
    }

    echo $html;
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
