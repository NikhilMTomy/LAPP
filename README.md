# LAPP : Linux Apache PHP Postgres  
A simple implementation of a server with apache, PHP and postgresql.  
## Important
The file `template/dbconfig.php` is not ignored using `.gitignore`. This is because it contains sensitive data.  
Create it with the following format
```
<?php
	// dbconfig.php
	$db_host = "postgres_server";
	$db_name = "postgres_database_name";
	$db_user = "postgres_username";
	$db_pass = "postgres_password]";
	$db_port = "postgres_port";
?>
```  