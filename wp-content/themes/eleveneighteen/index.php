<?php
get_header();

  $query = new WP_Query( array( 'post_type' => 'event', 'posts_per_page' => '1') );
  if ( $query->have_posts() ) :
  while ( $query->have_posts() ) : $query->the_post();

  // On récupère le lien de l'évènement FB
  $fb_query = get_the_terms ($post->id, "fb_event");
  if ( !is_wp_error($fb_query)) :
    $liste_fb = wp_list_pluck($fb_query, 'name');
    $fb_event = implode(", ", $liste_fb);
  endif;

  // On récupère la date de l'évènement
  $date_query = get_the_terms ($post->id, 'date');
  if ( !is_wp_error($date_query)) :
    $liste_dates = wp_list_pluck($date_query, 'name');
    $date = implode(", ", $liste_dates);
  endif;

  // On récupère l'ID de la vidéo de l'évènement
  $youtube_query = get_the_terms ($post->id, 'video_yt');
  if ( !is_wp_error($youtube_query)) :
    $skills_links = wp_list_pluck($youtube_query, 'name');
    $yt_id = implode(", ", $skills_links);
  endif;
?>

<body class="home">
  <!-- Popup de partage de l'événement -->
  <div class="popup" id="share">
    <a href="#" class="close" onclick="return false;"><i class="fas fa-times"></i></a>
    <h3 class="share-title"><?php the_excerpt(); ?></h3>
    <ul class="social-links">
      <div class="social-icons">
        <li>
          <a class="share-fb" id="share-fb" href=""><i class="fab fa-facebook-f"></i></a>
        </li>
        <li>
          <a class="share-tw" target="_blank" href="https://twitter.com/intent/tweet?text=Les soirées de Balthazar 3 accueilleront @13BlockOfficiel le 24 mars à La Suite Brest by @1118Ent w/ @xxxaniki, @frenshkyd, DJ Morex & Ess-K&url=https://bit.ly/2E7Nyq7&hashtags=1118Ent, rap, trap, event&related=1118Ent, 1118vinzy, 1118Iksma, ShortyMcTwist"><i class="fab fa-twitter"></i></a>
        </li>
      </div>

      <li class="url">
        <button class="button copy" data-clipboard-text="<?php echo $fb_event; ?>"><i class="far fa-clipboard"></i> Copier le lien de l'évènement</button>
      </li>
    </ul>
  </div>

  <header id="masthead" class="site-header" role="banner">
    <span><?php the_custom_logo( $blog_id = 0 ) ?></span>

    <?php if ( has_nav_menu('top') ) : ?> <!-- On test si un emplacement de menu existe  -->
    <nav id="site-navigation" class="top-menu container-nav-links">
    <?php
    wp_nav_menu(array(
    'theme_location' => 'top',
    'menu_class'     => 'menu-top',
    ));
    ?>
    </nav>
    <?php endif; ?>
  </header>

  <section class="content">
    <div class="title">
      <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

      <h2><?php echo $date; ?> &mdash; By Eleven Eighteen Entertainment</h2>
    </div>
  </section>

  <!-- <footer>
      <a class="button" href="billetterie/"><i class="fas fa-ticket-alt"></i> &nbsp;Billetterie</a>
      <a class="button" href="<?php the_permalink(); ?>"><i class="fas fa-arrow-circle-right"></i> &nbsp;Plus d'informations</a>
      <span class="share-event"><button class="button share"><i class="fas fa-share"></i> &nbsp;Partager l'évènement</button></span>
  </footer> -->

  <?php if ( has_nav_menu('bottom') ) : ?> <!-- On test si un emplacement de menu existe  -->
  <footer>
    <?php
    wp_nav_menu(array(
    'theme_location' => 'bottom',
    'menu_class'     => 'menu-bottom',
    ));
    ?>
    <!-- <span class="share-event"><button class="button share"><i class="fas fa-share"></i> &nbsp;Partager l'évènement</button></span> -->
  </footer>
  <?php endif; ?>

  <div class="bg-gradient"></div>
  <div class="blackoverlay"></div>

  <section id="background">
      <div class="foreground">
          <div class="player">

            <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $yt_id; ?>?modestbranding=0&amp;rel=0&amp;autoplay=1&amp;controls=0&amp;showinfo=0&amp;iv_load_policy=3&amp;loop=1&amp;playlist=<?php echo $yt_id; ?>"></iframe>
          </div>
      </div>
  </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>
    <script type="text/javascript">
        new ClipboardJS('.copy');

        window.fbAsyncInit = function() {
            FB.init({
                appId      : '209175226520156',
                xfbml      : true,
                version    : 'v2.12'
            });
            FB.AppEvents.logPageView();
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        document.getElementById('share-fb').onclick = function() {
          FB.ui({
            method: 'share',
            display: 'popup',
            quote: 'Les soirées de Balthazar #3 accueilleront @13BlockOfficiel le 24 mars à La Suite #Brest by @1118Ent w/ @xxxaniki, @frenshkyd, DJ Morex & Ess-K https://bit.ly/2E7Nyq7 #rap #trap #event',
            href: 'https://sgossel1.github.io/eleven-eighteen-ent/',
          }, function(response){});
        }
    </script>

<?php get_footer(); ?>
<?php endwhile; wp_reset_postdata();
endif; ?>
