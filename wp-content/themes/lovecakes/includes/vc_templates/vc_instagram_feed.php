<?php
vc_map( array(
    "name" => __("Instagram Feed"),
    "base" => "dg_instagram_feed",
    "category" => __('Content'),
    'icon' => 'icon-wpb-single-image',
    'description' => 'Instagram Feed',
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("User ID"),
            "param_name" => "userid",
        ),
        array(
            "type" => "textfield",
            "heading" => __("Access Token"),
            "param_name" => "token",
        ),
    )
));
add_shortcode('dg_instagram_feed', 'instaFeed');
function instaFeed($atts) {
    $args = shortcode_atts( array(
        'userid' => '',
        'token' => '',
    ), $atts);
    $userid = $args['userid'];
    $token = $args['token'];
    $url = "https://api.instagram.com/v1/users/{$userid}/media/recent/?access_token={$token}";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    $result = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($result);

    $html = '
    <div class="row">';
    foreach($result->data as $post) {
        $html .= '
        <div class="col-xs-12 col-md-3 insta-wrapper">
            <a href="' . $post->link . '" target="_blank"><img src="' . $post->images->standard_resolution->url . '" alt="' . $post->caption->text . '" /></a>
        </div>';

    }
    $html .= '
    </div>';
    return $html;
    //print_r($result->data);
}