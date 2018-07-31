<?php
    require_once '/mySQL/database.php';

    class Question
    {
        public $id;
        public $title;
        public $text;
        public $answerArray;

        public function __construct($id, $title, $text)
        {
            $this->id = $id;
            $this->title = $title;
            $this->text = $text;
        }

        public function print_question()
        {
            $sql_query_answers = "SELECT id, text FROM answer
                                    JOIN question_answer
                                    ON answer.id = question_answer.answerID
                                    && question_answer.questionID = $id";

            $db = getConnection();

            $stmt = $db->prepare($sql_query);
            $stmt->execute();
            $stmt->bind_result($id, $title, $text);

            $db->close();
        }
    }
?>