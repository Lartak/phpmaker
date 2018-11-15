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
$orderdetails_list = new orderdetails_list();

// Run the page
$orderdetails_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orderdetails_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$orderdetails->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var forderdetailslist = currentForm = new ew.Form("forderdetailslist", "list");
forderdetailslist.formKeyCountName = '<?php echo $orderdetails_list->FormKeyCountName ?>';

// Form_CustomValidate event
forderdetailslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
forderdetailslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$orderdetails->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($orderdetails_list->TotalRecs > 0 && $orderdetails_list->ExportOptions->visible()) { ?>
<?php $orderdetails_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($orderdetails_list->ImportOptions->visible()) { ?>
<?php $orderdetails_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$orderdetails_list->renderOtherOptions();
?>
<?php $orderdetails_list->showPageHeader(); ?>
<?php
$orderdetails_list->showMessage();
?>
<?php if ($orderdetails_list->TotalRecs > 0 || $orderdetails->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($orderdetails_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> orderdetails">
<?php if (!$orderdetails->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$orderdetails->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($orderdetails_list->Pager)) $orderdetails_list->Pager = new PrevNextPager($orderdetails_list->StartRec, $orderdetails_list->DisplayRecs, $orderdetails_list->TotalRecs, $orderdetails_list->AutoHidePager) ?>
<?php if ($orderdetails_list->Pager->RecordCount > 0 && $orderdetails_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($orderdetails_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $orderdetails_list->pageUrl() ?>start=<?php echo $orderdetails_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($orderdetails_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $orderdetails_list->pageUrl() ?>start=<?php echo $orderdetails_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $orderdetails_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($orderdetails_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $orderdetails_list->pageUrl() ?>start=<?php echo $orderdetails_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($orderdetails_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $orderdetails_list->pageUrl() ?>start=<?php echo $orderdetails_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $orderdetails_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($orderdetails_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $orderdetails_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $orderdetails_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $orderdetails_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($orderdetails_list->TotalRecs > 0 && (!$orderdetails_list->AutoHidePageSizeSelector || $orderdetails_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="orderdetails">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($orderdetails_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($orderdetails_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($orderdetails_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($orderdetails->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($orderdetails_list->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="forderdetailslist" id="forderdetailslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($orderdetails_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $orderdetails_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orderdetails">
<div id="gmp_orderdetails" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($orderdetails_list->TotalRecs > 0 || $orderdetails->isGridEdit()) { ?>
<table id="tbl_orderdetailslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$orderdetails_list->RowType = ROWTYPE_HEADER;

// Render list options
$orderdetails_list->renderListOptions();

// Render list options (header, left)
$orderdetails_list->ListOptions->render("header", "left");
?>
<?php if ($orderdetails->OrderID->Visible) { // OrderID ?>
	<?php if ($orderdetails->sortUrl($orderdetails->OrderID) == "") { ?>
		<th data-name="OrderID" class="<?php echo $orderdetails->OrderID->headerCellClass() ?>"><div id="elh_orderdetails_OrderID" class="orderdetails_OrderID"><div class="ew-table-header-caption"><?php echo $orderdetails->OrderID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OrderID" class="<?php echo $orderdetails->OrderID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orderdetails->SortUrl($orderdetails->OrderID) ?>',1);"><div id="elh_orderdetails_OrderID" class="orderdetails_OrderID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orderdetails->OrderID->caption() ?></span><span class="ew-table-header-sort"><?php if ($orderdetails->OrderID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orderdetails->OrderID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orderdetails->ProductID->Visible) { // ProductID ?>
	<?php if ($orderdetails->sortUrl($orderdetails->ProductID) == "") { ?>
		<th data-name="ProductID" class="<?php echo $orderdetails->ProductID->headerCellClass() ?>"><div id="elh_orderdetails_ProductID" class="orderdetails_ProductID"><div class="ew-table-header-caption"><?php echo $orderdetails->ProductID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductID" class="<?php echo $orderdetails->ProductID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orderdetails->SortUrl($orderdetails->ProductID) ?>',1);"><div id="elh_orderdetails_ProductID" class="orderdetails_ProductID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orderdetails->ProductID->caption() ?></span><span class="ew-table-header-sort"><?php if ($orderdetails->ProductID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orderdetails->ProductID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orderdetails->UnitPrice->Visible) { // UnitPrice ?>
	<?php if ($orderdetails->sortUrl($orderdetails->UnitPrice) == "") { ?>
		<th data-name="UnitPrice" class="<?php echo $orderdetails->UnitPrice->headerCellClass() ?>"><div id="elh_orderdetails_UnitPrice" class="orderdetails_UnitPrice"><div class="ew-table-header-caption"><?php echo $orderdetails->UnitPrice->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitPrice" class="<?php echo $orderdetails->UnitPrice->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orderdetails->SortUrl($orderdetails->UnitPrice) ?>',1);"><div id="elh_orderdetails_UnitPrice" class="orderdetails_UnitPrice">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orderdetails->UnitPrice->caption() ?></span><span class="ew-table-header-sort"><?php if ($orderdetails->UnitPrice->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orderdetails->UnitPrice->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orderdetails->Quantity->Visible) { // Quantity ?>
	<?php if ($orderdetails->sortUrl($orderdetails->Quantity) == "") { ?>
		<th data-name="Quantity" class="<?php echo $orderdetails->Quantity->headerCellClass() ?>"><div id="elh_orderdetails_Quantity" class="orderdetails_Quantity"><div class="ew-table-header-caption"><?php echo $orderdetails->Quantity->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Quantity" class="<?php echo $orderdetails->Quantity->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orderdetails->SortUrl($orderdetails->Quantity) ?>',1);"><div id="elh_orderdetails_Quantity" class="orderdetails_Quantity">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orderdetails->Quantity->caption() ?></span><span class="ew-table-header-sort"><?php if ($orderdetails->Quantity->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orderdetails->Quantity->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orderdetails->Discount->Visible) { // Discount ?>
	<?php if ($orderdetails->sortUrl($orderdetails->Discount) == "") { ?>
		<th data-name="Discount" class="<?php echo $orderdetails->Discount->headerCellClass() ?>"><div id="elh_orderdetails_Discount" class="orderdetails_Discount"><div class="ew-table-header-caption"><?php echo $orderdetails->Discount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Discount" class="<?php echo $orderdetails->Discount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orderdetails->SortUrl($orderdetails->Discount) ?>',1);"><div id="elh_orderdetails_Discount" class="orderdetails_Discount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orderdetails->Discount->caption() ?></span><span class="ew-table-header-sort"><?php if ($orderdetails->Discount->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orderdetails->Discount->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$orderdetails_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($orderdetails->ExportAll && $orderdetails->isExport()) {
	$orderdetails_list->StopRec = $orderdetails_list->TotalRecs;
} else {

	// Set the last record to display
	if ($orderdetails_list->TotalRecs > $orderdetails_list->StartRec + $orderdetails_list->DisplayRecs - 1)
		$orderdetails_list->StopRec = $orderdetails_list->StartRec + $orderdetails_list->DisplayRecs - 1;
	else
		$orderdetails_list->StopRec = $orderdetails_list->TotalRecs;
}
$orderdetails_list->RecCnt = $orderdetails_list->StartRec - 1;
if ($orderdetails_list->Recordset && !$orderdetails_list->Recordset->EOF) {
	$orderdetails_list->Recordset->moveFirst();
	$selectLimit = $orderdetails_list->UseSelectLimit;
	if (!$selectLimit && $orderdetails_list->StartRec > 1)
		$orderdetails_list->Recordset->move($orderdetails_list->StartRec - 1);
} elseif (!$orderdetails->AllowAddDeleteRow && $orderdetails_list->StopRec == 0) {
	$orderdetails_list->StopRec = $orderdetails->GridAddRowCount;
}

// Initialize aggregate
$orderdetails->RowType = ROWTYPE_AGGREGATEINIT;
$orderdetails->resetAttributes();
$orderdetails_list->renderRow();
while ($orderdetails_list->RecCnt < $orderdetails_list->StopRec) {
	$orderdetails_list->RecCnt++;
	if ($orderdetails_list->RecCnt >= $orderdetails_list->StartRec) {
		$orderdetails_list->RowCnt++;

		// Set up key count
		$orderdetails_list->KeyCount = $orderdetails_list->RowIndex;

		// Init row class and style
		$orderdetails->resetAttributes();
		$orderdetails->CssClass = "";
		if ($orderdetails->isGridAdd()) {
		} else {
			$orderdetails_list->loadRowValues($orderdetails_list->Recordset); // Load row values
		}
		$orderdetails->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$orderdetails->RowAttrs = array_merge($orderdetails->RowAttrs, array('data-rowindex'=>$orderdetails_list->RowCnt, 'id'=>'r' . $orderdetails_list->RowCnt . '_orderdetails', 'data-rowtype'=>$orderdetails->RowType));

		// Render row
		$orderdetails_list->renderRow();

		// Render list options
		$orderdetails_list->renderListOptions();
?>
	<tr<?php echo $orderdetails->rowAttributes() ?>>
<?php

// Render list options (body, left)
$orderdetails_list->ListOptions->render("body", "left", $orderdetails_list->RowCnt);
?>
	<?php if ($orderdetails->OrderID->Visible) { // OrderID ?>
		<td data-name="OrderID"<?php echo $orderdetails->OrderID->cellAttributes() ?>>
<span id="el<?php echo $orderdetails_list->RowCnt ?>_orderdetails_OrderID" class="orderdetails_OrderID">
<span<?php echo $orderdetails->OrderID->viewAttributes() ?>>
<?php echo $orderdetails->OrderID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orderdetails->ProductID->Visible) { // ProductID ?>
		<td data-name="ProductID"<?php echo $orderdetails->ProductID->cellAttributes() ?>>
<span id="el<?php echo $orderdetails_list->RowCnt ?>_orderdetails_ProductID" class="orderdetails_ProductID">
<span<?php echo $orderdetails->ProductID->viewAttributes() ?>>
<?php echo $orderdetails->ProductID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orderdetails->UnitPrice->Visible) { // UnitPrice ?>
		<td data-name="UnitPrice"<?php echo $orderdetails->UnitPrice->cellAttributes() ?>>
<span id="el<?php echo $orderdetails_list->RowCnt ?>_orderdetails_UnitPrice" class="orderdetails_UnitPrice">
<span<?php echo $orderdetails->UnitPrice->viewAttributes() ?>>
<?php echo $orderdetails->UnitPrice->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orderdetails->Quantity->Visible) { // Quantity ?>
		<td data-name="Quantity"<?php echo $orderdetails->Quantity->cellAttributes() ?>>
<span id="el<?php echo $orderdetails_list->RowCnt ?>_orderdetails_Quantity" class="orderdetails_Quantity">
<span<?php echo $orderdetails->Quantity->viewAttributes() ?>>
<?php echo $orderdetails->Quantity->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orderdetails->Discount->Visible) { // Discount ?>
		<td data-name="Discount"<?php echo $orderdetails->Discount->cellAttributes() ?>>
<span id="el<?php echo $orderdetails_list->RowCnt ?>_orderdetails_Discount" class="orderdetails_Discount">
<span<?php echo $orderdetails->Discount->viewAttributes() ?>>
<?php echo $orderdetails->Discount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$orderdetails_list->ListOptions->render("body", "right", $orderdetails_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$orderdetails->isGridAdd())
		$orderdetails_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$orderdetails->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($orderdetails_list->Recordset)
	$orderdetails_list->Recordset->Close();
?>
<?php if (!$orderdetails->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$orderdetails->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($orderdetails_list->Pager)) $orderdetails_list->Pager = new PrevNextPager($orderdetails_list->StartRec, $orderdetails_list->DisplayRecs, $orderdetails_list->TotalRecs, $orderdetails_list->AutoHidePager) ?>
<?php if ($orderdetails_list->Pager->RecordCount > 0 && $orderdetails_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($orderdetails_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $orderdetails_list->pageUrl() ?>start=<?php echo $orderdetails_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($orderdetails_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $orderdetails_list->pageUrl() ?>start=<?php echo $orderdetails_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $orderdetails_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($orderdetails_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $orderdetails_list->pageUrl() ?>start=<?php echo $orderdetails_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($orderdetails_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $orderdetails_list->pageUrl() ?>start=<?php echo $orderdetails_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $orderdetails_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($orderdetails_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $orderdetails_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $orderdetails_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $orderdetails_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($orderdetails_list->TotalRecs > 0 && (!$orderdetails_list->AutoHidePageSizeSelector || $orderdetails_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="orderdetails">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($orderdetails_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($orderdetails_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($orderdetails_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($orderdetails->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($orderdetails_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($orderdetails_list->TotalRecs == 0 && !$orderdetails->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($orderdetails_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$orderdetails_list->showPageFooter();
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
$orderdetails_list->terminate();
?>
