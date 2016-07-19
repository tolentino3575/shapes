#Shapes

##Author

Project created by Erik Tolentino

##Description

An application to manage shapes. User has ability to add shapes and corresponding dimensions, as well as update them.

#Setup
###Instructions for MBP using MAMP

To View:
* Start MAMP servers
* From terminal, in project root folder enter "/Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot" to set up username and password for PhpMyAdmin and enter MySQL shell

* In browser, type "localhost:8888/phpmyadmin"
* If prompted, both your username and password are "root"

* From PhpMyAdmin, import the databases "shapes.sql.zip" and "shapes_test.sql.zip" included in "Shapes" folder

* From mysql shell in terminal, enter "USE shapes;" to enter and use database

* Open new shell in terminal and navigate to project root folder
* From terminal, run "composer install" while in project root folder "Shapes"
* From terminal, navigate into "/Shapes/web" folder and enter "php -S localhost:8000"

* To view, type "localhost:8000" in browser

#Technologies Used:

* Php
* PhpMyAdmin
* MAMP
* MySQL
* PHPUnit
* Silex
* Twig
* Atom
* Terminal
* GitHub
* Bootstrap
* HTML
