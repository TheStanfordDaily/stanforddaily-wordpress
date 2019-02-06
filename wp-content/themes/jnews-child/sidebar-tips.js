(function ($) {
    $(function () {
        // $($("#tsd-tips-widget").html()).prependTo($('.jeg_sidebar'));
        $(".jeg_bottombar .jeg_nav_normal").last().replaceWith(
            $($("#tsd-tips-widget").html())
        );
        $($("#tsd-donate-header").html()).prependTo($('.jeg_viewport'));
        $(".tsd-donation-form").submit(function(e) {
            var isRecurring = $(this).find("input.monthlyDonation").attr("checked") === "checked";
            if (isRecurring) {
                var amount = $(this).find("select[name=amount]").val();
                var recurringForm = $(this).next(".tsd-donation-form-recurring");
                recurringForm.find("input[name=a3]").val(amount);
                recurringForm.submit();
                return false;
            }
        });

        $("a.tsd-tips-toggle").click(function(e) {
            e.preventDefault();
            var expandedElement = $(this).next("tsd-tips-expanded");
            var icon = $(this).find("i.fa");
            expandedElement.slideToggle(400, function() {
                if (expandedElement.is(":visible")) {
                    icon.removeClass("fa-caret-down").addClass("fa-caret-up");
                }
                else {
                    icon.addClass("fa-caret-down").removeClass("fa-caret-up");
                }
            })
        });

        $(".tsd-tips-expanded form").submit(function(e) {
            $.post($(this).attr("action"), $(this).serialize())  .done(function() {
                alert( "Tip submitted successfully. Thank you!" );
                $("a.tsd-tips-toggle").click();
              })
              .fail(function() {
                alert( "Error submitting the form. Please email your tip to eic@stanforddaily.com." );
              });
            return false;
        });
    });
})(jQuery);