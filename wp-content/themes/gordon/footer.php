<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage GORDON
 * @since GORDON 1.0
 */

						// Widgets area inside page content
						gordon_create_widgets_area('widgets_below_content');
						?>				
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					// Widgets area below page content
					gordon_create_widgets_area('widgets_below_page');

					$gordon_body_style = gordon_get_theme_option('body_style');
					if ($gordon_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Footer
			$gordon_footer_style = gordon_get_theme_option("footer_style");
			if (strpos($gordon_footer_style, 'footer-custom-')===0) $gordon_footer_style = 'footer-custom';
			get_template_part( "templates/{$gordon_footer_style}");
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php if (gordon_is_on(gordon_get_theme_option('debug_mode')) && gordon_get_file_dir('images/makeup.jpg')!='') { ?>
		<img src="<?php echo esc_url(gordon_get_file_url('images/makeup.jpg')); ?>" id="makeup">
	<?php } ?>

	<?php wp_footer(); ?>

</body>
</html>