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
$customers_add = new customers_add();

// Run the page
$customers_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$customers_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fcustomersadd = currentForm = new ew.Form("fcustomersadd", "add");

// Validate form
fcustomersadd.validate = function() {
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
		<?php if ($customers_add->CustomerID->Required) { ?>
			elm = this.getElements("x" + infix + "_CustomerID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers->CustomerID->caption(), $customers->CustomerID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($customers_add->CompanyName->Required) { ?>
			elm = this.getElements("x" + infix + "_CompanyName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers->CompanyName->caption(), $customers->CompanyName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($customers_add->ContactName->Required) { ?>
			elm = this.getElements("x" + infix + "_ContactName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers->ContactName->caption(), $customers->ContactName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($customers_add->ContactTitle->Required) { ?>
			elm = this.getElements("x" + infix + "_ContactTitle");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers->ContactTitle->caption(), $customers->ContactTitle->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($customers_add->Address->Required) { ?>
			elm = this.getElements("x" + infix + "_Address");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers->Address->caption(), $customers->Address->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($customers_add->City->Required) { ?>
			elm = this.getElements("x" + infix + "_City");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers->City->caption(), $customers->City->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($customers_add->Region->Required) { ?>
			elm = this.getElements("x" + infix + "_Region");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers->Region->caption(), $customers->Region->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($customers_add->PostalCode->Required) { ?>
			elm = this.getElements("x" + infix + "_PostalCode");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers->PostalCode->caption(), $customers->PostalCode->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($customers_add->Country->Required) { ?>
			elm = this.getElements("x" + infix + "_Country");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers->Country->caption(), $customers->Country->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($customers_add->Phone->Required) { ?>
			elm = this.getElements("x" + infix + "_Phone");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers->Phone->caption(), $customers->Phone->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($customers_add->Fax->Required) { ?>
			elm = this.getElements("x" + infix + "_Fax");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers->Fax->caption(), $customers->Fax->RequiredErrorMessage)) ?>");
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
fcustomersadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcustomersadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $customers_add->showPageHeader(); ?>
<?php
$customers_add->showMessage();
?>
<form name="fcustomersadd" id="fcustomersadd" class="<?php echo $customers_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($customers_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $customers_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="customers">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$customers_add->IsModal ?>">
<?php if (!$customers_add->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($customers_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_customersadd" class="table ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($customers->CustomerID->Visible) { // CustomerID ?>
<?php if ($customers_add->IsMobileOrModal) { ?>
	<div id="r_CustomerID" class="form-group row">
		<label id="elh_customers_CustomerID" for="x_CustomerID" class="<?php echo $customers_add->LeftColumnClass ?>"><?php echo $customers->CustomerID->caption() ?><?php echo ($customers->CustomerID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_add->RightColumnClass ?>"><div<?php echo $customers->CustomerID->cellAttributes() ?>>
<span id="el_customers_CustomerID">
<input type="text" data-table="customers" data-field="x_CustomerID" name="x_CustomerID" id="x_CustomerID" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($customers->CustomerID->getPlaceHolder()) ?>" value="<?php echo $customers->CustomerID->EditValue ?>"<?php echo $customers->CustomerID->editAttributes() ?>>
</span>
<?php echo $customers->CustomerID->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_CustomerID">
		<td class="<?php echo $customers_add->TableLeftColumnClass ?>"><span id="elh_customers_CustomerID"><?php echo $customers->CustomerID->caption() ?><?php echo ($customers->CustomerID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $customers->CustomerID->cellAttributes() ?>>
<span id="el_customers_CustomerID">
<input type="text" data-table="customers" data-field="x_CustomerID" name="x_CustomerID" id="x_CustomerID" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($customers->CustomerID->getPlaceHolder()) ?>" value="<?php echo $customers->CustomerID->EditValue ?>"<?php echo $customers->CustomerID->editAttributes() ?>>
</span>
<?php echo $customers->CustomerID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($customers->CompanyName->Visible) { // CompanyName ?>
<?php if ($customers_add->IsMobileOrModal) { ?>
	<div id="r_CompanyName" class="form-group row">
		<label id="elh_customers_CompanyName" for="x_CompanyName" class="<?php echo $customers_add->LeftColumnClass ?>"><?php echo $customers->CompanyName->caption() ?><?php echo ($customers->CompanyName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_add->RightColumnClass ?>"><div<?php echo $customers->CompanyName->cellAttributes() ?>>
<span id="el_customers_CompanyName">
<input type="text" data-table="customers" data-field="x_CompanyName" name="x_CompanyName" id="x_CompanyName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($customers->CompanyName->getPlaceHolder()) ?>" value="<?php echo $customers->CompanyName->EditValue ?>"<?php echo $customers->CompanyName->editAttributes() ?>>
</span>
<?php echo $customers->CompanyName->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_CompanyName">
		<td class="<?php echo $customers_add->TableLeftColumnClass ?>"><span id="elh_customers_CompanyName"><?php echo $customers->CompanyName->caption() ?><?php echo ($customers->CompanyName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $customers->CompanyName->cellAttributes() ?>>
<span id="el_customers_CompanyName">
<input type="text" data-table="customers" data-field="x_CompanyName" name="x_CompanyName" id="x_CompanyName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($customers->CompanyName->getPlaceHolder()) ?>" value="<?php echo $customers->CompanyName->EditValue ?>"<?php echo $customers->CompanyName->editAttributes() ?>>
</span>
<?php echo $customers->CompanyName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($customers->ContactName->Visible) { // ContactName ?>
<?php if ($customers_add->IsMobileOrModal) { ?>
	<div id="r_ContactName" class="form-group row">
		<label id="elh_customers_ContactName" for="x_ContactName" class="<?php echo $customers_add->LeftColumnClass ?>"><?php echo $customers->ContactName->caption() ?><?php echo ($customers->ContactName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_add->RightColumnClass ?>"><div<?php echo $customers->ContactName->cellAttributes() ?>>
<span id="el_customers_ContactName">
<input type="text" data-table="customers" data-field="x_ContactName" name="x_ContactName" id="x_ContactName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($customers->ContactName->getPlaceHolder()) ?>" value="<?php echo $customers->ContactName->EditValue ?>"<?php echo $customers->ContactName->editAttributes() ?>>
</span>
<?php echo $customers->ContactName->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ContactName">
		<td class="<?php echo $customers_add->TableLeftColumnClass ?>"><span id="elh_customers_ContactName"><?php echo $customers->ContactName->caption() ?><?php echo ($customers->ContactName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $customers->ContactName->cellAttributes() ?>>
<span id="el_customers_ContactName">
<input type="text" data-table="customers" data-field="x_ContactName" name="x_ContactName" id="x_ContactName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($customers->ContactName->getPlaceHolder()) ?>" value="<?php echo $customers->ContactName->EditValue ?>"<?php echo $customers->ContactName->editAttributes() ?>>
</span>
<?php echo $customers->ContactName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($customers->ContactTitle->Visible) { // ContactTitle ?>
<?php if ($customers_add->IsMobileOrModal) { ?>
	<div id="r_ContactTitle" class="form-group row">
		<label id="elh_customers_ContactTitle" for="x_ContactTitle" class="<?php echo $customers_add->LeftColumnClass ?>"><?php echo $customers->ContactTitle->caption() ?><?php echo ($customers->ContactTitle->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_add->RightColumnClass ?>"><div<?php echo $customers->ContactTitle->cellAttributes() ?>>
<span id="el_customers_ContactTitle">
<input type="text" data-table="customers" data-field="x_ContactTitle" name="x_ContactTitle" id="x_ContactTitle" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($customers->ContactTitle->getPlaceHolder()) ?>" value="<?php echo $customers->ContactTitle->EditValue ?>"<?php echo $customers->ContactTitle->editAttributes() ?>>
</span>
<?php echo $customers->ContactTitle->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ContactTitle">
		<td class="<?php echo $customers_add->TableLeftColumnClass ?>"><span id="elh_customers_ContactTitle"><?php echo $customers->ContactTitle->caption() ?><?php echo ($customers->ContactTitle->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $customers->ContactTitle->cellAttributes() ?>>
<span id="el_customers_ContactTitle">
<input type="text" data-table="customers" data-field="x_ContactTitle" name="x_ContactTitle" id="x_ContactTitle" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($customers->ContactTitle->getPlaceHolder()) ?>" value="<?php echo $customers->ContactTitle->EditValue ?>"<?php echo $customers->ContactTitle->editAttributes() ?>>
</span>
<?php echo $customers->ContactTitle->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($customers->Address->Visible) { // Address ?>
<?php if ($customers_add->IsMobileOrModal) { ?>
	<div id="r_Address" class="form-group row">
		<label id="elh_customers_Address" for="x_Address" class="<?php echo $customers_add->LeftColumnClass ?>"><?php echo $customers->Address->caption() ?><?php echo ($customers->Address->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_add->RightColumnClass ?>"><div<?php echo $customers->Address->cellAttributes() ?>>
<span id="el_customers_Address">
<input type="text" data-table="customers" data-field="x_Address" name="x_Address" id="x_Address" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($customers->Address->getPlaceHolder()) ?>" value="<?php echo $customers->Address->EditValue ?>"<?php echo $customers->Address->editAttributes() ?>>
</span>
<?php echo $customers->Address->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Address">
		<td class="<?php echo $customers_add->TableLeftColumnClass ?>"><span id="elh_customers_Address"><?php echo $customers->Address->caption() ?><?php echo ($customers->Address->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $customers->Address->cellAttributes() ?>>
<span id="el_customers_Address">
<input type="text" data-table="customers" data-field="x_Address" name="x_Address" id="x_Address" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($customers->Address->getPlaceHolder()) ?>" value="<?php echo $customers->Address->EditValue ?>"<?php echo $customers->Address->editAttributes() ?>>
</span>
<?php echo $customers->Address->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($customers->City->Visible) { // City ?>
<?php if ($customers_add->IsMobileOrModal) { ?>
	<div id="r_City" class="form-group row">
		<label id="elh_customers_City" for="x_City" class="<?php echo $customers_add->LeftColumnClass ?>"><?php echo $customers->City->caption() ?><?php echo ($customers->City->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_add->RightColumnClass ?>"><div<?php echo $customers->City->cellAttributes() ?>>
<span id="el_customers_City">
<input type="text" data-table="customers" data-field="x_City" name="x_City" id="x_City" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($customers->City->getPlaceHolder()) ?>" value="<?php echo $customers->City->EditValue ?>"<?php echo $customers->City->editAttributes() ?>>
</span>
<?php echo $customers->City->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_City">
		<td class="<?php echo $customers_add->TableLeftColumnClass ?>"><span id="elh_customers_City"><?php echo $customers->City->caption() ?><?php echo ($customers->City->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $customers->City->cellAttributes() ?>>
<span id="el_customers_City">
<input type="text" data-table="customers" data-field="x_City" name="x_City" id="x_City" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($customers->City->getPlaceHolder()) ?>" value="<?php echo $customers->City->EditValue ?>"<?php echo $customers->City->editAttributes() ?>>
</span>
<?php echo $customers->City->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($customers->Region->Visible) { // Region ?>
<?php if ($customers_add->IsMobileOrModal) { ?>
	<div id="r_Region" class="form-group row">
		<label id="elh_customers_Region" for="x_Region" class="<?php echo $customers_add->LeftColumnClass ?>"><?php echo $customers->Region->caption() ?><?php echo ($customers->Region->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_add->RightColumnClass ?>"><div<?php echo $customers->Region->cellAttributes() ?>>
<span id="el_customers_Region">
<input type="text" data-table="customers" data-field="x_Region" name="x_Region" id="x_Region" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($customers->Region->getPlaceHolder()) ?>" value="<?php echo $customers->Region->EditValue ?>"<?php echo $customers->Region->editAttributes() ?>>
</span>
<?php echo $customers->Region->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Region">
		<td class="<?php echo $customers_add->TableLeftColumnClass ?>"><span id="elh_customers_Region"><?php echo $customers->Region->caption() ?><?php echo ($customers->Region->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $customers->Region->cellAttributes() ?>>
<span id="el_customers_Region">
<input type="text" data-table="customers" data-field="x_Region" name="x_Region" id="x_Region" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($customers->Region->getPlaceHolder()) ?>" value="<?php echo $customers->Region->EditValue ?>"<?php echo $customers->Region->editAttributes() ?>>
</span>
<?php echo $customers->Region->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($customers->PostalCode->Visible) { // PostalCode ?>
<?php if ($customers_add->IsMobileOrModal) { ?>
	<div id="r_PostalCode" class="form-group row">
		<label id="elh_customers_PostalCode" for="x_PostalCode" class="<?php echo $customers_add->LeftColumnClass ?>"><?php echo $customers->PostalCode->caption() ?><?php echo ($customers->PostalCode->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_add->RightColumnClass ?>"><div<?php echo $customers->PostalCode->cellAttributes() ?>>
<span id="el_customers_PostalCode">
<input type="text" data-table="customers" data-field="x_PostalCode" name="x_PostalCode" id="x_PostalCode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($customers->PostalCode->getPlaceHolder()) ?>" value="<?php echo $customers->PostalCode->EditValue ?>"<?php echo $customers->PostalCode->editAttributes() ?>>
</span>
<?php echo $customers->PostalCode->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_PostalCode">
		<td class="<?php echo $customers_add->TableLeftColumnClass ?>"><span id="elh_customers_PostalCode"><?php echo $customers->PostalCode->caption() ?><?php echo ($customers->PostalCode->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $customers->PostalCode->cellAttributes() ?>>
<span id="el_customers_PostalCode">
<input type="text" data-table="customers" data-field="x_PostalCode" name="x_PostalCode" id="x_PostalCode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($customers->PostalCode->getPlaceHolder()) ?>" value="<?php echo $customers->PostalCode->EditValue ?>"<?php echo $customers->PostalCode->editAttributes() ?>>
</span>
<?php echo $customers->PostalCode->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($customers->Country->Visible) { // Country ?>
<?php if ($customers_add->IsMobileOrModal) { ?>
	<div id="r_Country" class="form-group row">
		<label id="elh_customers_Country" for="x_Country" class="<?php echo $customers_add->LeftColumnClass ?>"><?php echo $customers->Country->caption() ?><?php echo ($customers->Country->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_add->RightColumnClass ?>"><div<?php echo $customers->Country->cellAttributes() ?>>
<span id="el_customers_Country">
<input type="text" data-table="customers" data-field="x_Country" name="x_Country" id="x_Country" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($customers->Country->getPlaceHolder()) ?>" value="<?php echo $customers->Country->EditValue ?>"<?php echo $customers->Country->editAttributes() ?>>
</span>
<?php echo $customers->Country->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Country">
		<td class="<?php echo $customers_add->TableLeftColumnClass ?>"><span id="elh_customers_Country"><?php echo $customers->Country->caption() ?><?php echo ($customers->Country->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $customers->Country->cellAttributes() ?>>
<span id="el_customers_Country">
<input type="text" data-table="customers" data-field="x_Country" name="x_Country" id="x_Country" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($customers->Country->getPlaceHolder()) ?>" value="<?php echo $customers->Country->EditValue ?>"<?php echo $customers->Country->editAttributes() ?>>
</span>
<?php echo $customers->Country->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($customers->Phone->Visible) { // Phone ?>
<?php if ($customers_add->IsMobileOrModal) { ?>
	<div id="r_Phone" class="form-group row">
		<label id="elh_customers_Phone" for="x_Phone" class="<?php echo $customers_add->LeftColumnClass ?>"><?php echo $customers->Phone->caption() ?><?php echo ($customers->Phone->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_add->RightColumnClass ?>"><div<?php echo $customers->Phone->cellAttributes() ?>>
<span id="el_customers_Phone">
<input type="text" data-table="customers" data-field="x_Phone" name="x_Phone" id="x_Phone" size="30" maxlength="24" placeholder="<?php echo HtmlEncode($customers->Phone->getPlaceHolder()) ?>" value="<?php echo $customers->Phone->EditValue ?>"<?php echo $customers->Phone->editAttributes() ?>>
</span>
<?php echo $customers->Phone->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Phone">
		<td class="<?php echo $customers_add->TableLeftColumnClass ?>"><span id="elh_customers_Phone"><?php echo $customers->Phone->caption() ?><?php echo ($customers->Phone->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $customers->Phone->cellAttributes() ?>>
<span id="el_customers_Phone">
<input type="text" data-table="customers" data-field="x_Phone" name="x_Phone" id="x_Phone" size="30" maxlength="24" placeholder="<?php echo HtmlEncode($customers->Phone->getPlaceHolder()) ?>" value="<?php echo $customers->Phone->EditValue ?>"<?php echo $customers->Phone->editAttributes() ?>>
</span>
<?php echo $customers->Phone->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($customers->Fax->Visible) { // Fax ?>
<?php if ($customers_add->IsMobileOrModal) { ?>
	<div id="r_Fax" class="form-group row">
		<label id="elh_customers_Fax" for="x_Fax" class="<?php echo $customers_add->LeftColumnClass ?>"><?php echo $customers->Fax->caption() ?><?php echo ($customers->Fax->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_add->RightColumnClass ?>"><div<?php echo $customers->Fax->cellAttributes() ?>>
<span id="el_customers_Fax">
<input type="text" data-table="customers" data-field="x_Fax" name="x_Fax" id="x_Fax" size="30" maxlength="24" placeholder="<?php echo HtmlEncode($customers->Fax->getPlaceHolder()) ?>" value="<?php echo $customers->Fax->EditValue ?>"<?php echo $customers->Fax->editAttributes() ?>>
</span>
<?php echo $customers->Fax->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Fax">
		<td class="<?php echo $customers_add->TableLeftColumnClass ?>"><span id="elh_customers_Fax"><?php echo $customers->Fax->caption() ?><?php echo ($customers->Fax->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $customers->Fax->cellAttributes() ?>>
<span id="el_customers_Fax">
<input type="text" data-table="customers" data-field="x_Fax" name="x_Fax" id="x_Fax" size="30" maxlength="24" placeholder="<?php echo HtmlEncode($customers->Fax->getPlaceHolder()) ?>" value="<?php echo $customers->Fax->EditValue ?>"<?php echo $customers->Fax->editAttributes() ?>>
</span>
<?php echo $customers->Fax->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($customers_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$customers_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $customers_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $customers_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$customers_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$customers_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$customers_add->terminate();
?>
