<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 21.12.2017
 * Time: 18:14
 */

class Roll_theme_options_controls {
	private static $optionsName = null;

	public static function getControl($type, $params) {
		$html = '';
		$attrName = '';

		if (!$type && !is_string($type)) return false;
		if (!is_array($params) || empty($params)) return false;


		switch ($type) {
			case "text" : {
				$attrName = self::$optionsName . '[' . $params['id'] . ']';
				$html = '<tr>
                            <th>
                                <label for="text">'.$params['label'].'</label>
                                <div class="roll-desc">'.$params['desc'].'</div>
                            </th>
                            <td><input type="text" id="text" name="'. $attrName .'" class="roll-text"></td>
                          </tr>';
				return 	$html;
			}

			default : {
				return false;
			}
		}
	}
	private static function textFlied($value = '') {

	}

	public static function setOptionsName($name) {
		self::$optionsName = $name;
	}
}