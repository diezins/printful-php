<?php
    session_start();

    //session_destroy();
    // if (isset($_SESSION['username'])) {
    //     $url = "2ndView";
    //     header('Location: ' . $url);
    //     exit();
    // } else 
    
    if (isset($_POST['username'])) {
        $username = $_POST['username'];
        $testtest = $_POST['test_name'];
        $_SESSION['username'] = $username;
        $_SESSION['test_name'] = $testtest;
        $url = "2ndView";
        header('Location: ' . $url);
        exit();
    }
?>

<html>
    <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="newcss.css" />
    </head>

    <body>
        <div class="title">
            Testa uzdevums
        </div>
        
        <form method="post" action="index">
            <input type="text" name="username" placeholder="Ievadiet jūsu vārdu"><br>
            
            <?php
                require_once("/get_dropdown.php");
            ?>
            
            <input type="submit" value="Sākt">
        </form>
        
    </body>
</html>

