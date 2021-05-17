<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="script.js"></script>
</head>

<body>
    <div id="show_msg">
        <?php require "show_msgs.php" ?>
    </div>

    <div class="newMsg">
        <form action="" method="POST">
            <input type="text" class="writeBox" name="msg">
            <input type="submit" class="submit">
        </form>
    </div>
</body>

</html>

<?php

if (isset($_POST["msg"]) and $_POST["msg"] != NULL) {
    $msg = $_POST["msg"];

    insertIntoMessageDiscussion("email1", "email2", $msg);

    header("Refresh:0;");
}

?>