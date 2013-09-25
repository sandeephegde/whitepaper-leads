var download_url;

jQuery(document).ready(function ($) {
    $(document).on("click", "a.fileDownloadCustomRichExperience", function () {		
        $.fileDownload($(this).attr('href'), {
            successCallback: function (url) {
                $preparingFileModal.dialog('close');
            },
            failCallback: function (responseHtml, url) {
                $("#error-modal").dialog({ modal: true });
            }
        });
        return false; //this is critical to stop the click event which will trigger a normal file download!
    });
    

	//send email on each file download
   $(".emailall").click(function(){
  
  username=getCookie("white_paper_name");
  useremail=getCookie("white_paper_email");
  usercompany=getCookie("white_paper_company");
  userheard=getCookie("white_paper_heard_from");
  rawurl=$(this).attr('href');
  var fileNameIndex = rawurl.lastIndexOf("/") + 1;
  var userfilename = rawurl.substr(fileNameIndex);
 
  
  		jQuery.ajax({
			type: 'POST',
			url: whitepaper_script_ajax.ajaxurl,
			data: {
				action: 'ajaxcontact_send_mail',
				white_paper_name: username,
				white_paper_email: useremail,
				white_paper_company:usercompany,
				white_paper_heard_from:userheard,
				file_title:userfilename
			},
			
			success:function(data, textStatus, XMLHttpRequest){
			console.log('success');					
			
			},
			
			error: function(MLHttpRequest, textStatus, errorThrown){
				//alert(errorThrown);
			}
		});
  
  
});
});

function set_file_url(file_url)
{
	download_url = file_url;	
}

function clear_errors(url)
{
	document.getElementById('txtNameError').innerHTML = "";
	document.getElementById('txtEmailError').innerHTML = "";
	document.getElementById('txtCompanyError').innerHTML = "";
	document.getElementById('txtHearError').innerHTML = "";
}


function ajaxformsendmail()
{
	clear_errors();
	var flag = 1;
	
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	
	var name = document.getElementById('txtName').value;
	var email = document.getElementById('txtEmail').value;
	var company = document.getElementById('txtCompany').value;
	var hear = document.getElementById('txtHear').value;
	
	if(name.trim().length == 0)
	{
		if(flag == 1)
		document.getElementById('txtName').focus();
		document.getElementById('txtNameError').innerHTML = "Name cannot be left blank.";
		flag = 0;
	}	
	
	if(email.trim().length == 0)
	{
		if(flag == 1)
		document.getElementById('txtEmail').focus();
		document.getElementById('txtEmailError').innerHTML = "Email cannot be left blank";
		flag = 0;
	}
	
	if(email.trim().length != 0)
	{
		if(!email.match(emailExp))
		{
			if(flag == 1)
			document.getElementById('txtEmail').focus();
			document.getElementById('txtEmailError').innerHTML = "Invalid Email address";
			flag = 0;
		}		
	}
	
	if(company.trim().length == 0)
	{
		if(flag == 1)
		document.getElementById('txtCompany').focus();
		document.getElementById('txtCompanyError').innerHTML = "Company cannot be left blank";
		flag = 0;
	}
	
	if(hear.trim().length == 0)
	{
		if(flag == 1)
		document.getElementById('txtHear').focus();
		document.getElementById('txtHearError').innerHTML = " Description cannot be left blank";
		flag = 0;
	}
	
	if(flag != 0)
	{
		document.getElementById('inline1').innerHTML = "<div id='loading'> <br /> <p> Your file will start downloading now.</p> </div> ";		var arrayIndex = download_url.lastIndexOf("/") + 1;		var fileTitle = download_url.substr(arrayIndex);
		jQuery.ajax({
			type: 'POST',
			url: whitepaper_script_ajax.ajaxurl,
			data: {
				action: 'ajaxcontact_send_mail',
				white_paper_name: name,
				white_paper_email: email,
				white_paper_company:company,
				white_paper_heard_from:hear,								
				file_title:fileTitle
			},
			
			success:function(data, textStatus, XMLHttpRequest){
				setCookie("visited_flag",1,365);
				setCookie("white_paper_name",name,365);
				setCookie("white_paper_email",email,365);
				setCookie("white_paper_company",company,365);
				setCookie("white_paper_heard_from",hear,365);
				
				$.fileDownload(download_url, {
					successCallback: function (url) {
						location.reload();
					},
					failCallback: function (responseHtml, url) {
						$preparingFileModal.dialog('close');
						$("#error-modal").dialog({ modal: true });
					}
				});				
				setTimeout(function(){location.reload();},5000);
			},
			
			error: function(MLHttpRequest, textStatus, errorThrown){
				alert(errorThrown);
			}
		});
	}
}

function setCookie(c_name,value,exdays)
{
	var exdate=new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
	document.cookie=c_name + "=" + c_value;
}


function getCookie(c_name)
{
var c_value = document.cookie;
var c_start = c_value.indexOf(" " + c_name + "=");
if (c_start == -1)
  {
  c_start = c_value.indexOf(c_name + "=");
  }
if (c_start == -1)
  {
  c_value = null;
  }
else
  {
  c_start = c_value.indexOf("=", c_start) + 1;
  var c_end = c_value.indexOf(";", c_start);
  if (c_end == -1)
  {
c_end = c_value.length;
}
c_value = unescape(c_value.substring(c_start,c_end));
}
return c_value;
}