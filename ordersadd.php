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
$orders_add = new orders_add();

// Run the page
$orders_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orders_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fordersadd = currentForm = new ew.Form("fordersadd", "add");

// Validate form
fordersadd.validate = function() {
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
		<?php if ($orders_add->CustomerID->Required) { ?>
			elm = this.getElements("x" + infix + "_CustomerID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders->CustomerID->caption(), $orders->CustomerID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($orders_add->EmployeeID->Required) { ?>
			elm = this.getElements("x" + infix + "_EmployeeID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders->EmployeeID->caption(), $orders->EmployeeID->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_EmployeeID");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($orders->EmployeeID->errorMessage()) ?>");
		<?php if ($orders_add->OrderDate->Required) { ?>
			elm = this.getElements("x" + infix + "_OrderDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders->OrderDate->caption(), $orders->OrderDate->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_OrderDate");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($orders->OrderDate->errorMessage()) ?>");
		<?php if ($orders_add->RequiredDate->Required) { ?>
			elm = this.getElements("x" + infix + "_RequiredDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders->RequiredDate->caption(), $orders->RequiredDate->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_RequiredDate");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($orders->RequiredDate->errorMessage()) ?>");
		<?php if ($orders_add->ShippedDate->Required) { ?>
			elm = this.getElements("x" + infix + "_ShippedDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders->ShippedDate->caption(), $orders->ShippedDate->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_ShippedDate");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($orders->ShippedDate->errorMessage()) ?>");
		<?php if ($orders_add->ShipVia->Required) { ?>
			elm = this.getElements("x" + infix + "_ShipVia");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders->ShipVia->caption(), $orders->ShipVia->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_ShipVia");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($orders->ShipVia->errorMessage()) ?>");
		<?php if ($orders_add->Freight->Required) { ?>
			elm = this.getElements("x" + infix + "_Freight");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders->Freight->caption(), $orders->Freight->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Freight");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($orders->Freight->errorMessage()) ?>");
		<?php if ($orders_add->ShipName->Required) { ?>
			elm = this.getElements("x" + infix + "_ShipName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders->ShipName->caption(), $orders->ShipName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($orders_add->ShipAddress->Required) { ?>
			elm = this.getElements("x" + infix + "_ShipAddress");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders->ShipAddress->caption(), $orders->ShipAddress->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($orders_add->ShipCity->Required) { ?>
			elm = this.getElements("x" + infix + "_ShipCity");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders->ShipCity->caption(), $orders->ShipCity->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($orders_add->ShipRegion->Required) { ?>
			elm = this.getElements("x" + infix + "_ShipRegion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders->ShipRegion->caption(), $orders->ShipRegion->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($orders_add->ShipPostalCode->Required) { ?>
			elm = this.getElements("x" + infix + "_ShipPostalCode");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders->ShipPostalCode->caption(), $orders->ShipPostalCode->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($orders_add->ShipCountry->Required) { ?>
			elm = this.getElements("x" + infix + "_ShipCountry");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders->ShipCountry->caption(), $orders->ShipCountry->RequiredErrorMessage)) ?>");
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
fordersadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fordersadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $orders_add->showPageHeader(); ?>
<?php
$orders_add->showMessage();
?>
<form name="fordersadd" id="fordersadd" class="<?php echo $orders_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($orders_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $orders_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orders">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$orders_add->IsModal ?>">
<?php if (!$orders_add->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($orders_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_ordersadd" class="table ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($orders->CustomerID->Visible) { // CustomerID ?>
<?php if ($orders_add->IsMobileOrModal) { ?>
	<div id="r_CustomerID" class="form-group row">
		<label id="elh_orders_CustomerID" for="x_CustomerID" class="<?php echo $orders_add->LeftColumnClass ?>"><?php echo $orders->CustomerID->caption() ?><?php echo ($orders->CustomerID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_add->RightColumnClass ?>"><div<?php echo $orders->CustomerID->cellAttributes() ?>>
<span id="el_orders_CustomerID">
<input type="text" data-table="orders" data-field="x_CustomerID" name="x_CustomerID" id="x_CustomerID" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($orders->CustomerID->getPlaceHolder()) ?>" value="<?php echo $orders->CustomerID->EditValue ?>"<?php echo $orders->CustomerID->editAttributes() ?>>
</span>
<?php echo $orders->CustomerID->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_CustomerID">
		<td class="<?php echo $orders_add->TableLeftColumnClass ?>"><span id="elh_orders_CustomerID"><?php echo $orders->CustomerID->caption() ?><?php echo ($orders->CustomerID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $orders->CustomerID->cellAttributes() ?>>
<span id="el_orders_CustomerID">
<input type="text" data-table="orders" data-field="x_CustomerID" name="x_CustomerID" id="x_CustomerID" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($orders->CustomerID->getPlaceHolder()) ?>" value="<?php echo $orders->CustomerID->EditValue ?>"<?php echo $orders->CustomerID->editAttributes() ?>>
</span>
<?php echo $orders->CustomerID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($orders->EmployeeID->Visible) { // EmployeeID ?>
<?php if ($orders_add->IsMobileOrModal) { ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_orders_EmployeeID" for="x_EmployeeID" class="<?php echo $orders_add->LeftColumnClass ?>"><?php echo $orders->EmployeeID->caption() ?><?php echo ($orders->EmployeeID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_add->RightColumnClass ?>"><div<?php echo $orders->EmployeeID->cellAttributes() ?>>
<span id="el_orders_EmployeeID">
<input type="text" data-table="orders" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($orders->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $orders->EmployeeID->EditValue ?>"<?php echo $orders->EmployeeID->editAttributes() ?>>
</span>
<?php echo $orders->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_EmployeeID">
		<td class="<?php echo $orders_add->TableLeftColumnClass ?>"><span id="elh_orders_EmployeeID"><?php echo $orders->EmployeeID->caption() ?><?php echo ($orders->EmployeeID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $orders->EmployeeID->cellAttributes() ?>>
<span id="el_orders_EmployeeID">
<input type="text" data-table="orders" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($orders->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $orders->EmployeeID->EditValue ?>"<?php echo $orders->EmployeeID->editAttributes() ?>>
</span>
<?php echo $orders->EmployeeID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($orders->OrderDate->Visible) { // OrderDate ?>
<?php if ($orders_add->IsMobileOrModal) { ?>
	<div id="r_OrderDate" class="form-group row">
		<label id="elh_orders_OrderDate" for="x_OrderDate" class="<?php echo $orders_add->LeftColumnClass ?>"><?php echo $orders->OrderDate->caption() ?><?php echo ($orders->OrderDate->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_add->RightColumnClass ?>"><div<?php echo $orders->OrderDate->cellAttributes() ?>>
<span id="el_orders_OrderDate">
<input type="text" data-table="orders" data-field="x_OrderDate" name="x_OrderDate" id="x_OrderDate" placeholder="<?php echo HtmlEncode($orders->OrderDate->getPlaceHolder()) ?>" value="<?php echo $orders->OrderDate->EditValue ?>"<?php echo $orders->OrderDate->editAttributes() ?>>
</span>
<?php echo $orders->OrderDate->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_OrderDate">
		<td class="<?php echo $orders_add->TableLeftColumnClass ?>"><span id="elh_orders_OrderDate"><?php echo $orders->OrderDate->caption() ?><?php echo ($orders->OrderDate->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $orders->OrderDate->cellAttributes() ?>>
<span id="el_orders_OrderDate">
<input type="text" data-table="orders" data-field="x_OrderDate" name="x_OrderDate" id="x_OrderDate" placeholder="<?php echo HtmlEncode($orders->OrderDate->getPlaceHolder()) ?>" value="<?php echo $orders->OrderDate->EditValue ?>"<?php echo $orders->OrderDate->editAttributes() ?>>
</span>
<?php echo $orders->OrderDate->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($orders->RequiredDate->Visible) { // RequiredDate ?>
<?php if ($orders_add->IsMobileOrModal) { ?>
	<div id="r_RequiredDate" class="form-group row">
		<label id="elh_orders_RequiredDate" for="x_RequiredDate" class="<?php echo $orders_add->LeftColumnClass ?>"><?php echo $orders->RequiredDate->caption() ?><?php echo ($orders->RequiredDate->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_add->RightColumnClass ?>"><div<?php echo $orders->RequiredDate->cellAttributes() ?>>
<span id="el_orders_RequiredDate">
<input type="text" data-table="orders" data-field="x_RequiredDate" name="x_RequiredDate" id="x_RequiredDate" placeholder="<?php echo HtmlEncode($orders->RequiredDate->getPlaceHolder()) ?>" value="<?php echo $orders->RequiredDate->EditValue ?>"<?php echo $orders->RequiredDate->editAttributes() ?>>
</span>
<?php echo $orders->RequiredDate->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_RequiredDate">
		<td class="<?php echo $orders_add->TableLeftColumnClass ?>"><span id="elh_orders_RequiredDate"><?php echo $orders->RequiredDate->caption() ?><?php echo ($orders->RequiredDate->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $orders->RequiredDate->cellAttributes() ?>>
<span id="el_orders_RequiredDate">
<input type="text" data-table="orders" data-field="x_RequiredDate" name="x_RequiredDate" id="x_RequiredDate" placeholder="<?php echo HtmlEncode($orders->RequiredDate->getPlaceHolder()) ?>" value="<?php echo $orders->RequiredDate->EditValue ?>"<?php echo $orders->RequiredDate->editAttributes() ?>>
</span>
<?php echo $orders->RequiredDate->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($orders->ShippedDate->Visible) { // ShippedDate ?>
<?php if ($orders_add->IsMobileOrModal) { ?>
	<div id="r_ShippedDate" class="form-group row">
		<label id="elh_orders_ShippedDate" for="x_ShippedDate" class="<?php echo $orders_add->LeftColumnClass ?>"><?php echo $orders->ShippedDate->caption() ?><?php echo ($orders->ShippedDate->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_add->RightColumnClass ?>"><div<?php echo $orders->ShippedDate->cellAttributes() ?>>
<span id="el_orders_ShippedDate">
<input type="text" data-table="orders" data-field="x_ShippedDate" name="x_ShippedDate" id="x_ShippedDate" placeholder="<?php echo HtmlEncode($orders->ShippedDate->getPlaceHolder()) ?>" value="<?php echo $orders->ShippedDate->EditValue ?>"<?php echo $orders->ShippedDate->editAttributes() ?>>
</span>
<?php echo $orders->ShippedDate->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ShippedDate">
		<td class="<?php echo $orders_add->TableLeftColumnClass ?>"><span id="elh_orders_ShippedDate"><?php echo $orders->ShippedDate->caption() ?><?php echo ($orders->ShippedDate->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $orders->ShippedDate->cellAttributes() ?>>
<span id="el_orders_ShippedDate">
<input type="text" data-table="orders" data-field="x_ShippedDate" name="x_ShippedDate" id="x_ShippedDate" placeholder="<?php echo HtmlEncode($orders->ShippedDate->getPlaceHolder()) ?>" value="<?php echo $orders->ShippedDate->EditValue ?>"<?php echo $orders->ShippedDate->editAttributes() ?>>
</span>
<?php echo $orders->ShippedDate->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($orders->ShipVia->Visible) { // ShipVia ?>
<?php if ($orders_add->IsMobileOrModal) { ?>
	<div id="r_ShipVia" class="form-group row">
		<label id="elh_orders_ShipVia" for="x_ShipVia" class="<?php echo $orders_add->LeftColumnClass ?>"><?php echo $orders->ShipVia->caption() ?><?php echo ($orders->ShipVia->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_add->RightColumnClass ?>"><div<?php echo $orders->ShipVia->cellAttributes() ?>>
<span id="el_orders_ShipVia">
<input type="text" data-table="orders" data-field="x_ShipVia" name="x_ShipVia" id="x_ShipVia" size="30" placeholder="<?php echo HtmlEncode($orders->ShipVia->getPlaceHolder()) ?>" value="<?php echo $orders->ShipVia->EditValue ?>"<?php echo $orders->ShipVia->editAttributes() ?>>
</span>
<?php echo $orders->ShipVia->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ShipVia">
		<td class="<?php echo $orders_add->TableLeftColumnClass ?>"><span id="elh_orders_ShipVia"><?php echo $orders->ShipVia->caption() ?><?php echo ($orders->ShipVia->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $orders->ShipVia->cellAttributes() ?>>
<span id="el_orders_ShipVia">
<input type="text" data-table="orders" data-field="x_ShipVia" name="x_ShipVia" id="x_ShipVia" size="30" placeholder="<?php echo HtmlEncode($orders->ShipVia->getPlaceHolder()) ?>" value="<?php echo $orders->ShipVia->EditValue ?>"<?php echo $orders->ShipVia->editAttributes() ?>>
</span>
<?php echo $orders->ShipVia->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($orders->Freight->Visible) { // Freight ?>
<?php if ($orders_add->IsMobileOrModal) { ?>
	<div id="r_Freight" class="form-group row">
		<label id="elh_orders_Freight" for="x_Freight" class="<?php echo $orders_add->LeftColumnClass ?>"><?php echo $orders->Freight->caption() ?><?php echo ($orders->Freight->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_add->RightColumnClass ?>"><div<?php echo $orders->Freight->cellAttributes() ?>>
<span id="el_orders_Freight">
<input type="text" data-table="orders" data-field="x_Freight" name="x_Freight" id="x_Freight" size="30" placeholder="<?php echo HtmlEncode($orders->Freight->getPlaceHolder()) ?>" value="<?php echo $orders->Freight->EditValue ?>"<?php echo $orders->Freight->editAttributes() ?>>
</span>
<?php echo $orders->Freight->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Freight">
		<td class="<?php echo $orders_add->TableLeftColumnClass ?>"><span id="elh_orders_Freight"><?php echo $orders->Freight->caption() ?><?php echo ($orders->Freight->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $orders->Freight->cellAttributes() ?>>
<span id="el_orders_Freight">
<input type="text" data-table="orders" data-field="x_Freight" name="x_Freight" id="x_Freight" size="30" placeholder="<?php echo HtmlEncode($orders->Freight->getPlaceHolder()) ?>" value="<?php echo $orders->Freight->EditValue ?>"<?php echo $orders->Freight->editAttributes() ?>>
</span>
<?php echo $orders->Freight->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($orders->ShipName->Visible) { // ShipName ?>
<?php if ($orders_add->IsMobileOrModal) { ?>
	<div id="r_ShipName" class="form-group row">
		<label id="elh_orders_ShipName" for="x_ShipName" class="<?php echo $orders_add->LeftColumnClass ?>"><?php echo $orders->ShipName->caption() ?><?php echo ($orders->ShipName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_add->RightColumnClass ?>"><div<?php echo $orders->ShipName->cellAttributes() ?>>
<span id="el_orders_ShipName">
<input type="text" data-table="orders" data-field="x_ShipName" name="x_ShipName" id="x_ShipName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($orders->ShipName->getPlaceHolder()) ?>" value="<?php echo $orders->ShipName->EditValue ?>"<?php echo $orders->ShipName->editAttributes() ?>>
</span>
<?php echo $orders->ShipName->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ShipName">
		<td class="<?php echo $orders_add->TableLeftColumnClass ?>"><span id="elh_orders_ShipName"><?php echo $orders->ShipName->caption() ?><?php echo ($orders->ShipName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $orders->ShipName->cellAttributes() ?>>
<span id="el_orders_ShipName">
<input type="text" data-table="orders" data-field="x_ShipName" name="x_ShipName" id="x_ShipName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($orders->ShipName->getPlaceHolder()) ?>" value="<?php echo $orders->ShipName->EditValue ?>"<?php echo $orders->ShipName->editAttributes() ?>>
</span>
<?php echo $orders->ShipName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($orders->ShipAddress->Visible) { // ShipAddress ?>
<?php if ($orders_add->IsMobileOrModal) { ?>
	<div id="r_ShipAddress" class="form-group row">
		<label id="elh_orders_ShipAddress" for="x_ShipAddress" class="<?php echo $orders_add->LeftColumnClass ?>"><?php echo $orders->ShipAddress->caption() ?><?php echo ($orders->ShipAddress->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_add->RightColumnClass ?>"><div<?php echo $orders->ShipAddress->cellAttributes() ?>>
<span id="el_orders_ShipAddress">
<input type="text" data-table="orders" data-field="x_ShipAddress" name="x_ShipAddress" id="x_ShipAddress" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($orders->ShipAddress->getPlaceHolder()) ?>" value="<?php echo $orders->ShipAddress->EditValue ?>"<?php echo $orders->ShipAddress->editAttributes() ?>>
</span>
<?php echo $orders->ShipAddress->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ShipAddress">
		<td class="<?php echo $orders_add->TableLeftColumnClass ?>"><span id="elh_orders_ShipAddress"><?php echo $orders->ShipAddress->caption() ?><?php echo ($orders->ShipAddress->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $orders->ShipAddress->cellAttributes() ?>>
<span id="el_orders_ShipAddress">
<input type="text" data-table="orders" data-field="x_ShipAddress" name="x_ShipAddress" id="x_ShipAddress" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($orders->ShipAddress->getPlaceHolder()) ?>" value="<?php echo $orders->ShipAddress->EditValue ?>"<?php echo $orders->ShipAddress->editAttributes() ?>>
</span>
<?php echo $orders->ShipAddress->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($orders->ShipCity->Visible) { // ShipCity ?>
<?php if ($orders_add->IsMobileOrModal) { ?>
	<div id="r_ShipCity" class="form-group row">
		<label id="elh_orders_ShipCity" for="x_ShipCity" class="<?php echo $orders_add->LeftColumnClass ?>"><?php echo $orders->ShipCity->caption() ?><?php echo ($orders->ShipCity->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_add->RightColumnClass ?>"><div<?php echo $orders->ShipCity->cellAttributes() ?>>
<span id="el_orders_ShipCity">
<input type="text" data-table="orders" data-field="x_ShipCity" name="x_ShipCity" id="x_ShipCity" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($orders->ShipCity->getPlaceHolder()) ?>" value="<?php echo $orders->ShipCity->EditValue ?>"<?php echo $orders->ShipCity->editAttributes() ?>>
</span>
<?php echo $orders->ShipCity->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ShipCity">
		<td class="<?php echo $orders_add->TableLeftColumnClass ?>"><span id="elh_orders_ShipCity"><?php echo $orders->ShipCity->caption() ?><?php echo ($orders->ShipCity->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $orders->ShipCity->cellAttributes() ?>>
<span id="el_orders_ShipCity">
<input type="text" data-table="orders" data-field="x_ShipCity" name="x_ShipCity" id="x_ShipCity" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($orders->ShipCity->getPlaceHolder()) ?>" value="<?php echo $orders->ShipCity->EditValue ?>"<?php echo $orders->ShipCity->editAttributes() ?>>
</span>
<?php echo $orders->ShipCity->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($orders->ShipRegion->Visible) { // ShipRegion ?>
<?php if ($orders_add->IsMobileOrModal) { ?>
	<div id="r_ShipRegion" class="form-group row">
		<label id="elh_orders_ShipRegion" for="x_ShipRegion" class="<?php echo $orders_add->LeftColumnClass ?>"><?php echo $orders->ShipRegion->caption() ?><?php echo ($orders->ShipRegion->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_add->RightColumnClass ?>"><div<?php echo $orders->ShipRegion->cellAttributes() ?>>
<span id="el_orders_ShipRegion">
<input type="text" data-table="orders" data-field="x_ShipRegion" name="x_ShipRegion" id="x_ShipRegion" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($orders->ShipRegion->getPlaceHolder()) ?>" value="<?php echo $orders->ShipRegion->EditValue ?>"<?php echo $orders->ShipRegion->editAttributes() ?>>
</span>
<?php echo $orders->ShipRegion->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ShipRegion">
		<td class="<?php echo $orders_add->TableLeftColumnClass ?>"><span id="elh_orders_ShipRegion"><?php echo $orders->ShipRegion->caption() ?><?php echo ($orders->ShipRegion->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $orders->ShipRegion->cellAttributes() ?>>
<span id="el_orders_ShipRegion">
<input type="text" data-table="orders" data-field="x_ShipRegion" name="x_ShipRegion" id="x_ShipRegion" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($orders->ShipRegion->getPlaceHolder()) ?>" value="<?php echo $orders->ShipRegion->EditValue ?>"<?php echo $orders->ShipRegion->editAttributes() ?>>
</span>
<?php echo $orders->ShipRegion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($orders->ShipPostalCode->Visible) { // ShipPostalCode ?>
<?php if ($orders_add->IsMobileOrModal) { ?>
	<div id="r_ShipPostalCode" class="form-group row">
		<label id="elh_orders_ShipPostalCode" for="x_ShipPostalCode" class="<?php echo $orders_add->LeftColumnClass ?>"><?php echo $orders->ShipPostalCode->caption() ?><?php echo ($orders->ShipPostalCode->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_add->RightColumnClass ?>"><div<?php echo $orders->ShipPostalCode->cellAttributes() ?>>
<span id="el_orders_ShipPostalCode">
<input type="text" data-table="orders" data-field="x_ShipPostalCode" name="x_ShipPostalCode" id="x_ShipPostalCode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($orders->ShipPostalCode->getPlaceHolder()) ?>" value="<?php echo $orders->ShipPostalCode->EditValue ?>"<?php echo $orders->ShipPostalCode->editAttributes() ?>>
</span>
<?php echo $orders->ShipPostalCode->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ShipPostalCode">
		<td class="<?php echo $orders_add->TableLeftColumnClass ?>"><span id="elh_orders_ShipPostalCode"><?php echo $orders->ShipPostalCode->caption() ?><?php echo ($orders->ShipPostalCode->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $orders->ShipPostalCode->cellAttributes() ?>>
<span id="el_orders_ShipPostalCode">
<input type="text" data-table="orders" data-field="x_ShipPostalCode" name="x_ShipPostalCode" id="x_ShipPostalCode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($orders->ShipPostalCode->getPlaceHolder()) ?>" value="<?php echo $orders->ShipPostalCode->EditValue ?>"<?php echo $orders->ShipPostalCode->editAttributes() ?>>
</span>
<?php echo $orders->ShipPostalCode->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($orders->ShipCountry->Visible) { // ShipCountry ?>
<?php if ($orders_add->IsMobileOrModal) { ?>
	<div id="r_ShipCountry" class="form-group row">
		<label id="elh_orders_ShipCountry" for="x_ShipCountry" class="<?php echo $orders_add->LeftColumnClass ?>"><?php echo $orders->ShipCountry->caption() ?><?php echo ($orders->ShipCountry->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_add->RightColumnClass ?>"><div<?php echo $orders->ShipCountry->cellAttributes() ?>>
<span id="el_orders_ShipCountry">
<input type="text" data-table="orders" data-field="x_ShipCountry" name="x_ShipCountry" id="x_ShipCountry" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($orders->ShipCountry->getPlaceHolder()) ?>" value="<?php echo $orders->ShipCountry->EditValue ?>"<?php echo $orders->ShipCountry->editAttributes() ?>>
</span>
<?php echo $orders->ShipCountry->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ShipCountry">
		<td class="<?php echo $orders_add->TableLeftColumnClass ?>"><span id="elh_orders_ShipCountry"><?php echo $orders->ShipCountry->caption() ?><?php echo ($orders->ShipCountry->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $orders->ShipCountry->cellAttributes() ?>>
<span id="el_orders_ShipCountry">
<input type="text" data-table="orders" data-field="x_ShipCountry" name="x_ShipCountry" id="x_ShipCountry" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($orders->ShipCountry->getPlaceHolder()) ?>" value="<?php echo $orders->ShipCountry->EditValue ?>"<?php echo $orders->ShipCountry->editAttributes() ?>>
</span>
<?php echo $orders->ShipCountry->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($orders_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$orders_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $orders_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $orders_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$orders_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$orders_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$orders_add->terminate();
?>
