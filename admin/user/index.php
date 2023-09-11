<?php
// Select
$stmt = $db->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_OBJ);

// Delete
if (isset($_POST['userDeleteBtn'])) {
    $id = $_POST['id'];
    $stmt = $db->prepare("DELETE FROM users WHERE id=$id");
    $result = $stmt->execute();
    if ($result) {
        echo "<script>sweetAlert('User Deleted.', 'users')</script>";
    }
}
?>
<div class="container-fluid">
    <div class="row">
        <!-- DataTales Example -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">User List</h6>
                    <a href="index.php?page=users-create" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i>
                        Add New
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($users as $user) :
                                ?>
                                    <tr>
                                        <td><?php echo $user->id ?></td>
                                        <td><?php echo $user->name ?></td>
                                        <td><?php echo $user->email ?></td>
                                        <td><?php echo $user->role ?></td>
                                        <td>
                                            <form action="" method="post">
                                                <input type="hidden" name="id" value="<?php echo $user->id ?>">
                                                <a href="index.php?page=users-edit&id=<?php echo $user->id ?>" class="btn btn-success btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button name="userDeleteBtn" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')">
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