<?php
define('WP_USE_THEMES', false);
require('./wp-load.php');

$post_id = 5;
$new_content = "Hints:\n1. Find the vulnerable plugin\n2. Exploit AJAX endpoint\n3. Achieve RCE\n4. Extract credentials for Stage 5";

wp_update_post(array(
    'ID' => $post_id,
    'post_content' => $new_content
));

echo "Post updated successfully!\n";
echo "New content:\n" . get_post_field('post_content', $post_id);
?>
