ZF2 Sample Report Application
=============================

Introduction
------------
This is a sample non-trivial application, built on the top of Zend Framework 2, 
Doctrine 2 and PHPUnit 4.4, aimed to showcase some best practices on modern web
programming with PHP.

The application is a simple report that shows transactions for a merchant id 
specified as command line argument.

Installation
------------

    git clone git://github.com/pedrobrazao/zf2-sample-report.git
    cd zf2-sample-report
    php composer.phar self-update
    php composer.phar install

Usage
-----

There are 2 merchants (IDs 1 and 2) and a few transactions on database.

    php public/index.php report <merchant-id>

or...

    php public/index.php help

Unit Tests
----------

Test cases are using PHPUnit 4.4.* and can be executed as:

    cd test
    phpunit

Code coverage reports are available in data/coverage folder.

ToDo
----

1. Complete Unit Tests
2. Implement an application Cache layer to improve database access
3. Add some logging on running the report action.