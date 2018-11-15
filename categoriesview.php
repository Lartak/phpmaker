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
$categories_view = new categories_view();

// Run the page
$categories_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$categories_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$categories->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fcategoriesview = currentForm = new ew.Form("fcategoriesview", "view");

// Form_CustomValidate event
fcategoriesview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcategoriesview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$categories->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $categories_view->ExportOptions->render("body") ?>
<?php
	foreach ($categories_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $categories_view->showPageHeader(); ?>
<?php
$categories_view->showMessage();
?>
<?php if (!$categories_view->IsModal) { ?>
<?php if (!$categories->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($categories_view->Pager)) $categories_view->Pager = new PrevNextPager($categories_view->StartRec, $categories_view->DisplayRecs, $categories_view->TotalRecs, $categories_view->AutoHidePager) ?>
<?php if ($categories_view->Pager->RecordCount > 0 && $categories_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($categories_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $categories_view->pageUrl() ?>start=<?php echo $categories_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($categories_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $categories_view->pageUrl() ?>start=<?php echo $categories_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $categories_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($categories_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $categories_view->pageUrl() ?>start=<?php echo $categories_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($categories_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $categories_view->pageUrl() ?>start=<?php echo $categories_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $categories_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcategoriesview" id="fcategoriesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($categories_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $categories_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="categories">
<input type="hidden" name="modal" value="<?php echo (int)$categories_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($categories->CategoryID->Visible) { // CategoryID ?>
	<tr id="r_CategoryID">
		<td class="<?php echo $categories_view->TableLeftColumnClass ?>"><span id="elh_categories_CategoryID"><?php echo $categories->CategoryID->caption() ?></span></td>
		<td data-name="CategoryID"<?php echo $categories->CategoryID->cellAttributes() ?>>
<span id="el_categories_CategoryID">
<span<?php echo $categories->CategoryID->viewAttributes() ?>>
<?php echo $categories->CategoryID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($categories->CategoryName->Visible) { // CategoryName ?>
	<tr id="r_CategoryName">
		<td class="<?php echo $categories_view->TableLeftColumnClass ?>"><span id="elh_categories_CategoryName"><?php echo $categories->CategoryName->caption() ?></span></td>
		<td data-name="CategoryName"<?php echo $categories->CategoryName->cellAttributes() ?>>
<span id="el_categories_CategoryName">
<span<?php echo $categories->CategoryName->viewAttributes() ?>>
<?php echo $categories->CategoryName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($categories->Description->Visible) { // Description ?>
	<tr id="r_Description">
		<td class="<?php echo $categories_view->TableLeftColumnClass ?>"><span id="elh_categories_Description"><?php echo $categories->Description->caption() ?></span></td>
		<td data-name="Description"<?php echo $categories->Description->cellAttributes() ?>>
<span id="el_categories_Description">
<span<?php echo $categories->Description->viewAttributes() ?>>
<?php echo $categories->Description->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($categories->Picture->Visible) { // Picture ?>
	<tr id="r_Picture">
		<td class="<?php echo $categories_view->TableLeftColumnClass ?>"><span id="elh_categories_Picture"><?php echo $categories->Picture->caption() ?></span></td>
		<td data-name="Picture"<?php echo $categories->Picture->cellAttributes() ?>>
<span id="el_categories_Picture">
<span<?php echo $categories->Picture->viewAttributes() ?>>
<?php echo GetFileViewTag($categories->Picture, $categories->Picture->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$categories_view->IsModal) { ?>
<?php if (!$categories->isExport()) { ?>
<?php if (!isset($categories_view->Pager)) $categories_view->Pager = new PrevNextPager($categories_view->StartRec, $categories_view->DisplayRecs, $categories_view->TotalRecs, $categories_view->AutoHidePager) ?>
<?php if ($categories_view->Pager->RecordCount > 0 && $categories_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($categories_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $categories_view->pageUrl() ?>start=<?php echo $categories_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($categories_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $categories_view->pageUrl() ?>start=<?php echo $categories_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $categories_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($categories_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $categories_view->pageUrl() ?>start=<?php echo $categories_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($categories_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $categories_view->pageUrl() ?>start=<?php echo $categories_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $categories_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$categories_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$categories->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$categories_view->terminate();
?>
