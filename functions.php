<?php 

    function university_files(){
        wp_enqueue_script('main-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
        wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css'));
        wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css'));
        wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        wp_enqueue_style('fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
        
        
    }
    add_action('wp_enqueue_scripts','university_files');

    function university_features (){
        add_theme_support('title-tag');
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
    }
    add_action('pre_get_posts', 'university_adjust_queries')
?>