<?php 
/**
 * nastavení pluginu
 *
 * 
 * @author Wedesin
 */ 

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

if( ! class_exists( 'SuSetting' ) )
{
	class SuSetting
	{

       

		public function __construct()
		{
         add_action( 'admin_init',[$this,'save_setting_su_feilds'] );
        }
         /**
         * přidaní obsahu do  nastavení pluginu
         * @author digihood
         * @return function
         */ 
        
        public function settings_index(){
           
            HtmlForm::settings_page_html();
           
        }
         /**
         * uložení dat z nastavení pluginu
         * @author digihood
         * @return 
         */ 

        public function save_setting_su_feilds(){
            if(isset($_POST['save_su_settings_thanksyou']) && $_POST['save_su_settings_thanksyou'] == 'send') {
                if(isset($_POST['su_thanksyou']) && $_POST['su_thanksyou']){
                    update_option('su_thanksyou',$_POST['su_thanksyou']); 
                }
                if(isset($_POST['su_thanksyou_page']) && $_POST['su_thanksyou_page']){
                    update_option('su_thanksyou_page',$_POST['su_thanksyou_page']); 
                }
                if(isset($_POST['su_thanksyou_text']) && $_POST['su_thanksyou_text']){
                    update_option('su_thanksyou_text',$_POST['su_thanksyou_text']); 
                }else {
                    delete_option('su_thanksyou_text');
                }
                if(isset($_POST['su_selected_tax']) && $_POST['su_selected_tax']){
                    update_option('su_selected_tax',$_POST['su_selected_tax']); 
                }else {
                    delete_option('su_selected_tax');
                }
            }
            if(isset($_POST['save_su_settings_thanksyou']) && $_POST['save_su_settings_thanksyou'] == 'text'){
                if(isset($_POST['su_admin_mail']) && $_POST['su_admin_mail']){
                    update_option('su_admin_mail',$_POST['su_admin_mail']); 
                   
                }else {
                    delete_option('su_admin_mail');
                }
                if(isset($_POST['su_subject_mail']) && $_POST['su_subject_mail']){
                    update_option('su_subject_mail',$_POST['su_subject_mail']); 
                   
                }else {
                    delete_option('su_subject_mail');
                }
                if(isset($_POST['su_title_mail']) && $_POST['su_title_mail']){
                    update_option('su_title_mail',$_POST['su_title_mail']); 
                   
                }else {
                    delete_option('su_title_mail');
                }
                if(isset($_POST['su_footer_mail']) && $_POST['su_footer_mail']){
                    update_option('su_footer_mail',$_POST['su_footer_mail']); 
                   
                }else {
                    delete_option('su_footer_mail');
                }
                if(isset($_POST['su_message_mail']) && $_POST['su_message_mail']){
                    update_option('su_message_mail',$_POST['su_message_mail']); 
                   
                }
            
            }
          }
    }
    // new SuSetting;
}