<?php 

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}
/**
 * přidaní custom post type 
 *
 * 
 * @author digihood
 */ 
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
            add_filter('use_block_editor_for_post_type', [$this,'disable_gutenberg'], 10, 2);
            add_action( 'add_meta_boxes', [$this,'add_fields_meta_box'] );
            add_action( 'save_post', [$this,'save_fields_meta'] );
            add_action('admin_menu', [$this,'add_sub_menu_setting']);
            // přidání sloupců do stránky 
            add_filter( 'manage_save_ukraine_posts_columns', [$this, 'set_custom_edit_save_ukraine_columns'] );
            add_action( 'manage_save_ukraine_posts_custom_column' , [$this,'custom_save_ukraine_column'], 10, 2 );
            
		}

         /**
         * vytvoření řádku pro tabulku s posty
         *
         * @param $city_id = id taxnonomy mesta
         * @param $city_name = jmeno taxnonomy mesta
         * @author digihood
         * @return string
         */ 
        function disable_gutenberg($current_status, $post_type)
        {
            if ($post_type === 'save_ukraine') return false;
            return $current_status;
        }

        /**
         * create post type
         *
         * @author digihood
         * 
         */ 
        function create_post_type() {
            register_post_type( 'save_ukraine',
                array(
                'labels' => array(
                    'name' => __( 'Zachraň Ukrajinu', TM_PLUGSU ),
                    'add_new' => __( 'Přidat lokaci', TM_PLUGSU  ),
                    'view_item'=> __( 'Zobrazit lokace', TM_PLUGSU ),
                    'edit_item' => __( 'Upravit lokaci', TM_PLUGSU ),
                    'singular_name' => __( 'lokace', TM_PLUGSU ),
                    'menu_name' => __( 'Zachraň Ukrajinu (ubytování)', TM_PLUGSU ),
                ),
                'public' => false,
                'show_ui' => true,
                'menu_icon' => 'dashicons-sos',
                'menu_position' => 54,
                'show_in_rest' => true,
                'supports' => array( 'title','custom-fields')
                )
            );
        }

        /**
         * Add taxonomy 
         *
         * @param none
         * 
         * @author Wedesin
         */ 
        function create_type_tax() {
            register_taxonomy(
				'save_ukraine_type',
				'save_ukraine',
				array(
					'label' => __( 'Města', TM_PLUGSU ),
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

        /**
         * přidáni submenu 
         * @author digihood
         * @return string
         */ 
        function add_sub_menu_setting(){
            add_submenu_page(
                'edit.php?post_type=save_ukraine', 
                __('Nastavení',TM_PLUGSU), 
                __('Nastavení',TM_PLUGSU),      
                'manage_options',         
                'Setting_save_ukraine',
                [new SuSetting, 'settings_index']
            );       
        }

        /**
         * vytvoření řádku pro tabulku s posty
         *
         * @param $city_id = id taxnonomy mesta
         * @param $city_name = jmeno taxnonomy mesta
         * @author digihood
         * @return string
         */ 
        function add_fields_meta_box() {
            add_meta_box(
                'save_ukraine', 
                'Pole',
                [$this,'show_fields_meta_box'], 
                'save_ukraine', 
                'normal', 
                'high'
            );
        }
         
        /**
         * zobrazení fieldů v metaboxu
         * 
         * @author digihood
         *
         */ 
        function show_fields_meta_box() {
            global $post;  
            $this->HtmlForm->Html_output_metabox($post);
        }

        /**
         * uložení dat z metaboxu 
         *
         * @param $post_id = id postu
         * 
         * @author digihood
         * @return string/false
         */ 
        public function save_fields_meta( $post_id ) {  
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
        /**
         * přídaní sloupcu 
         *
         * @param $columns = sloupce
         * 
         * @author digihood
         * @return string/false
         */ 
        function set_custom_edit_save_ukraine_columns($columns) {
            unset( $columns['author'] );
            $columns['status'] = __( 'Status ubytování', TM_PLUGSU );
            $columns['kapacita'] = __( 'Kapacita', TM_PLUGSU );
            return $columns;
        }
        /**
         * zobrtazení v sloupcích  
         *
         * @param $columns = sloupce
         * @param $post_id = id postu
         * 
         * @author digihood
         * @return echo
         */ 
        function custom_save_ukraine_column( $column, $post_id ) {
            switch ( $column ) {
                case 'status' :
                    $status = get_post_meta($post_id, 'su_status', true);
                    if($status == 'free' || empty($status)){
                        echo __( 'Volno', TM_PLUGSU );
                    }else if ($status == 'occupied') {
                        echo __( 'Rezervováno', TM_PLUGSU );
                    } else if ($status == 'reserved'){
                        echo __( 'Obsazeno', TM_PLUGSU );
                    }
                    break;
                case 'kapacita' :
                    echo (get_post_meta($post_id, 'count_free_spot', true) ? get_post_meta($post_id, 'count_free_spot', true) : 0);
                    break;
            }
        }  
    }
    new zonePostType;
}