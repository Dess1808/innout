<?php
session_start();
requireValidSession();

loadTemplateView('save_users');
