<?php 
/**
 * Popis třídy
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

      static function get_all_save_ukraine_terms(){
          $terms = get_terms([
              'taxonomy' => 'save_ukraine_type',
              'hide_empty' => false,
          ]);
          $term = [];
          foreach ($terms as  $value) {
              $term[$value->term_id] = $value->name;
          }
          return $term;
      }

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

      static function show_value_field($post_id,$key){
        $field = get_post_meta( $post_id,  $key, true );
        if(isset($field) && $field) {
            return $field;
        }
        return null;
      }

      static function gel_all_pages_for_select(){
        $pages = get_pages();
        $pages_for_select = [];
        foreach ($pages as  $value) {
         $pages_for_select[$value->post_name] = $value->post_title;
        
        }
        
        
        return $pages_for_select;
      }

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

     

    
    }
    // new SuProcessing;
}