<?php

$userTest = User::getResultFromDataBaseOnly(['id' => 2]);
var_dump($userTest->getValues());
