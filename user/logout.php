<?php
session_start();
require 'functions.php';

session_unset();
session_destroy();
header("location:login.php");
