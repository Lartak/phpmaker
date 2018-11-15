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
$shippers_list = new shippers_list();

// Run the page
$shippers_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$shippers_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$shippers->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fshipperslist = currentForm = new ew.Form("fshipperslist", "list");
fshipperslist.formKeyCountName = '<?php echo $shippers_list->FormKeyCountName ?>';

// Form_CustomValidate event
fshipperslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fshipperslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fshipperslistsrch = currentSearchForm = new ew.Form("fshipperslistsrch");

// Filters
fshipperslistsrch.filterList = <?php echo $shippers_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$shippers->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($shippers_list->TotalRecs > 0 && $shippers_list->ExportOptions->visible()) { ?>
<?php $shippers_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($shippers_list->ImportOptions->visible()) { ?>
<?php $shippers_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($shippers_list->SearchOptions->visible()) { ?>
<?php $shippers_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($shippers_list->FilterOptions->visible()) { ?>
<?php $shippers_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$shippers_list->renderOtherOptions();
?>
<?php if (!$shippers->isExport() && !$shippers->CurrentAction) { ?>
<form name="fshipperslistsrch" id="fshipperslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($shippers_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fshipperslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="shippers">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($shippers_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($shippers_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $shippers_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($shippers_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($shippers_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($shippers_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($shippers_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $shippers_list->showPageHeader(); ?>
<?php
$shippers_list->showMessage();
?>
<?php if ($shippers_list->TotalRecs > 0 || $shippers->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($shippers_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> shippers">
<?php if (!$shippers->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$shippers->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($shippers_list->Pager)) $shippers_list->Pager = new PrevNextPager($shippers_list->StartRec, $shippers_list->DisplayRecs, $shippers_list->TotalRecs, $shippers_list->AutoHidePager) ?>
<?php if ($shippers_list->Pager->RecordCount > 0 && $shippers_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($shippers_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $shippers_list->pageUrl() ?>start=<?php echo $shippers_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($shippers_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $shippers_list->pageUrl() ?>start=<?php echo $shippers_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $shippers_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($shippers_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $shippers_list->pageUrl() ?>start=<?php echo $shippers_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($shippers_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $shippers_list->pageUrl() ?>start=<?php echo $shippers_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $shippers_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($shippers_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $shippers_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $shippers_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $shippers_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($shippers_list->TotalRecs > 0 && (!$shippers_list->AutoHidePageSizeSelector || $shippers_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="shippers">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($shippers_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($shippers_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($shippers_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($shippers->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($shippers_list->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fshipperslist" id="fshipperslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($shippers_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $shippers_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="shippers">
<div id="gmp_shippers" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($shippers_list->TotalRecs > 0 || $shippers->isGridEdit()) { ?>
<table id="tbl_shipperslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$shippers_list->RowType = ROWTYPE_HEADER;

// Render list options
$shippers_list->renderListOptions();

// Render list options (header, left)
$shippers_list->ListOptions->render("header", "left");
?>
<?php if ($shippers->ShipperID->Visible) { // ShipperID ?>
	<?php if ($shippers->sortUrl($shippers->ShipperID) == "") { ?>
		<th data-name="ShipperID" class="<?php echo $shippers->ShipperID->headerCellClass() ?>"><div id="elh_shippers_ShipperID" class="shippers_ShipperID"><div class="ew-table-header-caption"><?php echo $shippers->ShipperID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShipperID" class="<?php echo $shippers->ShipperID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $shippers->SortUrl($shippers->ShipperID) ?>',1);"><div id="elh_shippers_ShipperID" class="shippers_ShipperID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $shippers->ShipperID->caption() ?></span><span class="ew-table-header-sort"><?php if ($shippers->ShipperID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($shippers->ShipperID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($shippers->CompanyName->Visible) { // CompanyName ?>
	<?php if ($shippers->sortUrl($shippers->CompanyName) == "") { ?>
		<th data-name="CompanyName" class="<?php echo $shippers->CompanyName->headerCellClass() ?>"><div id="elh_shippers_CompanyName" class="shippers_CompanyName"><div class="ew-table-header-caption"><?php echo $shippers->CompanyName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CompanyName" class="<?php echo $shippers->CompanyName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $shippers->SortUrl($shippers->CompanyName) ?>',1);"><div id="elh_shippers_CompanyName" class="shippers_CompanyName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $shippers->CompanyName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($shippers->CompanyName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($shippers->CompanyName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($shippers->Phone->Visible) { // Phone ?>
	<?php if ($shippers->sortUrl($shippers->Phone) == "") { ?>
		<th data-name="Phone" class="<?php echo $shippers->Phone->headerCellClass() ?>"><div id="elh_shippers_Phone" class="shippers_Phone"><div class="ew-table-header-caption"><?php echo $shippers->Phone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Phone" class="<?php echo $shippers->Phone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $shippers->SortUrl($shippers->Phone) ?>',1);"><div id="elh_shippers_Phone" class="shippers_Phone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $shippers->Phone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($shippers->Phone->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($shippers->Phone->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$shippers_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($shippers->ExportAll && $shippers->isExport()) {
	$shippers_list->StopRec = $shippers_list->TotalRecs;
} else {

	// Set the last record to display
	if ($shippers_list->TotalRecs > $shippers_list->StartRec + $shippers_list->DisplayRecs - 1)
		$shippers_list->StopRec = $shippers_list->StartRec + $shippers_list->DisplayRecs - 1;
	else
		$shippers_list->StopRec = $shippers_list->TotalRecs;
}
$shippers_list->RecCnt = $shippers_list->StartRec - 1;
if ($shippers_list->Recordset && !$shippers_list->Recordset->EOF) {
	$shippers_list->Recordset->moveFirst();
	$selectLimit = $shippers_list->UseSelectLimit;
	if (!$selectLimit && $shippers_list->StartRec > 1)
		$shippers_list->Recordset->move($shippers_list->StartRec - 1);
} elseif (!$shippers->AllowAddDeleteRow && $shippers_list->StopRec == 0) {
	$shippers_list->StopRec = $shippers->GridAddRowCount;
}

// Initialize aggregate
$shippers->RowType = ROWTYPE_AGGREGATEINIT;
$shippers->resetAttributes();
$shippers_list->renderRow();
while ($shippers_list->RecCnt < $shippers_list->StopRec) {
	$shippers_list->RecCnt++;
	if ($shippers_list->RecCnt >= $shippers_list->StartRec) {
		$shippers_list->RowCnt++;

		// Set up key count
		$shippers_list->KeyCount = $shippers_list->RowIndex;

		// Init row class and style
		$shippers->resetAttributes();
		$shippers->CssClass = "";
		if ($shippers->isGridAdd()) {
		} else {
			$shippers_list->loadRowValues($shippers_list->Recordset); // Load row values
		}
		$shippers->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$shippers->RowAttrs = array_merge($shippers->RowAttrs, array('data-rowindex'=>$shippers_list->RowCnt, 'id'=>'r' . $shippers_list->RowCnt . '_shippers', 'data-rowtype'=>$shippers->RowType));

		// Render row
		$shippers_list->renderRow();

		// Render list options
		$shippers_list->renderListOptions();
?>
	<tr<?php echo $shippers->rowAttributes() ?>>
<?php

// Render list options (body, left)
$shippers_list->ListOptions->render("body", "left", $shippers_list->RowCnt);
?>
	<?php if ($shippers->ShipperID->Visible) { // ShipperID ?>
		<td data-name="ShipperID"<?php echo $shippers->ShipperID->cellAttributes() ?>>
<span id="el<?php echo $shippers_list->RowCnt ?>_shippers_ShipperID" class="shippers_ShipperID">
<span<?php echo $shippers->ShipperID->viewAttributes() ?>>
<?php echo $shippers->ShipperID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($shippers->CompanyName->Visible) { // CompanyName ?>
		<td data-name="CompanyName"<?php echo $shippers->CompanyName->cellAttributes() ?>>
<span id="el<?php echo $shippers_list->RowCnt ?>_shippers_CompanyName" class="shippers_CompanyName">
<span<?php echo $shippers->CompanyName->viewAttributes() ?>>
<?php echo $shippers->CompanyName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($shippers->Phone->Visible) { // Phone ?>
		<td data-name="Phone"<?php echo $shippers->Phone->cellAttributes() ?>>
<span id="el<?php echo $shippers_list->RowCnt ?>_shippers_Phone" class="shippers_Phone">
<span<?php echo $shippers->Phone->viewAttributes() ?>>
<?php echo $shippers->Phone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$shippers_list->ListOptions->render("body", "right", $shippers_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$shippers->isGridAdd())
		$shippers_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$shippers->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($shippers_list->Recordset)
	$shippers_list->Recordset->Close();
?>
<?php if (!$shippers->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$shippers->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($shippers_list->Pager)) $shippers_list->Pager = new PrevNextPager($shippers_list->StartRec, $shippers_list->DisplayRecs, $shippers_list->TotalRecs, $shippers_list->AutoHidePager) ?>
<?php if ($shippers_list->Pager->RecordCount > 0 && $shippers_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($shippers_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $shippers_list->pageUrl() ?>start=<?php echo $shippers_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($shippers_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $shippers_list->pageUrl() ?>start=<?php echo $shippers_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $shippers_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($shippers_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $shippers_list->pageUrl() ?>start=<?php echo $shippers_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($shippers_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $shippers_list->pageUrl() ?>start=<?php echo $shippers_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $shippers_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($shippers_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $shippers_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $shippers_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $shippers_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($shippers_list->TotalRecs > 0 && (!$shippers_list->AutoHidePageSizeSelector || $shippers_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="shippers">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($shippers_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($shippers_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($shippers_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($shippers->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($shippers_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($shippers_list->TotalRecs == 0 && !$shippers->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($shippers_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$shippers_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$shippers->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$shippers_list->terminate();
?>
