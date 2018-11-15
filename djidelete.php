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
$dji_delete = new dji_delete();

// Run the page
$dji_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$dji_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fdjidelete = currentForm = new ew.Form("fdjidelete", "delete");

// Form_CustomValidate event
fdjidelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdjidelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $dji_delete->showPageHeader(); ?>
<?php
$dji_delete->showMessage();
?>
<form name="fdjidelete" id="fdjidelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($dji_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $dji_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="dji">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($dji_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($dji->ID->Visible) { // ID ?>
		<th class="<?php echo $dji->ID->headerCellClass() ?>"><span id="elh_dji_ID" class="dji_ID"><?php echo $dji->ID->caption() ?></span></th>
<?php } ?>
<?php if ($dji->Date->Visible) { // Date ?>
		<th class="<?php echo $dji->Date->headerCellClass() ?>"><span id="elh_dji_Date" class="dji_Date"><?php echo $dji->Date->caption() ?></span></th>
<?php } ?>
<?php if ($dji->Open->Visible) { // Open ?>
		<th class="<?php echo $dji->Open->headerCellClass() ?>"><span id="elh_dji_Open" class="dji_Open"><?php echo $dji->Open->caption() ?></span></th>
<?php } ?>
<?php if ($dji->High->Visible) { // High ?>
		<th class="<?php echo $dji->High->headerCellClass() ?>"><span id="elh_dji_High" class="dji_High"><?php echo $dji->High->caption() ?></span></th>
<?php } ?>
<?php if ($dji->Low->Visible) { // Low ?>
		<th class="<?php echo $dji->Low->headerCellClass() ?>"><span id="elh_dji_Low" class="dji_Low"><?php echo $dji->Low->caption() ?></span></th>
<?php } ?>
<?php if ($dji->Close->Visible) { // Close ?>
		<th class="<?php echo $dji->Close->headerCellClass() ?>"><span id="elh_dji_Close" class="dji_Close"><?php echo $dji->Close->caption() ?></span></th>
<?php } ?>
<?php if ($dji->Volume->Visible) { // Volume ?>
		<th class="<?php echo $dji->Volume->headerCellClass() ?>"><span id="elh_dji_Volume" class="dji_Volume"><?php echo $dji->Volume->caption() ?></span></th>
<?php } ?>
<?php if ($dji->Adj_Close->Visible) { // Adj Close ?>
		<th class="<?php echo $dji->Adj_Close->headerCellClass() ?>"><span id="elh_dji_Adj_Close" class="dji_Adj_Close"><?php echo $dji->Adj_Close->caption() ?></span></th>
<?php } ?>
<?php if ($dji->Name->Visible) { // Name ?>
		<th class="<?php echo $dji->Name->headerCellClass() ?>"><span id="elh_dji_Name" class="dji_Name"><?php echo $dji->Name->caption() ?></span></th>
<?php } ?>
<?php if ($dji->Name2->Visible) { // Name2 ?>
		<th class="<?php echo $dji->Name2->headerCellClass() ?>"><span id="elh_dji_Name2" class="dji_Name2"><?php echo $dji->Name2->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$dji_delete->RecCnt = 0;
$i = 0;
while (!$dji_delete->Recordset->EOF) {
	$dji_delete->RecCnt++;
	$dji_delete->RowCnt++;

	// Set row properties
	$dji->resetAttributes();
	$dji->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$dji_delete->loadRowValues($dji_delete->Recordset);

	// Render row
	$dji_delete->renderRow();
?>
	<tr<?php echo $dji->rowAttributes() ?>>
<?php if ($dji->ID->Visible) { // ID ?>
		<td<?php echo $dji->ID->cellAttributes() ?>>
<span id="el<?php echo $dji_delete->RowCnt ?>_dji_ID" class="dji_ID">
<span<?php echo $dji->ID->viewAttributes() ?>>
<?php echo $dji->ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dji->Date->Visible) { // Date ?>
		<td<?php echo $dji->Date->cellAttributes() ?>>
<span id="el<?php echo $dji_delete->RowCnt ?>_dji_Date" class="dji_Date">
<span<?php echo $dji->Date->viewAttributes() ?>>
<?php echo $dji->Date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dji->Open->Visible) { // Open ?>
		<td<?php echo $dji->Open->cellAttributes() ?>>
<span id="el<?php echo $dji_delete->RowCnt ?>_dji_Open" class="dji_Open">
<span<?php echo $dji->Open->viewAttributes() ?>>
<?php echo $dji->Open->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dji->High->Visible) { // High ?>
		<td<?php echo $dji->High->cellAttributes() ?>>
<span id="el<?php echo $dji_delete->RowCnt ?>_dji_High" class="dji_High">
<span<?php echo $dji->High->viewAttributes() ?>>
<?php echo $dji->High->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dji->Low->Visible) { // Low ?>
		<td<?php echo $dji->Low->cellAttributes() ?>>
<span id="el<?php echo $dji_delete->RowCnt ?>_dji_Low" class="dji_Low">
<span<?php echo $dji->Low->viewAttributes() ?>>
<?php echo $dji->Low->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dji->Close->Visible) { // Close ?>
		<td<?php echo $dji->Close->cellAttributes() ?>>
<span id="el<?php echo $dji_delete->RowCnt ?>_dji_Close" class="dji_Close">
<span<?php echo $dji->Close->viewAttributes() ?>>
<?php echo $dji->Close->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dji->Volume->Visible) { // Volume ?>
		<td<?php echo $dji->Volume->cellAttributes() ?>>
<span id="el<?php echo $dji_delete->RowCnt ?>_dji_Volume" class="dji_Volume">
<span<?php echo $dji->Volume->viewAttributes() ?>>
<?php echo $dji->Volume->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dji->Adj_Close->Visible) { // Adj Close ?>
		<td<?php echo $dji->Adj_Close->cellAttributes() ?>>
<span id="el<?php echo $dji_delete->RowCnt ?>_dji_Adj_Close" class="dji_Adj_Close">
<span<?php echo $dji->Adj_Close->viewAttributes() ?>>
<?php echo $dji->Adj_Close->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dji->Name->Visible) { // Name ?>
		<td<?php echo $dji->Name->cellAttributes() ?>>
<span id="el<?php echo $dji_delete->RowCnt ?>_dji_Name" class="dji_Name">
<span<?php echo $dji->Name->viewAttributes() ?>>
<?php echo $dji->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dji->Name2->Visible) { // Name2 ?>
		<td<?php echo $dji->Name2->cellAttributes() ?>>
<span id="el<?php echo $dji_delete->RowCnt ?>_dji_Name2" class="dji_Name2">
<span<?php echo $dji->Name2->viewAttributes() ?>>
<?php echo $dji->Name2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$dji_delete->Recordset->moveNext();
}
$dji_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $dji_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$dji_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$dji_delete->terminate();
?>
