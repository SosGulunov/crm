<?php
session_start();
require_once "functions.php";

onlyUser();


component('sidebar');

?>

<div class="container">
    <h1>Общие сводки</h1>
</div>
<?php


component('footer');

