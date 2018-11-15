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
$customers_list = new customers_list();

// Run the page
$customers_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$customers_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$customers->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fcustomerslist = currentForm = new ew.Form("fcustomerslist", "list");
fcustomerslist.formKeyCountName = '<?php echo $customers_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcustomerslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcustomerslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fcustomerslistsrch = currentSearchForm = new ew.Form("fcustomerslistsrch");

// Filters
fcustomerslistsrch.filterList = <?php echo $customers_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$customers->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($customers_list->TotalRecs > 0 && $customers_list->ExportOptions->visible()) { ?>
<?php $customers_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($customers_list->ImportOptions->visible()) { ?>
<?php $customers_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($customers_list->SearchOptions->visible()) { ?>
<?php $customers_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($customers_list->FilterOptions->visible()) { ?>
<?php $customers_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$customers_list->renderOtherOptions();
?>
<?php if (!$customers->isExport() && !$customers->CurrentAction) { ?>
<form name="fcustomerslistsrch" id="fcustomerslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($customers_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fcustomerslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="customers">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($customers_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($customers_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $customers_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($customers_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($customers_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($customers_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($customers_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $customers_list->showPageHeader(); ?>
<?php
$customers_list->showMessage();
?>
<?php if ($customers_list->TotalRecs > 0 || $customers->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($customers_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> customers">
<?php if (!$customers->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$customers->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($customers_list->Pager)) $customers_list->Pager = new PrevNextPager($customers_list->StartRec, $customers_list->DisplayRecs, $customers_list->TotalRecs, $customers_list->AutoHidePager) ?>
<?php if ($customers_list->Pager->RecordCount > 0 && $customers_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($customers_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $customers_list->pageUrl() ?>start=<?php echo $customers_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($customers_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $customers_list->pageUrl() ?>start=<?php echo $customers_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $customers_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($customers_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $customers_list->pageUrl() ?>start=<?php echo $customers_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($customers_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $customers_list->pageUrl() ?>start=<?php echo $customers_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $customers_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($customers_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $customers_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $customers_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $customers_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($customers_list->TotalRecs > 0 && (!$customers_list->AutoHidePageSizeSelector || $customers_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="customers">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($customers_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($customers_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($customers_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($customers->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($customers_list->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcustomerslist" id="fcustomerslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($customers_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $customers_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="customers">
<div id="gmp_customers" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($customers_list->TotalRecs > 0 || $customers->isGridEdit()) { ?>
<table id="tbl_customerslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$customers_list->RowType = ROWTYPE_HEADER;

// Render list options
$customers_list->renderListOptions();

// Render list options (header, left)
$customers_list->ListOptions->render("header", "left");
?>
<?php if ($customers->CustomerID->Visible) { // CustomerID ?>
	<?php if ($customers->sortUrl($customers->CustomerID) == "") { ?>
		<th data-name="CustomerID" class="<?php echo $customers->CustomerID->headerCellClass() ?>"><div id="elh_customers_CustomerID" class="customers_CustomerID"><div class="ew-table-header-caption"><?php echo $customers->CustomerID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CustomerID" class="<?php echo $customers->CustomerID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $customers->SortUrl($customers->CustomerID) ?>',1);"><div id="elh_customers_CustomerID" class="customers_CustomerID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers->CustomerID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers->CustomerID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($customers->CustomerID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers->CompanyName->Visible) { // CompanyName ?>
	<?php if ($customers->sortUrl($customers->CompanyName) == "") { ?>
		<th data-name="CompanyName" class="<?php echo $customers->CompanyName->headerCellClass() ?>"><div id="elh_customers_CompanyName" class="customers_CompanyName"><div class="ew-table-header-caption"><?php echo $customers->CompanyName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CompanyName" class="<?php echo $customers->CompanyName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $customers->SortUrl($customers->CompanyName) ?>',1);"><div id="elh_customers_CompanyName" class="customers_CompanyName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers->CompanyName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers->CompanyName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($customers->CompanyName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers->ContactName->Visible) { // ContactName ?>
	<?php if ($customers->sortUrl($customers->ContactName) == "") { ?>
		<th data-name="ContactName" class="<?php echo $customers->ContactName->headerCellClass() ?>"><div id="elh_customers_ContactName" class="customers_ContactName"><div class="ew-table-header-caption"><?php echo $customers->ContactName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContactName" class="<?php echo $customers->ContactName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $customers->SortUrl($customers->ContactName) ?>',1);"><div id="elh_customers_ContactName" class="customers_ContactName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers->ContactName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers->ContactName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($customers->ContactName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers->ContactTitle->Visible) { // ContactTitle ?>
	<?php if ($customers->sortUrl($customers->ContactTitle) == "") { ?>
		<th data-name="ContactTitle" class="<?php echo $customers->ContactTitle->headerCellClass() ?>"><div id="elh_customers_ContactTitle" class="customers_ContactTitle"><div class="ew-table-header-caption"><?php echo $customers->ContactTitle->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContactTitle" class="<?php echo $customers->ContactTitle->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $customers->SortUrl($customers->ContactTitle) ?>',1);"><div id="elh_customers_ContactTitle" class="customers_ContactTitle">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers->ContactTitle->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers->ContactTitle->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($customers->ContactTitle->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers->Address->Visible) { // Address ?>
	<?php if ($customers->sortUrl($customers->Address) == "") { ?>
		<th data-name="Address" class="<?php echo $customers->Address->headerCellClass() ?>"><div id="elh_customers_Address" class="customers_Address"><div class="ew-table-header-caption"><?php echo $customers->Address->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Address" class="<?php echo $customers->Address->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $customers->SortUrl($customers->Address) ?>',1);"><div id="elh_customers_Address" class="customers_Address">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers->Address->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers->Address->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($customers->Address->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers->City->Visible) { // City ?>
	<?php if ($customers->sortUrl($customers->City) == "") { ?>
		<th data-name="City" class="<?php echo $customers->City->headerCellClass() ?>"><div id="elh_customers_City" class="customers_City"><div class="ew-table-header-caption"><?php echo $customers->City->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="City" class="<?php echo $customers->City->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $customers->SortUrl($customers->City) ?>',1);"><div id="elh_customers_City" class="customers_City">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers->City->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers->City->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($customers->City->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers->Region->Visible) { // Region ?>
	<?php if ($customers->sortUrl($customers->Region) == "") { ?>
		<th data-name="Region" class="<?php echo $customers->Region->headerCellClass() ?>"><div id="elh_customers_Region" class="customers_Region"><div class="ew-table-header-caption"><?php echo $customers->Region->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Region" class="<?php echo $customers->Region->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $customers->SortUrl($customers->Region) ?>',1);"><div id="elh_customers_Region" class="customers_Region">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers->Region->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers->Region->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($customers->Region->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers->PostalCode->Visible) { // PostalCode ?>
	<?php if ($customers->sortUrl($customers->PostalCode) == "") { ?>
		<th data-name="PostalCode" class="<?php echo $customers->PostalCode->headerCellClass() ?>"><div id="elh_customers_PostalCode" class="customers_PostalCode"><div class="ew-table-header-caption"><?php echo $customers->PostalCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PostalCode" class="<?php echo $customers->PostalCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $customers->SortUrl($customers->PostalCode) ?>',1);"><div id="elh_customers_PostalCode" class="customers_PostalCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers->PostalCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers->PostalCode->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($customers->PostalCode->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers->Country->Visible) { // Country ?>
	<?php if ($customers->sortUrl($customers->Country) == "") { ?>
		<th data-name="Country" class="<?php echo $customers->Country->headerCellClass() ?>"><div id="elh_customers_Country" class="customers_Country"><div class="ew-table-header-caption"><?php echo $customers->Country->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Country" class="<?php echo $customers->Country->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $customers->SortUrl($customers->Country) ?>',1);"><div id="elh_customers_Country" class="customers_Country">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers->Country->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers->Country->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($customers->Country->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers->Phone->Visible) { // Phone ?>
	<?php if ($customers->sortUrl($customers->Phone) == "") { ?>
		<th data-name="Phone" class="<?php echo $customers->Phone->headerCellClass() ?>"><div id="elh_customers_Phone" class="customers_Phone"><div class="ew-table-header-caption"><?php echo $customers->Phone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Phone" class="<?php echo $customers->Phone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $customers->SortUrl($customers->Phone) ?>',1);"><div id="elh_customers_Phone" class="customers_Phone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers->Phone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers->Phone->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($customers->Phone->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers->Fax->Visible) { // Fax ?>
	<?php if ($customers->sortUrl($customers->Fax) == "") { ?>
		<th data-name="Fax" class="<?php echo $customers->Fax->headerCellClass() ?>"><div id="elh_customers_Fax" class="customers_Fax"><div class="ew-table-header-caption"><?php echo $customers->Fax->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Fax" class="<?php echo $customers->Fax->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $customers->SortUrl($customers->Fax) ?>',1);"><div id="elh_customers_Fax" class="customers_Fax">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers->Fax->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers->Fax->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($customers->Fax->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$customers_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($customers->ExportAll && $customers->isExport()) {
	$customers_list->StopRec = $customers_list->TotalRecs;
} else {

	// Set the last record to display
	if ($customers_list->TotalRecs > $customers_list->StartRec + $customers_list->DisplayRecs - 1)
		$customers_list->StopRec = $customers_list->StartRec + $customers_list->DisplayRecs - 1;
	else
		$customers_list->StopRec = $customers_list->TotalRecs;
}
$customers_list->RecCnt = $customers_list->StartRec - 1;
if ($customers_list->Recordset && !$customers_list->Recordset->EOF) {
	$customers_list->Recordset->moveFirst();
	$selectLimit = $customers_list->UseSelectLimit;
	if (!$selectLimit && $customers_list->StartRec > 1)
		$customers_list->Recordset->move($customers_list->StartRec - 1);
} elseif (!$customers->AllowAddDeleteRow && $customers_list->StopRec == 0) {
	$customers_list->StopRec = $customers->GridAddRowCount;
}

// Initialize aggregate
$customers->RowType = ROWTYPE_AGGREGATEINIT;
$customers->resetAttributes();
$customers_list->renderRow();
while ($customers_list->RecCnt < $customers_list->StopRec) {
	$customers_list->RecCnt++;
	if ($customers_list->RecCnt >= $customers_list->StartRec) {
		$customers_list->RowCnt++;

		// Set up key count
		$customers_list->KeyCount = $customers_list->RowIndex;

		// Init row class and style
		$customers->resetAttributes();
		$customers->CssClass = "";
		if ($customers->isGridAdd()) {
		} else {
			$customers_list->loadRowValues($customers_list->Recordset); // Load row values
		}
		$customers->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$customers->RowAttrs = array_merge($customers->RowAttrs, array('data-rowindex'=>$customers_list->RowCnt, 'id'=>'r' . $customers_list->RowCnt . '_customers', 'data-rowtype'=>$customers->RowType));

		// Render row
		$customers_list->renderRow();

		// Render list options
		$customers_list->renderListOptions();
?>
	<tr<?php echo $customers->rowAttributes() ?>>
<?php

// Render list options (body, left)
$customers_list->ListOptions->render("body", "left", $customers_list->RowCnt);
?>
	<?php if ($customers->CustomerID->Visible) { // CustomerID ?>
		<td data-name="CustomerID"<?php echo $customers->CustomerID->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCnt ?>_customers_CustomerID" class="customers_CustomerID">
<span<?php echo $customers->CustomerID->viewAttributes() ?>>
<?php echo $customers->CustomerID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers->CompanyName->Visible) { // CompanyName ?>
		<td data-name="CompanyName"<?php echo $customers->CompanyName->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCnt ?>_customers_CompanyName" class="customers_CompanyName">
<span<?php echo $customers->CompanyName->viewAttributes() ?>>
<?php echo $customers->CompanyName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers->ContactName->Visible) { // ContactName ?>
		<td data-name="ContactName"<?php echo $customers->ContactName->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCnt ?>_customers_ContactName" class="customers_ContactName">
<span<?php echo $customers->ContactName->viewAttributes() ?>>
<?php echo $customers->ContactName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers->ContactTitle->Visible) { // ContactTitle ?>
		<td data-name="ContactTitle"<?php echo $customers->ContactTitle->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCnt ?>_customers_ContactTitle" class="customers_ContactTitle">
<span<?php echo $customers->ContactTitle->viewAttributes() ?>>
<?php echo $customers->ContactTitle->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers->Address->Visible) { // Address ?>
		<td data-name="Address"<?php echo $customers->Address->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCnt ?>_customers_Address" class="customers_Address">
<span<?php echo $customers->Address->viewAttributes() ?>>
<?php echo $customers->Address->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers->City->Visible) { // City ?>
		<td data-name="City"<?php echo $customers->City->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCnt ?>_customers_City" class="customers_City">
<span<?php echo $customers->City->viewAttributes() ?>>
<?php echo $customers->City->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers->Region->Visible) { // Region ?>
		<td data-name="Region"<?php echo $customers->Region->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCnt ?>_customers_Region" class="customers_Region">
<span<?php echo $customers->Region->viewAttributes() ?>>
<?php echo $customers->Region->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers->PostalCode->Visible) { // PostalCode ?>
		<td data-name="PostalCode"<?php echo $customers->PostalCode->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCnt ?>_customers_PostalCode" class="customers_PostalCode">
<span<?php echo $customers->PostalCode->viewAttributes() ?>>
<?php echo $customers->PostalCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers->Country->Visible) { // Country ?>
		<td data-name="Country"<?php echo $customers->Country->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCnt ?>_customers_Country" class="customers_Country">
<span<?php echo $customers->Country->viewAttributes() ?>>
<?php echo $customers->Country->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers->Phone->Visible) { // Phone ?>
		<td data-name="Phone"<?php echo $customers->Phone->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCnt ?>_customers_Phone" class="customers_Phone">
<span<?php echo $customers->Phone->viewAttributes() ?>>
<?php echo $customers->Phone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers->Fax->Visible) { // Fax ?>
		<td data-name="Fax"<?php echo $customers->Fax->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCnt ?>_customers_Fax" class="customers_Fax">
<span<?php echo $customers->Fax->viewAttributes() ?>>
<?php echo $customers->Fax->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$customers_list->ListOptions->render("body", "right", $customers_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$customers->isGridAdd())
		$customers_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$customers->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($customers_list->Recordset)
	$customers_list->Recordset->Close();
?>
<?php if (!$customers->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$customers->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($customers_list->Pager)) $customers_list->Pager = new PrevNextPager($customers_list->StartRec, $customers_list->DisplayRecs, $customers_list->TotalRecs, $customers_list->AutoHidePager) ?>
<?php if ($customers_list->Pager->RecordCount > 0 && $customers_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($customers_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $customers_list->pageUrl() ?>start=<?php echo $customers_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($customers_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $customers_list->pageUrl() ?>start=<?php echo $customers_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $customers_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($customers_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $customers_list->pageUrl() ?>start=<?php echo $customers_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($customers_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $customers_list->pageUrl() ?>start=<?php echo $customers_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $customers_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($customers_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $customers_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $customers_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $customers_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($customers_list->TotalRecs > 0 && (!$customers_list->AutoHidePageSizeSelector || $customers_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="customers">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($customers_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($customers_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($customers_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($customers->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($customers_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($customers_list->TotalRecs == 0 && !$customers->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($customers_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$customers_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$customers->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$customers_list->terminate();
?>
