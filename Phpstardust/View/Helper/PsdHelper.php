<?php

App::uses('AppHelper', 'View/Helper');
App::uses('CakeTime', 'Utility');

class PsdHelper extends AppHelper {
	
	public $helpers = array('Html', 'Form', 'Session','Paginator','Time');
	
	
	
	
	public function getSitename() {
		
		return Configure::read('Psd.name');
		
	}
	
	
	
	
	public function getSiteurl() {
		
		return Configure::read('Psd.url');
		
	}
	
	
	
	
	public function getArticleUrl($row=NULL) {
		
		return Configure::read('Psd.url') .'/post/' .$row['Article']['slug'];
		
	}
	
	
	
	
	public function getArticleTitle($row=NULL) {
		
		return $row['Article']['title'];
		
	}
	
	
	
	
	public function getArticleCreated($row=NULL) {
		
		return $this->Time->format('Y/m/d H:i:s' , $row['Article']['created']);
		
	}
	
	
	
	
	public function getArticleImage($row=NULL, $class=NULL, $style=NULL) {
		
		$image = Configure::read('Psd.url') .'/files/uploads/' .$row['Article']['image'];
		
		if ($row['Article']['image']!="") return $this->Html->image($image, array('alt' => $this->getArticleTitle($row), 'title' => $this->getArticleTitle($row), 'class' => $class, 'style' => $style)); 
		else return(false);
		
	}
	
	
	
	
	public function getArticleText($row=NULL, $truncate=NULL) {
		
		if ($truncate===NULL) return $row['Article']['text'];
		else return substr($row['Article']['text'],0,$truncate) ."...";
		
	}
	
	
	
	
	public function getPageUrl($row=NULL) {
		
		return Configure::read('Psd.url') .'/' .$row['Page']['slug'];
		
	}
	
	
	
	
	public function getPageTitle($row=NULL) {
		
		return $row['Page']['title'];
		
	}
	
	
	
	
	public function getPageCreated($row=NULL) {
		
		return $this->Time->format('Y/m/d H:i:s' , $row['Page']['created']);
		
	}
	
	
	
	
	public function getPageImage($row=NULL, $class=NULL, $style=NULL) {
		
		$image = Configure::read('Psd.url') .'/files/uploads/' .$row['Page']['image'];
		
		if ($row['Page']['image']!="") return $this->Html->image($image, array('alt' => $this->getPageTitle($row), 'title' => $this->getPageTitle($row), 'class' => $class, 'style' => $style)); 
		else return(false);
		
	}
	
	
	
	
	public function getPageText($row=NULL) {
		
		return $row['Page']['text'];
		
	}
	
	
	
	
	public function loadCkEditor($field=NULL) {
		
		$Setting = ClassRegistry::init('Setting');
		
		$Setting->id = 1;
		$lang = $Setting->field('language');
		$lang = substr($lang, 0, 2);
		
		$html = "<script type='text/javascript'>";
		
		if ($this->request->is('mobile')) $html .= 'var isMobile=true;';
		else $html .= 'var isMobile=false;';
		
		$html .= 'if (!isMobile) {';
		$html .= "$(document).ready(function() {
		
			CKEDITOR.replace('" .$field ."', {
				height:'400px',
				language:'" .$lang ."',
				toolbar: [
				{ name: 'document', items: ['Source'] },
				{ name: 'document', items: ['Maximize'] },
				[ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ],
				[ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ],
				[ 'NumberedList','BulletedList','-','Blockquote'],
				[ 'Link','Unlink','Anchor'],
				{ name: 'insert', items : [ 'Image','Table','HorizontalRule','SpecialChar' ] },
				{ name: 'basicstyles', items: [ 'Bold','Italic','Strike' ] },
				{ name: 'colors', items : [ 'TextColor','BGColor' ] }
				]
			});
		
		});";
		$html .= '}';
		$html .= '</script>';
		
		return($html);
		
	}
	
	
	
}

?>