<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<p class="country"></p>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
$.get("ajax-country", function(data, status){
    alert("Data: " + data + "\nStatus: " + status);
  });
});
</script>
</body>
</html>


