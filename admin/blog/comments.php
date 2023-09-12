<?php
$id = $_GET['id'];
$commentStmt = $db->prepare("SELECT comments.id, comments.text, comments.created_at, users.name FROM comments INNER JOIN users ON comments.user_id = users.id WHERE blog_id=$id");
$commentStmt->execute();
$comments = $commentStmt->fetchAll(PDO::FETCH_OBJ);
?>
<div class="container-fluid">
    <div class="row">
        <!-- DataTales Example -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Comment List</h6>
                    <a href="index.php?page=blogs" class="btn btn-secondary btn-sm">
                        <i class="fas fa-angle-double-left"></i>
                        Back
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <?php if (count($comments) >= 1) : ?>
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Text</th>
                                        <th>User</th>
                                        <th>Created at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($comments as $comment) :
                                    ?>
                                        <tr>
                                            <td><?php echo $comment->id ?></td>
                                            <td><?php echo $comment->text ?></td>
                                            <td><?php echo $comment->name ?></td>
                                            <td><?php echo $comment->created_at ?></td>
                                            <td>
                                                <form action="" method="post">
                                                    <input type="hidden" name="id" value="<?php echo $comment->id ?>">
                                                    <a href="index.php?page=blogs-edit&id=<?php echo $comment->id ?>" class="btn btn-success btn-sm" title="edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button name="blogDeleteBtn" class="btn btn-danger btn-sm" title="delete" onclick="return confirm('Are you sure you want to delete?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    <a href="index.php?page=blogs-comments&id=<?php echo $comment->id ?>" class="btn btn-info btn-sm" title="comment">
                                                        <i class="fas fa-comment-dots"></i>
                                                    </a>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach
                                    ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <p class="text-danger">There is no comment for this blog.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>