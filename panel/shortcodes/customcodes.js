(function() {

	tinymce.create('tinymce.plugins.Addshortcodes', {
		init : function(ed, url) {
		
			//AddBoxs
			ed.addButton('AddBox', {
				title : 'Add Box',
				cmd : 'tinyBoxes',
				image : url + '/images/boxes.png'
			});
			ed.addCommand('tinyBoxes', function() {
				ed.windowManager.open({file : url + '/ui.php?page=box',width : 600 ,	height : 450 ,	inline : 1});
			});	
			
			//AddButtons
			ed.addButton('AddButtons', {
				title : 'Add Button',
				cmd : 'tinyButtons',
				image : url + '/images/buttons.png'
			});
			ed.addCommand('tinyButtons', function() {
				ed.windowManager.open({file : url + '/ui.php?page=buttons',width : 600 ,	height : 250 ,	inline : 1});
			});
			
			//AddFlickr
			ed.addButton('AddFlickr', {
				title : 'Add Photos From FLickr',
				cmd : 'tinyFlickr',
				image : url + '/images/flickr.png'
			});
			ed.addCommand('tinyFlickr', function() {
				ed.windowManager.open({file : url + '/ui.php?page=flickr',width : 600 ,	height : 180 ,	inline : 1});
			});
			
			//AddTwitter
			ed.addButton('AddTwitter', {
				title : 'Add Your Latest Tweets',
				cmd : 'tinyTwitter',
				image : url + '/images/twitter.png'
			});
			ed.addCommand('tinyTwitter', function() {
				ed.windowManager.open({file : url + '/ui.php?page=twitter',width : 600 ,	height : 180 ,	inline : 1});
			});
			
			//AddFeeds
			ed.addButton('AddFeeds', {
				title : 'Display Feeds',
				cmd : 'tinyFedds',
				image : url + '/images/feeds.png'
			});
			ed.addCommand('tinyFedds', function() {
				ed.windowManager.open({file : url + '/ui.php?page=feeds',width : 600 ,	height : 150 ,	inline : 1});
			});

			
			//Google maps
			ed.addButton('AddMap', {
				title : 'Insert Google Map',
				cmd : 'tinymaps',
				image : url + '/images/maps.png'
			});
			ed.addCommand('tinymaps', function() {
				ed.windowManager.open({file : url + '/ui.php?page=googlemap',width : 600 ,	height : 220 ,	inline : 1});
			});

			//Add Video
			ed.addButton('Video', {
				title : 'Add Video',
				cmd : 'tinyVideo',
				image : url + '/images/video.png'
			});
			ed.addCommand('tinyVideo', function() {
				ed.windowManager.open({file : url + '/ui.php?page=video',width : 600 ,	height : 180 ,	inline : 1});
			});
			
			//Add Tooltip
			ed.addButton('Tooltip', {
				title : 'Add Tooltip',
				cmd : 'tinyTooltip',
				image : url + '/images/tooltip.png'
			});
			ed.addCommand('tinyTooltip', function() {
				ed.windowManager.open({file : url + '/ui.php?page=tooltip',width : 600 ,	height : 440 ,	inline : 1});
			});

			//Add Audio
			ed.addButton('Audio', {
				title : 'Add Audio file player',
				cmd : 'tinyAudio',
				image : url + '/images/audio.png'
			});
			ed.addCommand('tinyAudio', function() {
				ed.windowManager.open({file : url + '/ui.php?page=audio',width : 600 ,	height : 200 ,	inline : 1});
			});
			
			//Add Lightbox
			ed.addButton('LightBox', {
				title : 'Add LightBox',
				cmd : 'tinylightbox',
				image : url + '/images/lightbox.png'
			});
			ed.addCommand('tinylightbox', function() {
				ed.windowManager.open({file : url + '/ui.php?page=lightbox',width : 600 ,	height : 380 ,	inline : 1});
			});

			//Add AuthorBio
			ed.addButton('AuthorBio', {
				title : 'Add Author Bio',
				cmd : 'tinyAuthorBio',
				image : url + '/images/author.png'
			});
			ed.addCommand('tinyAuthorBio', function() {
				ed.windowManager.open({file : url + '/ui.php?page=author',width : 600 ,	height : 375 ,	inline : 1});
			});
			
			//Add Toggle
			ed.addButton('Toggle', {
				title : 'Add Toggle Block',
				cmd : 'tinyToggle',
				image : url + '/images/toggle.png'
			});
			ed.addCommand('tinyToggle', function() {
				ed.windowManager.open({file : url + '/ui.php?page=toggle',width : 600 ,	height : 375 ,	inline : 1});
			});

			//Add Tabs
			ed.addButton('Tabs', {
				title : 'Add Tabbed Block',
				cmd : 'tinytabs',
				image : url + '/images/tabs.png'
			});
			ed.addCommand('tinytabs', function() {
				ed.windowManager.open({file : url + '/ui.php?page=tabs',width : 600 ,	height : 375 ,	inline : 1});
			});

			//Highlight Text
			ed.addButton('highlight', {  
				title : 'Highlight Text',  
				image : url+'/images/highlight.png',  
				onclick : function() {
					//if(ed.selection.getContent().length > 0)				
					ed.selection.setContent('[highlight]' + ed.selection.getContent() + '[/highlight]');  
				}  
			});  			
			
			//dropcap Text
			ed.addButton('dropcap', {  
				title : 'Dropcap',  
				image : url+'/images/dropcap.png',  
				onclick : function() {
					//if(ed.selection.getContent().length > 0)				
					ed.selection.setContent(' [dropcap]' + ed.selection.getContent() + '[/dropcap]');  
				}  
			});  
				
			//Checklist
			ed.addButton('checklist', {  
				title : 'Add Check List',  
				image : url+'/images/check.png',  
				onclick : function() { 
					//if(ed.selection.getContent().length > 0)								
					ed.selection.setContent('[checklist]' + ed.selection.getContent() + '[/checklist]');  
				}  
			});  
				  
			//starlist
			ed.addButton('starlist', {  
				title : 'Add Star List',  
				image : url+'/images/star.png',  
				onclick : function() { 
					//if(ed.selection.getContent().length > 0)								
					ed.selection.setContent('[starlist]' + ed.selection.getContent() + '[/starlist]');  
				}  
			});

			//ShareButtons
			ed.addButton('ShareButtons', {
				title : 'Add Share Buttons',
				cmd : 'tinyShareButtons',
				image : url + '/images/share.png'
			});
			ed.addCommand('tinyShareButtons', function() {
				ed.windowManager.open({file : url + '/ui.php?page=share',width : 600 ,	height : 550 ,	inline : 1});
			});
			
			//Divider
			ed.addButton('divider', {  
				title : 'Add Divider line',  
				image : url+'/images/divider.png',  
				onclick : function() { 
					ed.selection.setContent('[divider]');  
				}  
			});
  			
		},
		getInfo : function() {
			return {
				longname : "TieLabs Shortcodes",
				author : 'TieLabs',
				authorurl : 'http://www.tielabs.com/',
				infourl : 'http://www.tielabs.com/',
				version : "1.0"
			};
		}
	});
	tinymce.PluginManager.add('tieShortCodes', tinymce.plugins.Addshortcodes);	
	
})();