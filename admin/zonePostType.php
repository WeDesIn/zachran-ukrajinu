<?php 

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

if( ! class_exists( 'zonePostType' ) )
{
	class zonePostType
	{
        private $HtmlForm;
        public function __construct()
		{
            $this->HtmlForm = new HtmlForm;
			add_action( 'init', [$this, 'create_post_type'] );
	
			add_action( 'init', [$this,'create_type_tax'] );
            add_filter('use_block_editor_for_post_type', [$this,'prefix_disable_gutenberg'], 10, 2);
            add_action( 'add_meta_boxes', [$this,'add_your_fields_meta_box'] );
            add_action( 'save_post', [$this,'save_your_fields_meta'] );
            add_action('admin_menu', [$this,'add_tutorial_cpt_submenu_example']);
		
          
            
		}
       
        function prefix_disable_gutenberg($current_status, $post_type)
        {
          
            if ($post_type === 'save_ukraine') return false;
            return $current_status;
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
                'public' => true,
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
				'save_ukraine_type',
				'save_ukraine',
				array(
					'label' => __( 'Města', TM_PLUGSU ),
					'rewrite' => array( 'slug' => 'save_ukraine-type' ),
					'hierarchical'               => true,
					'public'                     => true,
					'show_ui'                    => true,
					'show_admin_column'          => true,
					'show_in_nav_menus'          => true,
					'show_tagcloud'              => true,
					'show_in_rest' 				=> true,
				)
			);
            register_taxonomy(
				'save_ukraine_tax',
				'save_ukraine',
				array(
					'label' => __( 'Štítky', TM_PLUGSU ),
					'rewrite' => array( 'slug' => 'save_ukraine-tax' ),
					'hierarchical'               => false,
					'public'                     => true,
					'show_ui'                    => true,
					'show_admin_column'          => true,
					'show_in_nav_menus'          => true,
					'show_tagcloud'              => true,
					'show_in_rest' 				=> true,
				)
			);

        }

        function add_tutorial_cpt_submenu_example(){

            add_submenu_page(
                            'edit.php?post_type=save_ukraine', //$parent_slug
                            __('Nastavení',TM_PLUGSU),  //$page_title
                            __('Nastavení',TM_PLUGSU),        //$menu_title
                            'manage_options',           //$capability
                            'Setting_save_ukraine',//$menu_slug
                            [new SuSetting, 'settings_index']//$function
            );
       
       }
        function add_your_fields_meta_box() {
            add_meta_box(
                'save_ukraine', // $id
                'Pole', // $title
                [$this,'show_your_fields_meta_box'], // $callback
                'save_ukraine', // $screen
                'normal', // $context
                'high' // $priority
            );
            }
         
      
        function show_your_fields_meta_box() {
            global $post;  
                $this->HtmlForm->html_input_zoneposttype($post);
                ?>
            <?php }

public function save_your_fields_meta( $post_id ) {  
           
    if ( isset($_POST['post_type']) && 'save_ukraine' === $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_page', $post_id ) ) {
            return $post_id;
        } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }  
        $data_of_post = SuProcessing::process_data_for_save($_POST);
        $save = SuProcessing::save_su_fields_meta_foreach($post_id,$data_of_post);
        if($save == null) return false;
    }
  }
           
    }
    new zonePostType;
}