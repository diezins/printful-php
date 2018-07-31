<?php
    ob_start();
    if(!isset($_SESSION)) { 
        session_start(); 
    } 

    require_once '/mySQL/database.php';

    $questionCount = sizeof($_SESSION['questionIDs'])-1;

    if (isset($_POST['questionNum'])){
        $questionNum = $_POST['questionNum'];
    } else {
        $questionNum = 0;
    }

    $id = $_SESSION['questionIDs'][$questionNum]; // paņem jautājuma-ID

    $sql_query_answers = "SELECT answer.id, text FROM answer
                            JOIN question_answer
                            ON answer.id = question_answer.answerID
                            && question_answer.questionID =  $id";

    $db = getConnection();
    $stmt = $db->prepare($sql_query_answers);
    $stmt->execute();
    $stmt->bind_result($id2, $text2);
    $answers = '';

    while($stmt->fetch()) {
        $answers = $answers . "<label class=\"button\"><input type=\"radio\" name=\"uzas\"><span>".$text2."</span></label>";
    }
    
    if ($questionCount > $questionNum)
    {
        // pirmie jautājumi
        $question = getQuestion($id);
        $json_test = array("noMore" => false, "title" => $question ["title"], "text" => $question["text"], "author" => $answers);
    } else if ($questionCount == $questionNum) {
        // pēdējais elements, uzliek 'finišu'
        $question = getQuestion($id);
        $json_test = array("noMore" => true, "title" => $question["title"], "text" => $question["text"],"test" => $questionNum, "author" => $answers, "testID" => $questionNumm);
    }
    
    $json = json_encode($json_test);
    ob_end_clean();
    echo $json;
    exit();

    function getQuestion($id) // izvelk jautājuma 'virsrakstu' un pašu jautājumu
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

    // function set_usernameID($username)
    // {
    //     if (isset($_SESSION['username']))
    //     {
    //         $username = $_SESSION['username'];
    //         $sql_query = "SELECT id FROM user where user.username = $username";

    //         $db = getConnection();
    //         $stmt = $db->prepare($sql_query);
    //         $stmt->execute();
    //         $stmt->bind_result($id);
    //         $stmt->fetch();

    //         $_SESSION['user_id'] = $id;
    //     }
    // }

    // function save_answer($answerID, $questionID)
    // {
    //     if (isset($_SESSION['user_id']))
    //     {
    //         $userID = $_SESSION['user_id'];
    //         $sql_query = "SELECT id FROM question_answer WHERE questionID = $questionID && answerID = $answerID"

    //         $db = getConnection();
    //         $stmt = $db->prepare($sql_query);
    //         $stmt->execute();
    //         $stmt->bind_result($id);
    //         $stmt->fetch();

    //         // $id ir question/answer kombinācijas id

    //         $insertion_sql_query = "INSERT INTO user_answers (question_answer_id, user_id) VALUES (?, ?)";
    //         $stmt = $db->prepare($insertion_sql_query);
    //         $stmt->bind_param('dd', $id, $userID);
    //         $is_successful = $stmt->execute();

    //         if($is_successful){
    //             // redirect to next
    //         } else {
    //             echo "bad stuff happened";
    //         }
    //     }
        
        
        // find question_answer id depending on passed values

    }
?>