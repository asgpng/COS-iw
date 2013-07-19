Princeton Computer Science Independent Work Website
====================================================
Our Summer Programming Experience (SPE) '13 project was a prototype of a website for the independent work of Princeton's Computer Science Department. The existing system was still paper-based, which meant that students had to print out forms, fill them out by hand, walk to their advisor's office to have them fill forms out, and eventually turn forms in to Colleen, the COS secretary, who would manaully enter the data into a Google Doc. As such, the premise of this project was to increase the efficiency by digitizing these forms. These web forms were integrated into a website which will allow students and faculty to submit forms, view deadlines, and give feedback. On the administrative side, we added features for viewing and adding users, as well as viewing submitted forms and exporting form data to a csv file.

There are four folders, representing four different technologies we attempted to use to build this website. We began in python with Google App Engine, then attempted to use Flask to deploy on Princeton's CS servers. After running into problems with this approach, we transitioned to PHP with CodeIgniter, which was more supported on the server. The iw-php file is an earlier attempt at using PHP with the Silex micro-framework. Such an approach would also have worked, but as the CS department recommended we use CodeIgniter, our final app was built using it instead.

CodeIgniter
===========

Requirements
------------
Apache,
MySQL

Installing/Running
------------------

On a *nix machine with Apache installed, go to your web directory and run:
```
git clone https://github.com/asgpng/COS-iw.git
```

Configure Database
-------------------
```
In iw-ci/application/config/database.php:
> mysql -u root -p [PASSWORD]
> create database spe;
> use spe;
> source /PATH/TO/WEB/DIR/COS-iw/iw-ci/spe-iw.sql;
```

CodeIgniter Database
---------------------
```
/COS-iw/iw-ci/application/config/database.php
```

Test:
-----
```
(in a browser)
> http://localhost/COS-iw/iw-ci/index.php/test_login
```

If you have problems, check your server error log. If nothing shows up, it's most likely a database connection issue. Autoloading of the database can be disabled in
```
/COS-iw/iw-ci/application/config/autoload.php
```
Note that this will 'break' a lot of pages which load database models, but CodeIgniter should at least produce some debugging info.

Another source of info is the CodeIgniter documentation, which is quite good: (http://ellislab.com/codeigniter/user-guide/toc.html).

Google App Engine
=================

Installation
------------
Install Python development environment by following instructions at (https://developers.google.com/appengine/docs/python/gettingstartedpython27/devenvironment).

Running
-------
```
> dev_appserver.py iw-gae
```