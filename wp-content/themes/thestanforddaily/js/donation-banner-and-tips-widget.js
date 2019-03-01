/* Local storage polyfill */
if (!window.localStorage) {
	window.localStorage = {
		_data: {},
		setItem: function (id, val) { return this._data[id] = String(val); },
		getItem: function (id) { return this._data.hasOwnProperty(id) ? this._data[id] : undefined; },
		removeItem: function (id) { return delete this._data[id]; },
		clear: function () { return this._data = {}; }
	};
}

(function ($) {
	var numDaysBetween = function (d1, d2) {
		var diff = Math.abs(d1.getTime() - d2.getTime());
		return diff / (1000 * 60 * 60 * 24);
	};
	$(function () {
		// $($("#tsd-tips-widget").html()).prependTo($('.jeg_sidebar'));
		if (document.body.clientWidth < 768) {
			$("body").prepend(
				$($("#tsd-tips-widget").html())
			);
		}
		else {
			$(".jeg_bottombar .jeg_nav_normal").last().replaceWith(
				$($("#tsd-tips-widget").html())
			);
		}
		var optoutDate = new Date(parseInt(localStorage.getItem("tsd-donate-header-optout-time") || 0));
		if (localStorage.getItem("tsd-donate-header-close") !== "true" || numDaysBetween(new Date(), optoutDate) > 7) {
			$($("#tsd-donate-header").html()).prependTo($('.jeg_viewport'));
		}
		$(".tsd-donation-form").submit(function (e) {
			var isRecurring = $(this).find("input.monthlyDonation").attr("checked") === "checked";
			if (isRecurring) {
				var amount = $(this).find("select[name=amount]").val();
				var recurringForm = $(this).next(".tsd-donation-form-recurring");
				recurringForm.find("input[name=a3]").val(amount);
				recurringForm.submit();
				return false;
			}
		});
		$(".tsd-donate-header-close").click(function (e) {
			e.preventDefault();
			$(".tsd-donate-header").hide();
			localStorage.setItem("tsd-donate-header-close", "true");
			localStorage.setItem("tsd-donate-header-optout-time", new Date().getTime() + "");
		});

		$("a.tsd-tips-toggle").click(function (e) {
			e.preventDefault();
			console.log("HI");
			var expandedElement = $(this).next(".tsd-tips-expanded");
			var icon = $(this).find("i.fa");
			expandedElement.slideToggle(400, function () {
				if (expandedElement.is(":visible")) {
					icon.removeClass("fa-caret-down").addClass("fa-caret-up");
				}
				else {
					icon.addClass("fa-caret-down").removeClass("fa-caret-up");
				}
			})
		});

		$(".tsd-tips-expanded form").submit(function (e) {
			var buttonSubmit = $(this).find("input[type=submit]").attr("value", "Loading...").attr("disabled", "disabled");
			var inputs = $(this).find("input[type=text], input[type=email], textarea");
			$.post("https://script.google.com/macros/s/AKfycbzTLxlB1iYpJh8gEbeHEXEGiZiWOoglns3NJJf3YzrYLzn-W5Q/exec", $(this).serialize()).done(function () {
				alert("Tip submitted successfully. Thank you!");
				inputs.val("");
				buttonSubmit.attr("value", "Submit").removeAttr("disabled");
				$("a.tsd-tips-toggle").click();
			})
				.fail(function () {
					buttonSubmit.attr("value", "Submit").removeAttr("disabled");
					alert("Error submitting the form. Please email your tip to eic@stanforddaily.com.");
				});
			return false;
		});
	});
})(jQuery);
