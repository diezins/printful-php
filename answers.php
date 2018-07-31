<?php
        ob_start();
        if(!isset($_SESSION)) { 
            session_start(); 
        } 

        require_once '/mySQL/database.php';

        $db = getConnection();
        $questionCount = sizeof($_SESSION['questionIDs']);

        if (isset($_POST['questionNum'])){
            // nesaņem postu ar attiecīgo vērtību
            $questionNum = $_POST['questionNum'];
        } else {
            $questionNum = 0; // uzstāda temp mainīgo, kas seko līdzi - kurš jautājums tiek pildīts
        }

        if (($questionCount) < $questionNum){
            ob_end_clean();
            $json = json_encode(array("noMore" => true, "finish" => true, "redirect" => "3rdView"));
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
            if ($questionCount-1 == $questionNum)
            {
                // pēdējā elementa padošana elements
                $question = getQuestion($id);
                $json_test = array("noMore" => true, "title" => $question["title"], "text" => $question["text"],"test" => $questionNum, "author" => $answers, "testID" => $questionNumm);
                //$json_test = array("noMore" => "test", "author" => $answers, "testID" => $questionNum, "redirect" => "3rdView");
            }
            else
            {
                $question = getQuestion($id);
                $json_test = array("noMore" => $questionCount, "title" => $question["title"], "text" => $question["text"], "author" => $answers, "testID" => $questionNumm);
            }
            $json = json_encode($json_test);
            ob_end_clean();
            echo $json;
            exit();
        }

        function getQuestion($id)
        {
            $db = getConnection();

            $sql_query = "SELECT title, text FROM question
                            WHERE question.id = $id";
        
            $stmt = $db->prepare($sql_query);
            $stmt->execute();
            $stmt->bind_result($title, $text);
            
            $stmt->fetch();

            $response_array = array("title" => $title, "text" => $text);

            return $response_array;
        }
?>