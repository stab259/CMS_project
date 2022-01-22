<div class="col-md-4">



    <!-- Blog Search Well -->
    <div class="well">
        <form action="search.php" method="post">
            <h4>Blog Search</h4>
            <div class="input-group">
                <input type="text" name="search" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form><!-- search form  -->
        <!-- /.input-group -->
    </div>

    <!-- Login Well -->
    <div class="well">
        <form action="includes/login.php" method="post">
            <h4>Login</h4>
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Enter Username">
            </div>
            <div class="input-group">
                <input type="password" name="password" class="form-control" placeholder="Enter Password">
                <span class="input-group-btn">
                    <button class="btn btn-primary" name="login" type="submit">Submit</button>
                </span>
            </div>
        </form><!-- login form  -->
        <!-- /.form/input-group -->
    </div>



    <!-- Blog Categories Well -->
    <div class="well">

        <?php
        $query = "SELECT * FROM categories"; // LIMIT 3
        $select_categories_sidebar = mysqli_query($connection, $query);
        ?>

        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">

                    <?php
                    while ($row = mysqli_fetch_assoc($select_categories_sidebar)) {
                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];

                        echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                    }
                    ?>

                </ul>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "widget.php" ?>

</div>