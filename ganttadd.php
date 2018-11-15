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
$gantt_add = new gantt_add();

// Run the page
$gantt_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gantt_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fganttadd = currentForm = new ew.Form("fganttadd", "add");

// Validate form
fganttadd.validate = function() {
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
		<?php if ($gantt_add->id->Required) { ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gantt->id->caption(), $gantt->id->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($gantt->id->errorMessage()) ?>");
		<?php if ($gantt_add->name->Required) { ?>
			elm = this.getElements("x" + infix + "_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gantt->name->caption(), $gantt->name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($gantt_add->start->Required) { ?>
			elm = this.getElements("x" + infix + "_start");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gantt->start->caption(), $gantt->start->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_start");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($gantt->start->errorMessage()) ?>");
		<?php if ($gantt_add->end->Required) { ?>
			elm = this.getElements("x" + infix + "_end");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gantt->end->caption(), $gantt->end->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_end");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($gantt->end->errorMessage()) ?>");

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
fganttadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fganttadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $gantt_add->showPageHeader(); ?>
<?php
$gantt_add->showMessage();
?>
<form name="fganttadd" id="fganttadd" class="<?php echo $gantt_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($gantt_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $gantt_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gantt">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$gantt_add->IsModal ?>">
<?php if (!$gantt_add->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($gantt_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_ganttadd" class="table ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($gantt->id->Visible) { // id ?>
<?php if ($gantt_add->IsMobileOrModal) { ?>
	<div id="r_id" class="form-group row">
		<label id="elh_gantt_id" for="x_id" class="<?php echo $gantt_add->LeftColumnClass ?>"><?php echo $gantt->id->caption() ?><?php echo ($gantt->id->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gantt_add->RightColumnClass ?>"><div<?php echo $gantt->id->cellAttributes() ?>>
<span id="el_gantt_id">
<input type="text" data-table="gantt" data-field="x_id" name="x_id" id="x_id" size="30" placeholder="<?php echo HtmlEncode($gantt->id->getPlaceHolder()) ?>" value="<?php echo $gantt->id->EditValue ?>"<?php echo $gantt->id->editAttributes() ?>>
</span>
<?php echo $gantt->id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id">
		<td class="<?php echo $gantt_add->TableLeftColumnClass ?>"><span id="elh_gantt_id"><?php echo $gantt->id->caption() ?><?php echo ($gantt->id->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $gantt->id->cellAttributes() ?>>
<span id="el_gantt_id">
<input type="text" data-table="gantt" data-field="x_id" name="x_id" id="x_id" size="30" placeholder="<?php echo HtmlEncode($gantt->id->getPlaceHolder()) ?>" value="<?php echo $gantt->id->EditValue ?>"<?php echo $gantt->id->editAttributes() ?>>
</span>
<?php echo $gantt->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($gantt->name->Visible) { // name ?>
<?php if ($gantt_add->IsMobileOrModal) { ?>
	<div id="r_name" class="form-group row">
		<label id="elh_gantt_name" for="x_name" class="<?php echo $gantt_add->LeftColumnClass ?>"><?php echo $gantt->name->caption() ?><?php echo ($gantt->name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gantt_add->RightColumnClass ?>"><div<?php echo $gantt->name->cellAttributes() ?>>
<span id="el_gantt_name">
<input type="text" data-table="gantt" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($gantt->name->getPlaceHolder()) ?>" value="<?php echo $gantt->name->EditValue ?>"<?php echo $gantt->name->editAttributes() ?>>
</span>
<?php echo $gantt->name->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_name">
		<td class="<?php echo $gantt_add->TableLeftColumnClass ?>"><span id="elh_gantt_name"><?php echo $gantt->name->caption() ?><?php echo ($gantt->name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $gantt->name->cellAttributes() ?>>
<span id="el_gantt_name">
<input type="text" data-table="gantt" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($gantt->name->getPlaceHolder()) ?>" value="<?php echo $gantt->name->EditValue ?>"<?php echo $gantt->name->editAttributes() ?>>
</span>
<?php echo $gantt->name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($gantt->start->Visible) { // start ?>
<?php if ($gantt_add->IsMobileOrModal) { ?>
	<div id="r_start" class="form-group row">
		<label id="elh_gantt_start" for="x_start" class="<?php echo $gantt_add->LeftColumnClass ?>"><?php echo $gantt->start->caption() ?><?php echo ($gantt->start->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gantt_add->RightColumnClass ?>"><div<?php echo $gantt->start->cellAttributes() ?>>
<span id="el_gantt_start">
<input type="text" data-table="gantt" data-field="x_start" name="x_start" id="x_start" placeholder="<?php echo HtmlEncode($gantt->start->getPlaceHolder()) ?>" value="<?php echo $gantt->start->EditValue ?>"<?php echo $gantt->start->editAttributes() ?>>
</span>
<?php echo $gantt->start->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_start">
		<td class="<?php echo $gantt_add->TableLeftColumnClass ?>"><span id="elh_gantt_start"><?php echo $gantt->start->caption() ?><?php echo ($gantt->start->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $gantt->start->cellAttributes() ?>>
<span id="el_gantt_start">
<input type="text" data-table="gantt" data-field="x_start" name="x_start" id="x_start" placeholder="<?php echo HtmlEncode($gantt->start->getPlaceHolder()) ?>" value="<?php echo $gantt->start->EditValue ?>"<?php echo $gantt->start->editAttributes() ?>>
</span>
<?php echo $gantt->start->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($gantt->end->Visible) { // end ?>
<?php if ($gantt_add->IsMobileOrModal) { ?>
	<div id="r_end" class="form-group row">
		<label id="elh_gantt_end" for="x_end" class="<?php echo $gantt_add->LeftColumnClass ?>"><?php echo $gantt->end->caption() ?><?php echo ($gantt->end->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gantt_add->RightColumnClass ?>"><div<?php echo $gantt->end->cellAttributes() ?>>
<span id="el_gantt_end">
<input type="text" data-table="gantt" data-field="x_end" name="x_end" id="x_end" placeholder="<?php echo HtmlEncode($gantt->end->getPlaceHolder()) ?>" value="<?php echo $gantt->end->EditValue ?>"<?php echo $gantt->end->editAttributes() ?>>
</span>
<?php echo $gantt->end->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_end">
		<td class="<?php echo $gantt_add->TableLeftColumnClass ?>"><span id="elh_gantt_end"><?php echo $gantt->end->caption() ?><?php echo ($gantt->end->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $gantt->end->cellAttributes() ?>>
<span id="el_gantt_end">
<input type="text" data-table="gantt" data-field="x_end" name="x_end" id="x_end" placeholder="<?php echo HtmlEncode($gantt->end->getPlaceHolder()) ?>" value="<?php echo $gantt->end->EditValue ?>"<?php echo $gantt->end->editAttributes() ?>>
</span>
<?php echo $gantt->end->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($gantt_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$gantt_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $gantt_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gantt_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$gantt_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$gantt_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$gantt_add->terminate();
?>
