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
$models_delete = new models_delete();

// Run the page
$models_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$models_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fmodelsdelete = currentForm = new ew.Form("fmodelsdelete", "delete");

// Form_CustomValidate event
fmodelsdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fmodelsdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $models_delete->showPageHeader(); ?>
<?php
$models_delete->showMessage();
?>
<form name="fmodelsdelete" id="fmodelsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($models_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $models_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="models">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($models_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($models->ID->Visible) { // ID ?>
		<th class="<?php echo $models->ID->headerCellClass() ?>"><span id="elh_models_ID" class="models_ID"><?php echo $models->ID->caption() ?></span></th>
<?php } ?>
<?php if ($models->Trademark->Visible) { // Trademark ?>
		<th class="<?php echo $models->Trademark->headerCellClass() ?>"><span id="elh_models_Trademark" class="models_Trademark"><?php echo $models->Trademark->caption() ?></span></th>
<?php } ?>
<?php if ($models->Model->Visible) { // Model ?>
		<th class="<?php echo $models->Model->headerCellClass() ?>"><span id="elh_models_Model" class="models_Model"><?php echo $models->Model->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$models_delete->RecCnt = 0;
$i = 0;
while (!$models_delete->Recordset->EOF) {
	$models_delete->RecCnt++;
	$models_delete->RowCnt++;

	// Set row properties
	$models->resetAttributes();
	$models->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$models_delete->loadRowValues($models_delete->Recordset);

	// Render row
	$models_delete->renderRow();
?>
	<tr<?php echo $models->rowAttributes() ?>>
<?php if ($models->ID->Visible) { // ID ?>
		<td<?php echo $models->ID->cellAttributes() ?>>
<span id="el<?php echo $models_delete->RowCnt ?>_models_ID" class="models_ID">
<span<?php echo $models->ID->viewAttributes() ?>>
<?php echo $models->ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($models->Trademark->Visible) { // Trademark ?>
		<td<?php echo $models->Trademark->cellAttributes() ?>>
<span id="el<?php echo $models_delete->RowCnt ?>_models_Trademark" class="models_Trademark">
<span<?php echo $models->Trademark->viewAttributes() ?>>
<?php echo $models->Trademark->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($models->Model->Visible) { // Model ?>
		<td<?php echo $models->Model->cellAttributes() ?>>
<span id="el<?php echo $models_delete->RowCnt ?>_models_Model" class="models_Model">
<span<?php echo $models->Model->viewAttributes() ?>>
<?php echo $models->Model->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$models_delete->Recordset->moveNext();
}
$models_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $models_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$models_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$models_delete->terminate();
?>
