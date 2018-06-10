<?php 

    // GET OPTIONS
    $canon_options_frame = get_option('canon_options_frame');

    echo "<div class='header_banner'>";

    if (!empty($canon_options_frame['banner_code'])) {

        echo wp_kses_post($canon_options_frame['banner_code']);
            
    } else {

        printf("<img src='%s/img/banner_468x60.gif'>", esc_url(get_template_directory_uri()) );
            
    }

    echo "</div>";

?>