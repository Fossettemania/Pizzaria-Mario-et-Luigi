<!-- Cette page permettra à l'utilisateur de se déconnecter en détruisant la session. -->
<?php
session_start();
session_destroy();
header("Location: login.php");
exit;
