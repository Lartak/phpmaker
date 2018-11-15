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
$userlevelpermissions_edit = new userlevelpermissions_edit();

// Run the page
$userlevelpermissions_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$userlevelpermissions_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fuserlevelpermissionsedit = currentForm = new ew.Form("fuserlevelpermissionsedit", "edit");

// Validate form
fuserlevelpermissionsedit.validate = function() {
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
		<?php if ($userlevelpermissions_edit->userlevelid->Required) { ?>
			elm = this.getElements("x" + infix + "_userlevelid");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $userlevelpermissions->userlevelid->caption(), $userlevelpermissions->userlevelid->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_userlevelid");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($userlevelpermissions->userlevelid->errorMessage()) ?>");
		<?php if ($userlevelpermissions_edit->_tablename->Required) { ?>
			elm = this.getElements("x" + infix + "__tablename");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $userlevelpermissions->_tablename->caption(), $userlevelpermissions->_tablename->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($userlevelpermissions_edit->permission->Required) { ?>
			elm = this.getElements("x" + infix + "_permission");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $userlevelpermissions->permission->caption(), $userlevelpermissions->permission->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_permission");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($userlevelpermissions->permission->errorMessage()) ?>");

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
fuserlevelpermissionsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fuserlevelpermissionsedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $userlevelpermissions_edit->showPageHeader(); ?>
<?php
$userlevelpermissions_edit->showMessage();
?>
<?php if (!$userlevelpermissions_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($userlevelpermissions_edit->Pager)) $userlevelpermissions_edit->Pager = new PrevNextPager($userlevelpermissions_edit->StartRec, $userlevelpermissions_edit->DisplayRecs, $userlevelpermissions_edit->TotalRecs, $userlevelpermissions_edit->AutoHidePager) ?>
<?php if ($userlevelpermissions_edit->Pager->RecordCount > 0 && $userlevelpermissions_edit->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($userlevelpermissions_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $userlevelpermissions_edit->pageUrl() ?>start=<?php echo $userlevelpermissions_edit->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($userlevelpermissions_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $userlevelpermissions_edit->pageUrl() ?>start=<?php echo $userlevelpermissions_edit->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $userlevelpermissions_edit->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($userlevelpermissions_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $userlevelpermissions_edit->pageUrl() ?>start=<?php echo $userlevelpermissions_edit->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($userlevelpermissions_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $userlevelpermissions_edit->pageUrl() ?>start=<?php echo $userlevelpermissions_edit->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $userlevelpermissions_edit->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fuserlevelpermissionsedit" id="fuserlevelpermissionsedit" class="<?php echo $userlevelpermissions_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($userlevelpermissions_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $userlevelpermissions_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="userlevelpermissions">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$userlevelpermissions_edit->IsModal ?>">
<?php if (!$userlevelpermissions_edit->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($userlevelpermissions_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_userlevelpermissionsedit" class="table ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($userlevelpermissions->userlevelid->Visible) { // userlevelid ?>
<?php if ($userlevelpermissions_edit->IsMobileOrModal) { ?>
	<div id="r_userlevelid" class="form-group row">
		<label id="elh_userlevelpermissions_userlevelid" for="x_userlevelid" class="<?php echo $userlevelpermissions_edit->LeftColumnClass ?>"><?php echo $userlevelpermissions->userlevelid->caption() ?><?php echo ($userlevelpermissions->userlevelid->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $userlevelpermissions_edit->RightColumnClass ?>"><div<?php echo $userlevelpermissions->userlevelid->cellAttributes() ?>>
<span id="el_userlevelpermissions_userlevelid">
<span<?php echo $userlevelpermissions->userlevelid->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($userlevelpermissions->userlevelid->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="userlevelpermissions" data-field="x_userlevelid" name="x_userlevelid" id="x_userlevelid" value="<?php echo HtmlEncode($userlevelpermissions->userlevelid->CurrentValue) ?>">
<?php echo $userlevelpermissions->userlevelid->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_userlevelid">
		<td class="<?php echo $userlevelpermissions_edit->TableLeftColumnClass ?>"><span id="elh_userlevelpermissions_userlevelid"><?php echo $userlevelpermissions->userlevelid->caption() ?><?php echo ($userlevelpermissions->userlevelid->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $userlevelpermissions->userlevelid->cellAttributes() ?>>
<span id="el_userlevelpermissions_userlevelid">
<span<?php echo $userlevelpermissions->userlevelid->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($userlevelpermissions->userlevelid->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="userlevelpermissions" data-field="x_userlevelid" name="x_userlevelid" id="x_userlevelid" value="<?php echo HtmlEncode($userlevelpermissions->userlevelid->CurrentValue) ?>">
<?php echo $userlevelpermissions->userlevelid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($userlevelpermissions->_tablename->Visible) { // tablename ?>
<?php if ($userlevelpermissions_edit->IsMobileOrModal) { ?>
	<div id="r__tablename" class="form-group row">
		<label id="elh_userlevelpermissions__tablename" for="x__tablename" class="<?php echo $userlevelpermissions_edit->LeftColumnClass ?>"><?php echo $userlevelpermissions->_tablename->caption() ?><?php echo ($userlevelpermissions->_tablename->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $userlevelpermissions_edit->RightColumnClass ?>"><div<?php echo $userlevelpermissions->_tablename->cellAttributes() ?>>
<span id="el_userlevelpermissions__tablename">
<span<?php echo $userlevelpermissions->_tablename->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($userlevelpermissions->_tablename->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="userlevelpermissions" data-field="x__tablename" name="x__tablename" id="x__tablename" value="<?php echo HtmlEncode($userlevelpermissions->_tablename->CurrentValue) ?>">
<?php echo $userlevelpermissions->_tablename->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r__tablename">
		<td class="<?php echo $userlevelpermissions_edit->TableLeftColumnClass ?>"><span id="elh_userlevelpermissions__tablename"><?php echo $userlevelpermissions->_tablename->caption() ?><?php echo ($userlevelpermissions->_tablename->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $userlevelpermissions->_tablename->cellAttributes() ?>>
<span id="el_userlevelpermissions__tablename">
<span<?php echo $userlevelpermissions->_tablename->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($userlevelpermissions->_tablename->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="userlevelpermissions" data-field="x__tablename" name="x__tablename" id="x__tablename" value="<?php echo HtmlEncode($userlevelpermissions->_tablename->CurrentValue) ?>">
<?php echo $userlevelpermissions->_tablename->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($userlevelpermissions->permission->Visible) { // permission ?>
<?php if ($userlevelpermissions_edit->IsMobileOrModal) { ?>
	<div id="r_permission" class="form-group row">
		<label id="elh_userlevelpermissions_permission" for="x_permission" class="<?php echo $userlevelpermissions_edit->LeftColumnClass ?>"><?php echo $userlevelpermissions->permission->caption() ?><?php echo ($userlevelpermissions->permission->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $userlevelpermissions_edit->RightColumnClass ?>"><div<?php echo $userlevelpermissions->permission->cellAttributes() ?>>
<span id="el_userlevelpermissions_permission">
<input type="text" data-table="userlevelpermissions" data-field="x_permission" name="x_permission" id="x_permission" size="30" placeholder="<?php echo HtmlEncode($userlevelpermissions->permission->getPlaceHolder()) ?>" value="<?php echo $userlevelpermissions->permission->EditValue ?>"<?php echo $userlevelpermissions->permission->editAttributes() ?>>
</span>
<?php echo $userlevelpermissions->permission->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_permission">
		<td class="<?php echo $userlevelpermissions_edit->TableLeftColumnClass ?>"><span id="elh_userlevelpermissions_permission"><?php echo $userlevelpermissions->permission->caption() ?><?php echo ($userlevelpermissions->permission->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $userlevelpermissions->permission->cellAttributes() ?>>
<span id="el_userlevelpermissions_permission">
<input type="text" data-table="userlevelpermissions" data-field="x_permission" name="x_permission" id="x_permission" size="30" placeholder="<?php echo HtmlEncode($userlevelpermissions->permission->getPlaceHolder()) ?>" value="<?php echo $userlevelpermissions->permission->EditValue ?>"<?php echo $userlevelpermissions->permission->editAttributes() ?>>
</span>
<?php echo $userlevelpermissions->permission->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($userlevelpermissions_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$userlevelpermissions_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $userlevelpermissions_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $userlevelpermissions_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$userlevelpermissions_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
<?php if (!$userlevelpermissions_edit->IsModal) { ?>
<?php if (!isset($userlevelpermissions_edit->Pager)) $userlevelpermissions_edit->Pager = new PrevNextPager($userlevelpermissions_edit->StartRec, $userlevelpermissions_edit->DisplayRecs, $userlevelpermissions_edit->TotalRecs, $userlevelpermissions_edit->AutoHidePager) ?>
<?php if ($userlevelpermissions_edit->Pager->RecordCount > 0 && $userlevelpermissions_edit->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($userlevelpermissions_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $userlevelpermissions_edit->pageUrl() ?>start=<?php echo $userlevelpermissions_edit->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($userlevelpermissions_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $userlevelpermissions_edit->pageUrl() ?>start=<?php echo $userlevelpermissions_edit->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $userlevelpermissions_edit->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($userlevelpermissions_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $userlevelpermissions_edit->pageUrl() ?>start=<?php echo $userlevelpermissions_edit->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($userlevelpermissions_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $userlevelpermissions_edit->pageUrl() ?>start=<?php echo $userlevelpermissions_edit->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $userlevelpermissions_edit->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$userlevelpermissions_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$userlevelpermissions_edit->terminate();
?>
