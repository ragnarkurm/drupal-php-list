What it is
----------
These scripts are intended to extract all custom php from database.

Requirements
------------
* Drupal 7.x
* (Views)
* (Views PHP)
* (Panels)

Why
---
* When your codebase in get big then you have a lot of references from views and from panels to your code.
* If you change some function name or arguments or functionality, how are you going to find out which panels and views use the function?
* In addition, if you suspect evil activity in your Drupal, it is easy to get overview.
* If you need overview of your php in database, how?

Currently supported
-------------------
* Views
* Panels

Install
-------
* Download it to sites/example.com/modules/

Usage
-----
* cd sites/example.com/modules/x_php_list
* drush scr x_php_list_views.php | less
* drush scr x_php_list_pages.php | less
