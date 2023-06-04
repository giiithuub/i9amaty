<?php
session_start();
include('../middleware/adminMiddleware.php');
include('includes/header.php');
include('../config/db_config.php');

// Retrieve products and distributors
$products = getProducts();
$distributors = getDistributors();
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


<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Product Distributor</h4>
                </div>
                <div class="card-body">
                    <form action="crud.php" method="POST" id="add-product-distributor-form">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="mb-0 fw-bold text-dark" for="product_id">Product</label>
                                <select name="product_id" class="form-select mb-3" required>
                                    <option value="" selected>Select Product</option>
                                    <?php
                                    if ($products) {
                                        foreach ($products as $product) {
                                            echo '<option value="' . $product['id'] . '">' . $product['name'] . '</option>';
                                        }
                                    } else {
                                        echo '<option value="" disabled>No products available</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0 fw-bold text-dark" for="distributor_id">Distributor</label>
                                <select name="distributor_id" class="form-select mb-3" required>
                                    <option value="" selected>Select Distributor</option>
                                    <?php
                                    if ($distributors) {
                                        foreach ($distributors as $distributor) {
                                            echo '<option value="' . $distributor['id'] . '">' . $distributor['name'] . '</option>';
                                        }
                                    } else {
                                        echo '<option value="" disabled>No distributors available</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0 fw-bold text-dark" for="price">Price</label>
                                <input type="number" name="price" placeholder="Enter price" class="form-control mb-3" required>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="add_product_distributor">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
