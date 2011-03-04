<?php
class News extends AppModel {

	var $name = 'News';
	var $validate = array(
		'title' => array('notempty'),
		'start_at' => array('date'),
		'finish_at' => array('date')
	);

}
?>