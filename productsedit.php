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
$products_edit = new products_edit();

// Run the page
$products_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$products_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fproductsedit = currentForm = new ew.Form("fproductsedit", "edit");

// Validate form
fproductsedit.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		<?php if ($products_edit->ProductID->Required) { ?>
			elm = this.getElements("x" + infix + "_ProductID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products->ProductID->caption(), $products->ProductID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($products_edit->ProductName->Required) { ?>
			elm = this.getElements("x" + infix + "_ProductName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products->ProductName->caption(), $products->ProductName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($products_edit->SupplierID->Required) { ?>
			elm = this.getElements("x" + infix + "_SupplierID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products->SupplierID->caption(), $products->SupplierID->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_SupplierID");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($products->SupplierID->errorMessage()) ?>");
		<?php if ($products_edit->CategoryID->Required) { ?>
			elm = this.getElements("x" + infix + "_CategoryID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products->CategoryID->caption(), $products->CategoryID->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_CategoryID");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($products->CategoryID->errorMessage()) ?>");
		<?php if ($products_edit->QuantityPerUnit->Required) { ?>
			elm = this.getElements("x" + infix + "_QuantityPerUnit");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products->QuantityPerUnit->caption(), $products->QuantityPerUnit->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($products_edit->UnitPrice->Required) { ?>
			elm = this.getElements("x" + infix + "_UnitPrice");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products->UnitPrice->caption(), $products->UnitPrice->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_UnitPrice");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($products->UnitPrice->errorMessage()) ?>");
		<?php if ($products_edit->UnitsInStock->Required) { ?>
			elm = this.getElements("x" + infix + "_UnitsInStock");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products->UnitsInStock->caption(), $products->UnitsInStock->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_UnitsInStock");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($products->UnitsInStock->errorMessage()) ?>");
		<?php if ($products_edit->UnitsOnOrder->Required) { ?>
			elm = this.getElements("x" + infix + "_UnitsOnOrder");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products->UnitsOnOrder->caption(), $products->UnitsOnOrder->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_UnitsOnOrder");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($products->UnitsOnOrder->errorMessage()) ?>");
		<?php if ($products_edit->ReorderLevel->Required) { ?>
			elm = this.getElements("x" + infix + "_ReorderLevel");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products->ReorderLevel->caption(), $products->ReorderLevel->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_ReorderLevel");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($products->ReorderLevel->errorMessage()) ?>");
		<?php if ($products_edit->Discontinued->Required) { ?>
			elm = this.getElements("x" + infix + "_Discontinued[]");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products->Discontinued->caption(), $products->Discontinued->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ew.forms[val])
			if (!ew.forms[val].validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
fproductsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproductsedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fproductsedit.lists["x_Discontinued[]"] = <?php echo $products_edit->Discontinued->Lookup->toClientList() ?>;
fproductsedit.lists["x_Discontinued[]"].options = <?php echo JsonEncode($products_edit->Discontinued->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $products_edit->showPageHeader(); ?>
<?php
$products_edit->showMessage();
?>
<?php if (!$products_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($products_edit->Pager)) $products_edit->Pager = new PrevNextPager($products_edit->StartRec, $products_edit->DisplayRecs, $products_edit->TotalRecs, $products_edit->AutoHidePager) ?>
<?php if ($products_edit->Pager->RecordCount > 0 && $products_edit->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($products_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $products_edit->pageUrl() ?>start=<?php echo $products_edit->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($products_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $products_edit->pageUrl() ?>start=<?php echo $products_edit->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $products_edit->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($products_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $products_edit->pageUrl() ?>start=<?php echo $products_edit->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($products_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $products_edit->pageUrl() ?>start=<?php echo $products_edit->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $products_edit->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fproductsedit" id="fproductsedit" class="<?php echo $products_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($products_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $products_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="products">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$products_edit->IsModal ?>">
<?php if (!$products_edit->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($products_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_productsedit" class="table ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($products->ProductID->Visible) { // ProductID ?>
<?php if ($products_edit->IsMobileOrModal) { ?>
	<div id="r_ProductID" class="form-group row">
		<label id="elh_products_ProductID" class="<?php echo $products_edit->LeftColumnClass ?>"><?php echo $products->ProductID->caption() ?><?php echo ($products->ProductID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_edit->RightColumnClass ?>"><div<?php echo $products->ProductID->cellAttributes() ?>>
<span id="el_products_ProductID">
<span<?php echo $products->ProductID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($products->ProductID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="products" data-field="x_ProductID" name="x_ProductID" id="x_ProductID" value="<?php echo HtmlEncode($products->ProductID->CurrentValue) ?>">
<?php echo $products->ProductID->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ProductID">
		<td class="<?php echo $products_edit->TableLeftColumnClass ?>"><span id="elh_products_ProductID"><?php echo $products->ProductID->caption() ?><?php echo ($products->ProductID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $products->ProductID->cellAttributes() ?>>
<span id="el_products_ProductID">
<span<?php echo $products->ProductID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($products->ProductID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="products" data-field="x_ProductID" name="x_ProductID" id="x_ProductID" value="<?php echo HtmlEncode($products->ProductID->CurrentValue) ?>">
<?php echo $products->ProductID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($products->ProductName->Visible) { // ProductName ?>
<?php if ($products_edit->IsMobileOrModal) { ?>
	<div id="r_ProductName" class="form-group row">
		<label id="elh_products_ProductName" for="x_ProductName" class="<?php echo $products_edit->LeftColumnClass ?>"><?php echo $products->ProductName->caption() ?><?php echo ($products->ProductName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_edit->RightColumnClass ?>"><div<?php echo $products->ProductName->cellAttributes() ?>>
<span id="el_products_ProductName">
<input type="text" data-table="products" data-field="x_ProductName" name="x_ProductName" id="x_ProductName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($products->ProductName->getPlaceHolder()) ?>" value="<?php echo $products->ProductName->EditValue ?>"<?php echo $products->ProductName->editAttributes() ?>>
</span>
<?php echo $products->ProductName->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ProductName">
		<td class="<?php echo $products_edit->TableLeftColumnClass ?>"><span id="elh_products_ProductName"><?php echo $products->ProductName->caption() ?><?php echo ($products->ProductName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $products->ProductName->cellAttributes() ?>>
<span id="el_products_ProductName">
<input type="text" data-table="products" data-field="x_ProductName" name="x_ProductName" id="x_ProductName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($products->ProductName->getPlaceHolder()) ?>" value="<?php echo $products->ProductName->EditValue ?>"<?php echo $products->ProductName->editAttributes() ?>>
</span>
<?php echo $products->ProductName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($products->SupplierID->Visible) { // SupplierID ?>
<?php if ($products_edit->IsMobileOrModal) { ?>
	<div id="r_SupplierID" class="form-group row">
		<label id="elh_products_SupplierID" for="x_SupplierID" class="<?php echo $products_edit->LeftColumnClass ?>"><?php echo $products->SupplierID->caption() ?><?php echo ($products->SupplierID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_edit->RightColumnClass ?>"><div<?php echo $products->SupplierID->cellAttributes() ?>>
<span id="el_products_SupplierID">
<input type="text" data-table="products" data-field="x_SupplierID" name="x_SupplierID" id="x_SupplierID" size="30" placeholder="<?php echo HtmlEncode($products->SupplierID->getPlaceHolder()) ?>" value="<?php echo $products->SupplierID->EditValue ?>"<?php echo $products->SupplierID->editAttributes() ?>>
</span>
<?php echo $products->SupplierID->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_SupplierID">
		<td class="<?php echo $products_edit->TableLeftColumnClass ?>"><span id="elh_products_SupplierID"><?php echo $products->SupplierID->caption() ?><?php echo ($products->SupplierID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $products->SupplierID->cellAttributes() ?>>
<span id="el_products_SupplierID">
<input type="text" data-table="products" data-field="x_SupplierID" name="x_SupplierID" id="x_SupplierID" size="30" placeholder="<?php echo HtmlEncode($products->SupplierID->getPlaceHolder()) ?>" value="<?php echo $products->SupplierID->EditValue ?>"<?php echo $products->SupplierID->editAttributes() ?>>
</span>
<?php echo $products->SupplierID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($products->CategoryID->Visible) { // CategoryID ?>
<?php if ($products_edit->IsMobileOrModal) { ?>
	<div id="r_CategoryID" class="form-group row">
		<label id="elh_products_CategoryID" for="x_CategoryID" class="<?php echo $products_edit->LeftColumnClass ?>"><?php echo $products->CategoryID->caption() ?><?php echo ($products->CategoryID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_edit->RightColumnClass ?>"><div<?php echo $products->CategoryID->cellAttributes() ?>>
<span id="el_products_CategoryID">
<input type="text" data-table="products" data-field="x_CategoryID" name="x_CategoryID" id="x_CategoryID" size="30" placeholder="<?php echo HtmlEncode($products->CategoryID->getPlaceHolder()) ?>" value="<?php echo $products->CategoryID->EditValue ?>"<?php echo $products->CategoryID->editAttributes() ?>>
</span>
<?php echo $products->CategoryID->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_CategoryID">
		<td class="<?php echo $products_edit->TableLeftColumnClass ?>"><span id="elh_products_CategoryID"><?php echo $products->CategoryID->caption() ?><?php echo ($products->CategoryID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $products->CategoryID->cellAttributes() ?>>
<span id="el_products_CategoryID">
<input type="text" data-table="products" data-field="x_CategoryID" name="x_CategoryID" id="x_CategoryID" size="30" placeholder="<?php echo HtmlEncode($products->CategoryID->getPlaceHolder()) ?>" value="<?php echo $products->CategoryID->EditValue ?>"<?php echo $products->CategoryID->editAttributes() ?>>
</span>
<?php echo $products->CategoryID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($products->QuantityPerUnit->Visible) { // QuantityPerUnit ?>
<?php if ($products_edit->IsMobileOrModal) { ?>
	<div id="r_QuantityPerUnit" class="form-group row">
		<label id="elh_products_QuantityPerUnit" for="x_QuantityPerUnit" class="<?php echo $products_edit->LeftColumnClass ?>"><?php echo $products->QuantityPerUnit->caption() ?><?php echo ($products->QuantityPerUnit->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_edit->RightColumnClass ?>"><div<?php echo $products->QuantityPerUnit->cellAttributes() ?>>
<span id="el_products_QuantityPerUnit">
<input type="text" data-table="products" data-field="x_QuantityPerUnit" name="x_QuantityPerUnit" id="x_QuantityPerUnit" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($products->QuantityPerUnit->getPlaceHolder()) ?>" value="<?php echo $products->QuantityPerUnit->EditValue ?>"<?php echo $products->QuantityPerUnit->editAttributes() ?>>
</span>
<?php echo $products->QuantityPerUnit->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_QuantityPerUnit">
		<td class="<?php echo $products_edit->TableLeftColumnClass ?>"><span id="elh_products_QuantityPerUnit"><?php echo $products->QuantityPerUnit->caption() ?><?php echo ($products->QuantityPerUnit->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $products->QuantityPerUnit->cellAttributes() ?>>
<span id="el_products_QuantityPerUnit">
<input type="text" data-table="products" data-field="x_QuantityPerUnit" name="x_QuantityPerUnit" id="x_QuantityPerUnit" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($products->QuantityPerUnit->getPlaceHolder()) ?>" value="<?php echo $products->QuantityPerUnit->EditValue ?>"<?php echo $products->QuantityPerUnit->editAttributes() ?>>
</span>
<?php echo $products->QuantityPerUnit->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($products->UnitPrice->Visible) { // UnitPrice ?>
<?php if ($products_edit->IsMobileOrModal) { ?>
	<div id="r_UnitPrice" class="form-group row">
		<label id="elh_products_UnitPrice" for="x_UnitPrice" class="<?php echo $products_edit->LeftColumnClass ?>"><?php echo $products->UnitPrice->caption() ?><?php echo ($products->UnitPrice->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_edit->RightColumnClass ?>"><div<?php echo $products->UnitPrice->cellAttributes() ?>>
<span id="el_products_UnitPrice">
<input type="text" data-table="products" data-field="x_UnitPrice" name="x_UnitPrice" id="x_UnitPrice" size="30" placeholder="<?php echo HtmlEncode($products->UnitPrice->getPlaceHolder()) ?>" value="<?php echo $products->UnitPrice->EditValue ?>"<?php echo $products->UnitPrice->editAttributes() ?>>
</span>
<?php echo $products->UnitPrice->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_UnitPrice">
		<td class="<?php echo $products_edit->TableLeftColumnClass ?>"><span id="elh_products_UnitPrice"><?php echo $products->UnitPrice->caption() ?><?php echo ($products->UnitPrice->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $products->UnitPrice->cellAttributes() ?>>
<span id="el_products_UnitPrice">
<input type="text" data-table="products" data-field="x_UnitPrice" name="x_UnitPrice" id="x_UnitPrice" size="30" placeholder="<?php echo HtmlEncode($products->UnitPrice->getPlaceHolder()) ?>" value="<?php echo $products->UnitPrice->EditValue ?>"<?php echo $products->UnitPrice->editAttributes() ?>>
</span>
<?php echo $products->UnitPrice->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($products->UnitsInStock->Visible) { // UnitsInStock ?>
<?php if ($products_edit->IsMobileOrModal) { ?>
	<div id="r_UnitsInStock" class="form-group row">
		<label id="elh_products_UnitsInStock" for="x_UnitsInStock" class="<?php echo $products_edit->LeftColumnClass ?>"><?php echo $products->UnitsInStock->caption() ?><?php echo ($products->UnitsInStock->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_edit->RightColumnClass ?>"><div<?php echo $products->UnitsInStock->cellAttributes() ?>>
<span id="el_products_UnitsInStock">
<input type="text" data-table="products" data-field="x_UnitsInStock" name="x_UnitsInStock" id="x_UnitsInStock" size="30" placeholder="<?php echo HtmlEncode($products->UnitsInStock->getPlaceHolder()) ?>" value="<?php echo $products->UnitsInStock->EditValue ?>"<?php echo $products->UnitsInStock->editAttributes() ?>>
</span>
<?php echo $products->UnitsInStock->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_UnitsInStock">
		<td class="<?php echo $products_edit->TableLeftColumnClass ?>"><span id="elh_products_UnitsInStock"><?php echo $products->UnitsInStock->caption() ?><?php echo ($products->UnitsInStock->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $products->UnitsInStock->cellAttributes() ?>>
<span id="el_products_UnitsInStock">
<input type="text" data-table="products" data-field="x_UnitsInStock" name="x_UnitsInStock" id="x_UnitsInStock" size="30" placeholder="<?php echo HtmlEncode($products->UnitsInStock->getPlaceHolder()) ?>" value="<?php echo $products->UnitsInStock->EditValue ?>"<?php echo $products->UnitsInStock->editAttributes() ?>>
</span>
<?php echo $products->UnitsInStock->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($products->UnitsOnOrder->Visible) { // UnitsOnOrder ?>
<?php if ($products_edit->IsMobileOrModal) { ?>
	<div id="r_UnitsOnOrder" class="form-group row">
		<label id="elh_products_UnitsOnOrder" for="x_UnitsOnOrder" class="<?php echo $products_edit->LeftColumnClass ?>"><?php echo $products->UnitsOnOrder->caption() ?><?php echo ($products->UnitsOnOrder->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_edit->RightColumnClass ?>"><div<?php echo $products->UnitsOnOrder->cellAttributes() ?>>
<span id="el_products_UnitsOnOrder">
<input type="text" data-table="products" data-field="x_UnitsOnOrder" name="x_UnitsOnOrder" id="x_UnitsOnOrder" size="30" placeholder="<?php echo HtmlEncode($products->UnitsOnOrder->getPlaceHolder()) ?>" value="<?php echo $products->UnitsOnOrder->EditValue ?>"<?php echo $products->UnitsOnOrder->editAttributes() ?>>
</span>
<?php echo $products->UnitsOnOrder->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_UnitsOnOrder">
		<td class="<?php echo $products_edit->TableLeftColumnClass ?>"><span id="elh_products_UnitsOnOrder"><?php echo $products->UnitsOnOrder->caption() ?><?php echo ($products->UnitsOnOrder->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $products->UnitsOnOrder->cellAttributes() ?>>
<span id="el_products_UnitsOnOrder">
<input type="text" data-table="products" data-field="x_UnitsOnOrder" name="x_UnitsOnOrder" id="x_UnitsOnOrder" size="30" placeholder="<?php echo HtmlEncode($products->UnitsOnOrder->getPlaceHolder()) ?>" value="<?php echo $products->UnitsOnOrder->EditValue ?>"<?php echo $products->UnitsOnOrder->editAttributes() ?>>
</span>
<?php echo $products->UnitsOnOrder->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($products->ReorderLevel->Visible) { // ReorderLevel ?>
<?php if ($products_edit->IsMobileOrModal) { ?>
	<div id="r_ReorderLevel" class="form-group row">
		<label id="elh_products_ReorderLevel" for="x_ReorderLevel" class="<?php echo $products_edit->LeftColumnClass ?>"><?php echo $products->ReorderLevel->caption() ?><?php echo ($products->ReorderLevel->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_edit->RightColumnClass ?>"><div<?php echo $products->ReorderLevel->cellAttributes() ?>>
<span id="el_products_ReorderLevel">
<input type="text" data-table="products" data-field="x_ReorderLevel" name="x_ReorderLevel" id="x_ReorderLevel" size="30" placeholder="<?php echo HtmlEncode($products->ReorderLevel->getPlaceHolder()) ?>" value="<?php echo $products->ReorderLevel->EditValue ?>"<?php echo $products->ReorderLevel->editAttributes() ?>>
</span>
<?php echo $products->ReorderLevel->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ReorderLevel">
		<td class="<?php echo $products_edit->TableLeftColumnClass ?>"><span id="elh_products_ReorderLevel"><?php echo $products->ReorderLevel->caption() ?><?php echo ($products->ReorderLevel->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $products->ReorderLevel->cellAttributes() ?>>
<span id="el_products_ReorderLevel">
<input type="text" data-table="products" data-field="x_ReorderLevel" name="x_ReorderLevel" id="x_ReorderLevel" size="30" placeholder="<?php echo HtmlEncode($products->ReorderLevel->getPlaceHolder()) ?>" value="<?php echo $products->ReorderLevel->EditValue ?>"<?php echo $products->ReorderLevel->editAttributes() ?>>
</span>
<?php echo $products->ReorderLevel->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($products->Discontinued->Visible) { // Discontinued ?>
<?php if ($products_edit->IsMobileOrModal) { ?>
	<div id="r_Discontinued" class="form-group row">
		<label id="elh_products_Discontinued" class="<?php echo $products_edit->LeftColumnClass ?>"><?php echo $products->Discontinued->caption() ?><?php echo ($products->Discontinued->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_edit->RightColumnClass ?>"><div<?php echo $products->Discontinued->cellAttributes() ?>>
<span id="el_products_Discontinued">
<?php
$selwrk = (ConvertToBool($products->Discontinued->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="products" data-field="x_Discontinued" name="x_Discontinued[]" id="x_Discontinued[]" value="1"<?php echo $selwrk ?><?php echo $products->Discontinued->editAttributes() ?>>
</span>
<?php echo $products->Discontinued->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Discontinued">
		<td class="<?php echo $products_edit->TableLeftColumnClass ?>"><span id="elh_products_Discontinued"><?php echo $products->Discontinued->caption() ?><?php echo ($products->Discontinued->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $products->Discontinued->cellAttributes() ?>>
<span id="el_products_Discontinued">
<?php
$selwrk = (ConvertToBool($products->Discontinued->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="products" data-field="x_Discontinued" name="x_Discontinued[]" id="x_Discontinued[]" value="1"<?php echo $selwrk ?><?php echo $products->Discontinued->editAttributes() ?>>
</span>
<?php echo $products->Discontinued->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($products_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$products_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $products_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $products_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$products_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
<?php if (!$products_edit->IsModal) { ?>
<?php if (!isset($products_edit->Pager)) $products_edit->Pager = new PrevNextPager($products_edit->StartRec, $products_edit->DisplayRecs, $products_edit->TotalRecs, $products_edit->AutoHidePager) ?>
<?php if ($products_edit->Pager->RecordCount > 0 && $products_edit->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($products_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $products_edit->pageUrl() ?>start=<?php echo $products_edit->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($products_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $products_edit->pageUrl() ?>start=<?php echo $products_edit->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $products_edit->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($products_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $products_edit->pageUrl() ?>start=<?php echo $products_edit->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($products_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $products_edit->pageUrl() ?>start=<?php echo $products_edit->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $products_edit->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$products_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$products_edit->terminate();
?>
