<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    
    <header class="site-header">
        <div class="container">
            <div class="site-branding">
                <?php
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    echo '<span style="font-size: 32px;">💊</span>';
                }
                ?>
                <div>
                    <h1 class="site-title">
                        <a href="<?php echo home_url(); ?>" rel="home">
                            <?php bloginfo('name'); ?>
                        </a>
                    </h1>
                    <p class="site-description"><?php bloginfo('description'); ?></p>
                </div>
            </div>

            <nav class="main-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'fallback_cb' => 'default_pharmacy_menu'
                ));
                ?>
            </nav>
        </div>
    </header>

    <?php
    function default_pharmacy_menu() {
        echo '<ul>';
        echo '<li><a href="' . home_url() . '">Home</a></li>';
        echo '<li><a href="#">Services</a></li>';
        echo '<li><a href="#">About</a></li>';
        echo '<li><a href="#">Contact</a></li>';
        echo '</ul>';
    }
    ?>
