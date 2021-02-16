<?php

/**
 * Template Name: Challenge Page
 * Template Post Type: page
 */

get_header();
?>

  <div class="page-wrapper">
    <div class="video-wrapper">
      <video autoplay="" loop="" muted="" playsinline="">
        <source src="<?php echo esc_url( get_stylesheet_directory_uri()); ?>/assets/videos/market-loop.mp4" type="video/webm">
          Your browser does not support the video tag.
        </video>
      </video>

      <div class="video-info">
        <div class="title">Trade Now</div>
        <div class="details">250+ Forex pairs &amp; FDs on Shares, Indices, Energies &amp; Metals</div>
        <div class="button-wrap">
          <a href="#" class="button">Get started today</a>
        </div>
      </div>
    </div> <!-- .video-wrapper -->

    <div class="page-content">
      <div class="page-container rss-container">
          <?php
            $shortcode1 = CFS()->get('bdswiss_rss_shortcode_1');
            echo do_shortcode( $shortcode1 );

            $shortcode2 = CFS()->get('bdswiss_rss_shortcode_2');
            echo do_shortcode( $shortcode2 );
          ?>
      </div>

      <div class="page-container info-wrapper">
        <h2>Start trading with BDSwiss</h2>

        <p>
          Access one of the largest and most liquid markets in the world! Enter the world of Forex & CFD online trading in just a few steps and start trading more than 250 instruments on our world-leading trading platforms. Register for a trading account in just a few simple steps, practise trading on a demo environment with real market prices and enjoy an unparalleled experience with our user-friendly portal and fast deposits and withdrawals with a range of trusted payment options.
        </p>

        <div class="features">
          <?php
            $fields = CFS()->get( 'features' );

            foreach ( $fields as $field ) : ?>
              <div class="feature">
                <img src="<?php echo $field['image']; ?>" alt="">
                <h3><?php echo $field['title']; ?></h3>
                <p class="feature-info">
                  <?php echo $field['description']; ?>
                </p>
              </div>
          <?php endforeach; ?>
        </div>

        <div class="buttons-wrapper">
          <a href="#" class="button">Open An Account</a>

          <div class="note">
            Your capital is at risk
          </div>
        </div>
      </div>
    </div> <!-- page-content -->
  </div> <!-- .page-wrapper -->

<?php get_footer(); ?>