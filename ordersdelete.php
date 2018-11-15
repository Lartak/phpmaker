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
$orders_delete = new orders_delete();

// Run the page
$orders_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orders_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fordersdelete = currentForm = new ew.Form("fordersdelete", "delete");

// Form_CustomValidate event
fordersdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fordersdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $orders_delete->showPageHeader(); ?>
<?php
$orders_delete->showMessage();
?>
<form name="fordersdelete" id="fordersdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($orders_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $orders_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orders">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($orders_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($orders->OrderID->Visible) { // OrderID ?>
		<th class="<?php echo $orders->OrderID->headerCellClass() ?>"><span id="elh_orders_OrderID" class="orders_OrderID"><?php echo $orders->OrderID->caption() ?></span></th>
<?php } ?>
<?php if ($orders->CustomerID->Visible) { // CustomerID ?>
		<th class="<?php echo $orders->CustomerID->headerCellClass() ?>"><span id="elh_orders_CustomerID" class="orders_CustomerID"><?php echo $orders->CustomerID->caption() ?></span></th>
<?php } ?>
<?php if ($orders->EmployeeID->Visible) { // EmployeeID ?>
		<th class="<?php echo $orders->EmployeeID->headerCellClass() ?>"><span id="elh_orders_EmployeeID" class="orders_EmployeeID"><?php echo $orders->EmployeeID->caption() ?></span></th>
<?php } ?>
<?php if ($orders->OrderDate->Visible) { // OrderDate ?>
		<th class="<?php echo $orders->OrderDate->headerCellClass() ?>"><span id="elh_orders_OrderDate" class="orders_OrderDate"><?php echo $orders->OrderDate->caption() ?></span></th>
<?php } ?>
<?php if ($orders->RequiredDate->Visible) { // RequiredDate ?>
		<th class="<?php echo $orders->RequiredDate->headerCellClass() ?>"><span id="elh_orders_RequiredDate" class="orders_RequiredDate"><?php echo $orders->RequiredDate->caption() ?></span></th>
<?php } ?>
<?php if ($orders->ShippedDate->Visible) { // ShippedDate ?>
		<th class="<?php echo $orders->ShippedDate->headerCellClass() ?>"><span id="elh_orders_ShippedDate" class="orders_ShippedDate"><?php echo $orders->ShippedDate->caption() ?></span></th>
<?php } ?>
<?php if ($orders->ShipVia->Visible) { // ShipVia ?>
		<th class="<?php echo $orders->ShipVia->headerCellClass() ?>"><span id="elh_orders_ShipVia" class="orders_ShipVia"><?php echo $orders->ShipVia->caption() ?></span></th>
<?php } ?>
<?php if ($orders->Freight->Visible) { // Freight ?>
		<th class="<?php echo $orders->Freight->headerCellClass() ?>"><span id="elh_orders_Freight" class="orders_Freight"><?php echo $orders->Freight->caption() ?></span></th>
<?php } ?>
<?php if ($orders->ShipName->Visible) { // ShipName ?>
		<th class="<?php echo $orders->ShipName->headerCellClass() ?>"><span id="elh_orders_ShipName" class="orders_ShipName"><?php echo $orders->ShipName->caption() ?></span></th>
<?php } ?>
<?php if ($orders->ShipAddress->Visible) { // ShipAddress ?>
		<th class="<?php echo $orders->ShipAddress->headerCellClass() ?>"><span id="elh_orders_ShipAddress" class="orders_ShipAddress"><?php echo $orders->ShipAddress->caption() ?></span></th>
<?php } ?>
<?php if ($orders->ShipCity->Visible) { // ShipCity ?>
		<th class="<?php echo $orders->ShipCity->headerCellClass() ?>"><span id="elh_orders_ShipCity" class="orders_ShipCity"><?php echo $orders->ShipCity->caption() ?></span></th>
<?php } ?>
<?php if ($orders->ShipRegion->Visible) { // ShipRegion ?>
		<th class="<?php echo $orders->ShipRegion->headerCellClass() ?>"><span id="elh_orders_ShipRegion" class="orders_ShipRegion"><?php echo $orders->ShipRegion->caption() ?></span></th>
<?php } ?>
<?php if ($orders->ShipPostalCode->Visible) { // ShipPostalCode ?>
		<th class="<?php echo $orders->ShipPostalCode->headerCellClass() ?>"><span id="elh_orders_ShipPostalCode" class="orders_ShipPostalCode"><?php echo $orders->ShipPostalCode->caption() ?></span></th>
<?php } ?>
<?php if ($orders->ShipCountry->Visible) { // ShipCountry ?>
		<th class="<?php echo $orders->ShipCountry->headerCellClass() ?>"><span id="elh_orders_ShipCountry" class="orders_ShipCountry"><?php echo $orders->ShipCountry->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$orders_delete->RecCnt = 0;
$i = 0;
while (!$orders_delete->Recordset->EOF) {
	$orders_delete->RecCnt++;
	$orders_delete->RowCnt++;

	// Set row properties
	$orders->resetAttributes();
	$orders->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$orders_delete->loadRowValues($orders_delete->Recordset);

	// Render row
	$orders_delete->renderRow();
?>
	<tr<?php echo $orders->rowAttributes() ?>>
<?php if ($orders->OrderID->Visible) { // OrderID ?>
		<td<?php echo $orders->OrderID->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCnt ?>_orders_OrderID" class="orders_OrderID">
<span<?php echo $orders->OrderID->viewAttributes() ?>>
<?php echo $orders->OrderID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders->CustomerID->Visible) { // CustomerID ?>
		<td<?php echo $orders->CustomerID->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCnt ?>_orders_CustomerID" class="orders_CustomerID">
<span<?php echo $orders->CustomerID->viewAttributes() ?>>
<?php echo $orders->CustomerID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders->EmployeeID->Visible) { // EmployeeID ?>
		<td<?php echo $orders->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCnt ?>_orders_EmployeeID" class="orders_EmployeeID">
<span<?php echo $orders->EmployeeID->viewAttributes() ?>>
<?php echo $orders->EmployeeID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders->OrderDate->Visible) { // OrderDate ?>
		<td<?php echo $orders->OrderDate->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCnt ?>_orders_OrderDate" class="orders_OrderDate">
<span<?php echo $orders->OrderDate->viewAttributes() ?>>
<?php echo $orders->OrderDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders->RequiredDate->Visible) { // RequiredDate ?>
		<td<?php echo $orders->RequiredDate->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCnt ?>_orders_RequiredDate" class="orders_RequiredDate">
<span<?php echo $orders->RequiredDate->viewAttributes() ?>>
<?php echo $orders->RequiredDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders->ShippedDate->Visible) { // ShippedDate ?>
		<td<?php echo $orders->ShippedDate->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCnt ?>_orders_ShippedDate" class="orders_ShippedDate">
<span<?php echo $orders->ShippedDate->viewAttributes() ?>>
<?php echo $orders->ShippedDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders->ShipVia->Visible) { // ShipVia ?>
		<td<?php echo $orders->ShipVia->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCnt ?>_orders_ShipVia" class="orders_ShipVia">
<span<?php echo $orders->ShipVia->viewAttributes() ?>>
<?php echo $orders->ShipVia->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders->Freight->Visible) { // Freight ?>
		<td<?php echo $orders->Freight->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCnt ?>_orders_Freight" class="orders_Freight">
<span<?php echo $orders->Freight->viewAttributes() ?>>
<?php echo $orders->Freight->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders->ShipName->Visible) { // ShipName ?>
		<td<?php echo $orders->ShipName->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCnt ?>_orders_ShipName" class="orders_ShipName">
<span<?php echo $orders->ShipName->viewAttributes() ?>>
<?php echo $orders->ShipName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders->ShipAddress->Visible) { // ShipAddress ?>
		<td<?php echo $orders->ShipAddress->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCnt ?>_orders_ShipAddress" class="orders_ShipAddress">
<span<?php echo $orders->ShipAddress->viewAttributes() ?>>
<?php echo $orders->ShipAddress->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders->ShipCity->Visible) { // ShipCity ?>
		<td<?php echo $orders->ShipCity->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCnt ?>_orders_ShipCity" class="orders_ShipCity">
<span<?php echo $orders->ShipCity->viewAttributes() ?>>
<?php echo $orders->ShipCity->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders->ShipRegion->Visible) { // ShipRegion ?>
		<td<?php echo $orders->ShipRegion->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCnt ?>_orders_ShipRegion" class="orders_ShipRegion">
<span<?php echo $orders->ShipRegion->viewAttributes() ?>>
<?php echo $orders->ShipRegion->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders->ShipPostalCode->Visible) { // ShipPostalCode ?>
		<td<?php echo $orders->ShipPostalCode->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCnt ?>_orders_ShipPostalCode" class="orders_ShipPostalCode">
<span<?php echo $orders->ShipPostalCode->viewAttributes() ?>>
<?php echo $orders->ShipPostalCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders->ShipCountry->Visible) { // ShipCountry ?>
		<td<?php echo $orders->ShipCountry->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCnt ?>_orders_ShipCountry" class="orders_ShipCountry">
<span<?php echo $orders->ShipCountry->viewAttributes() ?>>
<?php echo $orders->ShipCountry->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$orders_delete->Recordset->moveNext();
}
$orders_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $orders_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$orders_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$orders_delete->terminate();
?>
