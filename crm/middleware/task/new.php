<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
model("Task");


$worker = new Task();
$isUpdate = $worker->new($_POST);

if($isUpdate){
    header("Location: " . view('tasks'));
}
