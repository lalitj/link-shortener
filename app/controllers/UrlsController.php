<?php

namespace app\controllers;

use app\models\Urls;
use lithium\action\DispatchException;
use lithium\security\Password;

class UrlsController extends \lithium\action\Controller {

	public function index() {
		$urls = Urls::all();
		//$this->processData($urls);
		return compact('urls');
	}

	public function view() {
		$url = Urls::first($this->request->id);
		return compact('url');
	}

	public function add() {
		
		$url = Urls::create();
		$error = "";
		if ($this->request->data) {
		
		$data = $this->request->data;
		$this->request->data['hash'] = Password::hash($data['url']);
		$this->request->data['shortlink'] = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 5);
			if($url->save($this->request->data)) {
				//return $this->redirect(array('Urls::view', 'args' => array($url->id)));
			} else { 
				 $errors = $url->errors();
				 if(isset($errors['url'])){
					$error = "Errors:".implode(', ',$errors['url']);
				 }
			}
		}
		return compact('url','error');
	}

	public function edit() {
		//$this->request->shortcode
		$options['conditions'] = array('shortlink' => $this->request->shortcode);
		$url = Urls::find('all',$options);
		$url_link = Urls::create();
		//echo "<pre>";
		//print_r($url);
		//die();
		//print_r($url);
		//die();
		$error = "";
		if (!$url) {
			return $this->redirect('Urls::index');
		}
		if (($this->request->data) && $url->save($this->request->data)) {
			return $this->redirect(array('Urls::view', 'args' => array($url->id)));
		}
		return compact("url_link",'url',"error");
	}

	public function delete() {
		/*if (!$this->request->is('post') && !$this->request->is('delete')) {
			$msg = "Urls::delete can only be called with http:post or http:delete.";
			throw new DispatchException($msg);
		}*/
		$options['conditions'] = array('shortlink' => $this->request->shortcode);
		Urls::find('all',$options)->delete();
		return $this->redirect('Urls::index');
	}
	
	public function admin() {
	}
}

?>