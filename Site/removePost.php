<?php
//File called when admin removes post
include("connection.php");

//Prepared SQL statement used to prevent SQL injection
$postID = mysqli_real_escape_string($db,$_POST['deletePost']);
$sql = "DELETE FROM bookClub WHERE postID = ?;";
$stmt = mysqli_stmt_init($db);

if(!mysqli_stmt_prepare($stmt,$sql)){
    echo "Error, post not deleted";
    } 
else {
    mysqli_stmt_bind_param($stmt,"s",$postID);
    mysqli_stmt_execute($stmt);
    header("Location: book-club.php");
}
?>