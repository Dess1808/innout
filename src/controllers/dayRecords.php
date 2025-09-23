<?php
// controller configs to dayRecords
session_start();
requireValidSession();
$dataFormated = currentTime((new DateTime())->getTimestamp());

// render view
loadTemplateView('dayRecords', ['today' => $dataFormated]);