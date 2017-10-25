<?php
/**
 *
 *  Force http/s for images in WordPress
 *
 *  Source:
 *  https://core.trac.wordpress.org/ticket/15928#comment:63
 *
 *  @param $url
 *  @param $post_id
 *
 *  @return string
 */
function ssl_post_thumbnail_urls( $url, $post_id ) {
    
    //Skip file attachments
    if ( ! wp_attachment_is_image( $post_id ) ) {
        return $url;
    }

    //Correct protocol for https connections
    list( $protocol, $uri ) = explode( '://', $url, 2 );

    if ( is_ssl() ) {
        if ( 'http' == $protocol ) {
            $protocol = 'https';
        }
    } else {
        if ( 'https' == $protocol ) {
            $protocol = 'http';
        }
    }

    return $protocol . '://' . $uri;
}

add_filter( 'wp_get_attachment_url', 'ssl_post_thumbnail_urls', 10, 2 );