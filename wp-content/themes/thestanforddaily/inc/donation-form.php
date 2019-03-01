<form action="https://www.paypal.com/cgi-bin/webscr" method="post" class="tsd-donation-form">
	<input type="hidden" name="business" value="coo@stanforddaily.com">
	<input type="hidden" name="cmd" value="_donations">
	<input type="hidden" name="item_name" value="Stanford Daily Donation">
	<input type="hidden" name="item_number" value="From Header in Page: <?php global $wp;
echo home_url($wp->request);?>">
	<input type="hidden" name="currency_code" value="USD">
	<button class="button" type="submit" name="submit">Support the Daily</button><select name="amount" class="form-control" style="
	width: 100px;
	margin: 0px 20px;
">
		<option value="5">$5</option>
		<option value="10">$10</option>
		<option value="25">$25</option>
		<option value="50">$50</option>
		<option value="100">$100</option>
		<option value="500">$500</option>
		<option value="1000">$1,000</option>
	</select>

	<div class="checkbox"
	style="
	/* display: inline-block; */
	margin: 0px 10px;
	margin-top: 10px;
	" name="monthly-donation">
	<label><input type="checkbox" class="monthlyDonation" value="" style="
		margin-right: 10px;
	">Make my donation a monthly donation.</label>
	</div>

	<!--
https://developer.paypal.com/docs/classic/paypal-payments-standard/integration-guide/Appx_websitestandard_htmlvariables/#recurring-payment-variables
	-->

	<img alt="" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" style="display: none;">

</form>

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" class="tsd-donation-form-recurring">
	<input type="hidden" name="business" value="coo@stanforddaily.com">
	<input type="hidden" name="cmd" value="_xclick-subscriptions">
	<input type="hidden" name="item_name" value="Stanford Daily Donation">
	<input type="hidden" name="item_number" value="From <?php echo $donation_location; ?>">
	<input type="hidden" name="custom" value="<?php global $post; echo $post->id?>">
	<input type="hidden" name="no_note" value="1" />
	<input type="hidden" name="currency_code" value="USD">
	<input type="hidden" name="src" value="1" />
	<input type="hidden" name="a3" value="5">
	<input type="hidden" name="p3" value="1">
	<input type="hidden" name="t3" value="M" />
</form>
