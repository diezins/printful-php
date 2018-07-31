<?php
    require_once '/mySQL/database.php';

    $db = getConnection();

    $sql_query = "SELECT * FROM survey";
    $stmt = $db->prepare($sql_query);
    $stmt->execute();
    $stmt->bind_result($id, $name, $description);

    $elementArray = array();

    echo "<select id='test' name=\"testID\">";

    while($stmt->fetch())
    {
        // $elementArray[$key] = new Test($id, $name, $description);
        // echo "<option value='" . $elementArray[$key]->id . "'>" . $elementArray[$key]->name . "</option>";
        echo "<option value='" . $id . "'>" . $name . "</option>";
    }
    echo "</select><br>";
    
    $db->close();
?>