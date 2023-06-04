<?php
session_start();
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
        function getCommentsByProductId($productId)
        {
            global $con;
            $sql = "SELECT * FROM Comments WHERE product_id = '$productId' ORDER BY created_at DESC";
            $result = mysqli_query($con, $sql);
            $comments = [];
        
            while ($row = mysqli_fetch_assoc($result)) {
                $comments[] = $row;
            }
        
            return $comments;
        }
        
        // Submit comment
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['productId'];
            $name = $_POST['name'];
            $comment = $_POST['comment'];
        
            $sql = "INSERT INTO Comments (product_id, name, comment) VALUES ('$productId', '$name', '$comment')";
            mysqli_query($con, $sql);
        
            header("Location: product.php?id=$productId");
            exit();
        }
if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $product = getByID("Products", $productId);
 // Retrieve comments
 $comments = getCommentsByProductId($productId);

    if ($product) {
        $images = explode(",", $product['images']);
        ?>
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
                            <div class="d-flex flex-column">
                                <h3><?= $product['name'] ?></h3>
                                <hr style="border: 1px solid black;">
                                <h4 style="color:black;"><?= $product['description'] ?></h4>
                                <hr style="border: 1px solid black;">
                                <span class="heart"><i class='bx bx-heart'></i></span>
                            </div>
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr class="table-info">
                                        <th>Distributor Name</th>
                                        <th>Place</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $prodDist = getProductDistributorsByProdId($productId);
                                    $cheapestPrice = null;
                                    $cheapestDistributor = null;

                                    if (count($prodDist) > 0) {
                                        foreach ($prodDist as $row) {
                                            $distributor = getDistributorById($row['distributorId']);
                                            $price = $row['price'];
                                            if ($cheapestPrice === null || $price < $cheapestPrice) {
                                                $cheapestPrice = $price;
                                                $cheapestDistributor = $distributor;
                                            }
                                            ?>
                                            <tr>
                                                <td><?= $distributor['name']; ?></td>
                                                <td><?= $distributor['place']; ?></td>
                                                <td><?= $price; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='3'>No product distributors found</td></tr>";
                                    }
                                ?>
                                </tbody>
                            </table>
                            <?php if ($cheapestDistributor) { ?>
                                <div class="footer-container">
                                    <h3>Cheapest Price: <?= $cheapestPrice ?></h3>
                                    <p>From Distributor: <?= $cheapestDistributor['name'] ?></p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-container">
            <?php if (isset($row)) { ?>
                <h3>Cheapest Price: <?= $row['price'] ?></h3>
            <?php } ?>
        </div>

        <!-- Display comments -->
        <div class="container mt-5">
            <h2>Comments</h2>
            <div style="border-top: 1px solid #000; margin-bottom: 20px;"></div>
            <?php foreach ($comments as $comment) { ?>
                <div class="comment card">
                    <div class="card-body">
                        <div class="comment-header">
                            <div class="comment-profile">
                                <i class="fas fa-user-circle fa-3x"></i>
                                <h5 class="comment-name"><?= $comment['name'] ?></h5>
                            </div>
                            <div class="comment-info">
                               
                                <p class="comment-date"><?= $comment['created_at'] ?></p>
                            </div>
                        </div>
                        <div class="comment-body">
                            <p class="comment-text"><?= $comment['comment'] ?></p>
                        </div>
                    </div>
                </div>
                <div style="border-top: 1px solid #000; margin-bottom: 20px;"></div>
            <?php } ?>
        </div>

        <!-- Comment Form -->
        <form action="single-product.php?id=<?= $productId ?>" method="post" style="background: #e0e0e0; padding: 20px; border-radius: 8px;">
            <input type="hidden" name="productId" value="<?= $productId ?>">
            <div class="form-group">
                <label for="name">Your Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Your name" required>
            </div>
            <div class="form-group">
                <label for="comment">Leave a Comment</label>
                <textarea name="comment" id="comment" class="form-control" rows="4" placeholder="Leave a comment..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Comment</button>
        </form>

        </div>
    <?php
    } else {
        echo "<h2 class='text-center'>Chamber not found!</h2>";
    }
} else {
    echo "<h2 class='text-center'>No chamber selected!</h2>";
}

include('includes/footer.php');
?>

