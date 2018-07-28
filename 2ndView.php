

<?php
    session_start();
    include '/mySQL/database.php';

    if (!isset($_SESSION['username'])) {
        header("Location: index");
        exit();
    }

    $username = $_SESSION['username'];
    $test_name = $_SESSION['test_name'];
    //echo $username;
    //echo $test_name;
    
    $db = getConnection();

    $sql_query = "SELECT title, text FROM question
                    JOIN survey_question ON question.questionID = survey_question.questionID 
                    && survey_question.surveyID = $test_name";

    $stmt = $db->prepare($sql_query);
    $stmt->execute();
    $stmt->bind_result($title, $text);
    $q1 = "maize";
    $q2 = "maizemazie";

    while($stmt->fetch())
    {
        // fetcho jautājumu un dara lietas - safetcho visus jautājumus. 
        // uztaisīt atsevišķu funkciju ar query utt - kas iegūst jautājumus pēc padota Question_ID
        // un atgriež array ar viņiem
        //echo $title . "<br>";
        //echo $text . "<br>";
    }
?>

<html>
    <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" Type="text/css" href="style.css" />
            <script type="text/javascript" src="scripts.js"></script>
    </head>

    <body class="center">
        <div class="title" id="title">
            <?= $title?>
        </div>
        <div class="question" id="question">
            <?= $text?>
        </div>

        <form class="form">
            <button id="button1">Option 1</button>
            <button>Option 2</button>
            <button>Option 3</button>
            <input type="submit" value="Sākt">
            <input type="button" value="Dzēst" onclick="changeQuestion('maize', 'maizemaize');"
        </form>
    </body>
</html>

