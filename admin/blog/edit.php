<?php
//Get category data
$stmt = $db->prepare("SELECT * FROM categories");
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_OBJ);

//Get blog data
$id = $_GET['id'];
$stmt = $db->prepare("SELECT * FROM blogs WHERE id=$id");
$stmt->execute();
$blog = $stmt->fetchObject();

// Update Blog
$titleErr = '';
$categoryErr = '';
$contentErr = '';
$imageErr = '';

if (isset($_POST['blogUpdateBtn'])) {
    $title = $_POST['title'];
    $category_id = $_POST['category_id'];
    $content = $_POST['content'];
    $userID = $_SESSION['user']->id;
    // $created_at = date('Y-m-d H:i:s');

    $imageName = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];
    $imageType = $_FILES['image']['type'];

    if ($title === '') {
        $titleErr = "The title field is required!";
    } elseif ($category_id === '') {
        $categoryErr = "The category field is required!";
    } elseif ($content === '') {
        $contentErr = "The content field is required!";
    } else {
        if ($imageName === '') {
            $stmt = $db->prepare("UPDATE blogs SET title='$title', category_id=$category_id, content='$content' WHERE id=$id");
        } else {
            unlink("../assets/blog-images/$blog->image");

            $imageName = uniqid() . '_' . $imageName;

            if (in_array($imageType, ['image/png', 'image/jpg', 'image/jpeg'])) {
                move_uploaded_file($imageTmpName, "../assets/blog-images/$imageName");
            }

            $stmt = $db->prepare("UPDATE blogs SET title='$title', category_id=$category_id, content='$content', image='$imageName' WHERE id=$id");
        }

        $result = $stmt->execute();
        if ($result) {
            echo "<script>sweetAlert('Blog Updated.', 'blogs')</script>";
        }
    }
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Blog Update Form</h6>
                    <a href="index.php?page=blogs" class="btn btn-secondary btn-sm">
                        <i class="fas fa-angle-double-left"></i>
                        Back
                    </a>
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-2">
                            <label for="">Title</label>
                            <input type="text" name="title" class="form-control" value="<?php echo $blog->title ?>" placeholder="Enter title">
                            <span class="text-danger"><?php echo $titleErr ?></span>
                        </div>

                        <div class="mb-2">
                            <label for="">Category</label>
                            <select name="category_id" id="" class="form-control">
                                <option value="">Select Category</option>
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?php echo $category->id ?>" <?php if ($category->id === $blog->category_id) {
                                                                                    echo "selected";
                                                                                } ?>><?php echo $category->name ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="text-danger"><?php echo $categoryErr ?></span>
                        </div>

                        <div class="mb-2">
                            <label for="">Content</label>
                            <textarea name="content" id="" cols="30" rows="5" class="form-control" placeholder="Enter content"><?php echo $blog->content ?></textarea>
                            <span class="text-danger"><?php echo $contentErr ?></span>
                        </div>

                        <div class="mb-2">
                            <label for="">Image</label>
                            <input type="file" name="image" class="form-control">
                            <img src="../assets/blog-images/<?php echo $blog->image ?>" class="my-2" alt="" style="width: 100px;">
                        </div>
                        <button name="blogUpdateBtn" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>