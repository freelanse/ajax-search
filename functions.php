<?php
add_action('wp_ajax_ajax_search', 'handle_ajax_search');
add_action('wp_ajax_nopriv_ajax_search', 'handle_ajax_search');

function handle_ajax_search() {
$query = isset($_GET['query']) ? sanitize_text_field($_GET['query']) : '';

if (strlen($query) < 3) {
wp_send_json_error(['message' => 'Запрос слишком короткий']);
}

$args = [
's'              => $query,
'post_type'      => ['post', 'page'],
'post_status'    => 'publish',
'posts_per_page' => 10,
];

$search_query = new WP_Query($args);
$results = [];

if ($search_query->have_posts()) {
while ($search_query->have_posts()) {
$search_query->the_post();
$results[] = [
'title' => get_the_title(),
'link'  => get_permalink(),
];
}
wp_reset_postdata();
}

wp_send_json_success(['results' => $results]);
}
