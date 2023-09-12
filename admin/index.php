<?php
ob_start();
session_start();
if (!isset($_SESSION['user'])) {
    header('location:../index.php');
} else {
    if ($_SESSION['user']->role === 'user') {
        header('location:../index.php');
    }
}

include_once('layout/header.php');

function getRowCount($table)
{
    global $db;
    $stmt = $db->prepare("SELECT COUNT(*) as count FROM $table");
    $stmt->execute();
    $data = $stmt->fetchObject();
    return $data;
}

// Get category count
$category = getRowCount('categories');

// Get blog count
$blog = getRowCount('blogs');

// Get user count
$user = getRowCount('users');

// Get comment count
$comment = getRowCount('comments');
?>

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php
    include_once('layout/sidebar.php');
    ?>
    <!-- End of Sidebar -->

    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php
            include_once('layout/top-bar.php');
            ?>
            <!-- End of Topbar -->

            <?php
            if ($_SERVER['QUERY_STRING']) :
                switch ($_REQUEST['page']) {
                        // category page
                    case 'categories':
                        require_once('category/index.php');
                        break;
                    case 'categories-create':
                        require_once('category/create.php');
                        break;
                    case 'categories-edit':
                        require_once('category/edit.php');
                        break;
                        // blog
                    case 'blogs':
                        require_once('blog/index.php');
                        break;
                    case 'blogs-create':
                        require_once('blog/create.php');
                        break;
                    case 'blogs-edit':
                        require_once('blog/edit.php');
                        break;
                    case 'blogs-comments':
                        require_once('blog/comments.php');
                        break;
                        // user page
                    case 'users':
                        require_once('user/index.php');
                        break;
                    case 'users-create':
                        require_once('user/create.php');
                        break;
                    case 'users-edit':
                        require_once('user/edit.php');
                        break;
                    case 'users-profile':
                        require_once('user/profile.php');
                        break;
                }
            else :
            ?>
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Categories</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $category->count ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Blogs</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $blog->count ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Users
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $user->count ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Comments</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $comment->count ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            endif
            ?>

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php
        include_once('layout/copyright.php');
        ?>
        <!-- End of Footer -->

    </div>

</div>
<!-- End of Page Wrapper -->

<?php
include_once('layout/footer.php');
?>