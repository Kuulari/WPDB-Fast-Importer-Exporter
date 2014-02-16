<?php
function checkIfFileExists($filepath){
    if (file_exists($filepath)) {
        return true;
    } else {
        return false;
    }
}

function createDump($mysqldumpPath, $host, $user, $pass, $dbname){

    $date = new DateTime(date('y-m-j H:i:s'));
    $dateTime = $date->format('y-m-d-H-i-s');
    $filename = 'dumps/db-backup-'.$dateTime.'-' . time() . '.sql';

    //create Dump
    exec($mysqldumpPath." --host=".$host." --user=".$user." --password=".$pass." --databases ".$dbname." > ".$filename);
    $userdatei = fopen($filename,"r");
    $dump = "";
    while(!feof($userdatei))
    {
        $zeile = fgets($userdatei,1024);
        $dump .= $zeile;

    }
    fclose($userdatei);
}

function importDump($sqlPath, $host, $user, $pass, $dbname, $filename){

    exec($sqlPath." --user=".$user." --password=".$pass." --host=".$host." ".$dbname." < "."dumps/".$filename);

}




?>
