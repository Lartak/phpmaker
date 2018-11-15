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
$customers_delete = new customers_delete();

// Run the page
$customers_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$customers_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fcustomersdelete = currentForm = new ew.Form("fcustomersdelete", "delete");

// Form_CustomValidate event
fcustomersdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcustomersdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $customers_delete->showPageHeader(); ?>
<?php
$customers_delete->showMessage();
?>
<form name="fcustomersdelete" id="fcustomersdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($customers_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $customers_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="customers">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($customers_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($customers->CustomerID->Visible) { // CustomerID ?>
		<th class="<?php echo $customers->CustomerID->headerCellClass() ?>"><span id="elh_customers_CustomerID" class="customers_CustomerID"><?php echo $customers->CustomerID->caption() ?></span></th>
<?php } ?>
<?php if ($customers->CompanyName->Visible) { // CompanyName ?>
		<th class="<?php echo $customers->CompanyName->headerCellClass() ?>"><span id="elh_customers_CompanyName" class="customers_CompanyName"><?php echo $customers->CompanyName->caption() ?></span></th>
<?php } ?>
<?php if ($customers->ContactName->Visible) { // ContactName ?>
		<th class="<?php echo $customers->ContactName->headerCellClass() ?>"><span id="elh_customers_ContactName" class="customers_ContactName"><?php echo $customers->ContactName->caption() ?></span></th>
<?php } ?>
<?php if ($customers->ContactTitle->Visible) { // ContactTitle ?>
		<th class="<?php echo $customers->ContactTitle->headerCellClass() ?>"><span id="elh_customers_ContactTitle" class="customers_ContactTitle"><?php echo $customers->ContactTitle->caption() ?></span></th>
<?php } ?>
<?php if ($customers->Address->Visible) { // Address ?>
		<th class="<?php echo $customers->Address->headerCellClass() ?>"><span id="elh_customers_Address" class="customers_Address"><?php echo $customers->Address->caption() ?></span></th>
<?php } ?>
<?php if ($customers->City->Visible) { // City ?>
		<th class="<?php echo $customers->City->headerCellClass() ?>"><span id="elh_customers_City" class="customers_City"><?php echo $customers->City->caption() ?></span></th>
<?php } ?>
<?php if ($customers->Region->Visible) { // Region ?>
		<th class="<?php echo $customers->Region->headerCellClass() ?>"><span id="elh_customers_Region" class="customers_Region"><?php echo $customers->Region->caption() ?></span></th>
<?php } ?>
<?php if ($customers->PostalCode->Visible) { // PostalCode ?>
		<th class="<?php echo $customers->PostalCode->headerCellClass() ?>"><span id="elh_customers_PostalCode" class="customers_PostalCode"><?php echo $customers->PostalCode->caption() ?></span></th>
<?php } ?>
<?php if ($customers->Country->Visible) { // Country ?>
		<th class="<?php echo $customers->Country->headerCellClass() ?>"><span id="elh_customers_Country" class="customers_Country"><?php echo $customers->Country->caption() ?></span></th>
<?php } ?>
<?php if ($customers->Phone->Visible) { // Phone ?>
		<th class="<?php echo $customers->Phone->headerCellClass() ?>"><span id="elh_customers_Phone" class="customers_Phone"><?php echo $customers->Phone->caption() ?></span></th>
<?php } ?>
<?php if ($customers->Fax->Visible) { // Fax ?>
		<th class="<?php echo $customers->Fax->headerCellClass() ?>"><span id="elh_customers_Fax" class="customers_Fax"><?php echo $customers->Fax->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$customers_delete->RecCnt = 0;
$i = 0;
while (!$customers_delete->Recordset->EOF) {
	$customers_delete->RecCnt++;
	$customers_delete->RowCnt++;

	// Set row properties
	$customers->resetAttributes();
	$customers->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$customers_delete->loadRowValues($customers_delete->Recordset);

	// Render row
	$customers_delete->renderRow();
?>
	<tr<?php echo $customers->rowAttributes() ?>>
<?php if ($customers->CustomerID->Visible) { // CustomerID ?>
		<td<?php echo $customers->CustomerID->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCnt ?>_customers_CustomerID" class="customers_CustomerID">
<span<?php echo $customers->CustomerID->viewAttributes() ?>>
<?php echo $customers->CustomerID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers->CompanyName->Visible) { // CompanyName ?>
		<td<?php echo $customers->CompanyName->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCnt ?>_customers_CompanyName" class="customers_CompanyName">
<span<?php echo $customers->CompanyName->viewAttributes() ?>>
<?php echo $customers->CompanyName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers->ContactName->Visible) { // ContactName ?>
		<td<?php echo $customers->ContactName->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCnt ?>_customers_ContactName" class="customers_ContactName">
<span<?php echo $customers->ContactName->viewAttributes() ?>>
<?php echo $customers->ContactName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers->ContactTitle->Visible) { // ContactTitle ?>
		<td<?php echo $customers->ContactTitle->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCnt ?>_customers_ContactTitle" class="customers_ContactTitle">
<span<?php echo $customers->ContactTitle->viewAttributes() ?>>
<?php echo $customers->ContactTitle->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers->Address->Visible) { // Address ?>
		<td<?php echo $customers->Address->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCnt ?>_customers_Address" class="customers_Address">
<span<?php echo $customers->Address->viewAttributes() ?>>
<?php echo $customers->Address->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers->City->Visible) { // City ?>
		<td<?php echo $customers->City->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCnt ?>_customers_City" class="customers_City">
<span<?php echo $customers->City->viewAttributes() ?>>
<?php echo $customers->City->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers->Region->Visible) { // Region ?>
		<td<?php echo $customers->Region->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCnt ?>_customers_Region" class="customers_Region">
<span<?php echo $customers->Region->viewAttributes() ?>>
<?php echo $customers->Region->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers->PostalCode->Visible) { // PostalCode ?>
		<td<?php echo $customers->PostalCode->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCnt ?>_customers_PostalCode" class="customers_PostalCode">
<span<?php echo $customers->PostalCode->viewAttributes() ?>>
<?php echo $customers->PostalCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers->Country->Visible) { // Country ?>
		<td<?php echo $customers->Country->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCnt ?>_customers_Country" class="customers_Country">
<span<?php echo $customers->Country->viewAttributes() ?>>
<?php echo $customers->Country->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers->Phone->Visible) { // Phone ?>
		<td<?php echo $customers->Phone->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCnt ?>_customers_Phone" class="customers_Phone">
<span<?php echo $customers->Phone->viewAttributes() ?>>
<?php echo $customers->Phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers->Fax->Visible) { // Fax ?>
		<td<?php echo $customers->Fax->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCnt ?>_customers_Fax" class="customers_Fax">
<span<?php echo $customers->Fax->viewAttributes() ?>>
<?php echo $customers->Fax->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$customers_delete->Recordset->moveNext();
}
$customers_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $customers_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$customers_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$customers_delete->terminate();
?>
