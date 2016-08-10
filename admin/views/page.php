<div class="wrap">
	<?php screen_icon(); ?>
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<?php settings_errors(); ?>
	<div id="plugin-conflicts-status" class="notice notice-info">
		<p><?php _e( 'Debug mode is not running', 'plugin-conflicts' ); ?></p></div>

	<h2><?php _e( 'Toggle debug mode', 'plugin-conflicts' ); ?></h2>
	<p class="description"><?php _e( 'Debug mode is only enabled within this browser session. Other users will not be effected by these settings. You can either switch it off here or it will expire automatically when you close the session.', 'plugin-conflicts' ); ?></p>
	<button id="plugin-conflicts-enable" class="button-primary"
	        type="button"><?php _e( 'Start Debug Mode', 'plugin-conflicts' ); ?></button>
	<form method="post" action="options.php">
		<?php
		do_settings_sections( $this->plugin_screen_hook_suffix );
		settings_fields( PC_SLUG );
		submit_button( __( 'Save', 'plugin-conflicts' ) );
		?>
	</form>
</div>
<script>
	var pc_cookie_name = 'plugin_conflicts_enabled';
	function pc_button_text() {
		var button = jQuery('#plugin-conflicts-enable');
		var notice = jQuery('#plugin-conflicts-status');

		notice.toggleClass('notice-info notice-warning');

		if (pc_read_cookie(pc_cookie_name)) {
			button.text('<?php _e( 'Stop Debug Mode', 'plugin-conflicts' ); ?>');
			notice.children('p').text('<?php _e( 'Debug mode is running', 'plugin-conflicts' ); ?>');
		} else {
			button.text('<?php _e( 'Start Debug Mode', 'plugin-conflicts' ); ?>');
			notice.children('p').text('<?php _e( 'Debug mode is not running', 'plugin-conflicts' ); ?>');
		}
	}
	pc_button_text();

	jQuery('#plugin-conflicts-enable').click(function () {
		pc_toggle_enabled();
		pc_button_text();
	});
	function pc_toggle_enabled() {
		if (pc_read_cookie(pc_cookie_name)) {
			pc_erase_cookie(pc_cookie_name);
		} else {
			pc_create_cookie(pc_cookie_name, true, false);
		}
	}

	// toggle row class
	jQuery('input[name^="plugin-conflicts[plugins]"]').on('change', function () {
		jQuery(this).parents('tr').toggleClass('active inactive');
	});
	// source: http://www.quirksmode.org/js/cookies.html
	function pc_create_cookie(name, value, days) {
		if (days) {
			var date = new Date();
			date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
			var expires = "; expires=" + date.toGMTString();
		}
		else var expires = "";
		document.cookie = name + "=" + value + expires + "; path=/";
	}
	function pc_read_cookie(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for (var i = 0; i < ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') c = c.substring(1, c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
		}
		return null;
	}
	function pc_erase_cookie(name) {
		pc_create_cookie(name, "", -1);
	}
</script>
