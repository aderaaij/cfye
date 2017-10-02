<?php
// =========================================================================
// Add a div to content iframes for styling purposes
// =========================================================================
function wrap_embed_with_div($html, $url, $attr) {    
    return '<div class="m-article__iframe">' . $html . '</div>';
}    
add_filter('embed_oembed_html', 'wrap_embed_with_div', 10, 3);