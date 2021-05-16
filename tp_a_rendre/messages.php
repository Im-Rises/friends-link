<?php 
require "show_msgs.php"; 
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="newMsg">
        <form action="" method="POST">
            <input type="text" class="writeBox" name="msg">
            <input type="submit" class="submit">
        </form>
    </div>
</body>

</html>

<?php 

if(isset($_POST["msg"]) and $_POST["msg"]!=NULL) {
    $msg = $_POST["msg"];

    insertIntoMessageDiscussion("email1", "email2", $msg);

    header("Refresh:0;");
}

?>