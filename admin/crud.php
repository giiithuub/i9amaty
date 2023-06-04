<?php 
session_start();
include('../config/db_config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Add Product
if (isset($_POST['add_product'])) {
    // Retrieve form input values
    $name = $_POST['name'];
    $description = $_POST['description'];
    $slug = $_POST['slug'];
    $categoryId = $_POST['category_id'];

    $images = [];
    if (isset($_FILES['images'])) {
        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            $file_name = $_FILES['images']['name'][$key];
            $file_tmp = $_FILES['images']['tmp_name'][$key];

            // Assuming you want to put images into an 'uploads/' directory
            $newFilePath = "uploads/" . $file_name;
            if (move_uploaded_file($file_tmp, $newFilePath)) {
                $images[] = $newFilePath;
            }
        }
    }
    $imagesStr = implode(",", $images);

    // Insert into Products table
    $sql = "INSERT INTO Products (name, description, slug, categoryId, images) VALUES ('$name', '$description', '$slug', '$categoryId', '$imagesStr')";
    $query_run = mysqli_query($con, $sql);

    // Redirect based on success or failure
    if ($query_run) {
        $_SESSION['message'] = "Product Added";
        header('Location: add-product.php');
        exit();
    } else {
        $_SESSION['message'] = "Product Not Added";
        header('Location: add-product.php');
        exit();
    }
}

// Edit Product
if (isset($_POST['edit_product'])) {
    // Retrieve form input values
    $productId = $_POST['product_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $slug = $_POST['slug'];
    $categoryId = $_POST['category_id'];

    // Update Products table
    $sql = "UPDATE Products SET name='$name', description='$description', slug='$slug', categoryId='$categoryId' WHERE id='$productId'";
    $query_run = mysqli_query($con, $sql);

    // Redirect based on success or failure
    if ($query_run) {
        $_SESSION['message'] = "Product Updated";
        header('Location: edit-product.php?id=' . $productId);
        exit();
    } else {
        $_SESSION['message'] = "Product Not Updated";
        header('Location: edit-product.php?id=' . $productId);
        exit();
    }
}

// Delete Product
if (isset($_POST['delete_product'])) {
    $productId = $_POST['product_id'];

    // Delete from Products table
    $sql = "DELETE FROM Products WHERE id='$productId'";
    $query_run = mysqli_query($con, $sql);

    // Redirect based on success or failure
    if ($query_run) {
        $_SESSION['message'] = "Product Deleted";
        header('Location: products.php');
        exit();
    } else {
        $_SESSION['message'] = "Product Not Deleted";
        header('Location: products.php');
        exit();
    }
}

// Add Category
if (isset($_POST['add_category'])) {
    // Retrieve form input values
    $name = $_POST['name'];

    
    $images = [];
    if (isset($_FILES['images'])) {
        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            $file_name = $_FILES['images']['name'][$key];
            $file_tmp = $_FILES['images']['tmp_name'][$key];

            // Assuming you want to put images into an 'uploads/' directory
            $newFilePath = "uploads/" . $file_name;
            if (move_uploaded_file($file_tmp, $newFilePath)) {
                $images[] = $newFilePath;
            }
        }}

        $imagesStr = implode(",", $images);

    // Insert into Categories table
    $sql = "INSERT INTO Categories (name, images) VALUES ('$name', '$imagesStr')";
    $query_run = mysqli_query($con, $sql);

    // Redirect based on success or failure
    if ($query_run) {
        $_SESSION['message'] = "Category Added";
        header('Location: add-category.php');
        exit();
    } else {
        $_SESSION['message'] = "Category Not Added";
        header('Location: add-category.php');
        exit();
    }
}

// Edit Category
if (isset($_POST['edit_category'])) {
    // Retrieve form input values
    $categoryId = $_POST['category_id'];
    $name = $_POST['name'];

    // Update Categories table
    $sql = "UPDATE Categories SET name='$name' WHERE id='$categoryId'";
    $query_run = mysqli_query($con, $sql);

    // Redirect based on success or failure
    if ($query_run) {
        $_SESSION['message'] = "Category Updated";
        header('Location: edit-category.php?id=' . $categoryId);
        exit();
    } else {
        $_SESSION['message'] = "Category Not Updated";
        header('Location: edit-category.php?id=' . $categoryId);
        exit();
    }
}

// Delete Category
if (isset($_POST['delete_category'])) {
    $categoryId = $_POST['category_id'];

    // Delete from Categories table
    $sql = "DELETE FROM Categories WHERE id='$categoryId'";
    $query_run = mysqli_query($con, $sql);

    // Redirect based on success or failure
    if ($query_run) {
        $_SESSION['message'] = "Category Deleted";
        header('Location: categories.php');
        exit();
    } else {
        $_SESSION['message'] = "Category Not Deleted";
        header('Location: categories.php');
        exit();
    }
}

// Add Distributor
if (isset($_POST['add_distributor'])) {
    // Retrieve form input values
    $name = $_POST['name'];
    $place = $_POST['place'];

    // Insert into Distributors table
    $sql = "INSERT INTO Distributors (name, place) VALUES ('$name', '$place')";
    $query_run = mysqli_query($con, $sql);

    // Redirect based on success or failure
    if ($query_run) {
        $_SESSION['message'] = "Distributor Added";
        header('Location: add-distributor.php');
        exit();
    } else {
        $_SESSION['message'] = "Distributor Not Added";
        header('Location: add-distributor.php');
        exit();
    }
}

// Edit Distributor
if (isset($_POST['edit_distributor'])) {
    // Retrieve form input values
    $distributorId = $_POST['distributor_id'];
    $name = $_POST['name'];
    $place = $_POST['place'];

    // Update Distributors table
    $sql = "UPDATE Distributors SET name='$name', place='$place' WHERE id='$distributorId'";
    $query_run = mysqli_query($con, $sql);

    // Redirect based on success or failure
    if ($query_run) {
        $_SESSION['message'] = "Distributor Updated";
        header('Location: edit-distributor.php?id=' . $distributorId);
        exit();
    } else {
        $_SESSION['message'] = "Distributor Not Updated";
        header('Location: edit-distributor.php?id=' . $distributorId);
        exit();
    }
}

// Delete Distributor
if (isset($_POST['delete_distributor'])) {
    $distributorId = $_POST['distributor_id'];

    // Delete from Distributors table
    $sql = "DELETE FROM Distributors WHERE id='$distributorId'";
    $query_run = mysqli_query($con, $sql);

    // Redirect based on success or failure
    if ($query_run) {
        $_SESSION['message'] = "Distributor Deleted";
        header('Location: distributors.php');
        exit();
    } else {
        $_SESSION['message'] = "Distributor Not Deleted";
        header('Location: distributors.php');
        exit();
    }
}

// Add Product Distributor
if (isset($_POST['add_product_distributor'])) {
    // Retrieve form input values
    $productId = $_POST['product_id'];
    $distributorId = $_POST['distributor_id'];
    $price = $_POST['price'];

    // Insert into ProductDistributors table
    $sql = "INSERT INTO ProductDistributors (productId, distributorId, price) VALUES ('$productId', '$distributorId', '$price')";
    $query_run = mysqli_query($con, $sql);

    // Redirect based on success or failure
    if ($query_run) {
        $_SESSION['message'] = "Product Distributor Added";
        header('Location: add-product-distributor.php');
        exit();
    } else {
        $_SESSION['message'] = "Product Distributor Not Added";
        header('Location: add-product-distributor.php');
        exit();
    }
}

// Edit Product Distributor
if (isset($_POST['edit_product_distributor'])) {
    // Retrieve form input values
    $productDistributorId = $_POST['product_distributor_id'];
    $productId = $_POST['product_id'];
    $distributorId = $_POST['distributor_id'];
    $price = $_POST['price'];

    // Update ProductDistributors table
    $sql = "UPDATE ProductDistributors SET productId='$productId', distributorId='$distributorId', price='$price' WHERE id='$productDistributorId'";
    $query_run = mysqli_query($con, $sql);

    // Redirect based on success or failure
    if ($query_run) {
        $_SESSION['message'] = "Product Distributor Updated";
        header('Location: edit-product-distributor.php?id=' . $productDistributorId);
        exit();
    } else {
        $_SESSION['message'] = "Product Distributor Not Updated";
        header('Location: edit-product-distributor.php?id=' . $productDistributorId);
        exit();
    }
}

// Delete Product Distributor
if (isset($_POST['delete_product_distributor'])) {
    $productDistributorId = $_POST['product_distributor_id'];

    // Delete from ProductDistributors table
    $sql = "DELETE FROM ProductDistributors WHERE id='$productDistributorId'";
    $query_run = mysqli_query($con, $sql);

    // Redirect based on success or failure
    if ($query_run) {
        $_SESSION['message'] = "Product Distributor Deleted";
        header('Location: product-distributors.php');
        exit();
    } else {
        $_SESSION['message'] = "Product Distributor Not Deleted";
        header('Location: product-distributors.php');
        exit();
    }
}

?>
