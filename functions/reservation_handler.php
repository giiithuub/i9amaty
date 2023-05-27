<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include('../config/dbcon.php');

function createReservation($chamberId, $unvId, $fromDate, $toDate, $totalPrice, $numDays, $userInfo) {
    global $con; // Access your database connection

    // Prepare an SQL statement
    $stmt = $con->prepare("INSERT INTO reservations (chamber_id, unv_id, from_date, to_date, total_price, num_days, user_info) VALUES (?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters to the SQL statement using references
    $userInfoJson = json_encode($userInfo);
    $stmt->bind_param("iisssss", $chamberId, $unvId, $fromDate, $toDate, $totalPrice, $numDays, $userInfoJson);
    
    // Execute the SQL statement
    $stmt->execute();

    // Return true or false based on success
    return $stmt->affected_rows === 1;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract variables from $_POST array
    $chamberId = $_POST['chamber_id'];
    $unvId = $_POST['unv_id'];
    $fromDate = $_POST['start_date'];
    $toDate = $_POST['end_date'];
    $totalPrice = $_POST['total'];
    $numDays = $_POST['num_days'];

    // Extract user information
    $userInfo = [
        'firstName' => $_POST['first_name'],
        'lastName' => $_POST['last_name'],
        'phoneNumber' => $_POST['phone_number'],
        'address' => $_POST['address_line1'],
        'city' => $_POST['city'],
        'state' => $_POST['state'],
        'postcode' => $_POST['postcode']
    ];
    if (checkDuplicateReservation($userInfo['firstName'], $userInfo['lastName'], $fromDate, $toDate)) {
        $_SESSION['message'] = 'You have already made a reservation within this date range!';
        echo "Redirecting...";
        header('Location: ../view-reservation.php');
        exit();
    }

    // Create reservation
    createReservation($chamberId, $unvId, $fromDate, $toDate, $totalPrice, $numDays, $userInfo);
}

function checkDuplicateReservation($firstName, $lastName, $startDate, $endDate) {
    global $con;
    $firstName = mysqli_real_escape_string($con, $firstName);
    $lastName = mysqli_real_escape_string($con, $lastName);
    $startDate = mysqli_real_escape_string($con, $startDate);
    $endDate = mysqli_real_escape_string($con, $endDate);

    $query = "SELECT COUNT(*) AS count FROM reservations WHERE JSON_EXTRACT(user_info, '$.firstName') = '$firstName' AND JSON_EXTRACT(user_info, '$.lastName') = '$lastName' AND ('$startDate' BETWEEN from_date AND to_date OR '$endDate' BETWEEN from_date AND to_date)";
    $result = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($result);

    return $data['count'] > 0;
}


?>
