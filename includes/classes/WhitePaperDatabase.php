<?php
	class WhitePaperDatabase extends WhitePaperInit
	{
		public $wpdb;
		public $table_prefix;
		
		function __construct($wpdb) 
		{
			$this->wpdb = $wpdb;
			$this->table_prefix = $this->wpdb->prefix;	
		}
		
		/*********************************************************************************/
		/*
		 *	Database Instantiation 
		 * */
		/*********************************************************************************/
				
		/*
		 * Function : init() - that is used to initialize the
		 * database functions that need to be used.
		 * */
		function init()
		{			
			/* Initialize the Tables */
			/* settings table */
			$table = $this->table_prefix . "white_paper_settings";
			$structure = "CREATE TABLE $table (
				name varchar(500) NOT NULL
			);";
			$this->wpdb->query($structure);
			
			/* Insert blank initially in settings table */
			$table = $this->table_prefix . "white_paper_settings";
			$structure = "INSERT INTO $table VALUES ('');";
			$this->wpdb->query($structure);
			
			/* category table */
			$table = $this->table_prefix . "category";
			$structure = "CREATE TABLE $table (
				cat_id integer(11) NOT NULL AUTO_INCREMENT,
				cat_name VARCHAR(500) NOT NULL,
				PRIMARY KEY (cat_id)
			);";
			$this->wpdb->query($structure);
			
			/* whitepaper table */			
			$table = $this->table_prefix . "whitepaper";
			$structure = "CREATE TABLE $table (
				w_id integer(11) NOT NULL AUTO_INCREMENT,
				w_name varchar(500) NOT NULL,
				description text NOT NULL,
				location varchar(500) NOT NULL,
				c_id integer(11) NOT NULL,
				PRIMARY KEY (w_id)
			);";
			$this->wpdb->query($structure);			

			/* detail table */
			$table = $this->table_prefix . "details";
			$structure = "CREATE TABLE $table (
				detail_id integer(11) NOT NULL AUTO_INCREMENT,
				name varchar(500) NOT NULL,
				email varchar(500) NOT NULL,
				company varchar(500) NOT NULL,
				about varchar(500) NOT NULL,
				PRIMARY KEY (detail_id)
			);";
			$this->wpdb->query($structure);
		}
		
		/*
		 * Fucntion : finish() - this is used to drop all the data
		 * in the database and the database itself after plugin
		 * is unistalled.
		 * */
		function finish()
		{
			$table = $this->table_prefix . "white_paper_settings";
			$structure = "drop table if exists $table";
			$this->wpdb->query($structure);
			
			$table = $this->table_prefix . "category";
			$structure = "drop table if exists $table";
			$this->wpdb->query($structure);

			$table = $this->table_prefix . "whitepaper";
			$structure = "drop table if exists $table";
			$this->wpdb->query($structure);

			$table = $this->table_prefix . "details";
			$structure = "drop table if exists $table";
			$this->wpdb->query($structure);
		}
		
		/*********************************************************************************/
		/*
		 *	CRUD Operations of Groups(Categories) 
		 * */
		/*********************************************************************************/		
	
		/*
		 * Fucntion : add_category() - 
		 * Function to add a new category to database
		 * */
		function add_category($category){	
			$table = $this->table_prefix . "category";
			$structure = "INSERT INTO $table VALUES (null,'$category');";
			$this->wpdb->query($structure);
			return true;			
		}
		
		
		/*
		 * Fucntion : get_all_categories() - 
		 * Function that gets all the categories from the database
		 * */				
		function get_all_categories()
		{
			$table = $this->table_prefix . "category";
			$sql = "SELECT * FROM $table;";
			$results = $this->wpdb->get_results($sql);
			return $results;
		}
		
		/*
		 * Function : get_single_category() -
		 * Function that gets one category depending on cat_id
		 * */
		 function get_single_category($cat_id)
		 {
			 $table = $this->table_prefix . "category";
			 $sql = "SELECT * FROM $table where cat_id = $cat_id;";
			 $results = $this->wpdb->get_results($sql);
			 return $results;
		 }
		 
		/*
		 * Function : edit_category() -
		 * Function that edits a category depending on the cat_id
		 * */		
		 function edit_category($cat_id ,$category_name)
		 {
			$table = $this->table_prefix . "category";
			$structure = "UPDATE $table SET cat_name = '$category_name' where cat_id = $cat_id;";
			$this->wpdb->query($structure);
			return true;
		 }
		 
		/*
		* Function - delete_category() -
		* Function that deletes one category at a time
		* */
		function delete_category($cat_id)
		{
			$table = $this->table_prefix . "category";
			$structure = "DELETE FROM $table where cat_id = $cat_id;";
			$this->wpdb->query($structure);
			return true;
		}
		 
		/*********************************************************************************/
		/*
		 *	CRUD Operations for White paper Management
		 * */
		/*********************************************************************************/			 
		
		/*
		 * Function - add_new_whitepaper() -
		 * Function adds a new whitepaper
		 * */
		function add_new_whitepaper($paper_name, $paper_desc, $paper_location, $paper_group)
		{
			$table = $this->table_prefix . "whitepaper";
			$structure = "INSERT INTO $table VALUES (null,'$paper_name', '$paper_desc', '$paper_location', $paper_group);";
			$this->wpdb->query($structure);
			return true;			
		}
		
		/*
		 * Function - get_all_whitepapers() -
		 * Function that gets all details of white papers
		 * */		
		function get_all_whitepapers($group = 'all')
		{
            $table_wp = $this->table_prefix . "whitepaper";
            $table_wc = $this->table_prefix . "category";

            if($group == "all")
            {
                $sql = "SELECT * FROM $table_wp;";
            }
            else
            {
                /*
                    SELECT *
                    FROM  `wp_whitepaper` wp,  `wp_category` wc
                    WHERE wp.`c_id` = wc.`cat_id`
                    AND wc.`cat_name` =  'Chinese Chow Chow'
                 * */
                $sql = "SELECT * FROM $table_wp wp, $table_wc wc
                    WHERE wp.`c_id` = wc.`cat_id`
                    AND wc.`cat_name` =  '$group';";
            }
			$results = $this->wpdb->get_results($sql);
			return $results;
		}
		
		/*
		 * Function - delete_whitepaper() -
		 * Function that deletes one category at a time
		 * */
		function delete_whitepaper($cat_id)
		{
			$table = $this->table_prefix . "whitepaper";
			$structure = "DELETE FROM $table where w_id = $cat_id;";
			$this->wpdb->query($structure);
			return true;
		}
						
		/*
		 * Function : get_single_whitepaper() -
		 * Function that gets one whitepaper data depending on wp_id
		 * */
		function get_single_whitepaper($w_id)
		{
			$table = $this->table_prefix . "whitepaper";
			$sql = "SELECT * FROM $table where  w_id = $w_id;";
			$results = $this->wpdb->get_results($sql);
			return $results;
		}
		
		/*
		 * Function : edit_whitepaper() -
		 * Function that edits one whitepaper data depending on wp_id
		 * */
		function edit_whitepaper($wp_id, $paper_name, $paper_desc, $paper_location, $paper_group)
		{
			$table = $this->table_prefix . "whitepaper";
			$structure = "UPDATE $table SET w_name = '$paper_name', description = '$paper_desc', location = '$paper_location', c_id = $paper_group where w_id = $wp_id;";
			$this->wpdb->query($structure);
			return true;			
		}
		
		/*********************************************************************************/
		/*
			*	CRUD Operations for White paper Downloads
		 * */
		/*********************************************************************************/			 
		
		/*
		 * Function - add_new_detail() -
		 * Function that adds new datail in the database
		 * */	
		
		function add_new_detail($name ,$email, $company, $heard)
		{
			$table = $this->table_prefix . "details";
			$structure = "INSERT INTO $table VALUES (null,'$name', '$email', '$company', '$heard');";
			$this->wpdb->query($structure);
			return true;
		}
		
		/*********************************************************************************/
		/*
			*	CRUD Operations for White paper Email Update
		 * */
		/*********************************************************************************/			 
		
		/*
		 * Function - whitepaper_update_email() -
		 * Function that updates email
		 * */	
		
		function whitepaper_update_email($email)
		{
			$table = $this->table_prefix . "white_paper_settings";
			$structure = "UPDATE $table SET name = '$email';";
			$this->wpdb->query($structure);
			return true;
		}
		
		/*
		 * Function - get_sending_email() -
		 * Function that retrives the email
		 * */	
		function get_sending_email()
		{
			$table = $this->table_prefix . "white_paper_settings";
			$sql = "SELECT * FROM $table;";
			$results = $this->wpdb->get_results($sql);
			foreach($results as $result)
			{
				$white_paper_email = $result->name;
			}
			return $white_paper_email;
		}
	}
?>