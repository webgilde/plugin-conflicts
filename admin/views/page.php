<?php screen_icon(); ?>
<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
<?php settings_errors(); ?>
<h3><?php _e( 'Toggle debug mode', 'plugin-conflicts' ); ?></h3>
<button id="plugin-conflicts-enable" class="button" type="button" ><?php _e( 'start debug mode', 'plugin-conflicts' ); ?></button>
<p class="description"><?php _e( 'Debug mode is enabled with the browser, so you are the only one in it. You can either switch it off here or it will expire automatically when you close the session.', 'plugin-conflicts' ); ?></p>
<form method="post" action="options.php"><?php
        settings_fields( PC_SLUG );
        do_settings_sections( $this->plugin_screen_hook_suffix );
        submit_button( __( 'Save', 'plugin-conflicts' ) );
    ?>
</form>
<script>
var pc_cookie_name = 'plugin_conflicts_enabled';
function pc_button_text(){
    var button = jQuery('#plugin-conflicts-enable');
    if( pc_read_cookie( pc_cookie_name ) ){
        button.text( '<?php _e( 'debug mode running', 'plugin-conflicts' ); ?>' );
    } else {
        button.text( '<?php _e( 'start debug mode', 'plugin-conflicts' ); ?>' );
    }
}
pc_button_text();

jQuery('#plugin-conflicts-enable').click(function(){
    pc_toggle_enabled();
    pc_button_text();
});
function pc_toggle_enabled(){
    if( pc_read_cookie( pc_cookie_name ) ){
        pc_erase_cookie( pc_cookie_name );
    } else {
        pc_create_cookie( pc_cookie_name, true, false );
    }
}
// source: http://www.quirksmode.org/js/cookies.html
function pc_create_cookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}
function pc_read_cookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}
function pc_erase_cookie(name) {
	pc_create_cookie(name,"",-1);
}
</script>