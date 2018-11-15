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
$shippers_delete = new shippers_delete();

// Run the page
$shippers_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$shippers_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fshippersdelete = currentForm = new ew.Form("fshippersdelete", "delete");

// Form_CustomValidate event
fshippersdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fshippersdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $shippers_delete->showPageHeader(); ?>
<?php
$shippers_delete->showMessage();
?>
<form name="fshippersdelete" id="fshippersdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($shippers_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $shippers_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="shippers">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($shippers_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($shippers->ShipperID->Visible) { // ShipperID ?>
		<th class="<?php echo $shippers->ShipperID->headerCellClass() ?>"><span id="elh_shippers_ShipperID" class="shippers_ShipperID"><?php echo $shippers->ShipperID->caption() ?></span></th>
<?php } ?>
<?php if ($shippers->CompanyName->Visible) { // CompanyName ?>
		<th class="<?php echo $shippers->CompanyName->headerCellClass() ?>"><span id="elh_shippers_CompanyName" class="shippers_CompanyName"><?php echo $shippers->CompanyName->caption() ?></span></th>
<?php } ?>
<?php if ($shippers->Phone->Visible) { // Phone ?>
		<th class="<?php echo $shippers->Phone->headerCellClass() ?>"><span id="elh_shippers_Phone" class="shippers_Phone"><?php echo $shippers->Phone->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$shippers_delete->RecCnt = 0;
$i = 0;
while (!$shippers_delete->Recordset->EOF) {
	$shippers_delete->RecCnt++;
	$shippers_delete->RowCnt++;

	// Set row properties
	$shippers->resetAttributes();
	$shippers->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$shippers_delete->loadRowValues($shippers_delete->Recordset);

	// Render row
	$shippers_delete->renderRow();
?>
	<tr<?php echo $shippers->rowAttributes() ?>>
<?php if ($shippers->ShipperID->Visible) { // ShipperID ?>
		<td<?php echo $shippers->ShipperID->cellAttributes() ?>>
<span id="el<?php echo $shippers_delete->RowCnt ?>_shippers_ShipperID" class="shippers_ShipperID">
<span<?php echo $shippers->ShipperID->viewAttributes() ?>>
<?php echo $shippers->ShipperID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($shippers->CompanyName->Visible) { // CompanyName ?>
		<td<?php echo $shippers->CompanyName->cellAttributes() ?>>
<span id="el<?php echo $shippers_delete->RowCnt ?>_shippers_CompanyName" class="shippers_CompanyName">
<span<?php echo $shippers->CompanyName->viewAttributes() ?>>
<?php echo $shippers->CompanyName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($shippers->Phone->Visible) { // Phone ?>
		<td<?php echo $shippers->Phone->cellAttributes() ?>>
<span id="el<?php echo $shippers_delete->RowCnt ?>_shippers_Phone" class="shippers_Phone">
<span<?php echo $shippers->Phone->viewAttributes() ?>>
<?php echo $shippers->Phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$shippers_delete->Recordset->moveNext();
}
$shippers_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $shippers_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$shippers_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$shippers_delete->terminate();
?>
