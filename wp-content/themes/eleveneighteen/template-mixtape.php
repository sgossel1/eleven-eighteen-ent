<?php
/*
Template Name: Mixtape
*/

get_header(); ?>

<body class="mixtape">

    <section id="background">
        <div class="bg-gradient"></div>
        <div class="cover"></div>
    </section>

    <?php
    while ( have_posts() ) : the_post(); ?>
    <section id="content">
        <div class="back-link">
            <a class="button" href="../"><i class="fas fa-arrow-left"></i> &nbsp;Retour</a>
        </div>

        <?php
        if ( has_post_thumbnail() ):
            the_post_thumbnail();
        endif;

        the_content(); ?>

        <a class="button spotify" href="<?php echo get_post_meta( get_the_ID(), 'url_spotify', true ); ?>" target="_blank"><i class="fab fa-spotify"></i> &nbsp;Écouter sur Spotify</a>
    </section>
    <?php endwhile; ?>

<?php get_footer(); ?>
