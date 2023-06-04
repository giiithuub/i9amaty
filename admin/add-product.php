<?php   
session_start();
include('../middleware/adminMiddleware.php');
include('includes/header.php');
include('../config/db_config.php');
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

<style>
    .form-check-label {
        color: black;
    }
</style>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Product</h4>
                </div>
                <div class="card-body">
                    <form action="crud.php" method="POST" enctype="multipart/form-data" id="add-product-form">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="mb-0 fw-bold text-dark" for="name">Product Name</label>
                                <input type="text" required name="name" placeholder="Enter product name" class="form-control mb-3">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0" for="">Category</label>
                                <select name="category_id" class="form-select mb-2" aria-label="Default select example">
                                    <option selected>Select Category</option>
                                    <?php
                                    $categories = getCategories();

                                    if ($categories) {
                                        foreach ($categories as $category) {
                                            ?>
                                            <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
                                        <?php
                                        }
                                    } else {
                                        echo "<option disabled>No categories available</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="mb-0 fw-bold text-dark" for="slug">Slug</label>
                                <input type="text" required placeholder="Enter slug" name="slug" class="form-control mb-3">
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0 fw-bold text-dark" for="description">Description</label>
                                <textarea name="description" required rows="3" placeholder="Enter description" class="form-control mb-3"></textarea>
                            </div>

                            <div class="col-md-12">
                            <label class="mb-0 fw-bold text-dark" for="images">Upload Images</label>
                            <input type="file" name="images[]" multiple class="form-control mb-3">
                            <div id="preview"></div>
                        </div>

                            <div class="col-md-6">
                                <label class="mb-0 fw-bold text-dark" for="price">Price</label>
                                <input type="number" required name="price" placeholder="Enter price" class="form-control mb-3">
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="add_product">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.querySelector('input[type="file"]').onchange = function() {
        let files = document.querySelector('input[type="file"]').files;
        let preview = document.getElementById('preview');

        function readAndPreview(file) {
            // Make sure `file.name` matches our extensions criteria
            if (/\.(jpe?g|png|gif)$/i.test(file.name)) {
                let reader = new FileReader();

                reader.addEventListener("load", function() {
                    let image = new Image();
                    image.height = 100;
                    image.width = 100;
                    image.style.margin = "0.5rem";
                    image.title = file.name;
                    image.src = this.result;
                    preview.appendChild(image);
                }, false);

                reader.readAsDataURL(file);
            }
        }

        if (files) {
            [].forEach.call(files, readAndPreview);
        }
    };
</script>

<?php include('includes/footer.php');?>
