=== SoundCloud Is Gold ===
Contributors: realtm
Donate link: https://www.paypal.com/donate/?token=BWzoCeVKupkWFJQ7nIA-0il0ndBxJOConYsL8hEYVgQHTMPaKM6bjYu0GqHO7aE2j0px_m
Tags: soundcloud, simple, shortcode, music, sound, podcasts, widget
Requires at least: 3.2
Tested up to: 4.9.7
Stable tag: 2.5.1

Browse and insert Soundcloud tracks, playlists and favourites to your posts. Live preview and customise your player to fit your website's design.

== Description ==

Browse and insert your or someone else tracks, playlists and favourites to your posts using SoundCloud's official player. The live preview makes it easy to see how customising your player will fit perfectly with your website’s design.

It’s smart, secure and just works.

You can set a default style for all players but if needed, you will be able to tweak the styling for one particular player. Soundcloud is Gold is currently helping 10,000 music lovers getting their work out there!

&nbsp;

>All you need from a Soundcloud Plugin - Easy to install and to set up, good looking in both widget and full-width style.
>⭐️⭐️⭐️⭐️⭐️ - @goamazinghostel - [read full review](https://wordpress.org/support/topic/all-you-need-from-a-soundcloud-plugin/)

&nbsp;

>Works Perfectly. This plugin made adding Soundcloud a trivial effort.
>⭐️⭐️⭐️⭐️⭐️ - @fssbob - [read full review](https://wordpress.org/support/topic/works-perfectly-1037/)

&nbsp;

== Top Features ==

* **Browse** through your or someone lese soundcloud tracks, sets and favourites from a tab in the media upload window, no need to go back and forth between Soundcloud and your website.
* **Save multiple users**, very useful for labels, collectives or artists with many projects
* **Live Preview** let you see what does what instantly.
* **Integrates perfectly** with wordpress media upload by using the same listing style that you get with the images.
* **Plugin construct the shortode for you**, no need to remember any crasy syntax (but you can still use the shortcode manually if needed).
* **Widget** for showing the latest or random tracks, favourites or sets for one user, multiple users or random users.
* **Track's info** displayed directly in the tab (description, url, cover, etc...).
* Default settings from the option page (see screenshot):
    * Default player type (Standard, Artwork, Visual)
    * Width
    * Extra Classes for the div that wraps around the player
    * Auto Play
    * Show/Hide Comments
    * Player's Colours
* Styled sortcode in editor for neat layout.
* Implement Soundcloud Html5 player.
* Follow WP developpers guidelines (enqueue scripts and styles just for the plugin, clean code, commented, secure and leave no trace when uninstall ).
* https support


= Advantages against pasting embed code from soundcloud and other plugins =

* By changing the main settings in the options, all players on your site using the default settings will change. If green isn't trendy anymore and purple is the new orange, it won't be a problem and you will keep your street credibility.
* If Soundcloud update their player or release an even cooler new player that let you scratch your track while streaming to snapchat, I will most defenetly update the plugin to use those new features.
* **Soundcloud is Gold** use a shortcode but the "Soundcloud is Gold" tab will write it for you dynamically as you select parameters, and on top of this it will provide a nice live preview of your player so you know what does what. When done just press the 'insert soundcloud player' and it will added to your post just like when you're adding a photo or gallery.



== Keep it alive! ==

If you love it please rate it! If you use it and want to help, [donations are always welcomed](http://www.mightymess.com/soundcloud-is-gold-wordpress-plugin) or you could like, tweet or spread the love on your blog ;)

Latest developments updates on twitter: [#soundcloudisgold](https://twitter.com/#!/search/realtime/%23soundcloudisgold) or follow me on [twitter](http://twitter.com/#!/mighty_mess)


== RoadMap ==

= Priority =

* Contextual On-boarding to help new users getting to know the plugin
* Use your own API key (which mean you're not dependent of the rate_limit attached to my key )
* Advance Settings (change background color and comments color, playcounts, buy link, font, wmode, etc, show/hide styled shortcode, number of tracks per page)
* Other soundcloud shortcode conflict fix (jetpack)
* Update to the way Settings are handled to be even more inline with Wordpress settings API.
* Live search while typing a name in the user name field. So if you're looking for someone it's kind of easier.
* Better UX for the editor: clicking to edit should know if which user and if it's a track/playlist/favourite
* Better UX for the editor: Better visual to actually know what the track is just by looking at it.

= Secondary =

* Seperate playlists into playlist types (ep, album, etc...)
* Url attribute for shortcode: easier for people using the shortcode manually.
* Trigger live preview when changing Soundcloud user name
* Add 'activities' to the widget


== Installation ==

Just follow the usual procedure. Log on to your wordpress, go to plugin 👉 Add New 👉 search 'Soundcloud is Gold' 👉 click install.




== Frequently Asked Questions ==

= I can't see my tracks? =

* Have you entered your real username? Your username is what you see in your soundcloud url when you click your name in soundcloud or view public profile (e.g http://soundcloud.com/anna-chocola ).
* Bare in mind is that all tracks that are set as private on soundcloud won't appear.
* Have you got other soundcloud plugin installed? That generally happen as you've been 'shopping around', disable them or even delete them and this if it works.

= It's behaving strangely or working partially or I've check everything but it still doesn't work =

Here's a simple method to track down incompatibilities with plugins and themes:

* Disable all plugins
* Enable 'soundcloud is gold' and check if it works (add a track to a post to be sure)
* If it worked: enable the other plugins one by one and check if it breaks
* If it didn't worked: enable the default Worpress theme and check if it works (add a track to a post to be sure).

Remenber that even if a plugin is popular, most of the plugins are badly coded or the developer didn't follow Wordpress guidelines on plugin development. Therefor conflict happens. The method is useful not just for this plugin.

= Do you have some documentation for the shortcode? =

If for some reason you wish to use the shortcode manually, here's what's possible:

**id or user is required for the shortcode to work**
[soundcloud id='trackID']: The id of the track, favorite or playlist.

[soundcloud user='yourUsername'] : This will always display the latest track (will overwrite id if set)

**Those attributes are optional**
comments: True or False
autoplay: True or False
playertype: 'Standard'
width: px or % (for example 56px or 56%)
color: rgb hex color code (for example #005bff)
show_artwork: True or False
visual: True or False (overwrites show_artwork)
show_comments: True or False
format: 'tracks' or 'playlists'



= Can I request features? =

Yes, you can. If asked nicely and the requests are sensibles, I almost always integrate them to new releases.

= Can you help me? =

Sometimes, I generally keep a eye on my plugin's forums and website's comments. Bear in mind that I've got a full time job and a life, so I can't always help straight away. I will not reply to people who obviously don't read the faqs or the forum or just say 'it doesn't work'.



== Screenshots ==

1. Main options
2. Color Customisation
3. Editor view
4. Adding a Track
4. Adding a Playlist
4. Widget Options


== Changelog ==

= 2.5.1 =
* 🔧 Fixing the insert shortcode button not inserting the shortcode anymore.
* ✍🏻 Renamed the media upload tab to "insert from Soundcloud" for consistency with Wordpress and better UX.
* ✍🏻 Minor styling update to fix the image placeholder in the editor.

= 2.5 =
* 🤟 You can now change playlists' height!
* 🤟 Mini player is back!! You can now Force the player height to show the Mini Player.
* 🤟 When adding a user, if you put the whole url, the plugin will work out your username.
* 🤖 Update how users are created for first time install so it's using user id and not username.
* 🇫🇷 The plugin is translation ready!! To celebrate I've translated it in French (Should be approved soon).
* ✍🏻 Updated the disclaimer message for people with no tracks/playlists.
* ✍🏻 Minors text changes for labels and instructions.
* 💥 Removed survey from the plugin admin panel. Thanks everyone!
* 💥 Screenshots were removed from the actual plugin, so that's a smaller plugin for.

= 2.4.3 =
* Fixed apostrophe bug in the shortcode when trying to insert

= 2.4.2 =
* Updated plugin to reflect Soundcloud API changes. Please update to fix any issues in version 2.4.1

= 2.4.1 =
* Fixed a bug in the Widget not properly displaying Playlists after updating from 2.3.3. Thanks to Jan Middelkoop and @gnorf for helping out.
* Added shortcode attr to show latest track from a specific, see FAQs for how to do it manually.
* Updated FAQs to give more documentation around the shortcode
* Added a survey for all users: Please help me make this plugin better by answering those few questions.

= 2.4 =
* Removed flash player and all related options as Soundcloud only support their html5 player now
* New Visual player now supported (big full artwork) with the addition with a force square option (height of 450px) to match Soundcloud default settings
* Editor: Clicking the image that represent the player now works again, let's you to edit the track or playlist (still need further UX refinements in next release). placeholder look has been updated too.
* Sets are now renamed Playlists
* Hide comments options now works again
* Playlists now get the counting properly in the tab
* Track duration in the upload tab is now properly formatted again (although there seems to a minor different of time with Soundcloud's site)
* HTTPS support: All Api calls are now using https
* Up to date screenshots
* All plugin images optimized with imageAlpha for faster plugin download and performance.
* Soundcloud limit attr bug temporary patch.
* Some labels/User block the API. Included a better error message to explain this.
* Styling update: No more custom fonts, faster download of the plugin, cleaned styling to match some default Wordpress styling.
* Using setting_errors() for default Wordpress notices.

= 2.3.3 =
* API issue fix. Temporary fix to help people going.

= 2.3.2 =
* minor XSS security update

= 2.3 =
* Updated plugin to new Soundcloud API (Json only)
* Small styling fix

= 2.2.2 =
* Bug fix and improvements

= 2.2.1 =
* Fix bug with tinymce plugin that prevented user from using editot
* Fixing bug mean that the delete and edit button on the soundcloud-is-gold image in the editor have been removed
* Fixed the insert-shortcode button, now close the modal window once shortcode inserted

= 2.2.1 =
* Security Update. Thanks to Samuel Wood for his help and time.

= 2.2 =
* Widget Update! Display latest and random track, favorites or sets for one user, multiple users or random users.

= 2.1 =
* Widget to display a user's latest track in the sidebar
* New "user" argument for the shortcode to show latest track of an user

= 2.0 =
* Save multiple users, very useful for labels, collectives or artists with many projects.
* favourites browsing fix.
* Settings API (Should fix the multi wp install issues)

= 1.0.7 =
* Moved to Settings API, which should enable multi-site compatibility (good tutorial at http://www.presscoders.com/2010/05/wordpress-settings-api-explained/ and plugin for reference at http://wordpress.org/extend/plugins/plugin-options-starter-kit/)
* Fixed bug where pagination would always go back to tracks when browsing sets or favourites. Thanks to givafizz for spotting it.

= 1.0.6 =
* Now you can browse and add Sets and your favorites ;)

= 1.0.5 =
* New Soundcloud official Html5 player! Woop Woop!

= 1.0.4 =
* Faster loading of the tab (only load player's preview when click on 'show')
* Pagination as people with more than 50 tracks couldn't access the rest of their tracks (25 tracks per page)
* Styled shortcode in tinymce editor with delete and edit buttons

= 1.0.3.2 =
* Emergency fix linked to soundcloud server been attacked (DDoS): Added user-agent header to request.

= 1.0.3 and 1.0.3.1 =
* Fixed warning message related to xml not loading when allow_url_fopen is disable: Now using cURL as a first choice for getting xml, and then simplexml_load_file as a last desperate option. Thanks a million to Karl Rixon (http://www.karlrixon.co.uk/).

= 1.0.2 =
* Fixed minor warnings
* Made shortcode stronger/safer with shortcode_atts()
* Set object mode to transparent until V1.1 is ready with new advance settings.
* Made all shortcode attributes lowercase (autoPlay is now autoplay, playerType is now playertype). sorry about that but it's needed.

= 1.0.1 =
* Fixed shortode using echo instead of return (silly I know). This caused the shortcode to be outputted at the top of the post instead of it's position in the post. Thanks raceyblood for spotting it.

= 1.0 =
* Hello world! Listen to me.
