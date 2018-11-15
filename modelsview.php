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
$models_view = new models_view();

// Run the page
$models_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$models_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$models->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fmodelsview = currentForm = new ew.Form("fmodelsview", "view");

// Form_CustomValidate event
fmodelsview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fmodelsview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$models->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $models_view->ExportOptions->render("body") ?>
<?php
	foreach ($models_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $models_view->showPageHeader(); ?>
<?php
$models_view->showMessage();
?>
<?php if (!$models_view->IsModal) { ?>
<?php if (!$models->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($models_view->Pager)) $models_view->Pager = new PrevNextPager($models_view->StartRec, $models_view->DisplayRecs, $models_view->TotalRecs, $models_view->AutoHidePager) ?>
<?php if ($models_view->Pager->RecordCount > 0 && $models_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($models_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $models_view->pageUrl() ?>start=<?php echo $models_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($models_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $models_view->pageUrl() ?>start=<?php echo $models_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $models_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($models_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $models_view->pageUrl() ?>start=<?php echo $models_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($models_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $models_view->pageUrl() ?>start=<?php echo $models_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $models_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fmodelsview" id="fmodelsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($models_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $models_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="models">
<input type="hidden" name="modal" value="<?php echo (int)$models_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($models->ID->Visible) { // ID ?>
	<tr id="r_ID">
		<td class="<?php echo $models_view->TableLeftColumnClass ?>"><span id="elh_models_ID"><?php echo $models->ID->caption() ?></span></td>
		<td data-name="ID"<?php echo $models->ID->cellAttributes() ?>>
<span id="el_models_ID">
<span<?php echo $models->ID->viewAttributes() ?>>
<?php echo $models->ID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($models->Trademark->Visible) { // Trademark ?>
	<tr id="r_Trademark">
		<td class="<?php echo $models_view->TableLeftColumnClass ?>"><span id="elh_models_Trademark"><?php echo $models->Trademark->caption() ?></span></td>
		<td data-name="Trademark"<?php echo $models->Trademark->cellAttributes() ?>>
<span id="el_models_Trademark">
<span<?php echo $models->Trademark->viewAttributes() ?>>
<?php echo $models->Trademark->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($models->Model->Visible) { // Model ?>
	<tr id="r_Model">
		<td class="<?php echo $models_view->TableLeftColumnClass ?>"><span id="elh_models_Model"><?php echo $models->Model->caption() ?></span></td>
		<td data-name="Model"<?php echo $models->Model->cellAttributes() ?>>
<span id="el_models_Model">
<span<?php echo $models->Model->viewAttributes() ?>>
<?php echo $models->Model->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$models_view->IsModal) { ?>
<?php if (!$models->isExport()) { ?>
<?php if (!isset($models_view->Pager)) $models_view->Pager = new PrevNextPager($models_view->StartRec, $models_view->DisplayRecs, $models_view->TotalRecs, $models_view->AutoHidePager) ?>
<?php if ($models_view->Pager->RecordCount > 0 && $models_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($models_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $models_view->pageUrl() ?>start=<?php echo $models_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($models_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $models_view->pageUrl() ?>start=<?php echo $models_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $models_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($models_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $models_view->pageUrl() ?>start=<?php echo $models_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($models_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $models_view->pageUrl() ?>start=<?php echo $models_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $models_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$models_view->showPageFooter();
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
$models_view->terminate();
?>
