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
$dji_view = new dji_view();

// Run the page
$dji_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$dji_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$dji->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fdjiview = currentForm = new ew.Form("fdjiview", "view");

// Form_CustomValidate event
fdjiview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdjiview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$dji->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $dji_view->ExportOptions->render("body") ?>
<?php
	foreach ($dji_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $dji_view->showPageHeader(); ?>
<?php
$dji_view->showMessage();
?>
<?php if (!$dji_view->IsModal) { ?>
<?php if (!$dji->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($dji_view->Pager)) $dji_view->Pager = new PrevNextPager($dji_view->StartRec, $dji_view->DisplayRecs, $dji_view->TotalRecs, $dji_view->AutoHidePager) ?>
<?php if ($dji_view->Pager->RecordCount > 0 && $dji_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($dji_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $dji_view->pageUrl() ?>start=<?php echo $dji_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($dji_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $dji_view->pageUrl() ?>start=<?php echo $dji_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $dji_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($dji_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $dji_view->pageUrl() ?>start=<?php echo $dji_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($dji_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $dji_view->pageUrl() ?>start=<?php echo $dji_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $dji_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fdjiview" id="fdjiview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($dji_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $dji_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="dji">
<input type="hidden" name="modal" value="<?php echo (int)$dji_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($dji->ID->Visible) { // ID ?>
	<tr id="r_ID">
		<td class="<?php echo $dji_view->TableLeftColumnClass ?>"><span id="elh_dji_ID"><?php echo $dji->ID->caption() ?></span></td>
		<td data-name="ID"<?php echo $dji->ID->cellAttributes() ?>>
<span id="el_dji_ID">
<span<?php echo $dji->ID->viewAttributes() ?>>
<?php echo $dji->ID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dji->Date->Visible) { // Date ?>
	<tr id="r_Date">
		<td class="<?php echo $dji_view->TableLeftColumnClass ?>"><span id="elh_dji_Date"><?php echo $dji->Date->caption() ?></span></td>
		<td data-name="Date"<?php echo $dji->Date->cellAttributes() ?>>
<span id="el_dji_Date">
<span<?php echo $dji->Date->viewAttributes() ?>>
<?php echo $dji->Date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dji->Open->Visible) { // Open ?>
	<tr id="r_Open">
		<td class="<?php echo $dji_view->TableLeftColumnClass ?>"><span id="elh_dji_Open"><?php echo $dji->Open->caption() ?></span></td>
		<td data-name="Open"<?php echo $dji->Open->cellAttributes() ?>>
<span id="el_dji_Open">
<span<?php echo $dji->Open->viewAttributes() ?>>
<?php echo $dji->Open->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dji->High->Visible) { // High ?>
	<tr id="r_High">
		<td class="<?php echo $dji_view->TableLeftColumnClass ?>"><span id="elh_dji_High"><?php echo $dji->High->caption() ?></span></td>
		<td data-name="High"<?php echo $dji->High->cellAttributes() ?>>
<span id="el_dji_High">
<span<?php echo $dji->High->viewAttributes() ?>>
<?php echo $dji->High->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dji->Low->Visible) { // Low ?>
	<tr id="r_Low">
		<td class="<?php echo $dji_view->TableLeftColumnClass ?>"><span id="elh_dji_Low"><?php echo $dji->Low->caption() ?></span></td>
		<td data-name="Low"<?php echo $dji->Low->cellAttributes() ?>>
<span id="el_dji_Low">
<span<?php echo $dji->Low->viewAttributes() ?>>
<?php echo $dji->Low->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dji->Close->Visible) { // Close ?>
	<tr id="r_Close">
		<td class="<?php echo $dji_view->TableLeftColumnClass ?>"><span id="elh_dji_Close"><?php echo $dji->Close->caption() ?></span></td>
		<td data-name="Close"<?php echo $dji->Close->cellAttributes() ?>>
<span id="el_dji_Close">
<span<?php echo $dji->Close->viewAttributes() ?>>
<?php echo $dji->Close->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dji->Volume->Visible) { // Volume ?>
	<tr id="r_Volume">
		<td class="<?php echo $dji_view->TableLeftColumnClass ?>"><span id="elh_dji_Volume"><?php echo $dji->Volume->caption() ?></span></td>
		<td data-name="Volume"<?php echo $dji->Volume->cellAttributes() ?>>
<span id="el_dji_Volume">
<span<?php echo $dji->Volume->viewAttributes() ?>>
<?php echo $dji->Volume->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dji->Adj_Close->Visible) { // Adj Close ?>
	<tr id="r_Adj_Close">
		<td class="<?php echo $dji_view->TableLeftColumnClass ?>"><span id="elh_dji_Adj_Close"><?php echo $dji->Adj_Close->caption() ?></span></td>
		<td data-name="Adj_Close"<?php echo $dji->Adj_Close->cellAttributes() ?>>
<span id="el_dji_Adj_Close">
<span<?php echo $dji->Adj_Close->viewAttributes() ?>>
<?php echo $dji->Adj_Close->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dji->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $dji_view->TableLeftColumnClass ?>"><span id="elh_dji_Name"><?php echo $dji->Name->caption() ?></span></td>
		<td data-name="Name"<?php echo $dji->Name->cellAttributes() ?>>
<span id="el_dji_Name">
<span<?php echo $dji->Name->viewAttributes() ?>>
<?php echo $dji->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dji->Name2->Visible) { // Name2 ?>
	<tr id="r_Name2">
		<td class="<?php echo $dji_view->TableLeftColumnClass ?>"><span id="elh_dji_Name2"><?php echo $dji->Name2->caption() ?></span></td>
		<td data-name="Name2"<?php echo $dji->Name2->cellAttributes() ?>>
<span id="el_dji_Name2">
<span<?php echo $dji->Name2->viewAttributes() ?>>
<?php echo $dji->Name2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$dji_view->IsModal) { ?>
<?php if (!$dji->isExport()) { ?>
<?php if (!isset($dji_view->Pager)) $dji_view->Pager = new PrevNextPager($dji_view->StartRec, $dji_view->DisplayRecs, $dji_view->TotalRecs, $dji_view->AutoHidePager) ?>
<?php if ($dji_view->Pager->RecordCount > 0 && $dji_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($dji_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $dji_view->pageUrl() ?>start=<?php echo $dji_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($dji_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $dji_view->pageUrl() ?>start=<?php echo $dji_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $dji_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($dji_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $dji_view->pageUrl() ?>start=<?php echo $dji_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($dji_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $dji_view->pageUrl() ?>start=<?php echo $dji_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $dji_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$dji_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$dji->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$dji_view->terminate();
?>
