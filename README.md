# config-parser
Repository for parsing configuration file.  The is repo is in PHP.
Files will include 
* ClassConfig.php
* form.php

To run the parser

1.  Upload form.php in the web server directory.
2.  In the same directory upload ClassConfig.php
3.  Open a browser and access form.php (ie http://localhost/form.php)
4.  Upload a configuration file desired.
5.  Click submit
6.  You can upload another configuration file and see the result


Description

The config-parser parses a configuration file written with any of  following extensions
- .config
- .txt
- .ini
- .cfg

It displays a configuration name and a value in an HTML table.  It does not display the comments or white spaces.  For boolean switches the parser's value displays true or false.
