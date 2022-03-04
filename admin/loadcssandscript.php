<?php 

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

if( ! class_exists( 'loadcssandscript' ) )
{
	class loadcssandscript
	{
        public function __construct()
		{
            
            add_action( 'admin_enqueue_scripts', [$this,'load_admin_style'] );
        }
        function load_admin_style() {
            wp_register_style( 'admin_css', D1G1_SUURL . '/assets/save-ukraine.css', false, '1.0.0' );
         
           
        }
    
    }
    new loadcssandscript;
}
   
