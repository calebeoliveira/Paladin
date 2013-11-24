Paladin
=======

Paladin is a PHP Data Object(PDO) abstraction layer for databases. For now, supporting only the MySQL DBMS.

**Example of use:**
```
<?php
$db = new Paladin();
$db->query("INSERT INTO 'todo' ('todo_text') VALUES (:param1)", 
		   [ 'param1' => 'foo bar bad text unsecure text' ]);
```

