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
$dji_edit = new dji_edit();

// Run the page
$dji_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$dji_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fdjiedit = currentForm = new ew.Form("fdjiedit", "edit");

// Validate form
fdjiedit.validate = function() {
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
		<?php if ($dji_edit->ID->Required) { ?>
			elm = this.getElements("x" + infix + "_ID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji->ID->caption(), $dji->ID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($dji_edit->Date->Required) { ?>
			elm = this.getElements("x" + infix + "_Date");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji->Date->caption(), $dji->Date->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Date");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($dji->Date->errorMessage()) ?>");
		<?php if ($dji_edit->Open->Required) { ?>
			elm = this.getElements("x" + infix + "_Open");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji->Open->caption(), $dji->Open->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Open");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($dji->Open->errorMessage()) ?>");
		<?php if ($dji_edit->High->Required) { ?>
			elm = this.getElements("x" + infix + "_High");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji->High->caption(), $dji->High->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_High");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($dji->High->errorMessage()) ?>");
		<?php if ($dji_edit->Low->Required) { ?>
			elm = this.getElements("x" + infix + "_Low");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji->Low->caption(), $dji->Low->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Low");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($dji->Low->errorMessage()) ?>");
		<?php if ($dji_edit->Close->Required) { ?>
			elm = this.getElements("x" + infix + "_Close");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji->Close->caption(), $dji->Close->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Close");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($dji->Close->errorMessage()) ?>");
		<?php if ($dji_edit->Volume->Required) { ?>
			elm = this.getElements("x" + infix + "_Volume");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji->Volume->caption(), $dji->Volume->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Volume");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($dji->Volume->errorMessage()) ?>");
		<?php if ($dji_edit->Adj_Close->Required) { ?>
			elm = this.getElements("x" + infix + "_Adj_Close");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji->Adj_Close->caption(), $dji->Adj_Close->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Adj_Close");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($dji->Adj_Close->errorMessage()) ?>");
		<?php if ($dji_edit->Name->Required) { ?>
			elm = this.getElements("x" + infix + "_Name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji->Name->caption(), $dji->Name->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Name");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($dji->Name->errorMessage()) ?>");
		<?php if ($dji_edit->Name2->Required) { ?>
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
fdjiedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdjiedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $dji_edit->showPageHeader(); ?>
<?php
$dji_edit->showMessage();
?>
<?php if (!$dji_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($dji_edit->Pager)) $dji_edit->Pager = new PrevNextPager($dji_edit->StartRec, $dji_edit->DisplayRecs, $dji_edit->TotalRecs, $dji_edit->AutoHidePager) ?>
<?php if ($dji_edit->Pager->RecordCount > 0 && $dji_edit->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($dji_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $dji_edit->pageUrl() ?>start=<?php echo $dji_edit->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($dji_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $dji_edit->pageUrl() ?>start=<?php echo $dji_edit->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $dji_edit->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($dji_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $dji_edit->pageUrl() ?>start=<?php echo $dji_edit->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($dji_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $dji_edit->pageUrl() ?>start=<?php echo $dji_edit->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $dji_edit->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fdjiedit" id="fdjiedit" class="<?php echo $dji_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($dji_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $dji_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="dji">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$dji_edit->IsModal ?>">
<?php if (!$dji_edit->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($dji_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_djiedit" class="table ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($dji->ID->Visible) { // ID ?>
<?php if ($dji_edit->IsMobileOrModal) { ?>
	<div id="r_ID" class="form-group row">
		<label id="elh_dji_ID" class="<?php echo $dji_edit->LeftColumnClass ?>"><?php echo $dji->ID->caption() ?><?php echo ($dji->ID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_edit->RightColumnClass ?>"><div<?php echo $dji->ID->cellAttributes() ?>>
<span id="el_dji_ID">
<span<?php echo $dji->ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($dji->ID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="dji" data-field="x_ID" name="x_ID" id="x_ID" value="<?php echo HtmlEncode($dji->ID->CurrentValue) ?>">
<?php echo $dji->ID->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ID">
		<td class="<?php echo $dji_edit->TableLeftColumnClass ?>"><span id="elh_dji_ID"><?php echo $dji->ID->caption() ?><?php echo ($dji->ID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $dji->ID->cellAttributes() ?>>
<span id="el_dji_ID">
<span<?php echo $dji->ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($dji->ID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="dji" data-field="x_ID" name="x_ID" id="x_ID" value="<?php echo HtmlEncode($dji->ID->CurrentValue) ?>">
<?php echo $dji->ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($dji->Date->Visible) { // Date ?>
<?php if ($dji_edit->IsMobileOrModal) { ?>
	<div id="r_Date" class="form-group row">
		<label id="elh_dji_Date" for="x_Date" class="<?php echo $dji_edit->LeftColumnClass ?>"><?php echo $dji->Date->caption() ?><?php echo ($dji->Date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_edit->RightColumnClass ?>"><div<?php echo $dji->Date->cellAttributes() ?>>
<span id="el_dji_Date">
<input type="text" data-table="dji" data-field="x_Date" name="x_Date" id="x_Date" placeholder="<?php echo HtmlEncode($dji->Date->getPlaceHolder()) ?>" value="<?php echo $dji->Date->EditValue ?>"<?php echo $dji->Date->editAttributes() ?>>
</span>
<?php echo $dji->Date->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Date">
		<td class="<?php echo $dji_edit->TableLeftColumnClass ?>"><span id="elh_dji_Date"><?php echo $dji->Date->caption() ?><?php echo ($dji->Date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $dji->Date->cellAttributes() ?>>
<span id="el_dji_Date">
<input type="text" data-table="dji" data-field="x_Date" name="x_Date" id="x_Date" placeholder="<?php echo HtmlEncode($dji->Date->getPlaceHolder()) ?>" value="<?php echo $dji->Date->EditValue ?>"<?php echo $dji->Date->editAttributes() ?>>
</span>
<?php echo $dji->Date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($dji->Open->Visible) { // Open ?>
<?php if ($dji_edit->IsMobileOrModal) { ?>
	<div id="r_Open" class="form-group row">
		<label id="elh_dji_Open" for="x_Open" class="<?php echo $dji_edit->LeftColumnClass ?>"><?php echo $dji->Open->caption() ?><?php echo ($dji->Open->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_edit->RightColumnClass ?>"><div<?php echo $dji->Open->cellAttributes() ?>>
<span id="el_dji_Open">
<input type="text" data-table="dji" data-field="x_Open" name="x_Open" id="x_Open" size="30" placeholder="<?php echo HtmlEncode($dji->Open->getPlaceHolder()) ?>" value="<?php echo $dji->Open->EditValue ?>"<?php echo $dji->Open->editAttributes() ?>>
</span>
<?php echo $dji->Open->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Open">
		<td class="<?php echo $dji_edit->TableLeftColumnClass ?>"><span id="elh_dji_Open"><?php echo $dji->Open->caption() ?><?php echo ($dji->Open->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $dji->Open->cellAttributes() ?>>
<span id="el_dji_Open">
<input type="text" data-table="dji" data-field="x_Open" name="x_Open" id="x_Open" size="30" placeholder="<?php echo HtmlEncode($dji->Open->getPlaceHolder()) ?>" value="<?php echo $dji->Open->EditValue ?>"<?php echo $dji->Open->editAttributes() ?>>
</span>
<?php echo $dji->Open->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($dji->High->Visible) { // High ?>
<?php if ($dji_edit->IsMobileOrModal) { ?>
	<div id="r_High" class="form-group row">
		<label id="elh_dji_High" for="x_High" class="<?php echo $dji_edit->LeftColumnClass ?>"><?php echo $dji->High->caption() ?><?php echo ($dji->High->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_edit->RightColumnClass ?>"><div<?php echo $dji->High->cellAttributes() ?>>
<span id="el_dji_High">
<input type="text" data-table="dji" data-field="x_High" name="x_High" id="x_High" size="30" placeholder="<?php echo HtmlEncode($dji->High->getPlaceHolder()) ?>" value="<?php echo $dji->High->EditValue ?>"<?php echo $dji->High->editAttributes() ?>>
</span>
<?php echo $dji->High->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_High">
		<td class="<?php echo $dji_edit->TableLeftColumnClass ?>"><span id="elh_dji_High"><?php echo $dji->High->caption() ?><?php echo ($dji->High->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $dji->High->cellAttributes() ?>>
<span id="el_dji_High">
<input type="text" data-table="dji" data-field="x_High" name="x_High" id="x_High" size="30" placeholder="<?php echo HtmlEncode($dji->High->getPlaceHolder()) ?>" value="<?php echo $dji->High->EditValue ?>"<?php echo $dji->High->editAttributes() ?>>
</span>
<?php echo $dji->High->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($dji->Low->Visible) { // Low ?>
<?php if ($dji_edit->IsMobileOrModal) { ?>
	<div id="r_Low" class="form-group row">
		<label id="elh_dji_Low" for="x_Low" class="<?php echo $dji_edit->LeftColumnClass ?>"><?php echo $dji->Low->caption() ?><?php echo ($dji->Low->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_edit->RightColumnClass ?>"><div<?php echo $dji->Low->cellAttributes() ?>>
<span id="el_dji_Low">
<input type="text" data-table="dji" data-field="x_Low" name="x_Low" id="x_Low" size="30" placeholder="<?php echo HtmlEncode($dji->Low->getPlaceHolder()) ?>" value="<?php echo $dji->Low->EditValue ?>"<?php echo $dji->Low->editAttributes() ?>>
</span>
<?php echo $dji->Low->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Low">
		<td class="<?php echo $dji_edit->TableLeftColumnClass ?>"><span id="elh_dji_Low"><?php echo $dji->Low->caption() ?><?php echo ($dji->Low->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $dji->Low->cellAttributes() ?>>
<span id="el_dji_Low">
<input type="text" data-table="dji" data-field="x_Low" name="x_Low" id="x_Low" size="30" placeholder="<?php echo HtmlEncode($dji->Low->getPlaceHolder()) ?>" value="<?php echo $dji->Low->EditValue ?>"<?php echo $dji->Low->editAttributes() ?>>
</span>
<?php echo $dji->Low->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($dji->Close->Visible) { // Close ?>
<?php if ($dji_edit->IsMobileOrModal) { ?>
	<div id="r_Close" class="form-group row">
		<label id="elh_dji_Close" for="x_Close" class="<?php echo $dji_edit->LeftColumnClass ?>"><?php echo $dji->Close->caption() ?><?php echo ($dji->Close->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_edit->RightColumnClass ?>"><div<?php echo $dji->Close->cellAttributes() ?>>
<span id="el_dji_Close">
<input type="text" data-table="dji" data-field="x_Close" name="x_Close" id="x_Close" size="30" placeholder="<?php echo HtmlEncode($dji->Close->getPlaceHolder()) ?>" value="<?php echo $dji->Close->EditValue ?>"<?php echo $dji->Close->editAttributes() ?>>
</span>
<?php echo $dji->Close->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Close">
		<td class="<?php echo $dji_edit->TableLeftColumnClass ?>"><span id="elh_dji_Close"><?php echo $dji->Close->caption() ?><?php echo ($dji->Close->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $dji->Close->cellAttributes() ?>>
<span id="el_dji_Close">
<input type="text" data-table="dji" data-field="x_Close" name="x_Close" id="x_Close" size="30" placeholder="<?php echo HtmlEncode($dji->Close->getPlaceHolder()) ?>" value="<?php echo $dji->Close->EditValue ?>"<?php echo $dji->Close->editAttributes() ?>>
</span>
<?php echo $dji->Close->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($dji->Volume->Visible) { // Volume ?>
<?php if ($dji_edit->IsMobileOrModal) { ?>
	<div id="r_Volume" class="form-group row">
		<label id="elh_dji_Volume" for="x_Volume" class="<?php echo $dji_edit->LeftColumnClass ?>"><?php echo $dji->Volume->caption() ?><?php echo ($dji->Volume->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_edit->RightColumnClass ?>"><div<?php echo $dji->Volume->cellAttributes() ?>>
<span id="el_dji_Volume">
<input type="text" data-table="dji" data-field="x_Volume" name="x_Volume" id="x_Volume" size="30" placeholder="<?php echo HtmlEncode($dji->Volume->getPlaceHolder()) ?>" value="<?php echo $dji->Volume->EditValue ?>"<?php echo $dji->Volume->editAttributes() ?>>
</span>
<?php echo $dji->Volume->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Volume">
		<td class="<?php echo $dji_edit->TableLeftColumnClass ?>"><span id="elh_dji_Volume"><?php echo $dji->Volume->caption() ?><?php echo ($dji->Volume->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $dji->Volume->cellAttributes() ?>>
<span id="el_dji_Volume">
<input type="text" data-table="dji" data-field="x_Volume" name="x_Volume" id="x_Volume" size="30" placeholder="<?php echo HtmlEncode($dji->Volume->getPlaceHolder()) ?>" value="<?php echo $dji->Volume->EditValue ?>"<?php echo $dji->Volume->editAttributes() ?>>
</span>
<?php echo $dji->Volume->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($dji->Adj_Close->Visible) { // Adj Close ?>
<?php if ($dji_edit->IsMobileOrModal) { ?>
	<div id="r_Adj_Close" class="form-group row">
		<label id="elh_dji_Adj_Close" for="x_Adj_Close" class="<?php echo $dji_edit->LeftColumnClass ?>"><?php echo $dji->Adj_Close->caption() ?><?php echo ($dji->Adj_Close->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_edit->RightColumnClass ?>"><div<?php echo $dji->Adj_Close->cellAttributes() ?>>
<span id="el_dji_Adj_Close">
<input type="text" data-table="dji" data-field="x_Adj_Close" name="x_Adj_Close" id="x_Adj_Close" size="30" placeholder="<?php echo HtmlEncode($dji->Adj_Close->getPlaceHolder()) ?>" value="<?php echo $dji->Adj_Close->EditValue ?>"<?php echo $dji->Adj_Close->editAttributes() ?>>
</span>
<?php echo $dji->Adj_Close->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Adj_Close">
		<td class="<?php echo $dji_edit->TableLeftColumnClass ?>"><span id="elh_dji_Adj_Close"><?php echo $dji->Adj_Close->caption() ?><?php echo ($dji->Adj_Close->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $dji->Adj_Close->cellAttributes() ?>>
<span id="el_dji_Adj_Close">
<input type="text" data-table="dji" data-field="x_Adj_Close" name="x_Adj_Close" id="x_Adj_Close" size="30" placeholder="<?php echo HtmlEncode($dji->Adj_Close->getPlaceHolder()) ?>" value="<?php echo $dji->Adj_Close->EditValue ?>"<?php echo $dji->Adj_Close->editAttributes() ?>>
</span>
<?php echo $dji->Adj_Close->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($dji->Name->Visible) { // Name ?>
<?php if ($dji_edit->IsMobileOrModal) { ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_dji_Name" for="x_Name" class="<?php echo $dji_edit->LeftColumnClass ?>"><?php echo $dji->Name->caption() ?><?php echo ($dji->Name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_edit->RightColumnClass ?>"><div<?php echo $dji->Name->cellAttributes() ?>>
<span id="el_dji_Name">
<input type="text" data-table="dji" data-field="x_Name" name="x_Name" id="x_Name" placeholder="<?php echo HtmlEncode($dji->Name->getPlaceHolder()) ?>" value="<?php echo $dji->Name->EditValue ?>"<?php echo $dji->Name->editAttributes() ?>>
</span>
<?php echo $dji->Name->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Name">
		<td class="<?php echo $dji_edit->TableLeftColumnClass ?>"><span id="elh_dji_Name"><?php echo $dji->Name->caption() ?><?php echo ($dji->Name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $dji->Name->cellAttributes() ?>>
<span id="el_dji_Name">
<input type="text" data-table="dji" data-field="x_Name" name="x_Name" id="x_Name" placeholder="<?php echo HtmlEncode($dji->Name->getPlaceHolder()) ?>" value="<?php echo $dji->Name->EditValue ?>"<?php echo $dji->Name->editAttributes() ?>>
</span>
<?php echo $dji->Name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($dji->Name2->Visible) { // Name2 ?>
<?php if ($dji_edit->IsMobileOrModal) { ?>
	<div id="r_Name2" class="form-group row">
		<label id="elh_dji_Name2" for="x_Name2" class="<?php echo $dji_edit->LeftColumnClass ?>"><?php echo $dji->Name2->caption() ?><?php echo ($dji->Name2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_edit->RightColumnClass ?>"><div<?php echo $dji->Name2->cellAttributes() ?>>
<span id="el_dji_Name2">
<input type="text" data-table="dji" data-field="x_Name2" name="x_Name2" id="x_Name2" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($dji->Name2->getPlaceHolder()) ?>" value="<?php echo $dji->Name2->EditValue ?>"<?php echo $dji->Name2->editAttributes() ?>>
</span>
<?php echo $dji->Name2->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Name2">
		<td class="<?php echo $dji_edit->TableLeftColumnClass ?>"><span id="elh_dji_Name2"><?php echo $dji->Name2->caption() ?><?php echo ($dji->Name2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $dji->Name2->cellAttributes() ?>>
<span id="el_dji_Name2">
<input type="text" data-table="dji" data-field="x_Name2" name="x_Name2" id="x_Name2" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($dji->Name2->getPlaceHolder()) ?>" value="<?php echo $dji->Name2->EditValue ?>"<?php echo $dji->Name2->editAttributes() ?>>
</span>
<?php echo $dji->Name2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($dji_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$dji_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $dji_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $dji_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$dji_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
<?php if (!$dji_edit->IsModal) { ?>
<?php if (!isset($dji_edit->Pager)) $dji_edit->Pager = new PrevNextPager($dji_edit->StartRec, $dji_edit->DisplayRecs, $dji_edit->TotalRecs, $dji_edit->AutoHidePager) ?>
<?php if ($dji_edit->Pager->RecordCount > 0 && $dji_edit->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($dji_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $dji_edit->pageUrl() ?>start=<?php echo $dji_edit->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($dji_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $dji_edit->pageUrl() ?>start=<?php echo $dji_edit->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $dji_edit->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($dji_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $dji_edit->pageUrl() ?>start=<?php echo $dji_edit->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($dji_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $dji_edit->pageUrl() ?>start=<?php echo $dji_edit->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $dji_edit->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$dji_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$dji_edit->terminate();
?>
