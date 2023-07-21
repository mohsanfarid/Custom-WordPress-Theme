<?php 
    //Import search-route file
    require get_theme_file_path('/inc/search-route.php');
    
    // Function for custom rest field
    function uni_custom_rest(){
      register_rest_field('post', 'authorName', array(
      'get_callback' => function () {return get_the_author();}));
    }
    add_action('rest_api_init', 'uni_custom_rest');


    // Function of Page Banners
    function pageBanner($args = NULL){
        // php logic will live here 
        if (!$args['title']) {
            $args['title'] = get_the_title();
          }
        
          if (!$args['subtitle']) {
            $args['subtitle'] = get_field('page_banner_subtitle');
          }
        
          if (!$args['photo']) {
            if (get_field('page_banner_background_image') AND !is_archive() AND !is_home() ) {
              $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
            } else {
              $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
            }
          }
        ?>
            <div class="page-banner">
      <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo']?>)"></div>
      <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php echo $args['title'] ?></h1>
        <div class="page-banner__intro">
          <p><?php echo $args['subtitle'] ?></p>
        </div>
      </div>
    </div>
        <?php
    }

    function university_files(){
        wp_enqueue_script('main-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
        wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css'));
        wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css'));
        wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        wp_enqueue_style('fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');

        // used below line to get root url for live search functionality//
        wp_localize_script('main-js', 'uniData', array(
          'root_url' => get_site_url()
        ));
        
        
    }
    add_action('wp_enqueue_scripts','university_files');

    function university_features (){
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_image_size('profressorLandscape', 400, 260, true);
        add_image_size('profressorPortrait', 480, 650, true);
        add_image_size('pageBanner', 1500, 350, true);
       // register_nav_menu('headerMenuLocation' , 'Header Menu Location');
        //register_nav_menu('footerMenuLocation1' , 'Footer Menu Location 1');
       // register_nav_menu('footerMenuLocation2' , 'Footer Menu Location 2');
    }

    add_action('after_setup_theme','university_features');


    // Transfered to mu-plugins folder to avoid lost of data on theme change, into must use plugins//


    //Custom Post Types Start//
   // function university_post_types (){
    //    register_post_type('event', array(
    //        'public' => true,
     //       'labels' => array(
      //          'name' => 'Events'
      //      ),
     //       'menu_icon' => 'dashicons-calendar'
     //   ));
   // }
   // add_action('init', 'university_post_types');
    //Custom Post Types Ends//

    //Manipulate Default URL qUEIRES for Events ARCHIVE

    function university_adjust_queries($query){
        $today = date('Ymd');
        
        
        if(!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()) {
            $query->set('meta_key', 'event_date');
            $query->set('orderby', 'meta_value');
            $query->set('order', 'ASC');
            $query->set('meta_query', array(
                array(
                  'key' => 'event_date',
                  'compare' => '>=',
                  'value' => $today,
                  'type' => 'numeric'
                )));
            
        }
 //Manipulate Default URL qUEIRES for Program ARCHIVE

        if (!is_admin() AND  is_post_type_archive('program') AND $query->is_main_query()){
            $query->set('orderby', 'title');
            $query->set('order', 'ASC');
            $query->set('posts_per_page', -1);
        }
    }
    add_action('pre_get_posts', 'university_adjust_queries')
?>