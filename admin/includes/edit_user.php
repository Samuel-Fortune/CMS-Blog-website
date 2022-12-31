<?php
if (isset($_GET['edit_user'])) {

    $the_user_id = escape($_GET['edit_user']);

    $query = "SELECT * FROM users WHERE user_id=$the_user_id";
    $select_users_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_users_query)) {
        $user_id = escape($row['user_id']);
        $username = escape($row['username']);
        $user_password = escape($row['user_password']);
        $user_firstname = escape($row['user_firstname']);
        $user_lastname = escape($row['user_lastname']);
        $user_email = escape($row['user_email']);
        $user_role = escape($row['user_role']);
    }
} // Post request to update user
if (isset($_POST['edit_user'])) {

    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname = escape($_POST['user_lastname']);
    $user_role = escape($_POST['user_role']);
    $username = escape($_POST['username']);
    $user_email = escape($_POST['user_email']);
    $user_password = escape($_POST['user_password']);
    $post_date = escape(date('d-m-y'));

    //$user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));

    if (!empty($user_password)) {

        $query_password = "SELECT user_password FROM users WHERE user_id = $user_id";
        $get_user_query = mysqli_query($connection, $query_password);
        confirmQuery($get_user_query);

        $row = mysqli_fetch_array($get_user_query);
        $db_user_password = escape($row['user_password']);

    }

    if ($db_user_password != $user_password) {
        $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));

    }

    $query = "UPDATE users SET ";
    $query .= "user_firstname  = '{$user_firstname}', ";
    $query .= "user_lastname  = '{$user_lastname}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "username   =  '{$username}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_password  = '{$hashed_password}' ";
    $query .= "WHERE user_id = {$the_user_id} ";

    $edit_user_query = mysqli_query($connection, $query);

    confirmQuery($edit_user_query);
    echo "User Updated" . "<a href='users.php'>View Users?</a>";
} else {
    //header("Location: index.php");
}

?>

<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" value="<?php echo $user_firstname ?>" class="form-control" name="user_firstname" >
    </div>

    <div class="form-group">
        <label for="post_status">Lastname</label>
        <input type="text" value="<?php echo $user_lastname ?>" class="form-control" name="user_lastname" >
    </div>

    <div class="form-group">
       <select name="user_role" id="user_role">

            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>

            <?php

if ($user_role == 'admin') {
    echo "<option value='subscriber'>subscriber</option>";

} else {
    echo "<option value='admin'>admin</option>";
}

?>



        </select>
    </div>

    <!--<div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file"  name="image" >
    </div>-->

    <div class="form-group">
        <label for="post_tags">Username</label>
        <input type="text" value="<?php echo $username ?>" class="form-control" name="username" >
    </div>

    <div class="form-group">
        <label for="post_content">Email</label>
        <input type="email" value="<?php echo $user_email ?>" name="user_email" class="form-control" >
    </div>

    <div class="form-group">
        <label for="post_content">Password</label>
        <input autocomplete="off" type="password" name="user_password" class="form-control" >
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Update user">
    </div>

</form>
