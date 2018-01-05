<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 31.12.2017
 * Time: 14:28
 */

class Roll_theme_options_export {

	private $optionsName;
    private $dataDir;

    public function __construct($optionsName) {
        $this->dataDir = get_template_directory() .'/export/data.json';
		$this->optionsName = $optionsName;
	}

	/*
	 * Export options data
	 */

	public function export() {
		$json = json_encode(get_option($this->optionsName));
		file_put_contents($this->dataDir, $json);
        return $json;
	}

	/*
	 * Import options data
	 */

	public function import() {
        $data = null;
        if (file_exists($this->dataDir)) {
            $data = file_get_contents($this->dataDir);
            if (strlen($data) != 0) {
                return json_decode($data, true);
            }
        }
        return false;
    }
}