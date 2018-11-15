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
$cars_delete = new cars_delete();

// Run the page
$cars_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cars_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fcarsdelete = currentForm = new ew.Form("fcarsdelete", "delete");

// Form_CustomValidate event
fcarsdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcarsdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $cars_delete->showPageHeader(); ?>
<?php
$cars_delete->showMessage();
?>
<form name="fcarsdelete" id="fcarsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cars_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cars_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cars">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($cars_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($cars->ID->Visible) { // ID ?>
		<th class="<?php echo $cars->ID->headerCellClass() ?>"><span id="elh_cars_ID" class="cars_ID"><?php echo $cars->ID->caption() ?></span></th>
<?php } ?>
<?php if ($cars->Trademark->Visible) { // Trademark ?>
		<th class="<?php echo $cars->Trademark->headerCellClass() ?>"><span id="elh_cars_Trademark" class="cars_Trademark"><?php echo $cars->Trademark->caption() ?></span></th>
<?php } ?>
<?php if ($cars->Model->Visible) { // Model ?>
		<th class="<?php echo $cars->Model->headerCellClass() ?>"><span id="elh_cars_Model" class="cars_Model"><?php echo $cars->Model->caption() ?></span></th>
<?php } ?>
<?php if ($cars->HP->Visible) { // HP ?>
		<th class="<?php echo $cars->HP->headerCellClass() ?>"><span id="elh_cars_HP" class="cars_HP"><?php echo $cars->HP->caption() ?></span></th>
<?php } ?>
<?php if ($cars->Liter->Visible) { // Liter ?>
		<th class="<?php echo $cars->Liter->headerCellClass() ?>"><span id="elh_cars_Liter" class="cars_Liter"><?php echo $cars->Liter->caption() ?></span></th>
<?php } ?>
<?php if ($cars->Cyl->Visible) { // Cyl ?>
		<th class="<?php echo $cars->Cyl->headerCellClass() ?>"><span id="elh_cars_Cyl" class="cars_Cyl"><?php echo $cars->Cyl->caption() ?></span></th>
<?php } ?>
<?php if ($cars->TransmissSpeedCount->Visible) { // TransmissSpeedCount ?>
		<th class="<?php echo $cars->TransmissSpeedCount->headerCellClass() ?>"><span id="elh_cars_TransmissSpeedCount" class="cars_TransmissSpeedCount"><?php echo $cars->TransmissSpeedCount->caption() ?></span></th>
<?php } ?>
<?php if ($cars->TransmissAutomatic->Visible) { // TransmissAutomatic ?>
		<th class="<?php echo $cars->TransmissAutomatic->headerCellClass() ?>"><span id="elh_cars_TransmissAutomatic" class="cars_TransmissAutomatic"><?php echo $cars->TransmissAutomatic->caption() ?></span></th>
<?php } ?>
<?php if ($cars->MPG_City->Visible) { // MPG_City ?>
		<th class="<?php echo $cars->MPG_City->headerCellClass() ?>"><span id="elh_cars_MPG_City" class="cars_MPG_City"><?php echo $cars->MPG_City->caption() ?></span></th>
<?php } ?>
<?php if ($cars->MPG_Highway->Visible) { // MPG_Highway ?>
		<th class="<?php echo $cars->MPG_Highway->headerCellClass() ?>"><span id="elh_cars_MPG_Highway" class="cars_MPG_Highway"><?php echo $cars->MPG_Highway->caption() ?></span></th>
<?php } ?>
<?php if ($cars->Category->Visible) { // Category ?>
		<th class="<?php echo $cars->Category->headerCellClass() ?>"><span id="elh_cars_Category" class="cars_Category"><?php echo $cars->Category->caption() ?></span></th>
<?php } ?>
<?php if ($cars->Hyperlink->Visible) { // Hyperlink ?>
		<th class="<?php echo $cars->Hyperlink->headerCellClass() ?>"><span id="elh_cars_Hyperlink" class="cars_Hyperlink"><?php echo $cars->Hyperlink->caption() ?></span></th>
<?php } ?>
<?php if ($cars->Price->Visible) { // Price ?>
		<th class="<?php echo $cars->Price->headerCellClass() ?>"><span id="elh_cars_Price" class="cars_Price"><?php echo $cars->Price->caption() ?></span></th>
<?php } ?>
<?php if ($cars->PictureName->Visible) { // PictureName ?>
		<th class="<?php echo $cars->PictureName->headerCellClass() ?>"><span id="elh_cars_PictureName" class="cars_PictureName"><?php echo $cars->PictureName->caption() ?></span></th>
<?php } ?>
<?php if ($cars->PictureSize->Visible) { // PictureSize ?>
		<th class="<?php echo $cars->PictureSize->headerCellClass() ?>"><span id="elh_cars_PictureSize" class="cars_PictureSize"><?php echo $cars->PictureSize->caption() ?></span></th>
<?php } ?>
<?php if ($cars->PictureType->Visible) { // PictureType ?>
		<th class="<?php echo $cars->PictureType->headerCellClass() ?>"><span id="elh_cars_PictureType" class="cars_PictureType"><?php echo $cars->PictureType->caption() ?></span></th>
<?php } ?>
<?php if ($cars->PictureWidth->Visible) { // PictureWidth ?>
		<th class="<?php echo $cars->PictureWidth->headerCellClass() ?>"><span id="elh_cars_PictureWidth" class="cars_PictureWidth"><?php echo $cars->PictureWidth->caption() ?></span></th>
<?php } ?>
<?php if ($cars->PictureHeight->Visible) { // PictureHeight ?>
		<th class="<?php echo $cars->PictureHeight->headerCellClass() ?>"><span id="elh_cars_PictureHeight" class="cars_PictureHeight"><?php echo $cars->PictureHeight->caption() ?></span></th>
<?php } ?>
<?php if ($cars->Color->Visible) { // Color ?>
		<th class="<?php echo $cars->Color->headerCellClass() ?>"><span id="elh_cars_Color" class="cars_Color"><?php echo $cars->Color->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$cars_delete->RecCnt = 0;
$i = 0;
while (!$cars_delete->Recordset->EOF) {
	$cars_delete->RecCnt++;
	$cars_delete->RowCnt++;

	// Set row properties
	$cars->resetAttributes();
	$cars->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$cars_delete->loadRowValues($cars_delete->Recordset);

	// Render row
	$cars_delete->renderRow();
?>
	<tr<?php echo $cars->rowAttributes() ?>>
<?php if ($cars->ID->Visible) { // ID ?>
		<td<?php echo $cars->ID->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCnt ?>_cars_ID" class="cars_ID">
<span<?php echo $cars->ID->viewAttributes() ?>>
<?php echo $cars->ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars->Trademark->Visible) { // Trademark ?>
		<td<?php echo $cars->Trademark->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCnt ?>_cars_Trademark" class="cars_Trademark">
<span<?php echo $cars->Trademark->viewAttributes() ?>>
<?php echo $cars->Trademark->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars->Model->Visible) { // Model ?>
		<td<?php echo $cars->Model->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCnt ?>_cars_Model" class="cars_Model">
<span<?php echo $cars->Model->viewAttributes() ?>>
<?php echo $cars->Model->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars->HP->Visible) { // HP ?>
		<td<?php echo $cars->HP->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCnt ?>_cars_HP" class="cars_HP">
<span<?php echo $cars->HP->viewAttributes() ?>>
<?php echo $cars->HP->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars->Liter->Visible) { // Liter ?>
		<td<?php echo $cars->Liter->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCnt ?>_cars_Liter" class="cars_Liter">
<span<?php echo $cars->Liter->viewAttributes() ?>>
<?php echo $cars->Liter->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars->Cyl->Visible) { // Cyl ?>
		<td<?php echo $cars->Cyl->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCnt ?>_cars_Cyl" class="cars_Cyl">
<span<?php echo $cars->Cyl->viewAttributes() ?>>
<?php echo $cars->Cyl->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars->TransmissSpeedCount->Visible) { // TransmissSpeedCount ?>
		<td<?php echo $cars->TransmissSpeedCount->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCnt ?>_cars_TransmissSpeedCount" class="cars_TransmissSpeedCount">
<span<?php echo $cars->TransmissSpeedCount->viewAttributes() ?>>
<?php echo $cars->TransmissSpeedCount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars->TransmissAutomatic->Visible) { // TransmissAutomatic ?>
		<td<?php echo $cars->TransmissAutomatic->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCnt ?>_cars_TransmissAutomatic" class="cars_TransmissAutomatic">
<span<?php echo $cars->TransmissAutomatic->viewAttributes() ?>>
<?php echo $cars->TransmissAutomatic->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars->MPG_City->Visible) { // MPG_City ?>
		<td<?php echo $cars->MPG_City->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCnt ?>_cars_MPG_City" class="cars_MPG_City">
<span<?php echo $cars->MPG_City->viewAttributes() ?>>
<?php echo $cars->MPG_City->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars->MPG_Highway->Visible) { // MPG_Highway ?>
		<td<?php echo $cars->MPG_Highway->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCnt ?>_cars_MPG_Highway" class="cars_MPG_Highway">
<span<?php echo $cars->MPG_Highway->viewAttributes() ?>>
<?php echo $cars->MPG_Highway->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars->Category->Visible) { // Category ?>
		<td<?php echo $cars->Category->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCnt ?>_cars_Category" class="cars_Category">
<span<?php echo $cars->Category->viewAttributes() ?>>
<?php echo $cars->Category->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars->Hyperlink->Visible) { // Hyperlink ?>
		<td<?php echo $cars->Hyperlink->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCnt ?>_cars_Hyperlink" class="cars_Hyperlink">
<span<?php echo $cars->Hyperlink->viewAttributes() ?>>
<?php echo $cars->Hyperlink->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars->Price->Visible) { // Price ?>
		<td<?php echo $cars->Price->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCnt ?>_cars_Price" class="cars_Price">
<span<?php echo $cars->Price->viewAttributes() ?>>
<?php echo $cars->Price->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars->PictureName->Visible) { // PictureName ?>
		<td<?php echo $cars->PictureName->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCnt ?>_cars_PictureName" class="cars_PictureName">
<span<?php echo $cars->PictureName->viewAttributes() ?>>
<?php echo $cars->PictureName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars->PictureSize->Visible) { // PictureSize ?>
		<td<?php echo $cars->PictureSize->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCnt ?>_cars_PictureSize" class="cars_PictureSize">
<span<?php echo $cars->PictureSize->viewAttributes() ?>>
<?php echo $cars->PictureSize->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars->PictureType->Visible) { // PictureType ?>
		<td<?php echo $cars->PictureType->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCnt ?>_cars_PictureType" class="cars_PictureType">
<span<?php echo $cars->PictureType->viewAttributes() ?>>
<?php echo $cars->PictureType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars->PictureWidth->Visible) { // PictureWidth ?>
		<td<?php echo $cars->PictureWidth->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCnt ?>_cars_PictureWidth" class="cars_PictureWidth">
<span<?php echo $cars->PictureWidth->viewAttributes() ?>>
<?php echo $cars->PictureWidth->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars->PictureHeight->Visible) { // PictureHeight ?>
		<td<?php echo $cars->PictureHeight->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCnt ?>_cars_PictureHeight" class="cars_PictureHeight">
<span<?php echo $cars->PictureHeight->viewAttributes() ?>>
<?php echo $cars->PictureHeight->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars->Color->Visible) { // Color ?>
		<td<?php echo $cars->Color->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCnt ?>_cars_Color" class="cars_Color">
<span<?php echo $cars->Color->viewAttributes() ?>>
<?php echo $cars->Color->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$cars_delete->Recordset->moveNext();
}
$cars_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cars_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$cars_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cars_delete->terminate();
?>
