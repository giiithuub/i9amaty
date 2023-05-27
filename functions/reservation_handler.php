<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ob_start(); // Start output buffering

session_start();
include('../config/dbcon.php');

function createReservation($chamberId, $unvId, $fromDate, $toDate, $totalPrice, $numDays, $userInfo, $userId) {
    global $con; 

    $stmt = $con->prepare(
        "INSERT INTO reservations (
            chamber_id, unv_id, from_date, to_date, total_price, num_days, 
            first_name, last_name, phone_number, address, city, state, postcode, user_id
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param(
        "iisssssssssssi", 
        $chamberId, $unvId, $fromDate, $toDate, $totalPrice, $numDays, 
        $userInfo['firstName'], $userInfo['lastName'], $userInfo['phoneNumber'], 
        $userInfo['address'], $userInfo['city'], $userInfo['state'], $userInfo['postcode'], $userId);
    
    $stmt->execute();

    return $stmt->affected_rows === 1;
}

function checkDuplicateReservation($firstName, $lastName, $startDate, $endDate) {
    global $con;
    $firstName = mysqli_real_escape_string($con, $firstName);
    $lastName = mysqli_real_escape_string($con, $lastName);
    $startDate = mysqli_real_escape_string($con, $startDate);
    $endDate = mysqli_real_escape_string($con, $endDate);

    $query = "SELECT COUNT(*) AS count FROM reservations WHERE first_name = '$firstName' AND last_name = '$lastName' AND ('$startDate' BETWEEN from_date AND to_date OR '$endDate' BETWEEN from_date AND to_date)";
    $result = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($result);

    return $data['count'] > 0;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract variables from $_POST array
    $chamberId = $_POST['chamber_id'];
    $unvId = $_POST['unv_id'];
    $fromDate = $_POST['start_date'];
    $toDate = $_POST['end_date'];
    $totalPrice = $_POST['total'];
    $numDays = $_POST['num_days'];
      $userId = $_COOKIE['user_id']; // Retrieving user_id from cookie
    // Retrieving user_id from cookie

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
        header('Location: ../view-reservation.php');
        exit();
    }

    // Create reservation
    $reservationCreated = createReservation($chamberId, $unvId, $fromDate, $toDate, $totalPrice, $numDays, $userInfo, $userId);
    if($reservationCreated){
        $_SESSION['message'] = 'Reservation created successfully!';
        header('Location: ../view-reservation.php'); // redirect to the desired page
    } else {
        $_SESSION['message'] = 'There was a problem creating the reservation.';
        header('Location: ../reservation-form.php'); // redirect back to the form page
    }
    exit();
}

ob_end_flush(); // End output buffering
?>
