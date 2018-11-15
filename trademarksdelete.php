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
$trademarks_delete = new trademarks_delete();

// Run the page
$trademarks_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$trademarks_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftrademarksdelete = currentForm = new ew.Form("ftrademarksdelete", "delete");

// Form_CustomValidate event
ftrademarksdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftrademarksdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $trademarks_delete->showPageHeader(); ?>
<?php
$trademarks_delete->showMessage();
?>
<form name="ftrademarksdelete" id="ftrademarksdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($trademarks_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $trademarks_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="trademarks">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($trademarks_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($trademarks->ID->Visible) { // ID ?>
		<th class="<?php echo $trademarks->ID->headerCellClass() ?>"><span id="elh_trademarks_ID" class="trademarks_ID"><?php echo $trademarks->ID->caption() ?></span></th>
<?php } ?>
<?php if ($trademarks->Trademark->Visible) { // Trademark ?>
		<th class="<?php echo $trademarks->Trademark->headerCellClass() ?>"><span id="elh_trademarks_Trademark" class="trademarks_Trademark"><?php echo $trademarks->Trademark->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$trademarks_delete->RecCnt = 0;
$i = 0;
while (!$trademarks_delete->Recordset->EOF) {
	$trademarks_delete->RecCnt++;
	$trademarks_delete->RowCnt++;

	// Set row properties
	$trademarks->resetAttributes();
	$trademarks->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$trademarks_delete->loadRowValues($trademarks_delete->Recordset);

	// Render row
	$trademarks_delete->renderRow();
?>
	<tr<?php echo $trademarks->rowAttributes() ?>>
<?php if ($trademarks->ID->Visible) { // ID ?>
		<td<?php echo $trademarks->ID->cellAttributes() ?>>
<span id="el<?php echo $trademarks_delete->RowCnt ?>_trademarks_ID" class="trademarks_ID">
<span<?php echo $trademarks->ID->viewAttributes() ?>>
<?php echo $trademarks->ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($trademarks->Trademark->Visible) { // Trademark ?>
		<td<?php echo $trademarks->Trademark->cellAttributes() ?>>
<span id="el<?php echo $trademarks_delete->RowCnt ?>_trademarks_Trademark" class="trademarks_Trademark">
<span<?php echo $trademarks->Trademark->viewAttributes() ?>>
<?php echo $trademarks->Trademark->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$trademarks_delete->Recordset->moveNext();
}
$trademarks_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $trademarks_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$trademarks_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$trademarks_delete->terminate();
?>
