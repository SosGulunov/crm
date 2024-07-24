<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
model("Worker");


$worker = new Worker();
$isUpdate = $worker->new($_POST);

if($isUpdate){
    header("Location: " . view('workers'));
}
