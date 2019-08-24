=== My Private Site ===
Contributors: dgewirtz
Donate link: http://zatzlabs.com/lab-notes/
Tags: login, visibility, private, security, plugin, pages, page, posts, post
Requires at least: 3.0
Tested up to: 5.0
Stable tag: 2.14.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Create a Private Site visible only to your registered users.

== Description ==

**IMPORTANT: Support has moved to the ZATZLabs site and is no longer provided on the WordPress.org forums. Please visit the new [ZATZLabs Forums](http://zatzlabs.com/forums/). If you need a timely reply from the developer, please [open a ticket](http://zatzlabs.com/submit-ticket/).**

Allows the Administrator to restrict a WordPress-based web site to viewing only by registered users who are logged on.  Any attempt, by anyone not logged, to view any Page, Post or other part of the site will display a WordPress login screen.

Login prompts are provided whenever a non-logged in user ("site visitor") attempts to access any URL controlled by WordPress on the web site.  This plugin does not control non-WordPress web pages, such as .html and .php files created by hand or by other software products.  Or images and other media and text files directly accessed by their URL, or from a browser's directory view, if available.

Features and Settings:

* Supports WordPress Networks ("Multisite"), with Network-wide Settings planned for a future version
* Visible Exclusions settings allow the entry of a list of URLs that will always be visible, and never be hidden by the plugin;  a separate Setting is provided for hiding or revealing Site Home without the need to enter its URL
* A URL Prefix option in Visible Exclusions, matches, and makes visible, all URLs that begin with the one or more partial URLs entered
* Supports Custom Login and Registration pages at URLs different than the standard WordPress Login and Registration URLs
* Landing Location settings determine what the User sees after successfully logging in
* Landing Location is set for both automatic Login prompts and the Meta Widget's Login link
* User Self-Registration settings (varies between Network and Non-Network WordPress) are presented on the plugin's Settings page for easy access
* No known Theme incompatibilities, and only known Plugin incompatibility is with the A5 Custom Login plugin
* Special functionality is included to not hide Login- and Registration-related URLs used by BuddyPress and Theme My Login plugins
* Remember Me improvements at Login via free companion plugin, jonradio Remember Me, which can be downloaded separately from the WordPress Plugin Repository
* Overrides WordPress hiding of Network Activated plugins, just for itself;  tp provide this feature for all plugins, use the free companion plugin, jonradio Reveal Network Activated Plugins, which can be downloaded separately from the WordPress Plugin Repository
* Setting to disable the plugin so that other plugin Settings can be changed when the Site is not set to Private

If you allow Self-Registration, where new Users can Register themselves, you will need to select the "Reveal User Registration Page" setting or new Users will be blocked from seeing the WordPress Registration screen (on WordPress Networks, turning off the Reveal User Registration Page setting on the "Main Site" will prevent Registration from all Sites).  For convenience, the WordPress Setting that controls Self-Registration of Users has been added to the Plugin's Settings page.

Another Setting allows the Private Site feature to be turned off.  When the plugin is installed and activated, the Private Site feature is set off by default, to allow the Administrator an opportunity to become familiarized with the plugin's features and to set the desired settings.  A warning that the site is not private appears after first activation of the plugin until the Administrator visits the plugin's Settings page.

If a WordPress Network is defined, the plugin can be activated individually for select sites.  Or Network Activated.  In either case, each site will have its own Settings page where the Private Site feature can be turned off (default) or on for just the one site, and a Landing Location defined for each site.

Yes, there are other plugins that hide some or all WordPress content for any site visitor who is not logged on.  But when I was searching for a solution for one of the web sites I support, I decided to "write my own" because I knew how it worked and felt comfortable that there would be no way for anyone not logged in to view the site, including Search Engines.

> <strong>Adoption Notice</strong><br>
> This plugin was recently adopted by David Gewirtz and ongoing support and updates will continue. Feel free to visit [David's Lab Notes](http://zatzlabs.com/lab-notes/) for additional details and to sign up for emailed news updates.

Special thanks to Jon 'jonradio' Pearkins for creating the plugin and making adoption possible.

== Installation ==

**IMPORTANT: Support has moved to the ZATZLabs site and is no longer provided on the WordPress.org forums. Please visit the new [ZATZLabs Forums](http://zatzlabs.com/forums/). If you need a timely reply from the developer, please [open a ticket](http://zatzlabs.com/submit-ticket/).**

This section describes how to install the *jonradio Private Site* plugin and get it working.

1. Use **Add Plugin** within the WordPress Admin panel to download and install this *jonradio Private Site* plugin from the WordPress.org plugin repository (preferred method).  Or download and unzip this plugin, then upload the `/jonradio-private-site/` directory to your WordPress web site's `/wp-content/plugins/` directory
1. Activate the *jonradio Private Site* plugin through the **Installed Plugins** Admin panel in WordPress.  If you have a WordPress Network ("Multisite"), you can either **Network Activate** this plugin, or Activate it individually on the sites where you wish to use it.
1. Go to the plugin's Settings page to make the Site **Private**, and set where the user ends up after logging in: the **Landing Location**.
1. If you allow Self-Registration, where new Users can set up their own User Name on your WordPress site or Network, you will want to select **Reveal User Registration Page** on the plugin's Settings page.

== Frequently Asked Questions ==

**IMPORTANT: Support has moved to the ZATZLabs site and is no longer provided on the WordPress.org forums. Please visit the new [ZATZLabs Forums](http://zatzlabs.com/forums/). If you need a timely reply from the developer, please [open a ticket](http://zatzlabs.com/submit-ticket/).**

= How do I fix Redirect Loops (browser cycles for a long time then gives up)? =

By far, the most common way to create a Redirect Loop on your browser with this *jonradio Private Site* plugin is to specify both Custom Login page and Landing Location on the plugin's Settings page.  Simply setting "Where to after Login?" in the Landing Location section to "Omit ?redirect_to= from URL" should correct the problem.

This problem has been observed when the URL of the Custom Login page is a WordPress Page.  It occurs because, for Page URLs, WordPress uses the ?redirect_to= Query keyword for purposes other than a Landing Location.

= What happened?  I changed my Permalinks and now some things don't work. =

Whenever you change your WordPress Permalinks (Settings-Permalinks in Admin panels), this *jonradio Private Site* plugin does **not** automatically change any URLs you have entered in the plugin's Settings.  You will therefore want to make changes to URLs in the plugin's Settings whenever you change Permalinks.

= Why has the plugin's Settings entry disappeared from the WordPress Admin Users submenu? =

At user request, to reduce clutter.

== Changelog ==

= 2.14.2 =
* Minor fix for password reset. Thanks to user o2Xav.

= 2.14.1 =
* Minor support update

= 2.14 =
* Force login at 'get_header' instead of 'template_redirect' Action to be compatible with wpengine.com hosting
* Allow Custom Login page that is NOT on the current WordPress site, and clean up Settings page validation of related fields
* Fix double display of Error Messages on Settings page

= 2.13 =
* Remove Plugin's entry on Users submenu on WordPress Admin panels
* Remove associated Setting, which determined whether Users submenu entry existed

= 2.12 =
* Wait until Pretty Permalinks applied before deciding whether to force a login
* Add an Override Advanced Setting with Warnings on Usage, to allow Landing Location and Custom Login to both be specified.
* Correct coding error that allowed Landing Location with Custom Login, a potential Redirection error
* Fix Error Log warning on [mb]strpos Offset parameter

= 2.11.4 =
* Use Custom Login setting, if present, to redirect failed login attempts with blank username and/or password

= 2.11.3 =
* Use Custom Login setting, if present, to redirect failed login attempts

= 2.11.2 =
* Provide a Setting to disable User with No Role behaviour introduced in 2.11

= 2.11.1 =
* Remove forced logout when User with No Role attempts to access a Site (Network/Multisite install), to fix repeated messages when wp_logout is hooked by other plugins

= 2.11 =
* In a WordPress Network ("Multisite"), block Users with No Role on the current Site
* Make Landing Location work when free Paid Membership Pro plugin is activated 

= 2.10.1 =
* Add setting to obey Landing Location for users who login via a URL of wp-login.php without a &redirect_to= following

= 2.10 =
* Add setting to not display a Users submenu option for the plugin's settings
* Conditional logic for Settings Saved update message in Validate function

= 2.9 =
* Set Landing Location for logins via Meta Widget link, as well as automatic Login prompts

= 2.8 =
* Add Prefix option to Always Visible URLs
* Automatically use mb_ Multi-Byte string functions, if available

= 2.7 =
* Add Custom Login URL setting

= 2.6.1 =
* Older versions of WordPress require a parameter be passed to get_post()

= 2.6 =
* Detect and make visible Login-associated Pages created by the Theme My Login plugin

= 2.5 =
* Allow other URLs to be Always Visible with new Setting

= 2.4.2 =
* Reveal BuddyPress /activate/ Activation page when Reveal Registration selected

= 2.4.1 =
* Fix bug in URL matching for Root, where one URL has a trailing slash and the other does not

= 2.4 =
* Handle BuddyPress' redirection of Register URL in Reveal Registration

= 2.3 =
* Add Setting to Reveal Home Page on a Private Site
* Fixed Problems with wp_registration_url function in WordPress prior to Version 3.6

= 2.2 =
* Add the WordPress User Self-Registration field to the plugin's Settings page
* Add the Settings page to the User submenu of Admin panel, too

= 2.1 =
* Add a settings checkbox to reveal the Register page for User Self-Registration

= 2.0 =
* Add Settings page, specifying Landing Location and turning Private Site off and on
* Warning for new default of OFF for Private Site until Settings are first viewed
* Add Networking Settings information page
* Track plugin version number in internal settings
* Replace WordPress Activation/Deactivation hooks with Version checking code from jonradio Multiple Themes
* Add Plugin entry on individual sites when plugin is Network Activated, and Settings link on all Plugin entries

= 1.1 =
* Change Action Hook to 'wp' from 'wp_head' to avoid Modify Header errors when certain other plugins are present

= 1.0 =
* Add readme.txt and screenshots
* Add in-line documentation for php functions

== Upgrade Notice ==

= 2.14 =
Support wpengine.com hosting and off-site Login pages

= 2.13 =
Reduce WordPress Admin panels Menu clutter by removing plugin Settings from Users submenu

= 2.12 =
Correct handling of www. in a URL by waiting until Pretty Permalinks applied before deciding whether to force Login

= 2.11.3 =
Correct Failed Logins when Custom Login selected

= 2.11.2 =
Add Setting to control User with No Role

= 2.11.1 =
Fix User with No Role errors on Network/Multisite

= 2.11 =
Improves Multisite security and supports Paid Membership Pro

= 2.10.1 =
Landing Location obeyed for direct access with wp-login.php URL

= 2.10 =
Allow deletion of Users submenu entry for plugin settings

= 2.9 =
Meta Widget logins now go to Landing Location

= 2.8 =
Support Prefix URL for Always Visible pages

= 2.7 =
Support Custom Login page

= 2.6.1 =
Support Theme My Login plugin with older versions of WordPress

= 2.6 =
Support Theme My Login plugin

= 2.5 =
Allow many Always Visible pages

= 2.4.2 =
Reveal BuddyPress Activation page

= 2.4.1 =
Home Page better URL matching for Root Home Pages

= 2.4 =
Support BuddyPress

= 2.3 =
New Setting to display Home Page on a Private Site.

= 2.2 =
Display WordPress Self-Registration field on plugin Settings page.

= 2.1 =
Allow User Self-Registration by "revealing" the Register page to those not logged in.

= 2.0 =
Create a Settings page that defines where the user ends up after logging in

= 1.1 =
Should eliminate Modify Header errors due to conflict with other plugins

= 1.0 =
Production version, updated to meet WordPress Repository standards