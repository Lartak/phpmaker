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
$categories_delete = new categories_delete();

// Run the page
$categories_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$categories_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fcategoriesdelete = currentForm = new ew.Form("fcategoriesdelete", "delete");

// Form_CustomValidate event
fcategoriesdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcategoriesdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $categories_delete->showPageHeader(); ?>
<?php
$categories_delete->showMessage();
?>
<form name="fcategoriesdelete" id="fcategoriesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($categories_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $categories_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="categories">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($categories_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($categories->CategoryID->Visible) { // CategoryID ?>
		<th class="<?php echo $categories->CategoryID->headerCellClass() ?>"><span id="elh_categories_CategoryID" class="categories_CategoryID"><?php echo $categories->CategoryID->caption() ?></span></th>
<?php } ?>
<?php if ($categories->CategoryName->Visible) { // CategoryName ?>
		<th class="<?php echo $categories->CategoryName->headerCellClass() ?>"><span id="elh_categories_CategoryName" class="categories_CategoryName"><?php echo $categories->CategoryName->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$categories_delete->RecCnt = 0;
$i = 0;
while (!$categories_delete->Recordset->EOF) {
	$categories_delete->RecCnt++;
	$categories_delete->RowCnt++;

	// Set row properties
	$categories->resetAttributes();
	$categories->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$categories_delete->loadRowValues($categories_delete->Recordset);

	// Render row
	$categories_delete->renderRow();
?>
	<tr<?php echo $categories->rowAttributes() ?>>
<?php if ($categories->CategoryID->Visible) { // CategoryID ?>
		<td<?php echo $categories->CategoryID->cellAttributes() ?>>
<span id="el<?php echo $categories_delete->RowCnt ?>_categories_CategoryID" class="categories_CategoryID">
<span<?php echo $categories->CategoryID->viewAttributes() ?>>
<?php echo $categories->CategoryID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($categories->CategoryName->Visible) { // CategoryName ?>
		<td<?php echo $categories->CategoryName->cellAttributes() ?>>
<span id="el<?php echo $categories_delete->RowCnt ?>_categories_CategoryName" class="categories_CategoryName">
<span<?php echo $categories->CategoryName->viewAttributes() ?>>
<?php echo $categories->CategoryName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$categories_delete->Recordset->moveNext();
}
$categories_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $categories_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$categories_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$categories_delete->terminate();
?>
