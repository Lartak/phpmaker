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
$trademarks_edit = new trademarks_edit();

// Run the page
$trademarks_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$trademarks_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var ftrademarksedit = currentForm = new ew.Form("ftrademarksedit", "edit");

// Validate form
ftrademarksedit.validate = function() {
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
		<?php if ($trademarks_edit->ID->Required) { ?>
			elm = this.getElements("x" + infix + "_ID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trademarks->ID->caption(), $trademarks->ID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($trademarks_edit->Trademark->Required) { ?>
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
ftrademarksedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftrademarksedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $trademarks_edit->showPageHeader(); ?>
<?php
$trademarks_edit->showMessage();
?>
<?php if (!$trademarks_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($trademarks_edit->Pager)) $trademarks_edit->Pager = new PrevNextPager($trademarks_edit->StartRec, $trademarks_edit->DisplayRecs, $trademarks_edit->TotalRecs, $trademarks_edit->AutoHidePager) ?>
<?php if ($trademarks_edit->Pager->RecordCount > 0 && $trademarks_edit->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($trademarks_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $trademarks_edit->pageUrl() ?>start=<?php echo $trademarks_edit->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($trademarks_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $trademarks_edit->pageUrl() ?>start=<?php echo $trademarks_edit->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $trademarks_edit->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($trademarks_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $trademarks_edit->pageUrl() ?>start=<?php echo $trademarks_edit->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($trademarks_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $trademarks_edit->pageUrl() ?>start=<?php echo $trademarks_edit->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $trademarks_edit->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="ftrademarksedit" id="ftrademarksedit" class="<?php echo $trademarks_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($trademarks_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $trademarks_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="trademarks">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$trademarks_edit->IsModal ?>">
<?php if (!$trademarks_edit->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($trademarks_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_trademarksedit" class="table ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($trademarks->ID->Visible) { // ID ?>
<?php if ($trademarks_edit->IsMobileOrModal) { ?>
	<div id="r_ID" class="form-group row">
		<label id="elh_trademarks_ID" class="<?php echo $trademarks_edit->LeftColumnClass ?>"><?php echo $trademarks->ID->caption() ?><?php echo ($trademarks->ID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trademarks_edit->RightColumnClass ?>"><div<?php echo $trademarks->ID->cellAttributes() ?>>
<span id="el_trademarks_ID">
<span<?php echo $trademarks->ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($trademarks->ID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="trademarks" data-field="x_ID" name="x_ID" id="x_ID" value="<?php echo HtmlEncode($trademarks->ID->CurrentValue) ?>">
<?php echo $trademarks->ID->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ID">
		<td class="<?php echo $trademarks_edit->TableLeftColumnClass ?>"><span id="elh_trademarks_ID"><?php echo $trademarks->ID->caption() ?><?php echo ($trademarks->ID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $trademarks->ID->cellAttributes() ?>>
<span id="el_trademarks_ID">
<span<?php echo $trademarks->ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($trademarks->ID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="trademarks" data-field="x_ID" name="x_ID" id="x_ID" value="<?php echo HtmlEncode($trademarks->ID->CurrentValue) ?>">
<?php echo $trademarks->ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($trademarks->Trademark->Visible) { // Trademark ?>
<?php if ($trademarks_edit->IsMobileOrModal) { ?>
	<div id="r_Trademark" class="form-group row">
		<label id="elh_trademarks_Trademark" for="x_Trademark" class="<?php echo $trademarks_edit->LeftColumnClass ?>"><?php echo $trademarks->Trademark->caption() ?><?php echo ($trademarks->Trademark->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trademarks_edit->RightColumnClass ?>"><div<?php echo $trademarks->Trademark->cellAttributes() ?>>
<span id="el_trademarks_Trademark">
<input type="text" data-table="trademarks" data-field="x_Trademark" name="x_Trademark" id="x_Trademark" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($trademarks->Trademark->getPlaceHolder()) ?>" value="<?php echo $trademarks->Trademark->EditValue ?>"<?php echo $trademarks->Trademark->editAttributes() ?>>
</span>
<?php echo $trademarks->Trademark->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Trademark">
		<td class="<?php echo $trademarks_edit->TableLeftColumnClass ?>"><span id="elh_trademarks_Trademark"><?php echo $trademarks->Trademark->caption() ?><?php echo ($trademarks->Trademark->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $trademarks->Trademark->cellAttributes() ?>>
<span id="el_trademarks_Trademark">
<input type="text" data-table="trademarks" data-field="x_Trademark" name="x_Trademark" id="x_Trademark" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($trademarks->Trademark->getPlaceHolder()) ?>" value="<?php echo $trademarks->Trademark->EditValue ?>"<?php echo $trademarks->Trademark->editAttributes() ?>>
</span>
<?php echo $trademarks->Trademark->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($trademarks_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$trademarks_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $trademarks_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $trademarks_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$trademarks_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
<?php if (!$trademarks_edit->IsModal) { ?>
<?php if (!isset($trademarks_edit->Pager)) $trademarks_edit->Pager = new PrevNextPager($trademarks_edit->StartRec, $trademarks_edit->DisplayRecs, $trademarks_edit->TotalRecs, $trademarks_edit->AutoHidePager) ?>
<?php if ($trademarks_edit->Pager->RecordCount > 0 && $trademarks_edit->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($trademarks_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $trademarks_edit->pageUrl() ?>start=<?php echo $trademarks_edit->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($trademarks_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $trademarks_edit->pageUrl() ?>start=<?php echo $trademarks_edit->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $trademarks_edit->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($trademarks_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $trademarks_edit->pageUrl() ?>start=<?php echo $trademarks_edit->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($trademarks_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $trademarks_edit->pageUrl() ?>start=<?php echo $trademarks_edit->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $trademarks_edit->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$trademarks_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$trademarks_edit->terminate();
?>
