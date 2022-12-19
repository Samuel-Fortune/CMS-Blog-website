<?php
if (isset($_GET['p_id'])) {
    $the_post_id = $_GET['p_id'];

}
$query = "SELECT * FROM posts";
$select_posts_id = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_posts_id)) {
    $data['post_id'] = $row['post_id'];
    $data['post_author'] = $row['post_author'];
    $data['post_title'] = $row['post_title'];
    $data['post_category_id'] = $row['post_category_id'];
    $data['post_status'] = $row['post_status'];
    $data['post_image'] = $row['post_image'];
    $data['post_content'] = $row['post_content'];
    $data['post_tags'] = $row['post_tags'];
    $data['post_comment_count'] = $row['post_comment_count'];
    $data['post_date'] = $row['post_date'];
}
foreach ($data as $dataKey => $dataVal) {
    $data[$dataKey] = mysqli_real_escape_string($connection, $dataVal);
    $data[$dataKey] = strip_tags($dataVal);
    $data[$dataKey] = htmlspecialchars($dataVal);

}
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title"> Post Title</label>
        <input value="<?php echo $data['post_title']; ?>" type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="post-category">Post Category Id</label>
        <input value="<?php echo $data['post_category_id']; ?>" type="text" class="form-control" name="post_category_id">
    </div>

    <div class="form-group">
        <label for="title">Post Author</label>
        <input value="<?php echo $data['post_author']; ?>" type="text" class="form-control" name="author" >
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input value="<?php echo $data['post_status']; ?>" type="text" class="form-control" name="post_status" >
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input value="<?php echo $data['post_image']; ?>" type="file"  name="image" >
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $data['post_tags']; ?>" type="text" class="form-control" name="post_tags" >
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo $data['post_content']; ?></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>

</form>
