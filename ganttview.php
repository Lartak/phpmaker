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
$gantt_view = new gantt_view();

// Run the page
$gantt_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gantt_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$gantt->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fganttview = currentForm = new ew.Form("fganttview", "view");

// Form_CustomValidate event
fganttview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fganttview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$gantt->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $gantt_view->ExportOptions->render("body") ?>
<?php
	foreach ($gantt_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $gantt_view->showPageHeader(); ?>
<?php
$gantt_view->showMessage();
?>
<?php if (!$gantt_view->IsModal) { ?>
<?php if (!$gantt->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($gantt_view->Pager)) $gantt_view->Pager = new PrevNextPager($gantt_view->StartRec, $gantt_view->DisplayRecs, $gantt_view->TotalRecs, $gantt_view->AutoHidePager) ?>
<?php if ($gantt_view->Pager->RecordCount > 0 && $gantt_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($gantt_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $gantt_view->pageUrl() ?>start=<?php echo $gantt_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($gantt_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $gantt_view->pageUrl() ?>start=<?php echo $gantt_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $gantt_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($gantt_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $gantt_view->pageUrl() ?>start=<?php echo $gantt_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($gantt_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $gantt_view->pageUrl() ?>start=<?php echo $gantt_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $gantt_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fganttview" id="fganttview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($gantt_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $gantt_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gantt">
<input type="hidden" name="modal" value="<?php echo (int)$gantt_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($gantt->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $gantt_view->TableLeftColumnClass ?>"><span id="elh_gantt_id"><?php echo $gantt->id->caption() ?></span></td>
		<td data-name="id"<?php echo $gantt->id->cellAttributes() ?>>
<span id="el_gantt_id">
<span<?php echo $gantt->id->viewAttributes() ?>>
<?php echo $gantt->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gantt->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $gantt_view->TableLeftColumnClass ?>"><span id="elh_gantt_name"><?php echo $gantt->name->caption() ?></span></td>
		<td data-name="name"<?php echo $gantt->name->cellAttributes() ?>>
<span id="el_gantt_name">
<span<?php echo $gantt->name->viewAttributes() ?>>
<?php echo $gantt->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gantt->start->Visible) { // start ?>
	<tr id="r_start">
		<td class="<?php echo $gantt_view->TableLeftColumnClass ?>"><span id="elh_gantt_start"><?php echo $gantt->start->caption() ?></span></td>
		<td data-name="start"<?php echo $gantt->start->cellAttributes() ?>>
<span id="el_gantt_start">
<span<?php echo $gantt->start->viewAttributes() ?>>
<?php echo $gantt->start->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gantt->end->Visible) { // end ?>
	<tr id="r_end">
		<td class="<?php echo $gantt_view->TableLeftColumnClass ?>"><span id="elh_gantt_end"><?php echo $gantt->end->caption() ?></span></td>
		<td data-name="end"<?php echo $gantt->end->cellAttributes() ?>>
<span id="el_gantt_end">
<span<?php echo $gantt->end->viewAttributes() ?>>
<?php echo $gantt->end->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$gantt_view->IsModal) { ?>
<?php if (!$gantt->isExport()) { ?>
<?php if (!isset($gantt_view->Pager)) $gantt_view->Pager = new PrevNextPager($gantt_view->StartRec, $gantt_view->DisplayRecs, $gantt_view->TotalRecs, $gantt_view->AutoHidePager) ?>
<?php if ($gantt_view->Pager->RecordCount > 0 && $gantt_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($gantt_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $gantt_view->pageUrl() ?>start=<?php echo $gantt_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($gantt_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $gantt_view->pageUrl() ?>start=<?php echo $gantt_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $gantt_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($gantt_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $gantt_view->pageUrl() ?>start=<?php echo $gantt_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($gantt_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $gantt_view->pageUrl() ?>start=<?php echo $gantt_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $gantt_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$gantt_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$gantt->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$gantt_view->terminate();
?>
