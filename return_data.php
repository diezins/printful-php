<?php   
    // $count = $_SESSION['question_count'];
    if (isset($_POST['id']) === true && empty($_POST['id']) === false)
    {
        require_once '/mySQL/database.php';
        $id = $_POST['id']; 
        // atbilžu varianti
        $sql_query_answers = "SELECT id, text FROM answer
                            JOIN question_answer
                            ON answer.id = question_answer.answerID
                            && question_answer.questionID = $id";

        $db = getConnection();

        $stmt = $db->prepare($sql_query_answers);
        $stmt->bind_result($id, $text);
        $stmt->execute();
        $answerIDArray = array();
        $answerTEXTArray = array();
        $key = 0;
        
        while($stmt->fetch()) {
            $answerIDArray[$key] = $id;
            $answerTEXTArray[$key] = 'dāvis';
            $key++;
            //echo "<option value='" . $id . "'>" . $text . "</option>";
        }
        header('Content-Type: text/html; charset=utf-8');
        $post_data = array('idArray' => 42);
    
        $book = array(
            "title" => "JavaScript: The Definitive Guide",
            "author" => "David Flanagan",
            "edition" => 6
        );

        echo json_encode($book, JSON_UNESCAPED_UNICODE); // for utf support
        
        $db->close();
    }

    // $url = "survey";
    // header('Location: ' . $url);
    // exit();

?>