# DHTMLSQL 

[![Total Downloads](https://poser.pugx.org/dhtml/dhtmlsql/downloads)](https://packagist.org/packages/dhtml/dhtmlsql)
[![Latest Stable Version](https://poser.pugx.org/dhtml/dhtmlsql/version.png)](https://packagist.org/packages/dhtml/dhtmlsql)
[![License](https://poser.pugx.org/dhtml/dhtmlsql/license)](https://packagist.org/packages/dhtml/dhtmlsql)

## What am I looking at?

You are looking at An advanced, compact and lightweight MySQL database wrapper library, built around PHP's mysqli extension.
It provides methods for interacting with MySQL databases that are more powerful and intuitive than PHP’s default ones.

## Features
 * It uses the mysqli extension for communicating with the database instead of the old mysql extension, which is officially deprecated as of PHP v5.5.0 and will be removed in the future; again, this is not a wrapper for the PDO extension which is already a wrapper in itself
 * It offers lots of powerful methods for easier interaction with MySQL
 * It provides a better security layer by encouraging the use of prepared statements, where parameters are automatically escaped.
 * It has comprehensive documentation and examples of usage included
 * It allows easy ways of backing up and restoring your database.


## Installation and Usage

One of the main goals of DHTMLSQL is to be **zero setup**. 

[Download the archive](https://github.com/dhtml/dhtmlsql/archive/master.zip) and simply
```php
<?php
require 'dhtmlsql.php';
```

**Or, if you use Composer:**

```json
"require": {
   "dhtml/dhtmlsql": "^1.0"
}
```

Or just run `composer require dhtml/dhtmlsql`

**That's it, you can now use DHTMLSQL to run your queries:**

## Requirements

PHP 5+ with the **mysqli extension** activated, MySQL 4.1.22+


## How to use

Connect to a database

```php
<?php
require "library/dhtmlsql.php";
 
// Connection data (server_address, name, password,  database)
$db=DHTMLSQL::connect('localhost','admin','pass','dbtest');
?>
```

A SELECT statement
```php
<?php
// $criteria will be escaped and enclosed in grave accents, and will
// replace the corresponding ? (question mark) automatically
$db->select(
    'column1, column2',
    'table',
    'criteria = ?',
    array($criteria)
);

// after this, one of the "fetch" methods can be run:

// to fetch all records to one associative array
$records = $db->fetch_assoc_all();

// or fetch records one by one, as associative arrays
while ($row = $db->fetch_assoc()) {
    // do stuff
}
?>
```

An INSERT statement
```php
<?php

$db->insert(
    'table',
    array(
        'column1' => $value1,
        'column2' => $value2,
    )
);
?>
```

An UPDATE statement

```php
<?php

// $criteria will be escaped and enclosed in grave accents, and will
// replace the corresponding ? (question mark) automatically
$db->update(
    'table',
    array(
        'column1' => $value1,
        'column2' => $value2,
    ),
    'criteria = ?',
    array($criteria)
);

?>
```
### Support
[Visit the project page](http://dhtml.github.com/dhtmlsql/) for documentation, configuration, and more advanced usage examples. 

You can also read the complete [API documentation here](http://dhtml.github.com/dhtmlsql/api) or even discuss it [here](https://disqus.com/home/forums/dhtmlsql/).

### Author

**Anthony Ogundipe** a.k.a dhtml

Special thanks to <a href="https://www.facebook.com/OmniPotens">Marcellinus Okeke</a> and <a href="https://www.facebook.com/pyjac">Oyebanji Jacob Mayowa</a> for their contributions to this library.

### License

Licensed under the MIT License
 