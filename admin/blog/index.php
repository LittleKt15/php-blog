<?php
//SELECT
$stmt = $db->prepare("SELECT blogs.id, blogs.title, blogs.content, blogs.image, blogs.created_at, categories.name as category_name, users.name as user_name FROM blogs INNER JOIN categories ON blogs.category_id = categories.id INNER JOIN users ON blogs.user_id = users.id");
$result = $stmt->execute();
$blogs = $stmt->fetchAll(PDO::FETCH_OBJ);

// DELETE
if (isset($_POST['blogDeleteBtn'])) {
    $id = $_POST['id'];

    $imageStmt = $db->prepare("SELECT image FROM blogs WHERE id=$id");
    $imageStmt->execute();
    $blog = $imageStmt->fetchObject();

    $stmt = $db->prepare("DELETE FROM blogs WHERE id=$id");
    $result = $stmt->execute();

    if ($result) {
        unlink("../assets/blog-images/$blog->image");
        echo "<script>sweetAlert('Blog Deleted.', 'blogs')</script>";
    }
}
?>
<div class="container-fluid">
    <div class="row">
        <!-- DataTales Example -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Blog List</h6>
                    <a href="index.php?page=blogs-create" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add New
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Category</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Author</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($blogs as $blog) :
                                ?>
                                    <tr>
                                        <td><?php echo $blog->id ?></td>
                                        <td>
                                            <img src="../assets/blog-images/<?php echo $blog->image ?>" style="width: 100px;" alt="">
                                        </td>
                                        <td><?php echo $blog->category_name ?></td>
                                        <td><?php echo $blog->title ?></td>
                                        <td>
                                            <div style="max-width: 300px; max-height: 200px; overflow: auto;">
                                                <?php echo $blog->content ?>
                                            </div>
                                        </td>
                                        <td><?php echo $blog->user_name ?></td>
                                        <td><?php echo $blog->created_at ?></td>
                                        <td>
                                            <form action="" method="post">
                                                <input type="hidden" name="id" value="<?php echo $blog->id ?>">
                                                <a href="index.php?page=blogs-edit&id=<?php echo $blog->id ?>" class="btn btn-success btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button name="blogDeleteBtn" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')">
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