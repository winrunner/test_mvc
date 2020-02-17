<?php

class View {	
	function generate($contentView, $pageTitle = 'Template view', $data = null, $templateView = 'template_view.php') {
		// 	extract($data);
        include 'app/views/'.$templateView;
	}
}

?>