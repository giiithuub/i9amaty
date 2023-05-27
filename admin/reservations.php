<?php   
session_start();
include('../middleware/adminMiddleware.php');
include('includes/header.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
if(isset($_POST['accept_reservation_btn'])) {
    // logic to accept the reservation
    $reservation_id = $_POST['reservation_id'];
    $query = "UPDATE reservations SET status='Confirmed' WHERE id='$reservation_id'";
    if(mysqli_query($con, $query)){
        $_SESSION['message'] = 'Reservation Accepted Successfully!';
    } else {
        $_SESSION['message'] = 'Failed to accept the reservation!';
    }
}

if(isset($_POST['decline_reservation_btn'])) {
    // logic to decline the reservation
    $reservation_id = $_POST['reservation_id'];
    $query = "UPDATE reservations SET status='Cancelled' WHERE id='$reservation_id'";
    if(mysqli_query($con, $query)){
        $_SESSION['message'] = 'Reservation Declined Successfully!';
    } else {
        $_SESSION['message'] = 'Failed to decline the reservation!';
    }
}
if (isset($_POST['delete'])) {
    global $con;
    $reservation_id = $_POST['reservation_id'];
    $sql = "DELETE FROM reservations WHERE id = $reservation_id";
    
    if(mysqli_query($con, $sql)){
        $_SESSION['message'] = 'Reservation Deletred Successfully!';
    } else {
        $_SESSION['message'] = 'Failed to deleted the reservation!';
    }
}


if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']); // Clear the session message
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>All Reservations</h4>
                </div>
                <div class="card-body" id="reservation_table">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr class="table-info">
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Chamber Image</th>
                                <th>From Date</th>
                                <th>To Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $reservations = getAllReservations();

                            if(mysqli_num_rows($reservations) > 0)
                            {
                                while ($reservation = mysqli_fetch_assoc($reservations)) {
                                    // Fetching user details

                                    // Fetching chamber details
                                    $chamber = getChamberById($reservation['chamber_id']);
                                    $images = explode(",", $chamber['images']);
                                    $firstImage = count($images) > 0 ? $images[0] : '';
                                    ?>
                                    <tr>
                                        <td><?= $reservation['id']; ?></td>
                                        <td><?= $reservation['first_name'] . ' ' . $reservation['last_name']; ?></td>
                                        <td>
                                            <img src="<?= $firstImage; ?>" alt="Chamber Image" width="50px" height="50px">
                                        </td>
                                        <td><?= $reservation['from_date']; ?></td>
                                        <td><?= $reservation['to_date']; ?></td>
                                        <td><?= $reservation['status']; ?></td>
                                        <td>
                                            <form action="reservations.php" method="POST">
                                                <input type="hidden" name="reservation_id" value="<?= $reservation['id']; ?>">
                                                <button type="submit" class="btn btn-success btn-sm" name="accept_reservation_btn">Accept</button>
                                                <button type="submit" class="btn btn-warning btn-sm" name="decline_reservation_btn">Decline</button>
                                                <button type="submit" class="btn btn-danger btn-sm" name="delete">Delete</button>
                                            </form> 
                                        </td>
                                    </tr>
                              <?php      
                                }
                            }
                            else
                            {
                                echo "No Record Found";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php');?>
