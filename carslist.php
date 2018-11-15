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
$cars_list = new cars_list();

// Run the page
$cars_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cars_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$cars->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fcarslist = currentForm = new ew.Form("fcarslist", "list");
fcarslist.formKeyCountName = '<?php echo $cars_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcarslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcarslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fcarslistsrch = currentSearchForm = new ew.Form("fcarslistsrch");

// Filters
fcarslistsrch.filterList = <?php echo $cars_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$cars->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($cars_list->TotalRecs > 0 && $cars_list->ExportOptions->visible()) { ?>
<?php $cars_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($cars_list->ImportOptions->visible()) { ?>
<?php $cars_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($cars_list->SearchOptions->visible()) { ?>
<?php $cars_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($cars_list->FilterOptions->visible()) { ?>
<?php $cars_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$cars_list->renderOtherOptions();
?>
<?php if (!$cars->isExport() && !$cars->CurrentAction) { ?>
<form name="fcarslistsrch" id="fcarslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($cars_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fcarslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="cars">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($cars_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($cars_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $cars_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($cars_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($cars_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($cars_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($cars_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $cars_list->showPageHeader(); ?>
<?php
$cars_list->showMessage();
?>
<?php if ($cars_list->TotalRecs > 0 || $cars->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($cars_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cars">
<?php if (!$cars->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$cars->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($cars_list->Pager)) $cars_list->Pager = new PrevNextPager($cars_list->StartRec, $cars_list->DisplayRecs, $cars_list->TotalRecs, $cars_list->AutoHidePager) ?>
<?php if ($cars_list->Pager->RecordCount > 0 && $cars_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($cars_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $cars_list->pageUrl() ?>start=<?php echo $cars_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($cars_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $cars_list->pageUrl() ?>start=<?php echo $cars_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $cars_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($cars_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $cars_list->pageUrl() ?>start=<?php echo $cars_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($cars_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $cars_list->pageUrl() ?>start=<?php echo $cars_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $cars_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($cars_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $cars_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $cars_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $cars_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($cars_list->TotalRecs > 0 && (!$cars_list->AutoHidePageSizeSelector || $cars_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="cars">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($cars_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($cars_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($cars_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($cars->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($cars_list->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcarslist" id="fcarslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cars_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cars_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cars">
<div id="gmp_cars" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($cars_list->TotalRecs > 0 || $cars->isGridEdit()) { ?>
<table id="tbl_carslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$cars_list->RowType = ROWTYPE_HEADER;

// Render list options
$cars_list->renderListOptions();

// Render list options (header, left)
$cars_list->ListOptions->render("header", "left");
?>
<?php if ($cars->ID->Visible) { // ID ?>
	<?php if ($cars->sortUrl($cars->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $cars->ID->headerCellClass() ?>"><div id="elh_cars_ID" class="cars_ID"><div class="ew-table-header-caption"><?php echo $cars->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $cars->ID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars->SortUrl($cars->ID) ?>',1);"><div id="elh_cars_ID" class="cars_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars->ID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars->ID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars->Trademark->Visible) { // Trademark ?>
	<?php if ($cars->sortUrl($cars->Trademark) == "") { ?>
		<th data-name="Trademark" class="<?php echo $cars->Trademark->headerCellClass() ?>"><div id="elh_cars_Trademark" class="cars_Trademark"><div class="ew-table-header-caption"><?php echo $cars->Trademark->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Trademark" class="<?php echo $cars->Trademark->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars->SortUrl($cars->Trademark) ?>',1);"><div id="elh_cars_Trademark" class="cars_Trademark">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars->Trademark->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars->Trademark->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars->Trademark->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars->Model->Visible) { // Model ?>
	<?php if ($cars->sortUrl($cars->Model) == "") { ?>
		<th data-name="Model" class="<?php echo $cars->Model->headerCellClass() ?>"><div id="elh_cars_Model" class="cars_Model"><div class="ew-table-header-caption"><?php echo $cars->Model->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Model" class="<?php echo $cars->Model->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars->SortUrl($cars->Model) ?>',1);"><div id="elh_cars_Model" class="cars_Model">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars->Model->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars->Model->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars->Model->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars->HP->Visible) { // HP ?>
	<?php if ($cars->sortUrl($cars->HP) == "") { ?>
		<th data-name="HP" class="<?php echo $cars->HP->headerCellClass() ?>"><div id="elh_cars_HP" class="cars_HP"><div class="ew-table-header-caption"><?php echo $cars->HP->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="HP" class="<?php echo $cars->HP->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars->SortUrl($cars->HP) ?>',1);"><div id="elh_cars_HP" class="cars_HP">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars->HP->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars->HP->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars->HP->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars->Liter->Visible) { // Liter ?>
	<?php if ($cars->sortUrl($cars->Liter) == "") { ?>
		<th data-name="Liter" class="<?php echo $cars->Liter->headerCellClass() ?>"><div id="elh_cars_Liter" class="cars_Liter"><div class="ew-table-header-caption"><?php echo $cars->Liter->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Liter" class="<?php echo $cars->Liter->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars->SortUrl($cars->Liter) ?>',1);"><div id="elh_cars_Liter" class="cars_Liter">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars->Liter->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars->Liter->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars->Liter->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars->Cyl->Visible) { // Cyl ?>
	<?php if ($cars->sortUrl($cars->Cyl) == "") { ?>
		<th data-name="Cyl" class="<?php echo $cars->Cyl->headerCellClass() ?>"><div id="elh_cars_Cyl" class="cars_Cyl"><div class="ew-table-header-caption"><?php echo $cars->Cyl->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Cyl" class="<?php echo $cars->Cyl->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars->SortUrl($cars->Cyl) ?>',1);"><div id="elh_cars_Cyl" class="cars_Cyl">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars->Cyl->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars->Cyl->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars->Cyl->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars->TransmissSpeedCount->Visible) { // TransmissSpeedCount ?>
	<?php if ($cars->sortUrl($cars->TransmissSpeedCount) == "") { ?>
		<th data-name="TransmissSpeedCount" class="<?php echo $cars->TransmissSpeedCount->headerCellClass() ?>"><div id="elh_cars_TransmissSpeedCount" class="cars_TransmissSpeedCount"><div class="ew-table-header-caption"><?php echo $cars->TransmissSpeedCount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TransmissSpeedCount" class="<?php echo $cars->TransmissSpeedCount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars->SortUrl($cars->TransmissSpeedCount) ?>',1);"><div id="elh_cars_TransmissSpeedCount" class="cars_TransmissSpeedCount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars->TransmissSpeedCount->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars->TransmissSpeedCount->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars->TransmissSpeedCount->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars->TransmissAutomatic->Visible) { // TransmissAutomatic ?>
	<?php if ($cars->sortUrl($cars->TransmissAutomatic) == "") { ?>
		<th data-name="TransmissAutomatic" class="<?php echo $cars->TransmissAutomatic->headerCellClass() ?>"><div id="elh_cars_TransmissAutomatic" class="cars_TransmissAutomatic"><div class="ew-table-header-caption"><?php echo $cars->TransmissAutomatic->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TransmissAutomatic" class="<?php echo $cars->TransmissAutomatic->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars->SortUrl($cars->TransmissAutomatic) ?>',1);"><div id="elh_cars_TransmissAutomatic" class="cars_TransmissAutomatic">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars->TransmissAutomatic->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cars->TransmissAutomatic->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars->TransmissAutomatic->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars->MPG_City->Visible) { // MPG_City ?>
	<?php if ($cars->sortUrl($cars->MPG_City) == "") { ?>
		<th data-name="MPG_City" class="<?php echo $cars->MPG_City->headerCellClass() ?>"><div id="elh_cars_MPG_City" class="cars_MPG_City"><div class="ew-table-header-caption"><?php echo $cars->MPG_City->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MPG_City" class="<?php echo $cars->MPG_City->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars->SortUrl($cars->MPG_City) ?>',1);"><div id="elh_cars_MPG_City" class="cars_MPG_City">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars->MPG_City->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars->MPG_City->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars->MPG_City->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars->MPG_Highway->Visible) { // MPG_Highway ?>
	<?php if ($cars->sortUrl($cars->MPG_Highway) == "") { ?>
		<th data-name="MPG_Highway" class="<?php echo $cars->MPG_Highway->headerCellClass() ?>"><div id="elh_cars_MPG_Highway" class="cars_MPG_Highway"><div class="ew-table-header-caption"><?php echo $cars->MPG_Highway->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MPG_Highway" class="<?php echo $cars->MPG_Highway->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars->SortUrl($cars->MPG_Highway) ?>',1);"><div id="elh_cars_MPG_Highway" class="cars_MPG_Highway">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars->MPG_Highway->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars->MPG_Highway->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars->MPG_Highway->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars->Category->Visible) { // Category ?>
	<?php if ($cars->sortUrl($cars->Category) == "") { ?>
		<th data-name="Category" class="<?php echo $cars->Category->headerCellClass() ?>"><div id="elh_cars_Category" class="cars_Category"><div class="ew-table-header-caption"><?php echo $cars->Category->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Category" class="<?php echo $cars->Category->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars->SortUrl($cars->Category) ?>',1);"><div id="elh_cars_Category" class="cars_Category">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars->Category->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cars->Category->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars->Category->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars->Hyperlink->Visible) { // Hyperlink ?>
	<?php if ($cars->sortUrl($cars->Hyperlink) == "") { ?>
		<th data-name="Hyperlink" class="<?php echo $cars->Hyperlink->headerCellClass() ?>"><div id="elh_cars_Hyperlink" class="cars_Hyperlink"><div class="ew-table-header-caption"><?php echo $cars->Hyperlink->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Hyperlink" class="<?php echo $cars->Hyperlink->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars->SortUrl($cars->Hyperlink) ?>',1);"><div id="elh_cars_Hyperlink" class="cars_Hyperlink">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars->Hyperlink->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cars->Hyperlink->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars->Hyperlink->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars->Price->Visible) { // Price ?>
	<?php if ($cars->sortUrl($cars->Price) == "") { ?>
		<th data-name="Price" class="<?php echo $cars->Price->headerCellClass() ?>"><div id="elh_cars_Price" class="cars_Price"><div class="ew-table-header-caption"><?php echo $cars->Price->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Price" class="<?php echo $cars->Price->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars->SortUrl($cars->Price) ?>',1);"><div id="elh_cars_Price" class="cars_Price">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars->Price->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars->Price->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars->Price->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars->PictureName->Visible) { // PictureName ?>
	<?php if ($cars->sortUrl($cars->PictureName) == "") { ?>
		<th data-name="PictureName" class="<?php echo $cars->PictureName->headerCellClass() ?>"><div id="elh_cars_PictureName" class="cars_PictureName"><div class="ew-table-header-caption"><?php echo $cars->PictureName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PictureName" class="<?php echo $cars->PictureName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars->SortUrl($cars->PictureName) ?>',1);"><div id="elh_cars_PictureName" class="cars_PictureName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars->PictureName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cars->PictureName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars->PictureName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars->PictureSize->Visible) { // PictureSize ?>
	<?php if ($cars->sortUrl($cars->PictureSize) == "") { ?>
		<th data-name="PictureSize" class="<?php echo $cars->PictureSize->headerCellClass() ?>"><div id="elh_cars_PictureSize" class="cars_PictureSize"><div class="ew-table-header-caption"><?php echo $cars->PictureSize->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PictureSize" class="<?php echo $cars->PictureSize->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars->SortUrl($cars->PictureSize) ?>',1);"><div id="elh_cars_PictureSize" class="cars_PictureSize">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars->PictureSize->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars->PictureSize->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars->PictureSize->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars->PictureType->Visible) { // PictureType ?>
	<?php if ($cars->sortUrl($cars->PictureType) == "") { ?>
		<th data-name="PictureType" class="<?php echo $cars->PictureType->headerCellClass() ?>"><div id="elh_cars_PictureType" class="cars_PictureType"><div class="ew-table-header-caption"><?php echo $cars->PictureType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PictureType" class="<?php echo $cars->PictureType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars->SortUrl($cars->PictureType) ?>',1);"><div id="elh_cars_PictureType" class="cars_PictureType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars->PictureType->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cars->PictureType->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars->PictureType->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars->PictureWidth->Visible) { // PictureWidth ?>
	<?php if ($cars->sortUrl($cars->PictureWidth) == "") { ?>
		<th data-name="PictureWidth" class="<?php echo $cars->PictureWidth->headerCellClass() ?>"><div id="elh_cars_PictureWidth" class="cars_PictureWidth"><div class="ew-table-header-caption"><?php echo $cars->PictureWidth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PictureWidth" class="<?php echo $cars->PictureWidth->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars->SortUrl($cars->PictureWidth) ?>',1);"><div id="elh_cars_PictureWidth" class="cars_PictureWidth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars->PictureWidth->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars->PictureWidth->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars->PictureWidth->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars->PictureHeight->Visible) { // PictureHeight ?>
	<?php if ($cars->sortUrl($cars->PictureHeight) == "") { ?>
		<th data-name="PictureHeight" class="<?php echo $cars->PictureHeight->headerCellClass() ?>"><div id="elh_cars_PictureHeight" class="cars_PictureHeight"><div class="ew-table-header-caption"><?php echo $cars->PictureHeight->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PictureHeight" class="<?php echo $cars->PictureHeight->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars->SortUrl($cars->PictureHeight) ?>',1);"><div id="elh_cars_PictureHeight" class="cars_PictureHeight">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars->PictureHeight->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars->PictureHeight->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars->PictureHeight->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars->Color->Visible) { // Color ?>
	<?php if ($cars->sortUrl($cars->Color) == "") { ?>
		<th data-name="Color" class="<?php echo $cars->Color->headerCellClass() ?>"><div id="elh_cars_Color" class="cars_Color"><div class="ew-table-header-caption"><?php echo $cars->Color->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Color" class="<?php echo $cars->Color->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cars->SortUrl($cars->Color) ?>',1);"><div id="elh_cars_Color" class="cars_Color">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars->Color->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cars->Color->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cars->Color->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cars_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($cars->ExportAll && $cars->isExport()) {
	$cars_list->StopRec = $cars_list->TotalRecs;
} else {

	// Set the last record to display
	if ($cars_list->TotalRecs > $cars_list->StartRec + $cars_list->DisplayRecs - 1)
		$cars_list->StopRec = $cars_list->StartRec + $cars_list->DisplayRecs - 1;
	else
		$cars_list->StopRec = $cars_list->TotalRecs;
}
$cars_list->RecCnt = $cars_list->StartRec - 1;
if ($cars_list->Recordset && !$cars_list->Recordset->EOF) {
	$cars_list->Recordset->moveFirst();
	$selectLimit = $cars_list->UseSelectLimit;
	if (!$selectLimit && $cars_list->StartRec > 1)
		$cars_list->Recordset->move($cars_list->StartRec - 1);
} elseif (!$cars->AllowAddDeleteRow && $cars_list->StopRec == 0) {
	$cars_list->StopRec = $cars->GridAddRowCount;
}

// Initialize aggregate
$cars->RowType = ROWTYPE_AGGREGATEINIT;
$cars->resetAttributes();
$cars_list->renderRow();
while ($cars_list->RecCnt < $cars_list->StopRec) {
	$cars_list->RecCnt++;
	if ($cars_list->RecCnt >= $cars_list->StartRec) {
		$cars_list->RowCnt++;

		// Set up key count
		$cars_list->KeyCount = $cars_list->RowIndex;

		// Init row class and style
		$cars->resetAttributes();
		$cars->CssClass = "";
		if ($cars->isGridAdd()) {
		} else {
			$cars_list->loadRowValues($cars_list->Recordset); // Load row values
		}
		$cars->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$cars->RowAttrs = array_merge($cars->RowAttrs, array('data-rowindex'=>$cars_list->RowCnt, 'id'=>'r' . $cars_list->RowCnt . '_cars', 'data-rowtype'=>$cars->RowType));

		// Render row
		$cars_list->renderRow();

		// Render list options
		$cars_list->renderListOptions();
?>
	<tr<?php echo $cars->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cars_list->ListOptions->render("body", "left", $cars_list->RowCnt);
?>
	<?php if ($cars->ID->Visible) { // ID ?>
		<td data-name="ID"<?php echo $cars->ID->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCnt ?>_cars_ID" class="cars_ID">
<span<?php echo $cars->ID->viewAttributes() ?>>
<?php echo $cars->ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars->Trademark->Visible) { // Trademark ?>
		<td data-name="Trademark"<?php echo $cars->Trademark->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCnt ?>_cars_Trademark" class="cars_Trademark">
<span<?php echo $cars->Trademark->viewAttributes() ?>>
<?php echo $cars->Trademark->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars->Model->Visible) { // Model ?>
		<td data-name="Model"<?php echo $cars->Model->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCnt ?>_cars_Model" class="cars_Model">
<span<?php echo $cars->Model->viewAttributes() ?>>
<?php echo $cars->Model->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars->HP->Visible) { // HP ?>
		<td data-name="HP"<?php echo $cars->HP->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCnt ?>_cars_HP" class="cars_HP">
<span<?php echo $cars->HP->viewAttributes() ?>>
<?php echo $cars->HP->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars->Liter->Visible) { // Liter ?>
		<td data-name="Liter"<?php echo $cars->Liter->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCnt ?>_cars_Liter" class="cars_Liter">
<span<?php echo $cars->Liter->viewAttributes() ?>>
<?php echo $cars->Liter->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars->Cyl->Visible) { // Cyl ?>
		<td data-name="Cyl"<?php echo $cars->Cyl->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCnt ?>_cars_Cyl" class="cars_Cyl">
<span<?php echo $cars->Cyl->viewAttributes() ?>>
<?php echo $cars->Cyl->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars->TransmissSpeedCount->Visible) { // TransmissSpeedCount ?>
		<td data-name="TransmissSpeedCount"<?php echo $cars->TransmissSpeedCount->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCnt ?>_cars_TransmissSpeedCount" class="cars_TransmissSpeedCount">
<span<?php echo $cars->TransmissSpeedCount->viewAttributes() ?>>
<?php echo $cars->TransmissSpeedCount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars->TransmissAutomatic->Visible) { // TransmissAutomatic ?>
		<td data-name="TransmissAutomatic"<?php echo $cars->TransmissAutomatic->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCnt ?>_cars_TransmissAutomatic" class="cars_TransmissAutomatic">
<span<?php echo $cars->TransmissAutomatic->viewAttributes() ?>>
<?php echo $cars->TransmissAutomatic->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars->MPG_City->Visible) { // MPG_City ?>
		<td data-name="MPG_City"<?php echo $cars->MPG_City->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCnt ?>_cars_MPG_City" class="cars_MPG_City">
<span<?php echo $cars->MPG_City->viewAttributes() ?>>
<?php echo $cars->MPG_City->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars->MPG_Highway->Visible) { // MPG_Highway ?>
		<td data-name="MPG_Highway"<?php echo $cars->MPG_Highway->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCnt ?>_cars_MPG_Highway" class="cars_MPG_Highway">
<span<?php echo $cars->MPG_Highway->viewAttributes() ?>>
<?php echo $cars->MPG_Highway->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars->Category->Visible) { // Category ?>
		<td data-name="Category"<?php echo $cars->Category->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCnt ?>_cars_Category" class="cars_Category">
<span<?php echo $cars->Category->viewAttributes() ?>>
<?php echo $cars->Category->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars->Hyperlink->Visible) { // Hyperlink ?>
		<td data-name="Hyperlink"<?php echo $cars->Hyperlink->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCnt ?>_cars_Hyperlink" class="cars_Hyperlink">
<span<?php echo $cars->Hyperlink->viewAttributes() ?>>
<?php echo $cars->Hyperlink->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars->Price->Visible) { // Price ?>
		<td data-name="Price"<?php echo $cars->Price->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCnt ?>_cars_Price" class="cars_Price">
<span<?php echo $cars->Price->viewAttributes() ?>>
<?php echo $cars->Price->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars->PictureName->Visible) { // PictureName ?>
		<td data-name="PictureName"<?php echo $cars->PictureName->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCnt ?>_cars_PictureName" class="cars_PictureName">
<span<?php echo $cars->PictureName->viewAttributes() ?>>
<?php echo $cars->PictureName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars->PictureSize->Visible) { // PictureSize ?>
		<td data-name="PictureSize"<?php echo $cars->PictureSize->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCnt ?>_cars_PictureSize" class="cars_PictureSize">
<span<?php echo $cars->PictureSize->viewAttributes() ?>>
<?php echo $cars->PictureSize->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars->PictureType->Visible) { // PictureType ?>
		<td data-name="PictureType"<?php echo $cars->PictureType->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCnt ?>_cars_PictureType" class="cars_PictureType">
<span<?php echo $cars->PictureType->viewAttributes() ?>>
<?php echo $cars->PictureType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars->PictureWidth->Visible) { // PictureWidth ?>
		<td data-name="PictureWidth"<?php echo $cars->PictureWidth->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCnt ?>_cars_PictureWidth" class="cars_PictureWidth">
<span<?php echo $cars->PictureWidth->viewAttributes() ?>>
<?php echo $cars->PictureWidth->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars->PictureHeight->Visible) { // PictureHeight ?>
		<td data-name="PictureHeight"<?php echo $cars->PictureHeight->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCnt ?>_cars_PictureHeight" class="cars_PictureHeight">
<span<?php echo $cars->PictureHeight->viewAttributes() ?>>
<?php echo $cars->PictureHeight->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars->Color->Visible) { // Color ?>
		<td data-name="Color"<?php echo $cars->Color->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCnt ?>_cars_Color" class="cars_Color">
<span<?php echo $cars->Color->viewAttributes() ?>>
<?php echo $cars->Color->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cars_list->ListOptions->render("body", "right", $cars_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$cars->isGridAdd())
		$cars_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$cars->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($cars_list->Recordset)
	$cars_list->Recordset->Close();
?>
<?php if (!$cars->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$cars->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($cars_list->Pager)) $cars_list->Pager = new PrevNextPager($cars_list->StartRec, $cars_list->DisplayRecs, $cars_list->TotalRecs, $cars_list->AutoHidePager) ?>
<?php if ($cars_list->Pager->RecordCount > 0 && $cars_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($cars_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $cars_list->pageUrl() ?>start=<?php echo $cars_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($cars_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $cars_list->pageUrl() ?>start=<?php echo $cars_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $cars_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($cars_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $cars_list->pageUrl() ?>start=<?php echo $cars_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($cars_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $cars_list->pageUrl() ?>start=<?php echo $cars_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $cars_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($cars_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $cars_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $cars_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $cars_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($cars_list->TotalRecs > 0 && (!$cars_list->AutoHidePageSizeSelector || $cars_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="cars">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($cars_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($cars_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($cars_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($cars->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($cars_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($cars_list->TotalRecs == 0 && !$cars->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($cars_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$cars_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$cars->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$cars_list->terminate();
?>
