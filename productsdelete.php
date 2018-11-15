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
$products_delete = new products_delete();

// Run the page
$products_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$products_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fproductsdelete = currentForm = new ew.Form("fproductsdelete", "delete");

// Form_CustomValidate event
fproductsdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproductsdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fproductsdelete.lists["x_Discontinued[]"] = <?php echo $products_delete->Discontinued->Lookup->toClientList() ?>;
fproductsdelete.lists["x_Discontinued[]"].options = <?php echo JsonEncode($products_delete->Discontinued->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $products_delete->showPageHeader(); ?>
<?php
$products_delete->showMessage();
?>
<form name="fproductsdelete" id="fproductsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($products_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $products_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="products">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($products_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($products->ProductID->Visible) { // ProductID ?>
		<th class="<?php echo $products->ProductID->headerCellClass() ?>"><span id="elh_products_ProductID" class="products_ProductID"><?php echo $products->ProductID->caption() ?></span></th>
<?php } ?>
<?php if ($products->ProductName->Visible) { // ProductName ?>
		<th class="<?php echo $products->ProductName->headerCellClass() ?>"><span id="elh_products_ProductName" class="products_ProductName"><?php echo $products->ProductName->caption() ?></span></th>
<?php } ?>
<?php if ($products->SupplierID->Visible) { // SupplierID ?>
		<th class="<?php echo $products->SupplierID->headerCellClass() ?>"><span id="elh_products_SupplierID" class="products_SupplierID"><?php echo $products->SupplierID->caption() ?></span></th>
<?php } ?>
<?php if ($products->CategoryID->Visible) { // CategoryID ?>
		<th class="<?php echo $products->CategoryID->headerCellClass() ?>"><span id="elh_products_CategoryID" class="products_CategoryID"><?php echo $products->CategoryID->caption() ?></span></th>
<?php } ?>
<?php if ($products->QuantityPerUnit->Visible) { // QuantityPerUnit ?>
		<th class="<?php echo $products->QuantityPerUnit->headerCellClass() ?>"><span id="elh_products_QuantityPerUnit" class="products_QuantityPerUnit"><?php echo $products->QuantityPerUnit->caption() ?></span></th>
<?php } ?>
<?php if ($products->UnitPrice->Visible) { // UnitPrice ?>
		<th class="<?php echo $products->UnitPrice->headerCellClass() ?>"><span id="elh_products_UnitPrice" class="products_UnitPrice"><?php echo $products->UnitPrice->caption() ?></span></th>
<?php } ?>
<?php if ($products->UnitsInStock->Visible) { // UnitsInStock ?>
		<th class="<?php echo $products->UnitsInStock->headerCellClass() ?>"><span id="elh_products_UnitsInStock" class="products_UnitsInStock"><?php echo $products->UnitsInStock->caption() ?></span></th>
<?php } ?>
<?php if ($products->UnitsOnOrder->Visible) { // UnitsOnOrder ?>
		<th class="<?php echo $products->UnitsOnOrder->headerCellClass() ?>"><span id="elh_products_UnitsOnOrder" class="products_UnitsOnOrder"><?php echo $products->UnitsOnOrder->caption() ?></span></th>
<?php } ?>
<?php if ($products->ReorderLevel->Visible) { // ReorderLevel ?>
		<th class="<?php echo $products->ReorderLevel->headerCellClass() ?>"><span id="elh_products_ReorderLevel" class="products_ReorderLevel"><?php echo $products->ReorderLevel->caption() ?></span></th>
<?php } ?>
<?php if ($products->Discontinued->Visible) { // Discontinued ?>
		<th class="<?php echo $products->Discontinued->headerCellClass() ?>"><span id="elh_products_Discontinued" class="products_Discontinued"><?php echo $products->Discontinued->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$products_delete->RecCnt = 0;
$i = 0;
while (!$products_delete->Recordset->EOF) {
	$products_delete->RecCnt++;
	$products_delete->RowCnt++;

	// Set row properties
	$products->resetAttributes();
	$products->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$products_delete->loadRowValues($products_delete->Recordset);

	// Render row
	$products_delete->renderRow();
?>
	<tr<?php echo $products->rowAttributes() ?>>
<?php if ($products->ProductID->Visible) { // ProductID ?>
		<td<?php echo $products->ProductID->cellAttributes() ?>>
<span id="el<?php echo $products_delete->RowCnt ?>_products_ProductID" class="products_ProductID">
<span<?php echo $products->ProductID->viewAttributes() ?>>
<?php echo $products->ProductID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($products->ProductName->Visible) { // ProductName ?>
		<td<?php echo $products->ProductName->cellAttributes() ?>>
<span id="el<?php echo $products_delete->RowCnt ?>_products_ProductName" class="products_ProductName">
<span<?php echo $products->ProductName->viewAttributes() ?>>
<?php echo $products->ProductName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($products->SupplierID->Visible) { // SupplierID ?>
		<td<?php echo $products->SupplierID->cellAttributes() ?>>
<span id="el<?php echo $products_delete->RowCnt ?>_products_SupplierID" class="products_SupplierID">
<span<?php echo $products->SupplierID->viewAttributes() ?>>
<?php echo $products->SupplierID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($products->CategoryID->Visible) { // CategoryID ?>
		<td<?php echo $products->CategoryID->cellAttributes() ?>>
<span id="el<?php echo $products_delete->RowCnt ?>_products_CategoryID" class="products_CategoryID">
<span<?php echo $products->CategoryID->viewAttributes() ?>>
<?php echo $products->CategoryID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($products->QuantityPerUnit->Visible) { // QuantityPerUnit ?>
		<td<?php echo $products->QuantityPerUnit->cellAttributes() ?>>
<span id="el<?php echo $products_delete->RowCnt ?>_products_QuantityPerUnit" class="products_QuantityPerUnit">
<span<?php echo $products->QuantityPerUnit->viewAttributes() ?>>
<?php echo $products->QuantityPerUnit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($products->UnitPrice->Visible) { // UnitPrice ?>
		<td<?php echo $products->UnitPrice->cellAttributes() ?>>
<span id="el<?php echo $products_delete->RowCnt ?>_products_UnitPrice" class="products_UnitPrice">
<span<?php echo $products->UnitPrice->viewAttributes() ?>>
<?php echo $products->UnitPrice->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($products->UnitsInStock->Visible) { // UnitsInStock ?>
		<td<?php echo $products->UnitsInStock->cellAttributes() ?>>
<span id="el<?php echo $products_delete->RowCnt ?>_products_UnitsInStock" class="products_UnitsInStock">
<span<?php echo $products->UnitsInStock->viewAttributes() ?>>
<?php echo $products->UnitsInStock->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($products->UnitsOnOrder->Visible) { // UnitsOnOrder ?>
		<td<?php echo $products->UnitsOnOrder->cellAttributes() ?>>
<span id="el<?php echo $products_delete->RowCnt ?>_products_UnitsOnOrder" class="products_UnitsOnOrder">
<span<?php echo $products->UnitsOnOrder->viewAttributes() ?>>
<?php echo $products->UnitsOnOrder->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($products->ReorderLevel->Visible) { // ReorderLevel ?>
		<td<?php echo $products->ReorderLevel->cellAttributes() ?>>
<span id="el<?php echo $products_delete->RowCnt ?>_products_ReorderLevel" class="products_ReorderLevel">
<span<?php echo $products->ReorderLevel->viewAttributes() ?>>
<?php echo $products->ReorderLevel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($products->Discontinued->Visible) { // Discontinued ?>
		<td<?php echo $products->Discontinued->cellAttributes() ?>>
<span id="el<?php echo $products_delete->RowCnt ?>_products_Discontinued" class="products_Discontinued">
<span<?php echo $products->Discontinued->viewAttributes() ?>>
<?php if (ConvertToBool($products->Discontinued->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $products->Discontinued->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $products->Discontinued->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$products_delete->Recordset->moveNext();
}
$products_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $products_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$products_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$products_delete->terminate();
?>
