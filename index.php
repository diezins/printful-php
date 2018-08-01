<?php require_once("/start.php");?>

<!DOCTYPE html>
<html lang="lv">
    <head>
            <title>Printful</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="style.css" />
            <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    </head>
    <body>
    <?php require_once("/start.php"); // uzspiežot 'sākt' viņš vēlreiz iziet cauri šim php ?>

        <div>
            Vārds
        </div>
        
        <form method="post" action="index.php">
            <input type="text" name="username" placeholder="Ievadiet jūsu vārdu"><br>
            <?php require_once("/get_dropdown.php"); ?>
            <input type="submit" id="start_button" value="Sākt">
        </form>
        
        <script src="scripts.js"></script>
    </body>
</html>