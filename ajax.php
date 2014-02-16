<?php

include_once("functions.php");

if(isset($_POST)){

    switch ($_POST["action"]) {
        case "checkIfFileExists":
            if(isset($_POST["path"]) && $_POST["path"] != ""){
                echo json_encode(array(checkIfFileExists($_POST["path"])));
            }else{
                echo json_encode(array("error"));
            }
            break;
        case "createDump":
            createDump($_POST["mysqldumpPath"], $_POST["host"], $_POST["user"], $_POST["pass"], $_POST["dbname"]);
            break;
        case "importDump":
            importDump($_POST["sqlPath"], $_POST["host"], $_POST["user"], $_POST["pass"], $_POST["dbname"], $_POST["filename"]);
            break;
    }


}



