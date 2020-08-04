<?php
wp_enqueue_script( 'imagesloaded' );
wp_enqueue_script( 'isotope' );
?>
<section class="blog_area_two">
    <div class="container">
        <div class="row blog_grid_info" id="blog_masonry">
            <?php
            while($wp_query->have_posts()) : $wp_query->the_post();
                ?>
                <div class="col-lg-4">
                    <div class="blog_list_item blog_list_item_two">
                        <?php if( has_post_thumbnail() ) : ?>
                        <a href="<?php saasland_day_link() ?>" class="post_date">
                            <h2> <?php the_time('d') ?> <span> <?php the_time('M') ?> </span></h2>
                        </a>
                        <?php endif; ?>
                        <a href="<?php the_permalink() ?>">
                            <?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) ) ?>
                        </a>
                        <div class="blog_content">
                            <a href="<?php the_permalink() ?>">
                                <h5 class="blog_title"> <?php the_title() ?> </h5>
                            </a>
                            <p> <?php echo strip_shortcodes(wp_trim_words(get_the_content(), $excerpt_limit_word)) ?> </p>
                            <div class="post-info-bottom">
                                <a href="<?php the_permalink() ?>" class="learn_btn_two">
                                    <?php echo esc_html($settings['read_more']) ?> <i class="arrow_right"></i>
                                </a>
                                <a class="post-info-comments" href="<?php the_permalink() ?>#comments">
                                    <i class="icon_comment_alt" aria-hidden="true"></i>
                                    <span> <?php saasland_comment_count(get_the_ID()) ?> </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            endwhile;

            ?>
        </div>
        <?php
        if(function_exists('saasland_pagination')) {
            saasland_pagination();
            wp_reset_query();
        }
        ?>
    </div>
</section>