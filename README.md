WPDB-Fast-Importer-Exporter
===========================

1. Introduction -----------

This is a small PHP Addon to fast import & export your current Wordpress Database.

2. Requirements -----------

I wrote this code using 'mysqldump.exe' and 'mysql.exe' found in xampp/mysql/bin/
SO you need a Xampp installation or get these files.

2. Install ----------------

Copy the /db/ folder in your Wordpress Root directory. 
it has to look like this:

root
- /db/
- /wp-admin/
- /wp-content/
- /wp-wp-includes/
- allTheOtherPHPFiles...
- wp-config.php

3. Usage -----------------

open your Wordpress in your Browser and add /db/ to the adress. 
e.g. localhost/db/

check if mysqldump.exe (export) / mysql.exe (export) was found (green border). If not, set the correct path.
You can also set the default value in index.php (line 4/5)

The tool will check if there is an wp-config.php file and show the Data-connections you set there. 
If the connection works, you can create your first Dump.

On the right side you can import existing dumps.

Dumps are stored in db/dumps/




For any questions write me a email: info@phillip-groschup.de


