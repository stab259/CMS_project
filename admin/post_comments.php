<?php include "includes/admin_header.php"; ?>

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
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>
                </div>
            </div>
            <!-- /.row -->
            <?php
            if (isset($_GET['id'])) {
                $the_comment_post_id = $_GET['id'];
            }

            if (isset($_POST['checkBoxArray'])) {

                foreach ($_POST['checkBoxArray'] as $commentValueId) {
                    $bulk_options = $_POST['bulk_options'];
                    switch ($bulk_options) {
                        case 'approved':
                            $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$commentValueId} ";
                            $approve_comment_query = mysqli_query($connection, $query);
                            confirmQuery($approve_comment_query);
                            header("Location: post_comments.php?id=$the_comment_post_id");
                            break;
                        case 'unapproved':
                            $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$commentValueId} ";
                            $unapprove_comment_query = mysqli_query($connection, $query);
                            confirmQuery($unapprove_comment_query);
                            header("Location: post_comments.php?id=$the_comment_post_id");
                            break;
                        case 'delete':
                            $query = "DELETE FROM comments WHERE comment_id = {$commentValueId} ";
                            $delete_query = mysqli_query($connection, $query);
                            confirmQuery($delete_query);
                            header("Location: post_comments.php?id=$the_comment_post_id");
                    }
                }
            }
            ?>

            <form action="" method="POST">
                <table class="table table-bordered table-hover">
                    <div id="bulkOptionContainer" class="col-xs-4">
                        <select name="bulk_options" id="" class="form-control">
                            <option value="">Select Options</option>
                            <option value="approved">Approve</option>
                            <option value="unapproved">Unapprove</option>
                            <option value="delete">Delete</option>
                        </select>
                    </div>
                    <div class="col-xs-4">
                        <input type="submit" name="submit" class="btn btn-success" value="Apply">
                    </div>
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="selectAllBoxes"></th>
                            <th>Id</th>
                            <th>Author</th>
                            <th>Comment</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>In Response to</th>
                            <th>Date</th>
                            <th>Approve</th>
                            <th>Unapprove</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $query = "SELECT * FROM comments WHERE comment_post_id =" . mysqli_escape_string($connection, $_GET['id']) . " ";
                        $select_comments = mysqli_query($connection, $query);

                        while ($row = mysqli_fetch_assoc($select_comments)) {
                            $comment_id = $row['comment_id'];
                            $comment_post_id = $row['comment_post_id'];
                            $comment_author = $row['comment_author'];
                            $comment_email = $row['comment_email'];
                            $comment_content = $row['comment_content'];
                            $comment_status = $row['comment_status'];
                            $comment_date = $row['comment_date'];

                            echo "<tr>";
                        ?>

                            <td><input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value=<?php echo $comment_id; ?>></td>

                        <?php
                            echo "<td>$comment_id</td>";
                            echo "<td>$comment_author</td>";
                            echo "<td>$comment_content</td>";
                            echo "<td>$comment_email</td>";
                            echo "<td>$comment_status</td>";

                            $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
                            $select_post_id_query = mysqli_query($connection, $query);

                            while ($row = mysqli_fetch_assoc($select_post_id_query)) {
                                $post_id = $row['post_id'];
                                $post_title = $row['post_title'];
                                echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                            }

                            echo "<td>$comment_date</td>";
                            echo "<td><a href='post_comments.php?id=$the_comment_post_id&approve=$comment_id'>Approve</a></td>";
                            echo "<td><a href='post_comments.php?id=$the_comment_post_id&unapprove=$comment_id'>Unapprove</a></td>";
                            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?');\" href='post_comments.php?id=$the_comment_post_id&delete=$comment_id'>Delete</a></td>";
                            echo "</tr>";
                        }

                        ?>

                    </tbody>
                </table>
            </form>


            <?php

            if (isset($_GET['approve'])) {
                $the_comment_id = $_GET['approve'];

                $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$the_comment_id} ";
                $approve_comment_query = mysqli_query($connection, $query);

                confirmQuery($approve_comment_query);
                header("Location: post_comments.php?id=$the_comment_post_id");
            }

            if (isset($_GET['unapprove'])) {
                $the_comment_id = $_GET['unapprove'];

                $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$the_comment_id} ";
                $unapprove_comment_query = mysqli_query($connection, $query);

                confirmQuery($unapprove_comment_query);
                header("Location: post_comments.php?id=$the_comment_post_id");
            }

            if (isset($_GET['delete'])) {
                $the_comment_id = $_GET['delete'];

                $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id} ";
                $delete_query = mysqli_query($connection, $query);

                confirmQuery($delete_query);
                header("Location: post_comments.php?id=$the_comment_post_id");
            }

            ?>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php"; ?>