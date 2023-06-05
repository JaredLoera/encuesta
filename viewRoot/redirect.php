<?php
session_start();
header('Location: ' . $_SESSION['previous_page']);
?>
