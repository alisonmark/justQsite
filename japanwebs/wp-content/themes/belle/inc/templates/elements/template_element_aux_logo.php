<?php
    
    // GET OPTIONS
    $canon_options_frame = get_option('canon_options_frame');

?>

                                    <div class="element-aux-logo">
                                        <?php 
                                            if (!empty($canon_options_frame['aux_logo_url'])) {
                                                echo '<a href="'. home_url() .'" class="aux-logo"><img src="'. $canon_options_frame['aux_logo_url'] .'" alt="Auxiliary logo"></a>';
                                            } else {
                                                echo '<a href="'. home_url() .'" class="aux-logo"><img src="'. get_template_directory_uri() .'/img/logo@2x-dark.png" alt="Auxiliary logo"></a>';
                                            }
                                        ?>
                                    </div>
