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
$suppliers_add = new suppliers_add();

// Run the page
$suppliers_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$suppliers_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fsuppliersadd = currentForm = new ew.Form("fsuppliersadd", "add");

// Validate form
fsuppliersadd.validate = function() {
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
		<?php if ($suppliers_add->CompanyName->Required) { ?>
			elm = this.getElements("x" + infix + "_CompanyName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers->CompanyName->caption(), $suppliers->CompanyName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($suppliers_add->ContactName->Required) { ?>
			elm = this.getElements("x" + infix + "_ContactName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers->ContactName->caption(), $suppliers->ContactName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($suppliers_add->ContactTitle->Required) { ?>
			elm = this.getElements("x" + infix + "_ContactTitle");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers->ContactTitle->caption(), $suppliers->ContactTitle->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($suppliers_add->Address->Required) { ?>
			elm = this.getElements("x" + infix + "_Address");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers->Address->caption(), $suppliers->Address->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($suppliers_add->City->Required) { ?>
			elm = this.getElements("x" + infix + "_City");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers->City->caption(), $suppliers->City->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($suppliers_add->Region->Required) { ?>
			elm = this.getElements("x" + infix + "_Region");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers->Region->caption(), $suppliers->Region->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($suppliers_add->PostalCode->Required) { ?>
			elm = this.getElements("x" + infix + "_PostalCode");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers->PostalCode->caption(), $suppliers->PostalCode->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($suppliers_add->Country->Required) { ?>
			elm = this.getElements("x" + infix + "_Country");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers->Country->caption(), $suppliers->Country->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($suppliers_add->Phone->Required) { ?>
			elm = this.getElements("x" + infix + "_Phone");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers->Phone->caption(), $suppliers->Phone->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($suppliers_add->Fax->Required) { ?>
			elm = this.getElements("x" + infix + "_Fax");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers->Fax->caption(), $suppliers->Fax->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($suppliers_add->HomePage->Required) { ?>
			elm = this.getElements("x" + infix + "_HomePage");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers->HomePage->caption(), $suppliers->HomePage->RequiredErrorMessage)) ?>");
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
fsuppliersadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fsuppliersadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $suppliers_add->showPageHeader(); ?>
<?php
$suppliers_add->showMessage();
?>
<form name="fsuppliersadd" id="fsuppliersadd" class="<?php echo $suppliers_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($suppliers_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $suppliers_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="suppliers">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$suppliers_add->IsModal ?>">
<?php if (!$suppliers_add->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($suppliers_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_suppliersadd" class="table ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($suppliers->CompanyName->Visible) { // CompanyName ?>
<?php if ($suppliers_add->IsMobileOrModal) { ?>
	<div id="r_CompanyName" class="form-group row">
		<label id="elh_suppliers_CompanyName" for="x_CompanyName" class="<?php echo $suppliers_add->LeftColumnClass ?>"><?php echo $suppliers->CompanyName->caption() ?><?php echo ($suppliers->CompanyName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_add->RightColumnClass ?>"><div<?php echo $suppliers->CompanyName->cellAttributes() ?>>
<span id="el_suppliers_CompanyName">
<input type="text" data-table="suppliers" data-field="x_CompanyName" name="x_CompanyName" id="x_CompanyName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($suppliers->CompanyName->getPlaceHolder()) ?>" value="<?php echo $suppliers->CompanyName->EditValue ?>"<?php echo $suppliers->CompanyName->editAttributes() ?>>
</span>
<?php echo $suppliers->CompanyName->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_CompanyName">
		<td class="<?php echo $suppliers_add->TableLeftColumnClass ?>"><span id="elh_suppliers_CompanyName"><?php echo $suppliers->CompanyName->caption() ?><?php echo ($suppliers->CompanyName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $suppliers->CompanyName->cellAttributes() ?>>
<span id="el_suppliers_CompanyName">
<input type="text" data-table="suppliers" data-field="x_CompanyName" name="x_CompanyName" id="x_CompanyName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($suppliers->CompanyName->getPlaceHolder()) ?>" value="<?php echo $suppliers->CompanyName->EditValue ?>"<?php echo $suppliers->CompanyName->editAttributes() ?>>
</span>
<?php echo $suppliers->CompanyName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($suppliers->ContactName->Visible) { // ContactName ?>
<?php if ($suppliers_add->IsMobileOrModal) { ?>
	<div id="r_ContactName" class="form-group row">
		<label id="elh_suppliers_ContactName" for="x_ContactName" class="<?php echo $suppliers_add->LeftColumnClass ?>"><?php echo $suppliers->ContactName->caption() ?><?php echo ($suppliers->ContactName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_add->RightColumnClass ?>"><div<?php echo $suppliers->ContactName->cellAttributes() ?>>
<span id="el_suppliers_ContactName">
<input type="text" data-table="suppliers" data-field="x_ContactName" name="x_ContactName" id="x_ContactName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($suppliers->ContactName->getPlaceHolder()) ?>" value="<?php echo $suppliers->ContactName->EditValue ?>"<?php echo $suppliers->ContactName->editAttributes() ?>>
</span>
<?php echo $suppliers->ContactName->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ContactName">
		<td class="<?php echo $suppliers_add->TableLeftColumnClass ?>"><span id="elh_suppliers_ContactName"><?php echo $suppliers->ContactName->caption() ?><?php echo ($suppliers->ContactName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $suppliers->ContactName->cellAttributes() ?>>
<span id="el_suppliers_ContactName">
<input type="text" data-table="suppliers" data-field="x_ContactName" name="x_ContactName" id="x_ContactName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($suppliers->ContactName->getPlaceHolder()) ?>" value="<?php echo $suppliers->ContactName->EditValue ?>"<?php echo $suppliers->ContactName->editAttributes() ?>>
</span>
<?php echo $suppliers->ContactName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($suppliers->ContactTitle->Visible) { // ContactTitle ?>
<?php if ($suppliers_add->IsMobileOrModal) { ?>
	<div id="r_ContactTitle" class="form-group row">
		<label id="elh_suppliers_ContactTitle" for="x_ContactTitle" class="<?php echo $suppliers_add->LeftColumnClass ?>"><?php echo $suppliers->ContactTitle->caption() ?><?php echo ($suppliers->ContactTitle->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_add->RightColumnClass ?>"><div<?php echo $suppliers->ContactTitle->cellAttributes() ?>>
<span id="el_suppliers_ContactTitle">
<input type="text" data-table="suppliers" data-field="x_ContactTitle" name="x_ContactTitle" id="x_ContactTitle" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($suppliers->ContactTitle->getPlaceHolder()) ?>" value="<?php echo $suppliers->ContactTitle->EditValue ?>"<?php echo $suppliers->ContactTitle->editAttributes() ?>>
</span>
<?php echo $suppliers->ContactTitle->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ContactTitle">
		<td class="<?php echo $suppliers_add->TableLeftColumnClass ?>"><span id="elh_suppliers_ContactTitle"><?php echo $suppliers->ContactTitle->caption() ?><?php echo ($suppliers->ContactTitle->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $suppliers->ContactTitle->cellAttributes() ?>>
<span id="el_suppliers_ContactTitle">
<input type="text" data-table="suppliers" data-field="x_ContactTitle" name="x_ContactTitle" id="x_ContactTitle" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($suppliers->ContactTitle->getPlaceHolder()) ?>" value="<?php echo $suppliers->ContactTitle->EditValue ?>"<?php echo $suppliers->ContactTitle->editAttributes() ?>>
</span>
<?php echo $suppliers->ContactTitle->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($suppliers->Address->Visible) { // Address ?>
<?php if ($suppliers_add->IsMobileOrModal) { ?>
	<div id="r_Address" class="form-group row">
		<label id="elh_suppliers_Address" for="x_Address" class="<?php echo $suppliers_add->LeftColumnClass ?>"><?php echo $suppliers->Address->caption() ?><?php echo ($suppliers->Address->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_add->RightColumnClass ?>"><div<?php echo $suppliers->Address->cellAttributes() ?>>
<span id="el_suppliers_Address">
<input type="text" data-table="suppliers" data-field="x_Address" name="x_Address" id="x_Address" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($suppliers->Address->getPlaceHolder()) ?>" value="<?php echo $suppliers->Address->EditValue ?>"<?php echo $suppliers->Address->editAttributes() ?>>
</span>
<?php echo $suppliers->Address->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Address">
		<td class="<?php echo $suppliers_add->TableLeftColumnClass ?>"><span id="elh_suppliers_Address"><?php echo $suppliers->Address->caption() ?><?php echo ($suppliers->Address->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $suppliers->Address->cellAttributes() ?>>
<span id="el_suppliers_Address">
<input type="text" data-table="suppliers" data-field="x_Address" name="x_Address" id="x_Address" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($suppliers->Address->getPlaceHolder()) ?>" value="<?php echo $suppliers->Address->EditValue ?>"<?php echo $suppliers->Address->editAttributes() ?>>
</span>
<?php echo $suppliers->Address->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($suppliers->City->Visible) { // City ?>
<?php if ($suppliers_add->IsMobileOrModal) { ?>
	<div id="r_City" class="form-group row">
		<label id="elh_suppliers_City" for="x_City" class="<?php echo $suppliers_add->LeftColumnClass ?>"><?php echo $suppliers->City->caption() ?><?php echo ($suppliers->City->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_add->RightColumnClass ?>"><div<?php echo $suppliers->City->cellAttributes() ?>>
<span id="el_suppliers_City">
<input type="text" data-table="suppliers" data-field="x_City" name="x_City" id="x_City" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($suppliers->City->getPlaceHolder()) ?>" value="<?php echo $suppliers->City->EditValue ?>"<?php echo $suppliers->City->editAttributes() ?>>
</span>
<?php echo $suppliers->City->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_City">
		<td class="<?php echo $suppliers_add->TableLeftColumnClass ?>"><span id="elh_suppliers_City"><?php echo $suppliers->City->caption() ?><?php echo ($suppliers->City->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $suppliers->City->cellAttributes() ?>>
<span id="el_suppliers_City">
<input type="text" data-table="suppliers" data-field="x_City" name="x_City" id="x_City" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($suppliers->City->getPlaceHolder()) ?>" value="<?php echo $suppliers->City->EditValue ?>"<?php echo $suppliers->City->editAttributes() ?>>
</span>
<?php echo $suppliers->City->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($suppliers->Region->Visible) { // Region ?>
<?php if ($suppliers_add->IsMobileOrModal) { ?>
	<div id="r_Region" class="form-group row">
		<label id="elh_suppliers_Region" for="x_Region" class="<?php echo $suppliers_add->LeftColumnClass ?>"><?php echo $suppliers->Region->caption() ?><?php echo ($suppliers->Region->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_add->RightColumnClass ?>"><div<?php echo $suppliers->Region->cellAttributes() ?>>
<span id="el_suppliers_Region">
<input type="text" data-table="suppliers" data-field="x_Region" name="x_Region" id="x_Region" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($suppliers->Region->getPlaceHolder()) ?>" value="<?php echo $suppliers->Region->EditValue ?>"<?php echo $suppliers->Region->editAttributes() ?>>
</span>
<?php echo $suppliers->Region->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Region">
		<td class="<?php echo $suppliers_add->TableLeftColumnClass ?>"><span id="elh_suppliers_Region"><?php echo $suppliers->Region->caption() ?><?php echo ($suppliers->Region->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $suppliers->Region->cellAttributes() ?>>
<span id="el_suppliers_Region">
<input type="text" data-table="suppliers" data-field="x_Region" name="x_Region" id="x_Region" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($suppliers->Region->getPlaceHolder()) ?>" value="<?php echo $suppliers->Region->EditValue ?>"<?php echo $suppliers->Region->editAttributes() ?>>
</span>
<?php echo $suppliers->Region->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($suppliers->PostalCode->Visible) { // PostalCode ?>
<?php if ($suppliers_add->IsMobileOrModal) { ?>
	<div id="r_PostalCode" class="form-group row">
		<label id="elh_suppliers_PostalCode" for="x_PostalCode" class="<?php echo $suppliers_add->LeftColumnClass ?>"><?php echo $suppliers->PostalCode->caption() ?><?php echo ($suppliers->PostalCode->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_add->RightColumnClass ?>"><div<?php echo $suppliers->PostalCode->cellAttributes() ?>>
<span id="el_suppliers_PostalCode">
<input type="text" data-table="suppliers" data-field="x_PostalCode" name="x_PostalCode" id="x_PostalCode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($suppliers->PostalCode->getPlaceHolder()) ?>" value="<?php echo $suppliers->PostalCode->EditValue ?>"<?php echo $suppliers->PostalCode->editAttributes() ?>>
</span>
<?php echo $suppliers->PostalCode->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_PostalCode">
		<td class="<?php echo $suppliers_add->TableLeftColumnClass ?>"><span id="elh_suppliers_PostalCode"><?php echo $suppliers->PostalCode->caption() ?><?php echo ($suppliers->PostalCode->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $suppliers->PostalCode->cellAttributes() ?>>
<span id="el_suppliers_PostalCode">
<input type="text" data-table="suppliers" data-field="x_PostalCode" name="x_PostalCode" id="x_PostalCode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($suppliers->PostalCode->getPlaceHolder()) ?>" value="<?php echo $suppliers->PostalCode->EditValue ?>"<?php echo $suppliers->PostalCode->editAttributes() ?>>
</span>
<?php echo $suppliers->PostalCode->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($suppliers->Country->Visible) { // Country ?>
<?php if ($suppliers_add->IsMobileOrModal) { ?>
	<div id="r_Country" class="form-group row">
		<label id="elh_suppliers_Country" for="x_Country" class="<?php echo $suppliers_add->LeftColumnClass ?>"><?php echo $suppliers->Country->caption() ?><?php echo ($suppliers->Country->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_add->RightColumnClass ?>"><div<?php echo $suppliers->Country->cellAttributes() ?>>
<span id="el_suppliers_Country">
<input type="text" data-table="suppliers" data-field="x_Country" name="x_Country" id="x_Country" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($suppliers->Country->getPlaceHolder()) ?>" value="<?php echo $suppliers->Country->EditValue ?>"<?php echo $suppliers->Country->editAttributes() ?>>
</span>
<?php echo $suppliers->Country->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Country">
		<td class="<?php echo $suppliers_add->TableLeftColumnClass ?>"><span id="elh_suppliers_Country"><?php echo $suppliers->Country->caption() ?><?php echo ($suppliers->Country->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $suppliers->Country->cellAttributes() ?>>
<span id="el_suppliers_Country">
<input type="text" data-table="suppliers" data-field="x_Country" name="x_Country" id="x_Country" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($suppliers->Country->getPlaceHolder()) ?>" value="<?php echo $suppliers->Country->EditValue ?>"<?php echo $suppliers->Country->editAttributes() ?>>
</span>
<?php echo $suppliers->Country->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($suppliers->Phone->Visible) { // Phone ?>
<?php if ($suppliers_add->IsMobileOrModal) { ?>
	<div id="r_Phone" class="form-group row">
		<label id="elh_suppliers_Phone" for="x_Phone" class="<?php echo $suppliers_add->LeftColumnClass ?>"><?php echo $suppliers->Phone->caption() ?><?php echo ($suppliers->Phone->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_add->RightColumnClass ?>"><div<?php echo $suppliers->Phone->cellAttributes() ?>>
<span id="el_suppliers_Phone">
<input type="text" data-table="suppliers" data-field="x_Phone" name="x_Phone" id="x_Phone" size="30" maxlength="24" placeholder="<?php echo HtmlEncode($suppliers->Phone->getPlaceHolder()) ?>" value="<?php echo $suppliers->Phone->EditValue ?>"<?php echo $suppliers->Phone->editAttributes() ?>>
</span>
<?php echo $suppliers->Phone->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Phone">
		<td class="<?php echo $suppliers_add->TableLeftColumnClass ?>"><span id="elh_suppliers_Phone"><?php echo $suppliers->Phone->caption() ?><?php echo ($suppliers->Phone->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $suppliers->Phone->cellAttributes() ?>>
<span id="el_suppliers_Phone">
<input type="text" data-table="suppliers" data-field="x_Phone" name="x_Phone" id="x_Phone" size="30" maxlength="24" placeholder="<?php echo HtmlEncode($suppliers->Phone->getPlaceHolder()) ?>" value="<?php echo $suppliers->Phone->EditValue ?>"<?php echo $suppliers->Phone->editAttributes() ?>>
</span>
<?php echo $suppliers->Phone->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($suppliers->Fax->Visible) { // Fax ?>
<?php if ($suppliers_add->IsMobileOrModal) { ?>
	<div id="r_Fax" class="form-group row">
		<label id="elh_suppliers_Fax" for="x_Fax" class="<?php echo $suppliers_add->LeftColumnClass ?>"><?php echo $suppliers->Fax->caption() ?><?php echo ($suppliers->Fax->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_add->RightColumnClass ?>"><div<?php echo $suppliers->Fax->cellAttributes() ?>>
<span id="el_suppliers_Fax">
<input type="text" data-table="suppliers" data-field="x_Fax" name="x_Fax" id="x_Fax" size="30" maxlength="24" placeholder="<?php echo HtmlEncode($suppliers->Fax->getPlaceHolder()) ?>" value="<?php echo $suppliers->Fax->EditValue ?>"<?php echo $suppliers->Fax->editAttributes() ?>>
</span>
<?php echo $suppliers->Fax->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Fax">
		<td class="<?php echo $suppliers_add->TableLeftColumnClass ?>"><span id="elh_suppliers_Fax"><?php echo $suppliers->Fax->caption() ?><?php echo ($suppliers->Fax->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $suppliers->Fax->cellAttributes() ?>>
<span id="el_suppliers_Fax">
<input type="text" data-table="suppliers" data-field="x_Fax" name="x_Fax" id="x_Fax" size="30" maxlength="24" placeholder="<?php echo HtmlEncode($suppliers->Fax->getPlaceHolder()) ?>" value="<?php echo $suppliers->Fax->EditValue ?>"<?php echo $suppliers->Fax->editAttributes() ?>>
</span>
<?php echo $suppliers->Fax->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($suppliers->HomePage->Visible) { // HomePage ?>
<?php if ($suppliers_add->IsMobileOrModal) { ?>
	<div id="r_HomePage" class="form-group row">
		<label id="elh_suppliers_HomePage" for="x_HomePage" class="<?php echo $suppliers_add->LeftColumnClass ?>"><?php echo $suppliers->HomePage->caption() ?><?php echo ($suppliers->HomePage->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_add->RightColumnClass ?>"><div<?php echo $suppliers->HomePage->cellAttributes() ?>>
<span id="el_suppliers_HomePage">
<textarea data-table="suppliers" data-field="x_HomePage" name="x_HomePage" id="x_HomePage" cols="35" rows="4" placeholder="<?php echo HtmlEncode($suppliers->HomePage->getPlaceHolder()) ?>"<?php echo $suppliers->HomePage->editAttributes() ?>><?php echo $suppliers->HomePage->EditValue ?></textarea>
</span>
<?php echo $suppliers->HomePage->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_HomePage">
		<td class="<?php echo $suppliers_add->TableLeftColumnClass ?>"><span id="elh_suppliers_HomePage"><?php echo $suppliers->HomePage->caption() ?><?php echo ($suppliers->HomePage->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $suppliers->HomePage->cellAttributes() ?>>
<span id="el_suppliers_HomePage">
<textarea data-table="suppliers" data-field="x_HomePage" name="x_HomePage" id="x_HomePage" cols="35" rows="4" placeholder="<?php echo HtmlEncode($suppliers->HomePage->getPlaceHolder()) ?>"<?php echo $suppliers->HomePage->editAttributes() ?>><?php echo $suppliers->HomePage->EditValue ?></textarea>
</span>
<?php echo $suppliers->HomePage->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($suppliers_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$suppliers_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $suppliers_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $suppliers_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$suppliers_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$suppliers_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$suppliers_add->terminate();
?>
