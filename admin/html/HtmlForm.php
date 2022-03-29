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
        /**
        * 	output metaboxu
        *
        * 	@param $post = data postu 
        *	
        * 
        * 	@author Wedesin
        * 	@return html
        */

        public function Html_output_metabox($post){
            $post_id = $post->ID;
            $free_dog =  SuProcessing::show_value_field($post_id,'su_free_dog');

            ?>
            <fieldset class="wedesin_meta_box_form wedesin-form-status">
                <label for="su_status"><?= __('Status:',TM_PLUGSU); ?></label>
                <input type="radio" id="free" name="su_status" required value="free" <?= (SuProcessing::show_value_field($post_id,'su_status') == 'free' ? 'checked' : '');?>>
                <label for="free"><?= __('Volno',TM_PLUGSU); ?></label>
                <input type="radio" id="occupied" name="su_status" required value="occupied" <?= (SuProcessing::show_value_field($post_id,'su_status') == 'occupied' ? 'checked' : '');?>>
                <label for="occupied"><?= __('Obsazeno',TM_PLUGSU); ?></label>
                <input type="radio" id="reserved" name="su_status" required value="reserved" <?= (SuProcessing::show_value_field($post_id,'su_status') == 'reserved' ? 'checked' : '');?>>
                <label for="reserved"><?= __('Rezervováno',TM_PLUGSU); ?></label>
            </fieldset>
            <fieldset class="wedesin_meta_box_form">
                <label for="su_name"><?= __('Jméno:',TM_PLUGSU); ?></label>
                <input type="text" id="su_name" name="su_name" required value="<?= SuProcessing::show_value_field($post_id,'su_name')?>">
            </fieldset>
            <fieldset class="wedesin_meta_box_form">
                <label for="su_subname"><?= __('Příjmení:',TM_PLUGSU); ?></label>
                <input type="text" id="su_subname" name="su_subname"  required value="<?= SuProcessing::show_value_field($post_id,'su_subname')?>">
            </fieldset>
            <fieldset class="wedesin_meta_box_form">
                <label for="su_mail"><?= __('E-mail:',TM_PLUGSU); ?></label>
                <input type="text" id="su_mail" name="su_mail" required value="<?= SuProcessing::show_value_field($post_id,'su_mail')?>">
            </fieldset>
            <fieldset class="wedesin_meta_box_form">
                <label for="su_adress"><?= __('Adresa',TM_PLUGSU); ?></label>
                <input type="text" id="su_adress" name="su_adress" required value="<?= SuProcessing::show_value_field($post_id,'su_adress')?>">
            </fieldset>
            <fieldset class="wedesin_meta_box_form">
                <label for="su_phone"><?= __('Telefon',TM_PLUGSU); ?></label>
                <input type="text" id="su_phone" name="su_phone" required value="<?= SuProcessing::show_value_field($post_id,'su_phone')?>">
            </fieldset>
            <fieldset class="wedesin_meta_box_form">
                <label for="count_free_spot"><?= __('Počet míst:',TM_PLUGSU); ?></label>
                <input type="text" id="count_free_spot" name="count_free_spot" required value="<?= SuProcessing::show_value_field($post_id,'count_free_spot')?>">
            </fieldset>
            <fieldset class="wedesin_meta_box_form">
                <label for="su_free_dog"><?= __('Psi vítáni:',TM_PLUGSU); ?></label>
                <select name="su_free_dog" id="su_free_dog">
                   <option value='yes' <?= ($free_dog == 'yes' ? 'selected' : '')?>><?= __('Ano',TM_PLUGSU); ?></option>
                   <option value='no' <?= ($free_dog == 'no' ? 'selected' : '')?>><?= __('Ne',TM_PLUGSU); ?></option>
                </select>
            </fieldset>
            <fieldset class="wedesin_meta_box_form">
                <label for="su_speak"><?= __('Hovoří těmito jazyky:',TM_PLUGSU); ?></label>
                <input type="text" id="su_speak" name="su_speak" required value="<?= SuProcessing::show_value_field($post_id,'su_speak')?>">
            </fieldset>
            <fieldset class="wedesin_meta_box_form">
                <label for="su_accommodation_length"><?= __('Delka ubytování:',TM_PLUGSU); ?></label>
                <input type="text" id="su_accommodation_length" required name="su_accommodation_length" value="<?= SuProcessing::show_value_field($post_id,'su_accommodation_length')?>">
            </fieldset>
            <fieldset class="wedesin_meta_box_form">
                <label for="su_comment"><?= __('Komentař:',TM_PLUGSU); ?></label><br>
                <textarea id="w3review" id="su_comment" name="su_comment" rows="4" cols="50"><?= SuProcessing::show_value_field($post_id,'su_comment')?></textarea>
            </fieldset>
          <?php
        }

        /**
        * 	shortcode formulař 
        *
        * 	@param $post = data postu 
        *	
        * 
        * 	@author Wedesin
        * 	@return html
        */
        public function  shortcode_form(){
            $su_thanksyou_page = get_option('su_thanksyou_page');
            $su_thanksyou = get_option('su_thanksyou');
            ob_start();
             ?>
                <form <?= ($su_thanksyou == 'page' ? 'action="/'.$su_thanksyou_page.'"' : '' )?> method="post" id="shortcode_form">
                    <?php wp_nonce_field('wedesin_form_send', 'form_send_action') ?>
                    <input type="hidden" name="save_su_shortcode" value="1">
                    <fieldset class="wedesin_save_form wedesin-half">
                        <label for="su_name"><?= __('Jmeno:',TM_PLUGSU); ?>*</label>
                        <input type="text" id="su_name" name="su_name" required>
                    </fieldset>
                    <fieldset class="wedesin_save_form wedesin-half">    
                        <label for="su_subname"><?= __('Přijmení:',TM_PLUGSU); ?>*</label>
                        <input type="text" id="su_subname" name="su_subname" required>
                    </fieldset>
                    <fieldset class="wedesin_save_form wedesin-half">        
                        <label for="su_mail"><?= __('E-mail:',TM_PLUGSU); ?>*</label>
                        <input type="email" id="su_mail" name="su_mail" required>
                    </fieldset>
                    <fieldset class="wedesin_save_form wedesin-half">        
                        <label for="su_phone"><?= __('Telefon',TM_PLUGSU); ?></label>
                        <input type="tel" id="su_phone" name="su_phone">
                    </fieldset>
                    <fieldset class="wedesin_save_form wedesin-fullwidth">          
                        <label for="su_adress"><?= __('Ubytovací adresa',TM_PLUGSU); ?>*</label>
                        <input type="text" id="su_adress" name="su_adress" required>
                    </fieldset>
                    <fieldset class="wedesin_save_form wedesin-fullwidth">        
                        <label for="su_city"><?= __('Město',TM_PLUGSU); ?>*</label>
                        <select name="su_city" id="mesto" >
                            <?php
                            $selected_tax = get_option('su_selected_tax');
                            foreach (SuProcessing::get_all_save_ukraine_terms() as $key => $value) { 
                            echo '<option value="'.$key.'" '.($key == $selected_tax ? 'selected':'').'>'.$value.'</option>';
                            }
                            ?>
                        </select>
                    </fieldset>
                    <fieldset class="wedesin_save_form wedesin-half">         
                        <label for="count_free_spot"><?= __('Počet míst:',TM_PLUGSU); ?>*</label>
                        <input type="number" id="count_free_spot" name="count_free_spot" required>
                    </fieldset>
                    <fieldset class="wedesin_save_form wedesin-half">    
                        <label for="su_free_dog"><?= __('Mazlíčci vítáni (psi, kočky...):',TM_PLUGSU); ?></label>
                        <select name="su_free_dog" id="su_free_dog">
                            <option value='yes'><?= __('Ano',TM_PLUGSU); ?></option>
                            <option value='no' ><?= __('Ne',TM_PLUGSU); ?></option>
                        </select>
                    </fieldset>
                    <fieldset class="wedesin_save_form wedesin-half">        
                        <label for="su_speak"><?= __('Hovoří těmito jazyky:',TM_PLUGSU); ?></label>
                        <input type="text" id="su_speak" name="su_speak">
                    </fieldset>            
                    <fieldset class="wedesin_save_form wedesin-half">        
                        <label for="su_accommodation_length"><?= __('Delka ubytování:',TM_PLUGSU); ?></label>
                        <input type="text" id="su_accommodation_length" name="su_accommodation_length">
                    </fieldset> 
                    <fieldset class="wedesin_save_form wedesin-fullwidth">       
                    <label for="su_comment"><?= __('Poznámka:',TM_PLUGSU); ?></label>
                        <textarea id="w3review" id="su_comment" name="su_comment" rows="4" cols="50"></textarea>
                    </fieldset>
                    <p><?= __('Odesláním formuláře souhlasíte se <a href="/ochrana-osobnich-udaju/" target="_blank">zpracováním osobních údajů</a>',TM_PLUGSU) ?></p>
                    <fieldset class="wedesin_save_form wedesin-fullwidth">       
                        <input type="submit" value="Odeslat">
                    </fieldset>
                </form>
            <?php return ob_get_clean();
        }
        
        /**
        * 	output stranky nastavení 
        * 
        * 	@author Wedesin
        * 	@return html
        */
        static public function settings_page_html(){
           $default_tab = null;
           $tab = isset($_GET['tab']) ? $_GET['tab'] : $default_tab;
  
            ?>
            <div class="wrap">
                <h1><?= __( 'Nastavení', TM_PLUGSU ); ?></h1>
                <nav class="nav-tab-wrapper">

                    <a href="edit.php?post_type=save_ukraine&page=Setting_save_ukraine" class="nav-tab <?php if($tab===null):?>nav-tab-active<?php endif; ?>"><?= __( 'Odesílání formuláře', TM_PLUGSU ); ?></a>
                    <a href="edit.php?post_type=save_ukraine&page=Setting_save_ukraine&tab=text_settings" class="nav-tab <?php if($tab==='text_settings'):?>nav-tab-active<?php endif; ?>"><?= __( 'Nastavení', TM_PLUGSU ); ?></a>
                        <a href="edit.php?post_type=save_ukraine&page=Setting_save_ukraine&tab=shortcode" class="nav-tab <?php if($tab==='shortcode'):?>nav-tab-active<?php endif; ?>"><?= __( 'ShortCode', TM_PLUGSU ); ?></a>
                </nav>
                <div class="tab-content">
                <?php 
                switch($tab) :
                    case 'shortcode':
                        ?>
                        <br>
                        <fieldset class="wedesin_meta_box_form wedesin-form-status">
                            <label for="su_thanksyou"><?= __( 'Shortcode pro zobrazení formulaře pro odeslaní nabídky', TM_PLUGSU ); ?></label><br>
                            <label class="label-mini" for="su_thanksyou">[show_su_form]</label>
                            <br>
                            <label for="su_thanksyou"><?= __( 'Shortcode pro zobrazení tabulky s nabídkami', TM_PLUGSU ); ?></label><br>
                            <label class="label-mini" for="su_thanksyou">[show_su_list_free]</label>
                            <br>

                            </fieldset>
                        <?php
                        break;
                    case 'text_settings':
                        ?>
                        <h2><?= __( 'Nastavení e-mailu', TM_PLUGSU ); ?></h2>
                        <form action="edit.php?post_type=save_ukraine&page=Setting_save_ukraine&tab=text_settings" method="post" id="settings_form_thankyou">
                            <input type="hidden" name="save_su_settings_thanksyou" value="text">
                            <?php 
                            $su_admin_mail = get_option('su_admin_mail');
                            $su_subject_mail = get_option('su_subject_mail');
                            $su_title_mail = get_option('su_title_mail');
                            $su_footer_mail = get_option('su_footer_mail');
                            $su_message_mail = get_option('su_message_mail');
                            ?>
                        <fieldset class="wedesin_meta_box_form">
                            <label for="su_admin_mail"><?= __('E-mail Administratora',TM_PLUGSU); ?> </label>
                            <input type="text" id="su_admin_mail" name="su_admin_mail" value="<?=(isset($su_admin_mail) && $su_admin_mail  ? $su_admin_mail :'')?>">
                        </fieldset>
                        <fieldset class="wedesin_meta_box_form">
                            <label for="su_subject_mail"><?= __('Předmět e-mailu',TM_PLUGSU); ?> </label>
                            <input type="text" id="su_subject_mail" name="su_subject_mail" value="<?=(isset($su_subject_mail) && $su_subject_mail  ? $su_subject_mail :'')?>">
                        </fieldset>
                        <fieldset class="wedesin_meta_box_form">
                            <label for="su_title_mail"><?= __('Nadpis e-mailu',TM_PLUGSU); ?> </label>
                            <input type="text" id="su_title_mail" name="su_title_mail" value="<?=(isset($su_title_mail) && $su_title_mail  ? $su_title_mail :'')?>">
                        </fieldset>
                        <fieldset class="wedesin_meta_box_form">
                            <label for="su_footer_mail"><?= __('Text ve footeru e-mailu',TM_PLUGSU); ?> </label><br>
                            <textarea id="su_footer_mail" name="su_footer_mail"  rows="4" cols="50"><?=(isset($su_footer_mail) && $su_footer_mail  ? $su_footer_mail :'')?></textarea>
                        </fieldset>
                        <fieldset class="wedesin_meta_box_form">
                            <label for="su_message_mail"><?= __('Obsah Mailu',TM_PLUGSU); ?> </label>
                            <?php
                            $editor_settings = [
                                'textarea_rows' => 10 ,
                                'editor_class' => 'su_editor',

                            ];
                            wp_editor((isset($su_message_mail) && $su_message_mail  ? $su_message_mail :''),'su_message_mail',$editor_settings);
                            ?>
                        </fieldset>
                            <?php submit_button();?>
                        </form>
                        <?php
                        break;
                    default:
                        $su_thanksyou = get_option('su_thanksyou');
                        $su_thanksyou_page = get_option('su_thanksyou_page');
                        $su_thanksyou_text = get_option('su_thanksyou_text');
                        $su_selected_tax = get_option('su_selected_tax');
                        ?>
                        <h2><?= __( 'Nastavení odesílání formuláře', TM_PLUGSU ); ?></h2>
                        <form action="edit.php?post_type=save_ukraine&page=Setting_save_ukraine" method="post" id="settings_form_text">
                            <input type="hidden" name="save_su_settings_thanksyou" value="send">
                            <fieldset class="wedesin_meta_box_form wedesin-form-status">
                                <label for="su_thanksyou"><?= __( 'Akce po odeslání formláře', TM_PLUGSU ); ?></label>
                                <p><?= __( 'Vyberte, co bude následovat po odeslání formuláře', TM_PLUGSU ); ?></p>

                                <input type="radio" id="su_thanksyou" name="su_thanksyou" value="page" <?= ($su_thanksyou == 'page' ? 'checked' :' ')?>>
                                <label for="su_thanksyou"><?= __('Přesměrovat na děkovací stránku',TM_PLUGSU); ?></label><br>
                                <label class="label-mini" for="su_thanksyou"><?= __('Vyberte děkovací stránku',TM_PLUGSU); ?></label>
                                <select name="su_thanksyou_page" id="su_thanksyou_page" >
                                    <?php
                                    foreach (SuProcessing::gel_all_pages_for_select() as $key => $value) { 
                                        echo '<option value='.$key.''.( $su_thanksyou_page && $su_thanksyou_page == $key ? ' selected': '').'>'.$value.'</option>';
                                    }
                                    ?>
                                </select>
                                <br>
                                <input type="radio" id="su_thanksyou" name="su_thanksyou" value="text"  <?= ($su_thanksyou == 'text' ? 'checked' :' ')?>>
                                <label for="su_thanksyou"><?= __('Zobrazit zprávu',TM_PLUGSU); ?> </label><br>
                                <label class="label-mini" for="su_thanksyou_text"><?= __('Vyplňte obsah děkovací stránky',TM_PLUGSU); ?> </label>
                                <input type="text" id="su_thanksyou_text" name="su_thanksyou_text" value="<?= ($su_thanksyou_text  ? $su_thanksyou_text :'')?>">
                            </fieldset>
                            <fieldset class="wedesin_meta_box_form">
                            <label class="label-mini" for="su_selected_tax"><?= __('ID předvyplněného města',TM_PLUGSU); ?> </label>
                                <input type="number" id="su_selected_tax" name="su_selected_tax" value="<?=($su_selected_tax  ? $su_selected_tax :'')?>">
                            </fieldset>
                            <?php submit_button();?>
                        </form>
                        <?php
                        break;
                endswitch; ?>
                </div>
            </div>
            <?php
        }
          /**
        * 	shortcode list table 
        *
        * 	@author Wedesin
        * 	@return html
        */
        static function shortcode_list(){
            $su_cities = SuProcessing::get_all_save_ukraine_terms(true);
            ob_start();
            ?>
                <table>
                    <tr>
                        <th><?= __('Město',TM_PLUGSU)?></th>
                        <th style="text-align:center"><?= __('počet volných míst (rezervované)',TM_PLUGSU)?></th>
                        <th style="text-align:center"><?= __('počet obsazených míst',TM_PLUGSU)?></th>
                    </tr>
                    
                  <?php
                    foreach ($su_cities as $city_id => $city_name) {
                        echo SuProcessing::get_city_tab_row($city_id, $city_name);
                    }

                    ?>
                
                </table>
            <?php 
             
            return ob_get_clean();
        }
    }
}