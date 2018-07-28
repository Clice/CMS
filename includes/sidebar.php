<!-- Sidebar -->
<div class="col-md-4">

    <!-- Search -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input type="text" class="form-control" name="search">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
    </div>

    <!-- Login -->
    <div class="well">
        <h4>Login</h4>
        <form action="includes/login.php" method="post">
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    if (isset($_GET['msg'])) {
                        echo $_GET['msg'];
                    }
                    ?>
                    <div class="form-group">
                        <input type="text" class="form-control" name="userName" placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="userPassword" placeholder="Enter Password">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="login" value="Login">
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Categories -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <?php
                    $query = "SELECT * FROM categories";

                    $select_all_categories_query = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                        $categoryId = $row['categoryId'];
                        $categoryTitle = $row['categoryTitle'];
                        ?>
                        <li><a href="category.php?id=<?php echo $categoryId; ?>"><?php echo $categoryTitle; ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>

    <?php include "widget.php" ?>

</div>