<?php
if (isset($_GET['p_id'])) {
    $the_post_id = escape($_GET['p_id']);

}
$query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
$select_posts_id = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_posts_id)) {
    $data['post_id'] = escape($row['post_id']);
    $data['post_author'] = escape($row['post_author']);
    $data['post_title'] = escape($row['post_title']);
    $data['post_category_id'] = escape($row['post_category_id']);
    $data['post_status'] = escape($row['post_status']);
    $data['post_image'] = escape($row['post_image']);
    $data['post_content'] = escape($row['post_content']);
    $data['post_tags'] = escape($row['post_tags']);
    $data['post_comment_count'] = escape($row['post_comment_count']);
    $data['post_date'] = escape($row['post_date']);
}
foreach ($data as $dataKey => $dataVal) {
    $data[$dataKey] = mysqli_real_escape_string($connection, $dataVal);
    $data[$dataKey] = strip_tags($dataVal);
    $data[$dataKey] = htmlspecialchars($dataVal);

}
//LOOK INTO THIS SECTION ERROR LATER

if (isset($_POST['update_post'])) {

    $post_author = escape($_POST['post_author']);
    $post_title = escape($_POST['post_title']);
    $post_category_id = escape($_POST['post_category']);
    $post_status = escape($_POST['post_status']);
    $post_image = escape($_FILES['image']['name']);
    $post_image_temp = escape($_FILES['image']['tmp_name']);
    $post_content = escape($_POST['post_content']);
    $post_tags = escape($_POST['post_tags']);

    move_uploaded_file($post_image_temp, "../images/$post_image");

    if (empty($post_image)) {

        $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
        $select_image = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($select_image)) {

            $post_image = escape($row['post_image']);

        }

    }
    $post_title = mysqli_real_escape_string($connection, $post_title);

    $query = "UPDATE posts SET ";
    $query .= "post_title  = '{$post_title}', ";
    $query .= "post_author  = '{$post_author}', ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_date   =  now(), ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_tags   = '{$post_tags}', ";
    $query .= "post_content= '{$post_content}', ";
    $query .= "post_image  = '{$post_image}' ";
    $query .= "WHERE post_id = {$the_post_id} ";

    $update_post = mysqli_query($connection, $query);

    confirmQuery($update_post);
    echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$the_post_id}'>View post</a> or <a href='posts.php'>Edit more post</a> </p>";

}
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_title"> Post Title</label>
        <input value="<?php echo $data['post_title']; ?>" type="text" class="form-control" name="post_title">
    </div>

    <div class="form-group">
       <select name="post_category" id="post_category">

            <?php

$query = "SELECT * FROM categories";

$select_categories = mysqli_query($connection, $query);

confirmQuery($select_categories);

while ($row = mysqli_fetch_assoc($select_categories)) {
    $cat_id = escape($row['cat_id']);
    $cat_title = escape($row['cat_title']);

    if ($cat_id == $post_category_id) {

        echo "<option selected value='{$cat_id}'>{$cat_title}</option>";

    } else {

        echo "<option value='{$cat_id}'>{$cat_title}</option>";

    }

}

?>

        </select>
    </div>

    <div class="form-group">
        <label for="title">Post Author</label>
        <input value="<?php echo $data['post_author']; ?>" type="text" class="form-control" name="post_author" >
    </div>

    <div class="form-group">
        <select name="post_status" id="">
            <option value='<?php echo $data['post_status']; ?>'><?php echo $data['post_status']; ?></option>
            <?php
if ($data['post_status'] == 'published') {
    echo "<option value='draft'>Draft</option>";

} else {
    echo "<option value='published'>Publish</option>";
}

?>

        </select>
    </div>

    <div class="form-group">
        <img width="100" src="../images/<?php echo $data['post_image']; ?>" alt="">
        <input type="file" name="image">


    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $data['post_tags']; ?>" type="text" class="form-control" name="post_tags" >
    </div>

    <div class="form-group">
        <label for="summernote">Post Content</label>
        <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10"><?php echo $data['post_content']; ?></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
    </div>

</form>
