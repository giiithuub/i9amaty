<?php
session_start();
include('../middleware/adminMiddleware.php');
include('includes/header.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../config/db_config.php');


if (isset($_POST['delete_category_btn'])) {
    $categoryId = $_POST['delete_category_btn'];
    $deleteResult = deleteCategory($categoryId);
    if ($deleteResult) {
        $_SESSION['message'] = "Category deleted successfully";
        header('Location: categories.php');
        exit();
    } else {
        $_SESSION['message'] = "Failed to delete product";
        header('Location: categories.php');
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


<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Categories</h4>
                </div>
                <div class="card-body" id="categories_table">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr class="table-info">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $categories = getCategories();

                            if (count($categories) > 0) {
                                foreach ($categories as $row) {
                                    $images = isset($row['images']) ? explode(",", $row['images']) : [];
                                    $firstImage = count($images) > 0 ? $images[0] : '';
                                    ?>
                                    <tr>
                                        <td><?= $row['id']; ?></td>
                                        <td><?= $row['name']; ?></td>
                                        <td>
                                            <?php if (!empty($firstImage)) { ?>
                                                <img src="<?= $firstImage; ?>" width="50px" height="50px" alt="<?= $row['name'] ?>">
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a href="edit-category.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                        </td>
                                        
                                        <td>
                                        <form method="post" action="">
                                            
                                        <button type="submit" class="btn btn-danger btn-sm " name="delete_category_btn" value="<?= $row['id']; ?>">Delete</button>
                                        </form>    
                                    </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='5'>No categories found</td></tr>";
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
