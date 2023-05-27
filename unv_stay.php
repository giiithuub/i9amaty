<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('functions/myfunctions.php');
include('config/dbcon.php');

include('includes/header.php');

$unv_id = isset($_GET['unv_id']) ? $_GET['unv_id'] : ''; // Get the 'unv_id' parameter from the URL
?>

<div class="py-3 bg-dark">
    <div class="container">
        <a href="index.php" class="text-white" style="text-decoration:none">Home / </a><a href="university_stay.php?unv_id=<?= $unv_id; ?>" class="text-white" style="text-decoration:none" >University Stays</a>
    </div>
</div>

<section class="product_list pt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php if (isset($_SESSION['message'])): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $_SESSION['message']; ?>
                    </div>
                    <?php unset($_SESSION['message']); ?>
                <?php endif; ?>
                <div class="product_list">
                    <div class="row">
                        <?php 
                        // Fetch the chambers from the database
                        $chambers = getChambersByUniversityStay($unv_id); 
                        while($chamber = mysqli_fetch_assoc($chambers)) {
                            // Extract the first image from the images string
                            $images = explode(",", $chamber['images']);
                            $firstImage = count($images) > 0 ? $images[0] : '';
                        ?>

                        <div class="col-lg-6 col-sm-6">
                            <div class="single_product_item">
                                <img src="admin/<?php echo $firstImage; ?>" alt="#" class="img-fluid">
                                <h3><a href="single-product.html"><?php echo $chamber['name']; ?></a></h3>
                                <p>UniStay: <?php echo $chamber['unv_name']; ?></p>
                                <p>Room Type: <?php echo $chamber['room_type']; ?></p>
                                <p>Price: $<?php echo $chamber['price']; ?>/month</p>
                                <a href="unv_stay.php?id=<?= $chamber['id']?>" class="btn_3">Book Now</a>
                            </div>
                        </div>

                        <?php 
                        } 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('includes/footer.php'); ?>
