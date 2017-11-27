<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
	    <title><?php wp_title() ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=6.0, user-scalable=yes">       
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri() ?>/assets/img/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri() ?>/assets/img/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri() ?>/assets/img/favicons/favicon-16x16.png">
        <link rel="manifest" href="<?php echo get_template_directory_uri() ?>/assets/img/favicons/manifest.json">
        <link rel="mask-icon" href="<?php echo get_template_directory_uri() ?>/assets/img/favicons/safari-pinned-tab.svg" color="#ec008c">
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/assets/img/favicons/favicon.ico">
        <meta name="msapplication-config" content="<?php echo get_template_directory_uri() ?>/assets/img/favicons/browserconfig.xml">
        <meta name="theme-color" content="#ec008c">
        <?php wp_head() ?>
    </head>
    <body class='no-js is-loadingBar is-loadingInit'>
        <script type="text/javascript">
            document.body.classList.remove('no-js');
        </script>
        <?php get_template_part('partials/header/piwik') ?>
        <div class='l-site'>
            <div class='l-site__header'>
                <header class="m-siteHeader">
                    <div class="m-siteHeader__title">
                        <div class='m-siteLogo'>
                            <a href="<?php echo get_home_url() ?>" title="CFYE.com">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 382.1 381.8">
                                    <path d="M140.4 329.1L34.7 239.3v-31.9H.7v46.8l112.4 93.7H.8v33.9h173.4V207.4h-33.8zM382 207.3l-173.4.1v174.4H382v-33.9H269.7l112.5-93.7v-46.8h-.2v-.1zM242.4 329.1v-88.4h104l-104 88.4zm-1.8-230.3V34.7h106.9v21.6h34.3V.8h-175v173.7h33.8v-42.7h140.6v-33zm-66.9 41.6H33.9V33.7h105.8v21.2H174V0H0v174.2h173.7z" fill="#fff"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class='m-siteHeader__nav'>
                        <nav class="m-siteNav">
                        <?php wp_nav_menu( 
                            array( 
                                'theme_location' => 'header-menu',
                                'menu_id' => '',
                                'menu_class' => '',
                                'container' => '',                                
                            ) 
                        ); ?>
                        </nav>
                    </div>
                    <!-- <button class='m-navButton'>
                        <span>Open Menu</span>
                    </button> -->
                </header>
            </div><!-- .l-siteHeader -->
            <!-- <div class='m-siteMenu'>
                <div class='m-siteMenu__inner'>
                    <nav class='m-siteMenu__nav'>
                        <?php wp_nav_menu( 
                            array( 
                                'theme_location' => 'header-menu',
                                'menu_id' => '',
                                'menu_class' => '',
                                'container' => '',                                
                            ) 
                        ); ?>
                    </nav>
                </div>
            </div> -->
            
            <div id="barba-wrapper">
                <div class="barba-container" data-namespace="<?php current_page_name() ?>">