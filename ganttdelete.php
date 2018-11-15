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
$gantt_delete = new gantt_delete();

// Run the page
$gantt_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gantt_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fganttdelete = currentForm = new ew.Form("fganttdelete", "delete");

// Form_CustomValidate event
fganttdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fganttdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $gantt_delete->showPageHeader(); ?>
<?php
$gantt_delete->showMessage();
?>
<form name="fganttdelete" id="fganttdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($gantt_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $gantt_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gantt">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($gantt_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($gantt->id->Visible) { // id ?>
		<th class="<?php echo $gantt->id->headerCellClass() ?>"><span id="elh_gantt_id" class="gantt_id"><?php echo $gantt->id->caption() ?></span></th>
<?php } ?>
<?php if ($gantt->name->Visible) { // name ?>
		<th class="<?php echo $gantt->name->headerCellClass() ?>"><span id="elh_gantt_name" class="gantt_name"><?php echo $gantt->name->caption() ?></span></th>
<?php } ?>
<?php if ($gantt->start->Visible) { // start ?>
		<th class="<?php echo $gantt->start->headerCellClass() ?>"><span id="elh_gantt_start" class="gantt_start"><?php echo $gantt->start->caption() ?></span></th>
<?php } ?>
<?php if ($gantt->end->Visible) { // end ?>
		<th class="<?php echo $gantt->end->headerCellClass() ?>"><span id="elh_gantt_end" class="gantt_end"><?php echo $gantt->end->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$gantt_delete->RecCnt = 0;
$i = 0;
while (!$gantt_delete->Recordset->EOF) {
	$gantt_delete->RecCnt++;
	$gantt_delete->RowCnt++;

	// Set row properties
	$gantt->resetAttributes();
	$gantt->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$gantt_delete->loadRowValues($gantt_delete->Recordset);

	// Render row
	$gantt_delete->renderRow();
?>
	<tr<?php echo $gantt->rowAttributes() ?>>
<?php if ($gantt->id->Visible) { // id ?>
		<td<?php echo $gantt->id->cellAttributes() ?>>
<span id="el<?php echo $gantt_delete->RowCnt ?>_gantt_id" class="gantt_id">
<span<?php echo $gantt->id->viewAttributes() ?>>
<?php echo $gantt->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gantt->name->Visible) { // name ?>
		<td<?php echo $gantt->name->cellAttributes() ?>>
<span id="el<?php echo $gantt_delete->RowCnt ?>_gantt_name" class="gantt_name">
<span<?php echo $gantt->name->viewAttributes() ?>>
<?php echo $gantt->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gantt->start->Visible) { // start ?>
		<td<?php echo $gantt->start->cellAttributes() ?>>
<span id="el<?php echo $gantt_delete->RowCnt ?>_gantt_start" class="gantt_start">
<span<?php echo $gantt->start->viewAttributes() ?>>
<?php echo $gantt->start->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gantt->end->Visible) { // end ?>
		<td<?php echo $gantt->end->cellAttributes() ?>>
<span id="el<?php echo $gantt_delete->RowCnt ?>_gantt_end" class="gantt_end">
<span<?php echo $gantt->end->viewAttributes() ?>>
<?php echo $gantt->end->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$gantt_delete->Recordset->moveNext();
}
$gantt_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gantt_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$gantt_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$gantt_delete->terminate();
?>
