<?php
// =========================================================================
// Modify main shortcode
// =========================================================================
function modify_img_caption_shortcode($attr, $content = null) {
    // New-style shortcode with the caption inside the shortcode with the link and image tags.
    
    if ( ! isset( $attr['caption'] ) ) {
        if ( preg_match( '#((?:<a [^>]+>\s*)?<img [^>]+>(?:\s*</a>)?)(.*)#is', $content, $matches ) ) {
            $content = $matches[1];
            $attr['caption'] = trim( $matches[2] );
        }
    }
    // Allow plugins/themes to override the default caption template.
    $output = apply_filters('img_caption_shortcode', '', $attr, $content);
    
    if ( $output != '' )
        return $output;
    extract(shortcode_atts(array(
        'id'	  => '',
        'align'	  => 'alignnone',
        'width'	  => '',
        'caption' => ''
    ), $attr));
    // print_r($attr);
    if ( 1 > (int) $width || empty($caption) )
        return $content;
    if ( $id ) $id = 'id="' . esc_attr($id) . '" ';
    return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="">'
    . do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}

add_shortcode('wp_caption', 'modify_img_caption_shortcode');
add_shortcode('caption', 'modify_img_caption_shortcode');
