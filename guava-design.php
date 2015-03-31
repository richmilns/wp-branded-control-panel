<?php
/*
Plugin Name: Guava Design Branded Control Panel
Plugin URI:
Description: Brands the control panel to include Guava Design widget on dashboard and change editor permissions, remove WordPress logo from admin menu etc
Author: Rich Milns
Version: 1.0.0
Author URI: http://guavadesign.co.uk
*/

/**
 * Convenience function (similar to CakePHP) to make debugging variables easier
 *
 * @param string $message
 */
if(!function_exists('debug')) {
	function debug($message=null)
	{
		$backtrace = debug_backtrace();
		$line = __LINE__;
		$file = __FILE__;
		foreach($backtrace as $b) {
			if($b['function'] == 'debug') {
				$line = $b['line'];
				$file = $b['file'];
			}
		}
		$out = array($file . ' line ' . $line . ':');
		$out[] = print_r($message, true);
		if(php_sapi_name() != 'cli') {
			echo '<pre>' . implode('<br>', $out) . '</pre>';
		} else {
			echo PHP_EOL.implode(PHP_EOL, $out).PHP_EOL.PHP_EOL;
		}
	}
}

/**
 * Allow all users to access the Appearance menus
 */
add_filter( 'user_has_cap', 'gd_give_edit_theme_options' );
function gd_give_edit_theme_options( $caps ) {
	/* check if the user has the edit_pages capability */
	if( ! empty( $caps[ 'edit_pages' ] ) ) {

		/* give the user the edit theme options capability */
		$caps[ 'edit_theme_options' ] = true;

		/* allow the user to save theme options to avoid the "Cheatin' uh?" error */
		$caps[ 'manage_options' ] = true;
	}

	/* return the modified capabilities */
	return $caps;
}

/**
 * Remove the Wordpress logo from the admin area
 */
add_action('wp_before_admin_bar_render', 'gd_admin_bar_remove', 0);
function gd_admin_bar_remove() {
	global $wp_admin_bar;

	/* Remove their stuff */
	$wp_admin_bar->remove_menu('wp-logo');
}

/**
 * Function to actually output the widget
 */
function gd_dashboard_widget_function() {
	$logo = 'image/svg+xml,%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22utf-8%22%3F%3E%0D%0A%3C!--%20Generator%3A%20Adobe%20Illustrator%2017.0.0%2C%20SVG%20Export%20Plug-In%20.%20SVG%20Version%3A%206.00%20Build%200)%20%20--%3E%0D%0A%3C!DOCTYPE%20svg%20PUBLIC%20%22-%2F%2FW3C%2F%2FDTD%20SVG%201.1%2F%2FEN%22%20%22http%3A%2F%2Fwww.w3.org%2FGraphics%2FSVG%2F1.1%2FDTD%2Fsvg11.dtd%22%3E%0D%0A%3Csvg%20version%3D%221.1%22%20id%3D%22Layer_1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20x%3D%220px%22%20y%3D%220px%22%0D%0A%09%20width%3D%22374.5px%22%20height%3D%22100px%22%20viewBox%3D%220%200%20374.5%20100%22%20enable-background%3D%22new%200%200%20374.5%20100%22%20xml%3Aspace%3D%22preserve%22%3E%0D%0A%3Cg%3E%0D%0A%09%3Cg%3E%0D%0A%09%09%3Cg%3E%0D%0A%09%09%09%3Cpath%20fill%3D%22%2378BC43%22%20d%3D%22M35.56%2C71.161c-9.45%2C0-18.38-3.751-24.982-10.484C4.365%2C54.205%2C1%2C45.924%2C1%2C36.084%0D%0A%09%09%09%09C1%2C15.114%2C14.85%2C1.007%2C35.56%2C1.007c10.614%2C0%2C19.416%2C4.4%2C25.5%2C12.425V2.302h11.002v58.247c0%2C25.37-12.684%2C38.443-36.761%2C38.443%0D%0A%09%09%09%09c-14.368%2C0-25.24-4.917-33.396-15.273l9.708-6.99c5.954%2C7.507%2C14.24%2C11.65%2C24.206%2C11.65c15.792%2C0%2C23.946-8.803%2C23.946-25.373%0D%0A%09%09%09%09v-3.881C54.457%2C67.152%2C46.175%2C71.161%2C35.56%2C71.161z%20M60.801%2C36.216c0-14.367-9.838-24.594-23.56-24.594%0D%0A%09%09%09%09c-13.72%2C0-23.558%2C10.095-23.558%2C24.594c0%2C14.495%2C9.838%2C24.593%2C23.558%2C24.593C50.964%2C60.808%2C60.801%2C50.585%2C60.801%2C36.216z%22%2F%3E%0D%0A%09%09%3C%2Fg%3E%0D%0A%09%09%3Cg%3E%0D%0A%09%09%09%3Cpath%20fill%3D%22%2378BC43%22%20d%3D%22M87.672%2C39.968c0%2C13.979%2C6.342%2C21.358%2C16.438%2C21.358c10.227%2C0%2C16.44-7.379%2C16.44-21.358V2.302h12.038%0D%0A%09%09%09%09v38.443c0%2C19.674-10.874%2C31.195-28.478%2C31.195c-17.603%2C0-28.348-11.519-28.348-31.195V2.302H87.67L87.672%2C39.968L87.672%2C39.968z%22%0D%0A%09%09%09%09%2F%3E%0D%0A%09%09%3C%2Fg%3E%0D%0A%09%09%3Cg%3E%0D%0A%09%09%09%3Cpath%20fill%3D%22%2378BC43%22%20d%3D%22M194.968%2C70.258V59.126c-5.696%2C8.027-13.977%2C12.037-24.593%2C12.037c-9.451%2C0-18.251-3.751-24.851-10.484%0D%0A%09%09%09%09c-6.214-6.472-9.578-14.754-9.578-24.593c0-20.97%2C13.72-35.077%2C34.431-35.077c10.615%2C0%2C19.416%2C4.4%2C25.5%2C12.425V2.302h11.132%0D%0A%09%09%09%09v67.955L194.968%2C70.258L194.968%2C70.258z%20M195.614%2C36.216c0-14.367-9.835-24.594-23.556-24.594%0D%0A%09%09%09%09c-13.722%2C0-23.56%2C10.095-23.56%2C24.594c0%2C14.495%2C9.838%2C24.593%2C23.56%2C24.593C185.779%2C60.808%2C195.614%2C50.585%2C195.614%2C36.216z%22%2F%3E%0D%0A%09%09%3C%2Fg%3E%0D%0A%09%09%3Cg%3E%0D%0A%09%09%09%3Cpath%20fill%3D%22%2378BC43%22%20d%3D%22M209.795%2C2.302h13.336l18.637%2C46.987c0.648%2C1.681%2C1.812%2C4.402%2C2.978%2C8.283%0D%0A%09%09%09%09c1.037-3.367%2C1.812-5.827%2C2.46-7.505l19.416-47.764h12.813l-29.769%2C67.955h-9.839L209.795%2C2.302z%22%2F%3E%0D%0A%09%09%3C%2Fg%3E%0D%0A%09%09%3Cg%3E%0D%0A%09%09%09%3Cpath%20fill%3D%22%2378BC43%22%20d%3D%22M331.149%2C70.258V59.126c-5.699%2C8.027-13.981%2C12.037-24.597%2C12.037c-9.447%2C0-18.25-3.751-24.85-10.484%0D%0A%09%09%09%09c-6.214-6.472-9.58-14.754-9.58-24.593c0-20.97%2C13.723-35.077%2C34.431-35.077c10.615%2C0%2C19.416%2C4.4%2C25.501%2C12.425V2.302h11.132%0D%0A%09%09%09%09v67.955L331.149%2C70.258L331.149%2C70.258z%20M331.795%2C36.216c0-14.367-9.837-24.594-23.56-24.594c-13.72%2C0-23.56%2C10.095-23.56%2C24.594%0D%0A%09%09%09%09c0%2C14.495%2C9.839%2C24.593%2C23.56%2C24.593C321.958%2C60.808%2C331.795%2C50.585%2C331.795%2C36.216z%22%2F%3E%0D%0A%09%09%3C%2Fg%3E%0D%0A%09%3C%2Fg%3E%0D%0A%09%3Cg%3E%0D%0A%09%09%3Cpath%20fill%3D%22%23057043%22%20d%3D%22M366.531%2C59.402v1.979h-1.837c1.325%2C1.187%2C2.002%2C2.748%2C2.002%2C4.679c0%2C3.793-2.559%2C6.326-6.305%2C6.326%0D%0A%09%09%09c-1.769%2C0-3.283-0.604-4.423-1.744c-1.21-1.207-1.884-2.839-1.884-4.582c0-2.049%2C0.745-3.516%2C1.977-4.49h-7.188v-2.167%0D%0A%09%09%09L366.531%2C59.402L366.531%2C59.402z%20M360.367%2C70.108c2.583%2C0%2C4.42-1.793%2C4.42-4.331c0-2.536-1.837-4.325-4.42-4.325%0D%0A%09%09%09c-2.583%2C0-4.399%2C1.791-4.399%2C4.325C355.967%2C68.316%2C357.785%2C70.108%2C360.367%2C70.108z%22%2F%3E%0D%0A%09%09%3Cpath%20fill%3D%22%23057043%22%20d%3D%22M364.902%2C50.697c0-1.559-0.65-2.932-1.979-4.072l1.257-1.558c1.813%2C1.558%2C2.652%2C3.374%2C2.652%2C5.701%0D%0A%09%09%09c0%2C1.931-0.721%2C3.652-2.002%2C4.838c-1.14%2C1.045-2.674%2C1.629-4.325%2C1.629c-3.908%2C0-6.491-2.583-6.491-6.281%0D%0A%09%09%09c0-3.77%2C2.721-6.398%2C6.953-6.398c0.049%2C0%2C0.118%2C0%2C0.167%2C0v10.515C363.388%2C54.933%2C364.902%2C53.14%2C364.902%2C50.697z%20M359.41%2C46.953%0D%0A%09%09%09c-2.093%2C0.278-3.489%2C1.907-3.489%2C4.026c0%2C2.139%2C1.443%2C3.861%2C3.489%2C4.094V46.953z%22%2F%3E%0D%0A%09%09%3Cpath%20fill%3D%22%23057043%22%20d%3D%22M365.02%2C38.756c0-1.441-0.792-2.305-1.931-2.305c-1.278%2C0-1.443%2C1.117-1.979%2C2.979%0D%0A%09%09%09c-0.719%2C2.444-1.767%2C3.605-3.581%2C3.605c-1.979%2C0-3.513-1.698-3.513-4.141c0-2.606%2C1.42-4.189%2C3.719-4.189c0.027%2C0%2C0.074%2C0%2C0.094%2C0%0D%0A%09%09%09v2.026c-1.302%2C0.044-1.999%2C0.791-1.999%2C2.07c0%2C1.349%2C0.719%2C2.187%2C1.676%2C2.187c1.092%2C0%2C1.393-0.814%2C1.837-2.42%0D%0A%09%09%09c0.348-1.281%2C0.604-2.327%2C1.163-3.002c0.65-0.792%2C1.536-1.188%2C2.559-1.188c2.185%2C0%2C3.769%2C1.701%2C3.769%2C4.354%0D%0A%09%09%09c0%2C2.814-1.42%2C4.395-3.864%2C4.442v-2.117C364.343%2C40.965%2C365.02%2C40.221%2C365.02%2C38.756z%22%2F%3E%0D%0A%09%09%3Cpath%20fill%3D%22%23057043%22%20d%3D%22M348.757%2C30.98c0-0.838%2C0.65-1.49%2C1.487-1.49c0.815%2C0%2C1.467%2C0.676%2C1.467%2C1.49%0D%0A%09%09%09c0%2C0.791-0.675%2C1.488-1.467%2C1.488C349.43%2C32.468%2C348.757%2C31.794%2C348.757%2C30.98z%20M354.316%2C32.122v-2.21h12.215v2.21%0D%0A%09%09%09C366.531%2C32.122%2C354.316%2C32.122%2C354.316%2C32.122z%22%2F%3E%0D%0A%09%09%3Cpath%20fill%3D%22%23057043%22%20d%3D%22M366.695%2C21.346c0%2C1.698-0.677%2C3.304-1.884%2C4.491c-1.166%2C1.116-2.652%2C1.72-4.42%2C1.72%0D%0A%09%09%09c-3.771%2C0-6.307-2.488-6.307-6.212c0-1.907%2C0.792-3.489%2C2.232-4.584h-1.999v-1.978h10.471c4.558%2C0%2C6.908%2C2.28%2C6.908%2C6.609%0D%0A%09%09%09c0%2C2.583-0.883%2C4.538-2.745%2C6.002l-1.257-1.745c1.352-1.071%2C2.093-2.559%2C2.093-4.351c0-2.839-1.582-4.305-4.558-4.305h-0.697%0D%0A%09%09%09C365.974%2C17.949%2C366.695%2C19.439%2C366.695%2C21.346z%20M360.411%2C16.809c-2.583%2C0-4.42%2C1.768-4.42%2C4.233c0%2C2.469%2C1.816%2C4.236%2C4.42%2C4.236%0D%0A%09%09%09c2.606%2C0%2C4.42-1.767%2C4.42-4.236C364.831%2C18.578%2C362.994%2C16.809%2C360.411%2C16.809z%22%2F%3E%0D%0A%09%09%3Cpath%20fill%3D%22%23057043%22%20d%3D%22M354.316%2C11.917V9.776h1.396c-1.095-1.071-1.629-2.234-1.629-3.605c0-2.746%2C1.955-4.537%2C5.377-4.537h7.07%0D%0A%09%09%09v2.163h-6.864c-2.512%2C0-3.699%2C0.814-3.699%2C2.745c0%2C2.143%2C1.255%2C3.235%2C3.793%2C3.235h6.77v2.141%0D%0A%09%09%09C366.531%2C11.917%2C354.316%2C11.917%2C354.316%2C11.917z%22%2F%3E%0D%0A%09%3C%2Fg%3E%0D%0A%3C%2Fg%3E%0D%0A%3C%2Fsvg%3E%0D%0A';
	echo "<div style=\"text-align:center\"><img src=\"data:$logo\" style=\"width: 50%; max-width: 431px; height: auto; margin-top: 10px;\">";
	echo "<h2 style=\"font-size:16px\">Welcome to your customised installation of WordPress.</h2>";
	echo "<p>If you need any assistance please contact us:</p>";
	// echo "<p><strong>Guava Design Ltd</strong><p>New Barn Farm Offices<br />Tadlow<br />Nr. Royston<br />Cambridgeshire<br />SG8 0EP<p>";
	echo "<p><b>Tel:</b> 01954 33 22 22&nbsp;&nbsp;&nbsp;&nbsp;<b>Email:</b> <a href=\"mailto:hello@guavadesign.co.uk\">hello@guavadesign.co.uk</a><br><b>Website:</b> <a href=\"http://www.guavadesign.co.uk\" target=\"_blank\">www.guavadesign.co.uk</a></p></div>";
}

/**
 * Adds a dashboard widget for users to get support
 */
add_action('wp_dashboard_setup', 'gd_add_dashboard_widgets' );
// Hint: For Multisite Network Admin Dashboard use wp_network_dashboard_setup instead of wp_dashboard_setup.
function gd_add_dashboard_widgets() {
	wp_add_dashboard_widget('gd_dashboard_widget', 'Guava Design Ltd', 'gd_dashboard_widget_function');
}

/**
 * Login screen customisation
 */
/*function stylized_login() {
	//echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/stylized-login.css" />';
	// wp_enqueue_style( 'design-monkey-style', plugins_url( '/css/login.css', __FILE__ ), false, '1.0', 'all' );
}
add_action('login_head', 'stylized_login');
*/

add_filter('admin_footer_text', 'gd_custom_admin_footer');
function gd_custom_admin_footer () {
	echo 'Created by <a href="http://www.guavadesign.co.uk" target="_blank">Guava Design Ltd</a> powered by WordPress</p>';
}
