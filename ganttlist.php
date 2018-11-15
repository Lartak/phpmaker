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
$gantt_list = new gantt_list();

// Run the page
$gantt_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gantt_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$gantt->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fganttlist = currentForm = new ew.Form("fganttlist", "list");
fganttlist.formKeyCountName = '<?php echo $gantt_list->FormKeyCountName ?>';

// Form_CustomValidate event
fganttlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fganttlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fganttlistsrch = currentSearchForm = new ew.Form("fganttlistsrch");

// Filters
fganttlistsrch.filterList = <?php echo $gantt_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$gantt->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($gantt_list->TotalRecs > 0 && $gantt_list->ExportOptions->visible()) { ?>
<?php $gantt_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($gantt_list->ImportOptions->visible()) { ?>
<?php $gantt_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($gantt_list->SearchOptions->visible()) { ?>
<?php $gantt_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($gantt_list->FilterOptions->visible()) { ?>
<?php $gantt_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$gantt_list->renderOtherOptions();
?>
<?php if (!$gantt->isExport() && !$gantt->CurrentAction) { ?>
<form name="fganttlistsrch" id="fganttlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($gantt_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fganttlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="gantt">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($gantt_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($gantt_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $gantt_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($gantt_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($gantt_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($gantt_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($gantt_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $gantt_list->showPageHeader(); ?>
<?php
$gantt_list->showMessage();
?>
<?php if ($gantt_list->TotalRecs > 0 || $gantt->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($gantt_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> gantt">
<?php if (!$gantt->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$gantt->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($gantt_list->Pager)) $gantt_list->Pager = new PrevNextPager($gantt_list->StartRec, $gantt_list->DisplayRecs, $gantt_list->TotalRecs, $gantt_list->AutoHidePager) ?>
<?php if ($gantt_list->Pager->RecordCount > 0 && $gantt_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($gantt_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $gantt_list->pageUrl() ?>start=<?php echo $gantt_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($gantt_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $gantt_list->pageUrl() ?>start=<?php echo $gantt_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $gantt_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($gantt_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $gantt_list->pageUrl() ?>start=<?php echo $gantt_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($gantt_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $gantt_list->pageUrl() ?>start=<?php echo $gantt_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $gantt_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($gantt_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $gantt_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $gantt_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $gantt_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($gantt_list->TotalRecs > 0 && (!$gantt_list->AutoHidePageSizeSelector || $gantt_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="gantt">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($gantt_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($gantt_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($gantt_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($gantt->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($gantt_list->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fganttlist" id="fganttlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($gantt_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $gantt_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gantt">
<div id="gmp_gantt" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($gantt_list->TotalRecs > 0 || $gantt->isGridEdit()) { ?>
<table id="tbl_ganttlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$gantt_list->RowType = ROWTYPE_HEADER;

// Render list options
$gantt_list->renderListOptions();

// Render list options (header, left)
$gantt_list->ListOptions->render("header", "left");
?>
<?php if ($gantt->id->Visible) { // id ?>
	<?php if ($gantt->sortUrl($gantt->id) == "") { ?>
		<th data-name="id" class="<?php echo $gantt->id->headerCellClass() ?>"><div id="elh_gantt_id" class="gantt_id"><div class="ew-table-header-caption"><?php echo $gantt->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $gantt->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $gantt->SortUrl($gantt->id) ?>',1);"><div id="elh_gantt_id" class="gantt_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gantt->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gantt->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($gantt->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gantt->name->Visible) { // name ?>
	<?php if ($gantt->sortUrl($gantt->name) == "") { ?>
		<th data-name="name" class="<?php echo $gantt->name->headerCellClass() ?>"><div id="elh_gantt_name" class="gantt_name"><div class="ew-table-header-caption"><?php echo $gantt->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $gantt->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $gantt->SortUrl($gantt->name) ?>',1);"><div id="elh_gantt_name" class="gantt_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gantt->name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($gantt->name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($gantt->name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gantt->start->Visible) { // start ?>
	<?php if ($gantt->sortUrl($gantt->start) == "") { ?>
		<th data-name="start" class="<?php echo $gantt->start->headerCellClass() ?>"><div id="elh_gantt_start" class="gantt_start"><div class="ew-table-header-caption"><?php echo $gantt->start->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="start" class="<?php echo $gantt->start->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $gantt->SortUrl($gantt->start) ?>',1);"><div id="elh_gantt_start" class="gantt_start">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gantt->start->caption() ?></span><span class="ew-table-header-sort"><?php if ($gantt->start->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($gantt->start->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gantt->end->Visible) { // end ?>
	<?php if ($gantt->sortUrl($gantt->end) == "") { ?>
		<th data-name="end" class="<?php echo $gantt->end->headerCellClass() ?>"><div id="elh_gantt_end" class="gantt_end"><div class="ew-table-header-caption"><?php echo $gantt->end->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="end" class="<?php echo $gantt->end->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $gantt->SortUrl($gantt->end) ?>',1);"><div id="elh_gantt_end" class="gantt_end">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gantt->end->caption() ?></span><span class="ew-table-header-sort"><?php if ($gantt->end->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($gantt->end->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$gantt_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($gantt->ExportAll && $gantt->isExport()) {
	$gantt_list->StopRec = $gantt_list->TotalRecs;
} else {

	// Set the last record to display
	if ($gantt_list->TotalRecs > $gantt_list->StartRec + $gantt_list->DisplayRecs - 1)
		$gantt_list->StopRec = $gantt_list->StartRec + $gantt_list->DisplayRecs - 1;
	else
		$gantt_list->StopRec = $gantt_list->TotalRecs;
}
$gantt_list->RecCnt = $gantt_list->StartRec - 1;
if ($gantt_list->Recordset && !$gantt_list->Recordset->EOF) {
	$gantt_list->Recordset->moveFirst();
	$selectLimit = $gantt_list->UseSelectLimit;
	if (!$selectLimit && $gantt_list->StartRec > 1)
		$gantt_list->Recordset->move($gantt_list->StartRec - 1);
} elseif (!$gantt->AllowAddDeleteRow && $gantt_list->StopRec == 0) {
	$gantt_list->StopRec = $gantt->GridAddRowCount;
}

// Initialize aggregate
$gantt->RowType = ROWTYPE_AGGREGATEINIT;
$gantt->resetAttributes();
$gantt_list->renderRow();
while ($gantt_list->RecCnt < $gantt_list->StopRec) {
	$gantt_list->RecCnt++;
	if ($gantt_list->RecCnt >= $gantt_list->StartRec) {
		$gantt_list->RowCnt++;

		// Set up key count
		$gantt_list->KeyCount = $gantt_list->RowIndex;

		// Init row class and style
		$gantt->resetAttributes();
		$gantt->CssClass = "";
		if ($gantt->isGridAdd()) {
		} else {
			$gantt_list->loadRowValues($gantt_list->Recordset); // Load row values
		}
		$gantt->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$gantt->RowAttrs = array_merge($gantt->RowAttrs, array('data-rowindex'=>$gantt_list->RowCnt, 'id'=>'r' . $gantt_list->RowCnt . '_gantt', 'data-rowtype'=>$gantt->RowType));

		// Render row
		$gantt_list->renderRow();

		// Render list options
		$gantt_list->renderListOptions();
?>
	<tr<?php echo $gantt->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gantt_list->ListOptions->render("body", "left", $gantt_list->RowCnt);
?>
	<?php if ($gantt->id->Visible) { // id ?>
		<td data-name="id"<?php echo $gantt->id->cellAttributes() ?>>
<span id="el<?php echo $gantt_list->RowCnt ?>_gantt_id" class="gantt_id">
<span<?php echo $gantt->id->viewAttributes() ?>>
<?php echo $gantt->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gantt->name->Visible) { // name ?>
		<td data-name="name"<?php echo $gantt->name->cellAttributes() ?>>
<span id="el<?php echo $gantt_list->RowCnt ?>_gantt_name" class="gantt_name">
<span<?php echo $gantt->name->viewAttributes() ?>>
<?php echo $gantt->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gantt->start->Visible) { // start ?>
		<td data-name="start"<?php echo $gantt->start->cellAttributes() ?>>
<span id="el<?php echo $gantt_list->RowCnt ?>_gantt_start" class="gantt_start">
<span<?php echo $gantt->start->viewAttributes() ?>>
<?php echo $gantt->start->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gantt->end->Visible) { // end ?>
		<td data-name="end"<?php echo $gantt->end->cellAttributes() ?>>
<span id="el<?php echo $gantt_list->RowCnt ?>_gantt_end" class="gantt_end">
<span<?php echo $gantt->end->viewAttributes() ?>>
<?php echo $gantt->end->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gantt_list->ListOptions->render("body", "right", $gantt_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$gantt->isGridAdd())
		$gantt_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$gantt->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($gantt_list->Recordset)
	$gantt_list->Recordset->Close();
?>
<?php if (!$gantt->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$gantt->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($gantt_list->Pager)) $gantt_list->Pager = new PrevNextPager($gantt_list->StartRec, $gantt_list->DisplayRecs, $gantt_list->TotalRecs, $gantt_list->AutoHidePager) ?>
<?php if ($gantt_list->Pager->RecordCount > 0 && $gantt_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($gantt_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $gantt_list->pageUrl() ?>start=<?php echo $gantt_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($gantt_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $gantt_list->pageUrl() ?>start=<?php echo $gantt_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $gantt_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($gantt_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $gantt_list->pageUrl() ?>start=<?php echo $gantt_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($gantt_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $gantt_list->pageUrl() ?>start=<?php echo $gantt_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $gantt_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($gantt_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $gantt_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $gantt_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $gantt_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($gantt_list->TotalRecs > 0 && (!$gantt_list->AutoHidePageSizeSelector || $gantt_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="gantt">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($gantt_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($gantt_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($gantt_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($gantt->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($gantt_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($gantt_list->TotalRecs == 0 && !$gantt->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($gantt_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$gantt_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$gantt->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$gantt_list->terminate();
?>
