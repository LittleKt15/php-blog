<?php
// Get old category
$id = $_GET['id'];
$stmt = $db->prepare("SELECT * FROM categories WHERE id=$id");
$stmt->execute();
$category = $stmt->fetchObject();

// Update
$nameErr = "";
if (isset($_POST['categoryUpdateBtn'])) {
    $name = $_POST['name'];
    if ($name === '') {
        $nameErr = "The name field is required!";
    } else {
        $stmt = $db->prepare("UPDATE categories SET name='$name' WHERE id=$id");
        $stmt->execute();

        echo "<script>sweetAlert('Category Updated.', 'categories')</script>";
    }
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Category Edit Form</h6>
                    <a href="index.php?page=categories" class="btn btn-secondary btn-sm">
                        <i class="fas fa-angle-double-left"></i>
                        Back
                    </a>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-2">
                            <label for="">Category Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $category->name ?>" placeholder="Enter category name">
                            <span class="text-danger"><?php echo $nameErr ?></span>
                        </div>
                        <button name="categoryUpdateBtn" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>