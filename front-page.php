<head>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript"> 
      $(document).ready( function() {
        $('#deletesuccess').delay(1000).fadeOut();
      });
    </script>
    <head>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript"> 
      $(document).ready( function() {
        $('#deletesuccess').delay(1000).fadeOut();
      });
    </script>
  </head>

<style>
	/* Loader Styles Start */

.loading {
  font-size: 84px;
  font-weight: 800;
  text-align: center;
  width: 100%;
  line-height: 1;
}
.loading span {
  position: relative;
  color: rgba(0, 0, 0, 0.2);
  display: inline-block;
}
.loading span::after {
  position: absolute;
  top: 0;
  left: 0;
  content: attr(data-text);
  color: #051441;
  opacity: 0;
  -webkit-transform: scale(1.5);
  -ms-transform: scale(1.5);
  transform: scale(1.5);
  -webkit-animation: loading 3s infinite;
  animation: loading 3s infinite;
}
.loading span:nth-child(2)::after {
  -webkit-animation-delay: 0.1s;
  animation-delay: 0.1s;
}
.loading span:nth-child(3)::after {
  -webkit-animation-delay: 0.2s;
  animation-delay: 0.2s;
}
.loading span:nth-child(4)::after {
  -webkit-animation-delay: 0.3s;
  animation-delay: 0.3s;
}
.loading span:nth-child(5)::after {
  -webkit-animation-delay: 0.4s;
  animation-delay: 0.4s;
}
.loading span:nth-child(6)::after {
  -webkit-animation-delay: 0.5s;
  animation-delay: 0.5s;
}
.loading span:nth-child(7)::after {
  -webkit-animation-delay: 0.6s;
  animation-delay: 0.6s;
}
.loading span:nth-child(8)::after {
  -webkit-animation-delay: 0.7s;
  animation-delay: 0.7s;
}
.loading span:nth-child(9)::after {
  -webkit-animation-delay: 0.8s;
  animation-delay: 0.8s;
}
.loading span:nth-child(10)::after {
  -webkit-animation-delay: 0.9s;
  animation-delay: 0.9s;
}

@-webkit-keyframes loading {
  0%,
  75%,
  100% {
    -webkit-transform: scale(1.5);
    transform: scale(1.5);
    opacity: 0;
  }
  25%,
  50% {
    -webkit-transform: scale(1);
    transform: scale(1);
    opacity: 1;
  }
}

@keyframes loading {
  0%,
  75%,
  100% {
    -webkit-transform: scale(1.5);
    transform: scale(1.5);
    opacity: 0;
  }
  25%,
  50% {
    -webkit-transform: scale(1);
    transform: scale(1);
    opacity: 1;
  }
}
/*--------------------------------------------------------------
  ##  Preloader
  --------------------------------------------------------------*/
  .page-loader {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 99999999;
    background-color: #fff;
  }
  .page-loader .loader {
    position: absolute;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    width: 100%;
  }
  
  .page-loading-wrapper {
    position: absolute;
    top: 50%;
    left: 50%;
    height: auto;
    width: 100%;
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
  }
  .page-loading-wrapper svg {
    width: 0;
    height: 0;
  }

  .loading div {
    background: #1abf68;
    width: 25px;
    height: 25px;
    border-radius: 50%;
  }

/* Loader Styles Ends */
</style>
  </head>
  
  
  <?php get_header();

    ?>

<div id="deletesuccess" class="page-loader">
      <div class="page-loading-wrapper">
        <div class="loading">
          <span data-text="U">U</span>
          <span data-text="N">N</span>
          <span data-text="I">I</span>
          <span data-text="V">V</span>
          <span data-text="E">E</span>
          <span data-text="R">R</span>
          <span data-text="S">S</span>
          <span data-text="I">I</span>
          <span data-text="T">T</span>
          <span data-text="Y">Y</span>
        </div>
      </div>
    </div>

    <div class="page-banner">
      <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/library-hero.jpg') ?>)"></div>
      <div class="page-banner__content container t-center c-white">
        <h1 class="headline headline--large">Welcome!</h1>
        <h2 class="headline headline--medium">We think you&rsquo;ll like it here.</h2>
        <h3 class="headline headline--small">Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re interested in?</h3>
        <a href="<?php echo get_post_type_archive_link('program')?>" class="btn btn--large btn--blue">Find Your Major</a>
      </div>
    </div>

    <div class="full-width-split group">
      <div class="full-width-split__one">
        <div class="full-width-split__inner">
          <h2 class="headline headline--small-plus t-center">Upcoming Events</h2>
<!-- Custome Query Start-->
    <?php
        $today = date('Ymd');
        $homePageEvent = new WP_Query(array(
            'posts_per_page' => 2,
            'post_type' => 'event',
            //sorting by upcominng date//
            'meta_key' => 'event_date',
            'orderby' => 'meta_value',
            'order' => 'ASC',
            // filtering not showing old events date
            'meta_query' => array(
              array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'numeric'
              )
            )
        ));

        while($homePageEvent->have_posts()){
            $homePageEvent->the_post();
              get_template_part('template-parts/content' , 'event');
        }

    ?>
          
          
          <p class="t-center no-margin"><a href="<?php echo get_post_type_archive_link('event');?>" class="btn btn--blue">View All Events</a></p>
        </div>
      </div>
      <div class="full-width-split__two">
        <div class="full-width-split__inner">



          <h2 class="headline headline--small-plus t-center">From Our Blogs</h2>
            <!-- Custome Query Start-->
            
            <?php 
                $homepagePosts = new WP_Query(array(
                    'posts_per_page' => 2
                    
                ));

               while($homepagePosts->have_posts()){
                $homepagePosts->the_post();
                    ?>
                    
                    <div class="event-summary">
            <a class="event-summary__date event-summary__date--beige t-center" href="<?php the_permalink()?>">
              <span class="event-summary__month"><?php the_time('M')?></span>
              <span class="event-summary__day"><?php the_time('d')?></span>
            </a>
            <div class="event-summary__content">
              <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink()?>"><?php the_title()?></a></h5>
              <p><?php if(has_excerpt()) {echo get_the_excerpt();} else {echo wp_trim_words(get_the_content(), 18);} ?> <a href="<?php the_permalink()?>" class="nu gray">Read more</a></p>
            </div>
          </div>
                    
                    <?php
                } wp_reset_postdata(); 
            ?>

            <!-- Custom Query Ends-->
          
          

          <p class="t-center no-margin"><a href="<?php echo site_url('/blog')?>" class="btn btn--yellow">View All Blog Posts</a></p>
        </div>
      </div>
    </div>

    <div class="hero-slider">
      <div data-glide-el="track" class="glide__track">
        <div class="glide__slides">
          <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('/images/bus.jpg') ?>)">
            <div class="hero-slider__interior container">
              <div class="hero-slider__overlay">
                <h2 class="headline headline--medium t-center">Free Transportation</h2>
                <p class="t-center">All students have free unlimited bus fare.</p>
                <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
              </div>
            </div>
          </div>
          <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('/images/apples.jpg') ?> )">
            <div class="hero-slider__interior container">
              <div class="hero-slider__overlay">
                <h2 class="headline headline--medium t-center">An Apple a Day</h2>
                <p class="t-center">Our dentistry program recommends eating apples.</p>
                <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
              </div>
            </div>
          </div>
          <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('/images/bread.jpg') ?> )">
            <div class="hero-slider__interior container">
              <div class="hero-slider__overlay">
                <h2 class="headline headline--medium t-center">Free Food</h2>
                <p class="t-center">Fictional University offers lunch plans for those in need.</p>
                <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
              </div>
            </div>
          </div>
        </div>
        <div class="slider__bullets glide__bullets" data-glide-el="controls[nav]"></div>
      </div>
    </div>
    <?php
   
   get_footer();
?>
