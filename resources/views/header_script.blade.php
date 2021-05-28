<script type="text/javascript">
        $(document).ready(function() { 
        	$('#my_header').load('<?php echo url("/my_header"); ?>');            
            setInterval(function () {                
                $('#my_header').load('<?php echo url("/my_header"); ?>');
            }, 5000);
        });
    </script>