<?php
    ob_start();
    if(!isset($_SESSION)) { 
        session_start(); 
    } 

    set_usernameID();
    save_answer();

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

    function set_usernameID()
    {
        require_once '/mySQL/database.php';

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
    }

    function save_answer()
    {
        require_once '/mySQL/database.php';

        if (isset($_SESSION['user_id']))
        {
            $userID = $_SESSION['user_id'];
            $db = getConnection();
            $userID = $db->real_escape_string($userID);

            $questionID = $_POST['questionID'];
            $answerID = $_POST['answerID'];

            $sql_query = "SELECT id FROM question_answer WHERE questionID = '$questionID' && answerID = '$answerID'";

            
            $stmt = $db->prepare($sql_query);
            $stmt->execute();
            $stmt->bind_result($id); // $id ir question/answer kombinācijas id
            $stmt->fetch();

            $insertion_sql_query = "INSERT INTO user_answers (question_answer_id, user_id) VALUES (? , ?)";
            $stmt = $db->prepare($insertion_sql_query);
            $test2 = 3;
            $stmt->bind_param('ii', $id, $userID);
            $is_successful = $stmt->execute();

            if($is_successful){
                // redirect to next
            } else {
                echo "bad stuff happened";
            }
        }
    }

?>