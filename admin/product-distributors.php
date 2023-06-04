<?php
session_start();
include('../middleware/adminMiddleware.php');
include('includes/header.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../config/db_config.php');

?>
<?php 

if (isset($_POST['delete_product_distributor_btn'])) {
    $productId = $_POST['delete_product_distributor_btn'];
    $deleteResult = deleteProductDistributor($productId);
    if ($deleteResult) {
        $_SESSION['message'] = "Product deleted successfully";
        header('Location: product-distributors.php');
        exit();
    } else {
        $_SESSION['message'] = "Failed to delete product";
        header('Location: product-distributors.php');
        exit();
    }
}
if (isset($_SESSION['message'])): ?>
    <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
        <?php 
            echo $_SESSION['message']; 
            unset($_SESSION['message']);
            unset($_SESSION['msg_type']);
        
        
        ?>
    </div>
<?php endif ?>


<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Product Distributors</h4>
                </div>
                <div class="card-body" id="product_distributors_table">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr class="table-info">
                                <th>ID</th>
                                <th>Product ID</th>
                                <th>Product Image</th>
                                <th>Distributor ID</th>
                                <th>Price</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $productDistributors = getProductDistributors();
                            
                            if (count($productDistributors) > 0) {
                                foreach ($productDistributors as $row) {
                                    $products = getById('Products', $row['productId']);
                                    $images = isset($products['images']) ? explode(",", $products['images']) : [];
                                    $firstImage = count($images) > 0 ? $images[0] : '';
                                    ?>
                                    <tr>
                                        <td><?= $row['id']; ?></td>
                                        <td><?= $row['productId']; ?></td>
                                        <td>
                                           
                                                <img src="<?= $firstImage; ?>" width="50px" height="50px" alt="Product Image">
                                          
                                        </td>
                                        <td><?= $row['distributorId']; ?></td>
                                        <td><?= $row['price']; ?></td>
                                        <td>
                                            <a href="edit-product-distributor.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                        </td>
                                        <td>
                                        <form method="post" action="">
                                            <button type="submit" class="btn btn-danger btn-sm delete_product_distributor_btn" name="delete_product_distributor_btn" value="<?= $row['id']; ?>">Delete</button>
                                        </form>
                                    </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='7'>No product distributors found</td></tr>";
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
