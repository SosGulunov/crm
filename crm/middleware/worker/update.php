<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
model("Worker");


$worker = new Worker();
$isUpdate = $worker->update($_POST, $_GET['id']);
if ($isUpdate) {
    header("Location: " . view('workers'));
} else {
    header("Location: " . view('workers') . "?id=" . $_GET['id']);
}
