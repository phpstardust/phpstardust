<?php

if ($this->Paginator->numbers()!=NULL) {

	$num = explode(' ',$this->Paginator->counter());
	echo '<p class="numberOfPages">' .__d('phpstardust', 'Page') .' ' .$num[0] .' ' .__d('phpstardust', $num[1]) .' ' .__d('phpstardust', $num[2]) .'</p>';
	echo '<ul class="pagination">';
	echo '<li>' .$this->Paginator->first(__d('phpstardust', 'First')) .'</li>';
	echo '<li>' .$this->Paginator->prev(__d('phpstardust', 'Prev')) .'</li>';
	echo '<li>' .$this->Paginator->numbers(array('separator'=>' ')) .'</li>';
	echo '<li>' .$this->Paginator->next(__d('phpstardust', 'Next')) .'</li>';
	echo '<li>' .$this->Paginator->last(__d('phpstardust', 'Last')) .'</li>';
	echo '</ul>';
	
}

?>