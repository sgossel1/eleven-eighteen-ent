<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header();

  // On récupère le lieu de l'évènement
  $venue_query = get_the_terms ($post->id, "venue");
  if ( !is_wp_error($venue_query)) :
    $liste_venues = wp_list_pluck($venue_query, 'name');
    $liste__description_venues = wp_list_pluck($venue_query, 'description');

    $venue = implode(", ", $liste_venues);
    $venue_desc = implode(", ", $liste__description_venues);
  endif;

  // On récupère la tête d'affiche de l'évènement
  $headliner_query = get_the_terms ($post->id, "headliner");
  if ( !is_wp_error($headliner_query)) :
    $liste_headliners = wp_list_pluck($headliner_query, 'name');
    $headliner = implode(", ", $liste_headliners);
  endif;

  // On récupère l'heure de l'évènement
  $duration_query = get_the_terms ($post->id, "duration");
  if ( !is_wp_error($duration_query)) :
    $liste_duration = wp_list_pluck($duration_query, 'name');
    $duration = implode(' <i class="fas fa-long-arrow-alt-right"></i> ', $liste_duration);
  endif;

  // On récupère les invités de l'évènement
  $guests_query = get_the_terms ($post->id, "guests");
  if ( !is_wp_error($duration_query)) :
    $liste_guests = wp_list_pluck($guests_query, 'name');
    $guests = implode(' &mdash; ', $liste_guests);
  endif;
?>

<body class="informations">
    <div class="popup" id="legal">
        <a href="#" class="close" onclick="return false;"><i class="fas fa-times"></i></a>
        <h3 class="share-title">Mention légales</h3>
        <p>En vertu de l’article 6 de la loi n° 2004-575 du 21 juin 2004 pour la confiance dans l’économie numérique, il est précisé aux utilisateurs du site https://sgossel1.github.io l’identité des différents intervenants dans le cadre de sa réalisation et de son suivi :<br><br>

        Propriétaire : Steven Gosselin &mdash; France<br>
        Créateur : Steven Gosselin<br>
        Responsable publication : Steven Gosselin – steven.gosselin29@gmail.com<br><br>
        Le responsable publication est une personne physique ou une personne morale.<br><br>
        Webmaster : Steven Gosselin – steven.gosselin29@gmail.com<br>
        Hébergeur : Github – États-Unis</p>
    </div>

    <section id="background">
        <div class="bg-gradient"></div>
        <div class="cover"></div>
    </section>

            <?php
            /* Start the Loop */
            while ( have_posts() ) : the_post(); ?>

    <div class="content">
        <div class="back-link">
          <a class="button" href="../../"><i class="fas fa-arrow-left"></i> &nbsp;Retour</a>
        </div>
        <span class="logo-container"><?php the_custom_logo( $blog_id = 0 ) ?></span>

        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        <div class="fire"></div>
        <?php // get_template_part( 'template-parts/post/content', get_post_format() );
            the_content();
        ?>
        <div class="buttons">
            <ul>
                <li class="call-to-action animated"><a href="https://www.facebook.com/events/1898955760123292/" target="blank"><i class="fab fa-facebook-f"></i> &nbsp;&nbsp;Evènement</a></li>
                <li class="call-to-action"><a href="https://www.weezevent.com/les-soirees-de-balthazar-3-w-13-block-shkyd-ess-k-more" target="blank"><i class="fas fa-ticket-alt"></i> &nbsp;&nbsp;Billetterie</a></li>
            </ul>
        </div>

        <div class="useful-informations" id="programmation">
            <div class="girls"></div>
            <h2 class="title">Programmation</h2>
            <div class="introduction">
                <?php
                if ( has_post_thumbnail() ) :
                    the_post_thumbnail('event-thumb', array('class' => 'aligncenter') );
                endif; ?>
                <span class="programmation-details">
                                <h2>Le premier showcase des soirées de Balthazar</h2>
                    <p>Nous tenons toujours à ramener des artistes qui savent faire le spectacle à nos soirées,<br>
                    et c’est pourquoi cette évidence nous est apparue :</p>
                    <p class="italic">Pour le premier showcase dans ton manoir, il te faut le 13 Block et uniquement le 13 Block.</p>

                    <h2 class="headliner"><?php echo $headliner; ?></h2>
                    <p class="has-text-centered lineup"><?php echo $guests; ?><br><br><br>
                        <i class="fas fa-clock"></i> &nbsp;<?php echo $duration; ?></p>
                </span>
            </div>
        </div>

        <div class="useful-informations">
            <div class="party"></div>
            <div>
            <h2 class="title">Informations pratiques</h2>
            <div class="content">
                <div>
                    <p class="title"><?php echo $venue; ?></p>
                    <p class="venue">
                    <?php echo $venue_desc; ?>
                    </p>
                </div>
                <div>
                    <?php get_sidebar(); ?>
                </div>
            </div>
            <div class="warning-age">Entrée interdite aux mineurs</div>
        </div>
    </div>
    <?php
    endwhile; // End of the loop.
    ?>
    <footer>
        <p class="social-icons"><a href="https://twitter.com/1118Ent"><i class="fab fa-twitter"></i></a> <a href="https://www.facebook.com/1118Entertainment/"><i class="fab fa-facebook"></i></a> <a href="https://www.instagram.com/1118entertainment/"><i class="fab fa-instagram"></i></a></p>
        <p>Made with <i class="fas fa-heart"></i> by <a href="https://twitter.com/sgossel1">Steven Gosselin</a></p><br>
        <p><a href="#" class="legal">Mentions légales</a></p>
    </footer>

<?php get_footer(); ?>
