<?php 

App::import('Helper', 'Html');

class WikiformatHelper extends AppHelper {
	public $helpers = array('Html');

	var $defaults = array(
		'delimiter' => "x20",
		'brackets' => array('start' => '[', 'end' => ']',),
	);

	var $invalid_string = "―";

	public function makeLink($text, $options = array(), $link_options = array()) {
		if (empty($text)) {
			return $this->invalid_string;
		}
		$_setting = array_merge($this->defaults, $options);

		$delimiter = $_setting['delimiter'];
		$start = $_setting['brackets']['start'];
		$end = $_setting['brackets']['end'];

		$_options = var_export($link_options, true);

		$function = '$Html = new HtmlHelper();
			$Html->tags = $Html->loadConfig();
			$label = $matches[1];
			$label = empty($label) ? $matches[2] : $label;
			$_options = '.$_options.';
			$options = isset($matches[3]) ? array_merge($_options, array("target" => $matches[3])) : $_options;
			return $Html->link($label, $matches[2], $options);';
		$search_full_url = "/\\{$start}(?:([^{$end}]*?)\\{$delimiter})?((?:(?:https?|ftp):\/\/|\/)?[a-zA-Z0-9;\/?:@&=\+$,\-_\.!~*'\(\)%#]+?)(?:\\{$delimiter}([^{$start}]*?))?\\{$end}/";

		return preg_replace_callback($search_full_url, create_function('$matches', $function), $text);
	}

	public function mmdd_to_text($str) {
		if (strlen($str) !== 4) {
			return $this->invalid_string;
		}

		if (!preg_match("/^(0[1-9]|1[0-2])(0[1-9]|[12][0-9]|3[01])$/", $str)) {
			return $this->invalid_string;
		}

		$month = intval(substr($str, 0, 2));
		$day = intval(substr($str, -2));

		return ("{$month}月 {$day}日");
	}

	public function array_to_text($array = array(), $labels = array())
	{
		if (!is_array($array) || !is_array($labels)) {
			return $this->invalid_string;
		}
		return implode(', ', array_intersect_key($labels, array_flip($array)));
	}

	public function html_escape($text) {
		if (empty($text)) {
			return $this->invalid_string;
		}
		return h($text);
	}

}

?>
