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
$suppliers_list = new suppliers_list();

// Run the page
$suppliers_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$suppliers_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$suppliers->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fsupplierslist = currentForm = new ew.Form("fsupplierslist", "list");
fsupplierslist.formKeyCountName = '<?php echo $suppliers_list->FormKeyCountName ?>';

// Form_CustomValidate event
fsupplierslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fsupplierslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fsupplierslistsrch = currentSearchForm = new ew.Form("fsupplierslistsrch");

// Filters
fsupplierslistsrch.filterList = <?php echo $suppliers_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$suppliers->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($suppliers_list->TotalRecs > 0 && $suppliers_list->ExportOptions->visible()) { ?>
<?php $suppliers_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($suppliers_list->ImportOptions->visible()) { ?>
<?php $suppliers_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($suppliers_list->SearchOptions->visible()) { ?>
<?php $suppliers_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($suppliers_list->FilterOptions->visible()) { ?>
<?php $suppliers_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$suppliers_list->renderOtherOptions();
?>
<?php if (!$suppliers->isExport() && !$suppliers->CurrentAction) { ?>
<form name="fsupplierslistsrch" id="fsupplierslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($suppliers_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fsupplierslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="suppliers">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($suppliers_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($suppliers_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $suppliers_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($suppliers_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($suppliers_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($suppliers_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($suppliers_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $suppliers_list->showPageHeader(); ?>
<?php
$suppliers_list->showMessage();
?>
<?php if ($suppliers_list->TotalRecs > 0 || $suppliers->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($suppliers_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> suppliers">
<?php if (!$suppliers->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$suppliers->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($suppliers_list->Pager)) $suppliers_list->Pager = new PrevNextPager($suppliers_list->StartRec, $suppliers_list->DisplayRecs, $suppliers_list->TotalRecs, $suppliers_list->AutoHidePager) ?>
<?php if ($suppliers_list->Pager->RecordCount > 0 && $suppliers_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($suppliers_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $suppliers_list->pageUrl() ?>start=<?php echo $suppliers_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($suppliers_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $suppliers_list->pageUrl() ?>start=<?php echo $suppliers_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $suppliers_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($suppliers_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $suppliers_list->pageUrl() ?>start=<?php echo $suppliers_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($suppliers_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $suppliers_list->pageUrl() ?>start=<?php echo $suppliers_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $suppliers_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($suppliers_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $suppliers_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $suppliers_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $suppliers_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($suppliers_list->TotalRecs > 0 && (!$suppliers_list->AutoHidePageSizeSelector || $suppliers_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="suppliers">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($suppliers_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($suppliers_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($suppliers_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($suppliers->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($suppliers_list->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fsupplierslist" id="fsupplierslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($suppliers_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $suppliers_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="suppliers">
<div id="gmp_suppliers" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($suppliers_list->TotalRecs > 0 || $suppliers->isGridEdit()) { ?>
<table id="tbl_supplierslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$suppliers_list->RowType = ROWTYPE_HEADER;

// Render list options
$suppliers_list->renderListOptions();

// Render list options (header, left)
$suppliers_list->ListOptions->render("header", "left");
?>
<?php if ($suppliers->SupplierID->Visible) { // SupplierID ?>
	<?php if ($suppliers->sortUrl($suppliers->SupplierID) == "") { ?>
		<th data-name="SupplierID" class="<?php echo $suppliers->SupplierID->headerCellClass() ?>"><div id="elh_suppliers_SupplierID" class="suppliers_SupplierID"><div class="ew-table-header-caption"><?php echo $suppliers->SupplierID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SupplierID" class="<?php echo $suppliers->SupplierID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $suppliers->SortUrl($suppliers->SupplierID) ?>',1);"><div id="elh_suppliers_SupplierID" class="suppliers_SupplierID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $suppliers->SupplierID->caption() ?></span><span class="ew-table-header-sort"><?php if ($suppliers->SupplierID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($suppliers->SupplierID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($suppliers->CompanyName->Visible) { // CompanyName ?>
	<?php if ($suppliers->sortUrl($suppliers->CompanyName) == "") { ?>
		<th data-name="CompanyName" class="<?php echo $suppliers->CompanyName->headerCellClass() ?>"><div id="elh_suppliers_CompanyName" class="suppliers_CompanyName"><div class="ew-table-header-caption"><?php echo $suppliers->CompanyName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CompanyName" class="<?php echo $suppliers->CompanyName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $suppliers->SortUrl($suppliers->CompanyName) ?>',1);"><div id="elh_suppliers_CompanyName" class="suppliers_CompanyName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $suppliers->CompanyName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($suppliers->CompanyName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($suppliers->CompanyName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($suppliers->ContactName->Visible) { // ContactName ?>
	<?php if ($suppliers->sortUrl($suppliers->ContactName) == "") { ?>
		<th data-name="ContactName" class="<?php echo $suppliers->ContactName->headerCellClass() ?>"><div id="elh_suppliers_ContactName" class="suppliers_ContactName"><div class="ew-table-header-caption"><?php echo $suppliers->ContactName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContactName" class="<?php echo $suppliers->ContactName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $suppliers->SortUrl($suppliers->ContactName) ?>',1);"><div id="elh_suppliers_ContactName" class="suppliers_ContactName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $suppliers->ContactName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($suppliers->ContactName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($suppliers->ContactName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($suppliers->ContactTitle->Visible) { // ContactTitle ?>
	<?php if ($suppliers->sortUrl($suppliers->ContactTitle) == "") { ?>
		<th data-name="ContactTitle" class="<?php echo $suppliers->ContactTitle->headerCellClass() ?>"><div id="elh_suppliers_ContactTitle" class="suppliers_ContactTitle"><div class="ew-table-header-caption"><?php echo $suppliers->ContactTitle->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContactTitle" class="<?php echo $suppliers->ContactTitle->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $suppliers->SortUrl($suppliers->ContactTitle) ?>',1);"><div id="elh_suppliers_ContactTitle" class="suppliers_ContactTitle">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $suppliers->ContactTitle->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($suppliers->ContactTitle->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($suppliers->ContactTitle->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($suppliers->Address->Visible) { // Address ?>
	<?php if ($suppliers->sortUrl($suppliers->Address) == "") { ?>
		<th data-name="Address" class="<?php echo $suppliers->Address->headerCellClass() ?>"><div id="elh_suppliers_Address" class="suppliers_Address"><div class="ew-table-header-caption"><?php echo $suppliers->Address->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Address" class="<?php echo $suppliers->Address->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $suppliers->SortUrl($suppliers->Address) ?>',1);"><div id="elh_suppliers_Address" class="suppliers_Address">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $suppliers->Address->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($suppliers->Address->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($suppliers->Address->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($suppliers->City->Visible) { // City ?>
	<?php if ($suppliers->sortUrl($suppliers->City) == "") { ?>
		<th data-name="City" class="<?php echo $suppliers->City->headerCellClass() ?>"><div id="elh_suppliers_City" class="suppliers_City"><div class="ew-table-header-caption"><?php echo $suppliers->City->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="City" class="<?php echo $suppliers->City->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $suppliers->SortUrl($suppliers->City) ?>',1);"><div id="elh_suppliers_City" class="suppliers_City">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $suppliers->City->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($suppliers->City->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($suppliers->City->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($suppliers->Region->Visible) { // Region ?>
	<?php if ($suppliers->sortUrl($suppliers->Region) == "") { ?>
		<th data-name="Region" class="<?php echo $suppliers->Region->headerCellClass() ?>"><div id="elh_suppliers_Region" class="suppliers_Region"><div class="ew-table-header-caption"><?php echo $suppliers->Region->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Region" class="<?php echo $suppliers->Region->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $suppliers->SortUrl($suppliers->Region) ?>',1);"><div id="elh_suppliers_Region" class="suppliers_Region">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $suppliers->Region->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($suppliers->Region->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($suppliers->Region->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($suppliers->PostalCode->Visible) { // PostalCode ?>
	<?php if ($suppliers->sortUrl($suppliers->PostalCode) == "") { ?>
		<th data-name="PostalCode" class="<?php echo $suppliers->PostalCode->headerCellClass() ?>"><div id="elh_suppliers_PostalCode" class="suppliers_PostalCode"><div class="ew-table-header-caption"><?php echo $suppliers->PostalCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PostalCode" class="<?php echo $suppliers->PostalCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $suppliers->SortUrl($suppliers->PostalCode) ?>',1);"><div id="elh_suppliers_PostalCode" class="suppliers_PostalCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $suppliers->PostalCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($suppliers->PostalCode->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($suppliers->PostalCode->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($suppliers->Country->Visible) { // Country ?>
	<?php if ($suppliers->sortUrl($suppliers->Country) == "") { ?>
		<th data-name="Country" class="<?php echo $suppliers->Country->headerCellClass() ?>"><div id="elh_suppliers_Country" class="suppliers_Country"><div class="ew-table-header-caption"><?php echo $suppliers->Country->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Country" class="<?php echo $suppliers->Country->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $suppliers->SortUrl($suppliers->Country) ?>',1);"><div id="elh_suppliers_Country" class="suppliers_Country">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $suppliers->Country->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($suppliers->Country->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($suppliers->Country->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($suppliers->Phone->Visible) { // Phone ?>
	<?php if ($suppliers->sortUrl($suppliers->Phone) == "") { ?>
		<th data-name="Phone" class="<?php echo $suppliers->Phone->headerCellClass() ?>"><div id="elh_suppliers_Phone" class="suppliers_Phone"><div class="ew-table-header-caption"><?php echo $suppliers->Phone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Phone" class="<?php echo $suppliers->Phone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $suppliers->SortUrl($suppliers->Phone) ?>',1);"><div id="elh_suppliers_Phone" class="suppliers_Phone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $suppliers->Phone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($suppliers->Phone->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($suppliers->Phone->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($suppliers->Fax->Visible) { // Fax ?>
	<?php if ($suppliers->sortUrl($suppliers->Fax) == "") { ?>
		<th data-name="Fax" class="<?php echo $suppliers->Fax->headerCellClass() ?>"><div id="elh_suppliers_Fax" class="suppliers_Fax"><div class="ew-table-header-caption"><?php echo $suppliers->Fax->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Fax" class="<?php echo $suppliers->Fax->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $suppliers->SortUrl($suppliers->Fax) ?>',1);"><div id="elh_suppliers_Fax" class="suppliers_Fax">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $suppliers->Fax->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($suppliers->Fax->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($suppliers->Fax->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$suppliers_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($suppliers->ExportAll && $suppliers->isExport()) {
	$suppliers_list->StopRec = $suppliers_list->TotalRecs;
} else {

	// Set the last record to display
	if ($suppliers_list->TotalRecs > $suppliers_list->StartRec + $suppliers_list->DisplayRecs - 1)
		$suppliers_list->StopRec = $suppliers_list->StartRec + $suppliers_list->DisplayRecs - 1;
	else
		$suppliers_list->StopRec = $suppliers_list->TotalRecs;
}
$suppliers_list->RecCnt = $suppliers_list->StartRec - 1;
if ($suppliers_list->Recordset && !$suppliers_list->Recordset->EOF) {
	$suppliers_list->Recordset->moveFirst();
	$selectLimit = $suppliers_list->UseSelectLimit;
	if (!$selectLimit && $suppliers_list->StartRec > 1)
		$suppliers_list->Recordset->move($suppliers_list->StartRec - 1);
} elseif (!$suppliers->AllowAddDeleteRow && $suppliers_list->StopRec == 0) {
	$suppliers_list->StopRec = $suppliers->GridAddRowCount;
}

// Initialize aggregate
$suppliers->RowType = ROWTYPE_AGGREGATEINIT;
$suppliers->resetAttributes();
$suppliers_list->renderRow();
while ($suppliers_list->RecCnt < $suppliers_list->StopRec) {
	$suppliers_list->RecCnt++;
	if ($suppliers_list->RecCnt >= $suppliers_list->StartRec) {
		$suppliers_list->RowCnt++;

		// Set up key count
		$suppliers_list->KeyCount = $suppliers_list->RowIndex;

		// Init row class and style
		$suppliers->resetAttributes();
		$suppliers->CssClass = "";
		if ($suppliers->isGridAdd()) {
		} else {
			$suppliers_list->loadRowValues($suppliers_list->Recordset); // Load row values
		}
		$suppliers->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$suppliers->RowAttrs = array_merge($suppliers->RowAttrs, array('data-rowindex'=>$suppliers_list->RowCnt, 'id'=>'r' . $suppliers_list->RowCnt . '_suppliers', 'data-rowtype'=>$suppliers->RowType));

		// Render row
		$suppliers_list->renderRow();

		// Render list options
		$suppliers_list->renderListOptions();
?>
	<tr<?php echo $suppliers->rowAttributes() ?>>
<?php

// Render list options (body, left)
$suppliers_list->ListOptions->render("body", "left", $suppliers_list->RowCnt);
?>
	<?php if ($suppliers->SupplierID->Visible) { // SupplierID ?>
		<td data-name="SupplierID"<?php echo $suppliers->SupplierID->cellAttributes() ?>>
<span id="el<?php echo $suppliers_list->RowCnt ?>_suppliers_SupplierID" class="suppliers_SupplierID">
<span<?php echo $suppliers->SupplierID->viewAttributes() ?>>
<?php echo $suppliers->SupplierID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($suppliers->CompanyName->Visible) { // CompanyName ?>
		<td data-name="CompanyName"<?php echo $suppliers->CompanyName->cellAttributes() ?>>
<span id="el<?php echo $suppliers_list->RowCnt ?>_suppliers_CompanyName" class="suppliers_CompanyName">
<span<?php echo $suppliers->CompanyName->viewAttributes() ?>>
<?php echo $suppliers->CompanyName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($suppliers->ContactName->Visible) { // ContactName ?>
		<td data-name="ContactName"<?php echo $suppliers->ContactName->cellAttributes() ?>>
<span id="el<?php echo $suppliers_list->RowCnt ?>_suppliers_ContactName" class="suppliers_ContactName">
<span<?php echo $suppliers->ContactName->viewAttributes() ?>>
<?php echo $suppliers->ContactName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($suppliers->ContactTitle->Visible) { // ContactTitle ?>
		<td data-name="ContactTitle"<?php echo $suppliers->ContactTitle->cellAttributes() ?>>
<span id="el<?php echo $suppliers_list->RowCnt ?>_suppliers_ContactTitle" class="suppliers_ContactTitle">
<span<?php echo $suppliers->ContactTitle->viewAttributes() ?>>
<?php echo $suppliers->ContactTitle->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($suppliers->Address->Visible) { // Address ?>
		<td data-name="Address"<?php echo $suppliers->Address->cellAttributes() ?>>
<span id="el<?php echo $suppliers_list->RowCnt ?>_suppliers_Address" class="suppliers_Address">
<span<?php echo $suppliers->Address->viewAttributes() ?>>
<?php echo $suppliers->Address->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($suppliers->City->Visible) { // City ?>
		<td data-name="City"<?php echo $suppliers->City->cellAttributes() ?>>
<span id="el<?php echo $suppliers_list->RowCnt ?>_suppliers_City" class="suppliers_City">
<span<?php echo $suppliers->City->viewAttributes() ?>>
<?php echo $suppliers->City->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($suppliers->Region->Visible) { // Region ?>
		<td data-name="Region"<?php echo $suppliers->Region->cellAttributes() ?>>
<span id="el<?php echo $suppliers_list->RowCnt ?>_suppliers_Region" class="suppliers_Region">
<span<?php echo $suppliers->Region->viewAttributes() ?>>
<?php echo $suppliers->Region->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($suppliers->PostalCode->Visible) { // PostalCode ?>
		<td data-name="PostalCode"<?php echo $suppliers->PostalCode->cellAttributes() ?>>
<span id="el<?php echo $suppliers_list->RowCnt ?>_suppliers_PostalCode" class="suppliers_PostalCode">
<span<?php echo $suppliers->PostalCode->viewAttributes() ?>>
<?php echo $suppliers->PostalCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($suppliers->Country->Visible) { // Country ?>
		<td data-name="Country"<?php echo $suppliers->Country->cellAttributes() ?>>
<span id="el<?php echo $suppliers_list->RowCnt ?>_suppliers_Country" class="suppliers_Country">
<span<?php echo $suppliers->Country->viewAttributes() ?>>
<?php echo $suppliers->Country->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($suppliers->Phone->Visible) { // Phone ?>
		<td data-name="Phone"<?php echo $suppliers->Phone->cellAttributes() ?>>
<span id="el<?php echo $suppliers_list->RowCnt ?>_suppliers_Phone" class="suppliers_Phone">
<span<?php echo $suppliers->Phone->viewAttributes() ?>>
<?php echo $suppliers->Phone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($suppliers->Fax->Visible) { // Fax ?>
		<td data-name="Fax"<?php echo $suppliers->Fax->cellAttributes() ?>>
<span id="el<?php echo $suppliers_list->RowCnt ?>_suppliers_Fax" class="suppliers_Fax">
<span<?php echo $suppliers->Fax->viewAttributes() ?>>
<?php echo $suppliers->Fax->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$suppliers_list->ListOptions->render("body", "right", $suppliers_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$suppliers->isGridAdd())
		$suppliers_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$suppliers->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($suppliers_list->Recordset)
	$suppliers_list->Recordset->Close();
?>
<?php if (!$suppliers->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$suppliers->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($suppliers_list->Pager)) $suppliers_list->Pager = new PrevNextPager($suppliers_list->StartRec, $suppliers_list->DisplayRecs, $suppliers_list->TotalRecs, $suppliers_list->AutoHidePager) ?>
<?php if ($suppliers_list->Pager->RecordCount > 0 && $suppliers_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($suppliers_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $suppliers_list->pageUrl() ?>start=<?php echo $suppliers_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($suppliers_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $suppliers_list->pageUrl() ?>start=<?php echo $suppliers_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $suppliers_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($suppliers_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $suppliers_list->pageUrl() ?>start=<?php echo $suppliers_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($suppliers_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $suppliers_list->pageUrl() ?>start=<?php echo $suppliers_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $suppliers_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($suppliers_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $suppliers_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $suppliers_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $suppliers_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($suppliers_list->TotalRecs > 0 && (!$suppliers_list->AutoHidePageSizeSelector || $suppliers_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="suppliers">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($suppliers_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($suppliers_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($suppliers_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($suppliers->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($suppliers_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($suppliers_list->TotalRecs == 0 && !$suppliers->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($suppliers_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$suppliers_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$suppliers->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$suppliers_list->terminate();
?>
