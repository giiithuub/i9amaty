<?php
session_start();
include('../middleware/adminMiddleware.php');
include('includes/header.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../config/db_config.php');

if (isset($_POST['delete_product_btn'])) {
    $productId = $_POST['delete_product_btn'];
    $deleteResult = deleteProduct($productId);
    if ($deleteResult) {
        $_SESSION['message'] = "Product deleted successfully";
        header('Location: products.php');
        exit();
    } else {
        $_SESSION['message'] = "Failed to delete product";
        header('Location: products.php');
        exit();
    }
}

?>
<?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
        <?php 
            echo $_SESSION['message']; 
            unset($_SESSION['message']);
            unset($_SESSION['msg_type']);
        ?>
    </div>
<?php endif ?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Products</h4>
                </div>
                <div class="card-body" id="products_table">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr class="table-info">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Images</th>
                                <th>Slug</th>
                                <th>Category ID</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $products = getProducts();

                            if ($products && mysqli_num_rows($products) > 0) {
                                while ($row = mysqli_fetch_assoc($products)) {
                                    $images = isset($row['images']) ? explode(",", $row['images']) : [];
                                    $firstImage = count($images) > 0 ? $images[0] : '';
                                    ?>
                                    <tr>
                                        <td><?= $row['id']; ?></td>
                                        <td><?= $row['name']; ?></td>
                                        <td><?= $row['description']; ?></td>
                                        <td>
                                            
                                                <img src="<?= $firstImage; ?>" width="50px" height="50px" alt="Product Image">
                                            
                                        </td>
                                        <td><?= $row['slug']; ?></td>
                                        <td><?= $row['categoryId']; ?></td>
                                        <td>
                                            <a href="edit-product.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                        </td>
                                        <td>
                                            <form method="post" action="">
                                                <button type="submit" class="btn btn-danger btn-sm" name="delete_product_btn" value="<?= $row['id']; ?>">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='8'>No products found</td></tr>";
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
