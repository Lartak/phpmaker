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
$trademarks_view = new trademarks_view();

// Run the page
$trademarks_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$trademarks_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$trademarks->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftrademarksview = currentForm = new ew.Form("ftrademarksview", "view");

// Form_CustomValidate event
ftrademarksview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftrademarksview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$trademarks->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $trademarks_view->ExportOptions->render("body") ?>
<?php
	foreach ($trademarks_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $trademarks_view->showPageHeader(); ?>
<?php
$trademarks_view->showMessage();
?>
<?php if (!$trademarks_view->IsModal) { ?>
<?php if (!$trademarks->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($trademarks_view->Pager)) $trademarks_view->Pager = new PrevNextPager($trademarks_view->StartRec, $trademarks_view->DisplayRecs, $trademarks_view->TotalRecs, $trademarks_view->AutoHidePager) ?>
<?php if ($trademarks_view->Pager->RecordCount > 0 && $trademarks_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($trademarks_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $trademarks_view->pageUrl() ?>start=<?php echo $trademarks_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($trademarks_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $trademarks_view->pageUrl() ?>start=<?php echo $trademarks_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $trademarks_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($trademarks_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $trademarks_view->pageUrl() ?>start=<?php echo $trademarks_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($trademarks_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $trademarks_view->pageUrl() ?>start=<?php echo $trademarks_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $trademarks_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="ftrademarksview" id="ftrademarksview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($trademarks_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $trademarks_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="trademarks">
<input type="hidden" name="modal" value="<?php echo (int)$trademarks_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($trademarks->ID->Visible) { // ID ?>
	<tr id="r_ID">
		<td class="<?php echo $trademarks_view->TableLeftColumnClass ?>"><span id="elh_trademarks_ID"><?php echo $trademarks->ID->caption() ?></span></td>
		<td data-name="ID"<?php echo $trademarks->ID->cellAttributes() ?>>
<span id="el_trademarks_ID">
<span<?php echo $trademarks->ID->viewAttributes() ?>>
<?php echo $trademarks->ID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($trademarks->Trademark->Visible) { // Trademark ?>
	<tr id="r_Trademark">
		<td class="<?php echo $trademarks_view->TableLeftColumnClass ?>"><span id="elh_trademarks_Trademark"><?php echo $trademarks->Trademark->caption() ?></span></td>
		<td data-name="Trademark"<?php echo $trademarks->Trademark->cellAttributes() ?>>
<span id="el_trademarks_Trademark">
<span<?php echo $trademarks->Trademark->viewAttributes() ?>>
<?php echo $trademarks->Trademark->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$trademarks_view->IsModal) { ?>
<?php if (!$trademarks->isExport()) { ?>
<?php if (!isset($trademarks_view->Pager)) $trademarks_view->Pager = new PrevNextPager($trademarks_view->StartRec, $trademarks_view->DisplayRecs, $trademarks_view->TotalRecs, $trademarks_view->AutoHidePager) ?>
<?php if ($trademarks_view->Pager->RecordCount > 0 && $trademarks_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($trademarks_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $trademarks_view->pageUrl() ?>start=<?php echo $trademarks_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($trademarks_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $trademarks_view->pageUrl() ?>start=<?php echo $trademarks_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $trademarks_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($trademarks_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $trademarks_view->pageUrl() ?>start=<?php echo $trademarks_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($trademarks_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $trademarks_view->pageUrl() ?>start=<?php echo $trademarks_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $trademarks_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$trademarks_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$trademarks->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$trademarks_view->terminate();
?>
