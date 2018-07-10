<?php
get_header(); ?>
<body class="informations billetterie">
    <section id="background">
        <div class="bg-gradient"></div>
        <div class="cover"></div>
    </section>
    <div class="content">
        <div class="back-link">
          <a class="button" href="<?php if(is_product()) { echo get_permalink( wc_get_page_id( 'shop' ) ); }else { echo home_url(); } ?>"><i class="fas fa-arrow-left"></i> &nbsp;Retour</a>
        </div>
        <span class="logo-container"><a href="<?php echo get_permalink( wc_get_page_id( 'cart' ) ); ?>"><i class="fas fa-shopping-cart"></i> Panier</a></span>

        <div class="container">
        <?php woocommerce_content(); ?>
        </div>
    </div>

    <footer>
        <p class="social-icons"><a href="https://twitter.com/1118Ent"><i class="fab fa-twitter"></i></a> <a href="https://www.facebook.com/1118Entertainment/"><i class="fab fa-facebook"></i></a> <a href="https://www.instagram.com/1118entertainment/"><i class="fab fa-instagram"></i></a></p>
        <p>Made with <i class="fas fa-heart"></i> by <a href="https://twitter.com/sgossel1">Steven Gosselin</a></p><br>
        <p><a href="#" class="legal">Mentions légales</a></p>
    </footer>

<?php get_footer(); ?>

