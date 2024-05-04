<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="includes/style.css">
<link href="images/favicon.ico" rel="shortcut icon" type="image/ico" />
<script type="text/javascript">
	
	function Change_title(){
			if (text.length < start) {
				start = 0;
			}
			document.title = text.substr(start, text.length) + text.substr(0, start);
			start ++;
		}
		var start = 0;

	text = "Location d'appartement";
</script>