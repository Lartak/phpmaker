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
$orderdetails_delete = new orderdetails_delete();

// Run the page
$orderdetails_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orderdetails_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var forderdetailsdelete = currentForm = new ew.Form("forderdetailsdelete", "delete");

// Form_CustomValidate event
forderdetailsdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
forderdetailsdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $orderdetails_delete->showPageHeader(); ?>
<?php
$orderdetails_delete->showMessage();
?>
<form name="forderdetailsdelete" id="forderdetailsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($orderdetails_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $orderdetails_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orderdetails">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($orderdetails_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($orderdetails->OrderID->Visible) { // OrderID ?>
		<th class="<?php echo $orderdetails->OrderID->headerCellClass() ?>"><span id="elh_orderdetails_OrderID" class="orderdetails_OrderID"><?php echo $orderdetails->OrderID->caption() ?></span></th>
<?php } ?>
<?php if ($orderdetails->ProductID->Visible) { // ProductID ?>
		<th class="<?php echo $orderdetails->ProductID->headerCellClass() ?>"><span id="elh_orderdetails_ProductID" class="orderdetails_ProductID"><?php echo $orderdetails->ProductID->caption() ?></span></th>
<?php } ?>
<?php if ($orderdetails->UnitPrice->Visible) { // UnitPrice ?>
		<th class="<?php echo $orderdetails->UnitPrice->headerCellClass() ?>"><span id="elh_orderdetails_UnitPrice" class="orderdetails_UnitPrice"><?php echo $orderdetails->UnitPrice->caption() ?></span></th>
<?php } ?>
<?php if ($orderdetails->Quantity->Visible) { // Quantity ?>
		<th class="<?php echo $orderdetails->Quantity->headerCellClass() ?>"><span id="elh_orderdetails_Quantity" class="orderdetails_Quantity"><?php echo $orderdetails->Quantity->caption() ?></span></th>
<?php } ?>
<?php if ($orderdetails->Discount->Visible) { // Discount ?>
		<th class="<?php echo $orderdetails->Discount->headerCellClass() ?>"><span id="elh_orderdetails_Discount" class="orderdetails_Discount"><?php echo $orderdetails->Discount->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$orderdetails_delete->RecCnt = 0;
$i = 0;
while (!$orderdetails_delete->Recordset->EOF) {
	$orderdetails_delete->RecCnt++;
	$orderdetails_delete->RowCnt++;

	// Set row properties
	$orderdetails->resetAttributes();
	$orderdetails->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$orderdetails_delete->loadRowValues($orderdetails_delete->Recordset);

	// Render row
	$orderdetails_delete->renderRow();
?>
	<tr<?php echo $orderdetails->rowAttributes() ?>>
<?php if ($orderdetails->OrderID->Visible) { // OrderID ?>
		<td<?php echo $orderdetails->OrderID->cellAttributes() ?>>
<span id="el<?php echo $orderdetails_delete->RowCnt ?>_orderdetails_OrderID" class="orderdetails_OrderID">
<span<?php echo $orderdetails->OrderID->viewAttributes() ?>>
<?php echo $orderdetails->OrderID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orderdetails->ProductID->Visible) { // ProductID ?>
		<td<?php echo $orderdetails->ProductID->cellAttributes() ?>>
<span id="el<?php echo $orderdetails_delete->RowCnt ?>_orderdetails_ProductID" class="orderdetails_ProductID">
<span<?php echo $orderdetails->ProductID->viewAttributes() ?>>
<?php echo $orderdetails->ProductID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orderdetails->UnitPrice->Visible) { // UnitPrice ?>
		<td<?php echo $orderdetails->UnitPrice->cellAttributes() ?>>
<span id="el<?php echo $orderdetails_delete->RowCnt ?>_orderdetails_UnitPrice" class="orderdetails_UnitPrice">
<span<?php echo $orderdetails->UnitPrice->viewAttributes() ?>>
<?php echo $orderdetails->UnitPrice->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orderdetails->Quantity->Visible) { // Quantity ?>
		<td<?php echo $orderdetails->Quantity->cellAttributes() ?>>
<span id="el<?php echo $orderdetails_delete->RowCnt ?>_orderdetails_Quantity" class="orderdetails_Quantity">
<span<?php echo $orderdetails->Quantity->viewAttributes() ?>>
<?php echo $orderdetails->Quantity->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orderdetails->Discount->Visible) { // Discount ?>
		<td<?php echo $orderdetails->Discount->cellAttributes() ?>>
<span id="el<?php echo $orderdetails_delete->RowCnt ?>_orderdetails_Discount" class="orderdetails_Discount">
<span<?php echo $orderdetails->Discount->viewAttributes() ?>>
<?php echo $orderdetails->Discount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$orderdetails_delete->Recordset->moveNext();
}
$orderdetails_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $orderdetails_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$orderdetails_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$orderdetails_delete->terminate();
?>
