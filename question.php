<?php
        ob_start();
        if(!isset($_SESSION)) { 
            session_start(); 
        } 

        require_once '/mySQL/database.php';

        $db = getConnection();
        $questionCount = sizeof($_SESSION['questionIDs'])-1;

        if (isset($_POST['questionNum'])){
            // nesaņem postu ar attiecīgo vērtību
            $questionNum = $_POST['questionNum'];
        } else {
            $questionNum = 0; // uzstāda temp mainīgo, kas seko līdzi - kurš jautājums tiek pildīts
        }

            // MET ERRORU ŠEIT - vispār nevajag šitajā funkcijā likties, ja ir pēdējais jaut.
        $id = $_SESSION['questionIDs'][$questionNum];

        $sql_query_answers = "SELECT id, text FROM answer
        JOIN question_answer
        ON answer.id = question_answer.answerID
        && question_answer.questionID =  $id";
    
        $stmt = $db->prepare($sql_query_answers);
        $stmt->execute();
        $stmt->bind_result($id2, $text2);
    
        $answers = '';
        $json_test = '';
    
        while($stmt->fetch()) {
            $answers = $answers . "<label class=\"button\"><input type=\"radio\" name=\"uzas\"><span>".$text2."</span></label>";
        }
        
        if ($questionCount > $questionNum)
        {
            $question = getQuestion($id);
            $json_test = array("if"=>"first Qs", 
            "noMore" => false, 
            "title" => $question ["title"], 
            "text" => $question["text"], 
            "author" => $answers);
        } else if ($questionCount == $questionNum)
        {
            // pēdējais elements, uzliek 'finišu'
            $question = getQuestion($id);
            $json_test = array("if"=>"priekšpēdējais", "noMore" => true, "title" => $question["title"], "text" => $question["text"],"test" => $questionNum, "author" => $answers, "testID" => $questionNumm);
        
        }    
        else if ($questionCount < $questionNum)
        {
            // $question = getQuestion($id);
            echo "yo";
            exit();
            //$json_test = array("if"=>"last", "noMore" => true, "finish" => true);
        } 
       
        $json = json_encode($json_test);
        ob_end_clean();
        echo $json;
        exit();

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