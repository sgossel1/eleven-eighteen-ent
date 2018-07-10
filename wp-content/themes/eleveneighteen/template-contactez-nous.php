<?php
/*
Template Name: Contactez-nous
*/

get_header(); ?>

<body class="about contact-us">
    <section id="background">
        <div class="bg-gradient"></div>
        <div class="cover"></div>
    </section>

    <?php
    while ( have_posts() ) : the_post(); ?>
        <div class="content">
            <div class="back-link">
              <a class="button" href="../"><i class="fas fa-arrow-left"></i> &nbsp;Retour</a>
            </div>

            <div class="container">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                <p class="social-icons"><a href="https://twitter.com/1118Ent"><i class="fab fa-twitter"></i></a> <a href="https://www.facebook.com/1118Entertainment/"><i class="fab fa-facebook"></i></a> <a href="https://www.instagram.com/1118entertainment/"><i class="fab fa-instagram"></i></a></p>
                <?php
                if ( has_post_thumbnail() ) :
                    the_post_thumbnail();
                endif;
                the_content(); ?>
            </div>
        </div>
    <?php endwhile; ?>

    <footer>
        <p class="social-icons"><a href=""><i class="fab fa-twitter"></i></a> <a href=""><i class="fab fa-facebook"></i></a> <a href=""><i class="fab fa-instagram"></i></a></p>
        <p>Made with <i class="fas fa-heart"></i> by <a href="https://twitter.com/sgossel1">Steven Gosselin</a></p><br>
        <p><a href="#" class="legal">Mentions légales</a></p>
    </footer>

<?php get_footer(); ?>
