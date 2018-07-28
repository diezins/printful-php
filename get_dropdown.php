<?php
    include 'test_object.php';
    include '/mySQL/database.php';

    $db = getConnection();

    $sql_query = "SELECT * FROM survey";
    $stmt = $db->prepare($sql_query);
    $stmt->execute();
    $stmt->bind_result($id, $name, $description);

    $elementArray = array();
    $key = 0;

    echo "<select id='test' name='test_name'>";

    while($stmt->fetch())
    {
        // $elementArray[$key] = new Test($id, $name, $description);
        // echo "<option value='" . $elementArray[$key]->id . "'>" . $elementArray[$key]->name . "</option>";
        echo "<option value='" . $id . "'>" . $name . "</option>";
        $key++;
    }
    echo "</select><br>";

    // echo "
    //     <script type=\"text/javascript\">
    //     var e = document.getElementById(\"test\");
    //     var selectedElement = e.options[e.selectedIndex].value;
    //     var selectedElementText = e.options[e.selectedIndex].text;
    //     document.write(selectedElement + \" \");
    //     document.write(selectedElementText);
    //     </script>";

    // echo "<br>";
    // echo $elementArray[0]->description;
    // echo "<br>";
    // echo $elementArray[1]->description;
    // echo "<br>";
    
    $db->close();
?>