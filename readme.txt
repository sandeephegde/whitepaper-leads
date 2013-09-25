=== Whitepaper Leads===
Contributors: WPfog, dotCORD, sandeephegde, siddharthdeshpande, Taha 
Tags: whitepaper download, download whitepaper, lead generation, whitepaper, lead capture, download, download form, cookie based download, cookie download form
Requires at least: 3.3
Tested up to: 3.6.1
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Stable tag: 3.6.1

This plugin helps you capture lead form data before downloading whitepapers from your website.

== Description ==

This plugin will allow you to grant an access to download whitepapers after filling up a form.
When the user visits for the first time on the site, and wants to download the whitepaper, he/she is shown a interface which can be used to take information from the user.
You can,
*	Create, edit and delete the categories.
*	Create, edit and delete the whitepapers.
*	Add a email to which the mail will be sent to after the whitepaper download.
*	Add a short code in the posts to see the papers in a Post.
*	You can add a category inside the shortcode, only those category whitepapers will be displayed.
This plugin was originally developed for http://www.vayavyalabs.com and we thank them for permitting us to release it to public.


= Shortcodes =

Use [whitepaper_display group='example_name']

= Contributing code =

The development source code for this plugin is available on GitHub account(https://github.com/sandeephegde/whitepaper-leads). 



== Installation ==


1. Install either via the WordPress.org plugin directory, or by uploading the files to `white-paper-leads.zip` to the `/wp-content/plugins/` directory on the server
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Now you are ready to add the whitepapers, groups and email at the admin.
4. Go to the menu White Papers, select Manage Group, in this you can add, update and delete the Groups.
5. Go to the menu White Papers, select Manage Paper, in this you can add, update and delete the Whitepapers.
6. Go to the menu White Papers, select Settings, in this you can add a Email Field that will add the email where it is needed to be sent to after download.
7. Create a post and add the following shortcode **[whitepaper_display]** to display the whitepapers.

That's it. You're ready to go!

== Frequently Asked Questions ==

= How to add new Groups in Manage Groups? =
Just add a new Group in "Group Name" and say "Add Group".

= How to Edit Groups in Manage Groups? =
Click on the "Edit Group" in the display below. NOTE : You cannot Edit more then one groups at a time.

= Can I edit more then one Groups at a time? =
No you cannot Edit more then one groups at a time.

= Can I Delete more then one Groups at a time? =
Yes you can delete more then one groups at a time.

= How to delete more then one Groups? =
Check the boxes in "Select" for more then one Group and Click "Delete Groups".

= Why I am not able to see any groups in the Manage Whitepapers? =
You need to first add new Groups in the "Manage Groups" and then you will find those groups appear in "White paper Group" dropdown.

= How to add new Whitepapers in Manage Papers? =
Just add a Whitepaper title, Description, URL and Select a Group and click on "Add Whitepaper".

= How to Edit a Whitepapers in Manage Papers? =
You can edit a whitepaper by clicking on "Edit", and the data appears in respective text boxes, where you can Change the Content and click on "Edit Whitepaper".

= Can I edit more then one whitepapers at a time? =
No you cannot edit more then one whitepaper at a time.

= How to Edit a Whitepapers in Manage Papers? =
You can edit a whitepaper by clicking on "Edit", and the data appears in respective text boxes, where you can Change the Content and click on "Edit Whitepaper".

= How to delete more then one Whitepapers? =
Check the boxes in "Select" for more then one whitepaper and Click "Delete Whitepaper".

= Can I Delete more then one Whitepapers at a time? =
Yes you can delete more then one Whitepapers at a time.

= How to change email receivers address on downloading the whitepaper for first time? =
Just Click on "Settings" and add new Email to "Email" and click on "Change Email".

== Screenshots ==

1. This screenshot describes the "Manage Groups".
2. This screenshot describes the "Manage Whitepapers".
3. This screenshot describes the "Settings".
4. This displays how the whitepapers are displayed after using [whitepaper_display] shortcode.
5. This screenshot shows the interface when the user clicks first time on the link to download.
6. This screenshot shows the file been downloaded.




== Changelog ==

= 1.0.1 =
* Added short code capabilities specific to the group/category

= 1.0.2 =
* Enhancement to trigger automatic notification of subsequent whitepapers by the same user. Cookie is setup on filling the form for first time and further tracked.

