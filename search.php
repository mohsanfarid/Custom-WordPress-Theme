<?php error_reporting(0); ?>
<?php
get_header();
pageBanner(array(
    'title' => 'Search Results',
    'subtitle' => 'You Searched For &ldquo;' . get_search_query() . '&rdquo;'
));
?>


    <div class="container container--narrow page-section">
        <?php 
        if(have_posts()){
            while(have_posts()){
                the_post(); 

                get_template_part('template-parts/content', get_post_type()); 
         }
            echo paginate_links();
        } else{
                echo '<h2 class="headline headlin--small-plus">No Resuts</h2>';
        }
        ?>
        <form class="search-form" method="get" action="<?php echo esc_url(site_url('/')); ?>">
        <label class="headline headline--medium" for="s">Perform a New Search:</label>
        <div class="search-form-row">
        <input class="s" id="s" type="search" name="s" placeholder="What are you looking for?">
        <input class="search-submit" type="submit" value="Search">
        </div>
</form><?php
        ?>

</div>    
<?php


    get_footer();
?>