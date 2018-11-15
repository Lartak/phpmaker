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
$suppliers_delete = new suppliers_delete();

// Run the page
$suppliers_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$suppliers_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fsuppliersdelete = currentForm = new ew.Form("fsuppliersdelete", "delete");

// Form_CustomValidate event
fsuppliersdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fsuppliersdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $suppliers_delete->showPageHeader(); ?>
<?php
$suppliers_delete->showMessage();
?>
<form name="fsuppliersdelete" id="fsuppliersdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($suppliers_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $suppliers_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="suppliers">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($suppliers_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($suppliers->SupplierID->Visible) { // SupplierID ?>
		<th class="<?php echo $suppliers->SupplierID->headerCellClass() ?>"><span id="elh_suppliers_SupplierID" class="suppliers_SupplierID"><?php echo $suppliers->SupplierID->caption() ?></span></th>
<?php } ?>
<?php if ($suppliers->CompanyName->Visible) { // CompanyName ?>
		<th class="<?php echo $suppliers->CompanyName->headerCellClass() ?>"><span id="elh_suppliers_CompanyName" class="suppliers_CompanyName"><?php echo $suppliers->CompanyName->caption() ?></span></th>
<?php } ?>
<?php if ($suppliers->ContactName->Visible) { // ContactName ?>
		<th class="<?php echo $suppliers->ContactName->headerCellClass() ?>"><span id="elh_suppliers_ContactName" class="suppliers_ContactName"><?php echo $suppliers->ContactName->caption() ?></span></th>
<?php } ?>
<?php if ($suppliers->ContactTitle->Visible) { // ContactTitle ?>
		<th class="<?php echo $suppliers->ContactTitle->headerCellClass() ?>"><span id="elh_suppliers_ContactTitle" class="suppliers_ContactTitle"><?php echo $suppliers->ContactTitle->caption() ?></span></th>
<?php } ?>
<?php if ($suppliers->Address->Visible) { // Address ?>
		<th class="<?php echo $suppliers->Address->headerCellClass() ?>"><span id="elh_suppliers_Address" class="suppliers_Address"><?php echo $suppliers->Address->caption() ?></span></th>
<?php } ?>
<?php if ($suppliers->City->Visible) { // City ?>
		<th class="<?php echo $suppliers->City->headerCellClass() ?>"><span id="elh_suppliers_City" class="suppliers_City"><?php echo $suppliers->City->caption() ?></span></th>
<?php } ?>
<?php if ($suppliers->Region->Visible) { // Region ?>
		<th class="<?php echo $suppliers->Region->headerCellClass() ?>"><span id="elh_suppliers_Region" class="suppliers_Region"><?php echo $suppliers->Region->caption() ?></span></th>
<?php } ?>
<?php if ($suppliers->PostalCode->Visible) { // PostalCode ?>
		<th class="<?php echo $suppliers->PostalCode->headerCellClass() ?>"><span id="elh_suppliers_PostalCode" class="suppliers_PostalCode"><?php echo $suppliers->PostalCode->caption() ?></span></th>
<?php } ?>
<?php if ($suppliers->Country->Visible) { // Country ?>
		<th class="<?php echo $suppliers->Country->headerCellClass() ?>"><span id="elh_suppliers_Country" class="suppliers_Country"><?php echo $suppliers->Country->caption() ?></span></th>
<?php } ?>
<?php if ($suppliers->Phone->Visible) { // Phone ?>
		<th class="<?php echo $suppliers->Phone->headerCellClass() ?>"><span id="elh_suppliers_Phone" class="suppliers_Phone"><?php echo $suppliers->Phone->caption() ?></span></th>
<?php } ?>
<?php if ($suppliers->Fax->Visible) { // Fax ?>
		<th class="<?php echo $suppliers->Fax->headerCellClass() ?>"><span id="elh_suppliers_Fax" class="suppliers_Fax"><?php echo $suppliers->Fax->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$suppliers_delete->RecCnt = 0;
$i = 0;
while (!$suppliers_delete->Recordset->EOF) {
	$suppliers_delete->RecCnt++;
	$suppliers_delete->RowCnt++;

	// Set row properties
	$suppliers->resetAttributes();
	$suppliers->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$suppliers_delete->loadRowValues($suppliers_delete->Recordset);

	// Render row
	$suppliers_delete->renderRow();
?>
	<tr<?php echo $suppliers->rowAttributes() ?>>
<?php if ($suppliers->SupplierID->Visible) { // SupplierID ?>
		<td<?php echo $suppliers->SupplierID->cellAttributes() ?>>
<span id="el<?php echo $suppliers_delete->RowCnt ?>_suppliers_SupplierID" class="suppliers_SupplierID">
<span<?php echo $suppliers->SupplierID->viewAttributes() ?>>
<?php echo $suppliers->SupplierID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($suppliers->CompanyName->Visible) { // CompanyName ?>
		<td<?php echo $suppliers->CompanyName->cellAttributes() ?>>
<span id="el<?php echo $suppliers_delete->RowCnt ?>_suppliers_CompanyName" class="suppliers_CompanyName">
<span<?php echo $suppliers->CompanyName->viewAttributes() ?>>
<?php echo $suppliers->CompanyName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($suppliers->ContactName->Visible) { // ContactName ?>
		<td<?php echo $suppliers->ContactName->cellAttributes() ?>>
<span id="el<?php echo $suppliers_delete->RowCnt ?>_suppliers_ContactName" class="suppliers_ContactName">
<span<?php echo $suppliers->ContactName->viewAttributes() ?>>
<?php echo $suppliers->ContactName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($suppliers->ContactTitle->Visible) { // ContactTitle ?>
		<td<?php echo $suppliers->ContactTitle->cellAttributes() ?>>
<span id="el<?php echo $suppliers_delete->RowCnt ?>_suppliers_ContactTitle" class="suppliers_ContactTitle">
<span<?php echo $suppliers->ContactTitle->viewAttributes() ?>>
<?php echo $suppliers->ContactTitle->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($suppliers->Address->Visible) { // Address ?>
		<td<?php echo $suppliers->Address->cellAttributes() ?>>
<span id="el<?php echo $suppliers_delete->RowCnt ?>_suppliers_Address" class="suppliers_Address">
<span<?php echo $suppliers->Address->viewAttributes() ?>>
<?php echo $suppliers->Address->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($suppliers->City->Visible) { // City ?>
		<td<?php echo $suppliers->City->cellAttributes() ?>>
<span id="el<?php echo $suppliers_delete->RowCnt ?>_suppliers_City" class="suppliers_City">
<span<?php echo $suppliers->City->viewAttributes() ?>>
<?php echo $suppliers->City->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($suppliers->Region->Visible) { // Region ?>
		<td<?php echo $suppliers->Region->cellAttributes() ?>>
<span id="el<?php echo $suppliers_delete->RowCnt ?>_suppliers_Region" class="suppliers_Region">
<span<?php echo $suppliers->Region->viewAttributes() ?>>
<?php echo $suppliers->Region->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($suppliers->PostalCode->Visible) { // PostalCode ?>
		<td<?php echo $suppliers->PostalCode->cellAttributes() ?>>
<span id="el<?php echo $suppliers_delete->RowCnt ?>_suppliers_PostalCode" class="suppliers_PostalCode">
<span<?php echo $suppliers->PostalCode->viewAttributes() ?>>
<?php echo $suppliers->PostalCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($suppliers->Country->Visible) { // Country ?>
		<td<?php echo $suppliers->Country->cellAttributes() ?>>
<span id="el<?php echo $suppliers_delete->RowCnt ?>_suppliers_Country" class="suppliers_Country">
<span<?php echo $suppliers->Country->viewAttributes() ?>>
<?php echo $suppliers->Country->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($suppliers->Phone->Visible) { // Phone ?>
		<td<?php echo $suppliers->Phone->cellAttributes() ?>>
<span id="el<?php echo $suppliers_delete->RowCnt ?>_suppliers_Phone" class="suppliers_Phone">
<span<?php echo $suppliers->Phone->viewAttributes() ?>>
<?php echo $suppliers->Phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($suppliers->Fax->Visible) { // Fax ?>
		<td<?php echo $suppliers->Fax->cellAttributes() ?>>
<span id="el<?php echo $suppliers_delete->RowCnt ?>_suppliers_Fax" class="suppliers_Fax">
<span<?php echo $suppliers->Fax->viewAttributes() ?>>
<?php echo $suppliers->Fax->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$suppliers_delete->Recordset->moveNext();
}
$suppliers_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $suppliers_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$suppliers_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$suppliers_delete->terminate();
?>
