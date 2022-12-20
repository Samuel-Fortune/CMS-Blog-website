<?php

function confirmQuery($result)
{
    global $connection;
    if (!$result) {
        die("QUERY FAILED" . mysqli_error($connection));

    } 
}

function insert_categories()
{
    global $connection;
    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];
        $cat_title = strip_tags($cat_title);
        $cat_title = htmlspecialchars($cat_title);
        if ( preg_match("/^[a-zA-Z]+$/", $cat_title) )
        {
            $cat_title = preg_replace("#[^a-zA-Z]#", "", $cat_title);

            $cat_title = mysqli_real_escape_string($connection, $cat_title);
            if ($cat_title == "" || empty($cat_title)) {
                echo "The field should not be empty";
    
            } else {
                $query = "INSERT INTO categories(cat_title)";
                $query .= "VALUE('{$cat_title}')";
                $create_category_query = mysqli_query($connection, $query);
    
                if (!$create_category_query) {
                    die('QUERY FAILED' . mysqli_error($connection));
    
                }
            }
        }
        else 
        {
            die('Invalid Category Name entered');
        }

        

    }
}

function findAllcategories()
{
    global $connection;
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?update={$cat_id}'>Edit</a></td>";
        echo "</tr>";
    }

}

function deleteAllcategories()
{
    global $connection;
    if (isset($_GET['delete'])) {
        $cat_id_delete = $_GET['delete'];

        $query = "DELETE FROM categories WHERE cat_id = {$cat_id_delete}";

        $delete_query = mysqli_query($connection, $query);
        header("LOCATION: categories.php");

    }
}
