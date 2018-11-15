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
$userlevels_list = new userlevels_list();

// Run the page
$userlevels_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$userlevels_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$userlevels->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fuserlevelslist = currentForm = new ew.Form("fuserlevelslist", "list");
fuserlevelslist.formKeyCountName = '<?php echo $userlevels_list->FormKeyCountName ?>';

// Form_CustomValidate event
fuserlevelslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fuserlevelslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fuserlevelslistsrch = currentSearchForm = new ew.Form("fuserlevelslistsrch");

// Filters
fuserlevelslistsrch.filterList = <?php echo $userlevels_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$userlevels->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($userlevels_list->TotalRecs > 0 && $userlevels_list->ExportOptions->visible()) { ?>
<?php $userlevels_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($userlevels_list->ImportOptions->visible()) { ?>
<?php $userlevels_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($userlevels_list->SearchOptions->visible()) { ?>
<?php $userlevels_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($userlevels_list->FilterOptions->visible()) { ?>
<?php $userlevels_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$userlevels_list->renderOtherOptions();
?>
<?php if (!$userlevels->isExport() && !$userlevels->CurrentAction) { ?>
<form name="fuserlevelslistsrch" id="fuserlevelslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($userlevels_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fuserlevelslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="userlevels">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($userlevels_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($userlevels_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $userlevels_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($userlevels_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($userlevels_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($userlevels_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($userlevels_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $userlevels_list->showPageHeader(); ?>
<?php
$userlevels_list->showMessage();
?>
<?php if ($userlevels_list->TotalRecs > 0 || $userlevels->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($userlevels_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> userlevels">
<?php if (!$userlevels->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$userlevels->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($userlevels_list->Pager)) $userlevels_list->Pager = new PrevNextPager($userlevels_list->StartRec, $userlevels_list->DisplayRecs, $userlevels_list->TotalRecs, $userlevels_list->AutoHidePager) ?>
<?php if ($userlevels_list->Pager->RecordCount > 0 && $userlevels_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($userlevels_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $userlevels_list->pageUrl() ?>start=<?php echo $userlevels_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($userlevels_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $userlevels_list->pageUrl() ?>start=<?php echo $userlevels_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $userlevels_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($userlevels_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $userlevels_list->pageUrl() ?>start=<?php echo $userlevels_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($userlevels_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $userlevels_list->pageUrl() ?>start=<?php echo $userlevels_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $userlevels_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($userlevels_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $userlevels_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $userlevels_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $userlevels_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($userlevels_list->TotalRecs > 0 && (!$userlevels_list->AutoHidePageSizeSelector || $userlevels_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="userlevels">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($userlevels_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($userlevels_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($userlevels_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($userlevels->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($userlevels_list->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fuserlevelslist" id="fuserlevelslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($userlevels_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $userlevels_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="userlevels">
<div id="gmp_userlevels" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($userlevels_list->TotalRecs > 0 || $userlevels->isGridEdit()) { ?>
<table id="tbl_userlevelslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$userlevels_list->RowType = ROWTYPE_HEADER;

// Render list options
$userlevels_list->renderListOptions();

// Render list options (header, left)
$userlevels_list->ListOptions->render("header", "left");
?>
<?php if ($userlevels->userlevelid->Visible) { // userlevelid ?>
	<?php if ($userlevels->sortUrl($userlevels->userlevelid) == "") { ?>
		<th data-name="userlevelid" class="<?php echo $userlevels->userlevelid->headerCellClass() ?>"><div id="elh_userlevels_userlevelid" class="userlevels_userlevelid"><div class="ew-table-header-caption"><?php echo $userlevels->userlevelid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="userlevelid" class="<?php echo $userlevels->userlevelid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $userlevels->SortUrl($userlevels->userlevelid) ?>',1);"><div id="elh_userlevels_userlevelid" class="userlevels_userlevelid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $userlevels->userlevelid->caption() ?></span><span class="ew-table-header-sort"><?php if ($userlevels->userlevelid->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($userlevels->userlevelid->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($userlevels->userlevelname->Visible) { // userlevelname ?>
	<?php if ($userlevels->sortUrl($userlevels->userlevelname) == "") { ?>
		<th data-name="userlevelname" class="<?php echo $userlevels->userlevelname->headerCellClass() ?>"><div id="elh_userlevels_userlevelname" class="userlevels_userlevelname"><div class="ew-table-header-caption"><?php echo $userlevels->userlevelname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="userlevelname" class="<?php echo $userlevels->userlevelname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $userlevels->SortUrl($userlevels->userlevelname) ?>',1);"><div id="elh_userlevels_userlevelname" class="userlevels_userlevelname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $userlevels->userlevelname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($userlevels->userlevelname->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($userlevels->userlevelname->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$userlevels_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($userlevels->ExportAll && $userlevels->isExport()) {
	$userlevels_list->StopRec = $userlevels_list->TotalRecs;
} else {

	// Set the last record to display
	if ($userlevels_list->TotalRecs > $userlevels_list->StartRec + $userlevels_list->DisplayRecs - 1)
		$userlevels_list->StopRec = $userlevels_list->StartRec + $userlevels_list->DisplayRecs - 1;
	else
		$userlevels_list->StopRec = $userlevels_list->TotalRecs;
}
$userlevels_list->RecCnt = $userlevels_list->StartRec - 1;
if ($userlevels_list->Recordset && !$userlevels_list->Recordset->EOF) {
	$userlevels_list->Recordset->moveFirst();
	$selectLimit = $userlevels_list->UseSelectLimit;
	if (!$selectLimit && $userlevels_list->StartRec > 1)
		$userlevels_list->Recordset->move($userlevels_list->StartRec - 1);
} elseif (!$userlevels->AllowAddDeleteRow && $userlevels_list->StopRec == 0) {
	$userlevels_list->StopRec = $userlevels->GridAddRowCount;
}

// Initialize aggregate
$userlevels->RowType = ROWTYPE_AGGREGATEINIT;
$userlevels->resetAttributes();
$userlevels_list->renderRow();
while ($userlevels_list->RecCnt < $userlevels_list->StopRec) {
	$userlevels_list->RecCnt++;
	if ($userlevels_list->RecCnt >= $userlevels_list->StartRec) {
		$userlevels_list->RowCnt++;

		// Set up key count
		$userlevels_list->KeyCount = $userlevels_list->RowIndex;

		// Init row class and style
		$userlevels->resetAttributes();
		$userlevels->CssClass = "";
		if ($userlevels->isGridAdd()) {
		} else {
			$userlevels_list->loadRowValues($userlevels_list->Recordset); // Load row values
		}
		$userlevels->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$userlevels->RowAttrs = array_merge($userlevels->RowAttrs, array('data-rowindex'=>$userlevels_list->RowCnt, 'id'=>'r' . $userlevels_list->RowCnt . '_userlevels', 'data-rowtype'=>$userlevels->RowType));

		// Render row
		$userlevels_list->renderRow();

		// Render list options
		$userlevels_list->renderListOptions();
?>
	<tr<?php echo $userlevels->rowAttributes() ?>>
<?php

// Render list options (body, left)
$userlevels_list->ListOptions->render("body", "left", $userlevels_list->RowCnt);
?>
	<?php if ($userlevels->userlevelid->Visible) { // userlevelid ?>
		<td data-name="userlevelid"<?php echo $userlevels->userlevelid->cellAttributes() ?>>
<span id="el<?php echo $userlevels_list->RowCnt ?>_userlevels_userlevelid" class="userlevels_userlevelid">
<span<?php echo $userlevels->userlevelid->viewAttributes() ?>>
<?php echo $userlevels->userlevelid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($userlevels->userlevelname->Visible) { // userlevelname ?>
		<td data-name="userlevelname"<?php echo $userlevels->userlevelname->cellAttributes() ?>>
<span id="el<?php echo $userlevels_list->RowCnt ?>_userlevels_userlevelname" class="userlevels_userlevelname">
<span<?php echo $userlevels->userlevelname->viewAttributes() ?>>
<?php echo $userlevels->userlevelname->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$userlevels_list->ListOptions->render("body", "right", $userlevels_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$userlevels->isGridAdd())
		$userlevels_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$userlevels->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($userlevels_list->Recordset)
	$userlevels_list->Recordset->Close();
?>
<?php if (!$userlevels->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$userlevels->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($userlevels_list->Pager)) $userlevels_list->Pager = new PrevNextPager($userlevels_list->StartRec, $userlevels_list->DisplayRecs, $userlevels_list->TotalRecs, $userlevels_list->AutoHidePager) ?>
<?php if ($userlevels_list->Pager->RecordCount > 0 && $userlevels_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($userlevels_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $userlevels_list->pageUrl() ?>start=<?php echo $userlevels_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($userlevels_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $userlevels_list->pageUrl() ?>start=<?php echo $userlevels_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $userlevels_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($userlevels_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $userlevels_list->pageUrl() ?>start=<?php echo $userlevels_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($userlevels_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $userlevels_list->pageUrl() ?>start=<?php echo $userlevels_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $userlevels_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($userlevels_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $userlevels_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $userlevels_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $userlevels_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($userlevels_list->TotalRecs > 0 && (!$userlevels_list->AutoHidePageSizeSelector || $userlevels_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="userlevels">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($userlevels_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($userlevels_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($userlevels_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($userlevels->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($userlevels_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($userlevels_list->TotalRecs == 0 && !$userlevels->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($userlevels_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$userlevels_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$userlevels->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$userlevels_list->terminate();
?>
