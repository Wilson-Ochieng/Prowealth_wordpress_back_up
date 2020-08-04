<?php
/**
 * The template to display Admin notices
 *
 * @package WordPress
 * @subpackage GORDON
 * @since GORDON 1.0.1
 */
?>
<div class="update-nag" id="gordon_admin_notice">
	<h3 class="gordon_notice_title"><?php echo sprintf(esc_html__('Welcome to %s', 'gordon'), wp_get_theme()->name); ?></h3>
	<?php
	if (!gordon_exists_trx_addons()) {
		?><p><?php echo wp_kses_data(__('<b>Attention!</b> Plugin "ThemeREX Addons is required! Please, install and activate it!', 'gordon')); ?></p><?php
	}
	?><p><?php
		if (gordon_get_value_gp('page')!='tgmpa-install-plugins') {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=tgmpa-install-plugins'); ?>" class="button-primary"><i class="dashicons dashicons-admin-plugins"></i> <?php esc_html_e('Install plugins', 'gordon'); ?></a>
			<?php
		}
		if (function_exists('gordon_exists_trx_addons') && gordon_exists_trx_addons()) {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=trx_importer'); ?>" class="button-primary"><i class="dashicons dashicons-download"></i> <?php esc_html_e('One Click Demo Data', 'gordon'); ?></a>
			<?php
		}
		?>
        <a href="<?php echo esc_url(admin_url().'customize.php'); ?>" class="button-primary"><i class="dashicons dashicons-admin-appearance"></i> <?php esc_html_e('Theme Customizer', 'gordon'); ?></a>
        <a href="#" class="button gordon_hide_notice"><i class="dashicons dashicons-dismiss"></i> <?php esc_html_e('Hide Notice', 'gordon'); ?></a>
	</p>
</div>