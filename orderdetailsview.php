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
$orderdetails_view = new orderdetails_view();

// Run the page
$orderdetails_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orderdetails_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$orderdetails->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var forderdetailsview = currentForm = new ew.Form("forderdetailsview", "view");

// Form_CustomValidate event
forderdetailsview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
forderdetailsview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$orderdetails->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $orderdetails_view->ExportOptions->render("body") ?>
<?php
	foreach ($orderdetails_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $orderdetails_view->showPageHeader(); ?>
<?php
$orderdetails_view->showMessage();
?>
<?php if (!$orderdetails_view->IsModal) { ?>
<?php if (!$orderdetails->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($orderdetails_view->Pager)) $orderdetails_view->Pager = new PrevNextPager($orderdetails_view->StartRec, $orderdetails_view->DisplayRecs, $orderdetails_view->TotalRecs, $orderdetails_view->AutoHidePager) ?>
<?php if ($orderdetails_view->Pager->RecordCount > 0 && $orderdetails_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($orderdetails_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $orderdetails_view->pageUrl() ?>start=<?php echo $orderdetails_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($orderdetails_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $orderdetails_view->pageUrl() ?>start=<?php echo $orderdetails_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $orderdetails_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($orderdetails_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $orderdetails_view->pageUrl() ?>start=<?php echo $orderdetails_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($orderdetails_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $orderdetails_view->pageUrl() ?>start=<?php echo $orderdetails_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $orderdetails_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="forderdetailsview" id="forderdetailsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($orderdetails_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $orderdetails_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orderdetails">
<input type="hidden" name="modal" value="<?php echo (int)$orderdetails_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($orderdetails->OrderID->Visible) { // OrderID ?>
	<tr id="r_OrderID">
		<td class="<?php echo $orderdetails_view->TableLeftColumnClass ?>"><span id="elh_orderdetails_OrderID"><?php echo $orderdetails->OrderID->caption() ?></span></td>
		<td data-name="OrderID"<?php echo $orderdetails->OrderID->cellAttributes() ?>>
<span id="el_orderdetails_OrderID">
<span<?php echo $orderdetails->OrderID->viewAttributes() ?>>
<?php echo $orderdetails->OrderID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orderdetails->ProductID->Visible) { // ProductID ?>
	<tr id="r_ProductID">
		<td class="<?php echo $orderdetails_view->TableLeftColumnClass ?>"><span id="elh_orderdetails_ProductID"><?php echo $orderdetails->ProductID->caption() ?></span></td>
		<td data-name="ProductID"<?php echo $orderdetails->ProductID->cellAttributes() ?>>
<span id="el_orderdetails_ProductID">
<span<?php echo $orderdetails->ProductID->viewAttributes() ?>>
<?php echo $orderdetails->ProductID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orderdetails->UnitPrice->Visible) { // UnitPrice ?>
	<tr id="r_UnitPrice">
		<td class="<?php echo $orderdetails_view->TableLeftColumnClass ?>"><span id="elh_orderdetails_UnitPrice"><?php echo $orderdetails->UnitPrice->caption() ?></span></td>
		<td data-name="UnitPrice"<?php echo $orderdetails->UnitPrice->cellAttributes() ?>>
<span id="el_orderdetails_UnitPrice">
<span<?php echo $orderdetails->UnitPrice->viewAttributes() ?>>
<?php echo $orderdetails->UnitPrice->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orderdetails->Quantity->Visible) { // Quantity ?>
	<tr id="r_Quantity">
		<td class="<?php echo $orderdetails_view->TableLeftColumnClass ?>"><span id="elh_orderdetails_Quantity"><?php echo $orderdetails->Quantity->caption() ?></span></td>
		<td data-name="Quantity"<?php echo $orderdetails->Quantity->cellAttributes() ?>>
<span id="el_orderdetails_Quantity">
<span<?php echo $orderdetails->Quantity->viewAttributes() ?>>
<?php echo $orderdetails->Quantity->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orderdetails->Discount->Visible) { // Discount ?>
	<tr id="r_Discount">
		<td class="<?php echo $orderdetails_view->TableLeftColumnClass ?>"><span id="elh_orderdetails_Discount"><?php echo $orderdetails->Discount->caption() ?></span></td>
		<td data-name="Discount"<?php echo $orderdetails->Discount->cellAttributes() ?>>
<span id="el_orderdetails_Discount">
<span<?php echo $orderdetails->Discount->viewAttributes() ?>>
<?php echo $orderdetails->Discount->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$orderdetails_view->IsModal) { ?>
<?php if (!$orderdetails->isExport()) { ?>
<?php if (!isset($orderdetails_view->Pager)) $orderdetails_view->Pager = new PrevNextPager($orderdetails_view->StartRec, $orderdetails_view->DisplayRecs, $orderdetails_view->TotalRecs, $orderdetails_view->AutoHidePager) ?>
<?php if ($orderdetails_view->Pager->RecordCount > 0 && $orderdetails_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($orderdetails_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $orderdetails_view->pageUrl() ?>start=<?php echo $orderdetails_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($orderdetails_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $orderdetails_view->pageUrl() ?>start=<?php echo $orderdetails_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $orderdetails_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($orderdetails_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $orderdetails_view->pageUrl() ?>start=<?php echo $orderdetails_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($orderdetails_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $orderdetails_view->pageUrl() ?>start=<?php echo $orderdetails_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $orderdetails_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$orderdetails_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$orderdetails->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$orderdetails_view->terminate();
?>
