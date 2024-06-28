<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
model("Tovar");


$tovar = new Tovar();
$isUpdate = $tovar->update($_POST, $_GET['id']);
if ($isUpdate) {
    header("Location: " . view('tovars'));
} else {
    header("Location: " . view('tovars') . "?id=" . $_GET['id']);
}