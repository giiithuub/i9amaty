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
<style>
    .custom-row{
        
        align-items: center;
        font-size: 1.2em;
    }
</style>

<div class="py-3 bg-dark">
    <div class="container">
        <a href="index.php" class="text-white" style="text-decoration:none">Home / </a><a href="view_reservation.php" class="text-white" style="text-decoration:none">Reservation</a>
    </div>
</div>

<div class="container p-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Reservations</h4>
                </div>
                <div class="card-body" id="reservation_table">
                    <table class="table table-bordred table-striped table-hover">
                        <thead class="table-info">
                            <tr>
                                <th>Chamber Image</th>
                                <th>Chamber Name</th>
                                <th>From Date</th>
                                <th>To Date</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Cancel Reservation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $reservations = getChamberReservations($_COOKIE['user_id']);
                            foreach ($reservations as $reservation) {
                                $user = getUserById($reservation['user_id']);
                                $chamber = getChamberById($reservation['chamber_id']);
                                $images = explode(",", $chamber['images']);
                                $firstImage = count($images) > 0 ? $images[0] : '';
                            ?>
                                <tr>
                                    <td><img src="admin/<?= $firstImage ?>" alt="<?= $chamber['name'] ?>" style="max-width:3rem; max-height: 5rem;"/></td>
                                    <td class="pt-4 custom-row"><?= $chamber['name'] ?></td>
                                    <td class="pt-4 custom-row"><?= $reservation['from_date'] ?></td>
                                    <td class="pt-4 custom-row"><?= $reservation['to_date'] ?></td>
                                    <td class="pt-4 custom-row"><?= $reservation['total_price'] ?></td>
                                    <td class="pt-4 custom-row"><?= $reservation['status']; ?></td>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="reservation_id" value="<?= $reservation['id'] ?>">
                                            <button class="btn btn-warning btn-sm" name="cancel"><i class="fa fa-trash me-2"></i> Cancel</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php    
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
