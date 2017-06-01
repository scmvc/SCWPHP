<?php
class PGSQLDriver
{
	
	public function DBInit(){
		global $DBCONF;
		$DBH = "";
		try {
			$DBH = new PDO("pgsql:host={$DBCONF['host']};dbname={$DBCONF['database']}",$DBCONF["username"],$DBCONF["password"],array(PDO::ATTR_PERSISTENT=>false));
		} catch (PDOException $e) {
			print "Error!: ".$e->getMessage()."<br/>";
		}
		return $DBH;
	}
}