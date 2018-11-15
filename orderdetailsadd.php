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
$orderdetails_add = new orderdetails_add();

// Run the page
$orderdetails_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orderdetails_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var forderdetailsadd = currentForm = new ew.Form("forderdetailsadd", "add");

// Validate form
forderdetailsadd.validate = function() {
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
		<?php if ($orderdetails_add->OrderID->Required) { ?>
			elm = this.getElements("x" + infix + "_OrderID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orderdetails->OrderID->caption(), $orderdetails->OrderID->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_OrderID");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($orderdetails->OrderID->errorMessage()) ?>");
		<?php if ($orderdetails_add->ProductID->Required) { ?>
			elm = this.getElements("x" + infix + "_ProductID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orderdetails->ProductID->caption(), $orderdetails->ProductID->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_ProductID");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($orderdetails->ProductID->errorMessage()) ?>");
		<?php if ($orderdetails_add->UnitPrice->Required) { ?>
			elm = this.getElements("x" + infix + "_UnitPrice");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orderdetails->UnitPrice->caption(), $orderdetails->UnitPrice->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_UnitPrice");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($orderdetails->UnitPrice->errorMessage()) ?>");
		<?php if ($orderdetails_add->Quantity->Required) { ?>
			elm = this.getElements("x" + infix + "_Quantity");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orderdetails->Quantity->caption(), $orderdetails->Quantity->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Quantity");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($orderdetails->Quantity->errorMessage()) ?>");
		<?php if ($orderdetails_add->Discount->Required) { ?>
			elm = this.getElements("x" + infix + "_Discount");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orderdetails->Discount->caption(), $orderdetails->Discount->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Discount");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($orderdetails->Discount->errorMessage()) ?>");

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
forderdetailsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
forderdetailsadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $orderdetails_add->showPageHeader(); ?>
<?php
$orderdetails_add->showMessage();
?>
<form name="forderdetailsadd" id="forderdetailsadd" class="<?php echo $orderdetails_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($orderdetails_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $orderdetails_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orderdetails">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$orderdetails_add->IsModal ?>">
<?php if (!$orderdetails_add->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($orderdetails_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_orderdetailsadd" class="table ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($orderdetails->OrderID->Visible) { // OrderID ?>
<?php if ($orderdetails_add->IsMobileOrModal) { ?>
	<div id="r_OrderID" class="form-group row">
		<label id="elh_orderdetails_OrderID" for="x_OrderID" class="<?php echo $orderdetails_add->LeftColumnClass ?>"><?php echo $orderdetails->OrderID->caption() ?><?php echo ($orderdetails->OrderID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orderdetails_add->RightColumnClass ?>"><div<?php echo $orderdetails->OrderID->cellAttributes() ?>>
<span id="el_orderdetails_OrderID">
<input type="text" data-table="orderdetails" data-field="x_OrderID" name="x_OrderID" id="x_OrderID" size="30" placeholder="<?php echo HtmlEncode($orderdetails->OrderID->getPlaceHolder()) ?>" value="<?php echo $orderdetails->OrderID->EditValue ?>"<?php echo $orderdetails->OrderID->editAttributes() ?>>
</span>
<?php echo $orderdetails->OrderID->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_OrderID">
		<td class="<?php echo $orderdetails_add->TableLeftColumnClass ?>"><span id="elh_orderdetails_OrderID"><?php echo $orderdetails->OrderID->caption() ?><?php echo ($orderdetails->OrderID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $orderdetails->OrderID->cellAttributes() ?>>
<span id="el_orderdetails_OrderID">
<input type="text" data-table="orderdetails" data-field="x_OrderID" name="x_OrderID" id="x_OrderID" size="30" placeholder="<?php echo HtmlEncode($orderdetails->OrderID->getPlaceHolder()) ?>" value="<?php echo $orderdetails->OrderID->EditValue ?>"<?php echo $orderdetails->OrderID->editAttributes() ?>>
</span>
<?php echo $orderdetails->OrderID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($orderdetails->ProductID->Visible) { // ProductID ?>
<?php if ($orderdetails_add->IsMobileOrModal) { ?>
	<div id="r_ProductID" class="form-group row">
		<label id="elh_orderdetails_ProductID" for="x_ProductID" class="<?php echo $orderdetails_add->LeftColumnClass ?>"><?php echo $orderdetails->ProductID->caption() ?><?php echo ($orderdetails->ProductID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orderdetails_add->RightColumnClass ?>"><div<?php echo $orderdetails->ProductID->cellAttributes() ?>>
<span id="el_orderdetails_ProductID">
<input type="text" data-table="orderdetails" data-field="x_ProductID" name="x_ProductID" id="x_ProductID" size="30" placeholder="<?php echo HtmlEncode($orderdetails->ProductID->getPlaceHolder()) ?>" value="<?php echo $orderdetails->ProductID->EditValue ?>"<?php echo $orderdetails->ProductID->editAttributes() ?>>
</span>
<?php echo $orderdetails->ProductID->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ProductID">
		<td class="<?php echo $orderdetails_add->TableLeftColumnClass ?>"><span id="elh_orderdetails_ProductID"><?php echo $orderdetails->ProductID->caption() ?><?php echo ($orderdetails->ProductID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $orderdetails->ProductID->cellAttributes() ?>>
<span id="el_orderdetails_ProductID">
<input type="text" data-table="orderdetails" data-field="x_ProductID" name="x_ProductID" id="x_ProductID" size="30" placeholder="<?php echo HtmlEncode($orderdetails->ProductID->getPlaceHolder()) ?>" value="<?php echo $orderdetails->ProductID->EditValue ?>"<?php echo $orderdetails->ProductID->editAttributes() ?>>
</span>
<?php echo $orderdetails->ProductID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($orderdetails->UnitPrice->Visible) { // UnitPrice ?>
<?php if ($orderdetails_add->IsMobileOrModal) { ?>
	<div id="r_UnitPrice" class="form-group row">
		<label id="elh_orderdetails_UnitPrice" for="x_UnitPrice" class="<?php echo $orderdetails_add->LeftColumnClass ?>"><?php echo $orderdetails->UnitPrice->caption() ?><?php echo ($orderdetails->UnitPrice->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orderdetails_add->RightColumnClass ?>"><div<?php echo $orderdetails->UnitPrice->cellAttributes() ?>>
<span id="el_orderdetails_UnitPrice">
<input type="text" data-table="orderdetails" data-field="x_UnitPrice" name="x_UnitPrice" id="x_UnitPrice" size="30" placeholder="<?php echo HtmlEncode($orderdetails->UnitPrice->getPlaceHolder()) ?>" value="<?php echo $orderdetails->UnitPrice->EditValue ?>"<?php echo $orderdetails->UnitPrice->editAttributes() ?>>
</span>
<?php echo $orderdetails->UnitPrice->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_UnitPrice">
		<td class="<?php echo $orderdetails_add->TableLeftColumnClass ?>"><span id="elh_orderdetails_UnitPrice"><?php echo $orderdetails->UnitPrice->caption() ?><?php echo ($orderdetails->UnitPrice->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $orderdetails->UnitPrice->cellAttributes() ?>>
<span id="el_orderdetails_UnitPrice">
<input type="text" data-table="orderdetails" data-field="x_UnitPrice" name="x_UnitPrice" id="x_UnitPrice" size="30" placeholder="<?php echo HtmlEncode($orderdetails->UnitPrice->getPlaceHolder()) ?>" value="<?php echo $orderdetails->UnitPrice->EditValue ?>"<?php echo $orderdetails->UnitPrice->editAttributes() ?>>
</span>
<?php echo $orderdetails->UnitPrice->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($orderdetails->Quantity->Visible) { // Quantity ?>
<?php if ($orderdetails_add->IsMobileOrModal) { ?>
	<div id="r_Quantity" class="form-group row">
		<label id="elh_orderdetails_Quantity" for="x_Quantity" class="<?php echo $orderdetails_add->LeftColumnClass ?>"><?php echo $orderdetails->Quantity->caption() ?><?php echo ($orderdetails->Quantity->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orderdetails_add->RightColumnClass ?>"><div<?php echo $orderdetails->Quantity->cellAttributes() ?>>
<span id="el_orderdetails_Quantity">
<input type="text" data-table="orderdetails" data-field="x_Quantity" name="x_Quantity" id="x_Quantity" size="30" placeholder="<?php echo HtmlEncode($orderdetails->Quantity->getPlaceHolder()) ?>" value="<?php echo $orderdetails->Quantity->EditValue ?>"<?php echo $orderdetails->Quantity->editAttributes() ?>>
</span>
<?php echo $orderdetails->Quantity->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Quantity">
		<td class="<?php echo $orderdetails_add->TableLeftColumnClass ?>"><span id="elh_orderdetails_Quantity"><?php echo $orderdetails->Quantity->caption() ?><?php echo ($orderdetails->Quantity->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $orderdetails->Quantity->cellAttributes() ?>>
<span id="el_orderdetails_Quantity">
<input type="text" data-table="orderdetails" data-field="x_Quantity" name="x_Quantity" id="x_Quantity" size="30" placeholder="<?php echo HtmlEncode($orderdetails->Quantity->getPlaceHolder()) ?>" value="<?php echo $orderdetails->Quantity->EditValue ?>"<?php echo $orderdetails->Quantity->editAttributes() ?>>
</span>
<?php echo $orderdetails->Quantity->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($orderdetails->Discount->Visible) { // Discount ?>
<?php if ($orderdetails_add->IsMobileOrModal) { ?>
	<div id="r_Discount" class="form-group row">
		<label id="elh_orderdetails_Discount" for="x_Discount" class="<?php echo $orderdetails_add->LeftColumnClass ?>"><?php echo $orderdetails->Discount->caption() ?><?php echo ($orderdetails->Discount->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orderdetails_add->RightColumnClass ?>"><div<?php echo $orderdetails->Discount->cellAttributes() ?>>
<span id="el_orderdetails_Discount">
<input type="text" data-table="orderdetails" data-field="x_Discount" name="x_Discount" id="x_Discount" size="30" placeholder="<?php echo HtmlEncode($orderdetails->Discount->getPlaceHolder()) ?>" value="<?php echo $orderdetails->Discount->EditValue ?>"<?php echo $orderdetails->Discount->editAttributes() ?>>
</span>
<?php echo $orderdetails->Discount->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Discount">
		<td class="<?php echo $orderdetails_add->TableLeftColumnClass ?>"><span id="elh_orderdetails_Discount"><?php echo $orderdetails->Discount->caption() ?><?php echo ($orderdetails->Discount->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $orderdetails->Discount->cellAttributes() ?>>
<span id="el_orderdetails_Discount">
<input type="text" data-table="orderdetails" data-field="x_Discount" name="x_Discount" id="x_Discount" size="30" placeholder="<?php echo HtmlEncode($orderdetails->Discount->getPlaceHolder()) ?>" value="<?php echo $orderdetails->Discount->EditValue ?>"<?php echo $orderdetails->Discount->editAttributes() ?>>
</span>
<?php echo $orderdetails->Discount->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($orderdetails_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$orderdetails_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $orderdetails_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $orderdetails_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$orderdetails_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$orderdetails_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$orderdetails_add->terminate();
?>
