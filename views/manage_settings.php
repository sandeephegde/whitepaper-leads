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
  <h2> <?php echo __( 'Whitepaper Settings'); ?> </h2>
  <?php
    if(isset($sending_email))
    {
        ?>
            <p> Currently your e-mail is set to : <?php echo $sending_email; ?> </p>
        <?php
    }
    else
    {
        ?>
            <p> No e-mail set, please set an e-mail. </p>
        <?php
    }
  ?>
  <form name="whitepaper_cat_manage_form"
    			method="post"
    			action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
    <h4> <?php echo __( 'Email Settings'); ?> </h4>
    <table>
      <tr>
        <td><?php _e("Set Email" ); ?></td>
        <td> : </td>
        <td>
			<input type="text" 
							name="whitepaper_settings_email" 
							value="<?php echo $white_email; ?>" size="20">
			<?php _e(' Note : Email where whitepaper download information is sent.') ?>					
		</td>
      </tr>
      <tr align="left">
        <td colspan="3">
			<input type="hidden" name="submit_add_settings" value="add" />
			<input type="submit" name="submit_settings_add" value="<?php _e('Change Email') ?>" /></td>
      </tr>
    </table>
  </form>
</div>