<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
model("Finance");

$finances = new Finance();

$finance_expenses = $finances->expenses($_POST['date_start'],$_POST['date_end']);
$expenses = 0;
foreach($finance_expenses as $finance){
    $expenses = $expenses + $finance['price'] + $finance['salary'];
}

$finance_profit = $finances->profit($_POST['date_start'],$_POST['date_end']);
$profit = 0;
foreach($finance_profit as $finance){
    $profit = $profit + ($finance['price']*$finance['count']);
}

$isUpdate = $finances->add($_POST,$expenses,$profit);

if ($isUpdate) {
    header('Content-Type: application/json');
    echo json_encode(['profit' => $profit, 'expenses' => $expenses]);
} else {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Не удалось обновить данные.']);
}
