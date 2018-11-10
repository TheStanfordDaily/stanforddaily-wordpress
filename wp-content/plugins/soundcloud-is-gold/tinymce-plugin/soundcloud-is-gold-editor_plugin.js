
(function() {


	tinymce.create('tinymce.plugins.soundcloudIsGold', {

		init : function(ed, url) {
			var t = this;

			t.url = url;
			//t._createButtons();

			// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('...');
			ed.addCommand('soundcloud_Is_Gold', function() {
				var el = ed.selection.getNode(), post_id, vp = tinymce.DOM.getViewPort(),
				H = vp.h - 80, W = ( 640 < vp.w ) ? 640 : vp.w;

				if ( el.nodeName != 'IMG' ) return;
				if ( ed.dom.getAttrib(el, 'class').indexOf('soundcloudIsGold') == -1 )	return;

				post_id = tinymce.DOM.get('post_ID').value;
				tb_show('', tinymce.documentBaseURL + '/media-upload.php?post_id='+post_id+'&tab=soundcloud_is_gold&TB_iframe=true&width='+W+'&height='+H);

				tinymce.DOM.setStyle( ['TB_overlay','TB_window','TB_load'], 'z-index', '999999' );
			});


			/*ed.onMouseDown.add(function(ed, e) {
				if ( e.target.nodeName == 'IMG' && ed.dom.hasClass(e.target, 'soundcloudIsGold') )
				t._showButtons(t, e.target, 'soundcloudisgoldbtns');
			});*/

			//Replace Shortcode with Styled img or whatever
			ed.onBeforeSetContent.add(function(ed, o) {
				//o.content = t._get_soundcloudIsGold_player(o.content);
				o.content = t._do_soundcloudIsGold(o.content);
			});

			//Put Back the shortcode when saving
			ed.onPostProcess.add(function(ed, o) {
				if (o.get)
					o.content = t._get_soundcloudIsGold(o.content);
			});


			//open popup on placeholder double click
			ed.on('Click',function(e) {
					var cls  = e.target.className.indexOf('soundcloudIsGold');

			    if ( e.target.nodeName == 'IMG' && e.target.className.indexOf('soundcloudIsGold') > -1 ) {
						//grad shortcode attr from title
						var b = e.target.title;
						//split elements
						var s = b.split(" ");
						//Create Object for storing
						var obj = {};
						//Loop through and extract the key and value
						for (i = 0; i < s.length; i++) {
							//capture key
							var k;
							var key = s[i].match(/[^=]*/);
							if(key != null) k = key[0];
							//capture value
							var v;
							var val = s[i].match(/(=')(.*)(?=')/);
							if(val != null) v = val[2];
							//if it worked, keep adding to the object
							if( k != undefined && v != undefined){
								obj[k] = v; //[k] for dynamic key
							}
						}

							var el = ed.selection.getNode(), post_id, vp = tinymce.DOM.getViewPort(),
							H = vp.h - 80, W = ( 640 < vp.w ) ? 640 : vp.w;

							post_id = tinymce.DOM.get('post_ID').value;
							track_id = '';
							selectFormat = '';
							if(obj['id'] != undefined) track_id = '&track_id='+obj['id'];
							if(obj['format'] != undefined) selectFormat = '&selectFormat='+obj['format'];

							tb_show('', tinymce.documentBaseURL + '/media-upload.php?post_id='+post_id+'&tab=soundcloud_is_gold'+track_id+selectFormat+'&TB_iframe=true&width='+W+'&height='+H);

							tinymce.DOM.setStyle( ['TB_overlay','TB_window','TB_load'], 'z-index', '999999' );

			    }
			});

		},

		//Replace Shortcode with Styled img or whatever
		_do_soundcloudIsGold : function(co) {
			return co.replace(/\[soundcloud([^\]]*)\]/g, function(a,b){
				//console.log(obj);
				//console.log('----');

				//data-mce-resize="false": stop been able to rezise the placeholder
				//data-mce-placeholder="1": Set the image as a placehoder, no more UI poping up.
				placeholder = '<img class="soundcloudIsGold_placeholder" src="../wp-content/plugins/soundcloud-is-gold/tinymce-plugin/img/player-placeholder.jpg" class="soundcloudIsGold mceItem" data-mce-resize="false" data-mce-placeholder="1" title="soundcloud'+tinymce.DOM.encode(b)+'" width="566px" height="166px" />';
				return placeholder;
			});
		},

		//Put Back the shortcode when saving
		_get_soundcloudIsGold : function(co) {

			function getAttr(s, n) {
				n = new RegExp(n + '=\"([^\"]+)\"', 'g').exec(s);
				return n ? tinymce.DOM.decode(n[1]) : '';
			};

			return co.replace(/(?:<p[^>]*>)*(<img[^>]+>)(?:<\/p>)*/g, function(a,im) {
				var cls = getAttr(im, 'class');

				if ( cls.indexOf('soundcloud') != -1 )
					return '<p>['+tinymce.trim(getAttr(im, 'title'))+']</p>';

				return a;
			});
		},

		//Replace Shortcode with Player
		_get_soundcloudIsGold_player : function(co) {
			return co.replace(/\[soundcloud([^\]]*)\]/g, function(a,b){

				//split elements
				var s = b.split(" ");
				//Loop through and extract the key and value
				for (i = 0; i < s.length; i++) {
					//capture key
					var k;
					var key = s[i].match(/[^=]*/);
					if(key != null) k = key[0];
					//capture value
					var v;
					var val = s[i].match(/(=')(.*)(?=')/);
					if(val != null) v = val[2];
					//if it worked, make it into an object
					if( k != undefined && v != undefined){
						var obj = {
						[k]: v
						}
					}
				}

				//Set request
				var myData = {
						action: 'soundcloud_is_gold_player_preview',
						request: 'getSoundcloudIsGoldPlayerPreview',
						ID: obj['id']
						};
						//The Ajax request
						jQuery.post(ajaxurl, myData, function(response) {
								if(response) placeholder = response;
								else placeholder = '<div class="soundcloudIsGold_placeholder"><img src="../wp-content/plugins/soundcloud-is-gold/tinymce-plugin/img/t.gif" class="soundcloudIsGold mceItem" data-mce-resize="false" data-mce-placeholder="1" title="soundcloud'+tinymce.DOM.encode(b)+'" /></div>';

						});
					return 'hello';
			});
		},


		getInfo : function() {
			return {
				longname : 'Soundcloud is Gold Shortcode Settings',
				author : 'TM',
				authorurl : 'http://www.mightymess.com',
				infourl : '',
				version : "1.2"
			};
		}

	});

	tinymce.PluginManager.add('soundcloudIsGold', tinymce.plugins.soundcloudIsGold);

})();
