<div class="portfolio-wrap">
    <div class="gallery-wrap">

        <?php

        $terms = get_terms('project-cat', array(
            'hide_empty' => false,
        ));

        ?>

        <ul id="filters" class="clearfix">
            <li><span class="filter active" data-filter=".all">All</span></li>
            <?php if (!empty($terms)) {
                foreach ($terms as $term) {
                    echo '<li><span class="filter" data-filter=".' . $term->slug . '">' . $term->name . '</span></li>';
                }
            } ?>

        </ul>

        <div id="gallery">
            <?php
            $args = array(
                'post_type' => 'projects',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'orderby' => 'title',
                'order' => 'ASC',
            );

            $loop = new WP_Query($args);

            while ($loop->have_posts()) : $loop->the_post();
                $img_url = wp_get_attachment_image_url(get_post_thumbnail_id(get_the_ID()), 'full');
                $single_terms = wp_get_post_terms(get_the_ID(), array('project-cat'));
                $single_term = [];
                $single_slug = [];
            ?>
                <?php foreach ($single_terms as $single) : ?>
                    <?php $single_term[] =  $single->name; ?>
                    <?php $single_slug[] =  $single->slug; ?>
                <?php endforeach; ?>

                <a class="gallery-item all <?php echo implode(' ', $single_slug); ?>" href="#" onclick="get_project_data(<?php echo get_the_ID(); ?>)" data-cat="<?php echo implode(' ', $single_slug); ?>">
                    <div class="inside">
                        <div class="details">
                            <div class="text">
                                <h6><?php the_title(); ?></h6>
                                <p><?php echo implode(', ', $single_term); ?></p>
                            </div>
                        </div>
                        <div class="overlay"></div>
                        <img src="<?php echo $img_url; ?>" alt="" />
                    </div>
                </a>

            <?php endwhile;

            wp_reset_postdata();
            ?>





        </div><!--/gallery-->

    </div><!--/gallery-wrap-->

</div>



<!-- Modal Content #1-->
<div class="popup">
    <div class="popup-inner">
        <a class="popup-close" href="javascript:void(0);">x</a>
        <div class="responseContent"></div>
    </div>
</div>