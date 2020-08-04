<?php
/**
 * The template to display breadcrumbs
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.08
 */

if ( ($trx_addons_breadcrumbs = trx_addons_get_breadcrumbs(array('truncate_title' => 100))) != '') {
	?><div class="breadcrumbs"><?php trx_addons_show_layout($trx_addons_breadcrumbs); ?></div><?php
}
?>