<?php 

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

if( ! class_exists( 'shortcode' ) )
{
	class shortcode
	{
        private $HtmlForm;
        private $sessions;
        public function __construct()
		{
            add_shortcode('show_su_form', [$this,'su_shortcode']); 
            add_action('init', [$this,'save_field_from_short_code']); 
            $this->HtmlForm = new HtmlForm;
            $this->sessions = new su_session;
        }
       
        function su_shortcode() { 
    
                if($this->sessions->checkSession('save_su_shortcode') == true){
                    $variable = $this->sessions->getSession('save_su_shortcode');
                    FlashMessages::show_su_mess($variable,'test','text');
          
                }
        return $this->HtmlForm->shortcode_form();
       
        } 

        public function save_field_from_short_code(){
            if(isset($_POST['save_su_shortcode']) && $_POST['save_su_shortcode'] == 1){
                global $user_ID;
                $new_post = array(
                'post_title' => $_POST['su_name'] .' '. $_POST['su_subname'],
                'post_status' => 'publish',
                'post_date' => date('Y-m-d H:i:s'),
                'post_author' => $user_ID,
                'post_type' => 'save_ukraine',
               'post_category' => array($_POST['su_city'])
                );
                $post_id = wp_insert_post($new_post);
                $data_of_post = zonePostType::process_data_for_save($_POST);
                $save = zonePostType::save_su_fields_meta_foreach($post_id,$data_of_post);
                $this->sessions->addSession('save_su_shortcode','success');
                return true;
            }
            $this->sessions->addSession('save_su_shortcode','fail');
            return false;
            
           
        }



    }
    new shortcode;
}

