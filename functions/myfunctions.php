<?php
include(__DIR__ . '/../config/dbcon.php');
// Report all PHP errors
error_reporting(E_ALL);

// Display all errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


function getAllActive($table, $active = null)
{
    global $con;
    $query = "SELECT * FROM $table WHERE status='0' ";
    if ($active !== null) {
        $query .= "AND active$active='$active'";
    }
   
    return $query_run = mysqli_query($con, $query);
}


function getAll($table)
{
    global $con;
    $query = "SELECT * FROM $table";

    return $query_run = mysqli_query($con, $query);
}

function getByID($table, $id)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id='$id' ";

    $query_run = mysqli_query($con, $query);

    return mysqli_fetch_assoc($query_run);
}


function getSlugActive($table, $slug)
{
    global $con;
    $query = "SELECT * FROM $table WHERE slug='$slug' LIMIT 1";

    return $query_run = mysqli_query($con, $query);
}

function getChambersByUniversityStay($unv_id) {
    global $con;
    $query = "SELECT * FROM chambers WHERE unv_id='$unv_id'";

    return $query_run = mysqli_query($con, $query);
}


function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header('Location: '.$url);
    exit();
}

function getCategory($categoryId) {
    global $con;

    $result = mysqli_query($con, "SELECT * FROM categories WHERE id = $categoryId");
    return mysqli_fetch_assoc($result);
}

function getProfitCategories()
{   
    global $con;
    $query = "SELECT * FROM categories WHERE is_profit = 1";
    $result = mysqli_query($con, $query);
    return $result;
}

function getNonProfitCategories()
{   
    global $con;
    $query = "SELECT * FROM categories WHERE is_profit = 0";
    $result = mysqli_query($con, $query);
    return $result;
}




function saveMessage($name, $email, $subject, $message) {
    global $con;
    // Sanitize the input
    $name = mysqli_real_escape_string($con, $name);
    $email = mysqli_real_escape_string($con, $email);
    $subject = mysqli_real_escape_string($con, $subject);
    $message = mysqli_real_escape_string($con, $message);
    
    // Prepare the SQL statement
    $sql = "INSERT INTO contact (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

    // Execute the query
    $result = mysqli_query($con, $sql);
    if ($result) {
        return true;
    } else {
        return false;
    }
}

function getChamberDates($id)
{
    global $con;
    // Prepare the SQL statement
    $query = "SELECT available_date_to, available_date_from FROM chambers WHERE id=? LIMIT 1";

    // Create a prepared statement
    $stmt = $con->prepare($query);

    // Check if the prepared statement is not false
    if ($stmt === false) {
        return false;
    }

    // Bind parameters
    $stmt->bind_param('i', $id); // 'i' indicates integer

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch data
    $data = $result->fetch_assoc();

    // Free result and close statement
    $result->free();
    $stmt->close();

    return $data;
}

function getChamberReservations($userId) {
    global $con;
    $userId = mysqli_real_escape_string($con, $userId);

    $query = "SELECT * FROM reservations WHERE user_id = '$userId'";
    $result = mysqli_query($con, $query);

    $reservations = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $reservations[] = $row;
    }

    return $reservations;
}


function getUserById($userId) {
    global $con;
    $userId = mysqli_real_escape_string($con, $userId);

    $query = "SELECT * FROM users WHERE id = '$userId' LIMIT 1";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    return $row;
}

function getChamberById($chamberId) {
    global $con;
    $chamberId = mysqli_real_escape_string($con, $chamberId);

    $query = "SELECT * FROM chambers WHERE id = '$chamberId' LIMIT 1";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    return $row;
}

?>
