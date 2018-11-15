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
$models_edit = new models_edit();

// Run the page
$models_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$models_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fmodelsedit = currentForm = new ew.Form("fmodelsedit", "edit");

// Validate form
fmodelsedit.validate = function() {
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
		<?php if ($models_edit->ID->Required) { ?>
			elm = this.getElements("x" + infix + "_ID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $models->ID->caption(), $models->ID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($models_edit->Trademark->Required) { ?>
			elm = this.getElements("x" + infix + "_Trademark");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $models->Trademark->caption(), $models->Trademark->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Trademark");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($models->Trademark->errorMessage()) ?>");
		<?php if ($models_edit->Model->Required) { ?>
			elm = this.getElements("x" + infix + "_Model");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $models->Model->caption(), $models->Model->RequiredErrorMessage)) ?>");
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
fmodelsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fmodelsedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $models_edit->showPageHeader(); ?>
<?php
$models_edit->showMessage();
?>
<?php if (!$models_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($models_edit->Pager)) $models_edit->Pager = new PrevNextPager($models_edit->StartRec, $models_edit->DisplayRecs, $models_edit->TotalRecs, $models_edit->AutoHidePager) ?>
<?php if ($models_edit->Pager->RecordCount > 0 && $models_edit->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($models_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $models_edit->pageUrl() ?>start=<?php echo $models_edit->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($models_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $models_edit->pageUrl() ?>start=<?php echo $models_edit->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $models_edit->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($models_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $models_edit->pageUrl() ?>start=<?php echo $models_edit->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($models_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $models_edit->pageUrl() ?>start=<?php echo $models_edit->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $models_edit->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fmodelsedit" id="fmodelsedit" class="<?php echo $models_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($models_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $models_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="models">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$models_edit->IsModal ?>">
<?php if (!$models_edit->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($models_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_modelsedit" class="table ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($models->ID->Visible) { // ID ?>
<?php if ($models_edit->IsMobileOrModal) { ?>
	<div id="r_ID" class="form-group row">
		<label id="elh_models_ID" class="<?php echo $models_edit->LeftColumnClass ?>"><?php echo $models->ID->caption() ?><?php echo ($models->ID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $models_edit->RightColumnClass ?>"><div<?php echo $models->ID->cellAttributes() ?>>
<span id="el_models_ID">
<span<?php echo $models->ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($models->ID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="models" data-field="x_ID" name="x_ID" id="x_ID" value="<?php echo HtmlEncode($models->ID->CurrentValue) ?>">
<?php echo $models->ID->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ID">
		<td class="<?php echo $models_edit->TableLeftColumnClass ?>"><span id="elh_models_ID"><?php echo $models->ID->caption() ?><?php echo ($models->ID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $models->ID->cellAttributes() ?>>
<span id="el_models_ID">
<span<?php echo $models->ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($models->ID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="models" data-field="x_ID" name="x_ID" id="x_ID" value="<?php echo HtmlEncode($models->ID->CurrentValue) ?>">
<?php echo $models->ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($models->Trademark->Visible) { // Trademark ?>
<?php if ($models_edit->IsMobileOrModal) { ?>
	<div id="r_Trademark" class="form-group row">
		<label id="elh_models_Trademark" for="x_Trademark" class="<?php echo $models_edit->LeftColumnClass ?>"><?php echo $models->Trademark->caption() ?><?php echo ($models->Trademark->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $models_edit->RightColumnClass ?>"><div<?php echo $models->Trademark->cellAttributes() ?>>
<span id="el_models_Trademark">
<input type="text" data-table="models" data-field="x_Trademark" name="x_Trademark" id="x_Trademark" size="30" placeholder="<?php echo HtmlEncode($models->Trademark->getPlaceHolder()) ?>" value="<?php echo $models->Trademark->EditValue ?>"<?php echo $models->Trademark->editAttributes() ?>>
</span>
<?php echo $models->Trademark->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Trademark">
		<td class="<?php echo $models_edit->TableLeftColumnClass ?>"><span id="elh_models_Trademark"><?php echo $models->Trademark->caption() ?><?php echo ($models->Trademark->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $models->Trademark->cellAttributes() ?>>
<span id="el_models_Trademark">
<input type="text" data-table="models" data-field="x_Trademark" name="x_Trademark" id="x_Trademark" size="30" placeholder="<?php echo HtmlEncode($models->Trademark->getPlaceHolder()) ?>" value="<?php echo $models->Trademark->EditValue ?>"<?php echo $models->Trademark->editAttributes() ?>>
</span>
<?php echo $models->Trademark->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($models->Model->Visible) { // Model ?>
<?php if ($models_edit->IsMobileOrModal) { ?>
	<div id="r_Model" class="form-group row">
		<label id="elh_models_Model" for="x_Model" class="<?php echo $models_edit->LeftColumnClass ?>"><?php echo $models->Model->caption() ?><?php echo ($models->Model->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $models_edit->RightColumnClass ?>"><div<?php echo $models->Model->cellAttributes() ?>>
<span id="el_models_Model">
<input type="text" data-table="models" data-field="x_Model" name="x_Model" id="x_Model" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($models->Model->getPlaceHolder()) ?>" value="<?php echo $models->Model->EditValue ?>"<?php echo $models->Model->editAttributes() ?>>
</span>
<?php echo $models->Model->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Model">
		<td class="<?php echo $models_edit->TableLeftColumnClass ?>"><span id="elh_models_Model"><?php echo $models->Model->caption() ?><?php echo ($models->Model->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $models->Model->cellAttributes() ?>>
<span id="el_models_Model">
<input type="text" data-table="models" data-field="x_Model" name="x_Model" id="x_Model" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($models->Model->getPlaceHolder()) ?>" value="<?php echo $models->Model->EditValue ?>"<?php echo $models->Model->editAttributes() ?>>
</span>
<?php echo $models->Model->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($models_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$models_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $models_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $models_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$models_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
<?php if (!$models_edit->IsModal) { ?>
<?php if (!isset($models_edit->Pager)) $models_edit->Pager = new PrevNextPager($models_edit->StartRec, $models_edit->DisplayRecs, $models_edit->TotalRecs, $models_edit->AutoHidePager) ?>
<?php if ($models_edit->Pager->RecordCount > 0 && $models_edit->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($models_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $models_edit->pageUrl() ?>start=<?php echo $models_edit->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($models_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $models_edit->pageUrl() ?>start=<?php echo $models_edit->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $models_edit->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($models_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $models_edit->pageUrl() ?>start=<?php echo $models_edit->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($models_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $models_edit->pageUrl() ?>start=<?php echo $models_edit->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $models_edit->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$models_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$models_edit->terminate();
?>
