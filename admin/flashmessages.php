<?php 
/**
 * class description
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
         * @param $message = obsah zprávy
         * @param $errormsq = zda je to chybová hláška
         * 
         * @author digihood
         * @return true/false
         */ 
        static public function show_su_mess($type,$mess,$submess){
            
            switch ($type) {
                case 'success':
                    echo '<div class="messageBox success">';
                    echo '<p>'.$mess.'</p>';
                    echo '<ul><li>'.$submess.'</li></ul>';
                    echo '</div>';
                    break;
                case 'error':
                    echo '<div class="messageBox error">';
                    echo '<p>'.$mess.'</p>';
                    echo '<ul><li>'.$submess.'</li></ul>';
                    echo '</div>';
                    break;
                case 'fail':
                    echo '<div class="messageBox fail">';
                    echo '<p>'.$mess.'</p>';
                    echo '<ul><li>'.$submess.'</li></ul>';
                    echo '</div>';
                    break;
            }
       
        }
            
    }
 }