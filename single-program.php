<?php 

    get_header();

    while(have_posts()) {
        the_post(); ?>
         <div class="page-banner">
      <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>)"></div>
      <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php THE_TITLE();?></h1>
        <div class="page-banner__intro">
          <p>Replace</p>
        </div>
      </div>
    </div>

    <div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
          <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program');?>"> <i class="fa fa-home" aria-hidden="true"></i> All Programs</a> <span class="metabox__main"><?php the_title()?></span>
        </p>
      </div>

    <div class="geenric-content">
        <?php the_content()?>
    </div>

    <?php
//Custom query to display upcomeing events for this program//
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
              ),
              array(
                'key' => 'related_program',
                'compare' => 'LIKE',
                'value' => '"' . get_the_ID() . '"'
              )
            )
        ));

        if($homePageEvent->have_posts()){
            echo '<hr class="section-break">';
        echo '<h2 class="headline headline--medium">Upcoming ' . get_the_title() . ' Events</h2>';
        while($homePageEvent->have_posts()){
            $homePageEvent->the_post(); ?>
                <div class="event-summary">
            <a class="event-summary__date t-center" href="#">
              <span class="event-summary__month">
                <!-- Getting the Event Date -->
                <?php 
              $eventDate = new DateTime(get_field('event_date')); 
              echo $eventDate->format('M')
              ?></span>
              <span class="event-summary__day"><?php echo $eventDate->format('d')?></span>
            </a>
            <div class="event-summary__content">
              <h5 class="event-summary__title headline headline--tiny"><a href="#"><?php the_title()?></a></h5>
              <p><?php if(has_excerpt()) {echo get_the_excerpt();} else {echo wp_trim_words(get_the_content(), 18);}?> <a href="<?php the_permalink()?>" class="nu gray">Learn more</a></p>
            </div>
          </div>
           
           <?php
        }
        }

    ?>
    </div>

    <?php }
    get_footer();

?>