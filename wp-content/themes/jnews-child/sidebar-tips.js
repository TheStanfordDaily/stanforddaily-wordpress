(function ($) {
    $(function () {
        // $($("#tsd-tips-widget").html()).prependTo($('.jeg_sidebar'));
        $(".jeg_bottombar .jeg_nav_normal").last().replaceWith(
            $($("#tsd-tips-widget").html())
        );
        $($("#tsd-donate-header").html()).prependTo($('.jeg_viewport'));
        $(".tsd-donation-form").submit(function(e) {
            var isRecurring = $(this).find("input[type=checkbox]").attr("checked") === "checked";
            if (isRecurring) {
                e.preventDefault();
                var amount = $(this).find("select[name=amount]").val();
                var recurringForm = $(this).next("tsd-donation-form-recurring");
                recurringForm.find("input[name=a3]").val(amount);
                recurringForm.submit();
            }
        })
    });
})(jQuery);