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
$suppliers_view = new suppliers_view();

// Run the page
$suppliers_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$suppliers_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$suppliers->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fsuppliersview = currentForm = new ew.Form("fsuppliersview", "view");

// Form_CustomValidate event
fsuppliersview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fsuppliersview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$suppliers->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $suppliers_view->ExportOptions->render("body") ?>
<?php
	foreach ($suppliers_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $suppliers_view->showPageHeader(); ?>
<?php
$suppliers_view->showMessage();
?>
<?php if (!$suppliers_view->IsModal) { ?>
<?php if (!$suppliers->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($suppliers_view->Pager)) $suppliers_view->Pager = new PrevNextPager($suppliers_view->StartRec, $suppliers_view->DisplayRecs, $suppliers_view->TotalRecs, $suppliers_view->AutoHidePager) ?>
<?php if ($suppliers_view->Pager->RecordCount > 0 && $suppliers_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($suppliers_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $suppliers_view->pageUrl() ?>start=<?php echo $suppliers_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($suppliers_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $suppliers_view->pageUrl() ?>start=<?php echo $suppliers_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $suppliers_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($suppliers_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $suppliers_view->pageUrl() ?>start=<?php echo $suppliers_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($suppliers_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $suppliers_view->pageUrl() ?>start=<?php echo $suppliers_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $suppliers_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fsuppliersview" id="fsuppliersview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($suppliers_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $suppliers_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="suppliers">
<input type="hidden" name="modal" value="<?php echo (int)$suppliers_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($suppliers->SupplierID->Visible) { // SupplierID ?>
	<tr id="r_SupplierID">
		<td class="<?php echo $suppliers_view->TableLeftColumnClass ?>"><span id="elh_suppliers_SupplierID"><?php echo $suppliers->SupplierID->caption() ?></span></td>
		<td data-name="SupplierID"<?php echo $suppliers->SupplierID->cellAttributes() ?>>
<span id="el_suppliers_SupplierID">
<span<?php echo $suppliers->SupplierID->viewAttributes() ?>>
<?php echo $suppliers->SupplierID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($suppliers->CompanyName->Visible) { // CompanyName ?>
	<tr id="r_CompanyName">
		<td class="<?php echo $suppliers_view->TableLeftColumnClass ?>"><span id="elh_suppliers_CompanyName"><?php echo $suppliers->CompanyName->caption() ?></span></td>
		<td data-name="CompanyName"<?php echo $suppliers->CompanyName->cellAttributes() ?>>
<span id="el_suppliers_CompanyName">
<span<?php echo $suppliers->CompanyName->viewAttributes() ?>>
<?php echo $suppliers->CompanyName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($suppliers->ContactName->Visible) { // ContactName ?>
	<tr id="r_ContactName">
		<td class="<?php echo $suppliers_view->TableLeftColumnClass ?>"><span id="elh_suppliers_ContactName"><?php echo $suppliers->ContactName->caption() ?></span></td>
		<td data-name="ContactName"<?php echo $suppliers->ContactName->cellAttributes() ?>>
<span id="el_suppliers_ContactName">
<span<?php echo $suppliers->ContactName->viewAttributes() ?>>
<?php echo $suppliers->ContactName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($suppliers->ContactTitle->Visible) { // ContactTitle ?>
	<tr id="r_ContactTitle">
		<td class="<?php echo $suppliers_view->TableLeftColumnClass ?>"><span id="elh_suppliers_ContactTitle"><?php echo $suppliers->ContactTitle->caption() ?></span></td>
		<td data-name="ContactTitle"<?php echo $suppliers->ContactTitle->cellAttributes() ?>>
<span id="el_suppliers_ContactTitle">
<span<?php echo $suppliers->ContactTitle->viewAttributes() ?>>
<?php echo $suppliers->ContactTitle->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($suppliers->Address->Visible) { // Address ?>
	<tr id="r_Address">
		<td class="<?php echo $suppliers_view->TableLeftColumnClass ?>"><span id="elh_suppliers_Address"><?php echo $suppliers->Address->caption() ?></span></td>
		<td data-name="Address"<?php echo $suppliers->Address->cellAttributes() ?>>
<span id="el_suppliers_Address">
<span<?php echo $suppliers->Address->viewAttributes() ?>>
<?php echo $suppliers->Address->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($suppliers->City->Visible) { // City ?>
	<tr id="r_City">
		<td class="<?php echo $suppliers_view->TableLeftColumnClass ?>"><span id="elh_suppliers_City"><?php echo $suppliers->City->caption() ?></span></td>
		<td data-name="City"<?php echo $suppliers->City->cellAttributes() ?>>
<span id="el_suppliers_City">
<span<?php echo $suppliers->City->viewAttributes() ?>>
<?php echo $suppliers->City->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($suppliers->Region->Visible) { // Region ?>
	<tr id="r_Region">
		<td class="<?php echo $suppliers_view->TableLeftColumnClass ?>"><span id="elh_suppliers_Region"><?php echo $suppliers->Region->caption() ?></span></td>
		<td data-name="Region"<?php echo $suppliers->Region->cellAttributes() ?>>
<span id="el_suppliers_Region">
<span<?php echo $suppliers->Region->viewAttributes() ?>>
<?php echo $suppliers->Region->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($suppliers->PostalCode->Visible) { // PostalCode ?>
	<tr id="r_PostalCode">
		<td class="<?php echo $suppliers_view->TableLeftColumnClass ?>"><span id="elh_suppliers_PostalCode"><?php echo $suppliers->PostalCode->caption() ?></span></td>
		<td data-name="PostalCode"<?php echo $suppliers->PostalCode->cellAttributes() ?>>
<span id="el_suppliers_PostalCode">
<span<?php echo $suppliers->PostalCode->viewAttributes() ?>>
<?php echo $suppliers->PostalCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($suppliers->Country->Visible) { // Country ?>
	<tr id="r_Country">
		<td class="<?php echo $suppliers_view->TableLeftColumnClass ?>"><span id="elh_suppliers_Country"><?php echo $suppliers->Country->caption() ?></span></td>
		<td data-name="Country"<?php echo $suppliers->Country->cellAttributes() ?>>
<span id="el_suppliers_Country">
<span<?php echo $suppliers->Country->viewAttributes() ?>>
<?php echo $suppliers->Country->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($suppliers->Phone->Visible) { // Phone ?>
	<tr id="r_Phone">
		<td class="<?php echo $suppliers_view->TableLeftColumnClass ?>"><span id="elh_suppliers_Phone"><?php echo $suppliers->Phone->caption() ?></span></td>
		<td data-name="Phone"<?php echo $suppliers->Phone->cellAttributes() ?>>
<span id="el_suppliers_Phone">
<span<?php echo $suppliers->Phone->viewAttributes() ?>>
<?php echo $suppliers->Phone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($suppliers->Fax->Visible) { // Fax ?>
	<tr id="r_Fax">
		<td class="<?php echo $suppliers_view->TableLeftColumnClass ?>"><span id="elh_suppliers_Fax"><?php echo $suppliers->Fax->caption() ?></span></td>
		<td data-name="Fax"<?php echo $suppliers->Fax->cellAttributes() ?>>
<span id="el_suppliers_Fax">
<span<?php echo $suppliers->Fax->viewAttributes() ?>>
<?php echo $suppliers->Fax->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($suppliers->HomePage->Visible) { // HomePage ?>
	<tr id="r_HomePage">
		<td class="<?php echo $suppliers_view->TableLeftColumnClass ?>"><span id="elh_suppliers_HomePage"><?php echo $suppliers->HomePage->caption() ?></span></td>
		<td data-name="HomePage"<?php echo $suppliers->HomePage->cellAttributes() ?>>
<span id="el_suppliers_HomePage">
<span<?php echo $suppliers->HomePage->viewAttributes() ?>>
<?php echo $suppliers->HomePage->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$suppliers_view->IsModal) { ?>
<?php if (!$suppliers->isExport()) { ?>
<?php if (!isset($suppliers_view->Pager)) $suppliers_view->Pager = new PrevNextPager($suppliers_view->StartRec, $suppliers_view->DisplayRecs, $suppliers_view->TotalRecs, $suppliers_view->AutoHidePager) ?>
<?php if ($suppliers_view->Pager->RecordCount > 0 && $suppliers_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($suppliers_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $suppliers_view->pageUrl() ?>start=<?php echo $suppliers_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($suppliers_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $suppliers_view->pageUrl() ?>start=<?php echo $suppliers_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $suppliers_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($suppliers_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $suppliers_view->pageUrl() ?>start=<?php echo $suppliers_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($suppliers_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $suppliers_view->pageUrl() ?>start=<?php echo $suppliers_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $suppliers_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$suppliers_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$suppliers->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$suppliers_view->terminate();
?>
