<?php

session_start();

include('functions/myfunctions.php');
include('includes/header.php');
include('config/dbcon.php');

if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']); // Clear the session message
}
if (isset($_POST['cancel'])) {
    global $con;
    $reservation_id = $_POST['reservation_id'];
    $sql = "DELETE FROM reservations WHERE id = $reservation_id";
    mysqli_query($con, $sql);
}

?>

<div class="py-3 bg-dark">
    <div class="container">
        <a href="index.php" class="text-white" style="text-decoration:none">Home / </a><a href="view_reservation.php" class="text-white" style="text-decoration:none">Reservation</a>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="card card-body shadow">
            <div class="row">
                <div class="col-md-12">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <h6>User</h6>
                        </div>
                        <div class="col-md-2">
                            <h6>Chamber Name</h6>
                        </div>
                        <div class="col-md-2">
                            <h6>From Date</h6>
                        </div>
                        <div class="col-md-2">
                            <h6>To Date</h6>
                        </div>
                        <div class="col-md-2">
                            <h6>Total Price</h6>
                        </div>
                        <div class="col-md-2">
                            <h6>Cancel Reservation</h6>
                        </div>
                    </div>
                </div>

                <?php 
                $reservations = getChamberReservations($_COOKIE['user_id']);
                foreach ($reservations as $reservation) {
                    $user = getUserById($reservation['user_id']);
                    $chamber = getChamberById($reservation['chamber_id']);
                ?>

                    <div class="card product-data border-success mb-3">
                        <form action="" method="post" class="row align-items-center">
                            <div class="col-md-2">
                                <h5><?= $user['name'] ?></h5>
                            </div>
                            <div class="col-md-2">
                                <h5><?= $chamber['name'] ?></h5>
                            </div>
                            <div class="col-md-2">
                                <h5><?= $reservation['from_date'] ?></h5>
                            </div>
                            <div class="col-md-2">
                                <h5><?= $reservation['to_date'] ?></h5>
                            </div>
                            <div class="col-md-2">
                                <h5><?= $reservation['total_price'] ?></h5>
                            </div>
                            <div class="col-md-2">
                                <input type="hidden" name="reservation_id" value="<?= $reservation['id'] ?>">
                                <button class="btn btn-warning btn-sm" name="cancel">
                                    <i class="fa fa-trash me-2"></i> Cancel</a>
                            </div>
                        </form>
                    </div>

                <?php    
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
