<?php
namespace PHPMaker2019\demo2019;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$orders_view = new orders_view();

// Run the page
$orders_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orders_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$orders->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fordersview = currentForm = new ew.Form("fordersview", "view");

// Form_CustomValidate event
fordersview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fordersview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$orders->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $orders_view->ExportOptions->render("body") ?>
<?php
	foreach ($orders_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $orders_view->showPageHeader(); ?>
<?php
$orders_view->showMessage();
?>
<?php if (!$orders_view->IsModal) { ?>
<?php if (!$orders->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($orders_view->Pager)) $orders_view->Pager = new PrevNextPager($orders_view->StartRec, $orders_view->DisplayRecs, $orders_view->TotalRecs, $orders_view->AutoHidePager) ?>
<?php if ($orders_view->Pager->RecordCount > 0 && $orders_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($orders_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $orders_view->pageUrl() ?>start=<?php echo $orders_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($orders_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $orders_view->pageUrl() ?>start=<?php echo $orders_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $orders_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($orders_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $orders_view->pageUrl() ?>start=<?php echo $orders_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($orders_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $orders_view->pageUrl() ?>start=<?php echo $orders_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $orders_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fordersview" id="fordersview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($orders_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $orders_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orders">
<input type="hidden" name="modal" value="<?php echo (int)$orders_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($orders->OrderID->Visible) { // OrderID ?>
	<tr id="r_OrderID">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_OrderID"><?php echo $orders->OrderID->caption() ?></span></td>
		<td data-name="OrderID"<?php echo $orders->OrderID->cellAttributes() ?>>
<span id="el_orders_OrderID">
<span<?php echo $orders->OrderID->viewAttributes() ?>>
<?php echo $orders->OrderID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders->CustomerID->Visible) { // CustomerID ?>
	<tr id="r_CustomerID">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_CustomerID"><?php echo $orders->CustomerID->caption() ?></span></td>
		<td data-name="CustomerID"<?php echo $orders->CustomerID->cellAttributes() ?>>
<span id="el_orders_CustomerID">
<span<?php echo $orders->CustomerID->viewAttributes() ?>>
<?php echo $orders->CustomerID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders->EmployeeID->Visible) { // EmployeeID ?>
	<tr id="r_EmployeeID">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_EmployeeID"><?php echo $orders->EmployeeID->caption() ?></span></td>
		<td data-name="EmployeeID"<?php echo $orders->EmployeeID->cellAttributes() ?>>
<span id="el_orders_EmployeeID">
<span<?php echo $orders->EmployeeID->viewAttributes() ?>>
<?php echo $orders->EmployeeID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders->OrderDate->Visible) { // OrderDate ?>
	<tr id="r_OrderDate">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_OrderDate"><?php echo $orders->OrderDate->caption() ?></span></td>
		<td data-name="OrderDate"<?php echo $orders->OrderDate->cellAttributes() ?>>
<span id="el_orders_OrderDate">
<span<?php echo $orders->OrderDate->viewAttributes() ?>>
<?php echo $orders->OrderDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders->RequiredDate->Visible) { // RequiredDate ?>
	<tr id="r_RequiredDate">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_RequiredDate"><?php echo $orders->RequiredDate->caption() ?></span></td>
		<td data-name="RequiredDate"<?php echo $orders->RequiredDate->cellAttributes() ?>>
<span id="el_orders_RequiredDate">
<span<?php echo $orders->RequiredDate->viewAttributes() ?>>
<?php echo $orders->RequiredDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders->ShippedDate->Visible) { // ShippedDate ?>
	<tr id="r_ShippedDate">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_ShippedDate"><?php echo $orders->ShippedDate->caption() ?></span></td>
		<td data-name="ShippedDate"<?php echo $orders->ShippedDate->cellAttributes() ?>>
<span id="el_orders_ShippedDate">
<span<?php echo $orders->ShippedDate->viewAttributes() ?>>
<?php echo $orders->ShippedDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders->ShipVia->Visible) { // ShipVia ?>
	<tr id="r_ShipVia">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_ShipVia"><?php echo $orders->ShipVia->caption() ?></span></td>
		<td data-name="ShipVia"<?php echo $orders->ShipVia->cellAttributes() ?>>
<span id="el_orders_ShipVia">
<span<?php echo $orders->ShipVia->viewAttributes() ?>>
<?php echo $orders->ShipVia->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders->Freight->Visible) { // Freight ?>
	<tr id="r_Freight">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_Freight"><?php echo $orders->Freight->caption() ?></span></td>
		<td data-name="Freight"<?php echo $orders->Freight->cellAttributes() ?>>
<span id="el_orders_Freight">
<span<?php echo $orders->Freight->viewAttributes() ?>>
<?php echo $orders->Freight->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders->ShipName->Visible) { // ShipName ?>
	<tr id="r_ShipName">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_ShipName"><?php echo $orders->ShipName->caption() ?></span></td>
		<td data-name="ShipName"<?php echo $orders->ShipName->cellAttributes() ?>>
<span id="el_orders_ShipName">
<span<?php echo $orders->ShipName->viewAttributes() ?>>
<?php echo $orders->ShipName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders->ShipAddress->Visible) { // ShipAddress ?>
	<tr id="r_ShipAddress">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_ShipAddress"><?php echo $orders->ShipAddress->caption() ?></span></td>
		<td data-name="ShipAddress"<?php echo $orders->ShipAddress->cellAttributes() ?>>
<span id="el_orders_ShipAddress">
<span<?php echo $orders->ShipAddress->viewAttributes() ?>>
<?php echo $orders->ShipAddress->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders->ShipCity->Visible) { // ShipCity ?>
	<tr id="r_ShipCity">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_ShipCity"><?php echo $orders->ShipCity->caption() ?></span></td>
		<td data-name="ShipCity"<?php echo $orders->ShipCity->cellAttributes() ?>>
<span id="el_orders_ShipCity">
<span<?php echo $orders->ShipCity->viewAttributes() ?>>
<?php echo $orders->ShipCity->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders->ShipRegion->Visible) { // ShipRegion ?>
	<tr id="r_ShipRegion">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_ShipRegion"><?php echo $orders->ShipRegion->caption() ?></span></td>
		<td data-name="ShipRegion"<?php echo $orders->ShipRegion->cellAttributes() ?>>
<span id="el_orders_ShipRegion">
<span<?php echo $orders->ShipRegion->viewAttributes() ?>>
<?php echo $orders->ShipRegion->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders->ShipPostalCode->Visible) { // ShipPostalCode ?>
	<tr id="r_ShipPostalCode">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_ShipPostalCode"><?php echo $orders->ShipPostalCode->caption() ?></span></td>
		<td data-name="ShipPostalCode"<?php echo $orders->ShipPostalCode->cellAttributes() ?>>
<span id="el_orders_ShipPostalCode">
<span<?php echo $orders->ShipPostalCode->viewAttributes() ?>>
<?php echo $orders->ShipPostalCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders->ShipCountry->Visible) { // ShipCountry ?>
	<tr id="r_ShipCountry">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_ShipCountry"><?php echo $orders->ShipCountry->caption() ?></span></td>
		<td data-name="ShipCountry"<?php echo $orders->ShipCountry->cellAttributes() ?>>
<span id="el_orders_ShipCountry">
<span<?php echo $orders->ShipCountry->viewAttributes() ?>>
<?php echo $orders->ShipCountry->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$orders_view->IsModal) { ?>
<?php if (!$orders->isExport()) { ?>
<?php if (!isset($orders_view->Pager)) $orders_view->Pager = new PrevNextPager($orders_view->StartRec, $orders_view->DisplayRecs, $orders_view->TotalRecs, $orders_view->AutoHidePager) ?>
<?php if ($orders_view->Pager->RecordCount > 0 && $orders_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($orders_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $orders_view->pageUrl() ?>start=<?php echo $orders_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($orders_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $orders_view->pageUrl() ?>start=<?php echo $orders_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $orders_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($orders_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $orders_view->pageUrl() ?>start=<?php echo $orders_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($orders_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $orders_view->pageUrl() ?>start=<?php echo $orders_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $orders_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$orders_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$orders->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$orders_view->terminate();
?>
