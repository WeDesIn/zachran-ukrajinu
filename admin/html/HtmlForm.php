<?php 

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

if( ! class_exists( 'HtmlForm' ) )
{
	class HtmlForm
	{
        public function __construct()
		{

        }

        public function html_input_zoneposttype(){
            global $post_id;
          ?>
            <input type="hidden" name="your_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

          

            <label for="su_name">Jmeno:</label>
                <input type="text" id="su_name" name="su_name" value="<?= self::show_value_field($post_id,'su_name')?>"><br><br>
            <label for="su_subname">Přijmení:</label>
                <input type="text" id="su_subname" name="su_subname" value="<?= self::show_value_field($post_id,'su_subname')?>"><br><br>
            <label for="su_mail">E-mail:</label>
                <input type="text" id="su_mail" name="su_mail" value="<?= self::show_value_field($post_id,'su_mail')?>"><br><br>
            <label for="su_adress">Adresa:</label>
                <input type="text" id="su_adress" name="su_adress" value="<?= self::show_value_field($post_id,'su_adress')?>"><br><br>
            <label for="su_phone">Telefon:</label>
                <input type="text" id="su_phone" name="su_phone" value="<?= self::show_value_field($post_id,'su_phone')?>"><br><br>
            <label for="count_free_spot">Počet míst:</label>
                <input type="text" id="count_free_spot" name="count_free_spot" value="<?= self::show_value_field($post_id,'count_free_spot')?>"><br><br>
            <label for="su_city">Město:</label>
                <input type="text" id="su_city" name="su_city" value="<?= self::show_value_field($post_id,'su_city')?>"><br><br>
            <label for="su_comment">Poznámky:</label>
                <input type="text" id="su_comment" name="su_comment" value="<?= self::show_value_field($post_id,'su_comment')?>"><br><br>
            <label for="su_status">Status:</label>
                <input type="text" id="su_status" name="su_status" value="<?= self::show_value_field($post_id,'su_status')?>"><br><br>
          <?php
        }

        public function  shortcode_form(){
            ob_start();
             ?>
            <form action="/sample-page/" method="post" id="shortcode_form">
            <input type="hidden" name="save_su_shortcode" value="1">
            <label for="su_name">Jmeno:</label>
                <input type="text" id="su_name" name="su_name"><br><br>
            <label for="su_subname">Přijmení:</label>
                <input type="text" id="su_subname" name="su_subname"><br><br>
            <label for="su_mail">E-mail:</label>
                <input type="text" id="su_mail" name="su_mail" ><br><br>
            <label for="su_adress">Adresa:</label>
                <input type="text" id="su_adress" name="su_adress"><br><br>
            <label for="su_phone">Telefon:</label>
                <input type="text" id="su_phone" name="su_phone"><br><br>
            <label for="count_free_spot">Počet míst:</label>
                <input type="text" id="count_free_spot" name="count_free_spot" ><br><br>
            <label for="su_city">Město:</label>
            <select name="su_city" id="mesto" form="shortcode_form">
                <?php
                foreach (zonePostType::get_all_save_ukraine_terms() as $key => $value) {
                   echo '<option value='.$key.'>'.$value.'</option>';
                }
                ?>
                </select><br><br>
            <label for="su_comment">Poznámky:</label>
                <input type="textarea" id="su_comment" name="su_comment" ><br><br>
            <label for="su_status">Status:</label>
                <input type="text" id="su_status" name="su_status" ><br><br>
                <input type="submit" value="Submit">
            </form>
            <?php return ob_get_clean();
        }

        static function show_value_field($post_id,$key){
            $field = get_post_meta( $post_id,  $key, true );
            if(isset($field) && $field) {
                return $field;
            }
            return null;
        }
    }
}