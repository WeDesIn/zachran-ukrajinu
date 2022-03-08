<?php 
/**
 * Flash upozornení
 *
 * 
 * @author digihood
 */ 

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

if( ! class_exists( 'FlashMessages' ) )
{
	class FlashMessages
	{
     
        private $session;
		public function __construct()
		{
           
          $this->session = new su_session;
           
        }


        /**
         * přidat zprávu
         *
         * @param $rype = typ hlášky
         * @param $message = obsah zprávy
         * @param $errormsq = zda je to chybová hláška
         * 
         * @author digihood
         * @return true/false
         */ 
        public static function show_su_mess($type,$mess,$submess){
            
            switch ($type) {
                case 'success':
                   self::html_output_show_su_mess($type,$mess,$submess);
                    break;
                case 'error':
                    self::html_output_show_su_mess($type,$mess,$submess);
                    break;
                case 'fail':
                    self::html_output_show_su_mess($type,$mess,$submess);
                    break;
            }
       
        }

        /**
         * html_output_show_su_mess
         *
         * @param $rype = typ hlášky
         * @param $message = obsah zprávy
         * @param $errormsq = zda je to chybová hláška
         * 
         * @author digihood
         * @return true/false
         */ 
        private static function html_output_show_su_mess($type,$mess,$submess){
            echo '<div class="messageBox '.$type.'">';
            echo '<p>'.$mess.'</p>';
            if(is_array($submess)) {
                foreach ($submess as $value) {
                    echo '<ul><li>'.$value[0].'</li></ul>';
                }
            } else {
                echo '<ul><li>'.$submess.'</li></ul>';
            }
            echo '</div>';
        }
            
    }
 }