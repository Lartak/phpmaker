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
$customers_view = new customers_view();

// Run the page
$customers_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$customers_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$customers->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fcustomersview = currentForm = new ew.Form("fcustomersview", "view");

// Form_CustomValidate event
fcustomersview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcustomersview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$customers->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $customers_view->ExportOptions->render("body") ?>
<?php
	foreach ($customers_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $customers_view->showPageHeader(); ?>
<?php
$customers_view->showMessage();
?>
<?php if (!$customers_view->IsModal) { ?>
<?php if (!$customers->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($customers_view->Pager)) $customers_view->Pager = new PrevNextPager($customers_view->StartRec, $customers_view->DisplayRecs, $customers_view->TotalRecs, $customers_view->AutoHidePager) ?>
<?php if ($customers_view->Pager->RecordCount > 0 && $customers_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($customers_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $customers_view->pageUrl() ?>start=<?php echo $customers_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($customers_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $customers_view->pageUrl() ?>start=<?php echo $customers_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $customers_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($customers_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $customers_view->pageUrl() ?>start=<?php echo $customers_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($customers_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $customers_view->pageUrl() ?>start=<?php echo $customers_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $customers_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcustomersview" id="fcustomersview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($customers_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $customers_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="customers">
<input type="hidden" name="modal" value="<?php echo (int)$customers_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($customers->CustomerID->Visible) { // CustomerID ?>
	<tr id="r_CustomerID">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_CustomerID"><?php echo $customers->CustomerID->caption() ?></span></td>
		<td data-name="CustomerID"<?php echo $customers->CustomerID->cellAttributes() ?>>
<span id="el_customers_CustomerID">
<span<?php echo $customers->CustomerID->viewAttributes() ?>>
<?php echo $customers->CustomerID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers->CompanyName->Visible) { // CompanyName ?>
	<tr id="r_CompanyName">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_CompanyName"><?php echo $customers->CompanyName->caption() ?></span></td>
		<td data-name="CompanyName"<?php echo $customers->CompanyName->cellAttributes() ?>>
<span id="el_customers_CompanyName">
<span<?php echo $customers->CompanyName->viewAttributes() ?>>
<?php echo $customers->CompanyName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers->ContactName->Visible) { // ContactName ?>
	<tr id="r_ContactName">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_ContactName"><?php echo $customers->ContactName->caption() ?></span></td>
		<td data-name="ContactName"<?php echo $customers->ContactName->cellAttributes() ?>>
<span id="el_customers_ContactName">
<span<?php echo $customers->ContactName->viewAttributes() ?>>
<?php echo $customers->ContactName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers->ContactTitle->Visible) { // ContactTitle ?>
	<tr id="r_ContactTitle">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_ContactTitle"><?php echo $customers->ContactTitle->caption() ?></span></td>
		<td data-name="ContactTitle"<?php echo $customers->ContactTitle->cellAttributes() ?>>
<span id="el_customers_ContactTitle">
<span<?php echo $customers->ContactTitle->viewAttributes() ?>>
<?php echo $customers->ContactTitle->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers->Address->Visible) { // Address ?>
	<tr id="r_Address">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_Address"><?php echo $customers->Address->caption() ?></span></td>
		<td data-name="Address"<?php echo $customers->Address->cellAttributes() ?>>
<span id="el_customers_Address">
<span<?php echo $customers->Address->viewAttributes() ?>>
<?php echo $customers->Address->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers->City->Visible) { // City ?>
	<tr id="r_City">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_City"><?php echo $customers->City->caption() ?></span></td>
		<td data-name="City"<?php echo $customers->City->cellAttributes() ?>>
<span id="el_customers_City">
<span<?php echo $customers->City->viewAttributes() ?>>
<?php echo $customers->City->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers->Region->Visible) { // Region ?>
	<tr id="r_Region">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_Region"><?php echo $customers->Region->caption() ?></span></td>
		<td data-name="Region"<?php echo $customers->Region->cellAttributes() ?>>
<span id="el_customers_Region">
<span<?php echo $customers->Region->viewAttributes() ?>>
<?php echo $customers->Region->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers->PostalCode->Visible) { // PostalCode ?>
	<tr id="r_PostalCode">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_PostalCode"><?php echo $customers->PostalCode->caption() ?></span></td>
		<td data-name="PostalCode"<?php echo $customers->PostalCode->cellAttributes() ?>>
<span id="el_customers_PostalCode">
<span<?php echo $customers->PostalCode->viewAttributes() ?>>
<?php echo $customers->PostalCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers->Country->Visible) { // Country ?>
	<tr id="r_Country">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_Country"><?php echo $customers->Country->caption() ?></span></td>
		<td data-name="Country"<?php echo $customers->Country->cellAttributes() ?>>
<span id="el_customers_Country">
<span<?php echo $customers->Country->viewAttributes() ?>>
<?php echo $customers->Country->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers->Phone->Visible) { // Phone ?>
	<tr id="r_Phone">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_Phone"><?php echo $customers->Phone->caption() ?></span></td>
		<td data-name="Phone"<?php echo $customers->Phone->cellAttributes() ?>>
<span id="el_customers_Phone">
<span<?php echo $customers->Phone->viewAttributes() ?>>
<?php echo $customers->Phone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers->Fax->Visible) { // Fax ?>
	<tr id="r_Fax">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_Fax"><?php echo $customers->Fax->caption() ?></span></td>
		<td data-name="Fax"<?php echo $customers->Fax->cellAttributes() ?>>
<span id="el_customers_Fax">
<span<?php echo $customers->Fax->viewAttributes() ?>>
<?php echo $customers->Fax->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$customers_view->IsModal) { ?>
<?php if (!$customers->isExport()) { ?>
<?php if (!isset($customers_view->Pager)) $customers_view->Pager = new PrevNextPager($customers_view->StartRec, $customers_view->DisplayRecs, $customers_view->TotalRecs, $customers_view->AutoHidePager) ?>
<?php if ($customers_view->Pager->RecordCount > 0 && $customers_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($customers_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $customers_view->pageUrl() ?>start=<?php echo $customers_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($customers_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $customers_view->pageUrl() ?>start=<?php echo $customers_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $customers_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($customers_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $customers_view->pageUrl() ?>start=<?php echo $customers_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($customers_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $customers_view->pageUrl() ?>start=<?php echo $customers_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $customers_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$customers_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$customers->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$customers_view->terminate();
?>
