<?php 
class Database
{
private $host = 'localhost';
private $username = 'root'; 
private $database = 'Resumebuilder';
private $password = '';
private $db =null;
function __construct()
{
    $this->db=new mysqli($this->host, $this->username, $this->password,$this->database);

}
public function connect()
{
    return $this->db;
}
}


$db = new Database();
$db = $db->connect();
?>


