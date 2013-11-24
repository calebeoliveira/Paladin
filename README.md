Paladin
=======

Paladin is a lightweight **DAO** (Data Access Object) written for PHP 5.3+. For now, supporting only the MySQL DBMS. All configuration access is made to the class itself, or can be passed as parameter to the constructor.

**Example of use:**
```
<?php
$db = new Paladin();

$db->query("INSERT INTO 'todo' ('text') VALUES (:param1)", 
		   [ 'param1' => 'foo bar bad text unsecure text' ]);
```

