  <div class="wrap">
	<?php 
		$base_url = $whitePaperInt->get_siteURL() . "/wp-admin/admin.php?page=" . 
		$whitePaperInt->get_folder() . "/" . $whitePaperInt->get_folder() . ".php"; ?>

  	<?php
		$columns = array(
							'select' => 'Select',
							'cat_name' => 'Group Name',
							'edit' => 'Edit Group'
					);
		register_column_headers('pro-list-site', $columns);     
	?>
    <?php    
		echo "<h2>" . __( 'Groups Listing' ) . "</h2>"; ?>
		<br />
		<div id="button">
			<a href="<?php echo $base_url; ?>"> Add new Group </a>
		</div>
		<div id="button">
			<a href="#" onclick="document.getElementById('form_delete').submit();" > Delete Group </a>
		</div>
		<br />
		<form action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>" method="post" id="form_delete" >
		<table class="widefat page fixed" cellspacing="0">
		  <thead>
			<tr>
				<?php print_column_headers('pro-list-site'); ?>
			</tr>
		  </thead>
		  <tfoot>
			<tr>
				<?php print_column_headers('pro-list-site', false); ?>
			</tr>
		  </tfoot>
		  <tbody>		
			<?php
				if(count($results) > 0)
				{
						foreach($results as $result)
						{
							$cat_id = $result->cat_id;
			?>
							<tr>
								<td> 
									<input type='checkbox' 
											name='category_che[]' 
											id='category_che[]'  value="<?php echo $cat_id; ?>" />
								</td>
								<td> <?php echo $result->cat_name; ?> </td>
								<td> 
									<?php $edit_url = $base_url . "&edit=1&cat_id=" . $cat_id; ?>
									<a href="<?php echo $edit_url; ?>"> Edit </a> 
								</td>
							</tr>                        
			<?php			
						}
				}
				else
				{
			?>
							<tr align="left">
								<td colspan="3"> 
									<h4> No Groups Added yet. </h4>
								</td>
							</tr>                        					
			<?php
				}
			?>
			<input type="hidden" name="submit_delete" value="delete" />
		  </tbody>
		</table>
	</form>
  </div>
