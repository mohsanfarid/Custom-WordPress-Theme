<?php error_reporting(0); ?>
<?php 

    get_header();
    pageBanner();
    while(have_posts()) {
        the_post(); ?>
         

    <div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
          <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program');?>"> <i class="fa fa-home" aria-hidden="true"></i> All Programs</a> <span class="metabox__main"><?php the_title()?></span>
        </p>
      </div>

    <div class="generic-content">
        <?php the_field('main_body_content') ?>
    </div>




    <?php
//Custom query to display Professors for this program//
$realtedProfessors = new WP_Query(array(
    'posts_per_page' => -1,
    'post_type' => 'professor',
    'orderby' => 'title',
    'order' => 'ASC',
    // filtering not showing old events date
    'meta_query' => array(
      array(
        'key' => 'related_program',
        'compare' => 'LIKE',
        'value' => '"' . get_the_ID() . '"'
      )
    )
));

if($realtedProfessors->have_posts()){
    echo '<hr class="section-break">';
echo '<h2 class="headline headline--medium"> ' . get_the_title() . ' Professors</h2>';
echo '<ul class="professor-cards">';
while($realtedProfessors->have_posts()){
    $realtedProfessors->the_post(); ?>
        <li class="professor-card__list-item">
          <a class="professor-card" href="<?php the_permalink();?>">
          <img class="professor-card__image" src="<?php the_post_thumbnail_url('profressorLandscape');?>">
          <span class="professor-card__name "><?php the_title(); ?></span>  
        

        </a>
        </li>
   
   <?php
}
echo '</ul>';
}

wp_reset_postdata(); // if not inserted the code below will not be displayed, when run multiple custom queries run this in between to get the results

//Custom query to display upcoming events for this program//
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
            $homePageEvent->the_post(); 
                get_template_part('template-parts/content-event');
        }
        }

    ?>
    </div>

    <?php }
    get_footer();

?>