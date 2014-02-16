<?php
include_once("functions.php");

define('mysqldumpPath', 'd:/xampp/mysql/bin/mysqldump.exe');
define('mysqlpath', 'd:/xampp/mysql/bin/mysql.exe');
?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>WPDB fast Importer / Exporter</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="js/jQuery2.1.0.js" type="text/javascript"></script>
        <script src="js/divers.js" type="text/javascript"></script>
    </head>
    <body>
    <h1>WPDB fast Importer / Exporter</h1>

    <div class="exporter" id="actionbox">
        <h2>Exporter</h2>
        <span>Path to you xampp mysqldump.exe must be correct</span><br>
        <?php
        if (checkIfFileExists(mysqldumpPath)) {
            $fileExists = "green";
        } else {
            $fileExists = "red";
        }
        ?>
        <input class="dumppath" style="border-color: <?php echo $fileExists; ?>" type="text" size="40"
               value="<?php echo mysqldumpPath; ?>">
        <input type="button" value="Check Again" class="exporter_check_again">
        <hr>

        <?php
        exporter();
        ?>

    </div>


    <div class="importer" id="actionbox">
        <h2>Importer</h2>
        <span>Path to you xampp mysql.exe must to be correct</span><br>
        <?php
        if (checkIfFileExists(mysqlpath)) {
            $fileExists = "green";
        } else {
            $fileExists = "red";
        }
        ?>
        <input class="sqlpath" style="border-color: <?php echo $fileExists; ?>" type="text" size="40"
               value="<?php echo mysqlpath; ?>"><?php checkIfFileExists(mysqlpath); ?>
        <input type="button" value="Check Again" class="importer_check_again">
        <hr>
        <?php
        importer();
        ?>


    </div>
    </body>
    </html>




<?php



function importer()
{
    if (checkIfFileExists("../wp-config.php")) {
        $connectedToWPDB = connectToDBIfExists();


        if ($connectedToWPDB) {
            showDumps();
        }
    }
}


function exporter()
{

    if (checkIfFileExists("../wp-config.php")) {
        $connectedToWPDB = connectToDBIfExists();

        if ($connectedToWPDB) {
            echo '<br><input class="exporterbutton" type="submit" value="DB Dump erstellen">';
        }
    } else {
        echo "could not find any WP DB";
    }
}



function connectToDBIfExists()
{
    include_once("../wp-config.php");

    ?><span>'wp-config.php' found.<br>This Con Data is in your wp-config.php:</span><?php
    createDBDataTable(DB_NAME, DB_USER, DB_PASSWORD, DB_HOST);

    $mysqlConnection = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
    if ($mysqlConnection) {
        ?><span style="color: green">Got connetection.</span> <?php
        return mysql_select_db(DB_NAME, $mysqlConnection);

    } //else (no db con) not required, Wordpress itself will do this
}



function createDBDataTable($dbname, $dbuser, $dbpass, $dbhost)
{
    ?>
    <table class="conTable" style="width: 100%" border="1">
        <tr>
            <th>Name:</th>
            <th>Value:</th>
        </tr>
        <tr>
            <td>DB-Name:</td>
            <td data-dbname="<?php echo $dbname; ?>"><?php echo $dbname; ?></td>
        </tr>
        <tr>
            <td>DB-User:</td>
            <td data-dbuser="<?php echo $dbuser; ?>"><?php echo $dbuser; ?></td>
        </tr>
        <tr>
            <td>DB-Pass:</td>
            <td data-dbpass="<?php echo $dbpass; ?>"><?php echo $dbpass; ?></td>
        </tr>
        <tr>
            <td>DB-Host:</td>
            <td data-dbhost="<?php echo $dbhost; ?>"><?php echo $dbhost; ?></td>
        </tr>
    </table>

<?php
}

function showDumps()
{
    echo "<br>Verf&uuml;gbare Dumps:";
    if ($handle = opendir('dumps')) {

        while (false !== ($file = readdir($handle))) {
            if ($file != ".." && $file != ".") {

                $fileDateData = explode("-", $file);
                $dumpdate = $fileDateData[4] . "." . $fileDateData[3] . ".20" . $fileDateData[2] . " - " . $fileDateData[5] . ":" . $fileDateData[6];
                ?>
                <br>
                <li><?php echo $dumpdate; ?><input class="importbutton" type="submit" value="Import it!!!"
                                                   data-file="<?php echo $file; ?>"></li>
            <?php
            }
        }
        closedir($handle);
    }
}



