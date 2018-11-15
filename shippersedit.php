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
$shippers_edit = new shippers_edit();

// Run the page
$shippers_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$shippers_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fshippersedit = currentForm = new ew.Form("fshippersedit", "edit");

// Validate form
fshippersedit.validate = function() {
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
		<?php if ($shippers_edit->ShipperID->Required) { ?>
			elm = this.getElements("x" + infix + "_ShipperID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $shippers->ShipperID->caption(), $shippers->ShipperID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($shippers_edit->CompanyName->Required) { ?>
			elm = this.getElements("x" + infix + "_CompanyName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $shippers->CompanyName->caption(), $shippers->CompanyName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($shippers_edit->Phone->Required) { ?>
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
fshippersedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fshippersedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $shippers_edit->showPageHeader(); ?>
<?php
$shippers_edit->showMessage();
?>
<?php if (!$shippers_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($shippers_edit->Pager)) $shippers_edit->Pager = new PrevNextPager($shippers_edit->StartRec, $shippers_edit->DisplayRecs, $shippers_edit->TotalRecs, $shippers_edit->AutoHidePager) ?>
<?php if ($shippers_edit->Pager->RecordCount > 0 && $shippers_edit->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($shippers_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $shippers_edit->pageUrl() ?>start=<?php echo $shippers_edit->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($shippers_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $shippers_edit->pageUrl() ?>start=<?php echo $shippers_edit->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $shippers_edit->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($shippers_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $shippers_edit->pageUrl() ?>start=<?php echo $shippers_edit->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($shippers_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $shippers_edit->pageUrl() ?>start=<?php echo $shippers_edit->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $shippers_edit->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fshippersedit" id="fshippersedit" class="<?php echo $shippers_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($shippers_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $shippers_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="shippers">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$shippers_edit->IsModal ?>">
<?php if (!$shippers_edit->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($shippers_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_shippersedit" class="table ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($shippers->ShipperID->Visible) { // ShipperID ?>
<?php if ($shippers_edit->IsMobileOrModal) { ?>
	<div id="r_ShipperID" class="form-group row">
		<label id="elh_shippers_ShipperID" class="<?php echo $shippers_edit->LeftColumnClass ?>"><?php echo $shippers->ShipperID->caption() ?><?php echo ($shippers->ShipperID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $shippers_edit->RightColumnClass ?>"><div<?php echo $shippers->ShipperID->cellAttributes() ?>>
<span id="el_shippers_ShipperID">
<span<?php echo $shippers->ShipperID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($shippers->ShipperID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="shippers" data-field="x_ShipperID" name="x_ShipperID" id="x_ShipperID" value="<?php echo HtmlEncode($shippers->ShipperID->CurrentValue) ?>">
<?php echo $shippers->ShipperID->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ShipperID">
		<td class="<?php echo $shippers_edit->TableLeftColumnClass ?>"><span id="elh_shippers_ShipperID"><?php echo $shippers->ShipperID->caption() ?><?php echo ($shippers->ShipperID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $shippers->ShipperID->cellAttributes() ?>>
<span id="el_shippers_ShipperID">
<span<?php echo $shippers->ShipperID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($shippers->ShipperID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="shippers" data-field="x_ShipperID" name="x_ShipperID" id="x_ShipperID" value="<?php echo HtmlEncode($shippers->ShipperID->CurrentValue) ?>">
<?php echo $shippers->ShipperID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($shippers->CompanyName->Visible) { // CompanyName ?>
<?php if ($shippers_edit->IsMobileOrModal) { ?>
	<div id="r_CompanyName" class="form-group row">
		<label id="elh_shippers_CompanyName" for="x_CompanyName" class="<?php echo $shippers_edit->LeftColumnClass ?>"><?php echo $shippers->CompanyName->caption() ?><?php echo ($shippers->CompanyName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $shippers_edit->RightColumnClass ?>"><div<?php echo $shippers->CompanyName->cellAttributes() ?>>
<span id="el_shippers_CompanyName">
<input type="text" data-table="shippers" data-field="x_CompanyName" name="x_CompanyName" id="x_CompanyName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($shippers->CompanyName->getPlaceHolder()) ?>" value="<?php echo $shippers->CompanyName->EditValue ?>"<?php echo $shippers->CompanyName->editAttributes() ?>>
</span>
<?php echo $shippers->CompanyName->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_CompanyName">
		<td class="<?php echo $shippers_edit->TableLeftColumnClass ?>"><span id="elh_shippers_CompanyName"><?php echo $shippers->CompanyName->caption() ?><?php echo ($shippers->CompanyName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $shippers->CompanyName->cellAttributes() ?>>
<span id="el_shippers_CompanyName">
<input type="text" data-table="shippers" data-field="x_CompanyName" name="x_CompanyName" id="x_CompanyName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($shippers->CompanyName->getPlaceHolder()) ?>" value="<?php echo $shippers->CompanyName->EditValue ?>"<?php echo $shippers->CompanyName->editAttributes() ?>>
</span>
<?php echo $shippers->CompanyName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($shippers->Phone->Visible) { // Phone ?>
<?php if ($shippers_edit->IsMobileOrModal) { ?>
	<div id="r_Phone" class="form-group row">
		<label id="elh_shippers_Phone" for="x_Phone" class="<?php echo $shippers_edit->LeftColumnClass ?>"><?php echo $shippers->Phone->caption() ?><?php echo ($shippers->Phone->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $shippers_edit->RightColumnClass ?>"><div<?php echo $shippers->Phone->cellAttributes() ?>>
<span id="el_shippers_Phone">
<input type="text" data-table="shippers" data-field="x_Phone" name="x_Phone" id="x_Phone" size="30" maxlength="24" placeholder="<?php echo HtmlEncode($shippers->Phone->getPlaceHolder()) ?>" value="<?php echo $shippers->Phone->EditValue ?>"<?php echo $shippers->Phone->editAttributes() ?>>
</span>
<?php echo $shippers->Phone->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Phone">
		<td class="<?php echo $shippers_edit->TableLeftColumnClass ?>"><span id="elh_shippers_Phone"><?php echo $shippers->Phone->caption() ?><?php echo ($shippers->Phone->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $shippers->Phone->cellAttributes() ?>>
<span id="el_shippers_Phone">
<input type="text" data-table="shippers" data-field="x_Phone" name="x_Phone" id="x_Phone" size="30" maxlength="24" placeholder="<?php echo HtmlEncode($shippers->Phone->getPlaceHolder()) ?>" value="<?php echo $shippers->Phone->EditValue ?>"<?php echo $shippers->Phone->editAttributes() ?>>
</span>
<?php echo $shippers->Phone->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($shippers_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$shippers_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $shippers_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $shippers_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$shippers_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
<?php if (!$shippers_edit->IsModal) { ?>
<?php if (!isset($shippers_edit->Pager)) $shippers_edit->Pager = new PrevNextPager($shippers_edit->StartRec, $shippers_edit->DisplayRecs, $shippers_edit->TotalRecs, $shippers_edit->AutoHidePager) ?>
<?php if ($shippers_edit->Pager->RecordCount > 0 && $shippers_edit->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($shippers_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $shippers_edit->pageUrl() ?>start=<?php echo $shippers_edit->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($shippers_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $shippers_edit->pageUrl() ?>start=<?php echo $shippers_edit->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $shippers_edit->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($shippers_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $shippers_edit->pageUrl() ?>start=<?php echo $shippers_edit->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($shippers_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $shippers_edit->pageUrl() ?>start=<?php echo $shippers_edit->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $shippers_edit->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$shippers_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$shippers_edit->terminate();
?>
