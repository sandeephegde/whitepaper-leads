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
  <h2> <?php echo __( 'White Paper Edit Group'); ?> </h2>
  <form name="whitepaper_cat_manage_form" 
    			method="post"
    			action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
    <h4> <?php echo __( 'Edit Group'); ?> </h4>
    <table>
      <tr>
        <td><?php _e("Group Name" ); ?></td>
        <td> : </td>
        <td><input type="text" 
							name="whitepaper_category_adit" value="<?php
																if(isset($cat_name))
																	echo $cat_name; ?>" size="20"></td>
      </tr>
      <tr align="right">
        <td colspan="3">
			<input type="hidden" name="submit_edit" value="edit" />
			<input  type="hidden" name="whitepaper_cat_id" value="<?php echo $cat_id; ?>" />
			<input type="submit" name="submit_addCategory" value="<?php _e('Save Category') ?>" />
		</td>
      </tr>
    </table>
  </form>
	<?php
		/* Page that displays the categories */
		include "view_includes/display_category.php";
	?>
</div>