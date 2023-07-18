<?php error_reporting(0); ?>
<?php
get_header();
pageBanner(array(
  'title' => 'Past Events',
  'subtitle' => 'What we were doing'
));

?>


    <div class="container container--narrow page-section">
        <?php 
            //Custom Query//
            $today = date('Ymd');
        $PastPageEvent = new WP_Query(array(
            'paged' => get_query_var('paged', 1),
          
            'post_type' => 'event',
            //sorting by upcominng date//
            'meta_key' => 'event_date',
            'orderby' => 'meta_value',
            'order' => 'ASC',
            // filtering not showing old events date
            'meta_query' => array(
              array(
                'key' => 'event_date',
                'compare' => '<',
                'value' => $today,
                'type' => 'numeric'
              )
            )
        ));


            while($PastPageEvent->have_posts()){
                $PastPageEvent->the_post();
         get_template_part('template-parts/content-event');
          
         }
              //  echo paginate_links(); //this will not work as it can be used for only archive pages
              echo paginate_links(array(
                'total' => $PastPageEvent->max_num_pages
              ));
        ?>

</div>    
<?php


    get_footer();
?>