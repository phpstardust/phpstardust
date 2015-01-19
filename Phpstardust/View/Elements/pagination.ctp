<?php

if ($this->Paginator->numbers()!=NULL) {

	$num = explode(' ',$this->Paginator->counter());
	echo __d('phpstardust', 'Page') .' ' .$num[0] .' ' .__d('phpstardust', $num[1]) .' ' .__d('phpstardust', $num[2]) .'<br><br>';
	echo $this->Paginator->first(__d('phpstardust', 'First'));
	echo ' ' .$this->Paginator->prev(__d('phpstardust', 'Prev'));
	echo ' ' .$this->Paginator->numbers(array('separator'=>' '));
	echo ' ' .$this->Paginator->next(__d('phpstardust', 'Next'));
	echo ' ' .$this->Paginator->last(__d('phpstardust', 'Last'));
	
}

?>