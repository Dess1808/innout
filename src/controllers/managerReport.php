<?php
session_start();
requireValidSession();
$currentDate = new DateTime();

loadTemplateView('managerReport', []);
