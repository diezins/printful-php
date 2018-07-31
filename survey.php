<?php
    session_start();
    require '/mySQL/database.php';
    require 'question_object.php';


    if (!isset($_SESSION['username']) && !isset($_SESSION['testID'])) {
        header("Location: index");
        exit();
    }

    $testID = $_SESSION['testID'];
    
    $db = getConnection();
    $sql_query = "SELECT id FROM question
                    JOIN survey_question 
                    ON question.ID = survey_question.questionID && 
                    survey_question.surveyID = $testID";
    $stmt = $db->prepare($sql_query);
    $stmt->execute();
    $stmt->bind_result($id);

    $key = 0;
    $questionIDArray = array();

    while($stmt->fetch())
    {
        $questionIDArray[$key++] = $id;
        $key++;
    }
    // saves question ID's in session
    $_SESSION['questionIDs'] = $questionIDArray;
    $db->close();
?>

<html>
    <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" Type="text/css" href="style.css" />
            <script type="text/javascript" src="jquery-3.3.1.min.js"></script>
            <script type="text/javascript" src="global.js"></script>
    </head>

    <body class="center">
        <div class="title" id="title">
            
        </div>
        <div class="question" id="question">
            
        </div>
        <form class="form" id="form">
            <div id="options">
            </div>
            <input type="hidden" value=0 id="questionNum">
            <input type="button" onclick="GetQuestion()" value="Next" id="next_button">
            <input type="button" value="Dzēst">
        </form>

        <div id="results">
                
        </div>
        <script src="global.js"></script>
        <script src="scripts.js"></script>

    </body>
</html>

<?php

?>
