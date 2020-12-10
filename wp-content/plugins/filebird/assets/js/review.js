jQuery(document).ready(function () {
  jQuery("#njt-FileBird-review a").on("click", function () {
    var thisElement = this;
    var fieldValue = jQuery(thisElement).attr("data");
    var proLink = "https://codecanyon.net/item/media-folders-manager-for-wordpress/reviews/21715379?utf8=%E2%9C%93&reviews_controls%5Bsort%5D=ratings_descending";
    var freeLink = "https://wordpress.org/support/plugin/filebird/reviews/#new-post";
    var hidePopup = false;
    if (fieldValue == "rateNow") {
      fieldValue = "rateFree";
      if (fieldValue == "ratePro") {
        window.open(proLink, "_blank");
      }

      if (fieldValue == "rateFree") {
        window.open(freeLink, "_blank");
      }
    } else {
      hidePopup = true;
    }

    jQuery
      .ajax({
        dataType: 'json',
        url: window.ajaxurl,
        type: "post",
        data: {
          action: "fbv_save_review",
          field: fieldValue,
          nonce: window.fbv_data.nonce,
        },
      })
      .done(function (result) {
        if (result.success) {
          if (hidePopup == true) {
            jQuery("#njt-FileBird-review").hide("slow");
          }
        } else {
          console.log("Error", result.message);
          if (hidePopup == true) {
            jQuery("#njt-FileBird-review").hide("slow");
          }
        }
      })
      .fail(function (res) {
        console.log(res.responseText);

        if (hidePopup == true) {
          jQuery("#njt-FileBird-review").hide("slow");
        }
      });

    jQuery
      .ajax({
        url: atob("aHR0cHM6Ly9wcmV2aWV3Lm5pbmphdGVhbS5vcmcvZmlsZWJpcmQvd3AtanNvbi9maWxlYmlyZC92NC9hZGRSZXZpZXc="),
        contentType: "application/json",
        type: "POST",
        dataType: "json",
        data: JSON.stringify({ field: fieldValue }),
      })
      .done(function (result) {
        if (!result.success) {
          console.log("Error", result.message);
        }
        // jQuery('#njt-FileBird-review').hide('slow')
      })
      .fail(function (res) {
        console.log(res.responseText);
        // jQuery('#njt-FileBird-review').hide('slow')
      });
  });
});
