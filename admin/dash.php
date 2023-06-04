<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Admin Dashboard</title>
  <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no' />
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <div class="container">
    <h1>Product Admin Dashboard</h1>
    <hr>

    <!-- Section for Categories -->
    <section>
      <h2>Category Operations</h2>
      <form id="category-form">
        <input type="text" id="category-name" placeholder="Category Name">
        <input type="text" id="category-image" placeholder="Category Image URL">
        <button type="submit" id="add-category">Add Category</button>
      </form>
      <button id="get-categories">Get Categories</button>
      <div id="category-results"></div>
    </section>
    <hr>

    <!-- Section for Products -->
    <section>
      <h2>Product Operations</h2>
      <form id="product-form">
        <input type="text" id="product-name" placeholder="Product Name">
        <textarea id="product-description" placeholder="Product Description"></textarea>
        <input type="text" id="product-images" placeholder="Product Images URLs (comma separated)">
        <input type="text" id="product-slug" placeholder="Product Slug">
        <input type="text" id="product-category-id" placeholder="Category ID">
        <button type="submit" id="add-product">Add Product</button>
      </form>
      <button id="get-products">Get Products</button>
      <div id="product-results"></div>
    </section>
    <hr>

    <!-- Section for Distributors -->
    <section>
      <h2>Distributor Operations</h2>
      <form id="distributor-form">
        <input type="text" id="distributor-name" placeholder="Distributor Name">
        <input type="text" id="distributor-place" placeholder="Distributor Place">
        <button type="submit" id="add-distributor">Add Distributor</button>
      </form>
      <button id="get-distributors">Get Distributors</button>
      <div id="distributor-results"></div>
    </section>

  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="dashboard.js"></script>
</body>
</html>
