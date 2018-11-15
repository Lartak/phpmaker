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
$products_list = new products_list();

// Run the page
$products_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$products_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$products->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fproductslist = currentForm = new ew.Form("fproductslist", "list");
fproductslist.formKeyCountName = '<?php echo $products_list->FormKeyCountName ?>';

// Form_CustomValidate event
fproductslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproductslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fproductslist.lists["x_Discontinued[]"] = <?php echo $products_list->Discontinued->Lookup->toClientList() ?>;
fproductslist.lists["x_Discontinued[]"].options = <?php echo JsonEncode($products_list->Discontinued->options(FALSE, TRUE)) ?>;

// Form object for search
var fproductslistsrch = currentSearchForm = new ew.Form("fproductslistsrch");

// Validate function for search
fproductslistsrch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
fproductslistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproductslistsrch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fproductslistsrch.lists["x_Discontinued[]"] = <?php echo $products_list->Discontinued->Lookup->toClientList() ?>;
fproductslistsrch.lists["x_Discontinued[]"].options = <?php echo JsonEncode($products_list->Discontinued->options(FALSE, TRUE)) ?>;

// Filters
fproductslistsrch.filterList = <?php echo $products_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$products->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($products_list->TotalRecs > 0 && $products_list->ExportOptions->visible()) { ?>
<?php $products_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($products_list->ImportOptions->visible()) { ?>
<?php $products_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($products_list->SearchOptions->visible()) { ?>
<?php $products_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($products_list->FilterOptions->visible()) { ?>
<?php $products_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$products_list->renderOtherOptions();
?>
<?php if (!$products->isExport() && !$products->CurrentAction) { ?>
<form name="fproductslistsrch" id="fproductslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($products_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fproductslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="products">
	<div class="ew-basic-search">
<?php
if ($SearchError == "")
	$products_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$products->RowType = ROWTYPE_SEARCH;

// Render row
$products->resetAttributes();
$products_list->renderRow();
?>
<div id="xsr_1" class="ew-row d-sm-flex">
<?php if ($products->Discontinued->Visible) { // Discontinued ?>
	<div id="xsc_Discontinued" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $products->Discontinued->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_Discontinued" id="z_Discontinued" value="="></span>
		<span class="ew-search-field">
<?php
$selwrk = (ConvertToBool($products->Discontinued->AdvancedSearch->SearchValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="products" data-field="x_Discontinued" name="x_Discontinued[]" id="x_Discontinued[]" value="1"<?php echo $selwrk ?><?php echo $products->Discontinued->editAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($products_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($products_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $products_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($products_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($products_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($products_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($products_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $products_list->showPageHeader(); ?>
<?php
$products_list->showMessage();
?>
<?php if ($products_list->TotalRecs > 0 || $products->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($products_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> products">
<?php if (!$products->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$products->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($products_list->Pager)) $products_list->Pager = new PrevNextPager($products_list->StartRec, $products_list->DisplayRecs, $products_list->TotalRecs, $products_list->AutoHidePager) ?>
<?php if ($products_list->Pager->RecordCount > 0 && $products_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($products_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $products_list->pageUrl() ?>start=<?php echo $products_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($products_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $products_list->pageUrl() ?>start=<?php echo $products_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $products_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($products_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $products_list->pageUrl() ?>start=<?php echo $products_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($products_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $products_list->pageUrl() ?>start=<?php echo $products_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $products_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($products_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $products_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $products_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $products_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($products_list->TotalRecs > 0 && (!$products_list->AutoHidePageSizeSelector || $products_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="products">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($products_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($products_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($products_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($products->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($products_list->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fproductslist" id="fproductslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($products_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $products_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="products">
<div id="gmp_products" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($products_list->TotalRecs > 0 || $products->isGridEdit()) { ?>
<table id="tbl_productslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$products_list->RowType = ROWTYPE_HEADER;

// Render list options
$products_list->renderListOptions();

// Render list options (header, left)
$products_list->ListOptions->render("header", "left");
?>
<?php if ($products->ProductID->Visible) { // ProductID ?>
	<?php if ($products->sortUrl($products->ProductID) == "") { ?>
		<th data-name="ProductID" class="<?php echo $products->ProductID->headerCellClass() ?>"><div id="elh_products_ProductID" class="products_ProductID"><div class="ew-table-header-caption"><?php echo $products->ProductID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductID" class="<?php echo $products->ProductID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $products->SortUrl($products->ProductID) ?>',1);"><div id="elh_products_ProductID" class="products_ProductID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $products->ProductID->caption() ?></span><span class="ew-table-header-sort"><?php if ($products->ProductID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($products->ProductID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($products->ProductName->Visible) { // ProductName ?>
	<?php if ($products->sortUrl($products->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $products->ProductName->headerCellClass() ?>"><div id="elh_products_ProductName" class="products_ProductName"><div class="ew-table-header-caption"><?php echo $products->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $products->ProductName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $products->SortUrl($products->ProductName) ?>',1);"><div id="elh_products_ProductName" class="products_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $products->ProductName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($products->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($products->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($products->SupplierID->Visible) { // SupplierID ?>
	<?php if ($products->sortUrl($products->SupplierID) == "") { ?>
		<th data-name="SupplierID" class="<?php echo $products->SupplierID->headerCellClass() ?>"><div id="elh_products_SupplierID" class="products_SupplierID"><div class="ew-table-header-caption"><?php echo $products->SupplierID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SupplierID" class="<?php echo $products->SupplierID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $products->SortUrl($products->SupplierID) ?>',1);"><div id="elh_products_SupplierID" class="products_SupplierID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $products->SupplierID->caption() ?></span><span class="ew-table-header-sort"><?php if ($products->SupplierID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($products->SupplierID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($products->CategoryID->Visible) { // CategoryID ?>
	<?php if ($products->sortUrl($products->CategoryID) == "") { ?>
		<th data-name="CategoryID" class="<?php echo $products->CategoryID->headerCellClass() ?>"><div id="elh_products_CategoryID" class="products_CategoryID"><div class="ew-table-header-caption"><?php echo $products->CategoryID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CategoryID" class="<?php echo $products->CategoryID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $products->SortUrl($products->CategoryID) ?>',1);"><div id="elh_products_CategoryID" class="products_CategoryID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $products->CategoryID->caption() ?></span><span class="ew-table-header-sort"><?php if ($products->CategoryID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($products->CategoryID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($products->QuantityPerUnit->Visible) { // QuantityPerUnit ?>
	<?php if ($products->sortUrl($products->QuantityPerUnit) == "") { ?>
		<th data-name="QuantityPerUnit" class="<?php echo $products->QuantityPerUnit->headerCellClass() ?>"><div id="elh_products_QuantityPerUnit" class="products_QuantityPerUnit"><div class="ew-table-header-caption"><?php echo $products->QuantityPerUnit->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="QuantityPerUnit" class="<?php echo $products->QuantityPerUnit->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $products->SortUrl($products->QuantityPerUnit) ?>',1);"><div id="elh_products_QuantityPerUnit" class="products_QuantityPerUnit">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $products->QuantityPerUnit->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($products->QuantityPerUnit->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($products->QuantityPerUnit->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($products->UnitPrice->Visible) { // UnitPrice ?>
	<?php if ($products->sortUrl($products->UnitPrice) == "") { ?>
		<th data-name="UnitPrice" class="<?php echo $products->UnitPrice->headerCellClass() ?>"><div id="elh_products_UnitPrice" class="products_UnitPrice"><div class="ew-table-header-caption"><?php echo $products->UnitPrice->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitPrice" class="<?php echo $products->UnitPrice->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $products->SortUrl($products->UnitPrice) ?>',1);"><div id="elh_products_UnitPrice" class="products_UnitPrice">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $products->UnitPrice->caption() ?></span><span class="ew-table-header-sort"><?php if ($products->UnitPrice->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($products->UnitPrice->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($products->UnitsInStock->Visible) { // UnitsInStock ?>
	<?php if ($products->sortUrl($products->UnitsInStock) == "") { ?>
		<th data-name="UnitsInStock" class="<?php echo $products->UnitsInStock->headerCellClass() ?>"><div id="elh_products_UnitsInStock" class="products_UnitsInStock"><div class="ew-table-header-caption"><?php echo $products->UnitsInStock->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitsInStock" class="<?php echo $products->UnitsInStock->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $products->SortUrl($products->UnitsInStock) ?>',1);"><div id="elh_products_UnitsInStock" class="products_UnitsInStock">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $products->UnitsInStock->caption() ?></span><span class="ew-table-header-sort"><?php if ($products->UnitsInStock->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($products->UnitsInStock->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($products->UnitsOnOrder->Visible) { // UnitsOnOrder ?>
	<?php if ($products->sortUrl($products->UnitsOnOrder) == "") { ?>
		<th data-name="UnitsOnOrder" class="<?php echo $products->UnitsOnOrder->headerCellClass() ?>"><div id="elh_products_UnitsOnOrder" class="products_UnitsOnOrder"><div class="ew-table-header-caption"><?php echo $products->UnitsOnOrder->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitsOnOrder" class="<?php echo $products->UnitsOnOrder->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $products->SortUrl($products->UnitsOnOrder) ?>',1);"><div id="elh_products_UnitsOnOrder" class="products_UnitsOnOrder">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $products->UnitsOnOrder->caption() ?></span><span class="ew-table-header-sort"><?php if ($products->UnitsOnOrder->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($products->UnitsOnOrder->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($products->ReorderLevel->Visible) { // ReorderLevel ?>
	<?php if ($products->sortUrl($products->ReorderLevel) == "") { ?>
		<th data-name="ReorderLevel" class="<?php echo $products->ReorderLevel->headerCellClass() ?>"><div id="elh_products_ReorderLevel" class="products_ReorderLevel"><div class="ew-table-header-caption"><?php echo $products->ReorderLevel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReorderLevel" class="<?php echo $products->ReorderLevel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $products->SortUrl($products->ReorderLevel) ?>',1);"><div id="elh_products_ReorderLevel" class="products_ReorderLevel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $products->ReorderLevel->caption() ?></span><span class="ew-table-header-sort"><?php if ($products->ReorderLevel->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($products->ReorderLevel->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($products->Discontinued->Visible) { // Discontinued ?>
	<?php if ($products->sortUrl($products->Discontinued) == "") { ?>
		<th data-name="Discontinued" class="<?php echo $products->Discontinued->headerCellClass() ?>"><div id="elh_products_Discontinued" class="products_Discontinued"><div class="ew-table-header-caption"><?php echo $products->Discontinued->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Discontinued" class="<?php echo $products->Discontinued->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $products->SortUrl($products->Discontinued) ?>',1);"><div id="elh_products_Discontinued" class="products_Discontinued">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $products->Discontinued->caption() ?></span><span class="ew-table-header-sort"><?php if ($products->Discontinued->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($products->Discontinued->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$products_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($products->ExportAll && $products->isExport()) {
	$products_list->StopRec = $products_list->TotalRecs;
} else {

	// Set the last record to display
	if ($products_list->TotalRecs > $products_list->StartRec + $products_list->DisplayRecs - 1)
		$products_list->StopRec = $products_list->StartRec + $products_list->DisplayRecs - 1;
	else
		$products_list->StopRec = $products_list->TotalRecs;
}
$products_list->RecCnt = $products_list->StartRec - 1;
if ($products_list->Recordset && !$products_list->Recordset->EOF) {
	$products_list->Recordset->moveFirst();
	$selectLimit = $products_list->UseSelectLimit;
	if (!$selectLimit && $products_list->StartRec > 1)
		$products_list->Recordset->move($products_list->StartRec - 1);
} elseif (!$products->AllowAddDeleteRow && $products_list->StopRec == 0) {
	$products_list->StopRec = $products->GridAddRowCount;
}

// Initialize aggregate
$products->RowType = ROWTYPE_AGGREGATEINIT;
$products->resetAttributes();
$products_list->renderRow();
while ($products_list->RecCnt < $products_list->StopRec) {
	$products_list->RecCnt++;
	if ($products_list->RecCnt >= $products_list->StartRec) {
		$products_list->RowCnt++;

		// Set up key count
		$products_list->KeyCount = $products_list->RowIndex;

		// Init row class and style
		$products->resetAttributes();
		$products->CssClass = "";
		if ($products->isGridAdd()) {
		} else {
			$products_list->loadRowValues($products_list->Recordset); // Load row values
		}
		$products->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$products->RowAttrs = array_merge($products->RowAttrs, array('data-rowindex'=>$products_list->RowCnt, 'id'=>'r' . $products_list->RowCnt . '_products', 'data-rowtype'=>$products->RowType));

		// Render row
		$products_list->renderRow();

		// Render list options
		$products_list->renderListOptions();
?>
	<tr<?php echo $products->rowAttributes() ?>>
<?php

// Render list options (body, left)
$products_list->ListOptions->render("body", "left", $products_list->RowCnt);
?>
	<?php if ($products->ProductID->Visible) { // ProductID ?>
		<td data-name="ProductID"<?php echo $products->ProductID->cellAttributes() ?>>
<span id="el<?php echo $products_list->RowCnt ?>_products_ProductID" class="products_ProductID">
<span<?php echo $products->ProductID->viewAttributes() ?>>
<?php echo $products->ProductID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($products->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $products->ProductName->cellAttributes() ?>>
<span id="el<?php echo $products_list->RowCnt ?>_products_ProductName" class="products_ProductName">
<span<?php echo $products->ProductName->viewAttributes() ?>>
<?php echo $products->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($products->SupplierID->Visible) { // SupplierID ?>
		<td data-name="SupplierID"<?php echo $products->SupplierID->cellAttributes() ?>>
<span id="el<?php echo $products_list->RowCnt ?>_products_SupplierID" class="products_SupplierID">
<span<?php echo $products->SupplierID->viewAttributes() ?>>
<?php echo $products->SupplierID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($products->CategoryID->Visible) { // CategoryID ?>
		<td data-name="CategoryID"<?php echo $products->CategoryID->cellAttributes() ?>>
<span id="el<?php echo $products_list->RowCnt ?>_products_CategoryID" class="products_CategoryID">
<span<?php echo $products->CategoryID->viewAttributes() ?>>
<?php echo $products->CategoryID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($products->QuantityPerUnit->Visible) { // QuantityPerUnit ?>
		<td data-name="QuantityPerUnit"<?php echo $products->QuantityPerUnit->cellAttributes() ?>>
<span id="el<?php echo $products_list->RowCnt ?>_products_QuantityPerUnit" class="products_QuantityPerUnit">
<span<?php echo $products->QuantityPerUnit->viewAttributes() ?>>
<?php echo $products->QuantityPerUnit->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($products->UnitPrice->Visible) { // UnitPrice ?>
		<td data-name="UnitPrice"<?php echo $products->UnitPrice->cellAttributes() ?>>
<span id="el<?php echo $products_list->RowCnt ?>_products_UnitPrice" class="products_UnitPrice">
<span<?php echo $products->UnitPrice->viewAttributes() ?>>
<?php echo $products->UnitPrice->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($products->UnitsInStock->Visible) { // UnitsInStock ?>
		<td data-name="UnitsInStock"<?php echo $products->UnitsInStock->cellAttributes() ?>>
<span id="el<?php echo $products_list->RowCnt ?>_products_UnitsInStock" class="products_UnitsInStock">
<span<?php echo $products->UnitsInStock->viewAttributes() ?>>
<?php echo $products->UnitsInStock->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($products->UnitsOnOrder->Visible) { // UnitsOnOrder ?>
		<td data-name="UnitsOnOrder"<?php echo $products->UnitsOnOrder->cellAttributes() ?>>
<span id="el<?php echo $products_list->RowCnt ?>_products_UnitsOnOrder" class="products_UnitsOnOrder">
<span<?php echo $products->UnitsOnOrder->viewAttributes() ?>>
<?php echo $products->UnitsOnOrder->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($products->ReorderLevel->Visible) { // ReorderLevel ?>
		<td data-name="ReorderLevel"<?php echo $products->ReorderLevel->cellAttributes() ?>>
<span id="el<?php echo $products_list->RowCnt ?>_products_ReorderLevel" class="products_ReorderLevel">
<span<?php echo $products->ReorderLevel->viewAttributes() ?>>
<?php echo $products->ReorderLevel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($products->Discontinued->Visible) { // Discontinued ?>
		<td data-name="Discontinued"<?php echo $products->Discontinued->cellAttributes() ?>>
<span id="el<?php echo $products_list->RowCnt ?>_products_Discontinued" class="products_Discontinued">
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
<?php

// Render list options (body, right)
$products_list->ListOptions->render("body", "right", $products_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$products->isGridAdd())
		$products_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$products->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($products_list->Recordset)
	$products_list->Recordset->Close();
?>
<?php if (!$products->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$products->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($products_list->Pager)) $products_list->Pager = new PrevNextPager($products_list->StartRec, $products_list->DisplayRecs, $products_list->TotalRecs, $products_list->AutoHidePager) ?>
<?php if ($products_list->Pager->RecordCount > 0 && $products_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($products_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $products_list->pageUrl() ?>start=<?php echo $products_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($products_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $products_list->pageUrl() ?>start=<?php echo $products_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $products_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($products_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $products_list->pageUrl() ?>start=<?php echo $products_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($products_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $products_list->pageUrl() ?>start=<?php echo $products_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $products_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($products_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $products_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $products_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $products_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($products_list->TotalRecs > 0 && (!$products_list->AutoHidePageSizeSelector || $products_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="products">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($products_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($products_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($products_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($products->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($products_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($products_list->TotalRecs == 0 && !$products->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($products_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$products_list->showPageFooter();
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
$products_list->terminate();
?>
