<?php
    // after pressing start
    session_start();

    require_once '/mySQL/database.php';

    $db = getConnection();

    //session_destroy();   
    if (isset($_POST['username']) && trim($_POST['username']) != '' && isset($_POST['testID'])) {
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['testID'] = $_POST['testID'];

        if (isset($_SESSION['username']) && isset($_SESSION['testID'])) {
            $input_username =$_SESSION['username'];
            $survey_id = $_SESSION['testID'];
    
            $sql_query = "INSERT INTO user (username, survey_id) VALUES (? , ?)";
            
            $stmt = $db->prepare($sql_query);
            $stmt->bind_param('sd', $input_username, $survey_id);
            $is_successful = $stmt->execute();
            if($is_successful){
                // Records created successfully. Redirect to landing page
                    $url = "survey";
                    header('Location: ' . $url);
                    exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
    }
?>