<?php
    /**
     * woocommerce_before_shop_loop hook
     *
     * @hooked woocommerce_result_count - 20
     * @hooked woocommerce_catalog_ordering - 30
    */
    do_action( 'woocommerce_before_shop_loop' );
?>

<?php woocommerce_product_loop_start(); ?>

    <?php woocommerce_product_subcategories(); ?>

    <?php while ( have_posts() ) : the_post(); ?>

        <?php wc_get_template_part( 'content', 'product' ); ?>

    <?php endwhile; // end of the loop. ?>

<?php woocommerce_product_loop_end(); ?>
