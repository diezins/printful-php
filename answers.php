<?php
        ob_start();
        if(!isset($_SESSION)) { 
            session_start(); 
        } 

        require_once '/mySQL/database.php';

        $db = getConnection();
        $test = $_SESSION['questionIDs'];

        if (isset($_POST['questionNum'])){
            // nesaņem postu ar attiecīgo vērtību
            $questionNum = $_POST['questionNum'];
        } else {
            $questionNum = 0; // uzstāda temp mainīgo, kas seko līdzi - kurš jautājums tiek pildīts
        }

        if (sizeof($_SESSION['questionIDs'])-1 < $questionNum){
            ob_end_clean();
            $json = json_encode(array("isLast" => true, "author" => $answers, "testID" => $questionNum, "redirect" => "3rdView"));
            echo $json;
            exit(); 
            // kopējie jautājumi ir mazāk par 'tagadējo'
        } 
        else 
        {
            $id = $_SESSION['questionIDs'][$questionNum];

            $sql_query_answers = "SELECT id, text FROM answer
            JOIN question_answer
            ON answer.id = question_answer.answerID
            && question_answer.questionID =  $id";
        
            $stmt = $db->prepare($sql_query_answers);
            $stmt->execute();
            $stmt->bind_result($id2, $text2);
        
            $answers = '';
        
            while($stmt->fetch()) 
            {
                $answers = $answers . "<label class=\"button\"><input type=\"radio\" name=\"uzas\"><span>".$text2."</span></label>";
            }
            if (sizeof($_SESSION['questionIDs'])-1 == $questionNum)
            {
                // last element

                $json_test = array("isLast" => true, "author" => $answers, "testID" => $questionNum, "redirect" => "3rdView");
            }
            else
            {
                $json_test = array("isLast" => "false", "author" => $answers, "testID" => $questionNum);
            }
            $json = json_encode($json_test);
            ob_end_clean();
            echo $json;
            exit();
        }
?>