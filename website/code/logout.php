<?php
session_start();
session_unset(); 
session_destroy();
echo "
<script>
    alert('Successfully Log Out');
    window.location.href = 'index.php';
</script>";
exit;
?>
