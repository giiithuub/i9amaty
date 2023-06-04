<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$username = "root";
$password = "root";
$database = "Electro";

// Connection to the database
$con = mysqli_connect($host, $username, $password, $database);

// Check the connection
if (!$con) {
    die("Connection failed " . mysqli_connect_error());
}

// Get functions

function getAll($table)
{
    global $con;
    $query = "SELECT * FROM $table";

    return $query_run = mysqli_query($con, $query);
}
function getCategories()
{
    global $con;
    $sql = "SELECT * FROM Categories";
    $result = mysqli_query($con, $sql);
    $categories = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row;
    }

    return $categories;
}

function getProductDistributors()
{
    global $con;
    $sql = "SELECT * FROM ProductDistributors";
    $result = mysqli_query($con, $sql);
    $productdistributors = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $productdistributors[] = $row;
    }

    return $productdistributors;
}

function getDistributorById($distributorId)
{
    global $con;
    $query = "SELECT * FROM Distributors WHERE id = '$distributorId'";
    $result = mysqli_query($con, $query);
    $distributor = mysqli_fetch_assoc($result);

    return $distributor;
}

function getProductDistributorsByProdId($productId)
{
    global $con;
    $sql = "SELECT * FROM ProductDistributors WHERE productId = '$productId'";
    $result = mysqli_query($con, $sql);
    $distributors = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $distributors[] = $row;
    }

    return $distributors;
}

function getDistributors()
{
    global $con;
    $sql = "SELECT * FROM Distributors";
    return mysqli_query($con, $sql);
}

function getProducts()
{
    global $con;
    $sql = "SELECT * FROM Products";
    return mysqli_query($con, $sql);
}
function getProductsByCategory($categoryId)
{
    global $con;
    $sql = "SELECT * FROM Products WHERE categoryId = '$categoryId'";
    return mysqli_query($con, $sql);
}

function getDistributorsByProduct($productId)
{
    global $con;
    $sql = "SELECT d.id, d.name, d.place, pd.price FROM ProductDistributors pd 
            JOIN Distributors d ON pd.distributorId = d.id 
            WHERE pd.productId = '$productId'";
    return mysqli_query($con, $sql);
}

function getById($table, $id)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run && mysqli_num_rows($query_run) > 0) {
        return mysqli_fetch_assoc($query_run);
    } else {
        return null; // or handle the error appropriately
    }
}

// Delete functions
function deleteCategory($id)
{
    global $con;
    $sql = "DELETE FROM Categories WHERE id = '$id'";
    return mysqli_query($con, $sql);
}

function deleteDistributor($id)
{
    global $con;
    $sql = "DELETE FROM Distributors WHERE id = '$id'";
    return mysqli_query($con, $sql);
}

function deleteProduct($id)
{
    global $con;
    $sql = "DELETE FROM Products WHERE id = '$id'";
    return mysqli_query($con, $sql);
}

function deleteProductDistributor($id)
{
    global $con;

    // Delete associated records in ProductDistributors table
    $deleteProductDistributors = "DELETE FROM ProductDistributors WHERE id = '$id'";
    mysqli_query($con, $deleteProductDistributors);

    // Delete the product
    $deleteProduct = "DELETE FROM Products WHERE id = '$id'";
    return mysqli_query($con, $deleteProduct);
}

// Add functions
function addCategory($name, $image)
{
    global $con;
    $sql = "INSERT INTO Categories (name, image) VALUES ('$name', '$image')";
    return mysqli_query($con, $sql);
}

function addDistributor($name, $place)
{
    global $con;
    $sql = "INSERT INTO Distributors (name, place) VALUES ('$name', '$place')";
    return mysqli_query($con, $sql);
}

function addProduct($name, $description, $images, $slug, $categoryId)
{
    global $con;
    $sql = "INSERT INTO Products (name, description, images, slug, categoryId) VALUES ('$name', '$description', '$images', '$slug', '$categoryId')";
    return mysqli_query($con, $sql);
}

function addProductDistributor($productId, $distributorId, $price)
{
    global $con;
    $sql = "INSERT INTO ProductDistributors (productId, distributorId, price) VALUES ('$productId', '$distributorId', '$price')";
    return mysqli_query($con, $sql);
}

// Update functions
// Add your update functions here

?>
