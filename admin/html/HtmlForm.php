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

        public function html_input_zoneposttype($post){
            global $post_id;
            $term = get_the_terms( $post_id, 'save_ukraine_type' );
             $free_dog =  SuProcessing::show_value_field($post_id,'su_free_dog');
        
          ?>
            <input type="hidden" name="your_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">
           
            <label for="su_status"><?= __('Status:',TM_PLUGSU); ?></label><br>
            <input type="radio" id="free" name="su_status" required value="free" <?= (SuProcessing::show_value_field($post_id,'su_status') == 'free' ? 'checked' : '');?>>
                <label for="free"><?= __('Volno',TM_PLUGSU); ?></label><br>
            <input type="radio" id="occupied" name="su_status" required value="occupied" <?= (SuProcessing::show_value_field($post_id,'su_status') == 'occupied' ? 'checked' : '');?>>
                <label for="occupied"><?= __('Obsazeno',TM_PLUGSU); ?></label><br><br>
            
            <label for="su_name"><?= __('Jmeno:',TM_PLUGSU); ?></label>
                <input type="text" id="su_name" name="su_name" required value="<?= SuProcessing::show_value_field($post_id,'su_name')?>"><br><br>
            <label for="su_subname"><?= __('Přijmení:',TM_PLUGSU); ?></label>
                <input type="text" id="su_subname" name="su_subname"  required value="<?= SuProcessing::show_value_field($post_id,'su_subname')?>"><br><br>
            <label for="su_mail"><?= __('E-mail:',TM_PLUGSU); ?></label>
                <input type="text" id="su_mail" name="su_mail" required value="<?= SuProcessing::show_value_field($post_id,'su_mail')?>"><br><br>
            <label for="su_adress"><?= __('Adresa',TM_PLUGSU); ?></label>
                <input type="text" id="su_adress" name="su_adress" required value="<?= SuProcessing::show_value_field($post_id,'su_adress')?>"><br><br>
            <label for="su_phone"><?= __('Telefon',TM_PLUGSU); ?></label>
                <input type="text" id="su_phone" name="su_phone" required value="<?= SuProcessing::show_value_field($post_id,'su_phone')?>"><br><br>
            <label for="count_free_spot"><?= __('Počet míst:',TM_PLUGSU); ?></label>
                <input type="text" id="count_free_spot" name="count_free_spot" required value="<?= SuProcessing::show_value_field($post_id,'count_free_spot')?>"><br><br>
           
            <label for="su_free_dog"><?= __('Psi vítáni:',TM_PLUGSU); ?></label>
            <select name="su_free_dog" id="su_free_dog">
           
                   <option value='yes' <?= ($free_dog == 'yes' ? 'selected' : '')?>><?= __('Ano',TM_PLUGSU); ?></option>
                   <option value='no' <?= ($free_dog == 'no' ? 'selected' : '')?>><?= __('Ne',TM_PLUGSU); ?></option>
            </select><br><br>
            <label for="su_speak"><?= __('Hovoří těmito jazyky:',TM_PLUGSU); ?></label>
                <input type="text" id="su_speak" name="su_speak" required value="<?= SuProcessing::show_value_field($post_id,'su_speak')?>"><br><br>
            <label for="su_accommodation_length"><?= __('Delka ubytování:',TM_PLUGSU); ?></label>
                <input type="text" id="su_accommodation_length" required name="su_accommodation_length" value="<?= SuProcessing::show_value_field($post_id,'su_accommodation_length')?>"><br><br>
            <label for="su_comment"><?= __('Komentař:',TM_PLUGSU); ?></label>
                <input type="text" id="su_comment" name="su_comment" value="<?= SuProcessing::show_value_field($post_id,'su_comment')?>"><br><br>
           
          <?php
        }

        public function  shortcode_form(){
            $su_thanksyou_page = get_option('su_thanksyou_page');
            $su_thanksyou = get_option('su_thanksyou');
            ob_start();
             ?>
            <form <?= ($su_thanksyou == 'page' ? 'action="/'.$su_thanksyou_page.'"' : '' )?> method="post" id="shortcode_form">
            
            <input type="hidden" name="save_su_shortcode" value="1">
            <fieldset class="save_ikraine shortcode">
                <label for="su_name"><?= __('Jmeno:',TM_PLUGSU); ?></label>
                    <input type="text" id="su_name" name="su_name" required><br><br>
            </fieldset>
            <fieldset class="save_ikraine shortcode">    
                <label for="su_subname"><?= __('Přijmení:',TM_PLUGSU); ?></label>
                    <input type="text" id="su_subname" name="su_subname" required><br><br>
            </fieldset>
            <fieldset class="save_ikraine shortcode">        
                <label for="su_mail"><?= __('E-mail:',TM_PLUGSU); ?></label>
                    <input type="email" id="su_mail" name="su_mail" required><br><br>
            </fieldset>
            <fieldset class="save_ikraine shortcode">          
                <label for="su_adress"><?= __('Adresa',TM_PLUGSU); ?></label>
                    <input type="text" id="su_adress" name="su_adress" required><br><br>
            </fieldset>
            <fieldset class="save_ikraine shortcode">        
                <label for="su_phone"><?= __('Telefon',TM_PLUGSU); ?></label>
                    <input type="tel" id="su_phone" name="su_phone" pattern="[0-9]{3} [0-9]{3} [0-9]{3}" required placeholder="777 777 777"><br><br>
            </fieldset>
           <fieldset class="save_ikraine shortcode">         
                <label for="count_free_spot"><?= __('Počet míst:',TM_PLUGSU); ?></label>
                    <input type="number" id="count_free_spot" name="count_free_spot" required><br><br>
            </fieldset>
            <fieldset class="save_ikraine shortcode">        
                <label for="su_city"><?= __('Město',TM_PLUGSU); ?></label>
                    <select name="su_city" id="mesto" >
                        <?php
                        foreach (SuProcessing::get_all_save_ukraine_terms() as $key => $value) { 
                        echo '<option value='.$key.'>'.$value.'</option>';
                        }
                        ?>
                    </select><br><br>
            </fieldset>
            <fieldset class="save_ikraine shortcode">    
                <label for="su_free_dog"><?= __('Psi vítáni:',TM_PLUGSU); ?></label>
                    <select name="su_free_dog" id="su_free_dog">
                
                        <option value='yes'><?= __('Ano',TM_PLUGSU); ?></option>
                        <option value='no' ><?= __('Ne',TM_PLUGSU); ?></option>
                    </select><br><br>
            </fieldset>
            <fieldset class="save_ikraine shortcode">        
                <label for="su_speak"><?= __('Hovoří těmito jazyky:',TM_PLUGSU); ?></label>
                    <input type="text" id="su_speak" name="su_speak" required><br><br>
            </fieldset>            
            <fieldset class="save_ikraine shortcode">        
                <label for="su_accommodation_length"><?= __('Delka ubytování:',TM_PLUGSU); ?></label>
                    <input type="text" id="su_accommodation_length" name="su_accommodation_length" required><br><br>
            </fieldset> 
            <fieldset class="save_ikraine shortcode">       
            <label for="su_comment"><?= __('Komentař:',TM_PLUGSU); ?></label>
                <input type="textarea" id="su_comment" name="su_comment" ><br><br>
            </fieldset>
                <input type="submit" value="Submit">
            
            </form>
            <?php return ob_get_clean();
        }

        static public function setting_html(){
           $pages = SuProcessing::gel_all_pages_for_select();
           $su_thanksyou = get_option('su_thanksyou');
           $su_thanksyou_page = get_option('su_thanksyou_page');
           $su_thanksyou_text = get_option('su_thanksyou_text');
  
            ?>
                <div class="wrap">
                <h1><?= __( 'Nastavení', TM_PLUGSU ); ?></h1>
                    <div class="su-admin left">
                    <h2><?= __( 'Nastavení Dekovaní', TM_PLUGSU ); ?></h2>
                    <form action="edit.php?post_type=save_ukraine&page=Setting_save_ukraine" method="post" id="settings_form">
                        <input type="hidden" name="save_su_settings_thanksyou" value="1">
                        <label for="su_thanksyou"><?= __( 'Vyber jak poděkuješ', TM_PLUGSU ); ?></label><br><br>
                            <input type="radio" id="su_thanksyou" name="su_thanksyou" value="page" <?= ($su_thanksyou == 'page' ? 'checked' :' ')?>>
                            <label for="su_thanksyou"><?= __('Stránka',TM_PLUGSU); ?></label>
                                <select name="su_thanksyou_page" id="su_thanksyou_page" >
                                    <?php
                                    foreach (SuProcessing::gel_all_pages_for_select() as $key => $value) { 
                                    echo '<option value='.$key.''.(isset($su_thanksyou_page) && $su_thanksyou_page && $su_thanksyou_page == $key ? ' selected': '').'>'.$value.'</option>';
                                    }
                                    ?>
                                </select><br><br>
                            <input type="radio" id="su_thanksyou" name="su_thanksyou" value="text"  <?= ($su_thanksyou == 'text' ? 'checked' :' ')?>>
                                <label for="su_thanksyou_text"><?= __('Text',TM_PLUGSU); ?> </label>
                                <input type="text" id="su_thanksyou_text" name="su_thanksyou_text" value="<?=(isset($su_thanksyou_text) && $su_thanksyou_text  ? $su_thanksyou_text :'')?>"><br><br>
                       
                    </div>
                    <div class="su-admin center">
                    <h2><?= __( 'Nastavení chybových hlašek', TM_PLUGSU ); ?></h2>
                    </div>
                    <div class="su-admin right">
                    <h2><?= __( 'Nastavení e-mailu', TM_PLUGSU ); ?></h2>
                    <fieldset class="save_ikraine settings-mail">   

                    <?php 
                        $su_admin_mail = get_option('su_admin_mail');
                        $su_subject_mail = get_option('su_subject_mail');
                        $su_title_mail = get_option('su_title_mail');
                        $su_footer_mail = get_option('su_footer_mail');
                        $su_message_mail = get_option('su_message_mail');
                       
                    ?>
                    <input type="hidden" name="save_su_settings_mail" value="1">
                        <label for="su_admin_mail"><?= __('E-mail Administratora',TM_PLUGSU); ?> </label>
                            <input type="text" id="su_admin_mail" name="su_admin_mail" value="<?=(isset($su_admin_mail) && $su_admin_mail  ? $su_admin_mail :'')?>"><br><br>
                        <label for="su_subject_mail"><?= __('Předmět e-mailu',TM_PLUGSU); ?> </label>
                            <input type="text" id="su_subject_mail" name="su_subject_mail" value="<?=(isset($su_subject_mail) && $su_subject_mail  ? $su_subject_mail :'')?>"><br><br>
                        <label for="su_title_mail"><?= __('Nadpis e-mailu',TM_PLUGSU); ?> </label>
                            <input type="text" id="su_title_mail" name="su_title_mail" value="<?=(isset($su_title_mail) && $su_title_mail  ? $su_title_mail :'')?>"><br><br>
                        <label for="su_footer_mail"><?= __('Text ve footeru e-mailu',TM_PLUGSU); ?> </label>
                            <input type="text" id="su_footer_mail" name="su_footer_mail" value="<?=(isset($su_footer_mail) && $su_footer_mail  ? $su_footer_mail :'')?>"><br><br>
                        <label for="su_message_mail"><?= __('Obsah Mailu',TM_PLUGSU); ?> </label>
                       <?php
                       $editor_settings = [
                           'textarea_rows' => 10 ,
                            'editor_class' => 'su_editor',

                            ];
                        wp_editor((isset($su_message_mail) && $su_message_mail  ? $su_message_mail :''),'su_message_mail',$editor_settings);
                        ?>
                        </fieldset>
                        </div>
                   
                        <?php submit_button();?>
                    </form>
                </div>
            <?php
        }

        static function shortcode_list($all_post){
            $su_city = SuProcessing::get_all_save_ukraine_terms();
            ob_start();
            ?>
                <table>
                <tr>
                    <th><?= __('jméno',TM_PLUGSU)?></th>
                    <th><?= __('město',TM_PLUGSU)?></th>
                    <th><?= __('počet volných míst',TM_PLUGSU)?></th>
                    <th><?= __('Pes',TM_PLUGSU)?></th>
                    <th><?= __('Jazyk',TM_PLUGSU)?></th>
                    <th><?= __('Delka ubytování',TM_PLUGSU)?></th>
                </tr>
                
                  <?php
                    foreach ($all_post as $key => $value) {
                      
                        echo '<tr>';
                        echo '<td>'.$value['title'].'</td>';
                        foreach ($su_city as $key => $city) {
                            if($value['su_city'] == $key ){
                                echo '<td>'.$city.'</td>';
                            }
                        }
                        echo '<td>'.$value['count_free_spot'].'</td>';
                        echo '<td>'.$value['su_free_dog'].'</td>';
                        echo '<td>'.$value['su_speak'].'</td>';
                        echo '<td>'.$value['su_accommodation_length'].'</td>';
                        echo '</tr>';
                    }

                    ?>


                </tr>
                
                </table>
            <?php 
             
            return ob_get_clean();
        }
    }
}