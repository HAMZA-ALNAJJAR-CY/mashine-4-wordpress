<?php
define('WP_USE_THEMES', false);
require('./wp-load.php');

$post_id = 5;
wp_update_post(array(
    'ID' => $post_id,
    'post_title' => 'Challenge Info'
));

echo "Post title updated to: " . get_the_title($post_id) . "\n";
?>
