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
$dji_add = new dji_add();

// Run the page
$dji_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$dji_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fdjiadd = currentForm = new ew.Form("fdjiadd", "add");

// Validate form
fdjiadd.validate = function() {
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
		<?php if ($dji_add->Date->Required) { ?>
			elm = this.getElements("x" + infix + "_Date");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji->Date->caption(), $dji->Date->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Date");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($dji->Date->errorMessage()) ?>");
		<?php if ($dji_add->Open->Required) { ?>
			elm = this.getElements("x" + infix + "_Open");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji->Open->caption(), $dji->Open->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Open");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($dji->Open->errorMessage()) ?>");
		<?php if ($dji_add->High->Required) { ?>
			elm = this.getElements("x" + infix + "_High");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji->High->caption(), $dji->High->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_High");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($dji->High->errorMessage()) ?>");
		<?php if ($dji_add->Low->Required) { ?>
			elm = this.getElements("x" + infix + "_Low");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji->Low->caption(), $dji->Low->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Low");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($dji->Low->errorMessage()) ?>");
		<?php if ($dji_add->Close->Required) { ?>
			elm = this.getElements("x" + infix + "_Close");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji->Close->caption(), $dji->Close->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Close");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($dji->Close->errorMessage()) ?>");
		<?php if ($dji_add->Volume->Required) { ?>
			elm = this.getElements("x" + infix + "_Volume");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji->Volume->caption(), $dji->Volume->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Volume");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($dji->Volume->errorMessage()) ?>");
		<?php if ($dji_add->Adj_Close->Required) { ?>
			elm = this.getElements("x" + infix + "_Adj_Close");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji->Adj_Close->caption(), $dji->Adj_Close->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Adj_Close");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($dji->Adj_Close->errorMessage()) ?>");
		<?php if ($dji_add->Name->Required) { ?>
			elm = this.getElements("x" + infix + "_Name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji->Name->caption(), $dji->Name->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Name");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($dji->Name->errorMessage()) ?>");
		<?php if ($dji_add->Name2->Required) { ?>
			elm = this.getElements("x" + infix + "_Name2");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji->Name2->caption(), $dji->Name2->RequiredErrorMessage)) ?>");
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
fdjiadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdjiadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $dji_add->showPageHeader(); ?>
<?php
$dji_add->showMessage();
?>
<form name="fdjiadd" id="fdjiadd" class="<?php echo $dji_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($dji_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $dji_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="dji">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$dji_add->IsModal ?>">
<?php if (!$dji_add->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($dji_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_djiadd" class="table ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($dji->Date->Visible) { // Date ?>
<?php if ($dji_add->IsMobileOrModal) { ?>
	<div id="r_Date" class="form-group row">
		<label id="elh_dji_Date" for="x_Date" class="<?php echo $dji_add->LeftColumnClass ?>"><?php echo $dji->Date->caption() ?><?php echo ($dji->Date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_add->RightColumnClass ?>"><div<?php echo $dji->Date->cellAttributes() ?>>
<span id="el_dji_Date">
<input type="text" data-table="dji" data-field="x_Date" name="x_Date" id="x_Date" placeholder="<?php echo HtmlEncode($dji->Date->getPlaceHolder()) ?>" value="<?php echo $dji->Date->EditValue ?>"<?php echo $dji->Date->editAttributes() ?>>
</span>
<?php echo $dji->Date->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Date">
		<td class="<?php echo $dji_add->TableLeftColumnClass ?>"><span id="elh_dji_Date"><?php echo $dji->Date->caption() ?><?php echo ($dji->Date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $dji->Date->cellAttributes() ?>>
<span id="el_dji_Date">
<input type="text" data-table="dji" data-field="x_Date" name="x_Date" id="x_Date" placeholder="<?php echo HtmlEncode($dji->Date->getPlaceHolder()) ?>" value="<?php echo $dji->Date->EditValue ?>"<?php echo $dji->Date->editAttributes() ?>>
</span>
<?php echo $dji->Date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($dji->Open->Visible) { // Open ?>
<?php if ($dji_add->IsMobileOrModal) { ?>
	<div id="r_Open" class="form-group row">
		<label id="elh_dji_Open" for="x_Open" class="<?php echo $dji_add->LeftColumnClass ?>"><?php echo $dji->Open->caption() ?><?php echo ($dji->Open->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_add->RightColumnClass ?>"><div<?php echo $dji->Open->cellAttributes() ?>>
<span id="el_dji_Open">
<input type="text" data-table="dji" data-field="x_Open" name="x_Open" id="x_Open" size="30" placeholder="<?php echo HtmlEncode($dji->Open->getPlaceHolder()) ?>" value="<?php echo $dji->Open->EditValue ?>"<?php echo $dji->Open->editAttributes() ?>>
</span>
<?php echo $dji->Open->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Open">
		<td class="<?php echo $dji_add->TableLeftColumnClass ?>"><span id="elh_dji_Open"><?php echo $dji->Open->caption() ?><?php echo ($dji->Open->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $dji->Open->cellAttributes() ?>>
<span id="el_dji_Open">
<input type="text" data-table="dji" data-field="x_Open" name="x_Open" id="x_Open" size="30" placeholder="<?php echo HtmlEncode($dji->Open->getPlaceHolder()) ?>" value="<?php echo $dji->Open->EditValue ?>"<?php echo $dji->Open->editAttributes() ?>>
</span>
<?php echo $dji->Open->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($dji->High->Visible) { // High ?>
<?php if ($dji_add->IsMobileOrModal) { ?>
	<div id="r_High" class="form-group row">
		<label id="elh_dji_High" for="x_High" class="<?php echo $dji_add->LeftColumnClass ?>"><?php echo $dji->High->caption() ?><?php echo ($dji->High->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_add->RightColumnClass ?>"><div<?php echo $dji->High->cellAttributes() ?>>
<span id="el_dji_High">
<input type="text" data-table="dji" data-field="x_High" name="x_High" id="x_High" size="30" placeholder="<?php echo HtmlEncode($dji->High->getPlaceHolder()) ?>" value="<?php echo $dji->High->EditValue ?>"<?php echo $dji->High->editAttributes() ?>>
</span>
<?php echo $dji->High->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_High">
		<td class="<?php echo $dji_add->TableLeftColumnClass ?>"><span id="elh_dji_High"><?php echo $dji->High->caption() ?><?php echo ($dji->High->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $dji->High->cellAttributes() ?>>
<span id="el_dji_High">
<input type="text" data-table="dji" data-field="x_High" name="x_High" id="x_High" size="30" placeholder="<?php echo HtmlEncode($dji->High->getPlaceHolder()) ?>" value="<?php echo $dji->High->EditValue ?>"<?php echo $dji->High->editAttributes() ?>>
</span>
<?php echo $dji->High->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($dji->Low->Visible) { // Low ?>
<?php if ($dji_add->IsMobileOrModal) { ?>
	<div id="r_Low" class="form-group row">
		<label id="elh_dji_Low" for="x_Low" class="<?php echo $dji_add->LeftColumnClass ?>"><?php echo $dji->Low->caption() ?><?php echo ($dji->Low->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_add->RightColumnClass ?>"><div<?php echo $dji->Low->cellAttributes() ?>>
<span id="el_dji_Low">
<input type="text" data-table="dji" data-field="x_Low" name="x_Low" id="x_Low" size="30" placeholder="<?php echo HtmlEncode($dji->Low->getPlaceHolder()) ?>" value="<?php echo $dji->Low->EditValue ?>"<?php echo $dji->Low->editAttributes() ?>>
</span>
<?php echo $dji->Low->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Low">
		<td class="<?php echo $dji_add->TableLeftColumnClass ?>"><span id="elh_dji_Low"><?php echo $dji->Low->caption() ?><?php echo ($dji->Low->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $dji->Low->cellAttributes() ?>>
<span id="el_dji_Low">
<input type="text" data-table="dji" data-field="x_Low" name="x_Low" id="x_Low" size="30" placeholder="<?php echo HtmlEncode($dji->Low->getPlaceHolder()) ?>" value="<?php echo $dji->Low->EditValue ?>"<?php echo $dji->Low->editAttributes() ?>>
</span>
<?php echo $dji->Low->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($dji->Close->Visible) { // Close ?>
<?php if ($dji_add->IsMobileOrModal) { ?>
	<div id="r_Close" class="form-group row">
		<label id="elh_dji_Close" for="x_Close" class="<?php echo $dji_add->LeftColumnClass ?>"><?php echo $dji->Close->caption() ?><?php echo ($dji->Close->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_add->RightColumnClass ?>"><div<?php echo $dji->Close->cellAttributes() ?>>
<span id="el_dji_Close">
<input type="text" data-table="dji" data-field="x_Close" name="x_Close" id="x_Close" size="30" placeholder="<?php echo HtmlEncode($dji->Close->getPlaceHolder()) ?>" value="<?php echo $dji->Close->EditValue ?>"<?php echo $dji->Close->editAttributes() ?>>
</span>
<?php echo $dji->Close->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Close">
		<td class="<?php echo $dji_add->TableLeftColumnClass ?>"><span id="elh_dji_Close"><?php echo $dji->Close->caption() ?><?php echo ($dji->Close->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $dji->Close->cellAttributes() ?>>
<span id="el_dji_Close">
<input type="text" data-table="dji" data-field="x_Close" name="x_Close" id="x_Close" size="30" placeholder="<?php echo HtmlEncode($dji->Close->getPlaceHolder()) ?>" value="<?php echo $dji->Close->EditValue ?>"<?php echo $dji->Close->editAttributes() ?>>
</span>
<?php echo $dji->Close->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($dji->Volume->Visible) { // Volume ?>
<?php if ($dji_add->IsMobileOrModal) { ?>
	<div id="r_Volume" class="form-group row">
		<label id="elh_dji_Volume" for="x_Volume" class="<?php echo $dji_add->LeftColumnClass ?>"><?php echo $dji->Volume->caption() ?><?php echo ($dji->Volume->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_add->RightColumnClass ?>"><div<?php echo $dji->Volume->cellAttributes() ?>>
<span id="el_dji_Volume">
<input type="text" data-table="dji" data-field="x_Volume" name="x_Volume" id="x_Volume" size="30" placeholder="<?php echo HtmlEncode($dji->Volume->getPlaceHolder()) ?>" value="<?php echo $dji->Volume->EditValue ?>"<?php echo $dji->Volume->editAttributes() ?>>
</span>
<?php echo $dji->Volume->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Volume">
		<td class="<?php echo $dji_add->TableLeftColumnClass ?>"><span id="elh_dji_Volume"><?php echo $dji->Volume->caption() ?><?php echo ($dji->Volume->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $dji->Volume->cellAttributes() ?>>
<span id="el_dji_Volume">
<input type="text" data-table="dji" data-field="x_Volume" name="x_Volume" id="x_Volume" size="30" placeholder="<?php echo HtmlEncode($dji->Volume->getPlaceHolder()) ?>" value="<?php echo $dji->Volume->EditValue ?>"<?php echo $dji->Volume->editAttributes() ?>>
</span>
<?php echo $dji->Volume->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($dji->Adj_Close->Visible) { // Adj Close ?>
<?php if ($dji_add->IsMobileOrModal) { ?>
	<div id="r_Adj_Close" class="form-group row">
		<label id="elh_dji_Adj_Close" for="x_Adj_Close" class="<?php echo $dji_add->LeftColumnClass ?>"><?php echo $dji->Adj_Close->caption() ?><?php echo ($dji->Adj_Close->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_add->RightColumnClass ?>"><div<?php echo $dji->Adj_Close->cellAttributes() ?>>
<span id="el_dji_Adj_Close">
<input type="text" data-table="dji" data-field="x_Adj_Close" name="x_Adj_Close" id="x_Adj_Close" size="30" placeholder="<?php echo HtmlEncode($dji->Adj_Close->getPlaceHolder()) ?>" value="<?php echo $dji->Adj_Close->EditValue ?>"<?php echo $dji->Adj_Close->editAttributes() ?>>
</span>
<?php echo $dji->Adj_Close->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Adj_Close">
		<td class="<?php echo $dji_add->TableLeftColumnClass ?>"><span id="elh_dji_Adj_Close"><?php echo $dji->Adj_Close->caption() ?><?php echo ($dji->Adj_Close->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $dji->Adj_Close->cellAttributes() ?>>
<span id="el_dji_Adj_Close">
<input type="text" data-table="dji" data-field="x_Adj_Close" name="x_Adj_Close" id="x_Adj_Close" size="30" placeholder="<?php echo HtmlEncode($dji->Adj_Close->getPlaceHolder()) ?>" value="<?php echo $dji->Adj_Close->EditValue ?>"<?php echo $dji->Adj_Close->editAttributes() ?>>
</span>
<?php echo $dji->Adj_Close->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($dji->Name->Visible) { // Name ?>
<?php if ($dji_add->IsMobileOrModal) { ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_dji_Name" for="x_Name" class="<?php echo $dji_add->LeftColumnClass ?>"><?php echo $dji->Name->caption() ?><?php echo ($dji->Name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_add->RightColumnClass ?>"><div<?php echo $dji->Name->cellAttributes() ?>>
<span id="el_dji_Name">
<input type="text" data-table="dji" data-field="x_Name" name="x_Name" id="x_Name" placeholder="<?php echo HtmlEncode($dji->Name->getPlaceHolder()) ?>" value="<?php echo $dji->Name->EditValue ?>"<?php echo $dji->Name->editAttributes() ?>>
</span>
<?php echo $dji->Name->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Name">
		<td class="<?php echo $dji_add->TableLeftColumnClass ?>"><span id="elh_dji_Name"><?php echo $dji->Name->caption() ?><?php echo ($dji->Name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $dji->Name->cellAttributes() ?>>
<span id="el_dji_Name">
<input type="text" data-table="dji" data-field="x_Name" name="x_Name" id="x_Name" placeholder="<?php echo HtmlEncode($dji->Name->getPlaceHolder()) ?>" value="<?php echo $dji->Name->EditValue ?>"<?php echo $dji->Name->editAttributes() ?>>
</span>
<?php echo $dji->Name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($dji->Name2->Visible) { // Name2 ?>
<?php if ($dji_add->IsMobileOrModal) { ?>
	<div id="r_Name2" class="form-group row">
		<label id="elh_dji_Name2" for="x_Name2" class="<?php echo $dji_add->LeftColumnClass ?>"><?php echo $dji->Name2->caption() ?><?php echo ($dji->Name2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_add->RightColumnClass ?>"><div<?php echo $dji->Name2->cellAttributes() ?>>
<span id="el_dji_Name2">
<input type="text" data-table="dji" data-field="x_Name2" name="x_Name2" id="x_Name2" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($dji->Name2->getPlaceHolder()) ?>" value="<?php echo $dji->Name2->EditValue ?>"<?php echo $dji->Name2->editAttributes() ?>>
</span>
<?php echo $dji->Name2->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Name2">
		<td class="<?php echo $dji_add->TableLeftColumnClass ?>"><span id="elh_dji_Name2"><?php echo $dji->Name2->caption() ?><?php echo ($dji->Name2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $dji->Name2->cellAttributes() ?>>
<span id="el_dji_Name2">
<input type="text" data-table="dji" data-field="x_Name2" name="x_Name2" id="x_Name2" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($dji->Name2->getPlaceHolder()) ?>" value="<?php echo $dji->Name2->EditValue ?>"<?php echo $dji->Name2->editAttributes() ?>>
</span>
<?php echo $dji->Name2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($dji_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$dji_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $dji_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $dji_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$dji_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$dji_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$dji_add->terminate();
?>
