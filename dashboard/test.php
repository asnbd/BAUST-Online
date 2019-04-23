<?php
$sql = "INSERT INTO result_marks VALUES";
if(isset($_POST['ids'])){
    if(isset($_POST["ids"]) && is_array($_POST["ids"])){
        foreach ($_POST["ids"] as $key => $text){
            $sql .= "(" . $text . ", " . $_POST["marks"][$key] . ")";
            if (next($_POST["ids"])==true) $sql .= ", ";
        }

        echo $sql;

    }
}