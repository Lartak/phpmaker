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
$trademarks_add = new trademarks_add();

// Run the page
$trademarks_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$trademarks_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var ftrademarksadd = currentForm = new ew.Form("ftrademarksadd", "add");

// Validate form
ftrademarksadd.validate = function() {
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
		<?php if ($trademarks_add->Trademark->Required) { ?>
			elm = this.getElements("x" + infix + "_Trademark");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trademarks->Trademark->caption(), $trademarks->Trademark->RequiredErrorMessage)) ?>");
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
ftrademarksadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftrademarksadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $trademarks_add->showPageHeader(); ?>
<?php
$trademarks_add->showMessage();
?>
<form name="ftrademarksadd" id="ftrademarksadd" class="<?php echo $trademarks_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($trademarks_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $trademarks_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="trademarks">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$trademarks_add->IsModal ?>">
<?php if (!$trademarks_add->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($trademarks_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_trademarksadd" class="table ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($trademarks->Trademark->Visible) { // Trademark ?>
<?php if ($trademarks_add->IsMobileOrModal) { ?>
	<div id="r_Trademark" class="form-group row">
		<label id="elh_trademarks_Trademark" for="x_Trademark" class="<?php echo $trademarks_add->LeftColumnClass ?>"><?php echo $trademarks->Trademark->caption() ?><?php echo ($trademarks->Trademark->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trademarks_add->RightColumnClass ?>"><div<?php echo $trademarks->Trademark->cellAttributes() ?>>
<span id="el_trademarks_Trademark">
<input type="text" data-table="trademarks" data-field="x_Trademark" name="x_Trademark" id="x_Trademark" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($trademarks->Trademark->getPlaceHolder()) ?>" value="<?php echo $trademarks->Trademark->EditValue ?>"<?php echo $trademarks->Trademark->editAttributes() ?>>
</span>
<?php echo $trademarks->Trademark->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Trademark">
		<td class="<?php echo $trademarks_add->TableLeftColumnClass ?>"><span id="elh_trademarks_Trademark"><?php echo $trademarks->Trademark->caption() ?><?php echo ($trademarks->Trademark->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $trademarks->Trademark->cellAttributes() ?>>
<span id="el_trademarks_Trademark">
<input type="text" data-table="trademarks" data-field="x_Trademark" name="x_Trademark" id="x_Trademark" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($trademarks->Trademark->getPlaceHolder()) ?>" value="<?php echo $trademarks->Trademark->EditValue ?>"<?php echo $trademarks->Trademark->editAttributes() ?>>
</span>
<?php echo $trademarks->Trademark->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($trademarks_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$trademarks_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $trademarks_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $trademarks_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$trademarks_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$trademarks_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$trademarks_add->terminate();
?>
