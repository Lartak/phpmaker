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
$order_details_extended_list = new order_details_extended_list();

// Run the page
$order_details_extended_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$order_details_extended_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$order_details_extended->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var forder_details_extendedlist = currentForm = new ew.Form("forder_details_extendedlist", "list");
forder_details_extendedlist.formKeyCountName = '<?php echo $order_details_extended_list->FormKeyCountName ?>';

// Form_CustomValidate event
forder_details_extendedlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
forder_details_extendedlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var forder_details_extendedlistsrch = currentSearchForm = new ew.Form("forder_details_extendedlistsrch");

// Filters
forder_details_extendedlistsrch.filterList = <?php echo $order_details_extended_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$order_details_extended->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($order_details_extended_list->TotalRecs > 0 && $order_details_extended_list->ExportOptions->visible()) { ?>
<?php $order_details_extended_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($order_details_extended_list->ImportOptions->visible()) { ?>
<?php $order_details_extended_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($order_details_extended_list->SearchOptions->visible()) { ?>
<?php $order_details_extended_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($order_details_extended_list->FilterOptions->visible()) { ?>
<?php $order_details_extended_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$order_details_extended_list->renderOtherOptions();
?>
<?php if (!$order_details_extended->isExport() && !$order_details_extended->CurrentAction) { ?>
<form name="forder_details_extendedlistsrch" id="forder_details_extendedlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($order_details_extended_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="forder_details_extendedlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="order_details_extended">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($order_details_extended_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($order_details_extended_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $order_details_extended_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($order_details_extended_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($order_details_extended_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($order_details_extended_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($order_details_extended_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $order_details_extended_list->showPageHeader(); ?>
<?php
$order_details_extended_list->showMessage();
?>
<?php if ($order_details_extended_list->TotalRecs > 0 || $order_details_extended->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($order_details_extended_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> order_details_extended">
<?php if (!$order_details_extended->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$order_details_extended->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($order_details_extended_list->Pager)) $order_details_extended_list->Pager = new PrevNextPager($order_details_extended_list->StartRec, $order_details_extended_list->DisplayRecs, $order_details_extended_list->TotalRecs, $order_details_extended_list->AutoHidePager) ?>
<?php if ($order_details_extended_list->Pager->RecordCount > 0 && $order_details_extended_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($order_details_extended_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $order_details_extended_list->pageUrl() ?>start=<?php echo $order_details_extended_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($order_details_extended_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $order_details_extended_list->pageUrl() ?>start=<?php echo $order_details_extended_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $order_details_extended_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($order_details_extended_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $order_details_extended_list->pageUrl() ?>start=<?php echo $order_details_extended_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($order_details_extended_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $order_details_extended_list->pageUrl() ?>start=<?php echo $order_details_extended_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $order_details_extended_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($order_details_extended_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $order_details_extended_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $order_details_extended_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $order_details_extended_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($order_details_extended_list->TotalRecs > 0 && (!$order_details_extended_list->AutoHidePageSizeSelector || $order_details_extended_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="order_details_extended">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($order_details_extended_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($order_details_extended_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($order_details_extended_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($order_details_extended->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($order_details_extended_list->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="forder_details_extendedlist" id="forder_details_extendedlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($order_details_extended_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $order_details_extended_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="order_details_extended">
<div id="gmp_order_details_extended" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($order_details_extended_list->TotalRecs > 0 || $order_details_extended->isGridEdit()) { ?>
<table id="tbl_order_details_extendedlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$order_details_extended_list->RowType = ROWTYPE_HEADER;

// Render list options
$order_details_extended_list->renderListOptions();

// Render list options (header, left)
$order_details_extended_list->ListOptions->render("header", "left");
?>
<?php if ($order_details_extended->CompanyName->Visible) { // CompanyName ?>
	<?php if ($order_details_extended->sortUrl($order_details_extended->CompanyName) == "") { ?>
		<th data-name="CompanyName" class="<?php echo $order_details_extended->CompanyName->headerCellClass() ?>"><div id="elh_order_details_extended_CompanyName" class="order_details_extended_CompanyName"><div class="ew-table-header-caption"><?php echo $order_details_extended->CompanyName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CompanyName" class="<?php echo $order_details_extended->CompanyName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $order_details_extended->SortUrl($order_details_extended->CompanyName) ?>',1);"><div id="elh_order_details_extended_CompanyName" class="order_details_extended_CompanyName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order_details_extended->CompanyName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($order_details_extended->CompanyName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($order_details_extended->CompanyName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order_details_extended->OrderID->Visible) { // OrderID ?>
	<?php if ($order_details_extended->sortUrl($order_details_extended->OrderID) == "") { ?>
		<th data-name="OrderID" class="<?php echo $order_details_extended->OrderID->headerCellClass() ?>"><div id="elh_order_details_extended_OrderID" class="order_details_extended_OrderID"><div class="ew-table-header-caption"><?php echo $order_details_extended->OrderID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OrderID" class="<?php echo $order_details_extended->OrderID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $order_details_extended->SortUrl($order_details_extended->OrderID) ?>',1);"><div id="elh_order_details_extended_OrderID" class="order_details_extended_OrderID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order_details_extended->OrderID->caption() ?></span><span class="ew-table-header-sort"><?php if ($order_details_extended->OrderID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($order_details_extended->OrderID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order_details_extended->ProductName->Visible) { // ProductName ?>
	<?php if ($order_details_extended->sortUrl($order_details_extended->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $order_details_extended->ProductName->headerCellClass() ?>"><div id="elh_order_details_extended_ProductName" class="order_details_extended_ProductName"><div class="ew-table-header-caption"><?php echo $order_details_extended->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $order_details_extended->ProductName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $order_details_extended->SortUrl($order_details_extended->ProductName) ?>',1);"><div id="elh_order_details_extended_ProductName" class="order_details_extended_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order_details_extended->ProductName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($order_details_extended->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($order_details_extended->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order_details_extended->UnitPrice->Visible) { // UnitPrice ?>
	<?php if ($order_details_extended->sortUrl($order_details_extended->UnitPrice) == "") { ?>
		<th data-name="UnitPrice" class="<?php echo $order_details_extended->UnitPrice->headerCellClass() ?>"><div id="elh_order_details_extended_UnitPrice" class="order_details_extended_UnitPrice"><div class="ew-table-header-caption"><?php echo $order_details_extended->UnitPrice->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitPrice" class="<?php echo $order_details_extended->UnitPrice->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $order_details_extended->SortUrl($order_details_extended->UnitPrice) ?>',1);"><div id="elh_order_details_extended_UnitPrice" class="order_details_extended_UnitPrice">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order_details_extended->UnitPrice->caption() ?></span><span class="ew-table-header-sort"><?php if ($order_details_extended->UnitPrice->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($order_details_extended->UnitPrice->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order_details_extended->Quantity->Visible) { // Quantity ?>
	<?php if ($order_details_extended->sortUrl($order_details_extended->Quantity) == "") { ?>
		<th data-name="Quantity" class="<?php echo $order_details_extended->Quantity->headerCellClass() ?>"><div id="elh_order_details_extended_Quantity" class="order_details_extended_Quantity"><div class="ew-table-header-caption"><?php echo $order_details_extended->Quantity->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Quantity" class="<?php echo $order_details_extended->Quantity->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $order_details_extended->SortUrl($order_details_extended->Quantity) ?>',1);"><div id="elh_order_details_extended_Quantity" class="order_details_extended_Quantity">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order_details_extended->Quantity->caption() ?></span><span class="ew-table-header-sort"><?php if ($order_details_extended->Quantity->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($order_details_extended->Quantity->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order_details_extended->Discount->Visible) { // Discount ?>
	<?php if ($order_details_extended->sortUrl($order_details_extended->Discount) == "") { ?>
		<th data-name="Discount" class="<?php echo $order_details_extended->Discount->headerCellClass() ?>"><div id="elh_order_details_extended_Discount" class="order_details_extended_Discount"><div class="ew-table-header-caption"><?php echo $order_details_extended->Discount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Discount" class="<?php echo $order_details_extended->Discount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $order_details_extended->SortUrl($order_details_extended->Discount) ?>',1);"><div id="elh_order_details_extended_Discount" class="order_details_extended_Discount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order_details_extended->Discount->caption() ?></span><span class="ew-table-header-sort"><?php if ($order_details_extended->Discount->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($order_details_extended->Discount->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order_details_extended->Extended_Price->Visible) { // Extended Price ?>
	<?php if ($order_details_extended->sortUrl($order_details_extended->Extended_Price) == "") { ?>
		<th data-name="Extended_Price" class="<?php echo $order_details_extended->Extended_Price->headerCellClass() ?>"><div id="elh_order_details_extended_Extended_Price" class="order_details_extended_Extended_Price"><div class="ew-table-header-caption"><?php echo $order_details_extended->Extended_Price->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Extended_Price" class="<?php echo $order_details_extended->Extended_Price->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $order_details_extended->SortUrl($order_details_extended->Extended_Price) ?>',1);"><div id="elh_order_details_extended_Extended_Price" class="order_details_extended_Extended_Price">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order_details_extended->Extended_Price->caption() ?></span><span class="ew-table-header-sort"><?php if ($order_details_extended->Extended_Price->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($order_details_extended->Extended_Price->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$order_details_extended_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($order_details_extended->ExportAll && $order_details_extended->isExport()) {
	$order_details_extended_list->StopRec = $order_details_extended_list->TotalRecs;
} else {

	// Set the last record to display
	if ($order_details_extended_list->TotalRecs > $order_details_extended_list->StartRec + $order_details_extended_list->DisplayRecs - 1)
		$order_details_extended_list->StopRec = $order_details_extended_list->StartRec + $order_details_extended_list->DisplayRecs - 1;
	else
		$order_details_extended_list->StopRec = $order_details_extended_list->TotalRecs;
}
$order_details_extended_list->RecCnt = $order_details_extended_list->StartRec - 1;
if ($order_details_extended_list->Recordset && !$order_details_extended_list->Recordset->EOF) {
	$order_details_extended_list->Recordset->moveFirst();
	$selectLimit = $order_details_extended_list->UseSelectLimit;
	if (!$selectLimit && $order_details_extended_list->StartRec > 1)
		$order_details_extended_list->Recordset->move($order_details_extended_list->StartRec - 1);
} elseif (!$order_details_extended->AllowAddDeleteRow && $order_details_extended_list->StopRec == 0) {
	$order_details_extended_list->StopRec = $order_details_extended->GridAddRowCount;
}

// Initialize aggregate
$order_details_extended->RowType = ROWTYPE_AGGREGATEINIT;
$order_details_extended->resetAttributes();
$order_details_extended_list->renderRow();
while ($order_details_extended_list->RecCnt < $order_details_extended_list->StopRec) {
	$order_details_extended_list->RecCnt++;
	if ($order_details_extended_list->RecCnt >= $order_details_extended_list->StartRec) {
		$order_details_extended_list->RowCnt++;

		// Set up key count
		$order_details_extended_list->KeyCount = $order_details_extended_list->RowIndex;

		// Init row class and style
		$order_details_extended->resetAttributes();
		$order_details_extended->CssClass = "";
		if ($order_details_extended->isGridAdd()) {
		} else {
			$order_details_extended_list->loadRowValues($order_details_extended_list->Recordset); // Load row values
		}
		$order_details_extended->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$order_details_extended->RowAttrs = array_merge($order_details_extended->RowAttrs, array('data-rowindex'=>$order_details_extended_list->RowCnt, 'id'=>'r' . $order_details_extended_list->RowCnt . '_order_details_extended', 'data-rowtype'=>$order_details_extended->RowType));

		// Render row
		$order_details_extended_list->renderRow();

		// Render list options
		$order_details_extended_list->renderListOptions();
?>
	<tr<?php echo $order_details_extended->rowAttributes() ?>>
<?php

// Render list options (body, left)
$order_details_extended_list->ListOptions->render("body", "left", $order_details_extended_list->RowCnt);
?>
	<?php if ($order_details_extended->CompanyName->Visible) { // CompanyName ?>
		<td data-name="CompanyName"<?php echo $order_details_extended->CompanyName->cellAttributes() ?>>
<span id="el<?php echo $order_details_extended_list->RowCnt ?>_order_details_extended_CompanyName" class="order_details_extended_CompanyName">
<span<?php echo $order_details_extended->CompanyName->viewAttributes() ?>>
<?php echo $order_details_extended->CompanyName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order_details_extended->OrderID->Visible) { // OrderID ?>
		<td data-name="OrderID"<?php echo $order_details_extended->OrderID->cellAttributes() ?>>
<span id="el<?php echo $order_details_extended_list->RowCnt ?>_order_details_extended_OrderID" class="order_details_extended_OrderID">
<span<?php echo $order_details_extended->OrderID->viewAttributes() ?>>
<?php echo $order_details_extended->OrderID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order_details_extended->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $order_details_extended->ProductName->cellAttributes() ?>>
<span id="el<?php echo $order_details_extended_list->RowCnt ?>_order_details_extended_ProductName" class="order_details_extended_ProductName">
<span<?php echo $order_details_extended->ProductName->viewAttributes() ?>>
<?php echo $order_details_extended->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order_details_extended->UnitPrice->Visible) { // UnitPrice ?>
		<td data-name="UnitPrice"<?php echo $order_details_extended->UnitPrice->cellAttributes() ?>>
<span id="el<?php echo $order_details_extended_list->RowCnt ?>_order_details_extended_UnitPrice" class="order_details_extended_UnitPrice">
<span<?php echo $order_details_extended->UnitPrice->viewAttributes() ?>>
<?php echo $order_details_extended->UnitPrice->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order_details_extended->Quantity->Visible) { // Quantity ?>
		<td data-name="Quantity"<?php echo $order_details_extended->Quantity->cellAttributes() ?>>
<span id="el<?php echo $order_details_extended_list->RowCnt ?>_order_details_extended_Quantity" class="order_details_extended_Quantity">
<span<?php echo $order_details_extended->Quantity->viewAttributes() ?>>
<?php echo $order_details_extended->Quantity->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order_details_extended->Discount->Visible) { // Discount ?>
		<td data-name="Discount"<?php echo $order_details_extended->Discount->cellAttributes() ?>>
<span id="el<?php echo $order_details_extended_list->RowCnt ?>_order_details_extended_Discount" class="order_details_extended_Discount">
<span<?php echo $order_details_extended->Discount->viewAttributes() ?>>
<?php echo $order_details_extended->Discount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order_details_extended->Extended_Price->Visible) { // Extended Price ?>
		<td data-name="Extended_Price"<?php echo $order_details_extended->Extended_Price->cellAttributes() ?>>
<span id="el<?php echo $order_details_extended_list->RowCnt ?>_order_details_extended_Extended_Price" class="order_details_extended_Extended_Price">
<span<?php echo $order_details_extended->Extended_Price->viewAttributes() ?>>
<?php echo $order_details_extended->Extended_Price->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$order_details_extended_list->ListOptions->render("body", "right", $order_details_extended_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$order_details_extended->isGridAdd())
		$order_details_extended_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$order_details_extended->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($order_details_extended_list->Recordset)
	$order_details_extended_list->Recordset->Close();
?>
<?php if (!$order_details_extended->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$order_details_extended->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($order_details_extended_list->Pager)) $order_details_extended_list->Pager = new PrevNextPager($order_details_extended_list->StartRec, $order_details_extended_list->DisplayRecs, $order_details_extended_list->TotalRecs, $order_details_extended_list->AutoHidePager) ?>
<?php if ($order_details_extended_list->Pager->RecordCount > 0 && $order_details_extended_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($order_details_extended_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $order_details_extended_list->pageUrl() ?>start=<?php echo $order_details_extended_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($order_details_extended_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $order_details_extended_list->pageUrl() ?>start=<?php echo $order_details_extended_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $order_details_extended_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($order_details_extended_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $order_details_extended_list->pageUrl() ?>start=<?php echo $order_details_extended_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($order_details_extended_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $order_details_extended_list->pageUrl() ?>start=<?php echo $order_details_extended_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $order_details_extended_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($order_details_extended_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $order_details_extended_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $order_details_extended_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $order_details_extended_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($order_details_extended_list->TotalRecs > 0 && (!$order_details_extended_list->AutoHidePageSizeSelector || $order_details_extended_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="order_details_extended">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($order_details_extended_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($order_details_extended_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($order_details_extended_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($order_details_extended->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($order_details_extended_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($order_details_extended_list->TotalRecs == 0 && !$order_details_extended->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($order_details_extended_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$order_details_extended_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$order_details_extended->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$order_details_extended_list->terminate();
?>
