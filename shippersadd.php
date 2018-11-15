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
$shippers_add = new shippers_add();

// Run the page
$shippers_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$shippers_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fshippersadd = currentForm = new ew.Form("fshippersadd", "add");

// Validate form
fshippersadd.validate = function() {
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
		<?php if ($shippers_add->CompanyName->Required) { ?>
			elm = this.getElements("x" + infix + "_CompanyName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $shippers->CompanyName->caption(), $shippers->CompanyName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($shippers_add->Phone->Required) { ?>
			elm = this.getElements("x" + infix + "_Phone");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $shippers->Phone->caption(), $shippers->Phone->RequiredErrorMessage)) ?>");
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
fshippersadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fshippersadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $shippers_add->showPageHeader(); ?>
<?php
$shippers_add->showMessage();
?>
<form name="fshippersadd" id="fshippersadd" class="<?php echo $shippers_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($shippers_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $shippers_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="shippers">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$shippers_add->IsModal ?>">
<?php if (!$shippers_add->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($shippers_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_shippersadd" class="table ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($shippers->CompanyName->Visible) { // CompanyName ?>
<?php if ($shippers_add->IsMobileOrModal) { ?>
	<div id="r_CompanyName" class="form-group row">
		<label id="elh_shippers_CompanyName" for="x_CompanyName" class="<?php echo $shippers_add->LeftColumnClass ?>"><?php echo $shippers->CompanyName->caption() ?><?php echo ($shippers->CompanyName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $shippers_add->RightColumnClass ?>"><div<?php echo $shippers->CompanyName->cellAttributes() ?>>
<span id="el_shippers_CompanyName">
<input type="text" data-table="shippers" data-field="x_CompanyName" name="x_CompanyName" id="x_CompanyName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($shippers->CompanyName->getPlaceHolder()) ?>" value="<?php echo $shippers->CompanyName->EditValue ?>"<?php echo $shippers->CompanyName->editAttributes() ?>>
</span>
<?php echo $shippers->CompanyName->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_CompanyName">
		<td class="<?php echo $shippers_add->TableLeftColumnClass ?>"><span id="elh_shippers_CompanyName"><?php echo $shippers->CompanyName->caption() ?><?php echo ($shippers->CompanyName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $shippers->CompanyName->cellAttributes() ?>>
<span id="el_shippers_CompanyName">
<input type="text" data-table="shippers" data-field="x_CompanyName" name="x_CompanyName" id="x_CompanyName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($shippers->CompanyName->getPlaceHolder()) ?>" value="<?php echo $shippers->CompanyName->EditValue ?>"<?php echo $shippers->CompanyName->editAttributes() ?>>
</span>
<?php echo $shippers->CompanyName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($shippers->Phone->Visible) { // Phone ?>
<?php if ($shippers_add->IsMobileOrModal) { ?>
	<div id="r_Phone" class="form-group row">
		<label id="elh_shippers_Phone" for="x_Phone" class="<?php echo $shippers_add->LeftColumnClass ?>"><?php echo $shippers->Phone->caption() ?><?php echo ($shippers->Phone->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $shippers_add->RightColumnClass ?>"><div<?php echo $shippers->Phone->cellAttributes() ?>>
<span id="el_shippers_Phone">
<input type="text" data-table="shippers" data-field="x_Phone" name="x_Phone" id="x_Phone" size="30" maxlength="24" placeholder="<?php echo HtmlEncode($shippers->Phone->getPlaceHolder()) ?>" value="<?php echo $shippers->Phone->EditValue ?>"<?php echo $shippers->Phone->editAttributes() ?>>
</span>
<?php echo $shippers->Phone->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Phone">
		<td class="<?php echo $shippers_add->TableLeftColumnClass ?>"><span id="elh_shippers_Phone"><?php echo $shippers->Phone->caption() ?><?php echo ($shippers->Phone->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $shippers->Phone->cellAttributes() ?>>
<span id="el_shippers_Phone">
<input type="text" data-table="shippers" data-field="x_Phone" name="x_Phone" id="x_Phone" size="30" maxlength="24" placeholder="<?php echo HtmlEncode($shippers->Phone->getPlaceHolder()) ?>" value="<?php echo $shippers->Phone->EditValue ?>"<?php echo $shippers->Phone->editAttributes() ?>>
</span>
<?php echo $shippers->Phone->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($shippers_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$shippers_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $shippers_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $shippers_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$shippers_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$shippers_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$shippers_add->terminate();
?>
