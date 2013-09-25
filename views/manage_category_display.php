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
  <?php
		if($error_list != "")
		{
	?>
  			<div class="error-box" style="width:400px;"> <strong>ERROR</strong>: <?php echo $error_list; ?> </div>
  <?php			
		}
	?>
  <?php
  		
		if($success != "")
		{
	?>
  			<div class="success-box" style="width:400px;"> <strong>SUCCESS</strong>: <?php echo $success; ?> </div>
  <?php
		}
	?>
  <h2> <?php echo __( 'White Paper Manage Groups'); ?> </h2>
  <form name="whitepaper_cat_manage_form" 
    			method="post"
    			action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
    <h4> <?php echo __( 'Add New Group'); ?> </h4>
    <table>
      <tr>
        <td><?php _e("Group Name" ); ?></td>
        <td> : </td>
        <td><input type="text" 
							name="whitepaper_catrgory" 
							value="<?php echo $white_category; ?>" size="20"></td>
      </tr>
      <tr align="right">
        <td colspan="3">
			<input type="hidden" name="submit_add" value="add" />
			<input type="submit" name="submit_addCategory" value="<?php _e('Add Group') ?>" /></td>
      </tr>
    </table>
  </form>
  <?php
  	/* Page that displays the categories */
  	include "view_includes/display_category.php";
  ?>
</div>