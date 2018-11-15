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
$cars_edit = new cars_edit();

// Run the page
$cars_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cars_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fcarsedit = currentForm = new ew.Form("fcarsedit", "edit");

// Validate form
fcarsedit.validate = function() {
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
		<?php if ($cars_edit->ID->Required) { ?>
			elm = this.getElements("x" + infix + "_ID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars->ID->caption(), $cars->ID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($cars_edit->Trademark->Required) { ?>
			elm = this.getElements("x" + infix + "_Trademark");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars->Trademark->caption(), $cars->Trademark->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Trademark");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($cars->Trademark->errorMessage()) ?>");
		<?php if ($cars_edit->Model->Required) { ?>
			elm = this.getElements("x" + infix + "_Model");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars->Model->caption(), $cars->Model->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Model");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($cars->Model->errorMessage()) ?>");
		<?php if ($cars_edit->HP->Required) { ?>
			elm = this.getElements("x" + infix + "_HP");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars->HP->caption(), $cars->HP->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_HP");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($cars->HP->errorMessage()) ?>");
		<?php if ($cars_edit->Liter->Required) { ?>
			elm = this.getElements("x" + infix + "_Liter");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars->Liter->caption(), $cars->Liter->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Liter");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($cars->Liter->errorMessage()) ?>");
		<?php if ($cars_edit->Cyl->Required) { ?>
			elm = this.getElements("x" + infix + "_Cyl");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars->Cyl->caption(), $cars->Cyl->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Cyl");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($cars->Cyl->errorMessage()) ?>");
		<?php if ($cars_edit->TransmissSpeedCount->Required) { ?>
			elm = this.getElements("x" + infix + "_TransmissSpeedCount");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars->TransmissSpeedCount->caption(), $cars->TransmissSpeedCount->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_TransmissSpeedCount");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($cars->TransmissSpeedCount->errorMessage()) ?>");
		<?php if ($cars_edit->TransmissAutomatic->Required) { ?>
			elm = this.getElements("x" + infix + "_TransmissAutomatic");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars->TransmissAutomatic->caption(), $cars->TransmissAutomatic->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($cars_edit->MPG_City->Required) { ?>
			elm = this.getElements("x" + infix + "_MPG_City");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars->MPG_City->caption(), $cars->MPG_City->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_MPG_City");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($cars->MPG_City->errorMessage()) ?>");
		<?php if ($cars_edit->MPG_Highway->Required) { ?>
			elm = this.getElements("x" + infix + "_MPG_Highway");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars->MPG_Highway->caption(), $cars->MPG_Highway->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_MPG_Highway");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($cars->MPG_Highway->errorMessage()) ?>");
		<?php if ($cars_edit->Category->Required) { ?>
			elm = this.getElements("x" + infix + "_Category");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars->Category->caption(), $cars->Category->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($cars_edit->Description->Required) { ?>
			elm = this.getElements("x" + infix + "_Description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars->Description->caption(), $cars->Description->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($cars_edit->Hyperlink->Required) { ?>
			elm = this.getElements("x" + infix + "_Hyperlink");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars->Hyperlink->caption(), $cars->Hyperlink->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($cars_edit->Price->Required) { ?>
			elm = this.getElements("x" + infix + "_Price");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars->Price->caption(), $cars->Price->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Price");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($cars->Price->errorMessage()) ?>");
		<?php if ($cars_edit->Picture->Required) { ?>
			felm = this.getElements("x" + infix + "_Picture");
			elm = this.getElements("fn_x" + infix + "_Picture");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $cars->Picture->caption(), $cars->Picture->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($cars_edit->PictureName->Required) { ?>
			elm = this.getElements("x" + infix + "_PictureName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars->PictureName->caption(), $cars->PictureName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($cars_edit->PictureSize->Required) { ?>
			elm = this.getElements("x" + infix + "_PictureSize");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars->PictureSize->caption(), $cars->PictureSize->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PictureSize");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($cars->PictureSize->errorMessage()) ?>");
		<?php if ($cars_edit->PictureType->Required) { ?>
			elm = this.getElements("x" + infix + "_PictureType");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars->PictureType->caption(), $cars->PictureType->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($cars_edit->PictureWidth->Required) { ?>
			elm = this.getElements("x" + infix + "_PictureWidth");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars->PictureWidth->caption(), $cars->PictureWidth->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PictureWidth");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($cars->PictureWidth->errorMessage()) ?>");
		<?php if ($cars_edit->PictureHeight->Required) { ?>
			elm = this.getElements("x" + infix + "_PictureHeight");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars->PictureHeight->caption(), $cars->PictureHeight->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PictureHeight");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($cars->PictureHeight->errorMessage()) ?>");
		<?php if ($cars_edit->Color->Required) { ?>
			elm = this.getElements("x" + infix + "_Color");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars->Color->caption(), $cars->Color->RequiredErrorMessage)) ?>");
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
fcarsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcarsedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $cars_edit->showPageHeader(); ?>
<?php
$cars_edit->showMessage();
?>
<?php if (!$cars_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($cars_edit->Pager)) $cars_edit->Pager = new PrevNextPager($cars_edit->StartRec, $cars_edit->DisplayRecs, $cars_edit->TotalRecs, $cars_edit->AutoHidePager) ?>
<?php if ($cars_edit->Pager->RecordCount > 0 && $cars_edit->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($cars_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $cars_edit->pageUrl() ?>start=<?php echo $cars_edit->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($cars_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $cars_edit->pageUrl() ?>start=<?php echo $cars_edit->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $cars_edit->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($cars_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $cars_edit->pageUrl() ?>start=<?php echo $cars_edit->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($cars_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $cars_edit->pageUrl() ?>start=<?php echo $cars_edit->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $cars_edit->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fcarsedit" id="fcarsedit" class="<?php echo $cars_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cars_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cars_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cars">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$cars_edit->IsModal ?>">
<?php if (!$cars_edit->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($cars_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_carsedit" class="table ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($cars->ID->Visible) { // ID ?>
<?php if ($cars_edit->IsMobileOrModal) { ?>
	<div id="r_ID" class="form-group row">
		<label id="elh_cars_ID" class="<?php echo $cars_edit->LeftColumnClass ?>"><?php echo $cars->ID->caption() ?><?php echo ($cars->ID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_edit->RightColumnClass ?>"><div<?php echo $cars->ID->cellAttributes() ?>>
<span id="el_cars_ID">
<span<?php echo $cars->ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($cars->ID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="cars" data-field="x_ID" name="x_ID" id="x_ID" value="<?php echo HtmlEncode($cars->ID->CurrentValue) ?>">
<?php echo $cars->ID->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ID">
		<td class="<?php echo $cars_edit->TableLeftColumnClass ?>"><span id="elh_cars_ID"><?php echo $cars->ID->caption() ?><?php echo ($cars->ID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $cars->ID->cellAttributes() ?>>
<span id="el_cars_ID">
<span<?php echo $cars->ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($cars->ID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="cars" data-field="x_ID" name="x_ID" id="x_ID" value="<?php echo HtmlEncode($cars->ID->CurrentValue) ?>">
<?php echo $cars->ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($cars->Trademark->Visible) { // Trademark ?>
<?php if ($cars_edit->IsMobileOrModal) { ?>
	<div id="r_Trademark" class="form-group row">
		<label id="elh_cars_Trademark" for="x_Trademark" class="<?php echo $cars_edit->LeftColumnClass ?>"><?php echo $cars->Trademark->caption() ?><?php echo ($cars->Trademark->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_edit->RightColumnClass ?>"><div<?php echo $cars->Trademark->cellAttributes() ?>>
<span id="el_cars_Trademark">
<input type="text" data-table="cars" data-field="x_Trademark" name="x_Trademark" id="x_Trademark" size="30" placeholder="<?php echo HtmlEncode($cars->Trademark->getPlaceHolder()) ?>" value="<?php echo $cars->Trademark->EditValue ?>"<?php echo $cars->Trademark->editAttributes() ?>>
</span>
<?php echo $cars->Trademark->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Trademark">
		<td class="<?php echo $cars_edit->TableLeftColumnClass ?>"><span id="elh_cars_Trademark"><?php echo $cars->Trademark->caption() ?><?php echo ($cars->Trademark->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $cars->Trademark->cellAttributes() ?>>
<span id="el_cars_Trademark">
<input type="text" data-table="cars" data-field="x_Trademark" name="x_Trademark" id="x_Trademark" size="30" placeholder="<?php echo HtmlEncode($cars->Trademark->getPlaceHolder()) ?>" value="<?php echo $cars->Trademark->EditValue ?>"<?php echo $cars->Trademark->editAttributes() ?>>
</span>
<?php echo $cars->Trademark->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($cars->Model->Visible) { // Model ?>
<?php if ($cars_edit->IsMobileOrModal) { ?>
	<div id="r_Model" class="form-group row">
		<label id="elh_cars_Model" for="x_Model" class="<?php echo $cars_edit->LeftColumnClass ?>"><?php echo $cars->Model->caption() ?><?php echo ($cars->Model->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_edit->RightColumnClass ?>"><div<?php echo $cars->Model->cellAttributes() ?>>
<span id="el_cars_Model">
<input type="text" data-table="cars" data-field="x_Model" name="x_Model" id="x_Model" size="30" placeholder="<?php echo HtmlEncode($cars->Model->getPlaceHolder()) ?>" value="<?php echo $cars->Model->EditValue ?>"<?php echo $cars->Model->editAttributes() ?>>
</span>
<?php echo $cars->Model->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Model">
		<td class="<?php echo $cars_edit->TableLeftColumnClass ?>"><span id="elh_cars_Model"><?php echo $cars->Model->caption() ?><?php echo ($cars->Model->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $cars->Model->cellAttributes() ?>>
<span id="el_cars_Model">
<input type="text" data-table="cars" data-field="x_Model" name="x_Model" id="x_Model" size="30" placeholder="<?php echo HtmlEncode($cars->Model->getPlaceHolder()) ?>" value="<?php echo $cars->Model->EditValue ?>"<?php echo $cars->Model->editAttributes() ?>>
</span>
<?php echo $cars->Model->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($cars->HP->Visible) { // HP ?>
<?php if ($cars_edit->IsMobileOrModal) { ?>
	<div id="r_HP" class="form-group row">
		<label id="elh_cars_HP" for="x_HP" class="<?php echo $cars_edit->LeftColumnClass ?>"><?php echo $cars->HP->caption() ?><?php echo ($cars->HP->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_edit->RightColumnClass ?>"><div<?php echo $cars->HP->cellAttributes() ?>>
<span id="el_cars_HP">
<input type="text" data-table="cars" data-field="x_HP" name="x_HP" id="x_HP" size="30" placeholder="<?php echo HtmlEncode($cars->HP->getPlaceHolder()) ?>" value="<?php echo $cars->HP->EditValue ?>"<?php echo $cars->HP->editAttributes() ?>>
</span>
<?php echo $cars->HP->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_HP">
		<td class="<?php echo $cars_edit->TableLeftColumnClass ?>"><span id="elh_cars_HP"><?php echo $cars->HP->caption() ?><?php echo ($cars->HP->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $cars->HP->cellAttributes() ?>>
<span id="el_cars_HP">
<input type="text" data-table="cars" data-field="x_HP" name="x_HP" id="x_HP" size="30" placeholder="<?php echo HtmlEncode($cars->HP->getPlaceHolder()) ?>" value="<?php echo $cars->HP->EditValue ?>"<?php echo $cars->HP->editAttributes() ?>>
</span>
<?php echo $cars->HP->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($cars->Liter->Visible) { // Liter ?>
<?php if ($cars_edit->IsMobileOrModal) { ?>
	<div id="r_Liter" class="form-group row">
		<label id="elh_cars_Liter" for="x_Liter" class="<?php echo $cars_edit->LeftColumnClass ?>"><?php echo $cars->Liter->caption() ?><?php echo ($cars->Liter->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_edit->RightColumnClass ?>"><div<?php echo $cars->Liter->cellAttributes() ?>>
<span id="el_cars_Liter">
<input type="text" data-table="cars" data-field="x_Liter" name="x_Liter" id="x_Liter" size="30" placeholder="<?php echo HtmlEncode($cars->Liter->getPlaceHolder()) ?>" value="<?php echo $cars->Liter->EditValue ?>"<?php echo $cars->Liter->editAttributes() ?>>
</span>
<?php echo $cars->Liter->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Liter">
		<td class="<?php echo $cars_edit->TableLeftColumnClass ?>"><span id="elh_cars_Liter"><?php echo $cars->Liter->caption() ?><?php echo ($cars->Liter->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $cars->Liter->cellAttributes() ?>>
<span id="el_cars_Liter">
<input type="text" data-table="cars" data-field="x_Liter" name="x_Liter" id="x_Liter" size="30" placeholder="<?php echo HtmlEncode($cars->Liter->getPlaceHolder()) ?>" value="<?php echo $cars->Liter->EditValue ?>"<?php echo $cars->Liter->editAttributes() ?>>
</span>
<?php echo $cars->Liter->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($cars->Cyl->Visible) { // Cyl ?>
<?php if ($cars_edit->IsMobileOrModal) { ?>
	<div id="r_Cyl" class="form-group row">
		<label id="elh_cars_Cyl" for="x_Cyl" class="<?php echo $cars_edit->LeftColumnClass ?>"><?php echo $cars->Cyl->caption() ?><?php echo ($cars->Cyl->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_edit->RightColumnClass ?>"><div<?php echo $cars->Cyl->cellAttributes() ?>>
<span id="el_cars_Cyl">
<input type="text" data-table="cars" data-field="x_Cyl" name="x_Cyl" id="x_Cyl" size="30" placeholder="<?php echo HtmlEncode($cars->Cyl->getPlaceHolder()) ?>" value="<?php echo $cars->Cyl->EditValue ?>"<?php echo $cars->Cyl->editAttributes() ?>>
</span>
<?php echo $cars->Cyl->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Cyl">
		<td class="<?php echo $cars_edit->TableLeftColumnClass ?>"><span id="elh_cars_Cyl"><?php echo $cars->Cyl->caption() ?><?php echo ($cars->Cyl->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $cars->Cyl->cellAttributes() ?>>
<span id="el_cars_Cyl">
<input type="text" data-table="cars" data-field="x_Cyl" name="x_Cyl" id="x_Cyl" size="30" placeholder="<?php echo HtmlEncode($cars->Cyl->getPlaceHolder()) ?>" value="<?php echo $cars->Cyl->EditValue ?>"<?php echo $cars->Cyl->editAttributes() ?>>
</span>
<?php echo $cars->Cyl->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($cars->TransmissSpeedCount->Visible) { // TransmissSpeedCount ?>
<?php if ($cars_edit->IsMobileOrModal) { ?>
	<div id="r_TransmissSpeedCount" class="form-group row">
		<label id="elh_cars_TransmissSpeedCount" for="x_TransmissSpeedCount" class="<?php echo $cars_edit->LeftColumnClass ?>"><?php echo $cars->TransmissSpeedCount->caption() ?><?php echo ($cars->TransmissSpeedCount->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_edit->RightColumnClass ?>"><div<?php echo $cars->TransmissSpeedCount->cellAttributes() ?>>
<span id="el_cars_TransmissSpeedCount">
<input type="text" data-table="cars" data-field="x_TransmissSpeedCount" name="x_TransmissSpeedCount" id="x_TransmissSpeedCount" size="30" placeholder="<?php echo HtmlEncode($cars->TransmissSpeedCount->getPlaceHolder()) ?>" value="<?php echo $cars->TransmissSpeedCount->EditValue ?>"<?php echo $cars->TransmissSpeedCount->editAttributes() ?>>
</span>
<?php echo $cars->TransmissSpeedCount->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_TransmissSpeedCount">
		<td class="<?php echo $cars_edit->TableLeftColumnClass ?>"><span id="elh_cars_TransmissSpeedCount"><?php echo $cars->TransmissSpeedCount->caption() ?><?php echo ($cars->TransmissSpeedCount->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $cars->TransmissSpeedCount->cellAttributes() ?>>
<span id="el_cars_TransmissSpeedCount">
<input type="text" data-table="cars" data-field="x_TransmissSpeedCount" name="x_TransmissSpeedCount" id="x_TransmissSpeedCount" size="30" placeholder="<?php echo HtmlEncode($cars->TransmissSpeedCount->getPlaceHolder()) ?>" value="<?php echo $cars->TransmissSpeedCount->EditValue ?>"<?php echo $cars->TransmissSpeedCount->editAttributes() ?>>
</span>
<?php echo $cars->TransmissSpeedCount->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($cars->TransmissAutomatic->Visible) { // TransmissAutomatic ?>
<?php if ($cars_edit->IsMobileOrModal) { ?>
	<div id="r_TransmissAutomatic" class="form-group row">
		<label id="elh_cars_TransmissAutomatic" for="x_TransmissAutomatic" class="<?php echo $cars_edit->LeftColumnClass ?>"><?php echo $cars->TransmissAutomatic->caption() ?><?php echo ($cars->TransmissAutomatic->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_edit->RightColumnClass ?>"><div<?php echo $cars->TransmissAutomatic->cellAttributes() ?>>
<span id="el_cars_TransmissAutomatic">
<input type="text" data-table="cars" data-field="x_TransmissAutomatic" name="x_TransmissAutomatic" id="x_TransmissAutomatic" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($cars->TransmissAutomatic->getPlaceHolder()) ?>" value="<?php echo $cars->TransmissAutomatic->EditValue ?>"<?php echo $cars->TransmissAutomatic->editAttributes() ?>>
</span>
<?php echo $cars->TransmissAutomatic->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_TransmissAutomatic">
		<td class="<?php echo $cars_edit->TableLeftColumnClass ?>"><span id="elh_cars_TransmissAutomatic"><?php echo $cars->TransmissAutomatic->caption() ?><?php echo ($cars->TransmissAutomatic->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $cars->TransmissAutomatic->cellAttributes() ?>>
<span id="el_cars_TransmissAutomatic">
<input type="text" data-table="cars" data-field="x_TransmissAutomatic" name="x_TransmissAutomatic" id="x_TransmissAutomatic" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($cars->TransmissAutomatic->getPlaceHolder()) ?>" value="<?php echo $cars->TransmissAutomatic->EditValue ?>"<?php echo $cars->TransmissAutomatic->editAttributes() ?>>
</span>
<?php echo $cars->TransmissAutomatic->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($cars->MPG_City->Visible) { // MPG_City ?>
<?php if ($cars_edit->IsMobileOrModal) { ?>
	<div id="r_MPG_City" class="form-group row">
		<label id="elh_cars_MPG_City" for="x_MPG_City" class="<?php echo $cars_edit->LeftColumnClass ?>"><?php echo $cars->MPG_City->caption() ?><?php echo ($cars->MPG_City->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_edit->RightColumnClass ?>"><div<?php echo $cars->MPG_City->cellAttributes() ?>>
<span id="el_cars_MPG_City">
<input type="text" data-table="cars" data-field="x_MPG_City" name="x_MPG_City" id="x_MPG_City" size="30" placeholder="<?php echo HtmlEncode($cars->MPG_City->getPlaceHolder()) ?>" value="<?php echo $cars->MPG_City->EditValue ?>"<?php echo $cars->MPG_City->editAttributes() ?>>
</span>
<?php echo $cars->MPG_City->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_MPG_City">
		<td class="<?php echo $cars_edit->TableLeftColumnClass ?>"><span id="elh_cars_MPG_City"><?php echo $cars->MPG_City->caption() ?><?php echo ($cars->MPG_City->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $cars->MPG_City->cellAttributes() ?>>
<span id="el_cars_MPG_City">
<input type="text" data-table="cars" data-field="x_MPG_City" name="x_MPG_City" id="x_MPG_City" size="30" placeholder="<?php echo HtmlEncode($cars->MPG_City->getPlaceHolder()) ?>" value="<?php echo $cars->MPG_City->EditValue ?>"<?php echo $cars->MPG_City->editAttributes() ?>>
</span>
<?php echo $cars->MPG_City->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($cars->MPG_Highway->Visible) { // MPG_Highway ?>
<?php if ($cars_edit->IsMobileOrModal) { ?>
	<div id="r_MPG_Highway" class="form-group row">
		<label id="elh_cars_MPG_Highway" for="x_MPG_Highway" class="<?php echo $cars_edit->LeftColumnClass ?>"><?php echo $cars->MPG_Highway->caption() ?><?php echo ($cars->MPG_Highway->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_edit->RightColumnClass ?>"><div<?php echo $cars->MPG_Highway->cellAttributes() ?>>
<span id="el_cars_MPG_Highway">
<input type="text" data-table="cars" data-field="x_MPG_Highway" name="x_MPG_Highway" id="x_MPG_Highway" size="30" placeholder="<?php echo HtmlEncode($cars->MPG_Highway->getPlaceHolder()) ?>" value="<?php echo $cars->MPG_Highway->EditValue ?>"<?php echo $cars->MPG_Highway->editAttributes() ?>>
</span>
<?php echo $cars->MPG_Highway->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_MPG_Highway">
		<td class="<?php echo $cars_edit->TableLeftColumnClass ?>"><span id="elh_cars_MPG_Highway"><?php echo $cars->MPG_Highway->caption() ?><?php echo ($cars->MPG_Highway->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $cars->MPG_Highway->cellAttributes() ?>>
<span id="el_cars_MPG_Highway">
<input type="text" data-table="cars" data-field="x_MPG_Highway" name="x_MPG_Highway" id="x_MPG_Highway" size="30" placeholder="<?php echo HtmlEncode($cars->MPG_Highway->getPlaceHolder()) ?>" value="<?php echo $cars->MPG_Highway->EditValue ?>"<?php echo $cars->MPG_Highway->editAttributes() ?>>
</span>
<?php echo $cars->MPG_Highway->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($cars->Category->Visible) { // Category ?>
<?php if ($cars_edit->IsMobileOrModal) { ?>
	<div id="r_Category" class="form-group row">
		<label id="elh_cars_Category" for="x_Category" class="<?php echo $cars_edit->LeftColumnClass ?>"><?php echo $cars->Category->caption() ?><?php echo ($cars->Category->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_edit->RightColumnClass ?>"><div<?php echo $cars->Category->cellAttributes() ?>>
<span id="el_cars_Category">
<input type="text" data-table="cars" data-field="x_Category" name="x_Category" id="x_Category" size="30" maxlength="7" placeholder="<?php echo HtmlEncode($cars->Category->getPlaceHolder()) ?>" value="<?php echo $cars->Category->EditValue ?>"<?php echo $cars->Category->editAttributes() ?>>
</span>
<?php echo $cars->Category->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Category">
		<td class="<?php echo $cars_edit->TableLeftColumnClass ?>"><span id="elh_cars_Category"><?php echo $cars->Category->caption() ?><?php echo ($cars->Category->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $cars->Category->cellAttributes() ?>>
<span id="el_cars_Category">
<input type="text" data-table="cars" data-field="x_Category" name="x_Category" id="x_Category" size="30" maxlength="7" placeholder="<?php echo HtmlEncode($cars->Category->getPlaceHolder()) ?>" value="<?php echo $cars->Category->EditValue ?>"<?php echo $cars->Category->editAttributes() ?>>
</span>
<?php echo $cars->Category->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($cars->Description->Visible) { // Description ?>
<?php if ($cars_edit->IsMobileOrModal) { ?>
	<div id="r_Description" class="form-group row">
		<label id="elh_cars_Description" for="x_Description" class="<?php echo $cars_edit->LeftColumnClass ?>"><?php echo $cars->Description->caption() ?><?php echo ($cars->Description->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_edit->RightColumnClass ?>"><div<?php echo $cars->Description->cellAttributes() ?>>
<span id="el_cars_Description">
<textarea data-table="cars" data-field="x_Description" name="x_Description" id="x_Description" cols="35" rows="4" placeholder="<?php echo HtmlEncode($cars->Description->getPlaceHolder()) ?>"<?php echo $cars->Description->editAttributes() ?>><?php echo $cars->Description->EditValue ?></textarea>
</span>
<?php echo $cars->Description->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Description">
		<td class="<?php echo $cars_edit->TableLeftColumnClass ?>"><span id="elh_cars_Description"><?php echo $cars->Description->caption() ?><?php echo ($cars->Description->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $cars->Description->cellAttributes() ?>>
<span id="el_cars_Description">
<textarea data-table="cars" data-field="x_Description" name="x_Description" id="x_Description" cols="35" rows="4" placeholder="<?php echo HtmlEncode($cars->Description->getPlaceHolder()) ?>"<?php echo $cars->Description->editAttributes() ?>><?php echo $cars->Description->EditValue ?></textarea>
</span>
<?php echo $cars->Description->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($cars->Hyperlink->Visible) { // Hyperlink ?>
<?php if ($cars_edit->IsMobileOrModal) { ?>
	<div id="r_Hyperlink" class="form-group row">
		<label id="elh_cars_Hyperlink" for="x_Hyperlink" class="<?php echo $cars_edit->LeftColumnClass ?>"><?php echo $cars->Hyperlink->caption() ?><?php echo ($cars->Hyperlink->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_edit->RightColumnClass ?>"><div<?php echo $cars->Hyperlink->cellAttributes() ?>>
<span id="el_cars_Hyperlink">
<input type="text" data-table="cars" data-field="x_Hyperlink" name="x_Hyperlink" id="x_Hyperlink" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($cars->Hyperlink->getPlaceHolder()) ?>" value="<?php echo $cars->Hyperlink->EditValue ?>"<?php echo $cars->Hyperlink->editAttributes() ?>>
</span>
<?php echo $cars->Hyperlink->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Hyperlink">
		<td class="<?php echo $cars_edit->TableLeftColumnClass ?>"><span id="elh_cars_Hyperlink"><?php echo $cars->Hyperlink->caption() ?><?php echo ($cars->Hyperlink->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $cars->Hyperlink->cellAttributes() ?>>
<span id="el_cars_Hyperlink">
<input type="text" data-table="cars" data-field="x_Hyperlink" name="x_Hyperlink" id="x_Hyperlink" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($cars->Hyperlink->getPlaceHolder()) ?>" value="<?php echo $cars->Hyperlink->EditValue ?>"<?php echo $cars->Hyperlink->editAttributes() ?>>
</span>
<?php echo $cars->Hyperlink->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($cars->Price->Visible) { // Price ?>
<?php if ($cars_edit->IsMobileOrModal) { ?>
	<div id="r_Price" class="form-group row">
		<label id="elh_cars_Price" for="x_Price" class="<?php echo $cars_edit->LeftColumnClass ?>"><?php echo $cars->Price->caption() ?><?php echo ($cars->Price->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_edit->RightColumnClass ?>"><div<?php echo $cars->Price->cellAttributes() ?>>
<span id="el_cars_Price">
<input type="text" data-table="cars" data-field="x_Price" name="x_Price" id="x_Price" size="30" placeholder="<?php echo HtmlEncode($cars->Price->getPlaceHolder()) ?>" value="<?php echo $cars->Price->EditValue ?>"<?php echo $cars->Price->editAttributes() ?>>
</span>
<?php echo $cars->Price->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Price">
		<td class="<?php echo $cars_edit->TableLeftColumnClass ?>"><span id="elh_cars_Price"><?php echo $cars->Price->caption() ?><?php echo ($cars->Price->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $cars->Price->cellAttributes() ?>>
<span id="el_cars_Price">
<input type="text" data-table="cars" data-field="x_Price" name="x_Price" id="x_Price" size="30" placeholder="<?php echo HtmlEncode($cars->Price->getPlaceHolder()) ?>" value="<?php echo $cars->Price->EditValue ?>"<?php echo $cars->Price->editAttributes() ?>>
</span>
<?php echo $cars->Price->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($cars->Picture->Visible) { // Picture ?>
<?php if ($cars_edit->IsMobileOrModal) { ?>
	<div id="r_Picture" class="form-group row">
		<label id="elh_cars_Picture" class="<?php echo $cars_edit->LeftColumnClass ?>"><?php echo $cars->Picture->caption() ?><?php echo ($cars->Picture->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_edit->RightColumnClass ?>"><div<?php echo $cars->Picture->cellAttributes() ?>>
<span id="el_cars_Picture">
<div id="fd_x_Picture">
<span title="<?php echo $cars->Picture->title() ? $cars->Picture->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($cars->Picture->ReadOnly || $cars->Picture->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="cars" data-field="x_Picture" name="x_Picture" id="x_Picture"<?php echo $cars->Picture->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_Picture" id= "fn_x_Picture" value="<?php echo $cars->Picture->Upload->FileName ?>">
<?php if (Post("fa_x_Picture") == "0") { ?>
<input type="hidden" name="fa_x_Picture" id= "fa_x_Picture" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_Picture" id= "fa_x_Picture" value="1">
<?php } ?>
<input type="hidden" name="fs_x_Picture" id= "fs_x_Picture" value="0">
<input type="hidden" name="fx_x_Picture" id= "fx_x_Picture" value="<?php echo $cars->Picture->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Picture" id= "fm_x_Picture" value="<?php echo $cars->Picture->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Picture" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $cars->Picture->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Picture">
		<td class="<?php echo $cars_edit->TableLeftColumnClass ?>"><span id="elh_cars_Picture"><?php echo $cars->Picture->caption() ?><?php echo ($cars->Picture->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $cars->Picture->cellAttributes() ?>>
<span id="el_cars_Picture">
<div id="fd_x_Picture">
<span title="<?php echo $cars->Picture->title() ? $cars->Picture->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($cars->Picture->ReadOnly || $cars->Picture->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="cars" data-field="x_Picture" name="x_Picture" id="x_Picture"<?php echo $cars->Picture->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_Picture" id= "fn_x_Picture" value="<?php echo $cars->Picture->Upload->FileName ?>">
<?php if (Post("fa_x_Picture") == "0") { ?>
<input type="hidden" name="fa_x_Picture" id= "fa_x_Picture" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_Picture" id= "fa_x_Picture" value="1">
<?php } ?>
<input type="hidden" name="fs_x_Picture" id= "fs_x_Picture" value="0">
<input type="hidden" name="fx_x_Picture" id= "fx_x_Picture" value="<?php echo $cars->Picture->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Picture" id= "fm_x_Picture" value="<?php echo $cars->Picture->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Picture" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $cars->Picture->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($cars->PictureName->Visible) { // PictureName ?>
<?php if ($cars_edit->IsMobileOrModal) { ?>
	<div id="r_PictureName" class="form-group row">
		<label id="elh_cars_PictureName" for="x_PictureName" class="<?php echo $cars_edit->LeftColumnClass ?>"><?php echo $cars->PictureName->caption() ?><?php echo ($cars->PictureName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_edit->RightColumnClass ?>"><div<?php echo $cars->PictureName->cellAttributes() ?>>
<span id="el_cars_PictureName">
<input type="text" data-table="cars" data-field="x_PictureName" name="x_PictureName" id="x_PictureName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($cars->PictureName->getPlaceHolder()) ?>" value="<?php echo $cars->PictureName->EditValue ?>"<?php echo $cars->PictureName->editAttributes() ?>>
</span>
<?php echo $cars->PictureName->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_PictureName">
		<td class="<?php echo $cars_edit->TableLeftColumnClass ?>"><span id="elh_cars_PictureName"><?php echo $cars->PictureName->caption() ?><?php echo ($cars->PictureName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $cars->PictureName->cellAttributes() ?>>
<span id="el_cars_PictureName">
<input type="text" data-table="cars" data-field="x_PictureName" name="x_PictureName" id="x_PictureName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($cars->PictureName->getPlaceHolder()) ?>" value="<?php echo $cars->PictureName->EditValue ?>"<?php echo $cars->PictureName->editAttributes() ?>>
</span>
<?php echo $cars->PictureName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($cars->PictureSize->Visible) { // PictureSize ?>
<?php if ($cars_edit->IsMobileOrModal) { ?>
	<div id="r_PictureSize" class="form-group row">
		<label id="elh_cars_PictureSize" for="x_PictureSize" class="<?php echo $cars_edit->LeftColumnClass ?>"><?php echo $cars->PictureSize->caption() ?><?php echo ($cars->PictureSize->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_edit->RightColumnClass ?>"><div<?php echo $cars->PictureSize->cellAttributes() ?>>
<span id="el_cars_PictureSize">
<input type="text" data-table="cars" data-field="x_PictureSize" name="x_PictureSize" id="x_PictureSize" size="30" placeholder="<?php echo HtmlEncode($cars->PictureSize->getPlaceHolder()) ?>" value="<?php echo $cars->PictureSize->EditValue ?>"<?php echo $cars->PictureSize->editAttributes() ?>>
</span>
<?php echo $cars->PictureSize->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_PictureSize">
		<td class="<?php echo $cars_edit->TableLeftColumnClass ?>"><span id="elh_cars_PictureSize"><?php echo $cars->PictureSize->caption() ?><?php echo ($cars->PictureSize->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $cars->PictureSize->cellAttributes() ?>>
<span id="el_cars_PictureSize">
<input type="text" data-table="cars" data-field="x_PictureSize" name="x_PictureSize" id="x_PictureSize" size="30" placeholder="<?php echo HtmlEncode($cars->PictureSize->getPlaceHolder()) ?>" value="<?php echo $cars->PictureSize->EditValue ?>"<?php echo $cars->PictureSize->editAttributes() ?>>
</span>
<?php echo $cars->PictureSize->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($cars->PictureType->Visible) { // PictureType ?>
<?php if ($cars_edit->IsMobileOrModal) { ?>
	<div id="r_PictureType" class="form-group row">
		<label id="elh_cars_PictureType" for="x_PictureType" class="<?php echo $cars_edit->LeftColumnClass ?>"><?php echo $cars->PictureType->caption() ?><?php echo ($cars->PictureType->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_edit->RightColumnClass ?>"><div<?php echo $cars->PictureType->cellAttributes() ?>>
<span id="el_cars_PictureType">
<input type="text" data-table="cars" data-field="x_PictureType" name="x_PictureType" id="x_PictureType" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($cars->PictureType->getPlaceHolder()) ?>" value="<?php echo $cars->PictureType->EditValue ?>"<?php echo $cars->PictureType->editAttributes() ?>>
</span>
<?php echo $cars->PictureType->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_PictureType">
		<td class="<?php echo $cars_edit->TableLeftColumnClass ?>"><span id="elh_cars_PictureType"><?php echo $cars->PictureType->caption() ?><?php echo ($cars->PictureType->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $cars->PictureType->cellAttributes() ?>>
<span id="el_cars_PictureType">
<input type="text" data-table="cars" data-field="x_PictureType" name="x_PictureType" id="x_PictureType" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($cars->PictureType->getPlaceHolder()) ?>" value="<?php echo $cars->PictureType->EditValue ?>"<?php echo $cars->PictureType->editAttributes() ?>>
</span>
<?php echo $cars->PictureType->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($cars->PictureWidth->Visible) { // PictureWidth ?>
<?php if ($cars_edit->IsMobileOrModal) { ?>
	<div id="r_PictureWidth" class="form-group row">
		<label id="elh_cars_PictureWidth" for="x_PictureWidth" class="<?php echo $cars_edit->LeftColumnClass ?>"><?php echo $cars->PictureWidth->caption() ?><?php echo ($cars->PictureWidth->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_edit->RightColumnClass ?>"><div<?php echo $cars->PictureWidth->cellAttributes() ?>>
<span id="el_cars_PictureWidth">
<input type="text" data-table="cars" data-field="x_PictureWidth" name="x_PictureWidth" id="x_PictureWidth" size="30" placeholder="<?php echo HtmlEncode($cars->PictureWidth->getPlaceHolder()) ?>" value="<?php echo $cars->PictureWidth->EditValue ?>"<?php echo $cars->PictureWidth->editAttributes() ?>>
</span>
<?php echo $cars->PictureWidth->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_PictureWidth">
		<td class="<?php echo $cars_edit->TableLeftColumnClass ?>"><span id="elh_cars_PictureWidth"><?php echo $cars->PictureWidth->caption() ?><?php echo ($cars->PictureWidth->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $cars->PictureWidth->cellAttributes() ?>>
<span id="el_cars_PictureWidth">
<input type="text" data-table="cars" data-field="x_PictureWidth" name="x_PictureWidth" id="x_PictureWidth" size="30" placeholder="<?php echo HtmlEncode($cars->PictureWidth->getPlaceHolder()) ?>" value="<?php echo $cars->PictureWidth->EditValue ?>"<?php echo $cars->PictureWidth->editAttributes() ?>>
</span>
<?php echo $cars->PictureWidth->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($cars->PictureHeight->Visible) { // PictureHeight ?>
<?php if ($cars_edit->IsMobileOrModal) { ?>
	<div id="r_PictureHeight" class="form-group row">
		<label id="elh_cars_PictureHeight" for="x_PictureHeight" class="<?php echo $cars_edit->LeftColumnClass ?>"><?php echo $cars->PictureHeight->caption() ?><?php echo ($cars->PictureHeight->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_edit->RightColumnClass ?>"><div<?php echo $cars->PictureHeight->cellAttributes() ?>>
<span id="el_cars_PictureHeight">
<input type="text" data-table="cars" data-field="x_PictureHeight" name="x_PictureHeight" id="x_PictureHeight" size="30" placeholder="<?php echo HtmlEncode($cars->PictureHeight->getPlaceHolder()) ?>" value="<?php echo $cars->PictureHeight->EditValue ?>"<?php echo $cars->PictureHeight->editAttributes() ?>>
</span>
<?php echo $cars->PictureHeight->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_PictureHeight">
		<td class="<?php echo $cars_edit->TableLeftColumnClass ?>"><span id="elh_cars_PictureHeight"><?php echo $cars->PictureHeight->caption() ?><?php echo ($cars->PictureHeight->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $cars->PictureHeight->cellAttributes() ?>>
<span id="el_cars_PictureHeight">
<input type="text" data-table="cars" data-field="x_PictureHeight" name="x_PictureHeight" id="x_PictureHeight" size="30" placeholder="<?php echo HtmlEncode($cars->PictureHeight->getPlaceHolder()) ?>" value="<?php echo $cars->PictureHeight->EditValue ?>"<?php echo $cars->PictureHeight->editAttributes() ?>>
</span>
<?php echo $cars->PictureHeight->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($cars->Color->Visible) { // Color ?>
<?php if ($cars_edit->IsMobileOrModal) { ?>
	<div id="r_Color" class="form-group row">
		<label id="elh_cars_Color" for="x_Color" class="<?php echo $cars_edit->LeftColumnClass ?>"><?php echo $cars->Color->caption() ?><?php echo ($cars->Color->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_edit->RightColumnClass ?>"><div<?php echo $cars->Color->cellAttributes() ?>>
<span id="el_cars_Color">
<input type="text" data-table="cars" data-field="x_Color" name="x_Color" id="x_Color" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($cars->Color->getPlaceHolder()) ?>" value="<?php echo $cars->Color->EditValue ?>"<?php echo $cars->Color->editAttributes() ?>>
</span>
<?php echo $cars->Color->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Color">
		<td class="<?php echo $cars_edit->TableLeftColumnClass ?>"><span id="elh_cars_Color"><?php echo $cars->Color->caption() ?><?php echo ($cars->Color->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $cars->Color->cellAttributes() ?>>
<span id="el_cars_Color">
<input type="text" data-table="cars" data-field="x_Color" name="x_Color" id="x_Color" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($cars->Color->getPlaceHolder()) ?>" value="<?php echo $cars->Color->EditValue ?>"<?php echo $cars->Color->editAttributes() ?>>
</span>
<?php echo $cars->Color->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($cars_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$cars_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $cars_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cars_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$cars_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
<?php if (!$cars_edit->IsModal) { ?>
<?php if (!isset($cars_edit->Pager)) $cars_edit->Pager = new PrevNextPager($cars_edit->StartRec, $cars_edit->DisplayRecs, $cars_edit->TotalRecs, $cars_edit->AutoHidePager) ?>
<?php if ($cars_edit->Pager->RecordCount > 0 && $cars_edit->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($cars_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $cars_edit->pageUrl() ?>start=<?php echo $cars_edit->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($cars_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $cars_edit->pageUrl() ?>start=<?php echo $cars_edit->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $cars_edit->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($cars_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $cars_edit->pageUrl() ?>start=<?php echo $cars_edit->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($cars_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $cars_edit->pageUrl() ?>start=<?php echo $cars_edit->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $cars_edit->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$cars_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cars_edit->terminate();
?>
