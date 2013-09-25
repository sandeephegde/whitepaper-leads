<style type="text/css">
/* Dyamic Messages */

	.error-box,  .information-box,  .warning-box,  .success-box {
	background-position: 10px center;
	background-repeat: no-repeat;
	border: 1px solid;
	border-radius: 5px 5px 5px 5px;
	margin: 10px 0;
	padding: 10px 10px 10px 20px;
}
.error-box {
	background-color: #FFBABA;
	color: #D8000C;
}
.success-box {
	background-color: #DFF2BF;
	color: #4F8A10;
}
.warning-box {
	background-color: #FEEFB3;
	color: #9F6000;
}
.information-box {
	background-color: #BDE5F8;
	color: #00529B;
}

#button a
{
	padding:5px;
	background-color:#EEEEEE;
	pointer:cursor;
	text-decoration:none;
	margin : 5px;
	float:left;
}
</style>

<div class="wrap">
  <h2> <?php echo __( 'White Paper Edit'); ?> </h2>
  <form name="whitepaper_eidt_form" 
    			method="post"
    			action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
    <h4> <?php echo __( 'Edit Whitepaper'); ?> </h4>
    <table>
		<tr>
			<td><?php _e("White Paper Title"); ?></td>
			<td> : </td>
			<td><input type="text" 
								name="whitepaper_name"
								value="<?php if(isset($paper_name)) echo $paper_name; ?>"
								style="width:450px;"/></td>
		</tr>
		<tr>
			<td valign="top"><?php _e("White Paper Description"); ?></td>
			<td valign="top"> : </td>
			<td>
				<textarea name="whitepaper_desc" style="width:445px; height:150px;"><?php if(isset($paper_desc)) echo $paper_desc; ?></textarea>
			</td>
		</tr>
		<tr>
					<td><?php _e("White paper URL"); ?></td>
			<td> : </td>
			<td><input type="text"
				name="whitepaper_location" 
				value="<?php if(isset($paper_location)) echo $paper_location; ?>"
			style="width:450px;"/><?php _e(" Ex: http://www.example.com/wp-content/uploads/2013/02/xyz.pdf" ); ?></td>
		</tr>
		<tr>
			<td><?php _e("White paper Group"); ?></td>
			<td> : </td>
			<td>
				<select name="whitepaper_group">
					<option value="">[Select A group]</option>
					<?php
						foreach($results as $result)
						{
							$cat_id = $result->cat_id;
							$cat_name = $result->cat_name;
							if($paper_group == $cat_id)
							{
							?>
							<option value="<?php echo $cat_id; ?>" selected><?php echo $cat_name; ?></option>
							<?php
							}
							else
							{
							?>
							<option value="<?php echo $cat_id; ?>"><?php echo $cat_name; ?></option>
							<?php
							}
						}
					?>					
				</select>
			</td>
		</tr>		
		<tr align="left">
			<td colspan="3">
				<input type="hidden" name="submit_edit_white_paper" value="add" />
				<input type="submit" name="submit_addCategory" value="<?php _e('Edit Whitepaper') ?>" />
			</td>
		</tr>
	</table>
	</form>
	<?php
		/* Page that displays the categories */
		include "view_includes/display_paper.php";
	?>
</div>