<?php
/*

Plugin Name: Click4Assistance Live Web Chat Software UK Provider
Plugin URI: http://wordpress.org/extend/plugins/Click4Assistance/
Description: Click4Assistance is the premier UK based Live Chat Software Provider. Allow visitors on your website to start a live chat, or you can proactively push an invitation asking if they need assistance, you can even monitor visitors in real-time while they browser your website. 1) Click the "Activate" link on the left of this description, 2) <a href="https://www.click4assistance.co.uk/live-chat-software-free-trial" target="_blank">Sign up for a Click4Assistance key</a>, and 3) Go to your <a href="/wp-admin/options-general.php?page=Click4Assistance_Settings_Panel">Settings/Click4Assistance</a> configuration page, and save your keys.
Version: 2.0
Author: Click4Assistance
Author URI: https://www.click4assistance.co.uk

License: GPLv2

*/

register_activation_hook(__FILE__, 'activate_Click4Assistance');

register_deactivation_hook(__FILE__, 'deactive_Click4Assistance');



function activate_Click4Assistance() {

	add_option('Click4Assistance_plugin_Account_GUID', '');


}

function deactive_Click4Assistance() {

	delete_option('Click4Assistance_plugin_Account_GUID');


}



// Import the form and validation script


function Click4Assistance_admin() {

	include('Click4Assistance_import_admin.php');

}





// Add the menu item to a sub menu of Settings.		



add_action('admin_menu', 'Click4Assistance_admin_actions');


function Click4Assistance_admin_actions() {

	add_options_page("Click4Assistance", "Click4Assistance", 1, "Click4Assistance_Settings_Panel", "Click4Assistance_admin");

}


// Creating the shortcode function


add_shortcode("C4AChatButton", "C4AChatButtonRender");


function C4AChatButtonRender( $atts, $content = null ) {  



        $Click4Assistance_plugin_Account_GUID = get_option('Click4Assistance_plugin_Account_GUID');  



echo '<script type="text/javascript" >

function InitialiseC4A() {

	/* Chat Tool */

	var Tool16 = new C4A.Tools(1); 

	C4A.Run(\''.$Click4Assistance_plugin_Account_GUID.'\');

}

</script>

<noscript><a href="https://www.click4assistance.co.uk/add-live-chat-software-click4assistance-uk" target="_blank" style="font-size:10px;position:fixed;bottom:2px;right:2px;">Click4Assistance UK Live Chat Software</a></noscript>

<script src="https://v4in1-si.click4assistance.co.uk/SI.js" type="text/javascript" defer="defer"></script>'  ;

}




// Add the tracking code to the footer of every page

add_action ('wp_footer', 'add_tracking_code_to_footer');

add_action ('wp_footer', 'add_embeddedchat_code_to_footer');

function add_tracking_code_to_footer() {

	// Check its enabled

	$Click4Assistance_plugin_EnableTrackingAndProactiveInvitations = get_option('Click4Assistance_plugin_EnableTrackingAndProactiveInvitations');

 	if ($Click4Assistance_plugin_EnableTrackingAndProactiveInvitations == "OFF")

		return;

	if (CheckConfiguration()==false) return;

	$Click4Assistance_plugin_Account_GUID = get_option('Click4Assistance_plugin_Account_GUID');  


echo '<script type="text/javascript" >

function InitialiseC4A() {

	/* Chat Tool */

	var Tool16 = new C4A.Tools(1); 

	C4A.Run(\''.$Click4Assistance_plugin_Account_GUID.'\');

}

</script>



<noscript><a href="https://www.click4assistance.co.uk/add-live-chat-software-click4assistance-uk" target="_blank" style="font-size:10px;position:fixed;bottom:2px;right:2px;">Click4Assistance UK Live Chat Software</a></noscript>

<script src="https://v4in1-si.click4assistance.co.uk/SI.js" type="text/javascript" defer="defer"></script>'  ;


}

function add_embeddedchat_code_to_footer() {


	$Click4Assistance_plugin_Account_GUID = get_option('Click4Assistance_plugin_Account_GUID');  


	if (CheckConfiguration()==false) return; 


	echo '<script type="text/javascript" >

function InitialiseC4A() {

	/* Chat Tool */

	var Tool16 = new C4A.Tools(1); 

	C4A.Run(\''.$Click4Assistance_plugin_Account_GUID.'\');

}

</script>



<noscript><a href="https://www.click4assistance.co.uk/add-live-chat-software-click4assistance-uk" target="_blank" style="font-size:10px;position:fixed;bottom:2px;right:2px;">Click4Assistance UK Live Chat Software</a></noscript>



<script src="https://v4in1-si.click4assistance.co.uk/SI.js" type="text/javascript" defer="defer"></script>'  ;

}

// Create the widget


add_action( 'widgets_init', 'click4assistance_widget' );

function click4assistance_widget() {

	register_widget( 'Click4Assistance_Widget' );

}


class Click4Assistance_Widget extends WP_Widget {

	function Click4Assistance_Widget() {

		$widget_ops = array( 'classname' => 'Click4Assistance_Widget', 'description' => __('A widget that displays the Click4Assistance chat button ', 'click4assistance') );

		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'click4assistance-widget' );

		parent::__construct( 'click4assistance-widget', __('Click4Assistance Widget', 'click4assistance'), $widget_ops, $control_ops );

	}


function widget( $args, $instance ) {

	extract( $args );

	echo $before_widget;

	if (CheckConfiguration ()==false) return;

	// Get the guids and update the chat script

        $Click4Assistance_plugin_Account_GUID = get_option('Click4Assistance_plugin_Account_GUID');  


	echo '<script type="text/javascript" >

function InitialiseC4A() {

	/* Chat Tool */

	var Tool16 = new C4A.Tools(1); 

	C4A.Run(\''.$Click4Assistance_plugin_Account_GUID.'\');

}

</script>

<noscript><a href="https://www.click4assistance.co.uk/add-live-chat-software-click4assistance-uk" target="_blank" style="font-size:10px;position:fixed;bottom:2px;right:2px;">Click4Assistance UK Live Chat Software</a></noscript>

<script src="https://v4in1-si.click4assistance.co.uk/SI.js" type="text/javascript" defer="defer"></script>'  ;

	echo $after_widget;


	}

	//Update the widget 

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		#No updates are done here


		return $instance;

	}

	function form( $instance ) {

		//Warn user the settings are inputted from control page

		echo "Please make sure you have updated your settings in Settings > Click4Assistance";

	}


}



function CheckConfiguration ()


{

	$Click4Assistance_plugin_Account_GUID = get_option('Click4Assistance_plugin_Account_GUID');  


	if ($Click4Assistance_plugin_Account_GUID == "" )

	{


		echo '<div style="position:fixed;bottom:0em;right:1em;z-index:99999; width:350px; height:250px; background-color:#e10019; padding:8px;">

		<div style="color:#e10019; background-color:#fff; border:solid 4px #e10019; font-size:14px; font-family:Tahoma; padding:4px; font-weight:bold; text-align:center;">Configure your Click4Assistance chat button</div>

		<div style="color:#fff; background-color:#e10019; border:solid 4px #e10019; font-size:14px; font-family:Tahoma; padding:4px; text-align:center;">Enter your Click4Assistance details within your Wordpress Dashboard under  &#34;Settings / Click4Assistance&#34;.<br><br>If you haven’t registered or need help, visit <a href="https://www.click4assistance.co.uk/live-chat-software-free-trial" target="_blank" style="color:#fff; text-decoration:underline;">www.click4assistance.co.uk/live-chat-software-free-trial</a></div>

		</div>';

		return false;	

	}

	else {

		return true;

	}

}


?>