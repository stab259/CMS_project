<?php include "includes/admin_header.php"; ?>
<?php

if (isset($_SESSION['username'])) {
    $the_username = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username = '{$the_username}' ";
    $select_user_profile_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_user_profile_query)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }

    if (isset($_POST['edit_user'])) {
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];


        $query = "UPDATE users SET ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "username = '{$username}', ";
        $query .= "user_email = '{$user_email}' ";

        if (!empty($user_password)) {
            $query_password = "SELECT user_password FROM users WHERE username = '{$the_username}' ";
            $get_user_query = mysqli_query($connection, $query_password);
            confirmQuery($get_user_query);

            $row = mysqli_fetch_array($get_user_query);
            $db_user_password = $row['user_password'];

            if ($user_password != $db_user_password) {
                echo $user_password;
                echo $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));
                $query .= ", user_password = '{$hashed_password}' ";
            }
        }

        $query .= "WHERE username = '{$the_username}' ";
        $edit_user_query = mysqli_query($connection, $query);
        confirmQuery($edit_user_query);
    }
}


?>


<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        WELCOME to admin
                        <small>Author</small>
                    </h1>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="user_firstname">First Name</label>
                        <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
                    </div>
                    <div class="form-group">
                        <label for="user_lastname">Last Name</label>
                        <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
                    </div>
                    <div class="form-group">
                        <label for="user_email">Email</label>
                        <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
                    </div>
                    <div class="form-group">
                        <label for="user_password">Password</label>
                        <input autocomplete="off" type="password" class="form-control" name="user_password">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="edit_user" value="Update Profile">
                    </div>
                </form>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php"; ?>