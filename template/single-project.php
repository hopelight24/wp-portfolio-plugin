<div class="w3-row">
    <?php
    $terms = wp_get_post_terms($project->ID, array('project-cat'));

    $img_url = wp_get_attachment_image_url(get_post_thumbnail_id($project->ID), 'full'); ?>
    <?php if (!empty($img_url)) : ?>
        <div class="w3-col m4 s12 w3-center"><img src="<?php echo $img_url; ?>"></div>
    <?php endif; ?>
    <div class="popup-project-categoty">
        <strong><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path d="M0 80V229.5c0 17 6.7 33.3 18.7 45.3l176 176c25 25 65.5 25 90.5 0L418.7 317.3c25-25 25-65.5 0-90.5l-176-176c-12-12-28.3-18.7-45.3-18.7H48C21.5 32 0 53.5 0 80zm112 32a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
            </svg></strong>
        <?php foreach ($terms as $term) : ?>
            <span><?php echo $term->name; ?></span>
        <?php endforeach; ?>
    </div>
    <div class="popup-project-title">
        <?php echo $project->post_title; ?>
    </div>

    <div class="w3-col m8 s12 ">
        <?php echo $project->post_content; ?>
    </div>

        <div class="project__images">
            <?php $project_img_1 =   get_post_meta( $project->ID, 'project_image_1', true); ?>
            <?php $project_img_2 =   get_post_meta( $project->ID, 'project_image_2', true); ?>

            <?php if($project_img_1): ?>
                <img src="<?php echo $project_img_1; ?>">
            <?php endif; ?>
            <?php if($project_img_2): ?>
                <img src="<?php echo $project_img_2; ?>">
            <?php endif; ?>
        </div>
    <div class="portfoli-buttons">  

        <a href="<?php echo get_post_meta( $project->ID, '_external_url', true); ?>" target="_blank" >Preview</a>
    </div>
</div>