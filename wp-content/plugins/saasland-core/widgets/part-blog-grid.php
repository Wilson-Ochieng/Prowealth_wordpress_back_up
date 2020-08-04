<section class="blog_area_two">
    <div class="blog_grid_info">
        <div class="container">
            <div class="row">
                <?php
                while($wp_query->have_posts()) : $wp_query->the_post();
                    ?>
                    <div <?php post_class('col-lg-6') ?>>
                        <div class="blog_list_item blog_list_item_two">
                            <?php
                            if(has_post_thumbnail()) : ?>
                                <div class="post_date">
                                    <h2> <?php the_time('d') ?> <span> <?php the_time('M') ?> </span></h2>
                                </div>
                            <?php endif; ?>

                            <a href="<?php the_permalink() ?>">
                                <?php the_post_thumbnail('saasland_370x300', array('class' => 'img-fluid')) ?>
                            </a>

                            <div class="blog_content">

                                <a href="<?php the_permalink() ?>">
                                    <h5 class="blog_title" title="<?php the_title_attribute() ?>"> <?php saasland_limit_latter(get_the_title(), 48); ?> </h5>
                                </a>

                                <p> <?php echo strip_shortcodes(wp_trim_words(get_the_content(), $excerpt_limit_word)) ?> </p>

                                <div class="post-info-bottom">
                                    <a href="<?php the_permalink() ?>" class="learn_btn_two">
                                        <?php echo esc_html($settings['read_more']) ?>
                                        <i class="arrow_right"></i>
                                    </a>
                                    <?php if(function_exists('saasland_comment_count')) : ?>
                                        <a class="post-info-comments" href="<?php the_permalink() ?>#comments">
                                            <i class="icon_comment_alt" aria-hidden="true"></i>
                                            <span> <?php saasland_comment_count(get_the_ID()) ?> </span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;

                if(function_exists('saasland_pagination')) {
                    saasland_pagination();
                    wp_reset_query();
                }
                ?>
            </div>
        </div>
    </div>

</section>