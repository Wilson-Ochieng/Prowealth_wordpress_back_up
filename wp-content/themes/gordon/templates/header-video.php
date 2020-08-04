<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage GORDON
 * @since GORDON 1.0.14
 */
$gordon_header_video = gordon_get_header_video();
$gordon_embed_video = '';
if (!empty($gordon_header_video) && !gordon_is_from_uploads($gordon_header_video)) {
	if (gordon_is_youtube_url($gordon_header_video) && preg_match('/[=\/]([^=\/]*)$/', $gordon_header_video, $matches) && !empty($matches[1])) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr($matches[1]); ?>"></div><?php
	} else {
		global $wp_embed;
		if (false && is_object($wp_embed)) {
			$gordon_embed_video = do_shortcode($wp_embed->run_shortcode( '[embed]' . trim($gordon_header_video) . '[/embed]' ));
			$gordon_embed_video = gordon_make_video_autoplay($gordon_embed_video);
		} else {
			$gordon_header_video = str_replace('/watch?v=', '/embed/', $gordon_header_video);
			$gordon_header_video = gordon_add_to_url($gordon_header_video, array(
				'feature' => 'oembed',
				'controls' => 0,
				'autoplay' => 1,
				'showinfo' => 0,
				'modestbranding' => 1,
				'wmode' => 'transparent',
				'enablejsapi' => 1,
				'origin' => home_url(),
				'widgetid' => 1
			));
			$gordon_embed_video = '<iframe src="' . esc_url($gordon_header_video) . '" width="1170" height="658" allowfullscreen="0" frameborder="0"></iframe>';
		}
		?><div id="background_video"><?php gordon_show_layout($gordon_embed_video); ?></div><?php
	}
}
?>