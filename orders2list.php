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
$orders2_list = new orders2_list();

// Run the page
$orders2_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orders2_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$orders2->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var forders2list = currentForm = new ew.Form("forders2list", "list");
forders2list.formKeyCountName = '<?php echo $orders2_list->FormKeyCountName ?>';

// Form_CustomValidate event
forders2list.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
forders2list.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var forders2listsrch = currentSearchForm = new ew.Form("forders2listsrch");

// Filters
forders2listsrch.filterList = <?php echo $orders2_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$orders2->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($orders2_list->TotalRecs > 0 && $orders2_list->ExportOptions->visible()) { ?>
<?php $orders2_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($orders2_list->ImportOptions->visible()) { ?>
<?php $orders2_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($orders2_list->SearchOptions->visible()) { ?>
<?php $orders2_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($orders2_list->FilterOptions->visible()) { ?>
<?php $orders2_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$orders2_list->renderOtherOptions();
?>
<?php if (!$orders2->isExport() && !$orders2->CurrentAction) { ?>
<form name="forders2listsrch" id="forders2listsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($orders2_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="forders2listsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="orders2">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($orders2_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($orders2_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $orders2_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($orders2_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($orders2_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($orders2_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($orders2_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $orders2_list->showPageHeader(); ?>
<?php
$orders2_list->showMessage();
?>
<?php if ($orders2_list->TotalRecs > 0 || $orders2->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($orders2_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> orders2">
<?php if (!$orders2->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$orders2->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($orders2_list->Pager)) $orders2_list->Pager = new PrevNextPager($orders2_list->StartRec, $orders2_list->DisplayRecs, $orders2_list->TotalRecs, $orders2_list->AutoHidePager) ?>
<?php if ($orders2_list->Pager->RecordCount > 0 && $orders2_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($orders2_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $orders2_list->pageUrl() ?>start=<?php echo $orders2_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($orders2_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $orders2_list->pageUrl() ?>start=<?php echo $orders2_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $orders2_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($orders2_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $orders2_list->pageUrl() ?>start=<?php echo $orders2_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($orders2_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $orders2_list->pageUrl() ?>start=<?php echo $orders2_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $orders2_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($orders2_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $orders2_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $orders2_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $orders2_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($orders2_list->TotalRecs > 0 && (!$orders2_list->AutoHidePageSizeSelector || $orders2_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="orders2">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($orders2_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($orders2_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($orders2_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($orders2->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($orders2_list->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="forders2list" id="forders2list" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($orders2_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $orders2_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orders2">
<div id="gmp_orders2" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($orders2_list->TotalRecs > 0 || $orders2->isGridEdit()) { ?>
<table id="tbl_orders2list" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$orders2_list->RowType = ROWTYPE_HEADER;

// Render list options
$orders2_list->renderListOptions();

// Render list options (header, left)
$orders2_list->ListOptions->render("header", "left");
?>
<?php if ($orders2->OrderID->Visible) { // OrderID ?>
	<?php if ($orders2->sortUrl($orders2->OrderID) == "") { ?>
		<th data-name="OrderID" class="<?php echo $orders2->OrderID->headerCellClass() ?>"><div id="elh_orders2_OrderID" class="orders2_OrderID"><div class="ew-table-header-caption"><?php echo $orders2->OrderID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OrderID" class="<?php echo $orders2->OrderID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders2->SortUrl($orders2->OrderID) ?>',1);"><div id="elh_orders2_OrderID" class="orders2_OrderID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders2->OrderID->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders2->OrderID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders2->OrderID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders2->CustomerID->Visible) { // CustomerID ?>
	<?php if ($orders2->sortUrl($orders2->CustomerID) == "") { ?>
		<th data-name="CustomerID" class="<?php echo $orders2->CustomerID->headerCellClass() ?>"><div id="elh_orders2_CustomerID" class="orders2_CustomerID"><div class="ew-table-header-caption"><?php echo $orders2->CustomerID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CustomerID" class="<?php echo $orders2->CustomerID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders2->SortUrl($orders2->CustomerID) ?>',1);"><div id="elh_orders2_CustomerID" class="orders2_CustomerID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders2->CustomerID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders2->CustomerID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders2->CustomerID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders2->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($orders2->sortUrl($orders2->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $orders2->EmployeeID->headerCellClass() ?>"><div id="elh_orders2_EmployeeID" class="orders2_EmployeeID"><div class="ew-table-header-caption"><?php echo $orders2->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $orders2->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders2->SortUrl($orders2->EmployeeID) ?>',1);"><div id="elh_orders2_EmployeeID" class="orders2_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders2->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders2->EmployeeID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders2->EmployeeID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders2->OrderDate->Visible) { // OrderDate ?>
	<?php if ($orders2->sortUrl($orders2->OrderDate) == "") { ?>
		<th data-name="OrderDate" class="<?php echo $orders2->OrderDate->headerCellClass() ?>"><div id="elh_orders2_OrderDate" class="orders2_OrderDate"><div class="ew-table-header-caption"><?php echo $orders2->OrderDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OrderDate" class="<?php echo $orders2->OrderDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders2->SortUrl($orders2->OrderDate) ?>',1);"><div id="elh_orders2_OrderDate" class="orders2_OrderDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders2->OrderDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders2->OrderDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders2->OrderDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders2->RequiredDate->Visible) { // RequiredDate ?>
	<?php if ($orders2->sortUrl($orders2->RequiredDate) == "") { ?>
		<th data-name="RequiredDate" class="<?php echo $orders2->RequiredDate->headerCellClass() ?>"><div id="elh_orders2_RequiredDate" class="orders2_RequiredDate"><div class="ew-table-header-caption"><?php echo $orders2->RequiredDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RequiredDate" class="<?php echo $orders2->RequiredDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders2->SortUrl($orders2->RequiredDate) ?>',1);"><div id="elh_orders2_RequiredDate" class="orders2_RequiredDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders2->RequiredDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders2->RequiredDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders2->RequiredDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders2->ShippedDate->Visible) { // ShippedDate ?>
	<?php if ($orders2->sortUrl($orders2->ShippedDate) == "") { ?>
		<th data-name="ShippedDate" class="<?php echo $orders2->ShippedDate->headerCellClass() ?>"><div id="elh_orders2_ShippedDate" class="orders2_ShippedDate"><div class="ew-table-header-caption"><?php echo $orders2->ShippedDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShippedDate" class="<?php echo $orders2->ShippedDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders2->SortUrl($orders2->ShippedDate) ?>',1);"><div id="elh_orders2_ShippedDate" class="orders2_ShippedDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders2->ShippedDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders2->ShippedDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders2->ShippedDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders2->ShipVia->Visible) { // ShipVia ?>
	<?php if ($orders2->sortUrl($orders2->ShipVia) == "") { ?>
		<th data-name="ShipVia" class="<?php echo $orders2->ShipVia->headerCellClass() ?>"><div id="elh_orders2_ShipVia" class="orders2_ShipVia"><div class="ew-table-header-caption"><?php echo $orders2->ShipVia->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShipVia" class="<?php echo $orders2->ShipVia->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders2->SortUrl($orders2->ShipVia) ?>',1);"><div id="elh_orders2_ShipVia" class="orders2_ShipVia">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders2->ShipVia->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders2->ShipVia->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders2->ShipVia->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders2->Freight->Visible) { // Freight ?>
	<?php if ($orders2->sortUrl($orders2->Freight) == "") { ?>
		<th data-name="Freight" class="<?php echo $orders2->Freight->headerCellClass() ?>"><div id="elh_orders2_Freight" class="orders2_Freight"><div class="ew-table-header-caption"><?php echo $orders2->Freight->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Freight" class="<?php echo $orders2->Freight->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders2->SortUrl($orders2->Freight) ?>',1);"><div id="elh_orders2_Freight" class="orders2_Freight">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders2->Freight->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders2->Freight->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders2->Freight->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders2->ShipName->Visible) { // ShipName ?>
	<?php if ($orders2->sortUrl($orders2->ShipName) == "") { ?>
		<th data-name="ShipName" class="<?php echo $orders2->ShipName->headerCellClass() ?>"><div id="elh_orders2_ShipName" class="orders2_ShipName"><div class="ew-table-header-caption"><?php echo $orders2->ShipName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShipName" class="<?php echo $orders2->ShipName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders2->SortUrl($orders2->ShipName) ?>',1);"><div id="elh_orders2_ShipName" class="orders2_ShipName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders2->ShipName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders2->ShipName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders2->ShipName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders2->ShipAddress->Visible) { // ShipAddress ?>
	<?php if ($orders2->sortUrl($orders2->ShipAddress) == "") { ?>
		<th data-name="ShipAddress" class="<?php echo $orders2->ShipAddress->headerCellClass() ?>"><div id="elh_orders2_ShipAddress" class="orders2_ShipAddress"><div class="ew-table-header-caption"><?php echo $orders2->ShipAddress->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShipAddress" class="<?php echo $orders2->ShipAddress->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders2->SortUrl($orders2->ShipAddress) ?>',1);"><div id="elh_orders2_ShipAddress" class="orders2_ShipAddress">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders2->ShipAddress->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders2->ShipAddress->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders2->ShipAddress->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders2->ShipCity->Visible) { // ShipCity ?>
	<?php if ($orders2->sortUrl($orders2->ShipCity) == "") { ?>
		<th data-name="ShipCity" class="<?php echo $orders2->ShipCity->headerCellClass() ?>"><div id="elh_orders2_ShipCity" class="orders2_ShipCity"><div class="ew-table-header-caption"><?php echo $orders2->ShipCity->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShipCity" class="<?php echo $orders2->ShipCity->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders2->SortUrl($orders2->ShipCity) ?>',1);"><div id="elh_orders2_ShipCity" class="orders2_ShipCity">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders2->ShipCity->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders2->ShipCity->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders2->ShipCity->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders2->ShipRegion->Visible) { // ShipRegion ?>
	<?php if ($orders2->sortUrl($orders2->ShipRegion) == "") { ?>
		<th data-name="ShipRegion" class="<?php echo $orders2->ShipRegion->headerCellClass() ?>"><div id="elh_orders2_ShipRegion" class="orders2_ShipRegion"><div class="ew-table-header-caption"><?php echo $orders2->ShipRegion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShipRegion" class="<?php echo $orders2->ShipRegion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders2->SortUrl($orders2->ShipRegion) ?>',1);"><div id="elh_orders2_ShipRegion" class="orders2_ShipRegion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders2->ShipRegion->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders2->ShipRegion->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders2->ShipRegion->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders2->ShipPostalCode->Visible) { // ShipPostalCode ?>
	<?php if ($orders2->sortUrl($orders2->ShipPostalCode) == "") { ?>
		<th data-name="ShipPostalCode" class="<?php echo $orders2->ShipPostalCode->headerCellClass() ?>"><div id="elh_orders2_ShipPostalCode" class="orders2_ShipPostalCode"><div class="ew-table-header-caption"><?php echo $orders2->ShipPostalCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShipPostalCode" class="<?php echo $orders2->ShipPostalCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders2->SortUrl($orders2->ShipPostalCode) ?>',1);"><div id="elh_orders2_ShipPostalCode" class="orders2_ShipPostalCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders2->ShipPostalCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders2->ShipPostalCode->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders2->ShipPostalCode->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders2->ShipCountry->Visible) { // ShipCountry ?>
	<?php if ($orders2->sortUrl($orders2->ShipCountry) == "") { ?>
		<th data-name="ShipCountry" class="<?php echo $orders2->ShipCountry->headerCellClass() ?>"><div id="elh_orders2_ShipCountry" class="orders2_ShipCountry"><div class="ew-table-header-caption"><?php echo $orders2->ShipCountry->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShipCountry" class="<?php echo $orders2->ShipCountry->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders2->SortUrl($orders2->ShipCountry) ?>',1);"><div id="elh_orders2_ShipCountry" class="orders2_ShipCountry">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders2->ShipCountry->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders2->ShipCountry->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders2->ShipCountry->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$orders2_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($orders2->ExportAll && $orders2->isExport()) {
	$orders2_list->StopRec = $orders2_list->TotalRecs;
} else {

	// Set the last record to display
	if ($orders2_list->TotalRecs > $orders2_list->StartRec + $orders2_list->DisplayRecs - 1)
		$orders2_list->StopRec = $orders2_list->StartRec + $orders2_list->DisplayRecs - 1;
	else
		$orders2_list->StopRec = $orders2_list->TotalRecs;
}
$orders2_list->RecCnt = $orders2_list->StartRec - 1;
if ($orders2_list->Recordset && !$orders2_list->Recordset->EOF) {
	$orders2_list->Recordset->moveFirst();
	$selectLimit = $orders2_list->UseSelectLimit;
	if (!$selectLimit && $orders2_list->StartRec > 1)
		$orders2_list->Recordset->move($orders2_list->StartRec - 1);
} elseif (!$orders2->AllowAddDeleteRow && $orders2_list->StopRec == 0) {
	$orders2_list->StopRec = $orders2->GridAddRowCount;
}

// Initialize aggregate
$orders2->RowType = ROWTYPE_AGGREGATEINIT;
$orders2->resetAttributes();
$orders2_list->renderRow();
while ($orders2_list->RecCnt < $orders2_list->StopRec) {
	$orders2_list->RecCnt++;
	if ($orders2_list->RecCnt >= $orders2_list->StartRec) {
		$orders2_list->RowCnt++;

		// Set up key count
		$orders2_list->KeyCount = $orders2_list->RowIndex;

		// Init row class and style
		$orders2->resetAttributes();
		$orders2->CssClass = "";
		if ($orders2->isGridAdd()) {
		} else {
			$orders2_list->loadRowValues($orders2_list->Recordset); // Load row values
		}
		$orders2->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$orders2->RowAttrs = array_merge($orders2->RowAttrs, array('data-rowindex'=>$orders2_list->RowCnt, 'id'=>'r' . $orders2_list->RowCnt . '_orders2', 'data-rowtype'=>$orders2->RowType));

		// Render row
		$orders2_list->renderRow();

		// Render list options
		$orders2_list->renderListOptions();
?>
	<tr<?php echo $orders2->rowAttributes() ?>>
<?php

// Render list options (body, left)
$orders2_list->ListOptions->render("body", "left", $orders2_list->RowCnt);
?>
	<?php if ($orders2->OrderID->Visible) { // OrderID ?>
		<td data-name="OrderID"<?php echo $orders2->OrderID->cellAttributes() ?>>
<span id="el<?php echo $orders2_list->RowCnt ?>_orders2_OrderID" class="orders2_OrderID">
<span<?php echo $orders2->OrderID->viewAttributes() ?>>
<?php echo $orders2->OrderID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders2->CustomerID->Visible) { // CustomerID ?>
		<td data-name="CustomerID"<?php echo $orders2->CustomerID->cellAttributes() ?>>
<span id="el<?php echo $orders2_list->RowCnt ?>_orders2_CustomerID" class="orders2_CustomerID">
<span<?php echo $orders2->CustomerID->viewAttributes() ?>>
<?php echo $orders2->CustomerID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders2->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID"<?php echo $orders2->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $orders2_list->RowCnt ?>_orders2_EmployeeID" class="orders2_EmployeeID">
<span<?php echo $orders2->EmployeeID->viewAttributes() ?>>
<?php echo $orders2->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders2->OrderDate->Visible) { // OrderDate ?>
		<td data-name="OrderDate"<?php echo $orders2->OrderDate->cellAttributes() ?>>
<span id="el<?php echo $orders2_list->RowCnt ?>_orders2_OrderDate" class="orders2_OrderDate">
<span<?php echo $orders2->OrderDate->viewAttributes() ?>>
<?php echo $orders2->OrderDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders2->RequiredDate->Visible) { // RequiredDate ?>
		<td data-name="RequiredDate"<?php echo $orders2->RequiredDate->cellAttributes() ?>>
<span id="el<?php echo $orders2_list->RowCnt ?>_orders2_RequiredDate" class="orders2_RequiredDate">
<span<?php echo $orders2->RequiredDate->viewAttributes() ?>>
<?php echo $orders2->RequiredDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders2->ShippedDate->Visible) { // ShippedDate ?>
		<td data-name="ShippedDate"<?php echo $orders2->ShippedDate->cellAttributes() ?>>
<span id="el<?php echo $orders2_list->RowCnt ?>_orders2_ShippedDate" class="orders2_ShippedDate">
<span<?php echo $orders2->ShippedDate->viewAttributes() ?>>
<?php echo $orders2->ShippedDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders2->ShipVia->Visible) { // ShipVia ?>
		<td data-name="ShipVia"<?php echo $orders2->ShipVia->cellAttributes() ?>>
<span id="el<?php echo $orders2_list->RowCnt ?>_orders2_ShipVia" class="orders2_ShipVia">
<span<?php echo $orders2->ShipVia->viewAttributes() ?>>
<?php echo $orders2->ShipVia->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders2->Freight->Visible) { // Freight ?>
		<td data-name="Freight"<?php echo $orders2->Freight->cellAttributes() ?>>
<span id="el<?php echo $orders2_list->RowCnt ?>_orders2_Freight" class="orders2_Freight">
<span<?php echo $orders2->Freight->viewAttributes() ?>>
<?php echo $orders2->Freight->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders2->ShipName->Visible) { // ShipName ?>
		<td data-name="ShipName"<?php echo $orders2->ShipName->cellAttributes() ?>>
<span id="el<?php echo $orders2_list->RowCnt ?>_orders2_ShipName" class="orders2_ShipName">
<span<?php echo $orders2->ShipName->viewAttributes() ?>>
<?php echo $orders2->ShipName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders2->ShipAddress->Visible) { // ShipAddress ?>
		<td data-name="ShipAddress"<?php echo $orders2->ShipAddress->cellAttributes() ?>>
<span id="el<?php echo $orders2_list->RowCnt ?>_orders2_ShipAddress" class="orders2_ShipAddress">
<span<?php echo $orders2->ShipAddress->viewAttributes() ?>>
<?php echo $orders2->ShipAddress->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders2->ShipCity->Visible) { // ShipCity ?>
		<td data-name="ShipCity"<?php echo $orders2->ShipCity->cellAttributes() ?>>
<span id="el<?php echo $orders2_list->RowCnt ?>_orders2_ShipCity" class="orders2_ShipCity">
<span<?php echo $orders2->ShipCity->viewAttributes() ?>>
<?php echo $orders2->ShipCity->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders2->ShipRegion->Visible) { // ShipRegion ?>
		<td data-name="ShipRegion"<?php echo $orders2->ShipRegion->cellAttributes() ?>>
<span id="el<?php echo $orders2_list->RowCnt ?>_orders2_ShipRegion" class="orders2_ShipRegion">
<span<?php echo $orders2->ShipRegion->viewAttributes() ?>>
<?php echo $orders2->ShipRegion->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders2->ShipPostalCode->Visible) { // ShipPostalCode ?>
		<td data-name="ShipPostalCode"<?php echo $orders2->ShipPostalCode->cellAttributes() ?>>
<span id="el<?php echo $orders2_list->RowCnt ?>_orders2_ShipPostalCode" class="orders2_ShipPostalCode">
<span<?php echo $orders2->ShipPostalCode->viewAttributes() ?>>
<?php echo $orders2->ShipPostalCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders2->ShipCountry->Visible) { // ShipCountry ?>
		<td data-name="ShipCountry"<?php echo $orders2->ShipCountry->cellAttributes() ?>>
<span id="el<?php echo $orders2_list->RowCnt ?>_orders2_ShipCountry" class="orders2_ShipCountry">
<span<?php echo $orders2->ShipCountry->viewAttributes() ?>>
<?php echo $orders2->ShipCountry->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$orders2_list->ListOptions->render("body", "right", $orders2_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$orders2->isGridAdd())
		$orders2_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$orders2->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($orders2_list->Recordset)
	$orders2_list->Recordset->Close();
?>
<?php if (!$orders2->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$orders2->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($orders2_list->Pager)) $orders2_list->Pager = new PrevNextPager($orders2_list->StartRec, $orders2_list->DisplayRecs, $orders2_list->TotalRecs, $orders2_list->AutoHidePager) ?>
<?php if ($orders2_list->Pager->RecordCount > 0 && $orders2_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($orders2_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $orders2_list->pageUrl() ?>start=<?php echo $orders2_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($orders2_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $orders2_list->pageUrl() ?>start=<?php echo $orders2_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $orders2_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($orders2_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $orders2_list->pageUrl() ?>start=<?php echo $orders2_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($orders2_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $orders2_list->pageUrl() ?>start=<?php echo $orders2_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $orders2_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($orders2_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $orders2_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $orders2_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $orders2_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($orders2_list->TotalRecs > 0 && (!$orders2_list->AutoHidePageSizeSelector || $orders2_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="orders2">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($orders2_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($orders2_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($orders2_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($orders2->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($orders2_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($orders2_list->TotalRecs == 0 && !$orders2->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($orders2_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$orders2_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$orders2->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$orders2_list->terminate();
?>
