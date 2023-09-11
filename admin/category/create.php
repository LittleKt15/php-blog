<?php
$nameErr = "";
if (isset($_POST['categoryCreateBtn'])) {
    $name = $_POST['name'];

    if ($name === '') {
        $nameErr = "The name field is required!";
    } else {
        $stmt = $db->prepare("INSERT INTO categories (name) VALUES ('$name')");
        $stmt->execute();

        echo "<script>sweetAlert('Category Created.', 'categories')</script>";
    }
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Category Create Form</h6>
                    <a href="index.php?page=categories" class="btn btn-secondary btn-sm">
                        <i class="fas fa-angle-double-left"></i>
                        Back
                    </a>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-2">
                            <label for="">Category Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter category name">
                            <span class="text-danger"><?php echo $nameErr ?></span>
                        </div>
                        <button name="categoryCreateBtn" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>