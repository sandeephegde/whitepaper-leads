<div class="wrap">
<?php 
	$base_url = $whitePaperInt->get_siteURL() . "/wp-admin/admin.php?page=list-site";
?>

<?php
	$columns = array(
						'select' => 'Select',
						'white_paper_title' => 'Title',
						'white_paper_desc' => 'Description',
						'white_paper_url' => 'URL',
						'edit' => 'Edit',
				);
	register_column_headers('pro-list-site', $columns);     
?>
<?php    
	echo "<h2>" . __( 'White paper listing' ) . "</h2>"; ?>
	<br />
	<div id="button">
		<a href="<?php echo $base_url; ?>"> Add new Whitepaper </a>
	</div>
	<div id="button">
		<a href="#" onclick="document.getElementById('form_delete_whitepapaper').submit();" > Delete Whitepaper </a>
	</div>
	<br />
	<form action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>" 
	method="post"
	id="form_delete_whitepapaper" >
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
			if(count($whitepaper_details) > 0)
			{
					foreach($whitepaper_details as $result)
					{
						$wp_id = $result->w_id;
						$wp_title = $result->w_name;
						$wp_desc = substr($result->description, 0, 50);
						$wp_url = $result->location;
		?>
						<tr>
							<td> 
								<input type='checkbox' 
										name='whitepaper_che[]' 
										id='whitepaper_che[]'  value="<?php echo $wp_id; ?>" />
							</td>
							<td> <?php echo $wp_title; ?> </td>
							<td> <?php echo $wp_desc; ?>... </td>
							<td> <?php echo $wp_url; ?> </td>
							<td> 
								<?php $edit_url = str_replace( '%7E', '~', $_SERVER['REQUEST_URI']) . "&edit_whitepaper=1&wp_id=" . $wp_id; ?>
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
								<h4> No whitepapers added yet. </h4>
							</td>
						</tr>                        					
		<?php
			}
		?>
		<input type="hidden" name="submit_white_paper_delete" value="delete" />
	  </tbody>
	</table>
</form>
</div>
