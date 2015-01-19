<?php

$this->set('channelData', array(
	'title' => __("Feed RSS - " .$title),
	'link' => $this->Html->url('/', true),
	'description' => __("Feed RSS - " .$title),
	'language' => 'en-us'
));

foreach ($articles as $article) {
	
	$postTime = strtotime($article['Article']['created']);
	$postLink = array(
		'controller' => 'articles',
		'action' => 'single',
		'year' => date('Y', $postTime),
		'month' => date('m', $postTime),
		'day' => date('d', $postTime),
		$article['Article']['slug']
	);
	
	$postLink = Configure::read('Psd.url') .'/post/' .$article['Article']['slug'];
	
	$bodyText = h(strip_tags($article['Article']['text']));
	
	$bodyText = $this->Text->truncate($bodyText, 2000, array(
		'ending' => '...',
		'exact' => true,
		'html' => true,
	));
	
	echo $this->Rss->item(array(), array(
		'title' => $article['Article']['title'],
		'link' => $postLink,
		'guid' => array('url' => $postLink, 'isPermaLink' => 'true'),
		'description' => $bodyText,
		'pubDate' => $article['Article']['created']
	));

}

?>