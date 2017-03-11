<?php
use Db_connect\DB;

require_once __DIR__.'/vendor/autoload.php';

$display_months = new Exo1DisplayAllMonths();

$paginator = new Exo2Pagination();


$months = $display_months->displayAllMonths();

$odds_values = $paginator->displayOddsValues();

$evens_values = $paginator->displayEvensValues();



echo "======== Afficher les mois en francais ======== \r\n";

    foreach ( $months as $key => $month ) {

        echo " $key => Mois de $month \r\n";
    }

echo "================================================ \r\n";


//var_dump($display_months->displayAllMonths());

//var_dump($paginator->displayEvensValues());

$range = $paginator->mergeTwoArrays($odds_values, $evens_values);

$total = $paginator->countAllItems($range);
//var_dump($range);



$page = $paginator->lastPage(4);
//var_dump($total);
$result = $paginator->showResult(3,8);


//var_dump($result);


//**********************************************************//
//                   EXO 3                                  //
// *********************************************************//

$connect = new \Db_connect\DBManager();

//var_dump($connect->getConfig());

$cuurent_user =(new User())->read(1);
$user_want_to_blacklist = (new User())->read(3);

var_dump($cuurent_user);

$blacklist = new Exo3BlackList($cuurent_user);
//var_dump($blacklist->add($user_want_to_blacklist));
var_dump($blacklist->remove($user_want_to_blacklist));


var_dump($blacklist);