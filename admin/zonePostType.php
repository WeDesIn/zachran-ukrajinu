<?php 

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

if( ! class_exists( 'zonePostType' ) )
{
	class zonePostType
	{
        public function __construct()
		{

			add_action( 'init', [$this, 'create_post_type'] );
	
			add_action( 'init', [$this,'create_type_tax'] );
		
          
            
		}
        
       
        function create_post_type() {
            register_post_type( 'save_ukraine',
                array(
                'labels' => array(
                    'name' => __( 'Zachraň Ukrajinu', TM_PLUGSU ),
                    'add_new' => __( 'Přidat lokaci', TM_PLUGSU  ),
                    'view_item'=> __( 'Zobrazit lokace', TM_PLUGSU ),
                    'edit_item' => __( 'Upravit lokaci', TM_PLUGSU ),
                    'singular_name' => __( 'lokaci', TM_PLUGSU ),
                    'menu_name' => __( 'Zachraň Ukrajinu', TM_PLUGSU ),
                ),
                'public' => false,
                'show_ui' => true,
                'menu_icon' => 'dashicons-sos',
                'menu_position' => 54,
                'show_in_rest' => true,
                'supports' => array( 'title', 'author','custom-fields')
                )
            );
        }

        /**
         * Add taxonomy 
         *
         * @param none
         * 
         * @author Wedesin
         * @return true/false
         */ 
        function create_type_tax() {
            register_taxonomy(
				'save_ukraine_tax',
				'save_ukraine',
				array(
					'label' => __( 'Lokace', TM_PLUGSU ),
					'rewrite' => array( 'slug' => 'save_ukraine-tax' ),
					'hierarchical'               => false,
					'public'                     => false,
					'show_ui'                    => true,
					'show_admin_column'          => true,
					'show_in_nav_menus'          => true,
					'show_tagcloud'              => true,
					'show_in_rest' 				=> true,
				)
			);

            register_taxonomy(
				'save_ukraine_type',
				'save_ukraine',
				array(
					'label' => __( '??', TM_PLUGSU ),
					'rewrite' => array( 'slug' => 'save_ukraine-type' ),
					'hierarchical'               => true,
					'public'                     => false,
					'show_ui'                    => true,
					'show_admin_column'          => true,
					'show_in_nav_menus'          => true,
					'show_tagcloud'              => true,
					'show_in_rest' 				=> true,
				)
			);

        }

      
      
    }
    new zonePostType;
}