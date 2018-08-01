<?php
    require_once '/mySQL/database.php';

    // atrod lietotāja ID, pēc lietotājvārda
    if (isset($_SESSION['username']))
    {
        $username = $_SESSION['username'];
        $db = getConnection();
        $username = $db->real_escape_string($username);
        
        $sql_query = "SELECT id FROM user where user.username = '$username'";
        $stmt = $db->prepare($sql_query);
        $stmt->execute();
        $stmt->bind_result($id);
        $stmt->fetch();

        $_SESSION['user_id'] = $id;
    }

    if (isset($_SESSION['user_id']))
        {
            $userID = $_SESSION['user_id'];
            $db23 = getConnection();
            $userID = $db->real_escape_string($userID);

            $questionID = $_POST['questionID'];
            $answerID = $_POST['answerID'];

            $sql_query = "SELECT id FROM question_answer WHERE questionID = '$questionID' && answerID = '$answerID'";
            
            $stmt = $db->prepare($sql_query);
            $stmt->execute();
            $stmt->bind_result($id); // $id apzīmē question/answer kombinācijas id
            $stmt->fetch(); 

            $insertion_sql_query = "INSERT INTO user_answers ('question_answer_id', 'user_id') VALUES (? , ?)";
            $stmt = $db23->prepare($insertion_sql_query);

            $stmt->bind_param('ii', $id, $userID);
            $is_successful = $stmt->execute();

            if($is_successful){
                // redirect to next
            } else {
                echo "bad stuff happened";
            }
        }
?>