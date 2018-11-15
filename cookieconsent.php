<?php
namespace PHPMaker2019\demo2019;
?>
<?php if (!CanTrackCookie()) { ?>
<div id="cookie-consent">
	<div class="<?php echo $COOKIE_CONSENT_CLASS ?>">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
		<div class="row">
			<div class="col-md-10"><?php echo $Language->phrase("CookieConsentSummary") ?></div>
			<div>
				<div class="pull-right text-nowrap">
					<button data-action="privacy.php" class="btn btn-default btn-sm shadow-none ew-btn"><?php echo $Language->phrase("LearnMore") ?></button>
					<button type="button" class="btn btn-primary btn-sm shadow-none ew-btn" data-cookie-string="<?php echo HtmlEncode(CreateConsentCookie()) ?>"><?php echo $Language->phrase("Accept") ?></button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
(function($) {

	// Accept button
	$("#cookie-consent button[data-cookie-string]").on("click", function(e){
		document.cookie = $(e.target).data("cookie-string");
		$("#cookie-consent").hide();
		$("<style>.control-sidebar:before{top:0!important}</style>").appendTo("head"); // Reset
	});

	// Learn more button
	$("#cookie-consent button[data-action]").on("click", function(e) {
		window.location = ew.RELATIVE_PATH + $(e.target).data("action");
	});

	// Override AdminLTE Control Sidebar
	adminlte.ControlSidebar.prototype._setMargin = function() {
		$(".control-sidebar").css("top", $(".main-header").outerHeight() + ($("#cookie-consent:visible").outerHeight() || 0));
	};
	$(function() {
		if ($(".control-sidebar")[0]) {
			$("<style>.control-sidebar:before{top:" + $("#cookie-consent").outerHeight() + "px!important}</style>").appendTo("head");
		}
	});
})(jQuery);
</script>
<?php } ?>
