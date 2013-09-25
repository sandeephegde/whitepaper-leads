<?php
	$base_url = $whitePaperInt->get_siteURL() . $whitePaperInt->get_url();
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>/js/jquery.file_download.js"></script>

<script type="text/javascript" src="<?php echo $base_url; ?>/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>/fancybox/jquery.fancybox-1.3.4.css" media="screen" />

<link type="text/css" media="all" rel="stylesheet" href="<?php echo $base_url; ?>/css/style.css"/>


<script type="text/javascript">
	$(function () {	
	<?php
		foreach($results as $result)
		{
			$w_id = $result->w_id;
		?>	
			$('#various<?php echo $w_id; ?>').fancybox({
				'titlePosition'		: 'inside',
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'none',
				'overlayColor'		: '#000',
				'overlayOpacity'	: 0.4,
				'showCloseButton'	: false,
				'showNavArrows'		: false				
			});
		<?php
		}
		?>
	});			

	function clear_all_data(file_url)
	{
		document.getElementById('txtName').value = "";
		document.getElementById('txtEmail').value = "";
		document.getElementById('txtCompany').value = "";
		
		document.getElementById('txtName').focus();
		
		set_file_url(file_url);
	}	
</script>
<?php

$image_url = $base_url . "/images/down.png";
if(isset($_COOKIE["visited_flag"]))
{
    if(count($results) > 0)
    {
        foreach($results as $result)
        {
            $w_id = $result->w_id;
            $w_name = $result->w_name;
            $w_desc = $result->description;
            $w_loc = $result->location;
        ?>
        <p id="whitepaper_widget">
            <a class="fileDownloadSimpleRichExperience" href="<?php echo $base_url; ?>/includes/download.php?file=<?php echo $w_loc; ?>">
            <span style="font-family: arial,helvetica,sans-serif;">
                <strong>
                    <span style="color: #000000;"><?php echo $w_name; ?></span>
                </strong>
            </span>
            </a>
        </p>
        <div style="clear: both;"></div>
        <br />
        <?php
        } /* end of foreach */
    }// end count if
}
else
{
    if(count($results) > 0)
    {
        foreach($results as $result)
        {
            $w_id = $result->w_id;
            $w_name = $result->w_name;
            $w_desc = $result->description;
            $w_loc = $result->location;
        ?>
            <p id="whitepaper_widget">
                <a class="my_link"
                   id="various<?php echo $w_id; ?>"
                   onclick="clear_all_data('<?php echo $base_url; ?>/includes/download.php?file=<?php echo $w_loc; ?>');"
                   href="#inline1">
                    <span style="font-family: arial,helvetica,sans-serif;">
                            <span style="color: #000000;"> <?php echo $w_name; ?> </span>
                    </span>
                </a>
            </p>
            <div style="clear: both;"></div>
            <br />
        <?php
        } /* end of foreach */
    }// end if count
}
?>
<div style="display: none;">
    <div id="inline1">
        <div id="error" style="padding-left:25px;"></div>
        <div id="success"></div>
        <table border="1" id="design_table">
          <tr align="center">
            <td  colspan="3">
				<h2> Enter the following details to download file </h2>
			</td>
          </tr>
          <tr>
            <td>
				Name
				<font id="star"> * </font>
			</td>
            <td>:</td>
            <td>
				<input type="text" name="txtName" id="txtName" value=""/>
				<br/>
				<div id="txtNameError"></div>
			</td>
          </tr>
          <tr>
            <td>
				Email
				<font id="star"> * </font>
			</td>
            <td>:</td>
            <td>
				<input type="text" name="txtEmail" id="txtEmail" value=""/>
				<br/>
				<div id="txtEmailError"></div>
			</td>
          </tr>
          <tr>
            <td>
				Company
				<font id="star"> * </font>
			</td>
            <td>:</td>
            <td>
				<input type="text" name="txtCompany" id="txtCompany" value=""/>
				<br/>
				<div id="txtCompanyError"></div>
			</td>
          </tr>
          <tr valign="top">
            <td width="200px">
				How did you hear about us
				<font id="star"> * </font>
			</td>
            <td>:</td>
            <td>
            	<select name="txtHear" id="txtHear">
                	<option value=""> Select an Option </option>
                	<option value="google"> Google </option>
                    <option value="linkedIn"> LinkedIn </option>
                    <option value="facebook"> Facebook </option>
                    <option value="twitter"> Twitter </option>
                    <option value="email"> Email </option>
                    <option value="friend"> Friend </option>
                    <option value="other"> Other </option>
                </select>
				<br/>
				<div id="txtHearError"></div>
            </td>          
          </tr>
          <tr>
            <td colspan="3" id="table_button"> 
				<input type="button" value="Proceed to Download" onclick="ajaxformsendmail();" />
				<div id="display_loading"></div>
            </td>
          </tr>
        </table> 
    </div>
</div>
<input type="hidden" id="txtBaseAddress" value="<?php echo $base_url; ?>" />
<div id="preparing-file-modal" title="Preparing report..." style="display: none;">
    We are preparing your report, please wait...
 
    <div class="ui-progressbar-value ui-corner-left ui-corner-right" style="width: 100%; height:22px; margin-top: 20px;"></div>
</div>
 
<div id="error-modal" title="Error" style="display: none;">
    There was a problem generating your report, please try again.
</div>