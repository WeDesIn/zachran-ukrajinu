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
            add_shortcode('show_su_form', [$this,'su_shortcode_form']); 
            add_shortcode('show_su_list_free', [$this,'su_shortcode_free']); 
            add_action('init', [$this,'save_field_from_short_code']); 
            $this->HtmlForm = new HtmlForm;
            $this->sessions = new su_session;
        }
       
        public function su_shortcode_form() { 
            $su_thanksyou_text = get_option('su_thanksyou_text');
            $su_thanksyou = get_option('su_thanksyou');

            if($this->sessions->checkSession('save_su_shortcode') === true){
                $type = $this->sessions->getSession('save_su_shortcode');
                $mess = $this->sessions->getSession('save_su_shortcode_mess');
                FlashMessages::show_su_mess($type,'Neco se pokazilo',$mess);

                $this->sessions->removeSession('save_su_shortcode');
            }
            if($this->sessions->checkSession('save_su_shortcode_success') === true){
                if($su_thanksyou == 'text'){
                    echo '<div class=su_thanksyou">'.(isset($su_thanksyou_text) && $su_thanksyou_text ? $su_thanksyou_text :'').'</div>';
                    $this->sessions->removeSession('save_su_shortcode_success');
                }
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
                'tax_input' => [
                    'save_ukraine_type' => [$_POST['su_city']]
                ]
                );
                $post_id = wp_insert_post($new_post);
                $data_of_post = SuProcessing::process_data_for_save($_POST);
                $SuProcessing = new SuProcessing;
                $check =  $SuProcessing->check_field_reqired($data_of_post);
                if($check == false){
                    $this->sessions->addSession('save_su_shortcode','fail');
                 
                    return false;
                }
                $save = SuProcessing::save_su_fields_meta_foreach($post_id,$data_of_post);
                if($save == true){    
                    $this->sessions->addSession('save_su_shortcode_success','success');
                    $this->sessions->addSession('save_su_shortcode_mess',['ok']);
                    SuProcessing::send_mail();
                   
                    return true;
                }else{
                    $this->sessions->addSession('save_su_shortcode','error');
                    $this->sessions->addSession('save_su_shortcode_mess','error');
                    return false; 
                }
            }

        }

        public function su_shortcode_free (){
            $all_post = SuProcessing::get_all_save_ukraine_post();

            return HtmlForm::shortcode_list($all_post);
             
        }



    }
    new shortcode;
}

