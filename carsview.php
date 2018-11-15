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
$cars_view = new cars_view();

// Run the page
$cars_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cars_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$cars->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fcarsview = currentForm = new ew.Form("fcarsview", "view");

// Form_CustomValidate event
fcarsview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcarsview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$cars->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $cars_view->ExportOptions->render("body") ?>
<?php
	foreach ($cars_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $cars_view->showPageHeader(); ?>
<?php
$cars_view->showMessage();
?>
<?php if (!$cars_view->IsModal) { ?>
<?php if (!$cars->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($cars_view->Pager)) $cars_view->Pager = new PrevNextPager($cars_view->StartRec, $cars_view->DisplayRecs, $cars_view->TotalRecs, $cars_view->AutoHidePager) ?>
<?php if ($cars_view->Pager->RecordCount > 0 && $cars_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($cars_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $cars_view->pageUrl() ?>start=<?php echo $cars_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($cars_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $cars_view->pageUrl() ?>start=<?php echo $cars_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $cars_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($cars_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $cars_view->pageUrl() ?>start=<?php echo $cars_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($cars_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $cars_view->pageUrl() ?>start=<?php echo $cars_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $cars_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcarsview" id="fcarsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cars_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cars_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cars">
<input type="hidden" name="modal" value="<?php echo (int)$cars_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($cars->ID->Visible) { // ID ?>
	<tr id="r_ID">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_ID"><?php echo $cars->ID->caption() ?></span></td>
		<td data-name="ID"<?php echo $cars->ID->cellAttributes() ?>>
<span id="el_cars_ID">
<span<?php echo $cars->ID->viewAttributes() ?>>
<?php echo $cars->ID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars->Trademark->Visible) { // Trademark ?>
	<tr id="r_Trademark">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_Trademark"><?php echo $cars->Trademark->caption() ?></span></td>
		<td data-name="Trademark"<?php echo $cars->Trademark->cellAttributes() ?>>
<span id="el_cars_Trademark">
<span<?php echo $cars->Trademark->viewAttributes() ?>>
<?php echo $cars->Trademark->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars->Model->Visible) { // Model ?>
	<tr id="r_Model">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_Model"><?php echo $cars->Model->caption() ?></span></td>
		<td data-name="Model"<?php echo $cars->Model->cellAttributes() ?>>
<span id="el_cars_Model">
<span<?php echo $cars->Model->viewAttributes() ?>>
<?php echo $cars->Model->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars->HP->Visible) { // HP ?>
	<tr id="r_HP">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_HP"><?php echo $cars->HP->caption() ?></span></td>
		<td data-name="HP"<?php echo $cars->HP->cellAttributes() ?>>
<span id="el_cars_HP">
<span<?php echo $cars->HP->viewAttributes() ?>>
<?php echo $cars->HP->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars->Liter->Visible) { // Liter ?>
	<tr id="r_Liter">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_Liter"><?php echo $cars->Liter->caption() ?></span></td>
		<td data-name="Liter"<?php echo $cars->Liter->cellAttributes() ?>>
<span id="el_cars_Liter">
<span<?php echo $cars->Liter->viewAttributes() ?>>
<?php echo $cars->Liter->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars->Cyl->Visible) { // Cyl ?>
	<tr id="r_Cyl">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_Cyl"><?php echo $cars->Cyl->caption() ?></span></td>
		<td data-name="Cyl"<?php echo $cars->Cyl->cellAttributes() ?>>
<span id="el_cars_Cyl">
<span<?php echo $cars->Cyl->viewAttributes() ?>>
<?php echo $cars->Cyl->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars->TransmissSpeedCount->Visible) { // TransmissSpeedCount ?>
	<tr id="r_TransmissSpeedCount">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_TransmissSpeedCount"><?php echo $cars->TransmissSpeedCount->caption() ?></span></td>
		<td data-name="TransmissSpeedCount"<?php echo $cars->TransmissSpeedCount->cellAttributes() ?>>
<span id="el_cars_TransmissSpeedCount">
<span<?php echo $cars->TransmissSpeedCount->viewAttributes() ?>>
<?php echo $cars->TransmissSpeedCount->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars->TransmissAutomatic->Visible) { // TransmissAutomatic ?>
	<tr id="r_TransmissAutomatic">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_TransmissAutomatic"><?php echo $cars->TransmissAutomatic->caption() ?></span></td>
		<td data-name="TransmissAutomatic"<?php echo $cars->TransmissAutomatic->cellAttributes() ?>>
<span id="el_cars_TransmissAutomatic">
<span<?php echo $cars->TransmissAutomatic->viewAttributes() ?>>
<?php echo $cars->TransmissAutomatic->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars->MPG_City->Visible) { // MPG_City ?>
	<tr id="r_MPG_City">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_MPG_City"><?php echo $cars->MPG_City->caption() ?></span></td>
		<td data-name="MPG_City"<?php echo $cars->MPG_City->cellAttributes() ?>>
<span id="el_cars_MPG_City">
<span<?php echo $cars->MPG_City->viewAttributes() ?>>
<?php echo $cars->MPG_City->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars->MPG_Highway->Visible) { // MPG_Highway ?>
	<tr id="r_MPG_Highway">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_MPG_Highway"><?php echo $cars->MPG_Highway->caption() ?></span></td>
		<td data-name="MPG_Highway"<?php echo $cars->MPG_Highway->cellAttributes() ?>>
<span id="el_cars_MPG_Highway">
<span<?php echo $cars->MPG_Highway->viewAttributes() ?>>
<?php echo $cars->MPG_Highway->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars->Category->Visible) { // Category ?>
	<tr id="r_Category">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_Category"><?php echo $cars->Category->caption() ?></span></td>
		<td data-name="Category"<?php echo $cars->Category->cellAttributes() ?>>
<span id="el_cars_Category">
<span<?php echo $cars->Category->viewAttributes() ?>>
<?php echo $cars->Category->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars->Description->Visible) { // Description ?>
	<tr id="r_Description">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_Description"><?php echo $cars->Description->caption() ?></span></td>
		<td data-name="Description"<?php echo $cars->Description->cellAttributes() ?>>
<span id="el_cars_Description">
<span<?php echo $cars->Description->viewAttributes() ?>>
<?php echo $cars->Description->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars->Hyperlink->Visible) { // Hyperlink ?>
	<tr id="r_Hyperlink">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_Hyperlink"><?php echo $cars->Hyperlink->caption() ?></span></td>
		<td data-name="Hyperlink"<?php echo $cars->Hyperlink->cellAttributes() ?>>
<span id="el_cars_Hyperlink">
<span<?php echo $cars->Hyperlink->viewAttributes() ?>>
<?php echo $cars->Hyperlink->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars->Price->Visible) { // Price ?>
	<tr id="r_Price">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_Price"><?php echo $cars->Price->caption() ?></span></td>
		<td data-name="Price"<?php echo $cars->Price->cellAttributes() ?>>
<span id="el_cars_Price">
<span<?php echo $cars->Price->viewAttributes() ?>>
<?php echo $cars->Price->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars->Picture->Visible) { // Picture ?>
	<tr id="r_Picture">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_Picture"><?php echo $cars->Picture->caption() ?></span></td>
		<td data-name="Picture"<?php echo $cars->Picture->cellAttributes() ?>>
<span id="el_cars_Picture">
<span<?php echo $cars->Picture->viewAttributes() ?>>
<?php echo GetFileViewTag($cars->Picture, $cars->Picture->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars->PictureName->Visible) { // PictureName ?>
	<tr id="r_PictureName">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_PictureName"><?php echo $cars->PictureName->caption() ?></span></td>
		<td data-name="PictureName"<?php echo $cars->PictureName->cellAttributes() ?>>
<span id="el_cars_PictureName">
<span<?php echo $cars->PictureName->viewAttributes() ?>>
<?php echo $cars->PictureName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars->PictureSize->Visible) { // PictureSize ?>
	<tr id="r_PictureSize">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_PictureSize"><?php echo $cars->PictureSize->caption() ?></span></td>
		<td data-name="PictureSize"<?php echo $cars->PictureSize->cellAttributes() ?>>
<span id="el_cars_PictureSize">
<span<?php echo $cars->PictureSize->viewAttributes() ?>>
<?php echo $cars->PictureSize->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars->PictureType->Visible) { // PictureType ?>
	<tr id="r_PictureType">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_PictureType"><?php echo $cars->PictureType->caption() ?></span></td>
		<td data-name="PictureType"<?php echo $cars->PictureType->cellAttributes() ?>>
<span id="el_cars_PictureType">
<span<?php echo $cars->PictureType->viewAttributes() ?>>
<?php echo $cars->PictureType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars->PictureWidth->Visible) { // PictureWidth ?>
	<tr id="r_PictureWidth">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_PictureWidth"><?php echo $cars->PictureWidth->caption() ?></span></td>
		<td data-name="PictureWidth"<?php echo $cars->PictureWidth->cellAttributes() ?>>
<span id="el_cars_PictureWidth">
<span<?php echo $cars->PictureWidth->viewAttributes() ?>>
<?php echo $cars->PictureWidth->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars->PictureHeight->Visible) { // PictureHeight ?>
	<tr id="r_PictureHeight">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_PictureHeight"><?php echo $cars->PictureHeight->caption() ?></span></td>
		<td data-name="PictureHeight"<?php echo $cars->PictureHeight->cellAttributes() ?>>
<span id="el_cars_PictureHeight">
<span<?php echo $cars->PictureHeight->viewAttributes() ?>>
<?php echo $cars->PictureHeight->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars->Color->Visible) { // Color ?>
	<tr id="r_Color">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_Color"><?php echo $cars->Color->caption() ?></span></td>
		<td data-name="Color"<?php echo $cars->Color->cellAttributes() ?>>
<span id="el_cars_Color">
<span<?php echo $cars->Color->viewAttributes() ?>>
<?php echo $cars->Color->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$cars_view->IsModal) { ?>
<?php if (!$cars->isExport()) { ?>
<?php if (!isset($cars_view->Pager)) $cars_view->Pager = new PrevNextPager($cars_view->StartRec, $cars_view->DisplayRecs, $cars_view->TotalRecs, $cars_view->AutoHidePager) ?>
<?php if ($cars_view->Pager->RecordCount > 0 && $cars_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($cars_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $cars_view->pageUrl() ?>start=<?php echo $cars_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($cars_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $cars_view->pageUrl() ?>start=<?php echo $cars_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $cars_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($cars_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $cars_view->pageUrl() ?>start=<?php echo $cars_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($cars_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $cars_view->pageUrl() ?>start=<?php echo $cars_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $cars_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$cars_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$cars->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$cars_view->terminate();
?>
