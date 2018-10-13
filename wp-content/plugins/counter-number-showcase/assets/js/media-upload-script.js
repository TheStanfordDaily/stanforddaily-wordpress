jQuery(document).ready(function(jQuery){
  
	var media_uploader = null;

	jQuery('.rcsp_media_upload').click(function(e) {
	   
		showImg = jQuery(this).prev('img');
		uploadID = jQuery(this).next('input');
			
	   media_uploader = wp.media({
			frame:    "post", 
			state:    "insert", 
			library: { 
			type:'image' // limits the frame to show only images
		   },
			multiple: false
		});

			media_uploader.on("insert", function(){
			var json = media_uploader.state().get("selection").first().toJSON();
			var image_url = json.url;
			//alert(image_url);
			 jQuery(uploadID).val(image_url);
			 showImg.attr('src',image_url);
			var image_caption = json.caption;
			var image_title = json.title;
		});

		media_uploader.open();
	});
	
});