<?php

class User{
	
	private $ID;
	private $name;
	private $password;
	private $date_include;

public static function getList(){
	$sql= new Sql();
	return $sql->select("SELECT * FROM tb_usuarios order by ID");
}
public static function search($name){
	$sql = new Sql();
	return $sql->select("SELECT * FROM tb_usuarios WHERE name LIKE :SEARCH ORDER BY Name",array(
		':SEARCH'=>"%".$name."%"
	));
}

	
public function getID(){
	return $this->ID;
}
public function setID($value){
	$this->ID = $value;
}
public function getName(){
	return $this->name;
}
public function setName($value){
	$this->name = $value;
}
public function getPassword(){
	return $this->password;
}
public function setPassword($value){
	$this->password = $value;
}
public function getDate(){
	return $this->date_include;
}
public function setDate($value){
	$this->date_include = $value;
}

public function loadById($id){
	
	$sql =new Sql();
	
	$results = $sql -> select("SELECT * FROM tb_usuarios where ID=:ID", array(
		":ID"=>$id
	));
	
	if (count($results) > 0 ){
				
		$this->setData($results[0]);
		
	}   
}
	
	
public function login ($login,$password){
	
	$sql =new Sql();
	
	$results = $sql -> select("SELECT * FROM tb_usuarios WHERE name=:NAME AND password =:PASSWORD", array(
		":NAME"=>$login,
		":PASSWORD"=>$password
	));
	
	if (count($results) > 0 ){
		

		$this->setData($results[0]);		
	} else{
		throw new Exception("Login e/ou Senha Invalidos");	
	}
}
public function setData($data){
	
		$this->setID($data['ID']);
		$this->setName($data['name']);
		$this->setDate(new DateTime($data['date_include']));
		$this->setPassword($data['password']);
}
	
public function insert(){
	$sql= new Sql();
	$results =$sql->select("CALL sp_usuarios_insert(:NOME,:PASSWORD)",array(':NOME'=>$this->getName(),
	':PASSWORD'=>$this->getPassword()
	
	));
		
	if(count($results)>0){
		
		$this->setData($results[0]);
	}
	
}
	
	
public function __toString(){
	
	return json_encode(array(
		"ID"=>$this->getID(),	
		"name"=>$this->getName(),	
		"date_include"=>$this->getDate()->format("d/m/Y H:i:s"),
		"password"=>$this->getPassword()
		

	));
}
		
}
?>