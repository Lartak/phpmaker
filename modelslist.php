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
$models_list = new models_list();

// Run the page
$models_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$models_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$models->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fmodelslist = currentForm = new ew.Form("fmodelslist", "list");
fmodelslist.formKeyCountName = '<?php echo $models_list->FormKeyCountName ?>';

// Form_CustomValidate event
fmodelslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fmodelslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fmodelslistsrch = currentSearchForm = new ew.Form("fmodelslistsrch");

// Filters
fmodelslistsrch.filterList = <?php echo $models_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$models->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($models_list->TotalRecs > 0 && $models_list->ExportOptions->visible()) { ?>
<?php $models_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($models_list->ImportOptions->visible()) { ?>
<?php $models_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($models_list->SearchOptions->visible()) { ?>
<?php $models_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($models_list->FilterOptions->visible()) { ?>
<?php $models_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$models_list->renderOtherOptions();
?>
<?php if (!$models->isExport() && !$models->CurrentAction) { ?>
<form name="fmodelslistsrch" id="fmodelslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($models_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fmodelslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="models">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($models_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($models_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $models_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($models_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($models_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($models_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($models_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $models_list->showPageHeader(); ?>
<?php
$models_list->showMessage();
?>
<?php if ($models_list->TotalRecs > 0 || $models->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($models_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> models">
<?php if (!$models->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$models->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($models_list->Pager)) $models_list->Pager = new PrevNextPager($models_list->StartRec, $models_list->DisplayRecs, $models_list->TotalRecs, $models_list->AutoHidePager) ?>
<?php if ($models_list->Pager->RecordCount > 0 && $models_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($models_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $models_list->pageUrl() ?>start=<?php echo $models_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($models_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $models_list->pageUrl() ?>start=<?php echo $models_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $models_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($models_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $models_list->pageUrl() ?>start=<?php echo $models_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($models_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $models_list->pageUrl() ?>start=<?php echo $models_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $models_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($models_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $models_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $models_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $models_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($models_list->TotalRecs > 0 && (!$models_list->AutoHidePageSizeSelector || $models_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="models">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($models_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($models_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($models_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($models->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($models_list->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fmodelslist" id="fmodelslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($models_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $models_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="models">
<div id="gmp_models" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($models_list->TotalRecs > 0 || $models->isGridEdit()) { ?>
<table id="tbl_modelslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$models_list->RowType = ROWTYPE_HEADER;

// Render list options
$models_list->renderListOptions();

// Render list options (header, left)
$models_list->ListOptions->render("header", "left");
?>
<?php if ($models->ID->Visible) { // ID ?>
	<?php if ($models->sortUrl($models->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $models->ID->headerCellClass() ?>"><div id="elh_models_ID" class="models_ID"><div class="ew-table-header-caption"><?php echo $models->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $models->ID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $models->SortUrl($models->ID) ?>',1);"><div id="elh_models_ID" class="models_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $models->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($models->ID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($models->ID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($models->Trademark->Visible) { // Trademark ?>
	<?php if ($models->sortUrl($models->Trademark) == "") { ?>
		<th data-name="Trademark" class="<?php echo $models->Trademark->headerCellClass() ?>"><div id="elh_models_Trademark" class="models_Trademark"><div class="ew-table-header-caption"><?php echo $models->Trademark->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Trademark" class="<?php echo $models->Trademark->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $models->SortUrl($models->Trademark) ?>',1);"><div id="elh_models_Trademark" class="models_Trademark">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $models->Trademark->caption() ?></span><span class="ew-table-header-sort"><?php if ($models->Trademark->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($models->Trademark->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($models->Model->Visible) { // Model ?>
	<?php if ($models->sortUrl($models->Model) == "") { ?>
		<th data-name="Model" class="<?php echo $models->Model->headerCellClass() ?>"><div id="elh_models_Model" class="models_Model"><div class="ew-table-header-caption"><?php echo $models->Model->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Model" class="<?php echo $models->Model->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $models->SortUrl($models->Model) ?>',1);"><div id="elh_models_Model" class="models_Model">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $models->Model->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($models->Model->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($models->Model->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$models_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($models->ExportAll && $models->isExport()) {
	$models_list->StopRec = $models_list->TotalRecs;
} else {

	// Set the last record to display
	if ($models_list->TotalRecs > $models_list->StartRec + $models_list->DisplayRecs - 1)
		$models_list->StopRec = $models_list->StartRec + $models_list->DisplayRecs - 1;
	else
		$models_list->StopRec = $models_list->TotalRecs;
}
$models_list->RecCnt = $models_list->StartRec - 1;
if ($models_list->Recordset && !$models_list->Recordset->EOF) {
	$models_list->Recordset->moveFirst();
	$selectLimit = $models_list->UseSelectLimit;
	if (!$selectLimit && $models_list->StartRec > 1)
		$models_list->Recordset->move($models_list->StartRec - 1);
} elseif (!$models->AllowAddDeleteRow && $models_list->StopRec == 0) {
	$models_list->StopRec = $models->GridAddRowCount;
}

// Initialize aggregate
$models->RowType = ROWTYPE_AGGREGATEINIT;
$models->resetAttributes();
$models_list->renderRow();
while ($models_list->RecCnt < $models_list->StopRec) {
	$models_list->RecCnt++;
	if ($models_list->RecCnt >= $models_list->StartRec) {
		$models_list->RowCnt++;

		// Set up key count
		$models_list->KeyCount = $models_list->RowIndex;

		// Init row class and style
		$models->resetAttributes();
		$models->CssClass = "";
		if ($models->isGridAdd()) {
		} else {
			$models_list->loadRowValues($models_list->Recordset); // Load row values
		}
		$models->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$models->RowAttrs = array_merge($models->RowAttrs, array('data-rowindex'=>$models_list->RowCnt, 'id'=>'r' . $models_list->RowCnt . '_models', 'data-rowtype'=>$models->RowType));

		// Render row
		$models_list->renderRow();

		// Render list options
		$models_list->renderListOptions();
?>
	<tr<?php echo $models->rowAttributes() ?>>
<?php

// Render list options (body, left)
$models_list->ListOptions->render("body", "left", $models_list->RowCnt);
?>
	<?php if ($models->ID->Visible) { // ID ?>
		<td data-name="ID"<?php echo $models->ID->cellAttributes() ?>>
<span id="el<?php echo $models_list->RowCnt ?>_models_ID" class="models_ID">
<span<?php echo $models->ID->viewAttributes() ?>>
<?php echo $models->ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($models->Trademark->Visible) { // Trademark ?>
		<td data-name="Trademark"<?php echo $models->Trademark->cellAttributes() ?>>
<span id="el<?php echo $models_list->RowCnt ?>_models_Trademark" class="models_Trademark">
<span<?php echo $models->Trademark->viewAttributes() ?>>
<?php echo $models->Trademark->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($models->Model->Visible) { // Model ?>
		<td data-name="Model"<?php echo $models->Model->cellAttributes() ?>>
<span id="el<?php echo $models_list->RowCnt ?>_models_Model" class="models_Model">
<span<?php echo $models->Model->viewAttributes() ?>>
<?php echo $models->Model->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$models_list->ListOptions->render("body", "right", $models_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$models->isGridAdd())
		$models_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$models->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($models_list->Recordset)
	$models_list->Recordset->Close();
?>
<?php if (!$models->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$models->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($models_list->Pager)) $models_list->Pager = new PrevNextPager($models_list->StartRec, $models_list->DisplayRecs, $models_list->TotalRecs, $models_list->AutoHidePager) ?>
<?php if ($models_list->Pager->RecordCount > 0 && $models_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($models_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $models_list->pageUrl() ?>start=<?php echo $models_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($models_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $models_list->pageUrl() ?>start=<?php echo $models_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $models_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($models_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $models_list->pageUrl() ?>start=<?php echo $models_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($models_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $models_list->pageUrl() ?>start=<?php echo $models_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $models_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($models_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $models_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $models_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $models_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($models_list->TotalRecs > 0 && (!$models_list->AutoHidePageSizeSelector || $models_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="models">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($models_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($models_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($models_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($models->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($models_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($models_list->TotalRecs == 0 && !$models->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($models_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$models_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$models->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$models_list->terminate();
?>
