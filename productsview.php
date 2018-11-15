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
$products_view = new products_view();

// Run the page
$products_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$products_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$products->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fproductsview = currentForm = new ew.Form("fproductsview", "view");

// Form_CustomValidate event
fproductsview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproductsview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fproductsview.lists["x_Discontinued[]"] = <?php echo $products_view->Discontinued->Lookup->toClientList() ?>;
fproductsview.lists["x_Discontinued[]"].options = <?php echo JsonEncode($products_view->Discontinued->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$products->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $products_view->ExportOptions->render("body") ?>
<?php
	foreach ($products_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $products_view->showPageHeader(); ?>
<?php
$products_view->showMessage();
?>
<?php if (!$products_view->IsModal) { ?>
<?php if (!$products->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($products_view->Pager)) $products_view->Pager = new PrevNextPager($products_view->StartRec, $products_view->DisplayRecs, $products_view->TotalRecs, $products_view->AutoHidePager) ?>
<?php if ($products_view->Pager->RecordCount > 0 && $products_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($products_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $products_view->pageUrl() ?>start=<?php echo $products_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($products_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $products_view->pageUrl() ?>start=<?php echo $products_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $products_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($products_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $products_view->pageUrl() ?>start=<?php echo $products_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($products_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $products_view->pageUrl() ?>start=<?php echo $products_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $products_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fproductsview" id="fproductsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($products_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $products_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="products">
<input type="hidden" name="modal" value="<?php echo (int)$products_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($products->ProductID->Visible) { // ProductID ?>
	<tr id="r_ProductID">
		<td class="<?php echo $products_view->TableLeftColumnClass ?>"><span id="elh_products_ProductID"><?php echo $products->ProductID->caption() ?></span></td>
		<td data-name="ProductID"<?php echo $products->ProductID->cellAttributes() ?>>
<span id="el_products_ProductID">
<span<?php echo $products->ProductID->viewAttributes() ?>>
<?php echo $products->ProductID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($products->ProductName->Visible) { // ProductName ?>
	<tr id="r_ProductName">
		<td class="<?php echo $products_view->TableLeftColumnClass ?>"><span id="elh_products_ProductName"><?php echo $products->ProductName->caption() ?></span></td>
		<td data-name="ProductName"<?php echo $products->ProductName->cellAttributes() ?>>
<span id="el_products_ProductName">
<span<?php echo $products->ProductName->viewAttributes() ?>>
<?php echo $products->ProductName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($products->SupplierID->Visible) { // SupplierID ?>
	<tr id="r_SupplierID">
		<td class="<?php echo $products_view->TableLeftColumnClass ?>"><span id="elh_products_SupplierID"><?php echo $products->SupplierID->caption() ?></span></td>
		<td data-name="SupplierID"<?php echo $products->SupplierID->cellAttributes() ?>>
<span id="el_products_SupplierID">
<span<?php echo $products->SupplierID->viewAttributes() ?>>
<?php echo $products->SupplierID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($products->CategoryID->Visible) { // CategoryID ?>
	<tr id="r_CategoryID">
		<td class="<?php echo $products_view->TableLeftColumnClass ?>"><span id="elh_products_CategoryID"><?php echo $products->CategoryID->caption() ?></span></td>
		<td data-name="CategoryID"<?php echo $products->CategoryID->cellAttributes() ?>>
<span id="el_products_CategoryID">
<span<?php echo $products->CategoryID->viewAttributes() ?>>
<?php echo $products->CategoryID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($products->QuantityPerUnit->Visible) { // QuantityPerUnit ?>
	<tr id="r_QuantityPerUnit">
		<td class="<?php echo $products_view->TableLeftColumnClass ?>"><span id="elh_products_QuantityPerUnit"><?php echo $products->QuantityPerUnit->caption() ?></span></td>
		<td data-name="QuantityPerUnit"<?php echo $products->QuantityPerUnit->cellAttributes() ?>>
<span id="el_products_QuantityPerUnit">
<span<?php echo $products->QuantityPerUnit->viewAttributes() ?>>
<?php echo $products->QuantityPerUnit->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($products->UnitPrice->Visible) { // UnitPrice ?>
	<tr id="r_UnitPrice">
		<td class="<?php echo $products_view->TableLeftColumnClass ?>"><span id="elh_products_UnitPrice"><?php echo $products->UnitPrice->caption() ?></span></td>
		<td data-name="UnitPrice"<?php echo $products->UnitPrice->cellAttributes() ?>>
<span id="el_products_UnitPrice">
<span<?php echo $products->UnitPrice->viewAttributes() ?>>
<?php echo $products->UnitPrice->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($products->UnitsInStock->Visible) { // UnitsInStock ?>
	<tr id="r_UnitsInStock">
		<td class="<?php echo $products_view->TableLeftColumnClass ?>"><span id="elh_products_UnitsInStock"><?php echo $products->UnitsInStock->caption() ?></span></td>
		<td data-name="UnitsInStock"<?php echo $products->UnitsInStock->cellAttributes() ?>>
<span id="el_products_UnitsInStock">
<span<?php echo $products->UnitsInStock->viewAttributes() ?>>
<?php echo $products->UnitsInStock->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($products->UnitsOnOrder->Visible) { // UnitsOnOrder ?>
	<tr id="r_UnitsOnOrder">
		<td class="<?php echo $products_view->TableLeftColumnClass ?>"><span id="elh_products_UnitsOnOrder"><?php echo $products->UnitsOnOrder->caption() ?></span></td>
		<td data-name="UnitsOnOrder"<?php echo $products->UnitsOnOrder->cellAttributes() ?>>
<span id="el_products_UnitsOnOrder">
<span<?php echo $products->UnitsOnOrder->viewAttributes() ?>>
<?php echo $products->UnitsOnOrder->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($products->ReorderLevel->Visible) { // ReorderLevel ?>
	<tr id="r_ReorderLevel">
		<td class="<?php echo $products_view->TableLeftColumnClass ?>"><span id="elh_products_ReorderLevel"><?php echo $products->ReorderLevel->caption() ?></span></td>
		<td data-name="ReorderLevel"<?php echo $products->ReorderLevel->cellAttributes() ?>>
<span id="el_products_ReorderLevel">
<span<?php echo $products->ReorderLevel->viewAttributes() ?>>
<?php echo $products->ReorderLevel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($products->Discontinued->Visible) { // Discontinued ?>
	<tr id="r_Discontinued">
		<td class="<?php echo $products_view->TableLeftColumnClass ?>"><span id="elh_products_Discontinued"><?php echo $products->Discontinued->caption() ?></span></td>
		<td data-name="Discontinued"<?php echo $products->Discontinued->cellAttributes() ?>>
<span id="el_products_Discontinued">
<span<?php echo $products->Discontinued->viewAttributes() ?>>
<?php if (ConvertToBool($products->Discontinued->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $products->Discontinued->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $products->Discontinued->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$products_view->IsModal) { ?>
<?php if (!$products->isExport()) { ?>
<?php if (!isset($products_view->Pager)) $products_view->Pager = new PrevNextPager($products_view->StartRec, $products_view->DisplayRecs, $products_view->TotalRecs, $products_view->AutoHidePager) ?>
<?php if ($products_view->Pager->RecordCount > 0 && $products_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($products_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $products_view->pageUrl() ?>start=<?php echo $products_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($products_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $products_view->pageUrl() ?>start=<?php echo $products_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $products_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($products_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $products_view->pageUrl() ?>start=<?php echo $products_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($products_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $products_view->pageUrl() ?>start=<?php echo $products_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $products_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$products_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$products->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$products_view->terminate();
?>
