<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
model("Task");


$task = new Task();
$isUpdate = $task->readiness($_GET['id']);
if ($isUpdate) {
    header("Location: " . view('tasks'));
}
else{
    header("Location: " . view('tasks'));
}