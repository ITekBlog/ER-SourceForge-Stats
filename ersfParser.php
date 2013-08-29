<?php
interface DataAdapter {
	function getData($url);
}

class SimpleXmlParser implements DataAdapter {

    public function getData($url) {
	$json = json_decode(file_get_contents($url));
	$str_HTML = "".$json->summaries->time->downloads;
	return $str_HTML;
    }
}
?>