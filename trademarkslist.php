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
$trademarks_list = new trademarks_list();

// Run the page
$trademarks_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$trademarks_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$trademarks->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftrademarkslist = currentForm = new ew.Form("ftrademarkslist", "list");
ftrademarkslist.formKeyCountName = '<?php echo $trademarks_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftrademarkslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftrademarkslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var ftrademarkslistsrch = currentSearchForm = new ew.Form("ftrademarkslistsrch");

// Filters
ftrademarkslistsrch.filterList = <?php echo $trademarks_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$trademarks->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($trademarks_list->TotalRecs > 0 && $trademarks_list->ExportOptions->visible()) { ?>
<?php $trademarks_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($trademarks_list->ImportOptions->visible()) { ?>
<?php $trademarks_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($trademarks_list->SearchOptions->visible()) { ?>
<?php $trademarks_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($trademarks_list->FilterOptions->visible()) { ?>
<?php $trademarks_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$trademarks_list->renderOtherOptions();
?>
<?php if (!$trademarks->isExport() && !$trademarks->CurrentAction) { ?>
<form name="ftrademarkslistsrch" id="ftrademarkslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($trademarks_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftrademarkslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="trademarks">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($trademarks_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($trademarks_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $trademarks_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($trademarks_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($trademarks_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($trademarks_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($trademarks_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $trademarks_list->showPageHeader(); ?>
<?php
$trademarks_list->showMessage();
?>
<?php if ($trademarks_list->TotalRecs > 0 || $trademarks->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($trademarks_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> trademarks">
<?php if (!$trademarks->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$trademarks->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($trademarks_list->Pager)) $trademarks_list->Pager = new PrevNextPager($trademarks_list->StartRec, $trademarks_list->DisplayRecs, $trademarks_list->TotalRecs, $trademarks_list->AutoHidePager) ?>
<?php if ($trademarks_list->Pager->RecordCount > 0 && $trademarks_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($trademarks_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $trademarks_list->pageUrl() ?>start=<?php echo $trademarks_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($trademarks_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $trademarks_list->pageUrl() ?>start=<?php echo $trademarks_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $trademarks_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($trademarks_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $trademarks_list->pageUrl() ?>start=<?php echo $trademarks_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($trademarks_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $trademarks_list->pageUrl() ?>start=<?php echo $trademarks_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $trademarks_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($trademarks_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $trademarks_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $trademarks_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $trademarks_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($trademarks_list->TotalRecs > 0 && (!$trademarks_list->AutoHidePageSizeSelector || $trademarks_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="trademarks">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($trademarks_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($trademarks_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($trademarks_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($trademarks->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($trademarks_list->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftrademarkslist" id="ftrademarkslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($trademarks_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $trademarks_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="trademarks">
<div id="gmp_trademarks" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($trademarks_list->TotalRecs > 0 || $trademarks->isGridEdit()) { ?>
<table id="tbl_trademarkslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$trademarks_list->RowType = ROWTYPE_HEADER;

// Render list options
$trademarks_list->renderListOptions();

// Render list options (header, left)
$trademarks_list->ListOptions->render("header", "left");
?>
<?php if ($trademarks->ID->Visible) { // ID ?>
	<?php if ($trademarks->sortUrl($trademarks->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $trademarks->ID->headerCellClass() ?>"><div id="elh_trademarks_ID" class="trademarks_ID"><div class="ew-table-header-caption"><?php echo $trademarks->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $trademarks->ID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $trademarks->SortUrl($trademarks->ID) ?>',1);"><div id="elh_trademarks_ID" class="trademarks_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $trademarks->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($trademarks->ID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($trademarks->ID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($trademarks->Trademark->Visible) { // Trademark ?>
	<?php if ($trademarks->sortUrl($trademarks->Trademark) == "") { ?>
		<th data-name="Trademark" class="<?php echo $trademarks->Trademark->headerCellClass() ?>"><div id="elh_trademarks_Trademark" class="trademarks_Trademark"><div class="ew-table-header-caption"><?php echo $trademarks->Trademark->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Trademark" class="<?php echo $trademarks->Trademark->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $trademarks->SortUrl($trademarks->Trademark) ?>',1);"><div id="elh_trademarks_Trademark" class="trademarks_Trademark">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $trademarks->Trademark->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($trademarks->Trademark->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($trademarks->Trademark->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$trademarks_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($trademarks->ExportAll && $trademarks->isExport()) {
	$trademarks_list->StopRec = $trademarks_list->TotalRecs;
} else {

	// Set the last record to display
	if ($trademarks_list->TotalRecs > $trademarks_list->StartRec + $trademarks_list->DisplayRecs - 1)
		$trademarks_list->StopRec = $trademarks_list->StartRec + $trademarks_list->DisplayRecs - 1;
	else
		$trademarks_list->StopRec = $trademarks_list->TotalRecs;
}
$trademarks_list->RecCnt = $trademarks_list->StartRec - 1;
if ($trademarks_list->Recordset && !$trademarks_list->Recordset->EOF) {
	$trademarks_list->Recordset->moveFirst();
	$selectLimit = $trademarks_list->UseSelectLimit;
	if (!$selectLimit && $trademarks_list->StartRec > 1)
		$trademarks_list->Recordset->move($trademarks_list->StartRec - 1);
} elseif (!$trademarks->AllowAddDeleteRow && $trademarks_list->StopRec == 0) {
	$trademarks_list->StopRec = $trademarks->GridAddRowCount;
}

// Initialize aggregate
$trademarks->RowType = ROWTYPE_AGGREGATEINIT;
$trademarks->resetAttributes();
$trademarks_list->renderRow();
while ($trademarks_list->RecCnt < $trademarks_list->StopRec) {
	$trademarks_list->RecCnt++;
	if ($trademarks_list->RecCnt >= $trademarks_list->StartRec) {
		$trademarks_list->RowCnt++;

		// Set up key count
		$trademarks_list->KeyCount = $trademarks_list->RowIndex;

		// Init row class and style
		$trademarks->resetAttributes();
		$trademarks->CssClass = "";
		if ($trademarks->isGridAdd()) {
		} else {
			$trademarks_list->loadRowValues($trademarks_list->Recordset); // Load row values
		}
		$trademarks->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$trademarks->RowAttrs = array_merge($trademarks->RowAttrs, array('data-rowindex'=>$trademarks_list->RowCnt, 'id'=>'r' . $trademarks_list->RowCnt . '_trademarks', 'data-rowtype'=>$trademarks->RowType));

		// Render row
		$trademarks_list->renderRow();

		// Render list options
		$trademarks_list->renderListOptions();
?>
	<tr<?php echo $trademarks->rowAttributes() ?>>
<?php

// Render list options (body, left)
$trademarks_list->ListOptions->render("body", "left", $trademarks_list->RowCnt);
?>
	<?php if ($trademarks->ID->Visible) { // ID ?>
		<td data-name="ID"<?php echo $trademarks->ID->cellAttributes() ?>>
<span id="el<?php echo $trademarks_list->RowCnt ?>_trademarks_ID" class="trademarks_ID">
<span<?php echo $trademarks->ID->viewAttributes() ?>>
<?php echo $trademarks->ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($trademarks->Trademark->Visible) { // Trademark ?>
		<td data-name="Trademark"<?php echo $trademarks->Trademark->cellAttributes() ?>>
<span id="el<?php echo $trademarks_list->RowCnt ?>_trademarks_Trademark" class="trademarks_Trademark">
<span<?php echo $trademarks->Trademark->viewAttributes() ?>>
<?php echo $trademarks->Trademark->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$trademarks_list->ListOptions->render("body", "right", $trademarks_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$trademarks->isGridAdd())
		$trademarks_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$trademarks->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($trademarks_list->Recordset)
	$trademarks_list->Recordset->Close();
?>
<?php if (!$trademarks->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$trademarks->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($trademarks_list->Pager)) $trademarks_list->Pager = new PrevNextPager($trademarks_list->StartRec, $trademarks_list->DisplayRecs, $trademarks_list->TotalRecs, $trademarks_list->AutoHidePager) ?>
<?php if ($trademarks_list->Pager->RecordCount > 0 && $trademarks_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($trademarks_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $trademarks_list->pageUrl() ?>start=<?php echo $trademarks_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($trademarks_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $trademarks_list->pageUrl() ?>start=<?php echo $trademarks_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $trademarks_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($trademarks_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $trademarks_list->pageUrl() ?>start=<?php echo $trademarks_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($trademarks_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $trademarks_list->pageUrl() ?>start=<?php echo $trademarks_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $trademarks_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($trademarks_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $trademarks_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $trademarks_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $trademarks_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($trademarks_list->TotalRecs > 0 && (!$trademarks_list->AutoHidePageSizeSelector || $trademarks_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="trademarks">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($trademarks_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($trademarks_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($trademarks_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($trademarks->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($trademarks_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($trademarks_list->TotalRecs == 0 && !$trademarks->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($trademarks_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$trademarks_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$trademarks->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$trademarks_list->terminate();
?>
