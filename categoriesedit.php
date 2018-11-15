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
$categories_edit = new categories_edit();

// Run the page
$categories_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$categories_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fcategoriesedit = currentForm = new ew.Form("fcategoriesedit", "edit");

// Validate form
fcategoriesedit.validate = function() {
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
		<?php if ($categories_edit->CategoryID->Required) { ?>
			elm = this.getElements("x" + infix + "_CategoryID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $categories->CategoryID->caption(), $categories->CategoryID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($categories_edit->CategoryName->Required) { ?>
			elm = this.getElements("x" + infix + "_CategoryName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $categories->CategoryName->caption(), $categories->CategoryName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($categories_edit->Description->Required) { ?>
			elm = this.getElements("x" + infix + "_Description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $categories->Description->caption(), $categories->Description->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($categories_edit->Picture->Required) { ?>
			felm = this.getElements("x" + infix + "_Picture");
			elm = this.getElements("fn_x" + infix + "_Picture");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $categories->Picture->caption(), $categories->Picture->RequiredErrorMessage)) ?>");
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
fcategoriesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcategoriesedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $categories_edit->showPageHeader(); ?>
<?php
$categories_edit->showMessage();
?>
<?php if (!$categories_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($categories_edit->Pager)) $categories_edit->Pager = new PrevNextPager($categories_edit->StartRec, $categories_edit->DisplayRecs, $categories_edit->TotalRecs, $categories_edit->AutoHidePager) ?>
<?php if ($categories_edit->Pager->RecordCount > 0 && $categories_edit->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($categories_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $categories_edit->pageUrl() ?>start=<?php echo $categories_edit->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($categories_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $categories_edit->pageUrl() ?>start=<?php echo $categories_edit->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $categories_edit->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($categories_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $categories_edit->pageUrl() ?>start=<?php echo $categories_edit->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($categories_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $categories_edit->pageUrl() ?>start=<?php echo $categories_edit->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $categories_edit->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fcategoriesedit" id="fcategoriesedit" class="<?php echo $categories_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($categories_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $categories_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="categories">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$categories_edit->IsModal ?>">
<?php if (!$categories_edit->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($categories_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_categoriesedit" class="table ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($categories->CategoryID->Visible) { // CategoryID ?>
<?php if ($categories_edit->IsMobileOrModal) { ?>
	<div id="r_CategoryID" class="form-group row">
		<label id="elh_categories_CategoryID" class="<?php echo $categories_edit->LeftColumnClass ?>"><?php echo $categories->CategoryID->caption() ?><?php echo ($categories->CategoryID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $categories_edit->RightColumnClass ?>"><div<?php echo $categories->CategoryID->cellAttributes() ?>>
<span id="el_categories_CategoryID">
<span<?php echo $categories->CategoryID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($categories->CategoryID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="categories" data-field="x_CategoryID" name="x_CategoryID" id="x_CategoryID" value="<?php echo HtmlEncode($categories->CategoryID->CurrentValue) ?>">
<?php echo $categories->CategoryID->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_CategoryID">
		<td class="<?php echo $categories_edit->TableLeftColumnClass ?>"><span id="elh_categories_CategoryID"><?php echo $categories->CategoryID->caption() ?><?php echo ($categories->CategoryID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $categories->CategoryID->cellAttributes() ?>>
<span id="el_categories_CategoryID">
<span<?php echo $categories->CategoryID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($categories->CategoryID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="categories" data-field="x_CategoryID" name="x_CategoryID" id="x_CategoryID" value="<?php echo HtmlEncode($categories->CategoryID->CurrentValue) ?>">
<?php echo $categories->CategoryID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($categories->CategoryName->Visible) { // CategoryName ?>
<?php if ($categories_edit->IsMobileOrModal) { ?>
	<div id="r_CategoryName" class="form-group row">
		<label id="elh_categories_CategoryName" for="x_CategoryName" class="<?php echo $categories_edit->LeftColumnClass ?>"><?php echo $categories->CategoryName->caption() ?><?php echo ($categories->CategoryName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $categories_edit->RightColumnClass ?>"><div<?php echo $categories->CategoryName->cellAttributes() ?>>
<span id="el_categories_CategoryName">
<input type="text" data-table="categories" data-field="x_CategoryName" name="x_CategoryName" id="x_CategoryName" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($categories->CategoryName->getPlaceHolder()) ?>" value="<?php echo $categories->CategoryName->EditValue ?>"<?php echo $categories->CategoryName->editAttributes() ?>>
</span>
<?php echo $categories->CategoryName->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_CategoryName">
		<td class="<?php echo $categories_edit->TableLeftColumnClass ?>"><span id="elh_categories_CategoryName"><?php echo $categories->CategoryName->caption() ?><?php echo ($categories->CategoryName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $categories->CategoryName->cellAttributes() ?>>
<span id="el_categories_CategoryName">
<input type="text" data-table="categories" data-field="x_CategoryName" name="x_CategoryName" id="x_CategoryName" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($categories->CategoryName->getPlaceHolder()) ?>" value="<?php echo $categories->CategoryName->EditValue ?>"<?php echo $categories->CategoryName->editAttributes() ?>>
</span>
<?php echo $categories->CategoryName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($categories->Description->Visible) { // Description ?>
<?php if ($categories_edit->IsMobileOrModal) { ?>
	<div id="r_Description" class="form-group row">
		<label id="elh_categories_Description" for="x_Description" class="<?php echo $categories_edit->LeftColumnClass ?>"><?php echo $categories->Description->caption() ?><?php echo ($categories->Description->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $categories_edit->RightColumnClass ?>"><div<?php echo $categories->Description->cellAttributes() ?>>
<span id="el_categories_Description">
<textarea data-table="categories" data-field="x_Description" name="x_Description" id="x_Description" cols="35" rows="4" placeholder="<?php echo HtmlEncode($categories->Description->getPlaceHolder()) ?>"<?php echo $categories->Description->editAttributes() ?>><?php echo $categories->Description->EditValue ?></textarea>
</span>
<?php echo $categories->Description->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Description">
		<td class="<?php echo $categories_edit->TableLeftColumnClass ?>"><span id="elh_categories_Description"><?php echo $categories->Description->caption() ?><?php echo ($categories->Description->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $categories->Description->cellAttributes() ?>>
<span id="el_categories_Description">
<textarea data-table="categories" data-field="x_Description" name="x_Description" id="x_Description" cols="35" rows="4" placeholder="<?php echo HtmlEncode($categories->Description->getPlaceHolder()) ?>"<?php echo $categories->Description->editAttributes() ?>><?php echo $categories->Description->EditValue ?></textarea>
</span>
<?php echo $categories->Description->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($categories->Picture->Visible) { // Picture ?>
<?php if ($categories_edit->IsMobileOrModal) { ?>
	<div id="r_Picture" class="form-group row">
		<label id="elh_categories_Picture" class="<?php echo $categories_edit->LeftColumnClass ?>"><?php echo $categories->Picture->caption() ?><?php echo ($categories->Picture->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $categories_edit->RightColumnClass ?>"><div<?php echo $categories->Picture->cellAttributes() ?>>
<span id="el_categories_Picture">
<div id="fd_x_Picture">
<span title="<?php echo $categories->Picture->title() ? $categories->Picture->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($categories->Picture->ReadOnly || $categories->Picture->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="categories" data-field="x_Picture" name="x_Picture" id="x_Picture"<?php echo $categories->Picture->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_Picture" id= "fn_x_Picture" value="<?php echo $categories->Picture->Upload->FileName ?>">
<?php if (Post("fa_x_Picture") == "0") { ?>
<input type="hidden" name="fa_x_Picture" id= "fa_x_Picture" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_Picture" id= "fa_x_Picture" value="1">
<?php } ?>
<input type="hidden" name="fs_x_Picture" id= "fs_x_Picture" value="0">
<input type="hidden" name="fx_x_Picture" id= "fx_x_Picture" value="<?php echo $categories->Picture->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Picture" id= "fm_x_Picture" value="<?php echo $categories->Picture->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Picture" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $categories->Picture->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Picture">
		<td class="<?php echo $categories_edit->TableLeftColumnClass ?>"><span id="elh_categories_Picture"><?php echo $categories->Picture->caption() ?><?php echo ($categories->Picture->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $categories->Picture->cellAttributes() ?>>
<span id="el_categories_Picture">
<div id="fd_x_Picture">
<span title="<?php echo $categories->Picture->title() ? $categories->Picture->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($categories->Picture->ReadOnly || $categories->Picture->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="categories" data-field="x_Picture" name="x_Picture" id="x_Picture"<?php echo $categories->Picture->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_Picture" id= "fn_x_Picture" value="<?php echo $categories->Picture->Upload->FileName ?>">
<?php if (Post("fa_x_Picture") == "0") { ?>
<input type="hidden" name="fa_x_Picture" id= "fa_x_Picture" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_Picture" id= "fa_x_Picture" value="1">
<?php } ?>
<input type="hidden" name="fs_x_Picture" id= "fs_x_Picture" value="0">
<input type="hidden" name="fx_x_Picture" id= "fx_x_Picture" value="<?php echo $categories->Picture->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Picture" id= "fm_x_Picture" value="<?php echo $categories->Picture->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Picture" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $categories->Picture->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($categories_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$categories_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $categories_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $categories_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$categories_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
<?php if (!$categories_edit->IsModal) { ?>
<?php if (!isset($categories_edit->Pager)) $categories_edit->Pager = new PrevNextPager($categories_edit->StartRec, $categories_edit->DisplayRecs, $categories_edit->TotalRecs, $categories_edit->AutoHidePager) ?>
<?php if ($categories_edit->Pager->RecordCount > 0 && $categories_edit->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($categories_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $categories_edit->pageUrl() ?>start=<?php echo $categories_edit->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($categories_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $categories_edit->pageUrl() ?>start=<?php echo $categories_edit->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $categories_edit->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($categories_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $categories_edit->pageUrl() ?>start=<?php echo $categories_edit->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($categories_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $categories_edit->pageUrl() ?>start=<?php echo $categories_edit->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $categories_edit->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$categories_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$categories_edit->terminate();
?>
