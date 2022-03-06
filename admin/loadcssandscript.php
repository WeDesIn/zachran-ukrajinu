<?php 

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

if( ! class_exists( 'loadcssandscriptWedesin' ) )
{
	class loadcssandscriptWedesin
	{
        public function __construct()
		{
            add_action( 'admin_enqueue_scripts', [$this,'load_admin_style'] );
            add_action( 'wp_enqueue_scripts', [$this,'load_frontend_style'] );
        }
        function load_admin_style() {
            wp_enqueue_style( 'wedesin-admin-css', D1G1_SUURL . 'assets/save-ukraine-backend.css', array(), filemtime( D1G1_SUPATH . 'assets/save-ukraine-backend.css'), 'all' );
        }
        function load_frontend_style() {
            wp_enqueue_style( 'main-form-css', D1G1_SUURL . 'assets/save-ukraine.css', array(), filemtime( D1G1_SUPATH . 'assets/save-ukraine.css'), 'all' );
        }
    
    }
    new loadcssandscriptWedesin;
}
   
