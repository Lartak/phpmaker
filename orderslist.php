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
$orders_list = new orders_list();

// Run the page
$orders_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orders_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$orders->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var forderslist = currentForm = new ew.Form("forderslist", "list");
forderslist.formKeyCountName = '<?php echo $orders_list->FormKeyCountName ?>';

// Form_CustomValidate event
forderslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
forderslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var forderslistsrch = currentSearchForm = new ew.Form("forderslistsrch");

// Filters
forderslistsrch.filterList = <?php echo $orders_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$orders->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($orders_list->TotalRecs > 0 && $orders_list->ExportOptions->visible()) { ?>
<?php $orders_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($orders_list->ImportOptions->visible()) { ?>
<?php $orders_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($orders_list->SearchOptions->visible()) { ?>
<?php $orders_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($orders_list->FilterOptions->visible()) { ?>
<?php $orders_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$orders_list->renderOtherOptions();
?>
<?php if (!$orders->isExport() && !$orders->CurrentAction) { ?>
<form name="forderslistsrch" id="forderslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($orders_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="forderslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="orders">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($orders_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($orders_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $orders_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($orders_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($orders_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($orders_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($orders_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $orders_list->showPageHeader(); ?>
<?php
$orders_list->showMessage();
?>
<?php if ($orders_list->TotalRecs > 0 || $orders->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($orders_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> orders">
<?php if (!$orders->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$orders->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($orders_list->Pager)) $orders_list->Pager = new PrevNextPager($orders_list->StartRec, $orders_list->DisplayRecs, $orders_list->TotalRecs, $orders_list->AutoHidePager) ?>
<?php if ($orders_list->Pager->RecordCount > 0 && $orders_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($orders_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $orders_list->pageUrl() ?>start=<?php echo $orders_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($orders_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $orders_list->pageUrl() ?>start=<?php echo $orders_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $orders_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($orders_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $orders_list->pageUrl() ?>start=<?php echo $orders_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($orders_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $orders_list->pageUrl() ?>start=<?php echo $orders_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $orders_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($orders_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $orders_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $orders_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $orders_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($orders_list->TotalRecs > 0 && (!$orders_list->AutoHidePageSizeSelector || $orders_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="orders">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($orders_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($orders_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($orders_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($orders->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($orders_list->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="forderslist" id="forderslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($orders_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $orders_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orders">
<div id="gmp_orders" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($orders_list->TotalRecs > 0 || $orders->isGridEdit()) { ?>
<table id="tbl_orderslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$orders_list->RowType = ROWTYPE_HEADER;

// Render list options
$orders_list->renderListOptions();

// Render list options (header, left)
$orders_list->ListOptions->render("header", "left");
?>
<?php if ($orders->OrderID->Visible) { // OrderID ?>
	<?php if ($orders->sortUrl($orders->OrderID) == "") { ?>
		<th data-name="OrderID" class="<?php echo $orders->OrderID->headerCellClass() ?>"><div id="elh_orders_OrderID" class="orders_OrderID"><div class="ew-table-header-caption"><?php echo $orders->OrderID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OrderID" class="<?php echo $orders->OrderID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders->SortUrl($orders->OrderID) ?>',1);"><div id="elh_orders_OrderID" class="orders_OrderID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders->OrderID->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders->OrderID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders->OrderID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders->CustomerID->Visible) { // CustomerID ?>
	<?php if ($orders->sortUrl($orders->CustomerID) == "") { ?>
		<th data-name="CustomerID" class="<?php echo $orders->CustomerID->headerCellClass() ?>"><div id="elh_orders_CustomerID" class="orders_CustomerID"><div class="ew-table-header-caption"><?php echo $orders->CustomerID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CustomerID" class="<?php echo $orders->CustomerID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders->SortUrl($orders->CustomerID) ?>',1);"><div id="elh_orders_CustomerID" class="orders_CustomerID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders->CustomerID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders->CustomerID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders->CustomerID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($orders->sortUrl($orders->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $orders->EmployeeID->headerCellClass() ?>"><div id="elh_orders_EmployeeID" class="orders_EmployeeID"><div class="ew-table-header-caption"><?php echo $orders->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $orders->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders->SortUrl($orders->EmployeeID) ?>',1);"><div id="elh_orders_EmployeeID" class="orders_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders->EmployeeID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders->EmployeeID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders->OrderDate->Visible) { // OrderDate ?>
	<?php if ($orders->sortUrl($orders->OrderDate) == "") { ?>
		<th data-name="OrderDate" class="<?php echo $orders->OrderDate->headerCellClass() ?>"><div id="elh_orders_OrderDate" class="orders_OrderDate"><div class="ew-table-header-caption"><?php echo $orders->OrderDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OrderDate" class="<?php echo $orders->OrderDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders->SortUrl($orders->OrderDate) ?>',1);"><div id="elh_orders_OrderDate" class="orders_OrderDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders->OrderDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders->OrderDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders->OrderDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders->RequiredDate->Visible) { // RequiredDate ?>
	<?php if ($orders->sortUrl($orders->RequiredDate) == "") { ?>
		<th data-name="RequiredDate" class="<?php echo $orders->RequiredDate->headerCellClass() ?>"><div id="elh_orders_RequiredDate" class="orders_RequiredDate"><div class="ew-table-header-caption"><?php echo $orders->RequiredDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RequiredDate" class="<?php echo $orders->RequiredDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders->SortUrl($orders->RequiredDate) ?>',1);"><div id="elh_orders_RequiredDate" class="orders_RequiredDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders->RequiredDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders->RequiredDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders->RequiredDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders->ShippedDate->Visible) { // ShippedDate ?>
	<?php if ($orders->sortUrl($orders->ShippedDate) == "") { ?>
		<th data-name="ShippedDate" class="<?php echo $orders->ShippedDate->headerCellClass() ?>"><div id="elh_orders_ShippedDate" class="orders_ShippedDate"><div class="ew-table-header-caption"><?php echo $orders->ShippedDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShippedDate" class="<?php echo $orders->ShippedDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders->SortUrl($orders->ShippedDate) ?>',1);"><div id="elh_orders_ShippedDate" class="orders_ShippedDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders->ShippedDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders->ShippedDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders->ShippedDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders->ShipVia->Visible) { // ShipVia ?>
	<?php if ($orders->sortUrl($orders->ShipVia) == "") { ?>
		<th data-name="ShipVia" class="<?php echo $orders->ShipVia->headerCellClass() ?>"><div id="elh_orders_ShipVia" class="orders_ShipVia"><div class="ew-table-header-caption"><?php echo $orders->ShipVia->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShipVia" class="<?php echo $orders->ShipVia->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders->SortUrl($orders->ShipVia) ?>',1);"><div id="elh_orders_ShipVia" class="orders_ShipVia">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders->ShipVia->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders->ShipVia->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders->ShipVia->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders->Freight->Visible) { // Freight ?>
	<?php if ($orders->sortUrl($orders->Freight) == "") { ?>
		<th data-name="Freight" class="<?php echo $orders->Freight->headerCellClass() ?>"><div id="elh_orders_Freight" class="orders_Freight"><div class="ew-table-header-caption"><?php echo $orders->Freight->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Freight" class="<?php echo $orders->Freight->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders->SortUrl($orders->Freight) ?>',1);"><div id="elh_orders_Freight" class="orders_Freight">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders->Freight->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders->Freight->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders->Freight->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders->ShipName->Visible) { // ShipName ?>
	<?php if ($orders->sortUrl($orders->ShipName) == "") { ?>
		<th data-name="ShipName" class="<?php echo $orders->ShipName->headerCellClass() ?>"><div id="elh_orders_ShipName" class="orders_ShipName"><div class="ew-table-header-caption"><?php echo $orders->ShipName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShipName" class="<?php echo $orders->ShipName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders->SortUrl($orders->ShipName) ?>',1);"><div id="elh_orders_ShipName" class="orders_ShipName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders->ShipName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders->ShipName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders->ShipName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders->ShipAddress->Visible) { // ShipAddress ?>
	<?php if ($orders->sortUrl($orders->ShipAddress) == "") { ?>
		<th data-name="ShipAddress" class="<?php echo $orders->ShipAddress->headerCellClass() ?>"><div id="elh_orders_ShipAddress" class="orders_ShipAddress"><div class="ew-table-header-caption"><?php echo $orders->ShipAddress->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShipAddress" class="<?php echo $orders->ShipAddress->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders->SortUrl($orders->ShipAddress) ?>',1);"><div id="elh_orders_ShipAddress" class="orders_ShipAddress">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders->ShipAddress->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders->ShipAddress->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders->ShipAddress->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders->ShipCity->Visible) { // ShipCity ?>
	<?php if ($orders->sortUrl($orders->ShipCity) == "") { ?>
		<th data-name="ShipCity" class="<?php echo $orders->ShipCity->headerCellClass() ?>"><div id="elh_orders_ShipCity" class="orders_ShipCity"><div class="ew-table-header-caption"><?php echo $orders->ShipCity->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShipCity" class="<?php echo $orders->ShipCity->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders->SortUrl($orders->ShipCity) ?>',1);"><div id="elh_orders_ShipCity" class="orders_ShipCity">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders->ShipCity->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders->ShipCity->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders->ShipCity->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders->ShipRegion->Visible) { // ShipRegion ?>
	<?php if ($orders->sortUrl($orders->ShipRegion) == "") { ?>
		<th data-name="ShipRegion" class="<?php echo $orders->ShipRegion->headerCellClass() ?>"><div id="elh_orders_ShipRegion" class="orders_ShipRegion"><div class="ew-table-header-caption"><?php echo $orders->ShipRegion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShipRegion" class="<?php echo $orders->ShipRegion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders->SortUrl($orders->ShipRegion) ?>',1);"><div id="elh_orders_ShipRegion" class="orders_ShipRegion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders->ShipRegion->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders->ShipRegion->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders->ShipRegion->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders->ShipPostalCode->Visible) { // ShipPostalCode ?>
	<?php if ($orders->sortUrl($orders->ShipPostalCode) == "") { ?>
		<th data-name="ShipPostalCode" class="<?php echo $orders->ShipPostalCode->headerCellClass() ?>"><div id="elh_orders_ShipPostalCode" class="orders_ShipPostalCode"><div class="ew-table-header-caption"><?php echo $orders->ShipPostalCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShipPostalCode" class="<?php echo $orders->ShipPostalCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders->SortUrl($orders->ShipPostalCode) ?>',1);"><div id="elh_orders_ShipPostalCode" class="orders_ShipPostalCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders->ShipPostalCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders->ShipPostalCode->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders->ShipPostalCode->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders->ShipCountry->Visible) { // ShipCountry ?>
	<?php if ($orders->sortUrl($orders->ShipCountry) == "") { ?>
		<th data-name="ShipCountry" class="<?php echo $orders->ShipCountry->headerCellClass() ?>"><div id="elh_orders_ShipCountry" class="orders_ShipCountry"><div class="ew-table-header-caption"><?php echo $orders->ShipCountry->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShipCountry" class="<?php echo $orders->ShipCountry->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders->SortUrl($orders->ShipCountry) ?>',1);"><div id="elh_orders_ShipCountry" class="orders_ShipCountry">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders->ShipCountry->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders->ShipCountry->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders->ShipCountry->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$orders_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($orders->ExportAll && $orders->isExport()) {
	$orders_list->StopRec = $orders_list->TotalRecs;
} else {

	// Set the last record to display
	if ($orders_list->TotalRecs > $orders_list->StartRec + $orders_list->DisplayRecs - 1)
		$orders_list->StopRec = $orders_list->StartRec + $orders_list->DisplayRecs - 1;
	else
		$orders_list->StopRec = $orders_list->TotalRecs;
}
$orders_list->RecCnt = $orders_list->StartRec - 1;
if ($orders_list->Recordset && !$orders_list->Recordset->EOF) {
	$orders_list->Recordset->moveFirst();
	$selectLimit = $orders_list->UseSelectLimit;
	if (!$selectLimit && $orders_list->StartRec > 1)
		$orders_list->Recordset->move($orders_list->StartRec - 1);
} elseif (!$orders->AllowAddDeleteRow && $orders_list->StopRec == 0) {
	$orders_list->StopRec = $orders->GridAddRowCount;
}

// Initialize aggregate
$orders->RowType = ROWTYPE_AGGREGATEINIT;
$orders->resetAttributes();
$orders_list->renderRow();
while ($orders_list->RecCnt < $orders_list->StopRec) {
	$orders_list->RecCnt++;
	if ($orders_list->RecCnt >= $orders_list->StartRec) {
		$orders_list->RowCnt++;

		// Set up key count
		$orders_list->KeyCount = $orders_list->RowIndex;

		// Init row class and style
		$orders->resetAttributes();
		$orders->CssClass = "";
		if ($orders->isGridAdd()) {
		} else {
			$orders_list->loadRowValues($orders_list->Recordset); // Load row values
		}
		$orders->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$orders->RowAttrs = array_merge($orders->RowAttrs, array('data-rowindex'=>$orders_list->RowCnt, 'id'=>'r' . $orders_list->RowCnt . '_orders', 'data-rowtype'=>$orders->RowType));

		// Render row
		$orders_list->renderRow();

		// Render list options
		$orders_list->renderListOptions();
?>
	<tr<?php echo $orders->rowAttributes() ?>>
<?php

// Render list options (body, left)
$orders_list->ListOptions->render("body", "left", $orders_list->RowCnt);
?>
	<?php if ($orders->OrderID->Visible) { // OrderID ?>
		<td data-name="OrderID"<?php echo $orders->OrderID->cellAttributes() ?>>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_OrderID" class="orders_OrderID">
<span<?php echo $orders->OrderID->viewAttributes() ?>>
<?php echo $orders->OrderID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders->CustomerID->Visible) { // CustomerID ?>
		<td data-name="CustomerID"<?php echo $orders->CustomerID->cellAttributes() ?>>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_CustomerID" class="orders_CustomerID">
<span<?php echo $orders->CustomerID->viewAttributes() ?>>
<?php echo $orders->CustomerID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID"<?php echo $orders->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_EmployeeID" class="orders_EmployeeID">
<span<?php echo $orders->EmployeeID->viewAttributes() ?>>
<?php echo $orders->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders->OrderDate->Visible) { // OrderDate ?>
		<td data-name="OrderDate"<?php echo $orders->OrderDate->cellAttributes() ?>>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_OrderDate" class="orders_OrderDate">
<span<?php echo $orders->OrderDate->viewAttributes() ?>>
<?php echo $orders->OrderDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders->RequiredDate->Visible) { // RequiredDate ?>
		<td data-name="RequiredDate"<?php echo $orders->RequiredDate->cellAttributes() ?>>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_RequiredDate" class="orders_RequiredDate">
<span<?php echo $orders->RequiredDate->viewAttributes() ?>>
<?php echo $orders->RequiredDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders->ShippedDate->Visible) { // ShippedDate ?>
		<td data-name="ShippedDate"<?php echo $orders->ShippedDate->cellAttributes() ?>>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_ShippedDate" class="orders_ShippedDate">
<span<?php echo $orders->ShippedDate->viewAttributes() ?>>
<?php echo $orders->ShippedDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders->ShipVia->Visible) { // ShipVia ?>
		<td data-name="ShipVia"<?php echo $orders->ShipVia->cellAttributes() ?>>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_ShipVia" class="orders_ShipVia">
<span<?php echo $orders->ShipVia->viewAttributes() ?>>
<?php echo $orders->ShipVia->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders->Freight->Visible) { // Freight ?>
		<td data-name="Freight"<?php echo $orders->Freight->cellAttributes() ?>>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_Freight" class="orders_Freight">
<span<?php echo $orders->Freight->viewAttributes() ?>>
<?php echo $orders->Freight->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders->ShipName->Visible) { // ShipName ?>
		<td data-name="ShipName"<?php echo $orders->ShipName->cellAttributes() ?>>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_ShipName" class="orders_ShipName">
<span<?php echo $orders->ShipName->viewAttributes() ?>>
<?php echo $orders->ShipName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders->ShipAddress->Visible) { // ShipAddress ?>
		<td data-name="ShipAddress"<?php echo $orders->ShipAddress->cellAttributes() ?>>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_ShipAddress" class="orders_ShipAddress">
<span<?php echo $orders->ShipAddress->viewAttributes() ?>>
<?php echo $orders->ShipAddress->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders->ShipCity->Visible) { // ShipCity ?>
		<td data-name="ShipCity"<?php echo $orders->ShipCity->cellAttributes() ?>>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_ShipCity" class="orders_ShipCity">
<span<?php echo $orders->ShipCity->viewAttributes() ?>>
<?php echo $orders->ShipCity->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders->ShipRegion->Visible) { // ShipRegion ?>
		<td data-name="ShipRegion"<?php echo $orders->ShipRegion->cellAttributes() ?>>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_ShipRegion" class="orders_ShipRegion">
<span<?php echo $orders->ShipRegion->viewAttributes() ?>>
<?php echo $orders->ShipRegion->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders->ShipPostalCode->Visible) { // ShipPostalCode ?>
		<td data-name="ShipPostalCode"<?php echo $orders->ShipPostalCode->cellAttributes() ?>>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_ShipPostalCode" class="orders_ShipPostalCode">
<span<?php echo $orders->ShipPostalCode->viewAttributes() ?>>
<?php echo $orders->ShipPostalCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders->ShipCountry->Visible) { // ShipCountry ?>
		<td data-name="ShipCountry"<?php echo $orders->ShipCountry->cellAttributes() ?>>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_ShipCountry" class="orders_ShipCountry">
<span<?php echo $orders->ShipCountry->viewAttributes() ?>>
<?php echo $orders->ShipCountry->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$orders_list->ListOptions->render("body", "right", $orders_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$orders->isGridAdd())
		$orders_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$orders->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($orders_list->Recordset)
	$orders_list->Recordset->Close();
?>
<?php if (!$orders->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$orders->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($orders_list->Pager)) $orders_list->Pager = new PrevNextPager($orders_list->StartRec, $orders_list->DisplayRecs, $orders_list->TotalRecs, $orders_list->AutoHidePager) ?>
<?php if ($orders_list->Pager->RecordCount > 0 && $orders_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($orders_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $orders_list->pageUrl() ?>start=<?php echo $orders_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($orders_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $orders_list->pageUrl() ?>start=<?php echo $orders_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $orders_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($orders_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $orders_list->pageUrl() ?>start=<?php echo $orders_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($orders_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $orders_list->pageUrl() ?>start=<?php echo $orders_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $orders_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($orders_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $orders_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $orders_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $orders_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($orders_list->TotalRecs > 0 && (!$orders_list->AutoHidePageSizeSelector || $orders_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="orders">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($orders_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($orders_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($orders_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($orders->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($orders_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($orders_list->TotalRecs == 0 && !$orders->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($orders_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$orders_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$orders->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$orders_list->terminate();
?>
