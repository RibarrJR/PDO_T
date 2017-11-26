<?php
require_once("config.php");
//Carrega um usuario
//$root = new User();
//$root->loadById(1);
//echo $root;

//Carrega TODOS
//$lista = User::getList();
//echo json_encode($lista);

//Carregauma lista buscando pelo nome
//$search =User::search("i");
//echo json_encode($search);

//carrega usuario usando login e senha
//$usuario =new User();
//$usuario->login("Junior","jr18");
//echo ($usuario);

//inserindo usuario novo
$aluno = new User();

$aluno ->setName("PM");
$aluno ->setPassword("pm123");

$aluno->insert();

echo $aluno;
?>