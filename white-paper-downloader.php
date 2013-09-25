<?php
/*
	Plugin Name: Whitepaper Leads
	Plugin URI: http://wpfog.com
	Description: This is a downloader that allows the user to create a downloader for his white papers.
	Author: WPfog
	Version: 1.0.2
	Author URI: http://wpfog.com
*/

define('WHITEPAPER_URL', WP_PLUGIN_URL . "/" . dirname( plugin_basename( __FILE__ ) ) );
define('WHITEPAPER_PATH', WP_PLUGIN_DIR ."/" .dirname( plugin_basename( __FILE__ ) ) );
 
include ("includes/classes/WhitePaperInit.php");
include ("includes/classes/WhitePaperDatabase.php");
include ("includes/classes/Validation.php");

/* Global Variables */
global $wpdb;

/* Collect all the data required for the app */
$folder = dirname(plugin_basename(__FILE__));
$siteURL = get_option('siteurl');
$url = $siteurl . '/wp-content/plugins/' . $folder;
$file_path = dirname(__FILE__);
$dirName = basename(PRO_FILE_PATH);

/* Call the init Class to instantiate the app settings */
$whitePaperInt = new WhitePaperInit($folder, $url, $file_path, $dirName, $siteURL);

/* create on install and on_uninstall events  */
register_activation_hook(__FILE__,'whitepaper_install');
register_deactivation_hook(__FILE__ , 'whitepaper_uninstall' );

/* Function called on install */
function whitepaper_install()
{
	global $wpdb;
	$database = new WhitePaperDatabase($wpdb);
	$database->init();
}

/* Function that is called on uninstall */
function whitepaper_uninstall()
{
	global $wpdb;
	$database = new WhitePaperDatabase($wpdb);
	$database->finish();
}

add_action('admin_menu','whitepaper_admin_menu');

/* Function that creates admin menu */
function whitepaper_admin_menu() {
	global $whitePaperInt;
	add_menu_page(
					"White Paper",
					"White Papers",
					8,
					__FILE__,
					"whitepaper_manage_category"
				);
	add_submenu_page(__FILE__,
					'Manage Paper',
					'Manage Group',
					'8',
					__FILE__,
					'whitepaper_manage_category'
					);
	add_submenu_page(__FILE__,
					'Manage Paper',
					'Manage Paper',
					'8',
					'list-site',
					'whitepaper_managepaper');
	add_submenu_page(__FILE__,
					'Manage Paper',
					'Settings',
					'8',
					'whitepaper-settings',
					'whitepaper_settings');
}

/*
 * Function - whitepaper_settings() -
 * Function that manages settings of whitepaper
 * */
 function whitepaper_settings()
 {
	 /* Code for Settings */
	 if(isset($_POST['submit_add_settings'])) 
	 {
		 global $whitePaperInt;
		 $error_list = "";            
		 $email = trim($_POST['whitepaper_settings_email']);
		 
		 /* Validate the data */
		 if(!Validation::validate_notBlank($email))
		 {
			 $error_list = "Email cannot be left blank. <br />";                                             
		 }
		 
		 /* If the data is NOT Validated */
		 if($error_list != "") {
			 include "views/manage_settings.php";                 
		 }
		 /* If the data is Validated */
		 else { 
			 global $wpdb;
			 $database = new WhitePaperDatabase($wpdb);
			 $result = $database->whitepaper_update_email($email);
			 if($result)
			 {
				 /*$redirect_url = $whitePaperInt->get_siteURL() . "/wp-admin/admin.php?page=" . $whitePaperInt->get_folder() . "/" . $whitePaperInt->get_folder() . ".php&success=1";
				 header("Location:$redirect_url");*/
				 $success = "Email Successfully Edited.";
				 include "views/manage_settings.php";
			 }
		 }
	 }
	 else
	 {
         global $wpdb;
         $database = new WhitePaperDatabase($wpdb);
         $sending_email = $database->get_sending_email();
		 include "views/manage_settings.php";
	 }
 }


/*
 * Function - whitepaper_manage_category() -
 * Function that manages CRUD Operations of Whitepaper Group
 * */
function whitepaper_manage_category()
{
	global $whitePaperInt;
	
	/* Pull all the category listing */
	global $wpdb;
	$database = new WhitePaperDatabase($wpdb);
	$results = $database->get_all_categories();
	
	/* Code for ADD Category */
	if(isset($_POST['submit_add'])) 
	{
		global $whitePaperInt;
		$error_list = "";            
		$category = trim($_POST['whitepaper_catrgory']);
		
		/* Validate the data */
		if(!Validation::validate_notBlank($category))
		{
			$error_list = "Group Name cannot be left blank. <br />";                                             
		}
		else 
		{
			if(!Validation::validate_forOnlyCharacters($category))
			{
				$error_list = "Special Characters not allowed.";
			}
		}
		
		/* If the data is NOT Validated */
		if($error_list != "") {
			include "views/manage_category_display.php";                 
		}
		/* If the data is Validated */
		else { 
			global $wpdb;
			$database = new WhitePaperDatabase($wpdb);
			$result = $database->add_category($category);
			if($result)
			{
				/*$redirect_url = $whitePaperInt->get_siteURL() . "/wp-admin/admin.php?page=" . $whitePaperInt->get_folder() . "/" . $whitePaperInt->get_folder() . ".php&success=1";
				header("Location:$redirect_url");*/
				$database = new WhitePaperDatabase($wpdb);
				$results = $database->get_all_categories();
				$success = "Group Successfully Added.";
				include "views/manage_category_display.php";
			}
		}
	}
	/* Code for Delete Category */
	else if(isset($_POST['submit_delete']))
	{
		$delete_id = $_POST['category_che'];
		$countCheck = count($delete_id);
		
		/* Connect to database */
		$database = new WhitePaperDatabase($wpdb);
		for($i=0 ; $i < $countCheck ; $i++)
		{
			$del_id  = $delete_id[$i];
			/* Query it */
			$database->delete_category($del_id);
		}
		global $wpdb;
		$database = new WhitePaperDatabase($wpdb);
		$results = $database->get_all_categories();				
		$success = "Group successfully Deleted.";
		include "views/manage_category_display.php";
	}	
	/* Code for EDIT Category */
	else if(isset($_GET['edit'])) {
		/* Database interactions for EDIT Category */
		if(isset($_GET['cat_id']) && isset($_POST['whitepaper_cat_id']))
		{
			$category_name = $_POST['whitepaper_category_adit'];
			$cat_id = $_POST['whitepaper_cat_id'];
			global $wpdb;
			$database = new WhitePaperDatabase($wpdb);
			$flag = $database->edit_category($cat_id ,$category_name);
			if($flag)
			{
				global $wpdb;
				$database = new WhitePaperDatabase($wpdb);
				$results = $database->get_all_categories();				
				$success = "Group Successfully Updated.";
				include "views/manage_category_display.php";
			}
		}
		/* Code to display EDIT Category page */
		else
		{
			$cat_id = $_GET['cat_id'];
			$database = new WhitePaperDatabase($wpdb);
			$single_result = $database->get_single_category($cat_id);
			foreach($single_result as $result)
			{
				$cat_name = $result->cat_name;
			}
			include "views/edit_category_display.php";			
		}
	}
	else {
		include "views/manage_category_display.php";
	}	
}

/*
 * Function - whitepaper_managepaper() -
 * Function that manages CRUD Operations of Whitepaper
 * */
function whitepaper_managepaper()
{
	global $whitePaperInt;
	global $wpdb;
	
	/* Code for ADD Whitepaper */
	if(isset($_POST['submit_add_white_paper']))
	{
		$paper_name = str_replace("'", "\'", trim($_POST['whitepaper_name']));
		$paper_desc = str_replace("'", "\'", trim($_POST['whitepaper_desc']));
		$paper_location = str_replace("'", "\'", trim($_POST['whitepaper_location']));
		$paper_group = str_replace("'", "\'", trim($_POST['whitepaper_group']));
		
		$error_flag = 0;
		$error_list = array();
		
		/* Validate the data */
		if(!Validation::validate_notBlank($paper_name))
		{
			$error_list[] = "Paper Title cannot be left blank.";
			$error_flag = 1;
		}
		
		if(!Validation::validate_notBlank($paper_desc)) 
		{
			$error_list[] = "Paper Description cannot be left blank.";
			$error_flag = 1;
		}
		
		if(!Validation::validate_notBlank($paper_location)) 
		{
			$error_list[] = "URL cannot be left blank.";
			$error_flag = 1;
		}
		
		if(!Validation::validate_notBlank($paper_group)) 
		{
			$error_list[] = "Group be left blank.";
			$error_flag = 1;
		}
		
		/* If the data is NOT Validated */
		if($error_flag == 1) {
			$database = new WhitePaperDatabase($wpdb);
			$results = $database->get_all_categories();			
			$whitepaper_details = $database->get_all_whitepapers();
			include "views/manage_paper_display.php";                 
		}
		/* If the data is Validated */
		else 
		{ 
			$database = new WhitePaperDatabase($wpdb);
			$add_result = $database->add_new_whitepaper($paper_name, $paper_desc, $paper_location, $paper_group);
			if($add_result)
			{
				$paper_name = "";
				$paper_desc = "";
				$paper_location = "";
				$paper_group = "";
				/*$redirect_url = $whitePaperInt->get_siteURL() . "/wp-admin/admin.php?page=" . $whitePaperInt->get_folder() . "/" . $whitePaperInt->get_folder() . ".php&success=1";
				header("Location:$redirect_url");*/
				$database = new WhitePaperDatabase($wpdb);
				$results = $database->get_all_categories();			
				$whitepaper_details = $database->get_all_whitepapers();
				
				$success = "Whitepaper Successfully Added.";
				include "views/manage_paper_display.php";
			}		
		}
	}
	/* Code for Delete whitepaper*/
	else if(isset($_POST['submit_white_paper_delete']))
	{
		$delete_id = $_POST['whitepaper_che'];
		$countCheck = count($delete_id);
		
		/* Connect to database */
		$database = new WhitePaperDatabase($wpdb);
		for($i=0 ; $i < $countCheck ; $i++)
		{
			$del_id  = $delete_id[$i];
			/* Query it */
			$database->delete_whitepaper($del_id);
		}
		$success = "whitepaper successfully Deleted.";
		$database = new WhitePaperDatabase($wpdb);
		$results = $database->get_all_categories();
		$whitepaper_details = $database->get_all_whitepapers();
		include "views/manage_paper_display.php";
	}
	/* Code for EDIT whitepaper */
	else if(isset($_GET['edit_whitepaper'])) {
		/* Database interactions for EDIT whitepaper */
		if(isset($_GET['wp_id']) && isset($_POST['submit_edit_white_paper']))
		{
			$paper_name = str_replace("'", "\'", trim($_POST['whitepaper_name']));
			$paper_desc = str_replace("'", "\'", trim($_POST['whitepaper_desc']));
			$paper_location = str_replace("'", "\'", trim($_POST['whitepaper_location']));
			$paper_group = str_replace("'", "\'", trim($_POST['whitepaper_group']));
			
			$error_flag = 0;
			$error_list = array();
			
			/* Validate the data */
			if(!Validation::validate_notBlank($paper_name))
			{
				$error_list[] = "Paper Title cannot be left blank.";
				$error_flag = 1;
			}
			
			if(!Validation::validate_notBlank($paper_desc)) 
			{
				$error_list[] = "Paper Description cannot be left blank.";
				$error_flag = 1;
			}
			
			if(!Validation::validate_notBlank($paper_location)) 
			{
				$error_list[] = "URL cannot be left blank.";
				$error_flag = 1;
			}
			
			if(!Validation::validate_notBlank($paper_group)) 
			{
				$error_list[] = "Group be left blank.";
				$error_flag = 1;
			}
			
			/* If the data is NOT Validated */
			if($error_flag == 1) {
				$database = new WhitePaperDatabase($wpdb);
				$results = $database->get_all_categories();			
				$whitepaper_details = $database->get_all_whitepapers();
				include "views/manage_paper_display.php";                 
			}
			/* If the data is Validated */
			else 
			{
				$wp_id = $_GET['wp_id'];
				$database = new WhitePaperDatabase($wpdb);
				$edit_result = $database->edit_whitepaper($wp_id, $paper_name, $paper_desc, $paper_location, $paper_group);
				if($edit_result)
				{
					$paper_name = "";
					$paper_desc = "";
					$paper_location = "";
					$paper_group = "";
					/*$redirect_url = $whitePaperInt->get_siteURL() . "/wp-admin/admin.php?page=" . $whitePaperInt->get_folder() . "/" . $whitePaperInt->get_folder() . ".php&success=1";
					header("Location:$redirect_url");*/
					$database = new WhitePaperDatabase($wpdb);
					$results = $database->get_all_categories();			
					$whitepaper_details = $database->get_all_whitepapers();
					
					$success = "Whitepaper Successfully Edited.";
					include "views/manage_paper_display.php";
				}		
			}
		}
		/* Code to display EDIT Whitepaper page */
		else
		{
			$wp_id = $_GET['wp_id'];
			$database = new WhitePaperDatabase($wpdb);
			$single_result = $database->get_single_whitepaper($wp_id);
			foreach($single_result as $result)
			{
				$wp_id = $result->w_id;
				$paper_name = $result->w_name;
				$paper_desc = $result->description;
				$paper_location = $result->location;
				$paper_group = $result->c_id;
			}
			$database = new WhitePaperDatabase($wpdb);
			$results = $database->get_all_categories();
			$whitepaper_details = $database->get_all_whitepapers();			
			include "views/edit_whitepaper_display.php";			
		}
	}	
	else
	{
		$database = new WhitePaperDatabase($wpdb);
		$results = $database->get_all_categories();
		$whitepaper_details = $database->get_all_whitepapers();
		include "views/manage_paper_display.php";
	}
}


/**--------------------------------------------------
 * Function to display white paper in page
 ---------------------------------------------------*/

add_shortcode("whitepaper_display","whitepaper_display_all_function");

function whitepaper_display_all_function($atts) 
{
    $group = "";
    extract( shortcode_atts( array(
        'group' => 'all',
    ), $atts ));

    $name = $_GET['name'];
	global $wpdb;
	global $whitePaperInt;
	$database = new WhitePaperDatabase($wpdb);
	$results = $database->get_all_whitepapers($group);
	include "views/view_includes/display_whitepapers.php";
}


/**--------------------------------------------------
 * Function to display white paper in widget
---------------------------------------------------*/

add_shortcode("whitepaper_display_widget","whitepaper_display_in_widget");

function whitepaper_display_in_widget($atts)
{
    $group = "";
    extract( shortcode_atts( array(
        'group' => 'all',
    ), $atts ));

    $name = $_GET['name'];
    global $wpdb;
    global $whitePaperInt;
    $database = new WhitePaperDatabase($wpdb);
    $results = $database->get_all_whitepapers($group);
    include "views/view_includes/display_whitepapers_widget.php";
}


/* Code for enqueing scripts in wordpress */
function ajaxcontact_enqueuescripts()
{
	wp_enqueue_script('whitepaper_script', WHITEPAPER_URL . '/js/whitepaper_script.js', array('jquery'));
	wp_localize_script('whitepaper_script', 'whitepaper_script_ajax', array('ajaxurl' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', ajaxcontact_enqueuescripts);
	
/*
 * Function : ajaxcontact_send_mail() -
 * Function that is called form the client and manages the ajax request
 * */
function ajaxcontact_send_mail()
{
	$name = $_POST['white_paper_name'];
	$email = $_POST['white_paper_email'];
	$company = $_POST['white_paper_company'];
	$heard = $_POST['white_paper_heard_from'];
	$file_title = $_POST['file_title'];//add file name here to send file info
	global $wpdb;
	$database = new WhitePaperDatabase($wpdb);
	$flag = $database->add_new_detail($name ,$email, $company, $heard);
		
	
	global $wpdb;
	$database = new WhitePaperDatabase($wpdb);
	$email_sender = $database->get_sending_email();
	
	
	$message = "Following user downloaded the Whitepaper
				Name : $name <br />
				email-id : $email <br />
				Company : $company <br />
				The person heard us from : $heard <br />
				The downloaded file is: $file_title";
	$to = $email_sender;
	$subject = "Whitepaper Downloaded";
	
	add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
	wp_mail($to, $subject, $message);

	die();
}

/* creating Ajax call for WordPress */
add_action( 'wp_ajax_nopriv_ajaxcontact_send_mail', 'ajaxcontact_send_mail');
add_action( 'wp_ajax_ajaxcontact_send_mail', 'ajaxcontact_send_mail');	
?>