





<?php 
include 'view/head.php';
include 'view/header.php';


//------------------------------------Page-Stocks-----------------------------------------
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['load_stocks'])) {
    if ($_SESSION['role'] !== 'employe') {
        loadStocksPage();
    } else {
        echo "<p style='color:red; text-align:center;'>Accès refusé : réservé aux administrateurs.</p>";
    }
}

function loadStocksPage() {
    include 'view/stocks.php';
}
//-----------------------------------------------------------------------------------------



//------------------------------------Page-Clients-----------------------------------------
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['load_clients'])) {
    if ($_SESSION['role'] !== 'employe') {
        loadClientsPage();
    } else {
        echo "<p style='color:red; text-align:center;'>Accès refusé : réservé aux administrateurs.</p>";
    }
}

function loadClientsPage() {
    include 'view/clients.php';
}
//-----------------------------------------------------------------------------------------

//------------------------------------Page-Commandes---------------------------------------
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['load_commandes'])) {
    loadCommandesPage();
}

function loadCommandesPage() {
    include 'view/commandes.php';
}
//-----------------------------------------------------------------------------------------

//------------------------------------Page-Home-----------------------------------------
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['load_home'])) {
    loadHomePage();
}

function loadHomePage() {
    include 'view/home.php';
}
//-----------------------------------------------------------------------------------------

include 'view/footer.php';

?>