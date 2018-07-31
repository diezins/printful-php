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

    $sql_query = "SELECT id, title, text FROM question
                    JOIN survey_question 
                    ON question.ID = survey_question.questionID && 
                    survey_question.surveyID = $testID";

    $stmt = $db->prepare($sql_query);
    $stmt->execute();
    $stmt->bind_result($id, $title, $text);

    $key = 0;
    $questionArray = array();
    $questionIDArray = array();
    

    while($stmt->fetch())
    {
        $questionArray[$key] = new Question($id, $title, $text); // masīvs ar jautājumiem
        $questionIDArray[$key] = $id;
        if ($key == 0) $tempID = $id;
        $key++;
        //$questionArray[0]->$text;
    }
    // answers for the specific tempID;
    $_SESSION['questionIDs'] = $questionIDArray;
    $db->close();
?>

<html>
    <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" Type="text/css" href="style.css" />
            <script type="text/javascript" src="jquery-3.3.1.min.js"></script>
            <script>
                // on page load
                $(document).ready(function(){
                    $.post({
                        url: 'answers.php',
                        type: 'POST',
                        data: {questionNum:0},
                        success: function(data){
                            if (!$.trim(data)){
                                alert("error, data is empty"); // next is empty
                            } 
                            else {
                                var Data = $.parseJSON(data);
                                $('#options').append(Data.author);
                            }
                        },
                        error: function(request, statuss, error)
                        {
                            alert("error in global.js");
                        }
                    });
                })
            </script>
    </head>

    <body class="center">
        <div class="title" id="title">
            <?= $questionArray[0]->title?>
        </div>
        <div class="question" id="question">
            <?= $questionArray[0]->text?>
        </div>

        <form class="form" id="form">
            <div id="options">
            </div>
            <input type="hidden" value=0 id="questionNum">
            <input type="button" value="Next" id="next_button">
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
