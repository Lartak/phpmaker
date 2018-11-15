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
$shippers_view = new shippers_view();

// Run the page
$shippers_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$shippers_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$shippers->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fshippersview = currentForm = new ew.Form("fshippersview", "view");

// Form_CustomValidate event
fshippersview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fshippersview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$shippers->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $shippers_view->ExportOptions->render("body") ?>
<?php
	foreach ($shippers_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $shippers_view->showPageHeader(); ?>
<?php
$shippers_view->showMessage();
?>
<?php if (!$shippers_view->IsModal) { ?>
<?php if (!$shippers->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($shippers_view->Pager)) $shippers_view->Pager = new PrevNextPager($shippers_view->StartRec, $shippers_view->DisplayRecs, $shippers_view->TotalRecs, $shippers_view->AutoHidePager) ?>
<?php if ($shippers_view->Pager->RecordCount > 0 && $shippers_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($shippers_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $shippers_view->pageUrl() ?>start=<?php echo $shippers_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($shippers_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $shippers_view->pageUrl() ?>start=<?php echo $shippers_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $shippers_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($shippers_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $shippers_view->pageUrl() ?>start=<?php echo $shippers_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($shippers_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $shippers_view->pageUrl() ?>start=<?php echo $shippers_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $shippers_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fshippersview" id="fshippersview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($shippers_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $shippers_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="shippers">
<input type="hidden" name="modal" value="<?php echo (int)$shippers_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($shippers->ShipperID->Visible) { // ShipperID ?>
	<tr id="r_ShipperID">
		<td class="<?php echo $shippers_view->TableLeftColumnClass ?>"><span id="elh_shippers_ShipperID"><?php echo $shippers->ShipperID->caption() ?></span></td>
		<td data-name="ShipperID"<?php echo $shippers->ShipperID->cellAttributes() ?>>
<span id="el_shippers_ShipperID">
<span<?php echo $shippers->ShipperID->viewAttributes() ?>>
<?php echo $shippers->ShipperID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($shippers->CompanyName->Visible) { // CompanyName ?>
	<tr id="r_CompanyName">
		<td class="<?php echo $shippers_view->TableLeftColumnClass ?>"><span id="elh_shippers_CompanyName"><?php echo $shippers->CompanyName->caption() ?></span></td>
		<td data-name="CompanyName"<?php echo $shippers->CompanyName->cellAttributes() ?>>
<span id="el_shippers_CompanyName">
<span<?php echo $shippers->CompanyName->viewAttributes() ?>>
<?php echo $shippers->CompanyName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($shippers->Phone->Visible) { // Phone ?>
	<tr id="r_Phone">
		<td class="<?php echo $shippers_view->TableLeftColumnClass ?>"><span id="elh_shippers_Phone"><?php echo $shippers->Phone->caption() ?></span></td>
		<td data-name="Phone"<?php echo $shippers->Phone->cellAttributes() ?>>
<span id="el_shippers_Phone">
<span<?php echo $shippers->Phone->viewAttributes() ?>>
<?php echo $shippers->Phone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$shippers_view->IsModal) { ?>
<?php if (!$shippers->isExport()) { ?>
<?php if (!isset($shippers_view->Pager)) $shippers_view->Pager = new PrevNextPager($shippers_view->StartRec, $shippers_view->DisplayRecs, $shippers_view->TotalRecs, $shippers_view->AutoHidePager) ?>
<?php if ($shippers_view->Pager->RecordCount > 0 && $shippers_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($shippers_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $shippers_view->pageUrl() ?>start=<?php echo $shippers_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($shippers_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $shippers_view->pageUrl() ?>start=<?php echo $shippers_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $shippers_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($shippers_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $shippers_view->pageUrl() ?>start=<?php echo $shippers_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($shippers_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $shippers_view->pageUrl() ?>start=<?php echo $shippers_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $shippers_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$shippers_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$shippers->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$shippers_view->terminate();
?>
