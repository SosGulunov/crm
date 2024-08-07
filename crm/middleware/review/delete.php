<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
model("Reviews");


$review = new Reviews();
$isDelete = $review->delete($_GET['id']);
if ($isUpdate) {
    header("Location: " . view('reviews'));
} else {
    header("Location: " . view('reviews'));
}