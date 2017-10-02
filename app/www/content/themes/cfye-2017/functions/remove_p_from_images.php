<?php
// =========================================================================
// Remove paragraph tags from content images
// =========================================================================
function remove_p_from_images($content){
    return preg_replace('/<p>\\s*?(<a .*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s', '\1', $content);
}
add_filter('the_content', 'remove_p_from_images');