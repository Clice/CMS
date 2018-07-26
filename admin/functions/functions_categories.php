<?php

function insert_category() {
    global $connection;

    if (isset($_POST['submit'])) {
        $categoryTitle = $_POST['addCategoryTitle'];

        if ($categoryTitle == "" || empty($categoryTitle)) {
            echo "This field should not be empty";
        } else {
            $query = "INSERT INTO categories (categoryTitle) ";
            $query .= "VALUE ('{$categoryTitle}')";
            $create_category_query = mysqli_query($connection, $query);
            confirmQuery($create_category_query);
        }
    }
}

function update_category() {
    global $connection;

    if (isset($_GET['edit'])) {
        $auxCategoryId = $_GET['edit'];
        $query = "SELECT * FROM categories WHERE categoryId = $auxCategoryId";
        $select_categories_id = mysqli_query($connection, $query);
        confirmQuery($select_categories_id);

        while ($row = mysqli_fetch_assoc($select_categories_id)) {
            $categoryId = $row['categoryId'];
            $categoryTitle = $row['categoryTitle'];
            ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="categoryTitle">Edit Category</label>
                    <input type="hidden" name="categoryId" value="<?php
                    if (isset($categoryId)) {
                        echo $categoryId;
                    }
                    ?>">
                    <input type="text" class="form-control" name="editCategoryTitle" value="<?php
                    if (isset($categoryTitle)) {
                        echo $categoryTitle;
                    }
                    ?>">
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="update" value="Update Categoty">
                </div>
            </form>
            <?php
        }

        if (isset($_POST['update'])) {
            $editCategoryTitle = $_POST['editCategoryTitle'];
            $query = "UPDATE categories SET categoryTitle = '$editCategoryTitle' WHERE categoryId = $auxCategoryId";
            $update_category_title = mysqli_query($connection, $query);
            confirmQuery($update_category_title);

            if (!$update_category_title) {
                echo "Error updating the category title.";
            } else {
                header("Location: categories.php");
            }
        }
    }
}

function find_all_categories() {
    global $connection;
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);
    confirmQuery($select_categories);

    while ($row = mysqli_fetch_assoc($select_categories)) {
        $categoryId = $row['categoryId'];
        $categoryTitle = $row['categoryTitle'];
        ?>
        <tr>
            <td><?php echo $categoryId; ?></td>
            <td><?php echo $categoryTitle; ?></td>
            <td><a href="../views/categories.php?edit=<?php echo $categoryId; ?>">Edit</a></td>
            <td><a href="../views/categories.php?delete=<?php echo $categoryId; ?>">Delete</a></td>
        </tr>
        <?php
    }
}

function select_categories($postCategoryId) {
    global $connection;
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);
    confirmQuery($select_categories);

    while ($row = mysqli_fetch_assoc($select_categories)) {
        $categoryId = $row['categoryId'];
        $categoryTitle = $row['categoryTitle'];
        ?>
        <option value="<?php echo $categoryId; ?>" <?php if ($categoryId == $postCategoryId) { echo 'selected'; } ?>><?php echo $categoryTitle; ?></option>
    <?php
    }
}

function find_category_by_id($categoryId) {
    global $connection;
    $query = "SELECT categoryTitle FROM categories WHERE categoryId = $categoryId";
    $find_category_by_id = mysqli_query($connection, $query);
    confirmQuery($find_category_by_id);

    while ($row = mysqli_fetch_assoc($find_category_by_id)) {
        $categoryTitle = $row['categoryTitle'];
    }

    return $categoryTitle;
}

function delete_category() {
    global $connection;

    if (isset($_GET['delete'])) {
        $auxCategoryId = $_GET['delete'];
        $query = "DELETE FROM categories WHERE categoryId = $auxCategoryId";
        $query_delete = mysqli_query($connection, $query);
        confirmQuery($query_delete);
        header("Location: categories.php");
    }
}

function num_categories() {
    global $connection;
    $query = "SELECT * FROM categories";
    $select_all_categories = mysqli_query($connection, $query);
    confirmQuery($select_all_categories);
    $num_categories = mysqli_num_rows($select_all_categories);
    return $num_categories;
}
