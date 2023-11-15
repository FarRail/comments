<?php 
include_once "header.php";
?>
<h1>Insert a comment</h1>
<form method="post" action="backend/comments.inv.php">
    <input type="hidden" name="date">
    <input type="hidden" name="time">
    <textarea name="message" cols="30" rows="10"></textarea><br>
    <button type="submit" name="comSubmit">Submit</button>
</form>