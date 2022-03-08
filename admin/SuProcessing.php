<?php 
/**
 * processing celeho pluginu
 *
 * 
 * @author Wedesin
 */ 

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

if( ! class_exists( 'SuProcessing' ) )
{
	class SuProcessing
	{

        
    private $sessions;
		public function __construct()
		{
      $this->sessions = new su_session;
    }
    

         /**
         * ukladání dat z administrace prispevku
         *
         * @param $post_id = id přispevku
         * @param $data_of_post = data z funkce process_data_for_save
         * 
         * @author digihood
         * @return true/false/null
         */ 
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
                    wp_set_post_terms($post_id,$value,'save_ukraine_type',true);
                   
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
        /**
         * zpracovaní dat z post pro uložení
         *
         * @param $data = $_POST
         * 
         * 
         * @author digihood
         * @return array
         */ 
    static function process_data_for_save($data){
        
        $data_of_post = [
            'su_name' => (isset($data['su_name']) && $data['su_name'] ? $data['su_name'] : ''),
            'su_subname' => (isset($data['su_subname']) && $data['su_subname'] ? $data['su_subname'] : ''),
            'su_mail' => (isset($data['su_mail']) && $data['su_mail'] ? $data['su_mail'] : ''),
            'su_adress' => (isset($data['su_adress']) && $data['su_adress'] ? $data['su_adress'] : ''),
            'su_phone' => (isset($data['su_phone']) && $data['su_phone'] ? $data['su_phone'] : ''),
            'count_free_spot' => (isset($data['count_free_spot']) && $data['count_free_spot'] ? $data['count_free_spot'] : ''),
            'su_city' => (isset($data['su_city']) && $data['su_city'] ? $data['su_city'] : ''),
            'su_comment' => (isset($data['su_comment']) && $data['su_comment'] ? $data['su_comment'] : ''),
            'su_status' => (isset($data['su_status']) && $data['su_status'] ? $data['su_status'] : ''),
            'su_free_dog' => (isset($data['su_free_dog']) && $data['su_free_dog'] ? $data['su_free_dog'] : ''),
            'su_speak' => (isset($data['su_speak']) && $data['su_speak'] ? $data['su_speak'] : ''),
            'su_accommodation_length' => (isset($data['su_accommodation_length']) && $data['su_accommodation_length'] ? $data['su_accommodation_length'] : '')
        ];
        return $data_of_post;
    }
          /**
         * získaní všech terms postu
         *
         * @param $hide_empty = false
         * @author digihood
         * @return array
         */ 
      static function get_all_save_ukraine_terms($hide_empty=false){
          $terms = get_terms([
              'taxonomy' => 'save_ukraine_type',
              'hide_empty' => $hide_empty,
          ]);
          $term = [];
          foreach ($terms as  $value) {
              $term[$value->term_id] = $value->name;
          }
          return $term;
      }
         /**
         * session error text
         *
         * @param $data_of_post = data z funkce process_data_for_save
         * @author digihood
         * @return true/false
         */ 
        public function check_field_reqired($data_of_post){
        $error = [];
        if(empty($data_of_post['su_name'])){ 
           $error['su_name'] = [''.__('Není vyplněný jmeno',TM_PLUGSU).''];
        }
        if(empty($data_of_post['su_subname'])){ 
          $error['su_subname'] = [''.__('Není vyplněný přijmení',TM_PLUGSU).''];
        }
        if(empty($data_of_post['su_mail'])){ 
          $error['su_mail'] = [''.__('Není vyplněný e-mail',TM_PLUGSU).''];
        }
        if(empty($data_of_post['su_adress'])){ 
          $error['su_adress'] = [''.__('Není vyplněná adresa',TM_PLUGSU).''];
        }
        if(empty($data_of_post['su_phone'])){ 
          $error['su_phone'] = [''.__('Není vyplněný Telefon',TM_PLUGSU).''];
        }
        if(empty($data_of_post['count_free_spot'])){ 
          $error['count_free_spot'] = [''.__('Není vyplněn počet míst',TM_PLUGSU).''];
        }
        if(empty($data_of_post['su_city'])){ 
          $error['su_city'] = [''.__('Není vyplněno město',TM_PLUGSU).''];
        }
        if(empty($data_of_post['su_speak'])){ 
          $error['su_speak'] = [''.__('Není vyplněný kterým jazykem mluvíte',TM_PLUGSU).''];
        }
        if(empty($data_of_post['su_accommodation_length'])){ 
          $error['su_accommodation_length'] = [''.__('Není vyplněna doba pronájmu',TM_PLUGSU).''];
        }
        if(isset($error) && $error){
          $this->sessions->addSession('save_su_shortcode_mess',$error);
            return false; 
        }else{
          return true;
        }
        
      }
        /**
         * show value field 
         *
         * @param $post_id = ID prispevku
         * @param $key = key value
         * @author digihood
         * @return array/null
         */ 

      static function show_value_field($post_id,$key){
        $field = get_post_meta( $post_id,  $key, true );
        if(isset($field) && $field) {
            return $field;
        }
        return null;
      }
        /**
         * ziskaní všech stránek 
         *
         * @author digihood
         * @return array
         */ 
      static function gel_all_pages_for_select(){
        $pages = get_pages();
        $pages_for_select = [];
        foreach ($pages as  $value) {
         $pages_for_select[$value->post_name] = $value->post_title;
        
        }
        return $pages_for_select;
      }
        /**
         * získaní všech custom post type(save_ukraine_type)
         *
         * @author digihood
         * @return array
         */ 
      static function get_all_save_ukraine_post(){
        $data_of_post = [];
        $posts = get_posts([
            'post_type' => 'save_ukraine',
            'post_status' => 'publish',
            'numberposts' => -1
            // 'order'    => 'ASC'
          ]); 

          foreach ($posts as  $value) {
              $data = get_post_meta($value->ID);
          
            $data_of_post[$value->ID] = [
                'title' => (isset($value->post_title) && $value->post_title ? $value->post_title : ''),
                'post_name' => (isset($value->post_name) && $value->post_name ? $value->post_name : '') ,
                'su_name' => (isset($data['su_name'][0]) && $data['su_name'][0]?  $data['su_name'][0] : ''),
                'su_subname' => (isset($data['su_subname'][0]) && $data['su_subname'][0]? $data['su_subname'][0] : ''),
                'su_mail' => (isset($data['su_mail'][0]) && $data['su_mail'][0]?$data['su_mail'][0] :'' ),
                'su_adress' => (isset($data['su_adress'][0]) && $data['su_adress'][0]? $data['su_adress'][0]: ''),
                'su_phone' => (isset($data['su_phone'][0]) && $data['su_phone'][0]?$data['su_phone'][0] :'' ),
                'count_free_spot' => (isset($data['count_free_spot'][0]) && $data['count_free_spot'][0]?$data['count_free_spot'][0] : ''),
                'su_city' => (isset($data['su_city'][0]) && $data['su_city'][0]? $data['su_city'][0]: ''),
                'su_comment' => (isset($data['su_comment'][0]) && $data['su_comment'][0]? $data['su_comment'][0]:'' ),
                'su_free_dog' => (isset($data['su_free_dog'][0]) && $data['su_free_dog'][0]? $data['su_free_dog'][0]: ''),
                'su_speak' => (isset($data['su_speak'][0]) && $data['su_speak'][0]? $data['su_speak'][0]: ''),
                'su_accommodation_length' => (isset($data['su_accommodation_length'][0]) && $data['su_accommodation_length'][0]?$data['su_accommodation_length'][0] :'' )

            ] ;
           
          }
          return $data_of_post;
      }
       /**
         * odleslaní emailu klientovy
         *
         * @author digihood
         * @return true
         */ 
     static public function send_mail( ) {
        $class_email = new SuSendEmail();
     
        $title = (get_option('su_title_mail') ?  get_option('su_title_mail')  : __('Nadpis', TM_PLUGSU));
        $mail = (get_option('su_admin_mail') ? get_option('su_admin_mail')  : get_bloginfo('admin_email'));
        $footer = (get_option('su_footer_mail') ? get_option('su_footer_mail'): '');
        $content = (get_option('su_message_mail') ? get_option('su_message_mail'): ''); 
        $message =  $class_email->email_content( $title,[$content], $footer);
        $subject =   (get_option('su_subject_mail') ? get_option('su_subject_mail'): '');
        $t =  $class_email->send_client_emails( $mail,$subject, $message );

        return true;
      }

      static public function send_admin_mail( ) {
        $class_email = new SuSendEmail();
     
        $title = (get_option('su_title_mail') ?  get_option('su_title_mail')  : __('Nadpis', TM_PLUGSU));
        $mail = (get_option('su_admin_mail') ? get_option('su_admin_mail')  : get_bloginfo('admin_email'));
        $footer = (get_option('su_footer_mail') ? get_option('su_footer_mail'): '');
        $content = (get_option('su_message_mail') ? get_option('su_message_mail'): ''); 
        $message =  $class_email->email_content( $title,[$content], $footer);
        $subject =   (get_option('su_subject_mail') ? get_option('su_subject_mail'): '');
       $t =  $class_email->send_client_emails( $mail,$subject, $message );

        return true;
      }
        /**
         * vytvoření řádku pro tabulku s posty
         *
         * @param $city_id = id taxnonomy mesta
         * @param $city_name = jmeno taxnonomy mesta
         * @author digihood
         * @return string
         */ 
      public static function get_city_tab_row($city_id, $city_name) {
        $su_free = 0;
        $su_reserved = 0;
        $su_occupied = 0;
        $args = array(
            'post_type'  => 'save_ukraine',
            'tax_query' => array(
                array(
                    'taxonomy' => 'save_ukraine_type',
                    'field'    => 'term_id',
                    'terms'    => array($city_id),
                )
            )

        );
        $postslist = get_posts( $args );
        foreach ($postslist as $city_data) {
          $status_book = get_post_meta($city_data->ID, 'su_status', true );
          $count_free_spot = get_post_meta($city_data->ID, 'count_free_spot', true);
          if($status_book == 'free' || empty($status_book)){
         
            $su_free+= $count_free_spot;
          }else if ($status_book == 'occupied') {
            $su_occupied+= $count_free_spot;
          } else if ($status_book == 'reserved'){
            $su_reserved+= $count_free_spot;
          }
        }
        $html = '<tr>';
          $html .= '<td>'.$city_name.'</td>';
          $html .= '<td style="text-align:center">'.$su_free.' ('.$su_reserved.')</td>';
          $html .= '<td style="text-align:center">'.$su_occupied.'</td>';
        $html .= '</tr>';
        return $html;
      }

     

    
    }
    // new SuProcessing;
}