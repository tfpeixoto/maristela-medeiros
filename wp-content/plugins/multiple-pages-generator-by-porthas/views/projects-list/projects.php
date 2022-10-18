<?php
/**
 * Display all project list template.
 *
 * @package MPG
 */

?>
<div class="wrap">
	<h2><?php esc_html_e( 'Projects', 'mpg' ); ?></h2>
	<form method="get">
		<?php $projects_list->prepare_items(); ?>
		<p class="search-box">
			<input type="hidden" name="page" value="<?php esc_attr_e( 'mpg-project-builder', 'mpg' ); ?>">
			<label class="screen-reader-text" for="search_email-search-input"><?php esc_html_e( 'Search:', 'mpg' ); ?></label>
			<input type="search" id="search_email-search-input" name="s" value="<?php echo isset( $_GET['s'] ) ? sanitize_text_field( $_GET['s'] ) : ''; // phpcs:ignore ?>" placeholder="<?php esc_attr_e( 'Search by project name', 'mpg' ); ?>">
			<input type="submit" id="search-submit" class="button" value="<?php esc_attr_e( 'Search', 'mpg' ); ?>">
		</p>
		<?php $projects_list->display(); ?>
	</form>
</div>
