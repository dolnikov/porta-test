<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/style.php';

use Src\Porta;

//Поддерживаемые методы
//GET:
//get_customer_info
//get_account_info
//get_full_vd_counter_info
//add_account
//add_followme_number
//update_account

//$porta = new Porta(45);
//$porta->exec("get_subscriptions", 1);


$porta = new Porta(70);
$porta->exec("get_subscriptions", 1);


?>


