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
$employees_list = new employees_list();

// Run the page
$employees_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employees_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$employees->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var femployeeslist = currentForm = new ew.Form("femployeeslist", "list");
femployeeslist.formKeyCountName = '<?php echo $employees_list->FormKeyCountName ?>';

// Form_CustomValidate event
femployeeslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
femployeeslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
femployeeslist.lists["x_Activated[]"] = <?php echo $employees_list->Activated->Lookup->toClientList() ?>;
femployeeslist.lists["x_Activated[]"].options = <?php echo JsonEncode($employees_list->Activated->options(FALSE, TRUE)) ?>;

// Form object for search
var femployeeslistsrch = currentSearchForm = new ew.Form("femployeeslistsrch");

// Validate function for search
femployeeslistsrch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
femployeeslistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
femployeeslistsrch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
femployeeslistsrch.lists["x_Activated[]"] = <?php echo $employees_list->Activated->Lookup->toClientList() ?>;
femployeeslistsrch.lists["x_Activated[]"].options = <?php echo JsonEncode($employees_list->Activated->options(FALSE, TRUE)) ?>;

// Filters
femployeeslistsrch.filterList = <?php echo $employees_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$employees->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($employees_list->TotalRecs > 0 && $employees_list->ExportOptions->visible()) { ?>
<?php $employees_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($employees_list->ImportOptions->visible()) { ?>
<?php $employees_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($employees_list->SearchOptions->visible()) { ?>
<?php $employees_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($employees_list->FilterOptions->visible()) { ?>
<?php $employees_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$employees_list->renderOtherOptions();
?>
<?php if (!$employees->isExport() && !$employees->CurrentAction) { ?>
<form name="femployeeslistsrch" id="femployeeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($employees_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="femployeeslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="employees">
	<div class="ew-basic-search">
<?php
if ($SearchError == "")
	$employees_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$employees->RowType = ROWTYPE_SEARCH;

// Render row
$employees->resetAttributes();
$employees_list->renderRow();
?>
<div id="xsr_1" class="ew-row d-sm-flex">
<?php if ($employees->Activated->Visible) { // Activated ?>
	<div id="xsc_Activated" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $employees->Activated->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_Activated" id="z_Activated" value="="></span>
		<span class="ew-search-field">
<?php
$selwrk = (ConvertToBool($employees->Activated->AdvancedSearch->SearchValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="employees" data-field="x_Activated" name="x_Activated[]" id="x_Activated[]" value="1"<?php echo $selwrk ?><?php echo $employees->Activated->editAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($employees_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($employees_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $employees_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($employees_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($employees_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($employees_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($employees_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $employees_list->showPageHeader(); ?>
<?php
$employees_list->showMessage();
?>
<?php if ($employees_list->TotalRecs > 0 || $employees->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($employees_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> employees">
<?php if (!$employees->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$employees->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($employees_list->Pager)) $employees_list->Pager = new PrevNextPager($employees_list->StartRec, $employees_list->DisplayRecs, $employees_list->TotalRecs, $employees_list->AutoHidePager) ?>
<?php if ($employees_list->Pager->RecordCount > 0 && $employees_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($employees_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $employees_list->pageUrl() ?>start=<?php echo $employees_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($employees_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $employees_list->pageUrl() ?>start=<?php echo $employees_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $employees_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($employees_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $employees_list->pageUrl() ?>start=<?php echo $employees_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($employees_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $employees_list->pageUrl() ?>start=<?php echo $employees_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $employees_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($employees_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $employees_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $employees_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $employees_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($employees_list->TotalRecs > 0 && (!$employees_list->AutoHidePageSizeSelector || $employees_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="employees">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($employees_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($employees_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($employees_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($employees->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($employees_list->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="femployeeslist" id="femployeeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($employees_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $employees_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employees">
<div id="gmp_employees" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($employees_list->TotalRecs > 0 || $employees->isGridEdit()) { ?>
<table id="tbl_employeeslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$employees_list->RowType = ROWTYPE_HEADER;

// Render list options
$employees_list->renderListOptions();

// Render list options (header, left)
$employees_list->ListOptions->render("header", "left");
?>
<?php if ($employees->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($employees->sortUrl($employees->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $employees->EmployeeID->headerCellClass() ?>"><div id="elh_employees_EmployeeID" class="employees_EmployeeID"><div class="ew-table-header-caption"><?php echo $employees->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $employees->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $employees->SortUrl($employees->EmployeeID) ?>',1);"><div id="elh_employees_EmployeeID" class="employees_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($employees->EmployeeID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($employees->EmployeeID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees->LastName->Visible) { // LastName ?>
	<?php if ($employees->sortUrl($employees->LastName) == "") { ?>
		<th data-name="LastName" class="<?php echo $employees->LastName->headerCellClass() ?>"><div id="elh_employees_LastName" class="employees_LastName"><div class="ew-table-header-caption"><?php echo $employees->LastName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastName" class="<?php echo $employees->LastName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $employees->SortUrl($employees->LastName) ?>',1);"><div id="elh_employees_LastName" class="employees_LastName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees->LastName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees->LastName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($employees->LastName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees->FirstName->Visible) { // FirstName ?>
	<?php if ($employees->sortUrl($employees->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $employees->FirstName->headerCellClass() ?>"><div id="elh_employees_FirstName" class="employees_FirstName"><div class="ew-table-header-caption"><?php echo $employees->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $employees->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $employees->SortUrl($employees->FirstName) ?>',1);"><div id="elh_employees_FirstName" class="employees_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees->FirstName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($employees->FirstName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees->Title->Visible) { // Title ?>
	<?php if ($employees->sortUrl($employees->Title) == "") { ?>
		<th data-name="Title" class="<?php echo $employees->Title->headerCellClass() ?>"><div id="elh_employees_Title" class="employees_Title"><div class="ew-table-header-caption"><?php echo $employees->Title->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Title" class="<?php echo $employees->Title->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $employees->SortUrl($employees->Title) ?>',1);"><div id="elh_employees_Title" class="employees_Title">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees->Title->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees->Title->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($employees->Title->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees->TitleOfCourtesy->Visible) { // TitleOfCourtesy ?>
	<?php if ($employees->sortUrl($employees->TitleOfCourtesy) == "") { ?>
		<th data-name="TitleOfCourtesy" class="<?php echo $employees->TitleOfCourtesy->headerCellClass() ?>"><div id="elh_employees_TitleOfCourtesy" class="employees_TitleOfCourtesy"><div class="ew-table-header-caption"><?php echo $employees->TitleOfCourtesy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TitleOfCourtesy" class="<?php echo $employees->TitleOfCourtesy->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $employees->SortUrl($employees->TitleOfCourtesy) ?>',1);"><div id="elh_employees_TitleOfCourtesy" class="employees_TitleOfCourtesy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees->TitleOfCourtesy->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees->TitleOfCourtesy->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($employees->TitleOfCourtesy->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees->BirthDate->Visible) { // BirthDate ?>
	<?php if ($employees->sortUrl($employees->BirthDate) == "") { ?>
		<th data-name="BirthDate" class="<?php echo $employees->BirthDate->headerCellClass() ?>"><div id="elh_employees_BirthDate" class="employees_BirthDate"><div class="ew-table-header-caption"><?php echo $employees->BirthDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BirthDate" class="<?php echo $employees->BirthDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $employees->SortUrl($employees->BirthDate) ?>',1);"><div id="elh_employees_BirthDate" class="employees_BirthDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees->BirthDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($employees->BirthDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($employees->BirthDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees->HireDate->Visible) { // HireDate ?>
	<?php if ($employees->sortUrl($employees->HireDate) == "") { ?>
		<th data-name="HireDate" class="<?php echo $employees->HireDate->headerCellClass() ?>"><div id="elh_employees_HireDate" class="employees_HireDate"><div class="ew-table-header-caption"><?php echo $employees->HireDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="HireDate" class="<?php echo $employees->HireDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $employees->SortUrl($employees->HireDate) ?>',1);"><div id="elh_employees_HireDate" class="employees_HireDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees->HireDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($employees->HireDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($employees->HireDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees->Address->Visible) { // Address ?>
	<?php if ($employees->sortUrl($employees->Address) == "") { ?>
		<th data-name="Address" class="<?php echo $employees->Address->headerCellClass() ?>"><div id="elh_employees_Address" class="employees_Address"><div class="ew-table-header-caption"><?php echo $employees->Address->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Address" class="<?php echo $employees->Address->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $employees->SortUrl($employees->Address) ?>',1);"><div id="elh_employees_Address" class="employees_Address">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees->Address->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees->Address->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($employees->Address->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees->City->Visible) { // City ?>
	<?php if ($employees->sortUrl($employees->City) == "") { ?>
		<th data-name="City" class="<?php echo $employees->City->headerCellClass() ?>"><div id="elh_employees_City" class="employees_City"><div class="ew-table-header-caption"><?php echo $employees->City->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="City" class="<?php echo $employees->City->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $employees->SortUrl($employees->City) ?>',1);"><div id="elh_employees_City" class="employees_City">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees->City->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees->City->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($employees->City->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees->Region->Visible) { // Region ?>
	<?php if ($employees->sortUrl($employees->Region) == "") { ?>
		<th data-name="Region" class="<?php echo $employees->Region->headerCellClass() ?>"><div id="elh_employees_Region" class="employees_Region"><div class="ew-table-header-caption"><?php echo $employees->Region->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Region" class="<?php echo $employees->Region->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $employees->SortUrl($employees->Region) ?>',1);"><div id="elh_employees_Region" class="employees_Region">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees->Region->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees->Region->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($employees->Region->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees->PostalCode->Visible) { // PostalCode ?>
	<?php if ($employees->sortUrl($employees->PostalCode) == "") { ?>
		<th data-name="PostalCode" class="<?php echo $employees->PostalCode->headerCellClass() ?>"><div id="elh_employees_PostalCode" class="employees_PostalCode"><div class="ew-table-header-caption"><?php echo $employees->PostalCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PostalCode" class="<?php echo $employees->PostalCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $employees->SortUrl($employees->PostalCode) ?>',1);"><div id="elh_employees_PostalCode" class="employees_PostalCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees->PostalCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees->PostalCode->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($employees->PostalCode->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees->Country->Visible) { // Country ?>
	<?php if ($employees->sortUrl($employees->Country) == "") { ?>
		<th data-name="Country" class="<?php echo $employees->Country->headerCellClass() ?>"><div id="elh_employees_Country" class="employees_Country"><div class="ew-table-header-caption"><?php echo $employees->Country->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Country" class="<?php echo $employees->Country->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $employees->SortUrl($employees->Country) ?>',1);"><div id="elh_employees_Country" class="employees_Country">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees->Country->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees->Country->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($employees->Country->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees->HomePhone->Visible) { // HomePhone ?>
	<?php if ($employees->sortUrl($employees->HomePhone) == "") { ?>
		<th data-name="HomePhone" class="<?php echo $employees->HomePhone->headerCellClass() ?>"><div id="elh_employees_HomePhone" class="employees_HomePhone"><div class="ew-table-header-caption"><?php echo $employees->HomePhone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="HomePhone" class="<?php echo $employees->HomePhone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $employees->SortUrl($employees->HomePhone) ?>',1);"><div id="elh_employees_HomePhone" class="employees_HomePhone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees->HomePhone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees->HomePhone->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($employees->HomePhone->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees->Extension->Visible) { // Extension ?>
	<?php if ($employees->sortUrl($employees->Extension) == "") { ?>
		<th data-name="Extension" class="<?php echo $employees->Extension->headerCellClass() ?>"><div id="elh_employees_Extension" class="employees_Extension"><div class="ew-table-header-caption"><?php echo $employees->Extension->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Extension" class="<?php echo $employees->Extension->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $employees->SortUrl($employees->Extension) ?>',1);"><div id="elh_employees_Extension" class="employees_Extension">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees->Extension->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees->Extension->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($employees->Extension->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees->_Email->Visible) { // Email ?>
	<?php if ($employees->sortUrl($employees->_Email) == "") { ?>
		<th data-name="_Email" class="<?php echo $employees->_Email->headerCellClass() ?>"><div id="elh_employees__Email" class="employees__Email"><div class="ew-table-header-caption"><?php echo $employees->_Email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_Email" class="<?php echo $employees->_Email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $employees->SortUrl($employees->_Email) ?>',1);"><div id="elh_employees__Email" class="employees__Email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees->_Email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees->_Email->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($employees->_Email->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees->Photo->Visible) { // Photo ?>
	<?php if ($employees->sortUrl($employees->Photo) == "") { ?>
		<th data-name="Photo" class="<?php echo $employees->Photo->headerCellClass() ?>"><div id="elh_employees_Photo" class="employees_Photo"><div class="ew-table-header-caption"><?php echo $employees->Photo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Photo" class="<?php echo $employees->Photo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $employees->SortUrl($employees->Photo) ?>',1);"><div id="elh_employees_Photo" class="employees_Photo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees->Photo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees->Photo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($employees->Photo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees->ReportsTo->Visible) { // ReportsTo ?>
	<?php if ($employees->sortUrl($employees->ReportsTo) == "") { ?>
		<th data-name="ReportsTo" class="<?php echo $employees->ReportsTo->headerCellClass() ?>"><div id="elh_employees_ReportsTo" class="employees_ReportsTo"><div class="ew-table-header-caption"><?php echo $employees->ReportsTo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReportsTo" class="<?php echo $employees->ReportsTo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $employees->SortUrl($employees->ReportsTo) ?>',1);"><div id="elh_employees_ReportsTo" class="employees_ReportsTo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees->ReportsTo->caption() ?></span><span class="ew-table-header-sort"><?php if ($employees->ReportsTo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($employees->ReportsTo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees->Password->Visible) { // Password ?>
	<?php if ($employees->sortUrl($employees->Password) == "") { ?>
		<th data-name="Password" class="<?php echo $employees->Password->headerCellClass() ?>"><div id="elh_employees_Password" class="employees_Password"><div class="ew-table-header-caption"><?php echo $employees->Password->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Password" class="<?php echo $employees->Password->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $employees->SortUrl($employees->Password) ?>',1);"><div id="elh_employees_Password" class="employees_Password">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees->Password->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees->Password->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($employees->Password->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees->UserLevel->Visible) { // UserLevel ?>
	<?php if ($employees->sortUrl($employees->UserLevel) == "") { ?>
		<th data-name="UserLevel" class="<?php echo $employees->UserLevel->headerCellClass() ?>"><div id="elh_employees_UserLevel" class="employees_UserLevel"><div class="ew-table-header-caption"><?php echo $employees->UserLevel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UserLevel" class="<?php echo $employees->UserLevel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $employees->SortUrl($employees->UserLevel) ?>',1);"><div id="elh_employees_UserLevel" class="employees_UserLevel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees->UserLevel->caption() ?></span><span class="ew-table-header-sort"><?php if ($employees->UserLevel->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($employees->UserLevel->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees->Username->Visible) { // Username ?>
	<?php if ($employees->sortUrl($employees->Username) == "") { ?>
		<th data-name="Username" class="<?php echo $employees->Username->headerCellClass() ?>"><div id="elh_employees_Username" class="employees_Username"><div class="ew-table-header-caption"><?php echo $employees->Username->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Username" class="<?php echo $employees->Username->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $employees->SortUrl($employees->Username) ?>',1);"><div id="elh_employees_Username" class="employees_Username">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees->Username->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees->Username->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($employees->Username->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees->Activated->Visible) { // Activated ?>
	<?php if ($employees->sortUrl($employees->Activated) == "") { ?>
		<th data-name="Activated" class="<?php echo $employees->Activated->headerCellClass() ?>"><div id="elh_employees_Activated" class="employees_Activated"><div class="ew-table-header-caption"><?php echo $employees->Activated->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Activated" class="<?php echo $employees->Activated->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $employees->SortUrl($employees->Activated) ?>',1);"><div id="elh_employees_Activated" class="employees_Activated">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees->Activated->caption() ?></span><span class="ew-table-header-sort"><?php if ($employees->Activated->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($employees->Activated->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$employees_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($employees->ExportAll && $employees->isExport()) {
	$employees_list->StopRec = $employees_list->TotalRecs;
} else {

	// Set the last record to display
	if ($employees_list->TotalRecs > $employees_list->StartRec + $employees_list->DisplayRecs - 1)
		$employees_list->StopRec = $employees_list->StartRec + $employees_list->DisplayRecs - 1;
	else
		$employees_list->StopRec = $employees_list->TotalRecs;
}
$employees_list->RecCnt = $employees_list->StartRec - 1;
if ($employees_list->Recordset && !$employees_list->Recordset->EOF) {
	$employees_list->Recordset->moveFirst();
	$selectLimit = $employees_list->UseSelectLimit;
	if (!$selectLimit && $employees_list->StartRec > 1)
		$employees_list->Recordset->move($employees_list->StartRec - 1);
} elseif (!$employees->AllowAddDeleteRow && $employees_list->StopRec == 0) {
	$employees_list->StopRec = $employees->GridAddRowCount;
}

// Initialize aggregate
$employees->RowType = ROWTYPE_AGGREGATEINIT;
$employees->resetAttributes();
$employees_list->renderRow();
while ($employees_list->RecCnt < $employees_list->StopRec) {
	$employees_list->RecCnt++;
	if ($employees_list->RecCnt >= $employees_list->StartRec) {
		$employees_list->RowCnt++;

		// Set up key count
		$employees_list->KeyCount = $employees_list->RowIndex;

		// Init row class and style
		$employees->resetAttributes();
		$employees->CssClass = "";
		if ($employees->isGridAdd()) {
		} else {
			$employees_list->loadRowValues($employees_list->Recordset); // Load row values
		}
		$employees->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$employees->RowAttrs = array_merge($employees->RowAttrs, array('data-rowindex'=>$employees_list->RowCnt, 'id'=>'r' . $employees_list->RowCnt . '_employees', 'data-rowtype'=>$employees->RowType));

		// Render row
		$employees_list->renderRow();

		// Render list options
		$employees_list->renderListOptions();
?>
	<tr<?php echo $employees->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employees_list->ListOptions->render("body", "left", $employees_list->RowCnt);
?>
	<?php if ($employees->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID"<?php echo $employees->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCnt ?>_employees_EmployeeID" class="employees_EmployeeID">
<span<?php echo $employees->EmployeeID->viewAttributes() ?>>
<?php echo $employees->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees->LastName->Visible) { // LastName ?>
		<td data-name="LastName"<?php echo $employees->LastName->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCnt ?>_employees_LastName" class="employees_LastName">
<span<?php echo $employees->LastName->viewAttributes() ?>>
<?php echo $employees->LastName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName"<?php echo $employees->FirstName->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCnt ?>_employees_FirstName" class="employees_FirstName">
<span<?php echo $employees->FirstName->viewAttributes() ?>>
<?php echo $employees->FirstName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees->Title->Visible) { // Title ?>
		<td data-name="Title"<?php echo $employees->Title->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCnt ?>_employees_Title" class="employees_Title">
<span<?php echo $employees->Title->viewAttributes() ?>>
<?php echo $employees->Title->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees->TitleOfCourtesy->Visible) { // TitleOfCourtesy ?>
		<td data-name="TitleOfCourtesy"<?php echo $employees->TitleOfCourtesy->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCnt ?>_employees_TitleOfCourtesy" class="employees_TitleOfCourtesy">
<span<?php echo $employees->TitleOfCourtesy->viewAttributes() ?>>
<?php echo $employees->TitleOfCourtesy->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees->BirthDate->Visible) { // BirthDate ?>
		<td data-name="BirthDate"<?php echo $employees->BirthDate->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCnt ?>_employees_BirthDate" class="employees_BirthDate">
<span<?php echo $employees->BirthDate->viewAttributes() ?>>
<?php echo $employees->BirthDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees->HireDate->Visible) { // HireDate ?>
		<td data-name="HireDate"<?php echo $employees->HireDate->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCnt ?>_employees_HireDate" class="employees_HireDate">
<span<?php echo $employees->HireDate->viewAttributes() ?>>
<?php echo $employees->HireDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees->Address->Visible) { // Address ?>
		<td data-name="Address"<?php echo $employees->Address->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCnt ?>_employees_Address" class="employees_Address">
<span<?php echo $employees->Address->viewAttributes() ?>>
<?php echo $employees->Address->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees->City->Visible) { // City ?>
		<td data-name="City"<?php echo $employees->City->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCnt ?>_employees_City" class="employees_City">
<span<?php echo $employees->City->viewAttributes() ?>>
<?php echo $employees->City->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees->Region->Visible) { // Region ?>
		<td data-name="Region"<?php echo $employees->Region->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCnt ?>_employees_Region" class="employees_Region">
<span<?php echo $employees->Region->viewAttributes() ?>>
<?php echo $employees->Region->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees->PostalCode->Visible) { // PostalCode ?>
		<td data-name="PostalCode"<?php echo $employees->PostalCode->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCnt ?>_employees_PostalCode" class="employees_PostalCode">
<span<?php echo $employees->PostalCode->viewAttributes() ?>>
<?php echo $employees->PostalCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees->Country->Visible) { // Country ?>
		<td data-name="Country"<?php echo $employees->Country->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCnt ?>_employees_Country" class="employees_Country">
<span<?php echo $employees->Country->viewAttributes() ?>>
<?php echo $employees->Country->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees->HomePhone->Visible) { // HomePhone ?>
		<td data-name="HomePhone"<?php echo $employees->HomePhone->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCnt ?>_employees_HomePhone" class="employees_HomePhone">
<span<?php echo $employees->HomePhone->viewAttributes() ?>>
<?php echo $employees->HomePhone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees->Extension->Visible) { // Extension ?>
		<td data-name="Extension"<?php echo $employees->Extension->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCnt ?>_employees_Extension" class="employees_Extension">
<span<?php echo $employees->Extension->viewAttributes() ?>>
<?php echo $employees->Extension->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees->_Email->Visible) { // Email ?>
		<td data-name="_Email"<?php echo $employees->_Email->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCnt ?>_employees__Email" class="employees__Email">
<span<?php echo $employees->_Email->viewAttributes() ?>>
<?php echo $employees->_Email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees->Photo->Visible) { // Photo ?>
		<td data-name="Photo"<?php echo $employees->Photo->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCnt ?>_employees_Photo" class="employees_Photo">
<span<?php echo $employees->Photo->viewAttributes() ?>>
<?php echo $employees->Photo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees->ReportsTo->Visible) { // ReportsTo ?>
		<td data-name="ReportsTo"<?php echo $employees->ReportsTo->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCnt ?>_employees_ReportsTo" class="employees_ReportsTo">
<span<?php echo $employees->ReportsTo->viewAttributes() ?>>
<?php echo $employees->ReportsTo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees->Password->Visible) { // Password ?>
		<td data-name="Password"<?php echo $employees->Password->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCnt ?>_employees_Password" class="employees_Password">
<span<?php echo $employees->Password->viewAttributes() ?>>
<?php echo $employees->Password->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees->UserLevel->Visible) { // UserLevel ?>
		<td data-name="UserLevel"<?php echo $employees->UserLevel->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCnt ?>_employees_UserLevel" class="employees_UserLevel">
<span<?php echo $employees->UserLevel->viewAttributes() ?>>
<?php echo $employees->UserLevel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees->Username->Visible) { // Username ?>
		<td data-name="Username"<?php echo $employees->Username->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCnt ?>_employees_Username" class="employees_Username">
<span<?php echo $employees->Username->viewAttributes() ?>>
<?php echo $employees->Username->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees->Activated->Visible) { // Activated ?>
		<td data-name="Activated"<?php echo $employees->Activated->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCnt ?>_employees_Activated" class="employees_Activated">
<span<?php echo $employees->Activated->viewAttributes() ?>>
<?php if (ConvertToBool($employees->Activated->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $employees->Activated->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $employees->Activated->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employees_list->ListOptions->render("body", "right", $employees_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$employees->isGridAdd())
		$employees_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$employees->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($employees_list->Recordset)
	$employees_list->Recordset->Close();
?>
<?php if (!$employees->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$employees->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($employees_list->Pager)) $employees_list->Pager = new PrevNextPager($employees_list->StartRec, $employees_list->DisplayRecs, $employees_list->TotalRecs, $employees_list->AutoHidePager) ?>
<?php if ($employees_list->Pager->RecordCount > 0 && $employees_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($employees_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $employees_list->pageUrl() ?>start=<?php echo $employees_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($employees_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $employees_list->pageUrl() ?>start=<?php echo $employees_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $employees_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($employees_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $employees_list->pageUrl() ?>start=<?php echo $employees_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($employees_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $employees_list->pageUrl() ?>start=<?php echo $employees_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $employees_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($employees_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $employees_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $employees_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $employees_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($employees_list->TotalRecs > 0 && (!$employees_list->AutoHidePageSizeSelector || $employees_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="employees">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($employees_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($employees_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($employees_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($employees->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($employees_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($employees_list->TotalRecs == 0 && !$employees->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($employees_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$employees_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$employees->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$employees_list->terminate();
?>
