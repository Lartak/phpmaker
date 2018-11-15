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
$employees_view = new employees_view();

// Run the page
$employees_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employees_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$employees->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var femployeesview = currentForm = new ew.Form("femployeesview", "view");

// Form_CustomValidate event
femployeesview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
femployeesview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
femployeesview.lists["x_Activated[]"] = <?php echo $employees_view->Activated->Lookup->toClientList() ?>;
femployeesview.lists["x_Activated[]"].options = <?php echo JsonEncode($employees_view->Activated->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$employees->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $employees_view->ExportOptions->render("body") ?>
<?php
	foreach ($employees_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $employees_view->showPageHeader(); ?>
<?php
$employees_view->showMessage();
?>
<?php if (!$employees_view->IsModal) { ?>
<?php if (!$employees->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($employees_view->Pager)) $employees_view->Pager = new PrevNextPager($employees_view->StartRec, $employees_view->DisplayRecs, $employees_view->TotalRecs, $employees_view->AutoHidePager) ?>
<?php if ($employees_view->Pager->RecordCount > 0 && $employees_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($employees_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $employees_view->pageUrl() ?>start=<?php echo $employees_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($employees_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $employees_view->pageUrl() ?>start=<?php echo $employees_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $employees_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($employees_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $employees_view->pageUrl() ?>start=<?php echo $employees_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($employees_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $employees_view->pageUrl() ?>start=<?php echo $employees_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $employees_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="femployeesview" id="femployeesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($employees_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $employees_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employees">
<input type="hidden" name="modal" value="<?php echo (int)$employees_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($employees->EmployeeID->Visible) { // EmployeeID ?>
	<tr id="r_EmployeeID">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_EmployeeID"><?php echo $employees->EmployeeID->caption() ?></span></td>
		<td data-name="EmployeeID"<?php echo $employees->EmployeeID->cellAttributes() ?>>
<span id="el_employees_EmployeeID">
<span<?php echo $employees->EmployeeID->viewAttributes() ?>>
<?php echo $employees->EmployeeID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees->LastName->Visible) { // LastName ?>
	<tr id="r_LastName">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_LastName"><?php echo $employees->LastName->caption() ?></span></td>
		<td data-name="LastName"<?php echo $employees->LastName->cellAttributes() ?>>
<span id="el_employees_LastName">
<span<?php echo $employees->LastName->viewAttributes() ?>>
<?php echo $employees->LastName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees->FirstName->Visible) { // FirstName ?>
	<tr id="r_FirstName">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_FirstName"><?php echo $employees->FirstName->caption() ?></span></td>
		<td data-name="FirstName"<?php echo $employees->FirstName->cellAttributes() ?>>
<span id="el_employees_FirstName">
<span<?php echo $employees->FirstName->viewAttributes() ?>>
<?php echo $employees->FirstName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees->Title->Visible) { // Title ?>
	<tr id="r_Title">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_Title"><?php echo $employees->Title->caption() ?></span></td>
		<td data-name="Title"<?php echo $employees->Title->cellAttributes() ?>>
<span id="el_employees_Title">
<span<?php echo $employees->Title->viewAttributes() ?>>
<?php echo $employees->Title->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees->TitleOfCourtesy->Visible) { // TitleOfCourtesy ?>
	<tr id="r_TitleOfCourtesy">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_TitleOfCourtesy"><?php echo $employees->TitleOfCourtesy->caption() ?></span></td>
		<td data-name="TitleOfCourtesy"<?php echo $employees->TitleOfCourtesy->cellAttributes() ?>>
<span id="el_employees_TitleOfCourtesy">
<span<?php echo $employees->TitleOfCourtesy->viewAttributes() ?>>
<?php echo $employees->TitleOfCourtesy->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees->BirthDate->Visible) { // BirthDate ?>
	<tr id="r_BirthDate">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_BirthDate"><?php echo $employees->BirthDate->caption() ?></span></td>
		<td data-name="BirthDate"<?php echo $employees->BirthDate->cellAttributes() ?>>
<span id="el_employees_BirthDate">
<span<?php echo $employees->BirthDate->viewAttributes() ?>>
<?php echo $employees->BirthDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees->HireDate->Visible) { // HireDate ?>
	<tr id="r_HireDate">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_HireDate"><?php echo $employees->HireDate->caption() ?></span></td>
		<td data-name="HireDate"<?php echo $employees->HireDate->cellAttributes() ?>>
<span id="el_employees_HireDate">
<span<?php echo $employees->HireDate->viewAttributes() ?>>
<?php echo $employees->HireDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees->Address->Visible) { // Address ?>
	<tr id="r_Address">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_Address"><?php echo $employees->Address->caption() ?></span></td>
		<td data-name="Address"<?php echo $employees->Address->cellAttributes() ?>>
<span id="el_employees_Address">
<span<?php echo $employees->Address->viewAttributes() ?>>
<?php echo $employees->Address->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees->City->Visible) { // City ?>
	<tr id="r_City">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_City"><?php echo $employees->City->caption() ?></span></td>
		<td data-name="City"<?php echo $employees->City->cellAttributes() ?>>
<span id="el_employees_City">
<span<?php echo $employees->City->viewAttributes() ?>>
<?php echo $employees->City->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees->Region->Visible) { // Region ?>
	<tr id="r_Region">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_Region"><?php echo $employees->Region->caption() ?></span></td>
		<td data-name="Region"<?php echo $employees->Region->cellAttributes() ?>>
<span id="el_employees_Region">
<span<?php echo $employees->Region->viewAttributes() ?>>
<?php echo $employees->Region->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees->PostalCode->Visible) { // PostalCode ?>
	<tr id="r_PostalCode">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_PostalCode"><?php echo $employees->PostalCode->caption() ?></span></td>
		<td data-name="PostalCode"<?php echo $employees->PostalCode->cellAttributes() ?>>
<span id="el_employees_PostalCode">
<span<?php echo $employees->PostalCode->viewAttributes() ?>>
<?php echo $employees->PostalCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees->Country->Visible) { // Country ?>
	<tr id="r_Country">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_Country"><?php echo $employees->Country->caption() ?></span></td>
		<td data-name="Country"<?php echo $employees->Country->cellAttributes() ?>>
<span id="el_employees_Country">
<span<?php echo $employees->Country->viewAttributes() ?>>
<?php echo $employees->Country->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees->HomePhone->Visible) { // HomePhone ?>
	<tr id="r_HomePhone">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_HomePhone"><?php echo $employees->HomePhone->caption() ?></span></td>
		<td data-name="HomePhone"<?php echo $employees->HomePhone->cellAttributes() ?>>
<span id="el_employees_HomePhone">
<span<?php echo $employees->HomePhone->viewAttributes() ?>>
<?php echo $employees->HomePhone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees->Extension->Visible) { // Extension ?>
	<tr id="r_Extension">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_Extension"><?php echo $employees->Extension->caption() ?></span></td>
		<td data-name="Extension"<?php echo $employees->Extension->cellAttributes() ?>>
<span id="el_employees_Extension">
<span<?php echo $employees->Extension->viewAttributes() ?>>
<?php echo $employees->Extension->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees->_Email->Visible) { // Email ?>
	<tr id="r__Email">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees__Email"><?php echo $employees->_Email->caption() ?></span></td>
		<td data-name="_Email"<?php echo $employees->_Email->cellAttributes() ?>>
<span id="el_employees__Email">
<span<?php echo $employees->_Email->viewAttributes() ?>>
<?php echo $employees->_Email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees->Photo->Visible) { // Photo ?>
	<tr id="r_Photo">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_Photo"><?php echo $employees->Photo->caption() ?></span></td>
		<td data-name="Photo"<?php echo $employees->Photo->cellAttributes() ?>>
<span id="el_employees_Photo">
<span<?php echo $employees->Photo->viewAttributes() ?>>
<?php echo $employees->Photo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees->Notes->Visible) { // Notes ?>
	<tr id="r_Notes">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_Notes"><?php echo $employees->Notes->caption() ?></span></td>
		<td data-name="Notes"<?php echo $employees->Notes->cellAttributes() ?>>
<span id="el_employees_Notes">
<span<?php echo $employees->Notes->viewAttributes() ?>>
<?php echo $employees->Notes->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees->ReportsTo->Visible) { // ReportsTo ?>
	<tr id="r_ReportsTo">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_ReportsTo"><?php echo $employees->ReportsTo->caption() ?></span></td>
		<td data-name="ReportsTo"<?php echo $employees->ReportsTo->cellAttributes() ?>>
<span id="el_employees_ReportsTo">
<span<?php echo $employees->ReportsTo->viewAttributes() ?>>
<?php echo $employees->ReportsTo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees->Password->Visible) { // Password ?>
	<tr id="r_Password">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_Password"><?php echo $employees->Password->caption() ?></span></td>
		<td data-name="Password"<?php echo $employees->Password->cellAttributes() ?>>
<span id="el_employees_Password">
<span<?php echo $employees->Password->viewAttributes() ?>>
<?php echo $employees->Password->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees->UserLevel->Visible) { // UserLevel ?>
	<tr id="r_UserLevel">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_UserLevel"><?php echo $employees->UserLevel->caption() ?></span></td>
		<td data-name="UserLevel"<?php echo $employees->UserLevel->cellAttributes() ?>>
<span id="el_employees_UserLevel">
<span<?php echo $employees->UserLevel->viewAttributes() ?>>
<?php echo $employees->UserLevel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees->Username->Visible) { // Username ?>
	<tr id="r_Username">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_Username"><?php echo $employees->Username->caption() ?></span></td>
		<td data-name="Username"<?php echo $employees->Username->cellAttributes() ?>>
<span id="el_employees_Username">
<span<?php echo $employees->Username->viewAttributes() ?>>
<?php echo $employees->Username->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees->Activated->Visible) { // Activated ?>
	<tr id="r_Activated">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_Activated"><?php echo $employees->Activated->caption() ?></span></td>
		<td data-name="Activated"<?php echo $employees->Activated->cellAttributes() ?>>
<span id="el_employees_Activated">
<span<?php echo $employees->Activated->viewAttributes() ?>>
<?php if (ConvertToBool($employees->Activated->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $employees->Activated->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $employees->Activated->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees->Profile->Visible) { // Profile ?>
	<tr id="r_Profile">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_Profile"><?php echo $employees->Profile->caption() ?></span></td>
		<td data-name="Profile"<?php echo $employees->Profile->cellAttributes() ?>>
<span id="el_employees_Profile">
<span<?php echo $employees->Profile->viewAttributes() ?>>
<?php echo $employees->Profile->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$employees_view->IsModal) { ?>
<?php if (!$employees->isExport()) { ?>
<?php if (!isset($employees_view->Pager)) $employees_view->Pager = new PrevNextPager($employees_view->StartRec, $employees_view->DisplayRecs, $employees_view->TotalRecs, $employees_view->AutoHidePager) ?>
<?php if ($employees_view->Pager->RecordCount > 0 && $employees_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($employees_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $employees_view->pageUrl() ?>start=<?php echo $employees_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($employees_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $employees_view->pageUrl() ?>start=<?php echo $employees_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $employees_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($employees_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $employees_view->pageUrl() ?>start=<?php echo $employees_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($employees_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $employees_view->pageUrl() ?>start=<?php echo $employees_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $employees_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$employees_view->showPageFooter();
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
$employees_view->terminate();
?>
