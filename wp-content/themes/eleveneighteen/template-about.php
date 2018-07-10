<?php
/*
Template Name: À propos
*/

get_header(); ?>

<body class="about">
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
              <?php
              if ( has_post_thumbnail() ) :
                  the_post_thumbnail();
              endif;
              the_content(); ?>
          </div>
      </div>
  <?php endwhile; ?>

  <footer>
      <p class="social-icons"><a href="https://twitter.com/1118Ent"><i class="fab fa-twitter"></i></a> <a href="https://www.facebook.com/1118Entertainment/"><i class="fab fa-facebook"></i></a> <a href="https://www.instagram.com/1118entertainment/"><i class="fab fa-instagram"></i></a></p>
      <p>Made with <i class="fas fa-heart"></i> by <a href="https://twitter.com/sgossel1">Steven Gosselin</a></p><br>
      <p><a href="#" class="legal">Mentions légales</a></p>
  </footer>

  <script type="text/javascript">
  jQuery(function ($) {
    var slider = {.
      el: {
        slider: $("#slider"),
        allSlides: $(".slide"),
        sliderNav: $(".slider-nav"),
        allNavButtons: $(".slider-nav > a")
      },
      timing: 300,
      slideWidth: 900,
      init: function() {
        this.bindUIEvents();
      },
      bindUIEvents: function() {
        this.el.slider.on("scroll", function(event) {
          slider.moveSlidePosition(event);
        });
        this.el.sliderNav.on("click", "a", function(event) {
          slider.handleNavClick(event, this);
        });
      },
      moveSlidePosition: function(event) {
        this.el.allSlides.css({
          "background-position": $(event.target).scrollLeft()/0+ "px 0"
        });
      },
      handleNavClick: function(event, el) {
        event.preventDefault();
        var position = $(el).attr("href").split("-").pop();

        this.el.slider.animate({
          scrollLeft: position * this.slideWidth
        }, this.timing);

        this.changeActiveNav(el);
      },
      changeActiveNav: function(el) {
        this.el.allNavButtons.removeClass("active");
        $(el).addClass("active");
      }
    };
    slider.init();
  });
  </script>

<?php get_footer(); ?>
