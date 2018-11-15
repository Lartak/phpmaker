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
$dji_list = new dji_list();

// Run the page
$dji_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$dji_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$dji->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fdjilist = currentForm = new ew.Form("fdjilist", "list");
fdjilist.formKeyCountName = '<?php echo $dji_list->FormKeyCountName ?>';

// Form_CustomValidate event
fdjilist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdjilist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fdjilistsrch = currentSearchForm = new ew.Form("fdjilistsrch");

// Filters
fdjilistsrch.filterList = <?php echo $dji_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$dji->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($dji_list->TotalRecs > 0 && $dji_list->ExportOptions->visible()) { ?>
<?php $dji_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($dji_list->ImportOptions->visible()) { ?>
<?php $dji_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($dji_list->SearchOptions->visible()) { ?>
<?php $dji_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($dji_list->FilterOptions->visible()) { ?>
<?php $dji_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$dji_list->renderOtherOptions();
?>
<?php if (!$dji->isExport() && !$dji->CurrentAction) { ?>
<form name="fdjilistsrch" id="fdjilistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($dji_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fdjilistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="dji">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($dji_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($dji_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $dji_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($dji_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($dji_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($dji_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($dji_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $dji_list->showPageHeader(); ?>
<?php
$dji_list->showMessage();
?>
<?php if ($dji_list->TotalRecs > 0 || $dji->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($dji_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> dji">
<?php if (!$dji->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$dji->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($dji_list->Pager)) $dji_list->Pager = new PrevNextPager($dji_list->StartRec, $dji_list->DisplayRecs, $dji_list->TotalRecs, $dji_list->AutoHidePager) ?>
<?php if ($dji_list->Pager->RecordCount > 0 && $dji_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($dji_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $dji_list->pageUrl() ?>start=<?php echo $dji_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($dji_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $dji_list->pageUrl() ?>start=<?php echo $dji_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $dji_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($dji_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $dji_list->pageUrl() ?>start=<?php echo $dji_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($dji_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $dji_list->pageUrl() ?>start=<?php echo $dji_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $dji_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($dji_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $dji_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $dji_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $dji_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($dji_list->TotalRecs > 0 && (!$dji_list->AutoHidePageSizeSelector || $dji_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="dji">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($dji_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($dji_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($dji_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($dji->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($dji_list->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdjilist" id="fdjilist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($dji_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $dji_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="dji">
<div id="gmp_dji" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($dji_list->TotalRecs > 0 || $dji->isGridEdit()) { ?>
<table id="tbl_djilist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$dji_list->RowType = ROWTYPE_HEADER;

// Render list options
$dji_list->renderListOptions();

// Render list options (header, left)
$dji_list->ListOptions->render("header", "left");
?>
<?php if ($dji->ID->Visible) { // ID ?>
	<?php if ($dji->sortUrl($dji->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $dji->ID->headerCellClass() ?>"><div id="elh_dji_ID" class="dji_ID"><div class="ew-table-header-caption"><?php echo $dji->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $dji->ID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $dji->SortUrl($dji->ID) ?>',1);"><div id="elh_dji_ID" class="dji_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dji->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($dji->ID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($dji->ID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dji->Date->Visible) { // Date ?>
	<?php if ($dji->sortUrl($dji->Date) == "") { ?>
		<th data-name="Date" class="<?php echo $dji->Date->headerCellClass() ?>"><div id="elh_dji_Date" class="dji_Date"><div class="ew-table-header-caption"><?php echo $dji->Date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Date" class="<?php echo $dji->Date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $dji->SortUrl($dji->Date) ?>',1);"><div id="elh_dji_Date" class="dji_Date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dji->Date->caption() ?></span><span class="ew-table-header-sort"><?php if ($dji->Date->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($dji->Date->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dji->Open->Visible) { // Open ?>
	<?php if ($dji->sortUrl($dji->Open) == "") { ?>
		<th data-name="Open" class="<?php echo $dji->Open->headerCellClass() ?>"><div id="elh_dji_Open" class="dji_Open"><div class="ew-table-header-caption"><?php echo $dji->Open->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Open" class="<?php echo $dji->Open->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $dji->SortUrl($dji->Open) ?>',1);"><div id="elh_dji_Open" class="dji_Open">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dji->Open->caption() ?></span><span class="ew-table-header-sort"><?php if ($dji->Open->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($dji->Open->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dji->High->Visible) { // High ?>
	<?php if ($dji->sortUrl($dji->High) == "") { ?>
		<th data-name="High" class="<?php echo $dji->High->headerCellClass() ?>"><div id="elh_dji_High" class="dji_High"><div class="ew-table-header-caption"><?php echo $dji->High->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="High" class="<?php echo $dji->High->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $dji->SortUrl($dji->High) ?>',1);"><div id="elh_dji_High" class="dji_High">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dji->High->caption() ?></span><span class="ew-table-header-sort"><?php if ($dji->High->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($dji->High->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dji->Low->Visible) { // Low ?>
	<?php if ($dji->sortUrl($dji->Low) == "") { ?>
		<th data-name="Low" class="<?php echo $dji->Low->headerCellClass() ?>"><div id="elh_dji_Low" class="dji_Low"><div class="ew-table-header-caption"><?php echo $dji->Low->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Low" class="<?php echo $dji->Low->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $dji->SortUrl($dji->Low) ?>',1);"><div id="elh_dji_Low" class="dji_Low">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dji->Low->caption() ?></span><span class="ew-table-header-sort"><?php if ($dji->Low->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($dji->Low->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dji->Close->Visible) { // Close ?>
	<?php if ($dji->sortUrl($dji->Close) == "") { ?>
		<th data-name="Close" class="<?php echo $dji->Close->headerCellClass() ?>"><div id="elh_dji_Close" class="dji_Close"><div class="ew-table-header-caption"><?php echo $dji->Close->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Close" class="<?php echo $dji->Close->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $dji->SortUrl($dji->Close) ?>',1);"><div id="elh_dji_Close" class="dji_Close">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dji->Close->caption() ?></span><span class="ew-table-header-sort"><?php if ($dji->Close->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($dji->Close->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dji->Volume->Visible) { // Volume ?>
	<?php if ($dji->sortUrl($dji->Volume) == "") { ?>
		<th data-name="Volume" class="<?php echo $dji->Volume->headerCellClass() ?>"><div id="elh_dji_Volume" class="dji_Volume"><div class="ew-table-header-caption"><?php echo $dji->Volume->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Volume" class="<?php echo $dji->Volume->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $dji->SortUrl($dji->Volume) ?>',1);"><div id="elh_dji_Volume" class="dji_Volume">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dji->Volume->caption() ?></span><span class="ew-table-header-sort"><?php if ($dji->Volume->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($dji->Volume->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dji->Adj_Close->Visible) { // Adj Close ?>
	<?php if ($dji->sortUrl($dji->Adj_Close) == "") { ?>
		<th data-name="Adj_Close" class="<?php echo $dji->Adj_Close->headerCellClass() ?>"><div id="elh_dji_Adj_Close" class="dji_Adj_Close"><div class="ew-table-header-caption"><?php echo $dji->Adj_Close->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Adj_Close" class="<?php echo $dji->Adj_Close->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $dji->SortUrl($dji->Adj_Close) ?>',1);"><div id="elh_dji_Adj_Close" class="dji_Adj_Close">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dji->Adj_Close->caption() ?></span><span class="ew-table-header-sort"><?php if ($dji->Adj_Close->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($dji->Adj_Close->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dji->Name->Visible) { // Name ?>
	<?php if ($dji->sortUrl($dji->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $dji->Name->headerCellClass() ?>"><div id="elh_dji_Name" class="dji_Name"><div class="ew-table-header-caption"><?php echo $dji->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $dji->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $dji->SortUrl($dji->Name) ?>',1);"><div id="elh_dji_Name" class="dji_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dji->Name->caption() ?></span><span class="ew-table-header-sort"><?php if ($dji->Name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($dji->Name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dji->Name2->Visible) { // Name2 ?>
	<?php if ($dji->sortUrl($dji->Name2) == "") { ?>
		<th data-name="Name2" class="<?php echo $dji->Name2->headerCellClass() ?>"><div id="elh_dji_Name2" class="dji_Name2"><div class="ew-table-header-caption"><?php echo $dji->Name2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name2" class="<?php echo $dji->Name2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $dji->SortUrl($dji->Name2) ?>',1);"><div id="elh_dji_Name2" class="dji_Name2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dji->Name2->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dji->Name2->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($dji->Name2->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$dji_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($dji->ExportAll && $dji->isExport()) {
	$dji_list->StopRec = $dji_list->TotalRecs;
} else {

	// Set the last record to display
	if ($dji_list->TotalRecs > $dji_list->StartRec + $dji_list->DisplayRecs - 1)
		$dji_list->StopRec = $dji_list->StartRec + $dji_list->DisplayRecs - 1;
	else
		$dji_list->StopRec = $dji_list->TotalRecs;
}
$dji_list->RecCnt = $dji_list->StartRec - 1;
if ($dji_list->Recordset && !$dji_list->Recordset->EOF) {
	$dji_list->Recordset->moveFirst();
	$selectLimit = $dji_list->UseSelectLimit;
	if (!$selectLimit && $dji_list->StartRec > 1)
		$dji_list->Recordset->move($dji_list->StartRec - 1);
} elseif (!$dji->AllowAddDeleteRow && $dji_list->StopRec == 0) {
	$dji_list->StopRec = $dji->GridAddRowCount;
}

// Initialize aggregate
$dji->RowType = ROWTYPE_AGGREGATEINIT;
$dji->resetAttributes();
$dji_list->renderRow();
while ($dji_list->RecCnt < $dji_list->StopRec) {
	$dji_list->RecCnt++;
	if ($dji_list->RecCnt >= $dji_list->StartRec) {
		$dji_list->RowCnt++;

		// Set up key count
		$dji_list->KeyCount = $dji_list->RowIndex;

		// Init row class and style
		$dji->resetAttributes();
		$dji->CssClass = "";
		if ($dji->isGridAdd()) {
		} else {
			$dji_list->loadRowValues($dji_list->Recordset); // Load row values
		}
		$dji->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$dji->RowAttrs = array_merge($dji->RowAttrs, array('data-rowindex'=>$dji_list->RowCnt, 'id'=>'r' . $dji_list->RowCnt . '_dji', 'data-rowtype'=>$dji->RowType));

		// Render row
		$dji_list->renderRow();

		// Render list options
		$dji_list->renderListOptions();
?>
	<tr<?php echo $dji->rowAttributes() ?>>
<?php

// Render list options (body, left)
$dji_list->ListOptions->render("body", "left", $dji_list->RowCnt);
?>
	<?php if ($dji->ID->Visible) { // ID ?>
		<td data-name="ID"<?php echo $dji->ID->cellAttributes() ?>>
<span id="el<?php echo $dji_list->RowCnt ?>_dji_ID" class="dji_ID">
<span<?php echo $dji->ID->viewAttributes() ?>>
<?php echo $dji->ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dji->Date->Visible) { // Date ?>
		<td data-name="Date"<?php echo $dji->Date->cellAttributes() ?>>
<span id="el<?php echo $dji_list->RowCnt ?>_dji_Date" class="dji_Date">
<span<?php echo $dji->Date->viewAttributes() ?>>
<?php echo $dji->Date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dji->Open->Visible) { // Open ?>
		<td data-name="Open"<?php echo $dji->Open->cellAttributes() ?>>
<span id="el<?php echo $dji_list->RowCnt ?>_dji_Open" class="dji_Open">
<span<?php echo $dji->Open->viewAttributes() ?>>
<?php echo $dji->Open->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dji->High->Visible) { // High ?>
		<td data-name="High"<?php echo $dji->High->cellAttributes() ?>>
<span id="el<?php echo $dji_list->RowCnt ?>_dji_High" class="dji_High">
<span<?php echo $dji->High->viewAttributes() ?>>
<?php echo $dji->High->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dji->Low->Visible) { // Low ?>
		<td data-name="Low"<?php echo $dji->Low->cellAttributes() ?>>
<span id="el<?php echo $dji_list->RowCnt ?>_dji_Low" class="dji_Low">
<span<?php echo $dji->Low->viewAttributes() ?>>
<?php echo $dji->Low->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dji->Close->Visible) { // Close ?>
		<td data-name="Close"<?php echo $dji->Close->cellAttributes() ?>>
<span id="el<?php echo $dji_list->RowCnt ?>_dji_Close" class="dji_Close">
<span<?php echo $dji->Close->viewAttributes() ?>>
<?php echo $dji->Close->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dji->Volume->Visible) { // Volume ?>
		<td data-name="Volume"<?php echo $dji->Volume->cellAttributes() ?>>
<span id="el<?php echo $dji_list->RowCnt ?>_dji_Volume" class="dji_Volume">
<span<?php echo $dji->Volume->viewAttributes() ?>>
<?php echo $dji->Volume->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dji->Adj_Close->Visible) { // Adj Close ?>
		<td data-name="Adj_Close"<?php echo $dji->Adj_Close->cellAttributes() ?>>
<span id="el<?php echo $dji_list->RowCnt ?>_dji_Adj_Close" class="dji_Adj_Close">
<span<?php echo $dji->Adj_Close->viewAttributes() ?>>
<?php echo $dji->Adj_Close->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dji->Name->Visible) { // Name ?>
		<td data-name="Name"<?php echo $dji->Name->cellAttributes() ?>>
<span id="el<?php echo $dji_list->RowCnt ?>_dji_Name" class="dji_Name">
<span<?php echo $dji->Name->viewAttributes() ?>>
<?php echo $dji->Name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dji->Name2->Visible) { // Name2 ?>
		<td data-name="Name2"<?php echo $dji->Name2->cellAttributes() ?>>
<span id="el<?php echo $dji_list->RowCnt ?>_dji_Name2" class="dji_Name2">
<span<?php echo $dji->Name2->viewAttributes() ?>>
<?php echo $dji->Name2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$dji_list->ListOptions->render("body", "right", $dji_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$dji->isGridAdd())
		$dji_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$dji->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($dji_list->Recordset)
	$dji_list->Recordset->Close();
?>
<?php if (!$dji->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$dji->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($dji_list->Pager)) $dji_list->Pager = new PrevNextPager($dji_list->StartRec, $dji_list->DisplayRecs, $dji_list->TotalRecs, $dji_list->AutoHidePager) ?>
<?php if ($dji_list->Pager->RecordCount > 0 && $dji_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($dji_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $dji_list->pageUrl() ?>start=<?php echo $dji_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($dji_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $dji_list->pageUrl() ?>start=<?php echo $dji_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $dji_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($dji_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $dji_list->pageUrl() ?>start=<?php echo $dji_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($dji_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $dji_list->pageUrl() ?>start=<?php echo $dji_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $dji_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($dji_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $dji_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $dji_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $dji_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($dji_list->TotalRecs > 0 && (!$dji_list->AutoHidePageSizeSelector || $dji_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="dji">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($dji_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($dji_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($dji_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($dji->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($dji_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($dji_list->TotalRecs == 0 && !$dji->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($dji_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$dji_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$dji->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$dji_list->terminate();
?>
