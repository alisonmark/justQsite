<?php
//Function to Trim Excerpt Length & more..
function synapse_excerpt_length( $length ) {
    return 23;
}
add_filter( 'excerpt_length', 'synapse_excerpt_length', 999 );

function synapse_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'synapse_excerpt_more' );