<div class="row" style="
    background: #eee;
    padding: 20px;
    text-align: center;
    border-top: 1px solid #aa0000;
">

<div class="col-xs-12 col-sm-6">
    <h3 style="
    /* padding: 0; */
    margin-top: 0px;
    text-align: center;
    ">Support independent, student-run journalism</h3>
    <i class="fa fa-book fa-4x" aria-hidden="true" style="float: left; margin: 5px 30px 0px 30px;"></i>
    Your support makes a difference in helping give staff members from all backgrounds the opportunity to conduct meaningful reporting. All contributions are tax-deductible.
</div>

<div class="col-xs-12 col-sm-6">
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" class="customize-unpreviewable">
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
        <option>$5</option>
        <option>$10</option>
        <option>$25</option>
        <option>$50</option>
        <option>$100</option>
        <option>$500</option>
        <option>$1,000</option>
    </select>

    <div class="checkbox" style="
    /* display: inline-block; */
    margin: 0px 10px;
    margin-top: 10px;
    " name="monthly-donation">
    <label><input type="checkbox" value="" style="
        margin-right: 10px;
    ">Make my donation a monthly donation.</label>
    </div>

    <!-- Display the payment button. -->

    <img alt="" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif">
</div>


</form>
</div>
