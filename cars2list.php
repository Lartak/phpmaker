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
$cars2_list = new cars2_list();

// Run the page
$cars2_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cars2_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$cars2->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fcars2list = currentForm = new ew.Form("fcars2list", "list");
fcars2list.formKeyCountName = '<?php echo $cars2_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcars2list.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcars2list.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fcars2listsrch = currentSearchForm = new ew.Form("fcars2listsrch");

// Filters
fcars2listsrch.filterList = <?php echo $cars2_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$cars2->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($cars2_list->TotalRecs > 0 && $cars2_list->ExportOptions->visible()) { ?>
<?php $cars2_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($cars2_list->ImportOptions->visible()) { ?>
<?php $cars2_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($cars2_list->SearchOptions->visible()) { ?>
<?php $cars2_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($cars2_list->FilterOptions->visible()) { ?>
<?php $cars2_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$cars2_list->renderOtherOptions();
?>
<?php if (!$cars2->isExport() && !$cars2->CurrentAction) { ?>
<form name="fcars2listsrch" id="fcars2listsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($cars2_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fcars2listsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="cars2">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($cars2_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($cars2_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $cars2_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($cars2_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($cars2_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($cars2_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($cars2_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $cars2_list->showPageHeader(); ?>
<?php
$cars2_list->showMessage();
?>
<?php if ($cars2_list->TotalRecs > 0 || $cars2->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($cars2_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cars2">
<?php if (!$cars2->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$cars2->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($cars2_list->Pager)) $cars2_list->Pager = new PrevNextPager($cars2_list->StartRec, $cars2_list->DisplayRecs, $cars2_list->TotalRecs, $cars2_list->AutoHidePager) ?>
<?php if ($cars2_list->Pager->RecordCount > 0 && $cars2_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($cars2_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $cars2_list->pageUrl() ?>start=<?php echo $cars2_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($cars2_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $cars2_list->pageUrl() ?>start=<?php echo $cars2_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $cars2_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($cars2_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $cars2_list->pageUrl() ?>start=<?php echo $cars2_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($cars2_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $cars2_list->pageUrl() ?>start=<?php echo $cars2_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $cars2_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($cars2_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $cars2_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $cars2_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $cars2_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($cars2_list->TotalRecs > 0 && (!$cars2_list->AutoHidePageSizeSelector || $cars2_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="cars2">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($cars2_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($cars2_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($cars2_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($cars2->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($cars2_list->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcars2list" id="fcars2list" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cars2_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cars2_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cars2">
<div id="gmp_cars2" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($cars2_list->TotalRecs > 0 || $cars2->isGridEdit()) { ?>
<table id="tbl_cars2list" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$cars2_list->RowType = ROWTYPE_HEADER;

// Render list options
$cars2_list->renderListOptions();

// Render list options (header, left)
$cars2_list->ListOptions->render("header", "left");
?>
<?php if ($cars2->ID->Visible) { // ID ?>
	<?php if ($cars2->sortUrl($cars2->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $cars2->ID->headerCellClass() ?>"><div id="elh_cars2_ID" class="cars2_ID"><div class="ew-table-header-caption"><?php echo $cars2->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $cars2->ID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars2->SortUrl($cars2->ID) ?>',1);"><div id="elh_cars2_ID" class="cars2_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars2->ID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars2->ID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2->Trademark->Visible) { // Trademark ?>
	<?php if ($cars2->sortUrl($cars2->Trademark) == "") { ?>
		<th data-name="Trademark" class="<?php echo $cars2->Trademark->headerCellClass() ?>"><div id="elh_cars2_Trademark" class="cars2_Trademark"><div class="ew-table-header-caption"><?php echo $cars2->Trademark->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Trademark" class="<?php echo $cars2->Trademark->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars2->SortUrl($cars2->Trademark) ?>',1);"><div id="elh_cars2_Trademark" class="cars2_Trademark">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2->Trademark->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars2->Trademark->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars2->Trademark->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2->Model->Visible) { // Model ?>
	<?php if ($cars2->sortUrl($cars2->Model) == "") { ?>
		<th data-name="Model" class="<?php echo $cars2->Model->headerCellClass() ?>"><div id="elh_cars2_Model" class="cars2_Model"><div class="ew-table-header-caption"><?php echo $cars2->Model->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Model" class="<?php echo $cars2->Model->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars2->SortUrl($cars2->Model) ?>',1);"><div id="elh_cars2_Model" class="cars2_Model">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2->Model->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars2->Model->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars2->Model->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2->HP->Visible) { // HP ?>
	<?php if ($cars2->sortUrl($cars2->HP) == "") { ?>
		<th data-name="HP" class="<?php echo $cars2->HP->headerCellClass() ?>"><div id="elh_cars2_HP" class="cars2_HP"><div class="ew-table-header-caption"><?php echo $cars2->HP->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="HP" class="<?php echo $cars2->HP->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars2->SortUrl($cars2->HP) ?>',1);"><div id="elh_cars2_HP" class="cars2_HP">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2->HP->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars2->HP->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars2->HP->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2->Liter->Visible) { // Liter ?>
	<?php if ($cars2->sortUrl($cars2->Liter) == "") { ?>
		<th data-name="Liter" class="<?php echo $cars2->Liter->headerCellClass() ?>"><div id="elh_cars2_Liter" class="cars2_Liter"><div class="ew-table-header-caption"><?php echo $cars2->Liter->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Liter" class="<?php echo $cars2->Liter->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars2->SortUrl($cars2->Liter) ?>',1);"><div id="elh_cars2_Liter" class="cars2_Liter">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2->Liter->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars2->Liter->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars2->Liter->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2->Cyl->Visible) { // Cyl ?>
	<?php if ($cars2->sortUrl($cars2->Cyl) == "") { ?>
		<th data-name="Cyl" class="<?php echo $cars2->Cyl->headerCellClass() ?>"><div id="elh_cars2_Cyl" class="cars2_Cyl"><div class="ew-table-header-caption"><?php echo $cars2->Cyl->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Cyl" class="<?php echo $cars2->Cyl->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars2->SortUrl($cars2->Cyl) ?>',1);"><div id="elh_cars2_Cyl" class="cars2_Cyl">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2->Cyl->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars2->Cyl->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars2->Cyl->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2->TransmissSpeedCount->Visible) { // TransmissSpeedCount ?>
	<?php if ($cars2->sortUrl($cars2->TransmissSpeedCount) == "") { ?>
		<th data-name="TransmissSpeedCount" class="<?php echo $cars2->TransmissSpeedCount->headerCellClass() ?>"><div id="elh_cars2_TransmissSpeedCount" class="cars2_TransmissSpeedCount"><div class="ew-table-header-caption"><?php echo $cars2->TransmissSpeedCount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TransmissSpeedCount" class="<?php echo $cars2->TransmissSpeedCount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars2->SortUrl($cars2->TransmissSpeedCount) ?>',1);"><div id="elh_cars2_TransmissSpeedCount" class="cars2_TransmissSpeedCount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2->TransmissSpeedCount->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars2->TransmissSpeedCount->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars2->TransmissSpeedCount->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2->TransmissAutomatic->Visible) { // TransmissAutomatic ?>
	<?php if ($cars2->sortUrl($cars2->TransmissAutomatic) == "") { ?>
		<th data-name="TransmissAutomatic" class="<?php echo $cars2->TransmissAutomatic->headerCellClass() ?>"><div id="elh_cars2_TransmissAutomatic" class="cars2_TransmissAutomatic"><div class="ew-table-header-caption"><?php echo $cars2->TransmissAutomatic->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TransmissAutomatic" class="<?php echo $cars2->TransmissAutomatic->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars2->SortUrl($cars2->TransmissAutomatic) ?>',1);"><div id="elh_cars2_TransmissAutomatic" class="cars2_TransmissAutomatic">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2->TransmissAutomatic->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cars2->TransmissAutomatic->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars2->TransmissAutomatic->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2->MPG_City->Visible) { // MPG_City ?>
	<?php if ($cars2->sortUrl($cars2->MPG_City) == "") { ?>
		<th data-name="MPG_City" class="<?php echo $cars2->MPG_City->headerCellClass() ?>"><div id="elh_cars2_MPG_City" class="cars2_MPG_City"><div class="ew-table-header-caption"><?php echo $cars2->MPG_City->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MPG_City" class="<?php echo $cars2->MPG_City->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars2->SortUrl($cars2->MPG_City) ?>',1);"><div id="elh_cars2_MPG_City" class="cars2_MPG_City">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2->MPG_City->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars2->MPG_City->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars2->MPG_City->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2->MPG_Highway->Visible) { // MPG_Highway ?>
	<?php if ($cars2->sortUrl($cars2->MPG_Highway) == "") { ?>
		<th data-name="MPG_Highway" class="<?php echo $cars2->MPG_Highway->headerCellClass() ?>"><div id="elh_cars2_MPG_Highway" class="cars2_MPG_Highway"><div class="ew-table-header-caption"><?php echo $cars2->MPG_Highway->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MPG_Highway" class="<?php echo $cars2->MPG_Highway->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars2->SortUrl($cars2->MPG_Highway) ?>',1);"><div id="elh_cars2_MPG_Highway" class="cars2_MPG_Highway">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2->MPG_Highway->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars2->MPG_Highway->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars2->MPG_Highway->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2->Category->Visible) { // Category ?>
	<?php if ($cars2->sortUrl($cars2->Category) == "") { ?>
		<th data-name="Category" class="<?php echo $cars2->Category->headerCellClass() ?>"><div id="elh_cars2_Category" class="cars2_Category"><div class="ew-table-header-caption"><?php echo $cars2->Category->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Category" class="<?php echo $cars2->Category->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars2->SortUrl($cars2->Category) ?>',1);"><div id="elh_cars2_Category" class="cars2_Category">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2->Category->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cars2->Category->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars2->Category->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2->Hyperlink->Visible) { // Hyperlink ?>
	<?php if ($cars2->sortUrl($cars2->Hyperlink) == "") { ?>
		<th data-name="Hyperlink" class="<?php echo $cars2->Hyperlink->headerCellClass() ?>"><div id="elh_cars2_Hyperlink" class="cars2_Hyperlink"><div class="ew-table-header-caption"><?php echo $cars2->Hyperlink->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Hyperlink" class="<?php echo $cars2->Hyperlink->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars2->SortUrl($cars2->Hyperlink) ?>',1);"><div id="elh_cars2_Hyperlink" class="cars2_Hyperlink">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2->Hyperlink->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cars2->Hyperlink->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars2->Hyperlink->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2->Price->Visible) { // Price ?>
	<?php if ($cars2->sortUrl($cars2->Price) == "") { ?>
		<th data-name="Price" class="<?php echo $cars2->Price->headerCellClass() ?>"><div id="elh_cars2_Price" class="cars2_Price"><div class="ew-table-header-caption"><?php echo $cars2->Price->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Price" class="<?php echo $cars2->Price->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars2->SortUrl($cars2->Price) ?>',1);"><div id="elh_cars2_Price" class="cars2_Price">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2->Price->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars2->Price->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars2->Price->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2->PictureName->Visible) { // PictureName ?>
	<?php if ($cars2->sortUrl($cars2->PictureName) == "") { ?>
		<th data-name="PictureName" class="<?php echo $cars2->PictureName->headerCellClass() ?>"><div id="elh_cars2_PictureName" class="cars2_PictureName"><div class="ew-table-header-caption"><?php echo $cars2->PictureName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PictureName" class="<?php echo $cars2->PictureName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars2->SortUrl($cars2->PictureName) ?>',1);"><div id="elh_cars2_PictureName" class="cars2_PictureName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2->PictureName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cars2->PictureName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars2->PictureName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2->PictureSize->Visible) { // PictureSize ?>
	<?php if ($cars2->sortUrl($cars2->PictureSize) == "") { ?>
		<th data-name="PictureSize" class="<?php echo $cars2->PictureSize->headerCellClass() ?>"><div id="elh_cars2_PictureSize" class="cars2_PictureSize"><div class="ew-table-header-caption"><?php echo $cars2->PictureSize->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PictureSize" class="<?php echo $cars2->PictureSize->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars2->SortUrl($cars2->PictureSize) ?>',1);"><div id="elh_cars2_PictureSize" class="cars2_PictureSize">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2->PictureSize->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars2->PictureSize->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars2->PictureSize->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2->PictureType->Visible) { // PictureType ?>
	<?php if ($cars2->sortUrl($cars2->PictureType) == "") { ?>
		<th data-name="PictureType" class="<?php echo $cars2->PictureType->headerCellClass() ?>"><div id="elh_cars2_PictureType" class="cars2_PictureType"><div class="ew-table-header-caption"><?php echo $cars2->PictureType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PictureType" class="<?php echo $cars2->PictureType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars2->SortUrl($cars2->PictureType) ?>',1);"><div id="elh_cars2_PictureType" class="cars2_PictureType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2->PictureType->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cars2->PictureType->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars2->PictureType->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2->PictureWidth->Visible) { // PictureWidth ?>
	<?php if ($cars2->sortUrl($cars2->PictureWidth) == "") { ?>
		<th data-name="PictureWidth" class="<?php echo $cars2->PictureWidth->headerCellClass() ?>"><div id="elh_cars2_PictureWidth" class="cars2_PictureWidth"><div class="ew-table-header-caption"><?php echo $cars2->PictureWidth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PictureWidth" class="<?php echo $cars2->PictureWidth->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars2->SortUrl($cars2->PictureWidth) ?>',1);"><div id="elh_cars2_PictureWidth" class="cars2_PictureWidth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2->PictureWidth->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars2->PictureWidth->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars2->PictureWidth->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2->PictureHeight->Visible) { // PictureHeight ?>
	<?php if ($cars2->sortUrl($cars2->PictureHeight) == "") { ?>
		<th data-name="PictureHeight" class="<?php echo $cars2->PictureHeight->headerCellClass() ?>"><div id="elh_cars2_PictureHeight" class="cars2_PictureHeight"><div class="ew-table-header-caption"><?php echo $cars2->PictureHeight->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PictureHeight" class="<?php echo $cars2->PictureHeight->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars2->SortUrl($cars2->PictureHeight) ?>',1);"><div id="elh_cars2_PictureHeight" class="cars2_PictureHeight">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2->PictureHeight->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars2->PictureHeight->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars2->PictureHeight->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cars2_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($cars2->ExportAll && $cars2->isExport()) {
	$cars2_list->StopRec = $cars2_list->TotalRecs;
} else {

	// Set the last record to display
	if ($cars2_list->TotalRecs > $cars2_list->StartRec + $cars2_list->DisplayRecs - 1)
		$cars2_list->StopRec = $cars2_list->StartRec + $cars2_list->DisplayRecs - 1;
	else
		$cars2_list->StopRec = $cars2_list->TotalRecs;
}
$cars2_list->RecCnt = $cars2_list->StartRec - 1;
if ($cars2_list->Recordset && !$cars2_list->Recordset->EOF) {
	$cars2_list->Recordset->moveFirst();
	$selectLimit = $cars2_list->UseSelectLimit;
	if (!$selectLimit && $cars2_list->StartRec > 1)
		$cars2_list->Recordset->move($cars2_list->StartRec - 1);
} elseif (!$cars2->AllowAddDeleteRow && $cars2_list->StopRec == 0) {
	$cars2_list->StopRec = $cars2->GridAddRowCount;
}

// Initialize aggregate
$cars2->RowType = ROWTYPE_AGGREGATEINIT;
$cars2->resetAttributes();
$cars2_list->renderRow();
while ($cars2_list->RecCnt < $cars2_list->StopRec) {
	$cars2_list->RecCnt++;
	if ($cars2_list->RecCnt >= $cars2_list->StartRec) {
		$cars2_list->RowCnt++;

		// Set up key count
		$cars2_list->KeyCount = $cars2_list->RowIndex;

		// Init row class and style
		$cars2->resetAttributes();
		$cars2->CssClass = "";
		if ($cars2->isGridAdd()) {
		} else {
			$cars2_list->loadRowValues($cars2_list->Recordset); // Load row values
		}
		$cars2->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$cars2->RowAttrs = array_merge($cars2->RowAttrs, array('data-rowindex'=>$cars2_list->RowCnt, 'id'=>'r' . $cars2_list->RowCnt . '_cars2', 'data-rowtype'=>$cars2->RowType));

		// Render row
		$cars2_list->renderRow();

		// Render list options
		$cars2_list->renderListOptions();
?>
	<tr<?php echo $cars2->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cars2_list->ListOptions->render("body", "left", $cars2_list->RowCnt);
?>
	<?php if ($cars2->ID->Visible) { // ID ?>
		<td data-name="ID"<?php echo $cars2->ID->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCnt ?>_cars2_ID" class="cars2_ID">
<span<?php echo $cars2->ID->viewAttributes() ?>>
<?php echo $cars2->ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2->Trademark->Visible) { // Trademark ?>
		<td data-name="Trademark"<?php echo $cars2->Trademark->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCnt ?>_cars2_Trademark" class="cars2_Trademark">
<span<?php echo $cars2->Trademark->viewAttributes() ?>>
<?php echo $cars2->Trademark->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2->Model->Visible) { // Model ?>
		<td data-name="Model"<?php echo $cars2->Model->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCnt ?>_cars2_Model" class="cars2_Model">
<span<?php echo $cars2->Model->viewAttributes() ?>>
<?php echo $cars2->Model->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2->HP->Visible) { // HP ?>
		<td data-name="HP"<?php echo $cars2->HP->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCnt ?>_cars2_HP" class="cars2_HP">
<span<?php echo $cars2->HP->viewAttributes() ?>>
<?php echo $cars2->HP->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2->Liter->Visible) { // Liter ?>
		<td data-name="Liter"<?php echo $cars2->Liter->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCnt ?>_cars2_Liter" class="cars2_Liter">
<span<?php echo $cars2->Liter->viewAttributes() ?>>
<?php echo $cars2->Liter->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2->Cyl->Visible) { // Cyl ?>
		<td data-name="Cyl"<?php echo $cars2->Cyl->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCnt ?>_cars2_Cyl" class="cars2_Cyl">
<span<?php echo $cars2->Cyl->viewAttributes() ?>>
<?php echo $cars2->Cyl->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2->TransmissSpeedCount->Visible) { // TransmissSpeedCount ?>
		<td data-name="TransmissSpeedCount"<?php echo $cars2->TransmissSpeedCount->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCnt ?>_cars2_TransmissSpeedCount" class="cars2_TransmissSpeedCount">
<span<?php echo $cars2->TransmissSpeedCount->viewAttributes() ?>>
<?php echo $cars2->TransmissSpeedCount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2->TransmissAutomatic->Visible) { // TransmissAutomatic ?>
		<td data-name="TransmissAutomatic"<?php echo $cars2->TransmissAutomatic->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCnt ?>_cars2_TransmissAutomatic" class="cars2_TransmissAutomatic">
<span<?php echo $cars2->TransmissAutomatic->viewAttributes() ?>>
<?php echo $cars2->TransmissAutomatic->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2->MPG_City->Visible) { // MPG_City ?>
		<td data-name="MPG_City"<?php echo $cars2->MPG_City->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCnt ?>_cars2_MPG_City" class="cars2_MPG_City">
<span<?php echo $cars2->MPG_City->viewAttributes() ?>>
<?php echo $cars2->MPG_City->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2->MPG_Highway->Visible) { // MPG_Highway ?>
		<td data-name="MPG_Highway"<?php echo $cars2->MPG_Highway->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCnt ?>_cars2_MPG_Highway" class="cars2_MPG_Highway">
<span<?php echo $cars2->MPG_Highway->viewAttributes() ?>>
<?php echo $cars2->MPG_Highway->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2->Category->Visible) { // Category ?>
		<td data-name="Category"<?php echo $cars2->Category->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCnt ?>_cars2_Category" class="cars2_Category">
<span<?php echo $cars2->Category->viewAttributes() ?>>
<?php echo $cars2->Category->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2->Hyperlink->Visible) { // Hyperlink ?>
		<td data-name="Hyperlink"<?php echo $cars2->Hyperlink->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCnt ?>_cars2_Hyperlink" class="cars2_Hyperlink">
<span<?php echo $cars2->Hyperlink->viewAttributes() ?>>
<?php echo $cars2->Hyperlink->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2->Price->Visible) { // Price ?>
		<td data-name="Price"<?php echo $cars2->Price->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCnt ?>_cars2_Price" class="cars2_Price">
<span<?php echo $cars2->Price->viewAttributes() ?>>
<?php echo $cars2->Price->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2->PictureName->Visible) { // PictureName ?>
		<td data-name="PictureName"<?php echo $cars2->PictureName->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCnt ?>_cars2_PictureName" class="cars2_PictureName">
<span<?php echo $cars2->PictureName->viewAttributes() ?>>
<?php echo $cars2->PictureName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2->PictureSize->Visible) { // PictureSize ?>
		<td data-name="PictureSize"<?php echo $cars2->PictureSize->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCnt ?>_cars2_PictureSize" class="cars2_PictureSize">
<span<?php echo $cars2->PictureSize->viewAttributes() ?>>
<?php echo $cars2->PictureSize->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2->PictureType->Visible) { // PictureType ?>
		<td data-name="PictureType"<?php echo $cars2->PictureType->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCnt ?>_cars2_PictureType" class="cars2_PictureType">
<span<?php echo $cars2->PictureType->viewAttributes() ?>>
<?php echo $cars2->PictureType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2->PictureWidth->Visible) { // PictureWidth ?>
		<td data-name="PictureWidth"<?php echo $cars2->PictureWidth->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCnt ?>_cars2_PictureWidth" class="cars2_PictureWidth">
<span<?php echo $cars2->PictureWidth->viewAttributes() ?>>
<?php echo $cars2->PictureWidth->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2->PictureHeight->Visible) { // PictureHeight ?>
		<td data-name="PictureHeight"<?php echo $cars2->PictureHeight->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCnt ?>_cars2_PictureHeight" class="cars2_PictureHeight">
<span<?php echo $cars2->PictureHeight->viewAttributes() ?>>
<?php echo $cars2->PictureHeight->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cars2_list->ListOptions->render("body", "right", $cars2_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$cars2->isGridAdd())
		$cars2_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$cars2->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($cars2_list->Recordset)
	$cars2_list->Recordset->Close();
?>
<?php if (!$cars2->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$cars2->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($cars2_list->Pager)) $cars2_list->Pager = new PrevNextPager($cars2_list->StartRec, $cars2_list->DisplayRecs, $cars2_list->TotalRecs, $cars2_list->AutoHidePager) ?>
<?php if ($cars2_list->Pager->RecordCount > 0 && $cars2_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($cars2_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $cars2_list->pageUrl() ?>start=<?php echo $cars2_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($cars2_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $cars2_list->pageUrl() ?>start=<?php echo $cars2_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $cars2_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($cars2_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $cars2_list->pageUrl() ?>start=<?php echo $cars2_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($cars2_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $cars2_list->pageUrl() ?>start=<?php echo $cars2_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $cars2_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($cars2_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $cars2_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $cars2_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $cars2_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($cars2_list->TotalRecs > 0 && (!$cars2_list->AutoHidePageSizeSelector || $cars2_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="cars2">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($cars2_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($cars2_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($cars2_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($cars2->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($cars2_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($cars2_list->TotalRecs == 0 && !$cars2->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($cars2_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$cars2_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$cars2->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$cars2_list->terminate();
?>
