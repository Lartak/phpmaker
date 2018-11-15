<?php
namespace PHPMaker2019\demo2019;

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(1, "mi_cars", $Language->MenuPhrase("1", "MenuText"), "carslist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(2, "mi_cars2", $Language->MenuPhrase("2", "MenuText"), "cars2list.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(3, "mi_categories", $Language->MenuPhrase("3", "MenuText"), "categorieslist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(4, "mi_customers", $Language->MenuPhrase("4", "MenuText"), "customerslist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(6, "mi_employees", $Language->MenuPhrase("6", "MenuText"), "employeeslist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(8, "mi_models", $Language->MenuPhrase("8", "MenuText"), "modelslist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(9, "mi_order_details_extended", $Language->MenuPhrase("9", "MenuText"), "order_details_extendedlist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(10, "mi_orderdetails", $Language->MenuPhrase("10", "MenuText"), "orderdetailslist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(11, "mi_orders", $Language->MenuPhrase("11", "MenuText"), "orderslist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(12, "mi_orders2", $Language->MenuPhrase("12", "MenuText"), "orders2list.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(13, "mi_products", $Language->MenuPhrase("13", "MenuText"), "productslist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(14, "mi_shippers", $Language->MenuPhrase("14", "MenuText"), "shipperslist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(15, "mi_suppliers", $Language->MenuPhrase("15", "MenuText"), "supplierslist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(16, "mi_trademarks", $Language->MenuPhrase("16", "MenuText"), "trademarkslist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(17, "mi_userlevelpermissions", $Language->MenuPhrase("17", "MenuText"), "userlevelpermissionslist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(18, "mi_userlevels", $Language->MenuPhrase("18", "MenuText"), "userlevelslist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(19, "mi_dji", $Language->MenuPhrase("19", "MenuText"), "djilist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(20, "mi_gantt", $Language->MenuPhrase("20", "MenuText"), "ganttlist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>
