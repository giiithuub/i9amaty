<?php
include(__DIR__ . '/../config/dbcon.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function getReservationsForUser($userId) {
    global $con;
    $userId = mysqli_real_escape_string($con, $userId); // sanitize user input
    $query = "SELECT * FROM reservations WHERE user_id = '$userId'";
    $result = mysqli_query($con, $query);
    $reservations = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $reservations;
}

function getTripById($tripId) {
    global $con;
    $tripId = mysqli_real_escape_string($con, $tripId); // sanitize user input
    $query = "SELECT * FROM trips WHERE id = '$tripId'";
    $result = mysqli_query($con, $query);
    $trip = mysqli_fetch_assoc($result);
    return $trip;
}

function getUserById($userId) {
    global $con;
    $userId = mysqli_real_escape_string($con, $userId); // sanitize user input
    $query = "SELECT * FROM users WHERE user_id = '$userId'";
    $result = mysqli_query($con, $query);
    $user = mysqli_fetch_assoc($result);
    return $user;
}

function acceptReservation($reservationId) {
    global $con;
    $reservationId = mysqli_real_escape_string($con, $reservationId);
    $query = "UPDATE reservations SET status = 'accepted' WHERE id = '$reservationId'";
    $result = mysqli_query($con, $query);
    return $result;
}

function declineReservation($reservationId) {
    global $con;
    $reservationId = mysqli_real_escape_string($con, $reservationId);
    $query = "UPDATE reservations SET status = 'declined' WHERE id = '$reservationId'";
    $result = mysqli_query($con, $query);
    return $result;
}
function getAllReservations() {
    global $con;
    $query = "SELECT * FROM reservations";
    $result = mysqli_query($con, $query);
    return $result; // returning mysqli_result, not array
}

function getAllMessages() {
    global $con;
    $query = "SELECT * FROM contact";
    $result = mysqli_query($con, $query);
    return $result; // returning mysqli_result, not array
}


function countAcceptedReservationsForTrip($tripId) {
    global $con;
    $tripId = mysqli_real_escape_string($con, $tripId); // sanitize user input
    $query = "SELECT COUNT(*) as count FROM reservations WHERE trip_id = '$tripId' AND status = 'Confirmed'";
    $result = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($result);
    return $data['count'];
}

function checkIfUserReservedForTrip($tripId, $userId, $name) {
    global $con;
    $tripId = mysqli_real_escape_string($con, $tripId);
    $userId = mysqli_real_escape_string($con, $userId);
    $name = mysqli_real_escape_string($con, $name);
    $query = "SELECT COUNT(*) as count FROM reservations WHERE trip_id = '$tripId' AND user_id = '$userId' AND name = '$name' ";
    $result = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($result);
    return $data['count'] > 0;
}

if (isset($_POST['reserve_button'])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $user_id = $_POST["user_id"];
    $trip_id = $_POST["trip_id"];

    // Check if the user already reserved for this trip under the same name
    if (checkIfUserReservedForTrip($trip_id, $user_id, $name)) {
        $_SESSION['message'] = 'You have already reserved for this trip under this name!';
        header('Location: ../view-reservation.php');
        exit();
    }

    // Get the trip details
    $trip = getTripById($trip_id);

    // Check the number of accepted reservations for this trip
    $acceptedReservations = countAcceptedReservationsForTrip($trip_id);

    if ($acceptedReservations >= $trip['max_participants']) {
        $_SESSION['message'] = 'No places left for this trip!';
        header('Location: ../view-reservation.php');
        exit();
    }

    // Insert the new reservation
    $query = "INSERT INTO reservations (name, email, phone, trip_id, user_id, status) VALUES ('$name', '$email', '$phone', '$trip_id', '$user_id', 'Pending')";
    $result = mysqli_query($con, $query);

    if ($result) {
        $_SESSION['message'] = 'Reservation made successfully!';
        header('Location: ../view-reservation.php');
    } else {
        $_SESSION['message'] = 'Error making reservation!';
        header('Location: ../view-reservation.php');
    }
}
?>




