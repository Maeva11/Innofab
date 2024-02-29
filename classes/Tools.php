<?php

require_once ('Controller.php');
class Tools extends GWModel
{
    public static function mapCss($file)
    {
        return '<link rel="stylesheet" href="' . $file . '" >';
    }

    public static function mapJs($file)
    {
        return '<script src="' . $file . '" ></script>';
    }
    public static function redirect($to)
    {
        header('Location: '.$to);
        die();
    }

    public static function getValue($label)
    {
        return (new Admin())->getDatas($label);
    }

    public static function strRandom($length)
    {
        $alphabet = '0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN';
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }
    public static function Link($name, $id, $title)
    {
        return URI.$name.$id.'/'.self::slug_file($title);
    }
    public static function trad($word)
    {
        if(!empty($trad =  @(new Admin())->translate($word, LANG, @$_SESSION['lang']))){
            return $trad;
        }
        return $word;
    }
    public static function slug($string)
    {
        $separator = '-';

        $accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
        $special_cases = array('&' => 'and', "'" => '');
        $string = strip_tags(str_replace('<br>', ' ', $string));
        $string = mb_strtolower(trim($string), 'UTF-8');
        $string = str_replace(array_keys($special_cases), array_values($special_cases), $string);
        $string = preg_replace($accents_regex, '$1', htmlentities($string, ENT_QUOTES, 'UTF-8'));
        $string = preg_replace("/[^a-z0-9]/u", "$separator", $string);
        $string = preg_replace("/[$separator]+/u", "$separator", $string);
        return $string;
    }
    public static function pageURL($name){
        return self::slug($name);
    }
    public static function generateInput($type = 'text', $label = '', $name = ' ', $value = '', $class = '', $placeholder='', $options = array(), $disabled = false, $size = '1', $display='', $largeur = "", $masque="")
    {
        $sReturn = '';
        switch ($type) {
            case 'image_content':
                $sReturn = '<fieldset class="row form-group ' .$largeur.' '.$class. '">
								<label for="' . $name . '">' . ucfirst($label) . '</label>
								<div class="col-md-5">';
                if (@!empty($value)) {
                    $sReturn .= '<br>
											<img src="' . BASE_URL . $value . '" height="150" width="auto"/><br/><br>
											<input data-masque="'.$masque.'" type="hidden" name="' . $label . 'img" value="' . $value . '" />';
                }
                $sReturn .= '
										<input data-masque="'.$masque.'" type="' . $type . '" class="form-control-file" id="' .$name. '" name="' . $name . '" ' . ($disabled === true ? "disabled" : "") . '>
									</fieldset>
								</div>
								<div class="col-md-7">
									<textarea type="textarea" class="form-control '.@$class.'" id="' .$name. '" name="' . $name . '" placeholder="' . $placeholder . '">' . $value . '</textarea>
								</div>
						</fieldset>';
                break;
            case 'text':
                if(!strpos($class, "not-trad")) {
                    $label .= (_PREFIX_LANG_ == "_en") ? " <img src='" . ADMIN_URL . "assets/flag-kingdom.png' style='height:30px;margin-left:1em;'>" : "";
                }
                    $name .=_PREFIX_LANG_;
                $sReturn = '<fieldset class="form-group ' .$largeur.' '.$class. '" >
							<label for="' . $name . '">' . ucfirst($label) . '</label>
							<input data-masque="'.$masque.'" type="' . $type . '" class="form-control" id="' .$name. '" name="' . $name . '" placeholder="' . $placeholder . '"  value="' . $value . '" ' . ($disabled === true ? "disabled" : "") . '>
						</fieldset>';
                break;
            case 'password':
                $sReturn = '<fieldset class="form-group ' .$largeur.' '.$class. '" >
							<label for="' . $name . '">' . ucfirst($label) . '</label>
							<input data-masque="'.$masque.'" type="' . $type . '" class="form-control" id="' .$name. '" name="' . $name . '" placeholder="' . $placeholder . '"  value="' . $value . '" ' . ($disabled === true ? "disabled" : "") . '>
						</fieldset>';
                break;
            case 'textarea':
                if(!strpos($class, "not-trad")) {
                    $label .= (_PREFIX_LANG_ == "_en") ? " <img src='" . ADMIN_URL . "assets/flag-kingdom.png' style='height:30px;margin-left:1em;'>" : "";
                }
                $name .=_PREFIX_LANG_;
                if ($name == "structure" || $name == "structure_en") { $editor = "not-tiny"; }
                $sReturn = '<fieldset class="form-group ' .$largeur.' '.$class. '">
							<label for="' . $name . '">' . ucfirst($label) . '</label>
							<textarea type="' . $type . '" class="form-control '.@$editor.'" id="' .$name. '" name="' . $name . '" placeholder="' . $placeholder . '">' . $value . '</textarea>
						</fieldset>';
                break;
            case 'hidden':
                $sReturn = '<input  type="'.$type.'" id="'.$name.'" name="'.$name.'" value="'.$value.'">';
                break;
            case 'select':
                $sReturn = '<fieldset class="form-group ' .$largeur.' '.$class. '">
							<label for="' . $name . '">' . ucfirst($label) . '</label>
							<select class="form-control" id="' .$name. '" name="' . $name . '" placeholder="' . $placeholder . '" autocomplete="off">
								<option value="">' . $placeholder . '</option>';
                if (count($options) > 0)
                    foreach ($options as $key => $Ovalue)
                        $sReturn .= '<option value="' . $key . '" ' . ($value == $key ? 'selected' : '') . '>'  .str_repeat('&nbsp;&nbsp;&nbsp;-&nbsp;',$Ovalue) . $Ovalue . '</option>';
                $sReturn .= '
							</select>
						</fieldset>';
                break;
            case 'checkbox':
                $sReturn = '<fieldset class="form-group col-3 ' .$class. '">';
                $sReturn .= '<input name="' . $name . '" id="' . $name . '" value="' . $value . '" ' . (($value == 1) ? 'checked="checked"' : '').' type="checkbox" />';
                $sReturn .= '<label for="' . $name . '" class="ml-3">'.$label.'</label>';
                $sReturn .= '</fieldset>';
                break;
            case 'radio':
                $sReturn = '<fieldset class="form-group ' .$largeur.' '.$class. '">
							<label for="' . $name . '"  class="mr-1">' . ucfirst($label) . '</label>';
                if (count($options) > 0)
                    foreach ($options as $key => $val)
                        $sReturn .= '<input name="'.$name .'" value="' . $val . '" ' . ($value == $val ? 'checked="checked"' : '') . ' type="radio"  class="mr-3 ml-5"/>' . $key . '&nbsp;&nbsp;';
                $sReturn .= '
							</select>
						</fieldset>';
                break;
            case 'number':
                $sReturn = '<fieldset class="form-group ' .$largeur.' '.$class. '" >
							<label for="' . $name . '">' . ucfirst($label) . '</label>
							<input data-masque="'.$masque.'" type="number" class="form-control" id="' .$name. '" name="' . $name . '" placeholder="' . $placeholder . '"  value="' . $value . '" ' . ($disabled === true ? "disabled" : "") . '>
						</fieldset>';
                break;
                case 'date':
                $sReturn = '<fieldset class="form-group ' .$largeur.' '.$class. '" >
							<label for="' . $name . '">' . ucfirst($label) . '</label>
							<input data-masque="'.$masque.'" type="date" class="form-control" id="' .$name. '" name="' . $name . '" placeholder="' . $placeholder . '"  value="' . $value . '" ' . ($disabled === true ? "disabled" : "") . '>
						</fieldset>';
                break;
            case 'file':

                $sReturn = '<fieldset class=" ' .$class. ' ' .$largeur.'">
								<label for="' . $name . '">' . ucfirst($label) . '</label><br>
								<input data-masque="'.$masque.'" type="file" class="form-control-file dropify-fr" ' . ((@!empty($value)) ? 'data-default-file="'.$value.'"' : '') . ' id="' .$name. '" name="' . $name . '"  >
								<input type="hidden" name="' . $name . '"  value="'.$value.'" >
							</fieldset>';
                break;
                case 'color':
                (empty($value))? $value = "#22387F" : "";
                $sReturn = '<fieldset class=" ' .$class. ' ' .$largeur.'">
								<label for="' . $name . '">' . ucfirst($label) . '</label><br>
								<input data-masque="'.$masque.'" type="color" class="form-control" value="'.$value.'" id="' .$name. '" name="' . $name . '"  >
							</fieldset>';
                break;
            case 'submit':
                $sReturn = '<fieldset class="form-group ' .$largeur.' '.$class. '"><input data-masque="'.$masque.'" type="submit" name="'.$name.'" value="'.@$value. '" /></fieldset>';
                break;
        }
        return $sReturn;
    }

    public static function generateTextarea($label = ' ', $name = ' ', $value = '', $class = '', $placeholder = '')
    {
        if ($name == "structure") {
            $editor = "editor";
        }
        $html = '<fieldset class="form-group mt-3 ' . $class . '">
                    <label for="' . $name . '">' . $label . '</label>
                    <textarea class="form-control mt-5 ' . @$editor . '" id="' . $name . '" name="' . $name . '" placeholder="' . $placeholder . '">' . $value . '</textarea>
                </fieldset>';
        return $html;
    }

    public static function generateSelect($label, $name, $choices, $value, $class = '')
    {
        $html = '<fieldset class="form-group ' . $class . '">
                    <label for="' . $name . '">' . $label . '</label><br>
                    <select  class="form-control" id="' . $name . '"   name="' . $name . '">';
        foreach ($choices as $choice_value => $choice_label) {
            $html .= '<option value="' . $choice_value . '" ' . (@$choice_value == @$value ? 'selected' : '') . '> ' . $choice_label . '</option>';
        }
        $html .= '</select>
                </fieldset>';
        return $html;
    }
    public static function slug_file($string){
        $separator = '-';

        $accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
        $special_cases = array( '&' => 'and', "'" => '');
        $string = strip_tags(str_replace('<br>',' ',$string));
        $string = mb_strtolower( trim( $string ), 'UTF-8' );
        $string = str_replace( array_keys($special_cases), array_values( $special_cases), $string );
        $string = preg_replace( $accents_regex, '$1', htmlentities( $string, ENT_QUOTES, 'UTF-8' ) );
        $string = preg_replace("/[^a-z0-9.]/u", "$separator", $string);
        $string = preg_replace("/[$separator]+/u", "$separator", $string);
        return $string;
    }
    public static function setFlash($type = "success", $message = ""){
        $_SESSION['DZF3BO58M']['type'] = $type;
        $_SESSION['DZF3BO58M']['message'] = $message;
    }
    public static function showFlash(){
        if(!isset($_SESSION['DZF3BO58M'])){ return  ""; }
        $message = '<div class="'.@$_SESSION['DZF3BO58M']['type'].' alert-success" role="alert">'.@$_SESSION['DZF3BO58M']['message'].'</div>';
        unset($_SESSION['DZF3BO58M']);
        return $message;
    }
}
function __($text){
    return Tools::trad($text);
}
