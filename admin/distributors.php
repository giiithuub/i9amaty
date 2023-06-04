<?php
session_start();
include('../middleware/adminMiddleware.php');
include('includes/header.php');
include('../config/db_config.php');

// Check if the delete distributor button is clicked
if (isset($_POST['delete_distributor_btn'])) {
    $distributorId = $_POST['delete_distributor_btn'];
    $result = deleteDistributor($distributorId);
    if ($result) {
        $_SESSION['message'] = "Distributor deleted successfully.";
    } else {
        $_SESSION['message'] = "Failed to delete distributor.";
    }
    header('Location: distributors.php');
    exit();
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
                    <h4>Distributors</h4>
                </div>
                <div class="card-body" id="distributors_table">
                    <?php if (isset($_SESSION['message'])) : ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $_SESSION['message']; ?>
                        </div>
                        <?php unset($_SESSION['message']); ?>
                    <?php endif; ?>
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr class="table-info">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Place</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $distributors = getDistributors();

                            if (mysqli_num_rows($distributors)) {
                                while ($row = mysqli_fetch_assoc($distributors)) {
                                    ?>
                                    <tr>
                                        <td><?= $row['id']; ?></td>
                                        <td><?= $row['name']; ?></td>
                                        <td><?= $row['place']; ?></td>
                                        <td>
                                            <a href="edit-distributor.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                        </td>
                                        <td>
                                            <form method="POST" onsubmit="return confirm('Are you sure you want to delete this distributor?');">
                                                <button type="submit" class="btn btn-danger btn-sm" name="delete_distributor_btn" value="<?= $row['id']; ?>">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='5'>No distributors found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
