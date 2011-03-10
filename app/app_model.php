<?php

App::import('Lib', 'LazyModel.LazyModel');

class AppModel extends LazyModel {

	public $actsAs = array(
		'Containable',
		'AutoTransaction',
	);

}

