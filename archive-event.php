<?php error_reporting(0); ?>
<?php
get_header();

pageBanner(array(
  'title' =>'All Events',
  'subtitle' => 'See What Going On'
));
?>


    <div class="container container--narrow page-section">
        <?php 
            while(have_posts()){
                the_post(); 
         get_template_part('template-parts/content-event');
               
         }
            echo paginate_links();

        ?>
        <hr class="section-break">
<p><a href="<?php echo site_url('/past-events')?>">Looking for Past Events?</a></p>
</div>    
<?php


    get_footer();
?>