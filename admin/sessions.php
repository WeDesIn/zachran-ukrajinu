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

if( ! class_exists( 'su_session' ) )
{
	class su_session
	{

		public function __construct()
		{
            if(!session_id()) session_start();
        }

        /**
         * Vytvoření session
         *
         * @param $name = jméno session
         * @param $value = hodnota
         * 
         * @author digihood
         * @return true/false
         */ 
        public function addSession( $name, $value="" ) 
        {
            $_SESSION[$name] = $value;
            return true;
        }

        /**
         * Kontrola session
         *
         * @param $name = jméno session
         * @param $value = hodnota
         * 
         * @author digihood
         * @return true/false
         */ 
        public function checkSession( $name, $value="" ) 
        {
            if ( !isset( $_SESSION[$name] ) ) return false;

            if ( $value !== "" ) {

                if ( $_SESSION[$name] == $value ) {
                    return true;
                }                    

            } else {

                if ( $_SESSION[$name] == 'error' || $_SESSION[$name] == 'success' || $_SESSION[$name] == 'fail') {

                    return true;

                } else {
                    
                }

            }

        }

        /**
         * Získat session
         *
         * @param $name = jméno session
         * 
         * @author digihood
         * @return true/false
         */ 
        public function getSession( $name ) 
        {
            
            if ( isset( $_SESSION[$name] ) ) 
            {
                return $_SESSION[$name];
            }

            return false;

        }

        /**
         * Odebrat session
         *
         * @param $name = jméno session
         * 
         * @author digihood
         * @return true/false
         */ 
        public function removeSession( $name ) 
        {
            if ( isset( $_SESSION[$name] ) ) 
            {
                unset($_SESSION[$name]);
                return true;
            }

            return false;
        }
            
    }
 }