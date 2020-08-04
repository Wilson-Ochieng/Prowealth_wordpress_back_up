<?php

add_image_size('saasland_370x300', 370, 300, true); // Screenshot carousel style 6
add_image_size('saasland_85x70', 85, 70, true); // Screenshot carousel style 6
add_image_size('saasland_228x405', 228, 405, true); // Screenshot carousel style 6
add_image_size('saasland_370x280', 370, 280, true); // Blog masonry thumbnail size
add_image_size('saasland_370x700', 370, 700, true); // Blog masonry thumbnail size
add_image_size('saasland_370x190', 370, 190, true); // Blog grid thumbnail size
add_image_size('saasland_80x80', 80, 80, true); // Testimonial author image
add_image_size('saasland_70x70', 70, 70, true); // Testimonial author image and Job post thumbnail
add_image_size('saasland_83x88', 83, 88, true); // Testimonial author image and Job post thumbnail
add_image_size('saasland_100x100', 100, 100, true); // Testimonial author image
add_image_size('saasland_85x90', 520, 300, true); // Testimonial style two author image
add_image_size('saasland_960x500', 960, 500, true); // Portfolio thumbnail for fullwidth 2 columns
add_image_size('saasland_370x400', 370, 400, true); // Portfolio thumbnail for 3 columns
add_image_size('saasland_270x350', 270, 350, true); // Portfolio thumbnail for 4 columns
add_image_size('saasland_570x400', 570, 400, true); // Portfolio thumbnail for 2 columns
add_image_size('saasland_640x450', 640, 450, true); // Portfolio thumbnail for 3 columns full width
add_image_size('saasland_480x450', 480, 450, true); // Portfolio thumbnail for 3 columns full width
add_image_size('saasland_240x220', 240, 220, true); // Job post thumbnail
add_image_size('saasland_240x250', 240, 250, true); // Related post thumbnail
add_image_size('saasland_450x420', 450, 420, true); // Shop list view thumbnail
add_image_size('saasland_80x90', 80, 90, true); // Shop list view thumbnail

// Elementor is anchor external target
function saasland_is_external($settings_key) {
    if(isset($settings_key['is_external'])) {
        echo $settings_key['is_external'] == true ? 'target="_blank"' : '';
    }
}


function saasland_icon_array($k, $replace = 'icon', $separator = '-') {
    $v = array();
    foreach ($k as $kv) {
        $kv = str_replace($separator, ' ', $kv);
        $kv = str_replace($replace, '', $kv);
        $v[] = array_push($v, ucwords($kv));
    }
    foreach($v as $key => $value) if($key&1) unset($v[$key]);
    return array_combine($k, $v);
}


// Social Share
function saasland_social_share() { ?>
    <div class="social_icon">
        <?php esc_html_e('share:', 'saasland-core') ?>
        <ul class="list-unstyled">
            <li><a href="https://facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="social_facebook"></i></a></li>
            <li><a href="https://twitter.com/intent/tweet?text=<?php the_permalink(); ?>"><i class="social_twitter"></i></a></li>
            <li><a href="https://www.pinterest.com/pin/create/button/?url=<?php the_permalink() ?>"><i class="social_pinterest"></i></a></li>
            <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>"><i class="social_linkedin"></i></a></li>
        </ul>
    </div>
    <?php
}

add_filter('gettext','saasland_enter_title');
function saasland_enter_title( $input ) {
    global $post_type;
    if( is_admin() && 'Enter title here' == $input && 'team' == $post_type )
        return 'Enter here the team member name';
    return $input;
}


// Category array
function saasland_cat_array($term = 'category') {
    $cats = get_terms( array(
        'taxonomy' => $term,
        'hide_empty' => true
    ));
    $cat_array = array();
    $cat_array['all'] = esc_html__('All', 'saasland-core');
    foreach ($cats as $cat) {
        $cat_array[$cat->slug] = $cat->name;
    }
    return $cat_array;
}


// Get the first category name
function saasland_first_category($term = 'category') {
    $cats = get_the_terms(get_the_ID(), $term);
    $cat  = is_array($cats) ? $cats[0]->name : '';
    echo esc_html($cat);
}

// Get the first category link
function saasland_first_category_link($term='category') {
    $cats = get_the_terms(get_the_ID(), $term);
    $cat  = is_array($cats) ? get_category_link($cats[0]->term_id) : '';
    echo esc_url($cat);
}