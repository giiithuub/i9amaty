<?php
session_start();
include('functions/myfunctions.php');
include('includes/header.php');
?>

<style>
    body { background-color: #ecedee }
    .card { border: none; overflow: hidden }
    .thumbnail_images ul { list-style: none; justify-content: center; display: flex; align-items: center; margin-top: 10px }
    .thumbnail_images ul li { margin: 5px; padding: 10px; border: 2px solid #eee; cursor: pointer; transition: all 0.5s }
    .thumbnail_images ul li:hover { border: 2px solid #000 }
    .main_image { display: flex; justify-content: center; align-items: center; border-bottom: 1px solid #eee; height: 400px; width: 100%; overflow: hidden }
    .heart { height: 29px; width: 29px; background-color: #eaeaea; border-radius: 50%; display: flex; justify-content: center; align-items: center }
    .content p { font-size: 12px }
    .ratings span { font-size: 14px; margin-left: 12px }
    .colors { margin-top: 5px }
    .colors ul { list-style: none; display: flex; padding-left: 0px }
    .colors ul li { height: 20px; width: 20px; display: flex; border-radius: 50%; margin-right: 10px; cursor: pointer }
    .colors ul li:nth-child(1) { background-color: #6c704d }
    .colors ul li:nth-child(2) { background-color: #96918b }
    .colors ul li:nth-child(3) { background-color: #68778e }
    .colors ul li:nth-child(4) { background-color: #263f55 }
    .colors ul li:nth-child(5) { background-color: black }
    .right-side { position: relative }
    .search-option { position: absolute; background-color: #000; overflow: hidden; align-items: center; color: #fff; width: 200px; height: 200px; border-radius: 49% 51% 50% 50% / 68% 69% 31% 32%; left: 30%; bottom: -250px; transition: all 0.5s; cursor: pointer }
    .search-option .first-search { position: absolute; top: 20px; left: 90px; font-size: 20px; opacity: 1000 }
    .search-option .inputs { opacity: 0; transition: all 0.5s ease; transition-delay: 0.5s; position: relative }
    .search-option .inputs input { position: absolute; top: 200px; left: 30px; padding-left: 20px; background-color: transparent; width: 300px; border: none; color: #fff; border-bottom: 1px solid #eee; transition: all 0.5s; z-index: 10 }
    .search-option .inputs input:focus { box-shadow: none; outline: none; z-index: 10 }
    .search-option:hover { border-radius: 0px; width: 100%; left: 0px }
    .search-option:hover .inputs { opacity: 1 }
    .search-option:hover .first-search { left: 27px; top: 25px; font-size: 15px }
    .search-option:hover .inputs input { top: 20px }
    .search-option .share { position: absolute; right: 20px; top: 22px }
    .buttons .btn { height: 50px; width: 150px; border-radius: 0px !important }
    .footer-container { position: sticky; bottom: 0; background-color: #fff; padding: 20px 0; text-align: center; z-index: 1 }
</style>

<?php
if (isset($_GET['id'])) {
    $chamberId = $_GET['id'];
    $chamber = getByID("chambers", $chamberId);

    if ($chamber) {
        $images = explode(",", $chamber['images']);
        ?>
        <!--================Single Chamber Area =================-->
        <div class="container mt-5 mb-5">
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-6 border-end">
                        <div class="d-flex flex-column justify-content-center">
                            <div class="main_image">
                                <!-- Main image goes here -->
                                <img src="admin/<?= $images[0] ?>" id="main_product_image" style="max-width: 100%; height: auto;">
                            </div>
                            <div class="thumbnail_images mt-3">
                                <ul id="thumbnail" style="display: flex; flex-wrap: wrap;">
                                    <!-- Thumbnails go here -->
                                    <?php foreach ($images as $image) { ?>
                                        <li style="margin-right: 10px;">
                                            <img onclick="changeImage(this)" src="admin/<?= $image ?>" style="width: 70px; height: 70px; object-fit: cover;">
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 right-side">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3><?= $chamber['name'] ?></h3>
                                <!-- Placeholder for Heart -->
                                <span class="heart"><i class='bx bx-heart'></i></span>
                            </div>
                            <div class="mt-2 pr-3 content">
                                <p><?= $chamber['description'] ?></p>
                            </div>
                            <div class="details">
                                <span class="fw-bold">Chamber Details</span>
                                <div class="mt-5">
                                    <h4 class="mb-3">Details</h4>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><i class="fas fa-door-open me-2"></i> Room Type: <?= $chamber['room_type'] ?></li>
                                        <li class="list-group-item"><i class="fas fa-users me-2"></i> Capacity: <?= $chamber['capacity'] ?></li>
                                        <li class="list-group-item"><i class="fas fa-bath me-2"></i> Bathroom: <?= $chamber['bathroom'] ? 'Yes' : 'No' ?></li>
                                        <li class="list-group-item"><i class="fas fa-utensils me-2"></i> Kitchen: <?= $chamber['kitchen'] ? 'Yes' : 'No' ?></li>
                                        <li class="list-group-item"><i class="fas fa-snowflake me-2"></i> AC: <?= $chamber['ac'] ? 'Yes' : 'No' ?></li>
                                        <li class="list-group-item"><i class="fas fa-fire me-2"></i> Heating: <?= $chamber['heating'] ? 'Yes' : 'No' ?></li>
                                        <li class="list-group-item"><i class="fas fa-couch me-2"></i> Furnished: <?= $chamber['furnished'] ? 'Yes' : 'No' ?></li>
                                        <li class="list-group-item"><i class="fas fa-ruler-horizontal me-2"></i> Size: <?= $chamber['size'] ?></li>
                                        <li class="list-group-item"><i class="fas fa-tree me-2"></i> Balcony: <?= $chamber['balcony'] ? 'Yes' : 'No' ?></li>
                                        <li class="list-group-item"><i class="fas fa-tshirt me-2"></i> Laundry: <?= $chamber['laundry'] ? 'Yes' : 'No' ?></li>
                                        <li class="list-group-item"><i class="fas fa-paw me-2"></i> Pet friendly: <?= $chamber['pet_friendly'] ? 'Yes' : 'No' ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-container">
            <h3>$<?= $chamber['price'] ?>/month</h3>
            <!-- Placeholder for Location and Available Date -->
            <h4>Location: TBD</h4>
            <h4>Available Date: TBD</h4>
            <button class="btn btn-dark">Reserve Now</button>
        </div>
        <script>
            function changeImage(element) {
                var main_product_image = document.getElementById('main_product_image');
                main_product_image.src = element.src;
            }
        </script>
        <!--================End Single Chamber Area =================-->
    <?php
    } else {
        echo "<h2 class='text-center'>Chamber not found!</h2>";
    }
} else {
    echo "<h2 class='text-center'>No chamber selected!</h2>";
}

include('includes/footer.php');
?>
