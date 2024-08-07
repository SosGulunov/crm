<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
model("Order");


$task = new Order();
$isUpdate = $task->unreadiness($_GET['id']);
if ($isUpdate) {
    header("Location: " . view('transactionHistory'));
}
else{
    header("Location: " . view('transactionHistory'));
}