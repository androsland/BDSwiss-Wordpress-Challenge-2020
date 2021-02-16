<?php

/**
 * @package BDSwissRSS
 * @version 1.0.0
 */
/*
Plugin Name: BDSwiss RSS
Description: This is a plugin for the BDSwiss Wordpress Challenge 2020. It handles BDSwiss RSS feeds custom post type and shortcode
Author: Andreas Demetriou
Version: 1.0.0
*/

class BDSwissRSS
{

	function __construct()
	{
		add_action('init', array($this, 'createCustomPostType'));
	}

	function activate()
	{
		$this->createCustomPostType();
		flush_rewrite_rules();
	}

	function deactivate()
	{
		flush_rewrite_rules();
	}

	function enqueue()
	{
		wp_enqueue_style('bdswissrssstyle', plugins_url('/assets/css/admin.css', __FILE__));
		wp_enqueue_script('bdswissrssstyle', plugins_url('/assets/js/admin.js', __FILE__));
	}

	function register()
	{
		add_action('init', array($this, 'registerShortcode'));
		add_action('admin_enqueue_scripts', array($this, 'enqueue'));
		add_action('admin_enqueue_scripts', array($this, 'enqueueMedia'));
		add_action("admin_init", array($this, 'createMetaBox'));
		add_action("save_post", array($this, 'saveMetaBox'));
		add_filter('manage_bdswiss_rss_posts_columns', array($this, 'createCustomPostColumns'), 1);
		add_action('manage_bdswiss_rss_posts_custom_column', array($this, 'handleCustomPostColumns'), 1, 2);
	}

	function createCustomPostColumns($columns)
	{
		unset($columns['date']);

		$columns['bdswiss_rss_shortcode'] = __('Shortcode');
		return $columns;
	}

	function handleCustomPostColumns($column, $post_id)
	{
		switch ($column) {
			case 'bdswiss_rss_shortcode':
				echo '[bdswiss-rss id="' . $post_id . '"]';
				break;
		}
	}

	function createCustomPostType()
	{
		register_post_type(
			'bdswiss_rss',
			[
				'public' => true,
				'label' => 'BDSwiss RSS',
				'description' => 'BDSwiss WordPress Challenge RSS feeds',
				'publicly_queryable'  => false,
				'supports' => array(
					'title'
				),
				'menu_icon' => plugin_dir_url( __FILE__ ) . 'assets/images/icon.png'
			]
		);
	}

	function enqueueMedia()
	{
		if (is_admin())
			wp_enqueue_media();
	}

	function createMetaBox()
	{
		// Setup a meta box for BDSwiss RSS feeds
		add_meta_box(
			"bdswiss_rss_meta_box",
			"RSS Feed",
			array($this, 'printMetaBox'),
			"bdswiss_rss",
			"advanced",
			"high"
		);
	}

	function saveMetaBox()
	{
		// Save meta box information as post meta for BDSwiss RSS feeds
		global $post;

		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}

		if (get_post_status($post->ID) === 'auto-draft') {
			return;
		}

		update_post_meta($post->ID, "_bdswiss_rss_description", sanitize_text_field($_POST["_bdswiss_rss_description"]));
		update_post_meta($post->ID, "_bdswiss_rss_url", sanitize_text_field($_POST["_bdswiss_rss_url"]));
		update_post_meta($post->ID, "_bdswiss_rss_logo", sanitize_text_field($_POST["_bdswiss_rss_logo"]));
		update_post_meta($post->ID, "_bdswiss_rss_limit", sanitize_text_field($_POST["_bdswiss_rss_limit"]));
		update_post_meta($post->ID, "_bdswiss_rss_keywords", sanitize_text_field($_POST["_bdswiss_rss_keywords"]));
	}

	function printMetaBox()
	{
		// Print the meta box
		global $post;
		$custom = get_post_custom($post->ID);
?>

		<div class="form-group">
			<div class="rss-id"><strong>Usage:</strong> [bdswiss-rss id="<?php echo $post->ID; ?>"]</div>
		</div>

		<div class="form-group">
			<label for="upload_image_button">Logo</label>
			<div class='image-preview-wrapper'>
				<img id='image-preview' src='<?php echo $custom['_bdswiss_rss_logo'][0]; ?>'>
			</div>
			<input id="upload_image_button" type="button" class="button" value="<?php _e('Choose logo'); ?>" />
			<input type='hidden' name='_bdswiss_rss_logo' id='_bdswiss_rss_logo' value='<?php echo $custom['_bdswiss_rss_logo'][0]; ?>'>
		</div>

		<div class="form-group">
			<label for="_bdswiss_rss_description">Description</label>
			<textarea class="form-control" name="_bdswiss_rss_description" id="_bdswiss_rss_description" cols="30" rows="10"><?php echo $custom['_bdswiss_rss_description'][0]; ?></textarea>
		</div>

		<div class="form-group">
			<label for="_bdswiss_rss_url">RSS URL</label>
			<input type="text" class="form-control" name="_bdswiss_rss_url" id="_bdswiss_rss_url" value="<?php echo $custom['_bdswiss_rss_url'][0]; ?>">
		</div>

		<div class="form-group">
			<label for="_bdswiss_rss_limit">Posts Limit</label>
			<input type="number" class="form-control" name="_bdswiss_rss_limit" id="_bdswiss_rss_limit" value="<?php echo $custom['_bdswiss_rss_limit'][0]; ?>">
		</div>

		<div class="form-group">
			<label for="_bdswiss_rss_keywords">Keywords</label>
			<input type="text" class="form-control" name="_bdswiss_rss_keywords" id="_bdswiss_rss_keywords" value="<?php echo $custom['_bdswiss_rss_keywords'][0]; ?>">
			<div class="help-block">Comma-seperated values</div>
		</div>

<?php
	}

	function processShortCode($atts)
	{
		// Process the shortcode
		extract(
			shortcode_atts(
				array(
					'id' => -1,
				),
				$atts
			)
		);

		// Validation
		if ($id == -1) {
			return '<p><strong>BDSwiss RSS Error:</strong> Missing shortcode argument "id".</p>';
		}

		if (get_post_status($id) != 'publish') {
			return '<p><strong>BDSwiss RSS Error:</strong> Feed not found.</p>';
		}

		if (get_post_type($id) != 'bdswiss_rss') {
			return '<p><strong>BDSwiss RSS Error:</strong> Invalid post.</p>';
		}

		// Get post meta
		$bdswissRSSFeedMeta = get_post_meta($id);

		$source = $bdswissRSSFeedMeta['_bdswiss_rss_url'][0];
		$logo = $bdswissRSSFeedMeta['_bdswiss_rss_logo'][0];
		$description = $bdswissRSSFeedMeta['_bdswiss_rss_description'][0];
		$posts_limit = $bdswissRSSFeedMeta['_bdswiss_rss_limit'][0];
		$keywords = $bdswissRSSFeedMeta['_bdswiss_rss_keywords'][0];
		$source = $bdswissRSSFeedMeta['_bdswiss_rss_url'][0];
		$source = $bdswissRSSFeedMeta['_bdswiss_rss_url'][0];

		// Read rss url
		$rssFeed = simplexml_load_file($source);

		if ($rssFeed == false) {
			return "<p><strong>BDSwiss RSS Error:</strong> The source is invalid. Please check your BDSwiss RSS feed.</p>";
		}

		$strResults = '
			<div class="rss-wrapper">
				<div class="info">
					<img src="' . $logo . '" class="rss-logo" alt="">
					<p>' . $description . '</p>
				</div>
				<div class="feeds-wrapper">
					<div class="feeds">';

		$i = 0;
		foreach ($rssFeed->channel->item as $feed) {
			if ($i == $posts_limit) {
				break;
			}

			if (strlen($keywords) > 0) {
				$strExpression = str_replace(',', '|', $keywords);

				if (preg_match('/(' . $strExpression . ')/', $feed->title) > 0) {

					$strResults .= $this->generateFeed($feed);
					$i++;
				}
			} else {
				$strResults .= $this->generateFeed($feed);
				$i++;
			}
		}

		$strResults .= '
					</div>
				</div>
			</div>';

		return $strResults;
	}

	function generateFeed($feed)
	{
		// Generate the feed
		$dtPublished = strtotime($feed->pubDate);

		return '
			<div class="feed">
				<div class="image">
					<img src="' . get_stylesheet_directory_uri() . '/assets/images/chart-line-solid.svg' . '" class="feed-logo" alt=""/>
				</div>
				<div class="details">
					<a href="' . $feed->link . '" target="_blank" rel="noopener">' . $feed->title . '</a>
					<div class="date">' . date("D M j Y G:i:s e", $dtPublished) . '</div>
				</div>
			</div>';
	}

	function registerShortcode()
	{
		add_shortcode('bdswiss-rss', array($this, 'processShortCode'));
	}
} // class BDSwissRSS

if (class_exists('BDSwissRSS')) {
	$bdswissRSS = new BDSwissRSS();
	$bdswissRSS->register();
}

register_activation_hook(__FILE__, array($bdswissRSS, 'activate'));
register_deactivation_hook(__FILE__, array($bdswissRSS, 'deactivate'));
register_uninstall_hook(__FILE__, array($bdswissRSS, 'uninstall'));
