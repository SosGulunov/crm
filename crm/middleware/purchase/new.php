<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
model("Purchase");


$purchase = new Purchase();
$isUpdate = $purchase->add($_POST);

if($isUpdate){
    header("Location: " . view('purchase_tovar'));
}
