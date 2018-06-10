<?php 

    // GET OPTIONS
    $canon_options_frame = get_option('canon_options_frame');

    $datetime_string = $canon_options_frame['countdown_datetime_string'];
    $gmt_offset = $canon_options_frame['countdown_gmt_offset'];
    $format = "dHMS";
    $use_compact = "unchecked";
    $description = $canon_options_frame['countdown_description'];
    $layout = '<strong>{desc}</strong> {dn} {dl} {hn} {hl} {mn} {ml} {sn} {sl}';

?>

	                            <div class="countdown"
	                            	data-label_years = "<?php esc_html_e("Years", "loc-canon-belle"); ?>"
	                            	data-label_months = "<?php esc_html_e("Months", "loc-canon-belle"); ?>"
	                            	data-label_weeks = "<?php esc_html_e("Weeks", "loc-canon-belle"); ?>"
	                            	data-label_days = "<?php esc_html_e("Days", "loc-canon-belle"); ?>"
	                            	data-label_hours = "<?php esc_html_e("Hours", "loc-canon-belle"); ?>"
	                            	data-label_minutes= "<?php esc_html_e("Minutes", "loc-canon-belle"); ?>"
	                            	data-label_seconds = "<?php esc_html_e("Seconds", "loc-canon-belle"); ?>"
	                            	
	                            	data-label_year = "<?php esc_html_e("Year", "loc-canon-belle"); ?>"
	                            	data-label_month = "<?php esc_html_e("Month", "loc-canon-belle"); ?>"
	                            	data-label_week = "<?php esc_html_e("Week", "loc-canon-belle"); ?>"
	                            	data-label_day = "<?php esc_html_e("Day", "loc-canon-belle"); ?>"
	                            	data-label_hour = "<?php esc_html_e("Hour", "loc-canon-belle"); ?>"
	                            	data-label_minute= "<?php esc_html_e("Minute", "loc-canon-belle"); ?>"
	                            	data-label_second = "<?php esc_html_e("Second", "loc-canon-belle"); ?>"
	                            	
	                            	data-label_y = "<?php esc_html_e("Y", "loc-canon-belle"); ?>"
	                            	data-label_m = "<?php esc_html_e("M", "loc-canon-belle"); ?>"
	                            	data-label_w = "<?php esc_html_e("W", "loc-canon-belle"); ?>"
	                            	data-label_d = "<?php esc_html_e("D", "loc-canon-belle"); ?>"

	                            	data-datetime_string = "<?php echo esc_attr($datetime_string); ?>"
	                            	data-gmt_offset = "<?php echo esc_attr($gmt_offset); ?>"
	                            	data-format = "<?php echo esc_attr($format); ?>"
	                            	data-use_compact = "<?php echo esc_attr($use_compact); ?>"
	                            	data-description = '<?php echo esc_attr($description); ?>'
	                            	data-layout = '<?php echo wp_kses_post($layout); ?>'
	                            ></div>
