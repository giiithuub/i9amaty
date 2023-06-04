<?php   
session_start();
include('../middleware/adminMiddleware.php');
include('includes/header.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
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
                    <h4>Add Category</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="crud.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label class="mb-0 fw-bold text-dark" for="images">Upload Images</label>
                            <input type="file" name="images[]" multiple class="form-control mb-3">
                            <div id="preview"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="add_category" class="btn btn-primary">Add Category</button>
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

