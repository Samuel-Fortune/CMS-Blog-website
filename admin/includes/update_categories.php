<form action="" method="post">
                                <div class="form-group">
                                    <label for="cat_title">Edit Category</label>



                                    <?php

if (isset($_GET['update'])) {
    $cat_id_update = escape($_GET['update']);

    $query = "SELECT * FROM categories WHERE cat_id = {$cat_id_update}";

    $update_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($update_query)) {
        $cat_id = escape($row['cat_id']);
        $cat_title = escape($row['cat_title']);

        ?>





                                     <input value="<?php if (isset($cat_title)) {echo $cat_title;}?>" class="form-control" type="text" name="cat_title">




                                    <?php }}?>

                                    <?php //UPDATE QUERY
if (isset($_POST['update_category'])) {
    $the_cat_title = escape($_POST['cat_title']);

    $query = "UPDATE categories SET cat_title = '{$the_cat_title}' WHERE cat_id = {$cat_id} ";

    $update_query = mysqli_query($connection, $query);

    if (!$update_query) {
        die("QUERY FAILED" . mysqli_error($connection));

    }

}

?>

                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="update_category" value="Update category">
                                </div>

                            </form>