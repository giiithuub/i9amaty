<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('includes/header.php');

$categoryId = isset($_GET['id']) ? $_GET['id'] : ''; // Get the 'category' parameter from the URL
?>

<div class="py-3 bg-dark">
    <div class="container">
        <a href="index.php" class="text-white" style="text-decoration:none">Home / </a><a href="category.php?category=<?= $category; ?>" class="text-white" style="text-decoration:none" >CATEGORY</a>
    </div>
</div>

<section class="product_list pt-5">
    <div class="container">
        <div class="row">
            <div class="product_list">
                <div class="row">
                    <?php
                    // Fetch the products by category from the database
                    $products = getProductsByCategory($categoryId);

                    $counter = 0; // Counter for tracking the number of products in a row

                    while ($product = mysqli_fetch_assoc($products)) {
                        // Extract the first image from the images string
                        $category = getById('Categories', $product['categoryId']);
                        $images = explode(",", $product['images']);
                        $firstImage = count($images) > 0 ? $images[0] : '';

                        // Start a new row if counter is a multiple of 3
                        if ($counter % 3 == 0) {
                            echo '</div><div class="row">';
                        }
                        ?>

                        <div class="col-lg-4 col-sm-6">
                            <div class="single_product_item">
                                <img src="admin/<?php echo $firstImage; ?>" alt="#" class="img-fluid">
                                <h3><a href="single-product.html"><?php echo $product['name']; ?></a></h3>
                                <p>Category: <?php echo $category['name']; ?></p>
                                <a href="single-product.php?id=<?= $product['id'] ?>" class="btn_3">Show More</a>
                            </div>
                        </div>

                        <?php
                        $counter++;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('includes/footer.php'); ?>
