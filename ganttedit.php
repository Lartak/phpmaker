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
$gantt_edit = new gantt_edit();

// Run the page
$gantt_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gantt_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fganttedit = currentForm = new ew.Form("fganttedit", "edit");

// Validate form
fganttedit.validate = function() {
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
		<?php if ($gantt_edit->id->Required) { ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gantt->id->caption(), $gantt->id->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($gantt->id->errorMessage()) ?>");
		<?php if ($gantt_edit->name->Required) { ?>
			elm = this.getElements("x" + infix + "_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gantt->name->caption(), $gantt->name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($gantt_edit->start->Required) { ?>
			elm = this.getElements("x" + infix + "_start");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gantt->start->caption(), $gantt->start->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_start");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($gantt->start->errorMessage()) ?>");
		<?php if ($gantt_edit->end->Required) { ?>
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
fganttedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fganttedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $gantt_edit->showPageHeader(); ?>
<?php
$gantt_edit->showMessage();
?>
<?php if (!$gantt_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($gantt_edit->Pager)) $gantt_edit->Pager = new PrevNextPager($gantt_edit->StartRec, $gantt_edit->DisplayRecs, $gantt_edit->TotalRecs, $gantt_edit->AutoHidePager) ?>
<?php if ($gantt_edit->Pager->RecordCount > 0 && $gantt_edit->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($gantt_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $gantt_edit->pageUrl() ?>start=<?php echo $gantt_edit->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($gantt_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $gantt_edit->pageUrl() ?>start=<?php echo $gantt_edit->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $gantt_edit->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($gantt_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $gantt_edit->pageUrl() ?>start=<?php echo $gantt_edit->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($gantt_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $gantt_edit->pageUrl() ?>start=<?php echo $gantt_edit->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $gantt_edit->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fganttedit" id="fganttedit" class="<?php echo $gantt_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($gantt_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $gantt_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gantt">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$gantt_edit->IsModal ?>">
<?php if (!$gantt_edit->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($gantt_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_ganttedit" class="table ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($gantt->id->Visible) { // id ?>
<?php if ($gantt_edit->IsMobileOrModal) { ?>
	<div id="r_id" class="form-group row">
		<label id="elh_gantt_id" for="x_id" class="<?php echo $gantt_edit->LeftColumnClass ?>"><?php echo $gantt->id->caption() ?><?php echo ($gantt->id->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gantt_edit->RightColumnClass ?>"><div<?php echo $gantt->id->cellAttributes() ?>>
<span id="el_gantt_id">
<span<?php echo $gantt->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($gantt->id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="gantt" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($gantt->id->CurrentValue) ?>">
<?php echo $gantt->id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id">
		<td class="<?php echo $gantt_edit->TableLeftColumnClass ?>"><span id="elh_gantt_id"><?php echo $gantt->id->caption() ?><?php echo ($gantt->id->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $gantt->id->cellAttributes() ?>>
<span id="el_gantt_id">
<span<?php echo $gantt->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($gantt->id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="gantt" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($gantt->id->CurrentValue) ?>">
<?php echo $gantt->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($gantt->name->Visible) { // name ?>
<?php if ($gantt_edit->IsMobileOrModal) { ?>
	<div id="r_name" class="form-group row">
		<label id="elh_gantt_name" for="x_name" class="<?php echo $gantt_edit->LeftColumnClass ?>"><?php echo $gantt->name->caption() ?><?php echo ($gantt->name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gantt_edit->RightColumnClass ?>"><div<?php echo $gantt->name->cellAttributes() ?>>
<span id="el_gantt_name">
<input type="text" data-table="gantt" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($gantt->name->getPlaceHolder()) ?>" value="<?php echo $gantt->name->EditValue ?>"<?php echo $gantt->name->editAttributes() ?>>
</span>
<?php echo $gantt->name->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_name">
		<td class="<?php echo $gantt_edit->TableLeftColumnClass ?>"><span id="elh_gantt_name"><?php echo $gantt->name->caption() ?><?php echo ($gantt->name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $gantt->name->cellAttributes() ?>>
<span id="el_gantt_name">
<input type="text" data-table="gantt" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($gantt->name->getPlaceHolder()) ?>" value="<?php echo $gantt->name->EditValue ?>"<?php echo $gantt->name->editAttributes() ?>>
</span>
<?php echo $gantt->name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($gantt->start->Visible) { // start ?>
<?php if ($gantt_edit->IsMobileOrModal) { ?>
	<div id="r_start" class="form-group row">
		<label id="elh_gantt_start" for="x_start" class="<?php echo $gantt_edit->LeftColumnClass ?>"><?php echo $gantt->start->caption() ?><?php echo ($gantt->start->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gantt_edit->RightColumnClass ?>"><div<?php echo $gantt->start->cellAttributes() ?>>
<span id="el_gantt_start">
<input type="text" data-table="gantt" data-field="x_start" name="x_start" id="x_start" placeholder="<?php echo HtmlEncode($gantt->start->getPlaceHolder()) ?>" value="<?php echo $gantt->start->EditValue ?>"<?php echo $gantt->start->editAttributes() ?>>
</span>
<?php echo $gantt->start->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_start">
		<td class="<?php echo $gantt_edit->TableLeftColumnClass ?>"><span id="elh_gantt_start"><?php echo $gantt->start->caption() ?><?php echo ($gantt->start->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $gantt->start->cellAttributes() ?>>
<span id="el_gantt_start">
<input type="text" data-table="gantt" data-field="x_start" name="x_start" id="x_start" placeholder="<?php echo HtmlEncode($gantt->start->getPlaceHolder()) ?>" value="<?php echo $gantt->start->EditValue ?>"<?php echo $gantt->start->editAttributes() ?>>
</span>
<?php echo $gantt->start->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($gantt->end->Visible) { // end ?>
<?php if ($gantt_edit->IsMobileOrModal) { ?>
	<div id="r_end" class="form-group row">
		<label id="elh_gantt_end" for="x_end" class="<?php echo $gantt_edit->LeftColumnClass ?>"><?php echo $gantt->end->caption() ?><?php echo ($gantt->end->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gantt_edit->RightColumnClass ?>"><div<?php echo $gantt->end->cellAttributes() ?>>
<span id="el_gantt_end">
<input type="text" data-table="gantt" data-field="x_end" name="x_end" id="x_end" placeholder="<?php echo HtmlEncode($gantt->end->getPlaceHolder()) ?>" value="<?php echo $gantt->end->EditValue ?>"<?php echo $gantt->end->editAttributes() ?>>
</span>
<?php echo $gantt->end->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_end">
		<td class="<?php echo $gantt_edit->TableLeftColumnClass ?>"><span id="elh_gantt_end"><?php echo $gantt->end->caption() ?><?php echo ($gantt->end->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $gantt->end->cellAttributes() ?>>
<span id="el_gantt_end">
<input type="text" data-table="gantt" data-field="x_end" name="x_end" id="x_end" placeholder="<?php echo HtmlEncode($gantt->end->getPlaceHolder()) ?>" value="<?php echo $gantt->end->EditValue ?>"<?php echo $gantt->end->editAttributes() ?>>
</span>
<?php echo $gantt->end->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($gantt_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$gantt_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $gantt_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gantt_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$gantt_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
<?php if (!$gantt_edit->IsModal) { ?>
<?php if (!isset($gantt_edit->Pager)) $gantt_edit->Pager = new PrevNextPager($gantt_edit->StartRec, $gantt_edit->DisplayRecs, $gantt_edit->TotalRecs, $gantt_edit->AutoHidePager) ?>
<?php if ($gantt_edit->Pager->RecordCount > 0 && $gantt_edit->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($gantt_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $gantt_edit->pageUrl() ?>start=<?php echo $gantt_edit->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($gantt_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $gantt_edit->pageUrl() ?>start=<?php echo $gantt_edit->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $gantt_edit->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($gantt_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $gantt_edit->pageUrl() ?>start=<?php echo $gantt_edit->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($gantt_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $gantt_edit->pageUrl() ?>start=<?php echo $gantt_edit->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $gantt_edit->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$gantt_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$gantt_edit->terminate();
?>
