<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 21.12.2017
 * Time: 18:14
 */

class Roll_theme_options_controls {
	private static $optionsName = null;
	private static $options = null;

	/*
	 * Get flied
	 * @return string
	 */

	public static function getControl($type, $params) {
		$html = '';
		$attrName = '';

		if (!$type && !is_string($type)) return false;
		if (!is_array($params) || empty($params)) return false;


		switch ($type) {
			case "text" : {
				$value = '';
				$attrName = self::$optionsName . '[' . $params['id'] . ']';

				if (isset($options[$params['id']]))
					$value = self::$options[$params['id']];
				$params['attrName'] = $attrName;

				return 	self::textFlied($value, $params);
			}

			default : {
				return false;
			}
		}
	}

	/*
	 * Get input with type text
	 * @return string
	 */

	private static function textFlied($value, $params) {
		$html = '<tr>
                    <th>
                        <label for="text">'.$params['label'].'</label>
                        <div class="roll-desc">'.$params['desc'].'</div>
                    </th>
                    <td><input type="text" id="text" name="'. $params['attrName'] .'" value="'. $value .'" class="roll-text"></td>
                 </tr>';
		return $html;
	}

	/*
	 * Set options name
	 */

	public static function setOptionsName($name) {
		self::$optionsName = $name;
	}

	/*
	 * Set options
	 */

	public static function setOptions($options) {
		self::$options = $options;
	}
}