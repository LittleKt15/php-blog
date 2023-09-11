<?php
// Select
$sql = "SELECT * FROM categories";
$stmt = $db->prepare($sql);
$result = $stmt->execute();

$categories = $stmt->fetchAll(PDO::FETCH_OBJ);

// Delete
if (isset($_POST['categoryDeleteBtn'])) {
    $id = $_POST['id'];
    $stmt = $db->prepare("DELETE FROM categories WHERE id=$id");
    $stmt->execute();

    echo "<script>sweetAlert('Category Deleted.', 'categories')</script>";
}
?>
<div class="container-fluid">
    <div class="row">
        <!-- DataTales Example -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
                    <a href="index.php?page=categories-create" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add New
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($categories as $category) :
                                ?>
                                    <tr>
                                        <td><?php echo $category->id ?></td>
                                        <td><?php echo $category->name ?></td>
                                        <td>
                                            <form action="" method="post">
                                                <input type="hidden" name="id" value="<?php echo $category->id ?>">
                                                <a href="index.php?page=categories-edit&id=<?php echo $category->id ?>" class="btn btn-success btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button name="categoryDeleteBtn" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                endforeach
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>