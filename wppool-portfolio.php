<?php
/*
 * Plugin Name:       Simple Portfolio
 * Plugin URI:        https://github.com/hopelight24/wp-portfolio-plugin
 * Description:       Simple Portfolio custom post type for custom content.
 * Version:           1.0.0
 * Author:            Sazzad Mahmud
 * Author URI:        https://hopelight24.github.io/
 *
 */

if (!defined('ABSPATH')) {
	exit('Sorry, you are not allowed to access this file directly.');
}



/** Plugin directory */
define('SP_CPT_PLUGIN_DIR', trailingslashit(dirname(__FILE__)));

/** Plugin base directory */
define('SP_CPT_PLUGIN_BASEDIR', trailingslashit(dirname(plugin_basename(__FILE__))));

add_action('init', 'wppool_sazzad_cpt_portfolio_post_type', 0);
/*
 Register Portfolio  CPT.
 */
function wppool_sazzad_cpt_portfolio_post_type()
{

	$labels = array(
		'name'                  => _x('Projects', 'Post Type General Name', 'simple-portfolio'),
		'singular_name'         => _x('Project', 'Post Type Singular Name', 'simple-portfolio'),
		'menu_name'             => _x('Projects', 'Admin menu name', 'simple-portfolio'),
		'name_admin_bar'        => _x('Project', 'Toolbar name', 'simple-portfolio'),
		'archives'              => __('Project Archive', 'simple-portfolio'),
		'attributes'            => __('Project Attributes', 'simple-portfolio'),
		'parent_item_colon'     => __('Parent Project:', 'simple-portfolio'),
		'all_items'             => __('All Projects', 'simple-portfolio'),
		'add_new_item'          => __('Add New Project', 'simple-portfolio'),
		'add_new'               => __('Add New', 'simple-portfolio'),
		'new_item'              => __('New Project', 'simple-portfolio'),
		'edit_item'             => __('Edit Project', 'simple-portfolio'),
		'update_item'           => __('Update Project', 'simple-portfolio'),
		'view_item'             => __('View Project', 'simple-portfolio'),
		'view_items'            => __('View Projects', 'simple-portfolio'),
		'search_items'          => __('Search Projects', 'simple-portfolio'),
		'not_found'             => __('Not found', 'simple-portfolio'),
		'not_found_in_trash'    => __('Not found in Trash', 'simple-portfolio'),
		'featured_image'        => __('Featured Image', 'simple-portfolio'),
		'set_featured_image'    => __('Set featured image', 'simple-portfolio'),
		'remove_featured_image' => __('Remove featured image', 'simple-portfolio'),
		'use_featured_image'    => __('Use as featured image', 'simple-portfolio'),
		'insert_into_item'      => __('Insert into Project', 'simple-portfolio'),
		'uploaded_to_this_item' => __('Uploaded to this Project', 'simple-portfolio'),
		'items_list'            => __('Projects list', 'simple-portfolio'),
		'items_list_navigation' => __('Projects list navigation', 'simple-portfolio'),
		'filter_items_list'     => __('Filter Projects list', 'simple-portfolio'),
	);

	$supports = array(
		'title',
		'editor',
		'thumbnail',
		'custom-fields',
	);

	$args = array(
		'label'                 => __('Project', 'simple-portfolio'),
		'description'           => __('Custom Project description', 'simple-portfolio'),
		'labels'                => $labels,
		'supports'              => $supports,
		'taxonomies'            => array('project-cat'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-portfolio',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'rewrite'               => array('slug' => 'projects',),
		'has_archive'           => 'projects',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
		'register_meta_box_cb' => 'external_url_meta_box'
	);

	register_post_type('projects ', $args);
}


add_action('init', 'wppool_test_cpt_portfolio_category', 0);

function wppool_test_cpt_portfolio_category()
{

	$labels = array(
		'name'                       => _x('Project Categories', 'Taxonomy General Name', 'simple-portfolio'),
		'singular_name'              => _x('Project Category', 'Taxonomy Singular Name', 'simple-portfolio'),
		'menu_name'                  => _x('Categories', 'Admin menu name', 'simple-portfolio'),
		'all_items'                  => __('All Categories', 'simple-portfolio'),
		'parent_item'                => __('Parent Category', 'simple-portfolio'),
		'parent_item_colon'          => __('Parent Category:', 'simple-portfolio'),
		'new_item_name'              => __('New Category Name', 'simple-portfolio'),
		'add_new_item'               => __('Add New Category', 'simple-portfolio'),
		'edit_item'                  => __('Edit Category', 'simple-portfolio'),
		'update_item'                => __('Update Category', 'simple-portfolio'),
		'view_item'                  => __('View Category', 'simple-portfolio'),
		'separate_items_with_commas' => __('Separate Categories with commas', 'simple-portfolio'),
		'add_or_remove_items'        => __('Add or remove Categories', 'simple-portfolio'),
		'choose_from_most_used'      => __('Choose from the most used', 'simple-portfolio'),
		'popular_items'              => __('Popular Categories', 'simple-portfolio'),
		'search_items'               => __('Search Categories', 'simple-portfolio'),
		'not_found'                  => __('Not Found', 'simple-portfolio'),
		'no_terms'                   => __('No Categories', 'simple-portfolio'),
		'items_list'                 => __('Categories list', 'simple-portfolio'),
		'items_list_navigation'      => __('Categories list navigation', 'simple-portfolio'),
	);

	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'show_in_rest'               => true,
	);

	register_taxonomy('project-cat', array('projects'),  $args);
}

/* Project CPT Custom Meta Box Register */
function external_url_meta_box()
{
	add_meta_box(
		'external_url',
		__('Project External URL', 'simple-portfolio'),
		'external_url_field_meta_box_callback',
		'projects'
	);

	add_meta_box(
		'first_image',
		__('First Image', 'textdomain'),
		'first_image_html',
		'projects'
	);

	add_meta_box(
		'second_image',
		__('Second Image', 'textdomain'),
		'second_image_html',
		'projects'

	);
}

add_action('add_meta_boxes', 'external_url_meta_box');


function first_image_html($post)
{

	$meta = (get_meta($post, 'project_image_1')) ? esc_url(get_meta($post, 'project_image_1')) : '';
?>
	<div class="aw-uploader">
		<p>
			<label for="portrait"><?php _e('Project Image 1', 'zuki') ?></label><br>
			<input type="text" name="project_image_1" id="meta-image" class="meta-image" value="<?php echo $meta ?>">
			<input type="button" class="" id="meta-image-button" value="Browse">
		</p>
		<?php if (!empty($meta)) : ?>
			<div class="image-preview"><img src="<?php echo $meta ?>" style="width:200px"><br><button type="button" style="background: #8f0707;border: none;color: #fff;padding: 5px 10px;border-radius: 5px;cursor: pointer;" id="project_img_1">Remove</button></div>
		<?php endif; ?>
	</div>


<?php

}


/**
 * Loads the image management javascript
 */
function prfx_image_enqueue()
{
	wp_enqueue_media();

	// Registers and enqueues the required javascript.
	wp_register_script('meta-box-image', plugin_dir_url(__FILE__) . 'js/meta-box-image.js', array('jquery'));
	wp_localize_script(
		'meta-box-image',
		'meta_image',
		array(
			'title' => __('Choose or Upload an Image', 'prfx-textdomain'),
			'button' => __('Use this image', 'prfx-textdomain'),
		)
	);
	wp_enqueue_script('meta-box-image');
}
add_action('admin_enqueue_scripts', 'prfx_image_enqueue');

function second_image_html($post)
{

	$meta = (get_meta($post, 'project_image_2')) ? esc_url(get_meta($post, 'project_image_2')) : '';
?>
	<div class="aw-uploader">
		<p>
			<label for="second_image"><?php _e('Project Image 2', 'zuki') ?></label><br>
			<input type="text" name="project_image_2" id="meta-image2" class="meta-image" value="<?php echo $meta ?>">
			<input type="button" id="meta-image-button2" value="Browse">
		</p>
		<?php if (!empty($meta)) : ?>
			<div class="image-preview"><img src="<?php echo $meta ?>" style="width:200px"><br><button style="background: #8f0707;border: none;color: #fff;padding: 5px 10px;border-radius: 5px;cursor: pointer;" type="button" id="project_img_2">Remove</button></div>
		<?php endif; ?>
	</div>
<?php

}
function get_meta($post, $fieldname)
{
	if (isset($post) && !empty($fieldname)) {

		return get_post_meta($post->ID, $fieldname, true);
	}
}



function external_url_field_meta_box_callback($post)
{
	wp_nonce_field('external_url_nonce', 'external_url_nonce');
	$value = get_post_meta($post->ID, '_external_url', true);
	echo '<input id="external_url" type="text" style="width:100%;" name="external_url" value="' .  esc_attr($value)  . '">';
}


function save_external_url_meta_box_data($post_id)
{

	if (!isset($_POST['external_url_nonce'])) {
		return;
	}

	// Verify that the nonce is valid.
	if (!wp_verify_nonce($_POST['external_url_nonce'], 'external_url_nonce')) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	// Check the user's permissions.
	if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {

		if (!current_user_can('edit_page', $post_id)) {
			return;
		}
	} else {

		if (!current_user_can('edit_post', $post_id)) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */

	// Make sure that it is set.
	if (!isset($_POST['external_url'])) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field($_POST['external_url']);

	// Update the meta field in the database.
	update_post_meta($post_id, '_external_url', $my_data);

	update_post_meta(
		$post_id,
		'project_image_1',
		$_POST['project_image_1']
	);

	update_post_meta(
		$post_id,
		'project_image_2',
		$_POST['project_image_2']
	);
}

add_action('save_post', 'save_external_url_meta_box_data');


// meta box value  load  when  post edit
function external_url_before_post($content)
{

	global $post;

	// retrieve the meta value of the current post
	$external_url = esc_attr(get_post_meta($post->ID, '_external_url', true));

	$notice = "<div class='wppool_external_url'>$external_url</div>";

	return $notice . $content;
}

add_filter('the_content', 'external_url_before_post');



function wppool_portfolio_load_css()
{

	echo  '<link rel="stylesheet" href="' . plugin_dir_url(__FILE__) . 'template/style.css' . '">';
}
add_action('wp_head', 'wppool_portfolio_load_css');

function wppool_portfolio_load_js()
{

?>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/2.1.11/jquery.mixitup.min.js"></script>

	<script>
		jQuery(function() {

			var filterList = {
				init: function() {
					jQuery('#gallery').mixItUp({
						selectors: {
							target: '.gallery-item',
							filter: '.filter'
						},
						load: {
							filter: '.all'
						}
					});
				}

			};


			filterList.init();

		});




		function get_project_data(project_id) {
			$('.popup').fadeIn(350);
			$.get('<?php echo admin_url('admin-ajax.php'); ?>?action=get_single_project', {
				id: project_id
			}, function(res) {
				let response = JSON.parse(res);
				jQuery('.responseContent').html('');
				jQuery('.responseContent').html(response.content);
			});
		}

		$('.popup-close').on('click', function(e) {
			$('.popup').fadeOut(350);
			e.preventDefault();
		});
	</script>
<?php

}
add_action('wp_footer', 'wppool_portfolio_load_js');


function wppool_projects()
{
	ob_start();
	include SP_CPT_PLUGIN_DIR . 'template/projects.php';
	return ob_get_clean();
}

add_shortcode('wppool-projects', 'wppool_projects');




function simple_portfolio_add_settings_page()
{
	add_options_page('Simple Portfolio', 'Simple Portfolio', 'manage_options', 'dbi-example-plugin', 'simple_portfolio_setting_page');
}
add_action('admin_menu', 'simple_portfolio_add_settings_page');

function simple_portfolio_setting_page()
{
?>
	<h2>Simple Portfolio</h2>

	<p>Call Simple Portfolio</p>
	<div class="short" style="font-size: 22px;
    background: #fff;
    max-width: 500px;
    padding: 15px 15px 20px;">
		[wppool-projects]
	</div>


<?php
}


// popup ajax  
add_action("wp_ajax_get_single_project", "get_single_project");
add_action("wp_ajax_nopriv_get_single_project", "get_single_project");

function get_single_project()
{
	$project_id = (isset($_GET['id'])) ? (int) trim($_GET['id']) : 0;
	if (empty($project_id)) {
		echo json_encode(['content' => '<p>Project not found</p>']);
		exit();
	}

	$project   = get_post($project_id);
	if (empty($project)) {
		echo json_encode(['content' => '<p>Project not found</p>']);
		exit();
	}
	ob_start();
	include SP_CPT_PLUGIN_DIR . 'template/single-project.php';
	$html =  ob_get_clean();
	echo json_encode(['content' => $html]);
	exit();
}
