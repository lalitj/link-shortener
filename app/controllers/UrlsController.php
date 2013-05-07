<?php

namespace app\controllers;

use app\models\Urls;
use lithium\action\DispatchException;
use lithium\security\Password;

class UrlsController extends \lithium\action\Controller {

	protected function _init() {
		parent::_init();
		$this->applyFilter('__invoke', function($self, $params, $chain){
			if($this->request->shortcode){
			$options['conditions'] = array('shortlink' => $this->request->shortcode);
			$url = Urls::first($options);
			
			if (!$url) {
				throw new DispatchException();
			}
			//die();
			$this->url = (array) $url;
			$self->set(compact('url'));
			}
			return $chain->next($self, $params, $chain);
		});
	}
	
	
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
		$new_shortlink = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 5);
		$this->request->data['shortlink'] = $new_shortlink;
			if($url->save($this->request->data)) {
				//return $this->redirect(array('Urls::view', 'args' => array($url->id)));
				$shortlink = $new_shortlink;
			} else { 
				 $errors = $url->errors();
				 if(isset($errors['url'])){
					$error = "Errors:".implode(', ',$errors['url']);
				 }
			}
		}
		return compact('url','error','shortlink');
	}

	public function edit() {
		
		//$url = $this->url;
		//print_r($url);
		//echo "<pre>";
		//$data = ['shortlink' => $this->request->shortcode];
		//$url = Urls::create($data);
		//print_r($url);
		$error = "";
		//$options['conditions'] = array('shortlink' => $this->request->shortcode);
		//$url = Urls::create(array('shortlink' => $this->request->shortcode), $options);
		$url_d = Urls::create($this->url);
		
		if (($this->request->data) && $url_d->save($this->request->data)) {
			//return $this->redirect(array('Urls::view', 'args' => array($url->id)));
		}
		
		//print_r($url);
		//$success = $post->save();
		//die();
		//return Discussions::create($data, $options);
			//$data += ['shortlink' => $url->_id];
		//$urls = $this->Urls->create_url(array("shortlink" => $this->request->shortcode));
		//print_r($urls);
		//$this->request->shortcode
		/*$options['conditions'] = array('shortlink' => $this->request->shortcode);
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
		} * 
		 */
		return compact("url_d",'url',"error");
		
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
	
	private function url_data() {
		return array_intersect_key($this->request->data, array_flip(['subject', 'content']));
	}
	
}

?>