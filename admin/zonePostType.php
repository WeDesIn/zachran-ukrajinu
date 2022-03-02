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
          //  add_action( 'save_post', [$this,'save_your_fields_meta'] );
		
          
            
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
					'label' => __( 'Město', TM_PLUGSU ),
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

        function add_your_fields_meta_box() {
            add_meta_box(
                'your_fields_meta_box', // $id
                'Pole', // $title
                [$this,'show_your_fields_meta_box'], // $callback
                'save_ukraine', // $screen
                'normal', // $context
                'high' // $priority
            );
            }
         
      
        function show_your_fields_meta_box() {
            global $post;  
                $meta = get_post_meta( $post->ID, 'your_fields', true ); 
            
                $this->HtmlForm->html_input_zoneposttype()
                ?>
           
            
            <?php }

        function save_your_fields_meta( $post_id ) {  
           
            if ( 'post' === $_POST['post_type'] ) {
                if ( !current_user_can( 'edit_page', $post_id ) ) {
                    return $post_id;
                } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
                    return $post_id;
                }  
            }
            $data_of_post = self::process_data_for_save($_POST);
            
            
            $save = $this->save_su_fields_meta_foreach($post_id,$data_of_post);
           
           //zde volat save
            
        }


        static function save_su_fields_meta_foreach($post_id,$data_of_post){
            
            foreach ($data_of_post as $key => $value) {
               $old[$key] = get_post_meta( $post_id,  $key, true );
            }

            foreach ($data_of_post as $key => $value) {
                $new[$key] = $value;
             }
            
            if ( $new && $old ) {
                foreach ($new as $key => $value) {
                  
                
                    if($old[$key] != $value){ 
                        update_post_meta( $post_id, $key, $value );
                    }elseif($new[$key] === '' && isset($old[$key]) && $old[$key]){
                        foreach ($old as $key => $value) {
                            delete_post_meta( $post_id, $key, $value );
                        }
                    }
                }
                return true;
            } 
            return null;
        }
        
        static function process_data_for_save($data){
            
            $data_of_post = [
                'su_name' => $data['su_name'],
                'su_subname' => $data['su_subname'],
                'su_mail' => $data['su_mail'],
                'su_adress' => $data['su_adress'],
                'su_phone' => $data['su_phone'],
                'count_free_spot' => $data['count_free_spot'],
                'su_city' => $data['su_city'],
                'su_comment' => $data['su_comment'],
                'su_status' => $data['su_status']
            ];
            return $data_of_post;
        }

        static function get_all_save_ukraine_terms(){
            $terms = get_terms([
                'taxonomy' => 'save_ukraine_tax',
                'hide_empty' => false,
            ]);
            $term = [];
            foreach ($terms as  $value) {
                $term[$value->term_id] = $value->name;
            }
            return $term;
        }
           
    }
    new zonePostType;
}