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
$employees_edit = new employees_edit();

// Run the page
$employees_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employees_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var femployeesedit = currentForm = new ew.Form("femployeesedit", "edit");

// Validate form
femployeesedit.validate = function() {
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
		<?php if ($employees_edit->EmployeeID->Required) { ?>
			elm = this.getElements("x" + infix + "_EmployeeID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees->EmployeeID->caption(), $employees->EmployeeID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($employees_edit->LastName->Required) { ?>
			elm = this.getElements("x" + infix + "_LastName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees->LastName->caption(), $employees->LastName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($employees_edit->FirstName->Required) { ?>
			elm = this.getElements("x" + infix + "_FirstName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees->FirstName->caption(), $employees->FirstName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($employees_edit->Title->Required) { ?>
			elm = this.getElements("x" + infix + "_Title");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees->Title->caption(), $employees->Title->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($employees_edit->TitleOfCourtesy->Required) { ?>
			elm = this.getElements("x" + infix + "_TitleOfCourtesy");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees->TitleOfCourtesy->caption(), $employees->TitleOfCourtesy->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($employees_edit->BirthDate->Required) { ?>
			elm = this.getElements("x" + infix + "_BirthDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees->BirthDate->caption(), $employees->BirthDate->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_BirthDate");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($employees->BirthDate->errorMessage()) ?>");
		<?php if ($employees_edit->HireDate->Required) { ?>
			elm = this.getElements("x" + infix + "_HireDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees->HireDate->caption(), $employees->HireDate->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_HireDate");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($employees->HireDate->errorMessage()) ?>");
		<?php if ($employees_edit->Address->Required) { ?>
			elm = this.getElements("x" + infix + "_Address");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees->Address->caption(), $employees->Address->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($employees_edit->City->Required) { ?>
			elm = this.getElements("x" + infix + "_City");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees->City->caption(), $employees->City->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($employees_edit->Region->Required) { ?>
			elm = this.getElements("x" + infix + "_Region");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees->Region->caption(), $employees->Region->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($employees_edit->PostalCode->Required) { ?>
			elm = this.getElements("x" + infix + "_PostalCode");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees->PostalCode->caption(), $employees->PostalCode->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($employees_edit->Country->Required) { ?>
			elm = this.getElements("x" + infix + "_Country");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees->Country->caption(), $employees->Country->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($employees_edit->HomePhone->Required) { ?>
			elm = this.getElements("x" + infix + "_HomePhone");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees->HomePhone->caption(), $employees->HomePhone->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($employees_edit->Extension->Required) { ?>
			elm = this.getElements("x" + infix + "_Extension");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees->Extension->caption(), $employees->Extension->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($employees_edit->_Email->Required) { ?>
			elm = this.getElements("x" + infix + "__Email");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees->_Email->caption(), $employees->_Email->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($employees_edit->Photo->Required) { ?>
			elm = this.getElements("x" + infix + "_Photo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees->Photo->caption(), $employees->Photo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($employees_edit->Notes->Required) { ?>
			elm = this.getElements("x" + infix + "_Notes");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees->Notes->caption(), $employees->Notes->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($employees_edit->ReportsTo->Required) { ?>
			elm = this.getElements("x" + infix + "_ReportsTo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees->ReportsTo->caption(), $employees->ReportsTo->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_ReportsTo");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($employees->ReportsTo->errorMessage()) ?>");
		<?php if ($employees_edit->Password->Required) { ?>
			elm = this.getElements("x" + infix + "_Password");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees->Password->caption(), $employees->Password->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($employees_edit->UserLevel->Required) { ?>
			elm = this.getElements("x" + infix + "_UserLevel");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees->UserLevel->caption(), $employees->UserLevel->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_UserLevel");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($employees->UserLevel->errorMessage()) ?>");
		<?php if ($employees_edit->Username->Required) { ?>
			elm = this.getElements("x" + infix + "_Username");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees->Username->caption(), $employees->Username->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($employees_edit->Activated->Required) { ?>
			elm = this.getElements("x" + infix + "_Activated[]");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees->Activated->caption(), $employees->Activated->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($employees_edit->Profile->Required) { ?>
			elm = this.getElements("x" + infix + "_Profile");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees->Profile->caption(), $employees->Profile->RequiredErrorMessage)) ?>");
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
femployeesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
femployeesedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
femployeesedit.lists["x_Activated[]"] = <?php echo $employees_edit->Activated->Lookup->toClientList() ?>;
femployeesedit.lists["x_Activated[]"].options = <?php echo JsonEncode($employees_edit->Activated->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $employees_edit->showPageHeader(); ?>
<?php
$employees_edit->showMessage();
?>
<?php if (!$employees_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($employees_edit->Pager)) $employees_edit->Pager = new PrevNextPager($employees_edit->StartRec, $employees_edit->DisplayRecs, $employees_edit->TotalRecs, $employees_edit->AutoHidePager) ?>
<?php if ($employees_edit->Pager->RecordCount > 0 && $employees_edit->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($employees_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $employees_edit->pageUrl() ?>start=<?php echo $employees_edit->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($employees_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $employees_edit->pageUrl() ?>start=<?php echo $employees_edit->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $employees_edit->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($employees_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $employees_edit->pageUrl() ?>start=<?php echo $employees_edit->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($employees_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $employees_edit->pageUrl() ?>start=<?php echo $employees_edit->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $employees_edit->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="femployeesedit" id="femployeesedit" class="<?php echo $employees_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($employees_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $employees_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employees">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$employees_edit->IsModal ?>">
<?php if (!$employees_edit->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($employees_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_employeesedit" class="table ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($employees->EmployeeID->Visible) { // EmployeeID ?>
<?php if ($employees_edit->IsMobileOrModal) { ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_employees_EmployeeID" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees->EmployeeID->caption() ?><?php echo ($employees->EmployeeID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div<?php echo $employees->EmployeeID->cellAttributes() ?>>
<span id="el_employees_EmployeeID">
<span<?php echo $employees->EmployeeID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($employees->EmployeeID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="employees" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" value="<?php echo HtmlEncode($employees->EmployeeID->CurrentValue) ?>">
<?php echo $employees->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_EmployeeID">
		<td class="<?php echo $employees_edit->TableLeftColumnClass ?>"><span id="elh_employees_EmployeeID"><?php echo $employees->EmployeeID->caption() ?><?php echo ($employees->EmployeeID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $employees->EmployeeID->cellAttributes() ?>>
<span id="el_employees_EmployeeID">
<span<?php echo $employees->EmployeeID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($employees->EmployeeID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="employees" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" value="<?php echo HtmlEncode($employees->EmployeeID->CurrentValue) ?>">
<?php echo $employees->EmployeeID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($employees->LastName->Visible) { // LastName ?>
<?php if ($employees_edit->IsMobileOrModal) { ?>
	<div id="r_LastName" class="form-group row">
		<label id="elh_employees_LastName" for="x_LastName" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees->LastName->caption() ?><?php echo ($employees->LastName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div<?php echo $employees->LastName->cellAttributes() ?>>
<span id="el_employees_LastName">
<input type="text" data-table="employees" data-field="x_LastName" name="x_LastName" id="x_LastName" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($employees->LastName->getPlaceHolder()) ?>" value="<?php echo $employees->LastName->EditValue ?>"<?php echo $employees->LastName->editAttributes() ?>>
</span>
<?php echo $employees->LastName->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_LastName">
		<td class="<?php echo $employees_edit->TableLeftColumnClass ?>"><span id="elh_employees_LastName"><?php echo $employees->LastName->caption() ?><?php echo ($employees->LastName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $employees->LastName->cellAttributes() ?>>
<span id="el_employees_LastName">
<input type="text" data-table="employees" data-field="x_LastName" name="x_LastName" id="x_LastName" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($employees->LastName->getPlaceHolder()) ?>" value="<?php echo $employees->LastName->EditValue ?>"<?php echo $employees->LastName->editAttributes() ?>>
</span>
<?php echo $employees->LastName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($employees->FirstName->Visible) { // FirstName ?>
<?php if ($employees_edit->IsMobileOrModal) { ?>
	<div id="r_FirstName" class="form-group row">
		<label id="elh_employees_FirstName" for="x_FirstName" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees->FirstName->caption() ?><?php echo ($employees->FirstName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div<?php echo $employees->FirstName->cellAttributes() ?>>
<span id="el_employees_FirstName">
<input type="text" data-table="employees" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employees->FirstName->getPlaceHolder()) ?>" value="<?php echo $employees->FirstName->EditValue ?>"<?php echo $employees->FirstName->editAttributes() ?>>
</span>
<?php echo $employees->FirstName->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_FirstName">
		<td class="<?php echo $employees_edit->TableLeftColumnClass ?>"><span id="elh_employees_FirstName"><?php echo $employees->FirstName->caption() ?><?php echo ($employees->FirstName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $employees->FirstName->cellAttributes() ?>>
<span id="el_employees_FirstName">
<input type="text" data-table="employees" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employees->FirstName->getPlaceHolder()) ?>" value="<?php echo $employees->FirstName->EditValue ?>"<?php echo $employees->FirstName->editAttributes() ?>>
</span>
<?php echo $employees->FirstName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($employees->Title->Visible) { // Title ?>
<?php if ($employees_edit->IsMobileOrModal) { ?>
	<div id="r_Title" class="form-group row">
		<label id="elh_employees_Title" for="x_Title" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees->Title->caption() ?><?php echo ($employees->Title->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div<?php echo $employees->Title->cellAttributes() ?>>
<span id="el_employees_Title">
<input type="text" data-table="employees" data-field="x_Title" name="x_Title" id="x_Title" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($employees->Title->getPlaceHolder()) ?>" value="<?php echo $employees->Title->EditValue ?>"<?php echo $employees->Title->editAttributes() ?>>
</span>
<?php echo $employees->Title->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Title">
		<td class="<?php echo $employees_edit->TableLeftColumnClass ?>"><span id="elh_employees_Title"><?php echo $employees->Title->caption() ?><?php echo ($employees->Title->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $employees->Title->cellAttributes() ?>>
<span id="el_employees_Title">
<input type="text" data-table="employees" data-field="x_Title" name="x_Title" id="x_Title" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($employees->Title->getPlaceHolder()) ?>" value="<?php echo $employees->Title->EditValue ?>"<?php echo $employees->Title->editAttributes() ?>>
</span>
<?php echo $employees->Title->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($employees->TitleOfCourtesy->Visible) { // TitleOfCourtesy ?>
<?php if ($employees_edit->IsMobileOrModal) { ?>
	<div id="r_TitleOfCourtesy" class="form-group row">
		<label id="elh_employees_TitleOfCourtesy" for="x_TitleOfCourtesy" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees->TitleOfCourtesy->caption() ?><?php echo ($employees->TitleOfCourtesy->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div<?php echo $employees->TitleOfCourtesy->cellAttributes() ?>>
<span id="el_employees_TitleOfCourtesy">
<input type="text" data-table="employees" data-field="x_TitleOfCourtesy" name="x_TitleOfCourtesy" id="x_TitleOfCourtesy" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($employees->TitleOfCourtesy->getPlaceHolder()) ?>" value="<?php echo $employees->TitleOfCourtesy->EditValue ?>"<?php echo $employees->TitleOfCourtesy->editAttributes() ?>>
</span>
<?php echo $employees->TitleOfCourtesy->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_TitleOfCourtesy">
		<td class="<?php echo $employees_edit->TableLeftColumnClass ?>"><span id="elh_employees_TitleOfCourtesy"><?php echo $employees->TitleOfCourtesy->caption() ?><?php echo ($employees->TitleOfCourtesy->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $employees->TitleOfCourtesy->cellAttributes() ?>>
<span id="el_employees_TitleOfCourtesy">
<input type="text" data-table="employees" data-field="x_TitleOfCourtesy" name="x_TitleOfCourtesy" id="x_TitleOfCourtesy" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($employees->TitleOfCourtesy->getPlaceHolder()) ?>" value="<?php echo $employees->TitleOfCourtesy->EditValue ?>"<?php echo $employees->TitleOfCourtesy->editAttributes() ?>>
</span>
<?php echo $employees->TitleOfCourtesy->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($employees->BirthDate->Visible) { // BirthDate ?>
<?php if ($employees_edit->IsMobileOrModal) { ?>
	<div id="r_BirthDate" class="form-group row">
		<label id="elh_employees_BirthDate" for="x_BirthDate" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees->BirthDate->caption() ?><?php echo ($employees->BirthDate->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div<?php echo $employees->BirthDate->cellAttributes() ?>>
<span id="el_employees_BirthDate">
<input type="text" data-table="employees" data-field="x_BirthDate" name="x_BirthDate" id="x_BirthDate" placeholder="<?php echo HtmlEncode($employees->BirthDate->getPlaceHolder()) ?>" value="<?php echo $employees->BirthDate->EditValue ?>"<?php echo $employees->BirthDate->editAttributes() ?>>
</span>
<?php echo $employees->BirthDate->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_BirthDate">
		<td class="<?php echo $employees_edit->TableLeftColumnClass ?>"><span id="elh_employees_BirthDate"><?php echo $employees->BirthDate->caption() ?><?php echo ($employees->BirthDate->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $employees->BirthDate->cellAttributes() ?>>
<span id="el_employees_BirthDate">
<input type="text" data-table="employees" data-field="x_BirthDate" name="x_BirthDate" id="x_BirthDate" placeholder="<?php echo HtmlEncode($employees->BirthDate->getPlaceHolder()) ?>" value="<?php echo $employees->BirthDate->EditValue ?>"<?php echo $employees->BirthDate->editAttributes() ?>>
</span>
<?php echo $employees->BirthDate->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($employees->HireDate->Visible) { // HireDate ?>
<?php if ($employees_edit->IsMobileOrModal) { ?>
	<div id="r_HireDate" class="form-group row">
		<label id="elh_employees_HireDate" for="x_HireDate" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees->HireDate->caption() ?><?php echo ($employees->HireDate->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div<?php echo $employees->HireDate->cellAttributes() ?>>
<span id="el_employees_HireDate">
<input type="text" data-table="employees" data-field="x_HireDate" name="x_HireDate" id="x_HireDate" placeholder="<?php echo HtmlEncode($employees->HireDate->getPlaceHolder()) ?>" value="<?php echo $employees->HireDate->EditValue ?>"<?php echo $employees->HireDate->editAttributes() ?>>
</span>
<?php echo $employees->HireDate->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_HireDate">
		<td class="<?php echo $employees_edit->TableLeftColumnClass ?>"><span id="elh_employees_HireDate"><?php echo $employees->HireDate->caption() ?><?php echo ($employees->HireDate->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $employees->HireDate->cellAttributes() ?>>
<span id="el_employees_HireDate">
<input type="text" data-table="employees" data-field="x_HireDate" name="x_HireDate" id="x_HireDate" placeholder="<?php echo HtmlEncode($employees->HireDate->getPlaceHolder()) ?>" value="<?php echo $employees->HireDate->EditValue ?>"<?php echo $employees->HireDate->editAttributes() ?>>
</span>
<?php echo $employees->HireDate->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($employees->Address->Visible) { // Address ?>
<?php if ($employees_edit->IsMobileOrModal) { ?>
	<div id="r_Address" class="form-group row">
		<label id="elh_employees_Address" for="x_Address" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees->Address->caption() ?><?php echo ($employees->Address->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div<?php echo $employees->Address->cellAttributes() ?>>
<span id="el_employees_Address">
<input type="text" data-table="employees" data-field="x_Address" name="x_Address" id="x_Address" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($employees->Address->getPlaceHolder()) ?>" value="<?php echo $employees->Address->EditValue ?>"<?php echo $employees->Address->editAttributes() ?>>
</span>
<?php echo $employees->Address->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Address">
		<td class="<?php echo $employees_edit->TableLeftColumnClass ?>"><span id="elh_employees_Address"><?php echo $employees->Address->caption() ?><?php echo ($employees->Address->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $employees->Address->cellAttributes() ?>>
<span id="el_employees_Address">
<input type="text" data-table="employees" data-field="x_Address" name="x_Address" id="x_Address" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($employees->Address->getPlaceHolder()) ?>" value="<?php echo $employees->Address->EditValue ?>"<?php echo $employees->Address->editAttributes() ?>>
</span>
<?php echo $employees->Address->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($employees->City->Visible) { // City ?>
<?php if ($employees_edit->IsMobileOrModal) { ?>
	<div id="r_City" class="form-group row">
		<label id="elh_employees_City" for="x_City" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees->City->caption() ?><?php echo ($employees->City->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div<?php echo $employees->City->cellAttributes() ?>>
<span id="el_employees_City">
<input type="text" data-table="employees" data-field="x_City" name="x_City" id="x_City" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($employees->City->getPlaceHolder()) ?>" value="<?php echo $employees->City->EditValue ?>"<?php echo $employees->City->editAttributes() ?>>
</span>
<?php echo $employees->City->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_City">
		<td class="<?php echo $employees_edit->TableLeftColumnClass ?>"><span id="elh_employees_City"><?php echo $employees->City->caption() ?><?php echo ($employees->City->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $employees->City->cellAttributes() ?>>
<span id="el_employees_City">
<input type="text" data-table="employees" data-field="x_City" name="x_City" id="x_City" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($employees->City->getPlaceHolder()) ?>" value="<?php echo $employees->City->EditValue ?>"<?php echo $employees->City->editAttributes() ?>>
</span>
<?php echo $employees->City->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($employees->Region->Visible) { // Region ?>
<?php if ($employees_edit->IsMobileOrModal) { ?>
	<div id="r_Region" class="form-group row">
		<label id="elh_employees_Region" for="x_Region" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees->Region->caption() ?><?php echo ($employees->Region->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div<?php echo $employees->Region->cellAttributes() ?>>
<span id="el_employees_Region">
<input type="text" data-table="employees" data-field="x_Region" name="x_Region" id="x_Region" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($employees->Region->getPlaceHolder()) ?>" value="<?php echo $employees->Region->EditValue ?>"<?php echo $employees->Region->editAttributes() ?>>
</span>
<?php echo $employees->Region->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Region">
		<td class="<?php echo $employees_edit->TableLeftColumnClass ?>"><span id="elh_employees_Region"><?php echo $employees->Region->caption() ?><?php echo ($employees->Region->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $employees->Region->cellAttributes() ?>>
<span id="el_employees_Region">
<input type="text" data-table="employees" data-field="x_Region" name="x_Region" id="x_Region" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($employees->Region->getPlaceHolder()) ?>" value="<?php echo $employees->Region->EditValue ?>"<?php echo $employees->Region->editAttributes() ?>>
</span>
<?php echo $employees->Region->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($employees->PostalCode->Visible) { // PostalCode ?>
<?php if ($employees_edit->IsMobileOrModal) { ?>
	<div id="r_PostalCode" class="form-group row">
		<label id="elh_employees_PostalCode" for="x_PostalCode" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees->PostalCode->caption() ?><?php echo ($employees->PostalCode->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div<?php echo $employees->PostalCode->cellAttributes() ?>>
<span id="el_employees_PostalCode">
<input type="text" data-table="employees" data-field="x_PostalCode" name="x_PostalCode" id="x_PostalCode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employees->PostalCode->getPlaceHolder()) ?>" value="<?php echo $employees->PostalCode->EditValue ?>"<?php echo $employees->PostalCode->editAttributes() ?>>
</span>
<?php echo $employees->PostalCode->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_PostalCode">
		<td class="<?php echo $employees_edit->TableLeftColumnClass ?>"><span id="elh_employees_PostalCode"><?php echo $employees->PostalCode->caption() ?><?php echo ($employees->PostalCode->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $employees->PostalCode->cellAttributes() ?>>
<span id="el_employees_PostalCode">
<input type="text" data-table="employees" data-field="x_PostalCode" name="x_PostalCode" id="x_PostalCode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employees->PostalCode->getPlaceHolder()) ?>" value="<?php echo $employees->PostalCode->EditValue ?>"<?php echo $employees->PostalCode->editAttributes() ?>>
</span>
<?php echo $employees->PostalCode->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($employees->Country->Visible) { // Country ?>
<?php if ($employees_edit->IsMobileOrModal) { ?>
	<div id="r_Country" class="form-group row">
		<label id="elh_employees_Country" for="x_Country" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees->Country->caption() ?><?php echo ($employees->Country->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div<?php echo $employees->Country->cellAttributes() ?>>
<span id="el_employees_Country">
<input type="text" data-table="employees" data-field="x_Country" name="x_Country" id="x_Country" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($employees->Country->getPlaceHolder()) ?>" value="<?php echo $employees->Country->EditValue ?>"<?php echo $employees->Country->editAttributes() ?>>
</span>
<?php echo $employees->Country->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Country">
		<td class="<?php echo $employees_edit->TableLeftColumnClass ?>"><span id="elh_employees_Country"><?php echo $employees->Country->caption() ?><?php echo ($employees->Country->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $employees->Country->cellAttributes() ?>>
<span id="el_employees_Country">
<input type="text" data-table="employees" data-field="x_Country" name="x_Country" id="x_Country" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($employees->Country->getPlaceHolder()) ?>" value="<?php echo $employees->Country->EditValue ?>"<?php echo $employees->Country->editAttributes() ?>>
</span>
<?php echo $employees->Country->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($employees->HomePhone->Visible) { // HomePhone ?>
<?php if ($employees_edit->IsMobileOrModal) { ?>
	<div id="r_HomePhone" class="form-group row">
		<label id="elh_employees_HomePhone" for="x_HomePhone" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees->HomePhone->caption() ?><?php echo ($employees->HomePhone->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div<?php echo $employees->HomePhone->cellAttributes() ?>>
<span id="el_employees_HomePhone">
<input type="text" data-table="employees" data-field="x_HomePhone" name="x_HomePhone" id="x_HomePhone" size="30" maxlength="24" placeholder="<?php echo HtmlEncode($employees->HomePhone->getPlaceHolder()) ?>" value="<?php echo $employees->HomePhone->EditValue ?>"<?php echo $employees->HomePhone->editAttributes() ?>>
</span>
<?php echo $employees->HomePhone->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_HomePhone">
		<td class="<?php echo $employees_edit->TableLeftColumnClass ?>"><span id="elh_employees_HomePhone"><?php echo $employees->HomePhone->caption() ?><?php echo ($employees->HomePhone->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $employees->HomePhone->cellAttributes() ?>>
<span id="el_employees_HomePhone">
<input type="text" data-table="employees" data-field="x_HomePhone" name="x_HomePhone" id="x_HomePhone" size="30" maxlength="24" placeholder="<?php echo HtmlEncode($employees->HomePhone->getPlaceHolder()) ?>" value="<?php echo $employees->HomePhone->EditValue ?>"<?php echo $employees->HomePhone->editAttributes() ?>>
</span>
<?php echo $employees->HomePhone->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($employees->Extension->Visible) { // Extension ?>
<?php if ($employees_edit->IsMobileOrModal) { ?>
	<div id="r_Extension" class="form-group row">
		<label id="elh_employees_Extension" for="x_Extension" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees->Extension->caption() ?><?php echo ($employees->Extension->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div<?php echo $employees->Extension->cellAttributes() ?>>
<span id="el_employees_Extension">
<input type="text" data-table="employees" data-field="x_Extension" name="x_Extension" id="x_Extension" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($employees->Extension->getPlaceHolder()) ?>" value="<?php echo $employees->Extension->EditValue ?>"<?php echo $employees->Extension->editAttributes() ?>>
</span>
<?php echo $employees->Extension->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Extension">
		<td class="<?php echo $employees_edit->TableLeftColumnClass ?>"><span id="elh_employees_Extension"><?php echo $employees->Extension->caption() ?><?php echo ($employees->Extension->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $employees->Extension->cellAttributes() ?>>
<span id="el_employees_Extension">
<input type="text" data-table="employees" data-field="x_Extension" name="x_Extension" id="x_Extension" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($employees->Extension->getPlaceHolder()) ?>" value="<?php echo $employees->Extension->EditValue ?>"<?php echo $employees->Extension->editAttributes() ?>>
</span>
<?php echo $employees->Extension->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($employees->_Email->Visible) { // Email ?>
<?php if ($employees_edit->IsMobileOrModal) { ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_employees__Email" for="x__Email" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees->_Email->caption() ?><?php echo ($employees->_Email->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div<?php echo $employees->_Email->cellAttributes() ?>>
<span id="el_employees__Email">
<input type="text" data-table="employees" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($employees->_Email->getPlaceHolder()) ?>" value="<?php echo $employees->_Email->EditValue ?>"<?php echo $employees->_Email->editAttributes() ?>>
</span>
<?php echo $employees->_Email->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r__Email">
		<td class="<?php echo $employees_edit->TableLeftColumnClass ?>"><span id="elh_employees__Email"><?php echo $employees->_Email->caption() ?><?php echo ($employees->_Email->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $employees->_Email->cellAttributes() ?>>
<span id="el_employees__Email">
<input type="text" data-table="employees" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($employees->_Email->getPlaceHolder()) ?>" value="<?php echo $employees->_Email->EditValue ?>"<?php echo $employees->_Email->editAttributes() ?>>
</span>
<?php echo $employees->_Email->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($employees->Photo->Visible) { // Photo ?>
<?php if ($employees_edit->IsMobileOrModal) { ?>
	<div id="r_Photo" class="form-group row">
		<label id="elh_employees_Photo" for="x_Photo" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees->Photo->caption() ?><?php echo ($employees->Photo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div<?php echo $employees->Photo->cellAttributes() ?>>
<span id="el_employees_Photo">
<input type="text" data-table="employees" data-field="x_Photo" name="x_Photo" id="x_Photo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($employees->Photo->getPlaceHolder()) ?>" value="<?php echo $employees->Photo->EditValue ?>"<?php echo $employees->Photo->editAttributes() ?>>
</span>
<?php echo $employees->Photo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Photo">
		<td class="<?php echo $employees_edit->TableLeftColumnClass ?>"><span id="elh_employees_Photo"><?php echo $employees->Photo->caption() ?><?php echo ($employees->Photo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $employees->Photo->cellAttributes() ?>>
<span id="el_employees_Photo">
<input type="text" data-table="employees" data-field="x_Photo" name="x_Photo" id="x_Photo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($employees->Photo->getPlaceHolder()) ?>" value="<?php echo $employees->Photo->EditValue ?>"<?php echo $employees->Photo->editAttributes() ?>>
</span>
<?php echo $employees->Photo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($employees->Notes->Visible) { // Notes ?>
<?php if ($employees_edit->IsMobileOrModal) { ?>
	<div id="r_Notes" class="form-group row">
		<label id="elh_employees_Notes" for="x_Notes" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees->Notes->caption() ?><?php echo ($employees->Notes->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div<?php echo $employees->Notes->cellAttributes() ?>>
<span id="el_employees_Notes">
<textarea data-table="employees" data-field="x_Notes" name="x_Notes" id="x_Notes" cols="35" rows="4" placeholder="<?php echo HtmlEncode($employees->Notes->getPlaceHolder()) ?>"<?php echo $employees->Notes->editAttributes() ?>><?php echo $employees->Notes->EditValue ?></textarea>
</span>
<?php echo $employees->Notes->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Notes">
		<td class="<?php echo $employees_edit->TableLeftColumnClass ?>"><span id="elh_employees_Notes"><?php echo $employees->Notes->caption() ?><?php echo ($employees->Notes->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $employees->Notes->cellAttributes() ?>>
<span id="el_employees_Notes">
<textarea data-table="employees" data-field="x_Notes" name="x_Notes" id="x_Notes" cols="35" rows="4" placeholder="<?php echo HtmlEncode($employees->Notes->getPlaceHolder()) ?>"<?php echo $employees->Notes->editAttributes() ?>><?php echo $employees->Notes->EditValue ?></textarea>
</span>
<?php echo $employees->Notes->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($employees->ReportsTo->Visible) { // ReportsTo ?>
<?php if ($employees_edit->IsMobileOrModal) { ?>
	<div id="r_ReportsTo" class="form-group row">
		<label id="elh_employees_ReportsTo" for="x_ReportsTo" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees->ReportsTo->caption() ?><?php echo ($employees->ReportsTo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div<?php echo $employees->ReportsTo->cellAttributes() ?>>
<span id="el_employees_ReportsTo">
<input type="text" data-table="employees" data-field="x_ReportsTo" name="x_ReportsTo" id="x_ReportsTo" size="30" placeholder="<?php echo HtmlEncode($employees->ReportsTo->getPlaceHolder()) ?>" value="<?php echo $employees->ReportsTo->EditValue ?>"<?php echo $employees->ReportsTo->editAttributes() ?>>
</span>
<?php echo $employees->ReportsTo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ReportsTo">
		<td class="<?php echo $employees_edit->TableLeftColumnClass ?>"><span id="elh_employees_ReportsTo"><?php echo $employees->ReportsTo->caption() ?><?php echo ($employees->ReportsTo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $employees->ReportsTo->cellAttributes() ?>>
<span id="el_employees_ReportsTo">
<input type="text" data-table="employees" data-field="x_ReportsTo" name="x_ReportsTo" id="x_ReportsTo" size="30" placeholder="<?php echo HtmlEncode($employees->ReportsTo->getPlaceHolder()) ?>" value="<?php echo $employees->ReportsTo->EditValue ?>"<?php echo $employees->ReportsTo->editAttributes() ?>>
</span>
<?php echo $employees->ReportsTo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($employees->Password->Visible) { // Password ?>
<?php if ($employees_edit->IsMobileOrModal) { ?>
	<div id="r_Password" class="form-group row">
		<label id="elh_employees_Password" for="x_Password" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees->Password->caption() ?><?php echo ($employees->Password->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div<?php echo $employees->Password->cellAttributes() ?>>
<span id="el_employees_Password">
<input type="text" data-table="employees" data-field="x_Password" name="x_Password" id="x_Password" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($employees->Password->getPlaceHolder()) ?>" value="<?php echo $employees->Password->EditValue ?>"<?php echo $employees->Password->editAttributes() ?>>
</span>
<?php echo $employees->Password->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Password">
		<td class="<?php echo $employees_edit->TableLeftColumnClass ?>"><span id="elh_employees_Password"><?php echo $employees->Password->caption() ?><?php echo ($employees->Password->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $employees->Password->cellAttributes() ?>>
<span id="el_employees_Password">
<input type="text" data-table="employees" data-field="x_Password" name="x_Password" id="x_Password" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($employees->Password->getPlaceHolder()) ?>" value="<?php echo $employees->Password->EditValue ?>"<?php echo $employees->Password->editAttributes() ?>>
</span>
<?php echo $employees->Password->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($employees->UserLevel->Visible) { // UserLevel ?>
<?php if ($employees_edit->IsMobileOrModal) { ?>
	<div id="r_UserLevel" class="form-group row">
		<label id="elh_employees_UserLevel" for="x_UserLevel" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees->UserLevel->caption() ?><?php echo ($employees->UserLevel->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div<?php echo $employees->UserLevel->cellAttributes() ?>>
<span id="el_employees_UserLevel">
<input type="text" data-table="employees" data-field="x_UserLevel" name="x_UserLevel" id="x_UserLevel" size="30" placeholder="<?php echo HtmlEncode($employees->UserLevel->getPlaceHolder()) ?>" value="<?php echo $employees->UserLevel->EditValue ?>"<?php echo $employees->UserLevel->editAttributes() ?>>
</span>
<?php echo $employees->UserLevel->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_UserLevel">
		<td class="<?php echo $employees_edit->TableLeftColumnClass ?>"><span id="elh_employees_UserLevel"><?php echo $employees->UserLevel->caption() ?><?php echo ($employees->UserLevel->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $employees->UserLevel->cellAttributes() ?>>
<span id="el_employees_UserLevel">
<input type="text" data-table="employees" data-field="x_UserLevel" name="x_UserLevel" id="x_UserLevel" size="30" placeholder="<?php echo HtmlEncode($employees->UserLevel->getPlaceHolder()) ?>" value="<?php echo $employees->UserLevel->EditValue ?>"<?php echo $employees->UserLevel->editAttributes() ?>>
</span>
<?php echo $employees->UserLevel->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($employees->Username->Visible) { // Username ?>
<?php if ($employees_edit->IsMobileOrModal) { ?>
	<div id="r_Username" class="form-group row">
		<label id="elh_employees_Username" for="x_Username" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees->Username->caption() ?><?php echo ($employees->Username->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div<?php echo $employees->Username->cellAttributes() ?>>
<span id="el_employees_Username">
<input type="text" data-table="employees" data-field="x_Username" name="x_Username" id="x_Username" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($employees->Username->getPlaceHolder()) ?>" value="<?php echo $employees->Username->EditValue ?>"<?php echo $employees->Username->editAttributes() ?>>
</span>
<?php echo $employees->Username->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Username">
		<td class="<?php echo $employees_edit->TableLeftColumnClass ?>"><span id="elh_employees_Username"><?php echo $employees->Username->caption() ?><?php echo ($employees->Username->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $employees->Username->cellAttributes() ?>>
<span id="el_employees_Username">
<input type="text" data-table="employees" data-field="x_Username" name="x_Username" id="x_Username" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($employees->Username->getPlaceHolder()) ?>" value="<?php echo $employees->Username->EditValue ?>"<?php echo $employees->Username->editAttributes() ?>>
</span>
<?php echo $employees->Username->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($employees->Activated->Visible) { // Activated ?>
<?php if ($employees_edit->IsMobileOrModal) { ?>
	<div id="r_Activated" class="form-group row">
		<label id="elh_employees_Activated" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees->Activated->caption() ?><?php echo ($employees->Activated->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div<?php echo $employees->Activated->cellAttributes() ?>>
<span id="el_employees_Activated">
<?php
$selwrk = (ConvertToBool($employees->Activated->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="employees" data-field="x_Activated" name="x_Activated[]" id="x_Activated[]" value="1"<?php echo $selwrk ?><?php echo $employees->Activated->editAttributes() ?>>
</span>
<?php echo $employees->Activated->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Activated">
		<td class="<?php echo $employees_edit->TableLeftColumnClass ?>"><span id="elh_employees_Activated"><?php echo $employees->Activated->caption() ?><?php echo ($employees->Activated->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $employees->Activated->cellAttributes() ?>>
<span id="el_employees_Activated">
<?php
$selwrk = (ConvertToBool($employees->Activated->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="employees" data-field="x_Activated" name="x_Activated[]" id="x_Activated[]" value="1"<?php echo $selwrk ?><?php echo $employees->Activated->editAttributes() ?>>
</span>
<?php echo $employees->Activated->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($employees->Profile->Visible) { // Profile ?>
<?php if ($employees_edit->IsMobileOrModal) { ?>
	<div id="r_Profile" class="form-group row">
		<label id="elh_employees_Profile" for="x_Profile" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees->Profile->caption() ?><?php echo ($employees->Profile->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div<?php echo $employees->Profile->cellAttributes() ?>>
<span id="el_employees_Profile">
<textarea data-table="employees" data-field="x_Profile" name="x_Profile" id="x_Profile" cols="35" rows="4" placeholder="<?php echo HtmlEncode($employees->Profile->getPlaceHolder()) ?>"<?php echo $employees->Profile->editAttributes() ?>><?php echo $employees->Profile->EditValue ?></textarea>
</span>
<?php echo $employees->Profile->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Profile">
		<td class="<?php echo $employees_edit->TableLeftColumnClass ?>"><span id="elh_employees_Profile"><?php echo $employees->Profile->caption() ?><?php echo ($employees->Profile->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $employees->Profile->cellAttributes() ?>>
<span id="el_employees_Profile">
<textarea data-table="employees" data-field="x_Profile" name="x_Profile" id="x_Profile" cols="35" rows="4" placeholder="<?php echo HtmlEncode($employees->Profile->getPlaceHolder()) ?>"<?php echo $employees->Profile->editAttributes() ?>><?php echo $employees->Profile->EditValue ?></textarea>
</span>
<?php echo $employees->Profile->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($employees_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$employees_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $employees_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $employees_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$employees_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
<?php if (!$employees_edit->IsModal) { ?>
<?php if (!isset($employees_edit->Pager)) $employees_edit->Pager = new PrevNextPager($employees_edit->StartRec, $employees_edit->DisplayRecs, $employees_edit->TotalRecs, $employees_edit->AutoHidePager) ?>
<?php if ($employees_edit->Pager->RecordCount > 0 && $employees_edit->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($employees_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $employees_edit->pageUrl() ?>start=<?php echo $employees_edit->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($employees_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $employees_edit->pageUrl() ?>start=<?php echo $employees_edit->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $employees_edit->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($employees_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $employees_edit->pageUrl() ?>start=<?php echo $employees_edit->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($employees_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $employees_edit->pageUrl() ?>start=<?php echo $employees_edit->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $employees_edit->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$employees_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$employees_edit->terminate();
?>
