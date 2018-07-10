<?php
/*
Template Name: Panier
*/

get_header(); ?>

<body class="informations cart">
    <div class="content">
        <div class="back-link">
          <a class="button" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>"><i class="fas fa-arrow-left"></i> &nbsp;Retour</a>
        </div>

        <div class="container">
        <?php
        while ( have_posts() ) : the_post();
            the_title( '<h1 class="entry-title">', '</h1>' );
            the_content(); ?>
        <?php endwhile; ?>
    </div>

<?php get_footer(); ?>
