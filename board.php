<?php 
include_once "header.php";
include_once "backend/dbh.inv.php";
include_once "backend/functions.inv.php";
?>
<style>
    h1.comments {
        margin: 20px 100px;
    }
    
    div.comms {
        width: 96%;
        margin: 10px;
        padding: 10px 20px;
        background-color: white;
    }
    
    section.comms {
        margin-top: 100px;
    }

    p.user{
        font-size: 24px;
        font-weight: 900;
        margin: 0;
        margin-bottom: 2px;
    }

    p.comT {
        font-size: 16px;
        margin-top: 0;
    }
</style>
<h1 class="comments">What people have commented</h1>
<section class="comments">
<?php
getComments($conn);
?>
</section>
