<?php
//GET user
$id = $_GET['id'];
$stmt = $db->prepare("SELECT * FROM users WHERE id=$id");
$stmt->execute();
$user = $stmt->fetchObject();

$nameErr = '';
$emailErr = '';

if (isset($_POST['userUpdateBtn'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if ($name === '') {
        $nameErr = "The name field isrequired!";
    } elseif ($email === '') {
        $emailErr = 'The email field is required!';
    } else {
        if($password === ''){
            $stmt = $db->prepare("UPDATE users SET name='$name', email='$email', role='$role' WHERE id=$id");
        } else{
            $password = md5($password);
            $stmt = $db->prepare("UPDATE users SET name='$name', email='$email', password='$password', role='$role' WHERE id=$id");
        }
        $result = $stmt->execute();
        if ($result) {
            echo "<script>sweetAlert('User Updated.', 'users')</script>";
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
                    <h6 class="m-0 font-weight-bold text-primary">User Edit Form</h6>
                    <a href="index.php?page=users" class="btn btn-secondary btn-sm">
                        <i class="fas fa-angle-double-left"></i>
                        Back
                    </a>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-2">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $user->name ?>" placeholder="Enter username">
                            <span class="text-danger"><?php echo $nameErr ?></span>
                        </div>

                        <div class="mb-2">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $user->email ?>" placeholder="Enter email">
                            <span class="text-danger"><?php echo $emailErr ?></span>
                        </div>

                        <div class="mb-2">
                            <label for="">Role</label>
                            <select name="role" id="" class="form-control">
                                <option value="admin" <?php if ($user->role  === 'admin') : ?> selected <?php endif ?>>Admin</option>
                                <option value="user" <?php if ($user->role  === 'user') : ?> selected <?php endif ?>>User</option>
                            </select>
                        </div>

                        <div class="mb-2">
                            <label for="">Password</label>
                            <input type="checkbox" onclick="showPassowrdInput()" id="checkbox">
                            <input type="password" id="password-input" name="password" class="form-control" placeholder="Enter password" style="display:none">
                        </div>
                        <button name="userUpdateBtn" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showPasswordInput() {
        let checkbox = document.getElementById('checkbox');
        let passwordInput = document.getElementById('password-input');
        if (checkbox.checked) {
            passwordInput.style.display = 'block';
        } else {
            passwordInput.style.display = 'none';
        }
    }

    // Add an event listener to the checkbox to trigger the function
    document.getElementById('checkbox').addEventListener('change', showPasswordInput);
</script>