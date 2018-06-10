<?php
    
    // GET OPTIONS
    $canon_options_frame = get_option('canon_options_frame');

?>

                                    <div class="element-logo">
                                        <?php 
                                            if (!empty($canon_options_frame['logo_text'])) {

                                                echo '<a href="'. home_url() .'" class="logo-text">';
                                                printf('<span class="text-logo">%s</span>', wp_kses_post($canon_options_frame['logo_text']));
                                                if ($canon_options_frame['logo_text_append_tagline'] == "checked") { printf('<span class="tagline">%s</span>', get_bloginfo('description')); }
                                                echo '</a>';

                                            } elseif (!empty($canon_options_frame['logo_url'])) {
                                                echo '<a href="'. home_url() .'" class="logo"><img src="'. $canon_options_frame['logo_url'] .'" alt="Logo"></a>';
                                            } else {
                                                echo '<a href="'. home_url() .'" class="logo"><img src="'. get_template_directory_uri() .'/img/logo@2x.png" alt="Logo"></a>';
                                            }
                                        ?>
                                    </div>
