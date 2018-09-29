<?php
//session_start() 
//sobre escribe las directivas de config de sesiones establecidas normalmente en php.ini (corazon de php realmente).
session_start([
    'cache_limiter' => 'private',
    'read_and_close' => true,
]);
?>