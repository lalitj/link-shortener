<?php

namespace app\models;

class Urls extends \lithium\data\Model {
	
	//Ref : http://blog.marcghorayeb.com/post/13013812393/mongodb-schema-definitions-in-li3
	protected $_schema = array(
		'_id' => array('type' => 'id'),
		'url' => array('type' => 'string'),
		'hash' => array('type' => 'string'),
		'shortlink' => array('type' => 'string'),
		'date' => array('type' => 'timestamp'), 
		'views' => array('type' => 'integer')
	);
	
	 public $validates = array(
        'url' => array(
            array(
                'notEmpty',
                'required' => true,
                'message' => 'Please supply a url.'
            ),
			array(
                'unique',
                'message' => 'This URL Already Added'
            ),
			array(
                'url',
                'message' => 'Enter a valid URL'
            )
        )
    );
}

?>