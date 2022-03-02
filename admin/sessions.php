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
        private $default_mess_succ;
        private $default_mess_error;

		public function __construct()
		{
           
            $this->default_mess_succ = __("Nastavení bylo úspěšně aktualizováno", TM_PLUGSU);
            $this->default_mess_error = __("Nastavení se nepodařilo uložit. Zkuste to, prosím, znovu.", TM_PLUGSU);
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
            if ( isset( $_SESSION[$name] ) ) 
            {

                if ( $value !== "" ) 
                {

                    if ( $_SESSION[$name] == $value ) 
                    {
                        return true;
                    }                    

                } else {

                    if ( $_SESSION[$name] == 'error' || $_SESSION[$name] == 'success' || $_SESSION[$name] == 'fail') 
                    {

                        return true;

                    } else {
                        
                    }

                }

            }

            return false;

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

        /**
         * kontrola aktivace sessin
         *
         * @param $name = jméno session
         * 
         * @author digihood
         * @return true/false
         */ 
        public function chceckallsesion() {

            if (isset($_SESSION)){
                
                return $_SESSION;
                }
                echo 'neni sessions';
                
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
        public function show_su_mess(){
       
        }
            
    }
 }