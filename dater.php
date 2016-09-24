<?php
/**
 * Plugin Name: Dater	
 * Plugin URI: 
 * Description: Dater Plugin which will display Date time using shortcode and at end of post
 * Version: 1.0.0
 * Author: Rahul Walunje - Brainstorm Force
 **/
// make sure request is from wordpress
if(!function_exists('add_action')) 
	die();
// register admin menu under settings
add_action( 'admin_menu', 'wps_btf_admin_menu' );
function wps_btf_admin_menu() {
	add_options_page('Dater Admin', 'Dater Admin', 'manage_options', 'dater.php', 'wps_btf_dater_admin'); 
}
// admin options 
function wps_btf_dater_admin() {
if(isset($_POST['greetings_msg'])) {
	update_option('greetings_msg', $_POST['greetings_msg'] );
}
	$msg_status = get_option('greetings_msg');
if(isset($_POST['greetings_msg']) && $_POST['greetings_msg']==1){
	update_option('greeting_txt', $_POST['greeting_txt'] );
}
$msg_txt = get_option('greeting_txt');
?>
	<h2> Dater Admin </h2>
	<form action="#" method="post">
		<p><label> Enble Greetings Message </label>
		<input name="greetings_msg" class="greet_toggle" type="radio" value="1" <?php if($msg_status==1) echo 'checked'; ?>> ON
		<input name="greetings_msg" class="greet_toggle" type="radio" value="0" <?php if($msg_status==0) echo 'checked'; ?>> OFF </br></p>
			<p class="toggle_msg"><label> Enter Your Message </label> <input name="greeting_txt" type='text' value="<?php echo $msg_txt; ?>"></p>
		<input type="hidden" class="hidden_status" value="<?php echo $msg_status; ?>">	
		<input type="submit" class="button button-primary" value="submit">
	</form>
<?php
}
// register shortcode
function wps_btf_scode_ay_return($atts){
	$msg_txt = get_option('greeting_txt');
	$day_today = '<span class="day_today"></span>';
	$message = '<span class="btf-greetings-msg">'.$day_today.'</span>';
	return $message;
}
add_shortcode('shortcode','wps_btf_scode_ay_return');

// filter post content for replacing *string* with admin greetings text 
add_filter( 'the_content','wps_btf_before_content'); 
function wps_btf_before_content( $content ) {
	if ( is_single() ) {
		$msg_txt = get_option('greeting_txt'); 
		$msg_status = get_option('greetings_msg');
		$day_today = '<span class="day_today"></span>';
		$content = str_replace('*string*', $msg_txt, $content);
		if($msg_status==1){
			$day_today_msg = '<div class="xyz" style="background: yellowgreen;padding:1em;">'.$msg_txt.' '.$day_today.'</div>';
		}
		else{
			$day_today_msg = '<div class="xyz" style="background: yellowgreen;padding:1em;">'.$day_today.'</div>';
		}
		$content = $content.'<span class="btf-greetings-msg">'.$day_today_msg.'</span>';
		return $content;
	}
	return $content;
}
// enques admin script for show/hide toggle
function wps_btf_scripts_admin() {
wp_enqueue_script( 'btf-custom-script',  plugins_url( 'js/btf-admin.js', __FILE__ ) , array( 'jquery' ) ); 
}
add_action( 'admin_enqueue_scripts', 'wps_btf_scripts_admin' );
add_action( 'wp_enqueue_scripts', 'wps_btf_scripts_admin' );
?>