<?php
// Définition du titre
function eleveneighteen_title( $title )
{
  if ( empty( $title ) && ( is_home() || is_front_page() ) ) {
    $title = __( 'Accueil', 'textdomain' );
  }
  return $title;
}
add_filter( 'wp_title', 'eleveneighteen_title' );

// Activation des Images à la Une
add_theme_support( 'post-thumbnails');
add_image_size( 'event-thumb', 400, 400 ); //300 pixels wide (and unlimited height)

// Définition du logo
function eleveneighteen_setup() {
  add_theme_support( 'custom-logo', array(
     'height'      => 28,
     'width'       => 150,
     'flex-width' => false,
  ) );
}
add_action( 'after_setup_theme', 'eleveneighteen_setup' );

// On enregistre les menus du site
register_nav_menus( array(
  'top' => __( 'Top Menu', 'eleveneighteen'),
  'bottom' => __( 'Bottom Menu', 'eleveneighteen'),
));

/**
 * Crée une zone de widgets
 * @param $register_sidebar (Array)
 */
function eleveneighteen_widgets_init() {
  register_sidebar(array(
    'name'          => __('Sidebar', 'eleveneighteen'),
    'id'            => 'sidebar-1',
    'description'   => __('Ajouter des widgets dans la sidebar.', 'eleveneighteen'),
    'before_widget' => '<div id="%1$s" class="widget %2$s prices">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ));

}

add_action('widgets_init', 'eleveneighteen_widgets_init');


////////////////////////////////////////////////////////
//   File d'attente de chargement des styles et scripts
///////////////////////////////////////////////////////
function eleveneighteen_scripts() {
  // On charge les feuilles de styles
  wp_enqueue_style('eleveneighteen-bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
  // wp_enqueue_style('eleveneighteen-mailchimp', '//cdn-images.mailchimp.com/embedcode/classic-10_7.css');
  wp_enqueue_style('eleveneighteen-style', get_stylesheet_uri() );

  // On appelle les fichiers de scripts (et on spécifie sa dépendance s'il y en a une : jquery)
  wp_enqueue_script('eleveneighteen-bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js', array( 'jquery' ), '', true);
  wp_enqueue_script('eleveneighteen-script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), 'version1', true);
  wp_enqueue_script('eleveneighteen-fontawesome', 'https://use.fontawesome.com/releases/v5.0.8/js/all.js', array( 'jquery' ), '', true);
  wp_enqueue_script("jquery");
}
add_action('wp_enqueue_scripts', 'eleveneighteen_scripts');


////////////////////////////////////////////////////////
//   CUSTOM POST event
///////////////////////////////////////////////////////
// Register Custom Post Type event
// Post Type Key: event
function eleveneighteen_create_event() {

  $labels = array(
    'name' => __( 'Événements', 'Post Type General Name', 'textdomain' ),
    'singular_name' => __( 'event', 'Post Type Singular Name', 'textdomain' ),
    'menu_name' => __( 'Événements', 'textdomain' ),
    'name_admin_bar' => __( 'Événements', 'textdomain' ),
    'archives' => __( 'Archives des événements', 'textdomain' ),
    'attributes' => __( 'Attributs des événements', 'textdomain' ),
    'parent_item_colon' => __( 'Parents des événements:', 'textdomain' ),
    'all_items' => __( 'Tous les événements', 'textdomain' ),
    'add_new_item' => __( 'Ajouter un nouvel événement', 'textdomain' ),
    'add_new' => __( 'Ajouter', 'textdomain' ),
    'new_item' => __( 'Nouvel événement', 'textdomain' ),
    'edit_item' => __( "Modifier l'événement", 'textdomain' ),
    'update_item' => __( "Mettre à jour l'événement", 'textdomain' ),
    'view_item' => __( "Voir l'événement", 'textdomain' ),
    'view_items' => __( 'Voir les événements', 'textdomain' ),
    'search_items' => __( 'Rechercher dans les événements', 'textdomain' ),
    'not_found' => __( 'Aucun événement trouvé.', 'textdomain' ),
    'not_found_in_trash' => __( 'Aucun événement trouvé dans la corbeille.', 'textdomain' ),
    'featured_image' => __( 'Image mise en avant', 'textdomain' ),
    'set_featured_image' => __( 'Définir l’image mise en avant', 'textdomain' ),
    'remove_featured_image' => __( 'Supprimer l’image mise en avant', 'textdomain' ),
    'use_featured_image' => __( 'Utiliser comme image mise en avant', 'textdomain' ),
    'insert_into_item' => __( "Insérer dans l'événement", 'textdomain' ),
    'uploaded_to_this_item' => __( 'Téléversé sur cet événement', 'textdomain' ),
    'items_list' => __( 'Liste des événements', 'textdomain' ),
    'items_list_navigation' => __( 'Navigation de la liste des événements', 'textdomain' ),
    'filter_items_list' => __( 'Filtrer la liste des événements', 'textdomain' ),
  );
  $args = array(
    'label' => __( 'event', 'textdomain' ),
    'description' => __( '', 'textdomain' ),
    'labels' => $labels,
    'menu_icon' => 'dashicons-calendar-alt',
    'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'author', 'trackbacks', 'page-attributes', 'post-formats', 'custom-fields'),
    'taxonomies' => array('date', 'duration', 'lieu', 'headliner', 'fb_event', 'video_yt'),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'can_export' => true,
    'has_archive' => false,
    'hierarchical' => false,
    'exclude_from_search' => true,
    'show_in_rest' => true,
    'publicly_queryable' => true,
    'capability_type' => 'page',
  );
  register_post_type( 'event', $args );

}
add_action( 'init', 'eleveneighteen_create_event', 0 );

//////////////////////////////////
// Création des taxonomies
/////////////////////////////////
add_action( 'init', 'eleveneighteen_add_taxonomies', 0 );

function eleveneighteen_add_taxonomies() {
  // Taxonomie date de l'évènement
  $labels_date = array(
    'name'                    => _x( 'Date', 'taxonomy general name'),
    'singular_name'           => _x( 'Date', 'taxonomy singular name'),
    'search_items'            => __( 'Chercher une date'),
    'all_items'               => __( 'Toutes les dates'),
    'edit_item'               => __( 'Editer la date'),
    'update_item'             => __( 'Mettre à jour la date'),
    'add_new_item'            => __( 'Ajouter une nouvelle date'),
    'new_item_name'           => __( 'Valeur de la nouvelle date'),
    'separate_items_with_commas'  => __( ''),
    'menu_name'         => __( 'Dates'),
  );
  $args_date = array(
    'hierarchical'      => false,
    'labels'            => $labels_date,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'date' ),
  );
  register_taxonomy( 'date', 'event', $args_date );

  // Taxonomie lieu de l'évènement
  $labels_date = array(
    'name'                    => _x( 'Lieu', 'taxonomy general name'),
    'singular_name'           => _x( 'Lieu', 'taxonomy singular name'),
    'search_items'            => __( 'Chercher un lieu'),
    'all_items'               => __( 'Tous les lieux'),
    'edit_item'               => __( 'Editer le lieu'),
    'update_item'             => __( 'Mettre à jour le lieu'),
    'add_new_item'            => __( 'Ajouter un nouveau lieu'),
    'new_item_name'           => __( 'Valeur du nouveau lieu'),
    'separate_items_with_commas'  => __( ''),
    'menu_name'         => __( 'Lieux'),
  );
  $args_date = array(
    'hierarchical'      => true,
    'labels'            => $labels_date,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'venue' ),
  );
  register_taxonomy( 'venue', 'event', $args_date );

  // Taxonomie Evenement FB
  $labels_date = array(
    'name'                    => _x( 'URL Événement FB (ne pas mettre de / à la fin)', 'taxonomy general name'),
    'singular_name'           => _x( 'URL Événement FB (ne pas mettre de / à la fin)', 'taxonomy singular name'),
    'search_items'            => __( 'Chercher un événement FB'),
    'all_items'               => __( 'Tous les évènements FB'),
    'edit_item'               => __( "Editer l'événement FB"),
    'update_item'             => __( "Mettre à jour l'événement FB"),
    'add_new_item'            => __( 'Ajouter un nouvel événement'),
    'new_item_name'           => __( 'Valeur du nouvel événement'),
    'separate_items_with_commas'  => __( ''),
    'menu_name'         => __( 'Événements FB'),
  );
  $args_date = array(
    'hierarchical'      => false,
    'labels'            => $labels_date,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'fb_event' ),
  );
  register_taxonomy( 'fb_event', 'event', $args_date );

  // Taxonomie vidéo youtube
  $labels_date = array(
    'name'                    => _x( 'ID Vidéo Youtube', 'taxonomy general name'),
    'singular_name'           => _x( 'ID Vidéo Youtube', 'taxonomy singular name'),
    'search_items'            => __( 'Chercher une vidéo'),
    'all_items'               => __( 'Toutes les vidéos'),
    'edit_item'               => __( 'Editer la vidéo'),
    'update_item'             => __( 'Mettre à jour la vidéo'),
    'add_new_item'            => __( 'Ajouter une nouvelle vidéo'),
    'new_item_name'           => __( 'Valeur de la nouvelle vidéo'),
    'separate_items_with_commas'  => __( ''),
    'menu_name'         => __( 'Vidéos Youtube'),
  );
  $args_date = array(
    'hierarchical'      => false,
    'labels'            => $labels_date,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'video_yt' ),
  );
  register_taxonomy( 'video_yt', 'event', $args_date );

  // Taxonomie heure de l'évènement
  $labels_date = array(
    'name'                    => _x( "Heure de l'événement", "taxonomy general name"),
    'singular_name'           => _x( "Heure de l'événement", 'taxonomy singular name'),
    'search_items'            => __( 'Chercher une heure'),
    'all_items'               => __( 'Toutes les heures'),
    'edit_item'               => __( "Editer l'heure"),
    'update_item'             => __( "Mettre à jour l'heure"),
    'add_new_item'            => __( 'Ajouter une nouvelle heure'),
    'new_item_name'           => __( 'Valeur de la nouvelle heure'),
    'separate_items_with_commas'  => __( ''),
    'menu_name'         => __( ''),
  );
  $args_date = array(
    'hierarchical'      => false,
    'labels'            => $labels_date,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'duration' ),
  );
  register_taxonomy( 'duration', 'event', $args_date );

  // Taxonomie tête d'affiche
  $labels_date = array(
    'name'                    => _x( "Tête d'affiche", "taxonomy general name"),
    'singular_name'           => _x( "Tête d'affiche", 'taxonomy singular name'),
    'search_items'            => __( "Chercher une tête d'affiche"),
    'all_items'               => __( "Toutes les têtes d'affiche"),
    'edit_item'               => __( "Editer la tête d'affiche"),
    'update_item'             => __( "Mettre à jour la tête d'affiche"),
    'add_new_item'            => __( "Ajouter une nouvelle tête d'affiche"),
    'new_item_name'           => __( "Valeur de la nouvelle tête d'affiche"),
    'separate_items_with_commas'  => __( ''),
    'menu_name'         => __( "Tête d'affiche"),
  );
  $args_date = array(
    'hierarchical'      => false,
    'labels'            => $labels_date,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'headliner' ),
  );
  register_taxonomy( 'headliner', 'event', $args_date );

  // Taxonomie prix
  $labels_date = array(
    'name'                    => _x( "Prix", "taxonomy general name"),
    'singular_name'           => _x( "Prix", 'taxonomy singular name'),
    'search_items'            => __( 'Chercher un prix'),
    'all_items'               => __( 'Tous les prix'),
    'edit_item'               => __( 'Editer le prix'),
    'update_item'             => __( 'Mettre à jour la date'),
    'add_new_item'            => __( 'Ajouter une nouvelle date'),
    'new_item_name'           => __( 'Valeur de la nouvelle date'),
    'separate_items_with_commas'  => __( ''),
    'menu_name'         => __( "Prix"),
  );
  $args_date = array(
    'hierarchical'      => true,
    'labels'            => $labels_date,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'price' ),
  );
  register_taxonomy( 'price', 'event', $args_date );

  // Taxonomie invités
  $labels_date = array(
    'name'                    => _x( "Invités", "taxonomy general name"),
    'singular_name'           => _x( "Invités", 'taxonomy singular name'),
    'search_items'            => __( 'Chercher une date'),
    'all_items'               => __( 'Toutes les dates'),
    'edit_item'               => __( 'Editer la date'),
    'update_item'             => __( 'Mettre à jour la date'),
    'add_new_item'            => __( 'Ajouter une nouvelle date'),
    'new_item_name'           => __( 'Valeur de la nouvelle date'),
    'separate_items_with_commas'  => __( ''),
    'menu_name'         => __( "Invités"),
  );
  $args_date = array(
    'hierarchical'      => true,
    'labels'            => $labels_date,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'guests' ),
  );
  register_taxonomy( 'guests', 'event', $args_date );
}
// On cache les taxonomies dans le panel d'admin
function eleveneighteen_taxonomy_removing() {
  remove_submenu_page('edit.php?post_type=event', 'edit-tags.php?taxonomy=duration&amp;post_type=event');
  remove_submenu_page('edit.php?post_type=event', 'edit-tags.php?taxonomy=video_yt&amp;post_type=event');
  remove_submenu_page('edit.php?post_type=event', 'edit-tags.php?taxonomy=fb_event&amp;post_type=event');
  remove_submenu_page('edit.php?post_type=event', 'edit-tags.php?taxonomy=dates&amp;post_type=event');
  remove_submenu_page('edit.php?post_type=event', 'edit-tags.php?taxonomy=headliner&amp;post_type=event');
}
add_action( 'admin_menu', 'eleveneighteen_taxonomy_removing' );


////////////////////////////////
//        WOOCOMERCE
///////////////////////////////
// Ajoute le support du thème woocomerce
add_action( 'after_setup_theme', 'woocommerce_support' );
  function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
// Remove the sorting dropdown from Woocommerce
remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_catalog_ordering', 30 );
// Remove the result count from WooCommerce
remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );
/* Remove product meta */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
//Remove WooCommerce Tabs - this code removes all 3 tabs - to be more specific just remove actual unset lines
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['description'] );        // Remove the description tab
    unset( $tabs['reviews'] );      // Remove the reviews tab
    unset( $tabs['additional_information'] );   // Remove the additional information tab
    return $tabs;
}
// On retire les produits associés
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
// On retire les images dans le panier
add_filter( 'woocommerce_cart_item_thumbnail', '__return_false' );


/////////////////////////////////////////////
// On supprime la fonction des commentaires
/////////////////////////////////////////////
function eleveneighteen_comments_closed( $open, $post_id ) {
  $post = get_post( $post_id );
  if ('post' == $post->post_type)
  $open = false;
  return $open;
}
function eleveneighteen_remove_commentstatus() {
  remove_meta_box( 'commentstatusdiv' , 'post' , 'normal' );
}
function eleveneighteen_remove_menu_items() {
   global $menu;
   $restricted = array(__('Comments'));
   end ($menu);
   while (prev($menu)){
   $value = explode(' ',$menu[key($menu)][0]);
   if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){
   unset($menu[key($menu)]);}
   }
}
add_filter('comments_open', 'eleveneighteen_comments_closed', 10, 2);
add_action( 'admin_menu' , 'eleveneighteen_remove_commentstatus' );
add_action('admin_menu', 'eleveneighteen_remove_menu_items');


//////////////////////////////////////////
// On enlève la fonction de recherche
/////////////////////////////////////////
function eleveneighteen_search_filter_query( $query, $error = true ) {
  if ( !is_search() ) return;
  $query->is_search = false;
  $query->query_vars['s'] = false;
  $query->query['s'] = false;
  // to error
  if ( $error )
  $query->is_404 = true;
}


////////////////////////////////
// DatePicker (admin)
///////////////////////////////
function datepicker_load_newevent($hook) {

  if( $hook != 'post-new.php' || $hook != 'post.php' ) {
    return;
  }
  wp_enqueue_script( 'jquery-ui-datepicker' );
  wp_enqueue_script('datepicker-js', get_template_directory_uri() . '/js/datepicker.js', array( 'jquery' ), '', true);
}
function datepicker_load_editevent($hook) {

  if( $hook != 'post.php'  )
    return;
  wp_enqueue_script( 'jquery-ui-datepicker' );
  wp_enqueue_script( 'datepicker-js', get_template_directory_uri() . '/js/datepicker.js' );
}

add_action('admin_enqueue_scripts', 'datepicker_load_newevent');
add_action('admin_enqueue_scripts', 'datepicker_load_editevent');
add_action('admin_head', 'custom_datepicker');

// Style du DatePicker
function custom_datepicker() {
  echo '<style>
    #ui-datepicker-div {
      background: white;
      padding: 20px;
      border: 1px solid black;
    }
  </style>';
}


/**
 * Allow HTML in term (category, tag) descriptions
 */
foreach ( array( 'pre_term_description' ) as $filter ) {
    remove_filter( $filter, 'wp_filter_kses' );
}

foreach ( array( 'term_description' ) as $filter ) {
    remove_filter( $filter, 'wp_kses_data' );
}
