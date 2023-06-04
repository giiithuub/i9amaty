
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary ">
    <div class="container-fluid">
        <a class="navbar-brand m-0" href="#">
            <span class="ms-1 font-weight-bold text-white">Admin Dashboard</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white <?= $page == 'products.php' || $page == 'add-product.php' ? 'active' : ''; ?>" href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="material-icons opacity-10">shopping_cart</i>
                        <span class="nav-link-text ms-1">Products</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="productsDropdown">
                        <li><a class="dropdown-item <?= $page == 'products.php' ? 'active' : ''; ?>" href="products.php">All Products</a></li>
                        <li><a class="dropdown-item <?= $page == 'add-product.php' ? 'active' : ''; ?>" href="add-product.php">Add Product</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white <?= $page == 'categories.php' || $page == 'add-category.php' ? 'active' : ''; ?>" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="material-icons opacity-10">category</i>
                        <span class="nav-link-text ms-1">Categories</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
                        <li><a class="dropdown-item <?= $page == 'categories.php' ? 'active' : ''; ?>" href="categories.php">All Categories</a></li>
                        <li><a class="dropdown-item <?= $page == 'add-category.php' ? 'active' : ''; ?>" href="add-category.php">Add Category</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white <?= $page == 'distributors.php' || $page == 'add-distributor.php' ? 'active' : ''; ?>" href="#" id="distributorsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="material-icons opacity-10">people</i>
                        <span class="nav-link-text ms-1">Distributors</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="distributorsDropdown">
                        <li><a class="dropdown-item <?= $page == 'distributors.php' ? 'active' : ''; ?>" href="distributors.php">All Distributors</a></li>
                        <li><a class="dropdown-item <?= $page == 'add-distributor.php' ? 'active' : ''; ?>" href="add-distributor.php">Add Distributor</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white <?= $page == 'product-distributors.php' || $page == 'add-product-distributor.php' ? 'active' : ''; ?>" href="#" id="productDistributorsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="material-icons opacity-10">assignment</i>
                        <span class="nav-link-text ms-1">Product Distributors</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="productDistributorsDropdown">
                        <li><a class="dropdown-item <?= $page == 'product-distributors.php' ? 'active' : ''; ?>" href="product-distributors.php">All Product Distributors</a></li>
                        <li><a class="dropdown-item <?= $page == 'add-product-distributor.php' ? 'active' : ''; ?>" href="add-product-distributor.php">Add Product Distributor</a></li>
                    </ul>
                </li>


            </ul>
        </div>
        <div class="d-flex">
            <a class="btn bg-gradient-primary mt-2 w-100" href="#">Logout</a>
        </div>
    </div>
</nav>
