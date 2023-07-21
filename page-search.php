<?php 

    get_header();

    while(have_posts()) {
    the_post(); 
    pageBanner(array(
      'title' => 'Search',
      'subtitle' => 'What do you need?',
      'photo' => 'https://marketplace.canva.com/EAFPlm92N5o/1/0/1600w/canva-colorful-photo-rainbow-facebook-cover-2vDB4UzBEdk.jpg'
    ));
    ?>
     

    <div class="container container--narrow page-section">
    <?php 
        $theParent = wp_get_post_parent_id(get_the_ID());
        if($theParent){
            ?>
            
      <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
          <a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent);?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParent); ?></a> <span class="metabox__main"><?php the_title();?></span>
        </p>
      </div>
      <?php
        }
        
    ?>
    
<?php 

$testArray = get_pages(array(
    'child_of' => get_the_ID()
)); 
if ($theParent or $testArray){ ?>
      <div class="page-links">
        <h2 class="page-links__title"><a href="<?php echo get_permalink($theParent);?>"><?php echo get_the_title($theParent); ?></a></h2>
        <ul class="min-list">
          <?php

          if($theParent){
            $findChildrenOf = $theParent;
          } else{
            $findChildrenOf = get_the_ID();
          }
            wp_list_pages(array(
                'title_li' => NULL,
                'child_of' => $findChildrenOf,
                'SORT_COLUMN' => 'menu_order'
            )); 
          ?>
        </ul>
      </div>

      <?php } ?>
   
      <div class="generic-content">
            <form class="search-form" method="get" action="<?php echo esc_url(site_url('/')); ?>">
                <label class="headline headline--medium" for="s">Perform a New Search:</label>
                <div class="search-form-row">
                <input class="s" id="s" type="search" name="s" placeholder="What are you looking for?">
                <input class="search-submit" type="submit" value="Search">
                </div>
        </form>
    </div>
    </div>
    <?php
    }
    
    get_footer();
?>