
<?php require "dao.php"; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php 
        $discussions = selectEmailsDiscussion("email1");
        foreach($discussions as $value) {
            echo $value[''];
        }
    ?>

</body>

</html>