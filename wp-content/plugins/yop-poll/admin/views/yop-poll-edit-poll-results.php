<div class="row">
	<div class="col-md-12">
		&nbsp;
	</div>
</div>
<div class="row poll-results-options">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-12">
				<h4>
					<?php _e( 'Display', 'yop-poll' );?>
				</h4>
			</div>
		</div>
		<div class="form-horizontal">
			<div class="form-group">
				<div class="col-md-3">
					<?php _e( 'Show results', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<?php
			        $show_results_moment_before_vote = '';
			        $show_results_moment_after_vote = '';
			        $show_results_moment_after_end_date = '';
			        $show_results_moment_never = '';
			        $show_results_moment_custom_date = '';
			        $show_results_moment_custom_date_class = 'hide';
			        $show_results_to_class = 'hide';
			        if ( true === in_array( 'before-vote', $poll->meta_data['options']['results']['showResultsMoment'] ) ) {
			            $show_results_moment_before_vote = 'selected';
			            $show_results_to_class = '';
			        }
			        if ( true === in_array( 'after-vote', $poll->meta_data['options']['results']['showResultsMoment'] ) ) {
			            $show_results_moment_after_vote = 'selected';
			            $show_results_to_class = '';
			        }
			        if ( true === in_array( 'after-end-date', $poll->meta_data['options']['results']['showResultsMoment'] ) ) {
			            $show_results_moment_after_end_date = 'selected';
			            $show_results_to_class = '';
			        }
			        if ( true === in_array( 'custom-date', $poll->meta_data['options']['results']['showResultsMoment'] ) ) {
			            $show_results_moment_custom_date = 'selected';
			            $show_results_moment_custom_date_class = '';
			            $show_results_to_class = '';
			        }
			        if ( true === in_array( 'never', $poll->meta_data['options']['results']['showResultsMoment'] ) ) {
			            $show_results_moment_never = 'selected';
			            $show_results_to_class = 'hide';
			        }
			        ?>
			        <select name="show-results-moment" class="show-results-moment" style="width:100%" multiple="multiple">
			            <option value="before-vote" <?php echo $show_results_moment_before_vote;?>><?php _e( 'Before vote', 'yop-poll' );?></option>
			            <option value="after-vote" <?php echo $show_results_moment_after_vote;?>><?php _e( 'After vote', 'yop-poll' );?></option>
			            <option value="after-end-date" <?php echo $show_results_moment_after_end_date;?>><?php _e( 'After poll end date', 'yop-poll' );?></option>
			            <option value="custom-date" <?php echo $show_results_moment_custom_date;?>><?php _e( 'Custom Date', 'yop-poll' );?></option>
			            <option value="never" <?php echo $show_results_moment_never;?>><?php _e( 'Never', 'yop-poll' );?></option>
			        </select>
				</div>
			</div>
			<div class="form-group custom-date-results-section <?php echo $show_results_moment_custom_date_class;?>">
				<div class="col-md-3">
				</div>
				<div class="col-md-9">
					<div class="input-group">
						<input type="text" class="form-control custom-date-results" value="<?php echo $poll->meta_data['options']['results']['customDateResults'];?>" readonly />
						<input type="hidden" class="form-control custom-date-results-hidden" value="<?php echo $poll->meta_data['options']['results']['customDateResults'];?>" />
		                <div class="input-group-addon">
							<i class="fa fa-calendar show-custom-date-results" aria-hidden="true"></i>
		                </div>
					</div>
				</div>
			</div>
			<div class="form-group show-results-to-section <?php echo $show_results_to_class;?>">
				<div class="col-md-3">
					<?php _e( 'Show results to', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<?php
			        $show_results_to_guest = '';
			        $show_results_to_registered = '';
			        if ( true === in_array( 'guest', $poll->meta_data['options']['results']['showResultsTo'] ) ) {
			            $show_results_to_guest = 'selected';
			        }
			        if ( true === in_array( 'registered', $poll->meta_data['options']['results']['showResultsTo'] ) ) {
			            $show_results_to_registered = 'selected';
			        }
			        ?>
			        <select name="show-results-to" class="show-results-to" style="width:100%" multiple="multiple">
			            <option value="guest" <?php echo $show_results_to_guest;?>><?php _e( 'Guest', 'yop-poll' );?></option>
			            <option value="registered" <?php echo $show_results_to_registered;?>><?php _e( 'Registered', 'yop-poll' );?></option>
			        </select>
				</div>
			</div>
            <div class="form-group">
                <div class="col-md-3">
					<?php _e( 'Show Details as', 'yop-poll' );?>
                </div>
                <div class="col-md-9">
	                <?php
	                $results_details_votes_number = '';
	                $results_details_percentages = '';
	                if ( true === in_array( 'votes-number', $poll->meta_data['options']['results']['resultsDetails'] ) ) {
		                $results_details_votes_number = 'selected';
	                }
	                if ( true === in_array( 'percentages', $poll->meta_data['options']['results']['resultsDetails'] ) ) {
		                $results_details_percentages = 'selected';
	                }
	                ?>
                    <select class="results-details-option" style="width:100%" multiple="multiple">
                        <option value="votes-number" <?php echo $results_details_votes_number;?>><?php _e( 'Votes Number', 'yop-poll' );?></option>
                        <option value="percentages" <?php echo $results_details_percentages;?>><?php _e( 'Percentages', 'yop-poll' );?></option>
                    </select>
                </div>
            </div>
			<div class="form-group">
				<div class="col-md-3">
					<?php _e( 'Display [Back to vote] link', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<?php
			        if ( 'yes' === $poll->meta_data['options']['results']['backToVoteOption'] ) {
			            $back_to_vote_option_yes = 'selected';
			            $back_to_vote_option_no = '';
			            $back_to_vote_caption_class = '';
			        } else {
			            $back_to_vote_option_yes = '';
			            $back_to_vote_option_no = 'selected';
			            $back_to_vote_caption_class = 'hide';
			        }
			        ?>
			        <select class="back-to-vote-option" style="width:100%">
			            <option value="no" <?php echo $back_to_vote_option_no;?>><?php _e( 'No', 'yop-poll' );?></option>
			            <option value="yes" <?php echo $back_to_vote_option_yes;?>><?php _e( 'Yes', 'yop-poll' );?></option>
			        </select>
				</div>
			</div>
			<div class="form-group back-to-vote-caption-section <?php echo $back_to_vote_caption_class;?>">
				<div class="col-md-3 field-caption">
					<?php _e( '[Back to vote] caption', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<input type="text" class="form-control back-to-vote-caption" value="<?php echo $poll->meta_data['options']['results']['backToVoteCaption'];?>"/>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					<?php _e( 'Sort results', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<?php
			        switch ( $poll->meta_data['options']['results']['sortResults'] ) {
			            case 'as-defined': {
			                $sort_results_as_defined = 'selected';
			                $sort_results_as_alphabetical = '';
			                $sort_results_as_number_of_votes = '';
			                $sort_results_rule_class = 'hide';
			                break;
			            }
			            case 'alphabetical': {
			                $sort_results_as_defined = '';
			                $sort_results_as_alphabetical = 'selected';
			                $sort_results_as_number_of_votes = '';
			                $sort_results_rule_class = 'hide';
			                break;
			            }
			            case 'number-of-votes': {
			                $sort_results_as_defined = '';
			                $sort_results_as_alphabetical = '';
			                $sort_results_as_number_of_votes = 'selected';
			                $sort_results_rule_class = '';
			                break;
			            }
			            default: {
			                $sort_results_as_defined = '';
			                $sort_results_as_alphabetical = '';
			                $sort_results_as_number_of_votes = '';
			                $sort_results_rule_class = 'hide';
			                break;
			            }
			        }
			        ?>
			        <select class="sort-results" style="width:100%">
			            <option value="as-defined" <?php echo $sort_results_as_defined;?>>
			                <?php _e( 'As Defined', 'yop-poll' );?>
			            </option>
			            <option value="alphabetical" <?php echo $sort_results_as_alphabetical;?>>
			                <?php _e( 'Alphabetical Order', 'yop-poll' );?>
			            </option>
			            <option value="number-of-votes" <?php echo $sort_results_as_number_of_votes;?>>
			                <?php _e( 'Number of votes', 'yop-poll' );?>
			            </option>
			        </select>
				</div>
			</div>
			<div class="form-group sort-results-rule-section <?php echo $sort_results_rule_class;?>">
				<div class="col-md-3">
					<?php _e( 'Sort rule', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<?php
			        if ( 'asc' === $poll->meta_data['options']['results']['sortResultsRule'] ) {
			            $sort_results_rule_asc = 'selected';
			            $sort_results_rule_desc = '';
			        } else {
			            $sort_results_rule_asc = '';
			            $sort_results_rule_desc = 'selected';
			        }
			        ?>
			        <select class="sort-results-rule" style="width:100%">
			            <option value="asc" <?php echo $sort_results_rule_asc?>><?php _e( 'Ascending', 'yop-poll' );?></option>
			            <option value="desc" <?php echo $sort_results_rule_desc?>><?php _e( 'Descending', 'yop-poll' );?></option>
			        </select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					<a href="#" class="upgrade-to-pro" data-screen="pie-results">
						<img src="<?php echo YOP_POLL_URL;?>admin/assets/images/pro-horizontal.svg" class="responsive" />
					</a>
					<?php _e( 'Display Results As', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<?php
			        if ( 'bar' === $poll->meta_data['options']['results']['displayResultsAs'] ) {
			            $display_results_as_bar = 'selected';
			            $display_results_as_pie = '';
			        } else {
			            $display_results_as_bar = '';
			            $display_results_as_pie = 'selected';
			        }
			        ?>
			        <select class="display-results-as" style="width:100%">
			            <option value="bar" <?php echo $display_results_as_bar;?>><?php _e( 'Bars', 'yop-poll' );?></option>
			            <option value="pie" <?php echo $display_results_as_pie;?>><?php _e( 'Pie', 'yop-poll' );?></option>
			        </select>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		&nbsp;
	</div>
</div>
