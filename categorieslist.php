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
$categories_list = new categories_list();

// Run the page
$categories_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$categories_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$categories->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fcategorieslist = currentForm = new ew.Form("fcategorieslist", "list");
fcategorieslist.formKeyCountName = '<?php echo $categories_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcategorieslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcategorieslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fcategorieslistsrch = currentSearchForm = new ew.Form("fcategorieslistsrch");

// Filters
fcategorieslistsrch.filterList = <?php echo $categories_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$categories->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($categories_list->TotalRecs > 0 && $categories_list->ExportOptions->visible()) { ?>
<?php $categories_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($categories_list->ImportOptions->visible()) { ?>
<?php $categories_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($categories_list->SearchOptions->visible()) { ?>
<?php $categories_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($categories_list->FilterOptions->visible()) { ?>
<?php $categories_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$categories_list->renderOtherOptions();
?>
<?php if (!$categories->isExport() && !$categories->CurrentAction) { ?>
<form name="fcategorieslistsrch" id="fcategorieslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($categories_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fcategorieslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="categories">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($categories_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($categories_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $categories_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($categories_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($categories_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($categories_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($categories_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $categories_list->showPageHeader(); ?>
<?php
$categories_list->showMessage();
?>
<?php if ($categories_list->TotalRecs > 0 || $categories->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($categories_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> categories">
<?php if (!$categories->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$categories->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($categories_list->Pager)) $categories_list->Pager = new PrevNextPager($categories_list->StartRec, $categories_list->DisplayRecs, $categories_list->TotalRecs, $categories_list->AutoHidePager) ?>
<?php if ($categories_list->Pager->RecordCount > 0 && $categories_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($categories_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $categories_list->pageUrl() ?>start=<?php echo $categories_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($categories_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $categories_list->pageUrl() ?>start=<?php echo $categories_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $categories_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($categories_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $categories_list->pageUrl() ?>start=<?php echo $categories_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($categories_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $categories_list->pageUrl() ?>start=<?php echo $categories_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $categories_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($categories_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $categories_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $categories_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $categories_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($categories_list->TotalRecs > 0 && (!$categories_list->AutoHidePageSizeSelector || $categories_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="categories">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($categories_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($categories_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($categories_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($categories->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($categories_list->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcategorieslist" id="fcategorieslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($categories_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $categories_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="categories">
<div id="gmp_categories" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($categories_list->TotalRecs > 0 || $categories->isGridEdit()) { ?>
<table id="tbl_categorieslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$categories_list->RowType = ROWTYPE_HEADER;

// Render list options
$categories_list->renderListOptions();

// Render list options (header, left)
$categories_list->ListOptions->render("header", "left");
?>
<?php if ($categories->CategoryID->Visible) { // CategoryID ?>
	<?php if ($categories->sortUrl($categories->CategoryID) == "") { ?>
		<th data-name="CategoryID" class="<?php echo $categories->CategoryID->headerCellClass() ?>"><div id="elh_categories_CategoryID" class="categories_CategoryID"><div class="ew-table-header-caption"><?php echo $categories->CategoryID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CategoryID" class="<?php echo $categories->CategoryID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $categories->SortUrl($categories->CategoryID) ?>',1);"><div id="elh_categories_CategoryID" class="categories_CategoryID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $categories->CategoryID->caption() ?></span><span class="ew-table-header-sort"><?php if ($categories->CategoryID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($categories->CategoryID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($categories->CategoryName->Visible) { // CategoryName ?>
	<?php if ($categories->sortUrl($categories->CategoryName) == "") { ?>
		<th data-name="CategoryName" class="<?php echo $categories->CategoryName->headerCellClass() ?>"><div id="elh_categories_CategoryName" class="categories_CategoryName"><div class="ew-table-header-caption"><?php echo $categories->CategoryName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CategoryName" class="<?php echo $categories->CategoryName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $categories->SortUrl($categories->CategoryName) ?>',1);"><div id="elh_categories_CategoryName" class="categories_CategoryName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $categories->CategoryName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($categories->CategoryName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($categories->CategoryName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$categories_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($categories->ExportAll && $categories->isExport()) {
	$categories_list->StopRec = $categories_list->TotalRecs;
} else {

	// Set the last record to display
	if ($categories_list->TotalRecs > $categories_list->StartRec + $categories_list->DisplayRecs - 1)
		$categories_list->StopRec = $categories_list->StartRec + $categories_list->DisplayRecs - 1;
	else
		$categories_list->StopRec = $categories_list->TotalRecs;
}
$categories_list->RecCnt = $categories_list->StartRec - 1;
if ($categories_list->Recordset && !$categories_list->Recordset->EOF) {
	$categories_list->Recordset->moveFirst();
	$selectLimit = $categories_list->UseSelectLimit;
	if (!$selectLimit && $categories_list->StartRec > 1)
		$categories_list->Recordset->move($categories_list->StartRec - 1);
} elseif (!$categories->AllowAddDeleteRow && $categories_list->StopRec == 0) {
	$categories_list->StopRec = $categories->GridAddRowCount;
}

// Initialize aggregate
$categories->RowType = ROWTYPE_AGGREGATEINIT;
$categories->resetAttributes();
$categories_list->renderRow();
while ($categories_list->RecCnt < $categories_list->StopRec) {
	$categories_list->RecCnt++;
	if ($categories_list->RecCnt >= $categories_list->StartRec) {
		$categories_list->RowCnt++;

		// Set up key count
		$categories_list->KeyCount = $categories_list->RowIndex;

		// Init row class and style
		$categories->resetAttributes();
		$categories->CssClass = "";
		if ($categories->isGridAdd()) {
		} else {
			$categories_list->loadRowValues($categories_list->Recordset); // Load row values
		}
		$categories->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$categories->RowAttrs = array_merge($categories->RowAttrs, array('data-rowindex'=>$categories_list->RowCnt, 'id'=>'r' . $categories_list->RowCnt . '_categories', 'data-rowtype'=>$categories->RowType));

		// Render row
		$categories_list->renderRow();

		// Render list options
		$categories_list->renderListOptions();
?>
	<tr<?php echo $categories->rowAttributes() ?>>
<?php

// Render list options (body, left)
$categories_list->ListOptions->render("body", "left", $categories_list->RowCnt);
?>
	<?php if ($categories->CategoryID->Visible) { // CategoryID ?>
		<td data-name="CategoryID"<?php echo $categories->CategoryID->cellAttributes() ?>>
<span id="el<?php echo $categories_list->RowCnt ?>_categories_CategoryID" class="categories_CategoryID">
<span<?php echo $categories->CategoryID->viewAttributes() ?>>
<?php echo $categories->CategoryID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($categories->CategoryName->Visible) { // CategoryName ?>
		<td data-name="CategoryName"<?php echo $categories->CategoryName->cellAttributes() ?>>
<span id="el<?php echo $categories_list->RowCnt ?>_categories_CategoryName" class="categories_CategoryName">
<span<?php echo $categories->CategoryName->viewAttributes() ?>>
<?php echo $categories->CategoryName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$categories_list->ListOptions->render("body", "right", $categories_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$categories->isGridAdd())
		$categories_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$categories->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($categories_list->Recordset)
	$categories_list->Recordset->Close();
?>
<?php if (!$categories->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$categories->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($categories_list->Pager)) $categories_list->Pager = new PrevNextPager($categories_list->StartRec, $categories_list->DisplayRecs, $categories_list->TotalRecs, $categories_list->AutoHidePager) ?>
<?php if ($categories_list->Pager->RecordCount > 0 && $categories_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($categories_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $categories_list->pageUrl() ?>start=<?php echo $categories_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($categories_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $categories_list->pageUrl() ?>start=<?php echo $categories_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $categories_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($categories_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $categories_list->pageUrl() ?>start=<?php echo $categories_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($categories_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $categories_list->pageUrl() ?>start=<?php echo $categories_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $categories_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($categories_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $categories_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $categories_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $categories_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($categories_list->TotalRecs > 0 && (!$categories_list->AutoHidePageSizeSelector || $categories_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="categories">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($categories_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($categories_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($categories_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($categories->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($categories_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($categories_list->TotalRecs == 0 && !$categories->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($categories_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$categories_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$categories->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$categories_list->terminate();
?>
