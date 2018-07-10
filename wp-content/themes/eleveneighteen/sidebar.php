<?php
/**
 * Affichage de la sidebar du site
 */
?>

<?php if(is_active_sidebar('sidebar-1')) : ?>
	<aside id="main-sidebar" class="sidebar widget-area">
		<?php dynamic_sidebar('sidebar-1'); ?>
	</aside>
<?php endif; ?>
