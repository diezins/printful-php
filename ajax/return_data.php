<?php
    // echo "yo";
    
    if (isset($_POST['id']) === true && empty($_POST['id']) === false)
    {
        require_once '/mySQL/database.php';

        // atbilžu varianti
        $sql_query_answers = "SELECT id, text FROM answer
                            JOIN question_answer
                            ON answer.id = question_answer.answerID
                            && question_answer.questionID = $id";

        $db = getConnection();

        $stmt = $db->prepare($sql_query);
        $stmt->execute();
        $stmt->bind_result($id, $text);

        while($stmt->fetch()) {
            echo "yo";
            // echo "<option value='" . $id . "'>" . $text . "</option>";
        }

        $db->close();
    }
?>