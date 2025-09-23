<?php

//loader Model 
function loadModel($modelName){
    require_once(MODEL_PATH . "/{$modelName}.php");
}

//loader View with trataments
function loadView($viewName, $params = array()){

    //tirando do array e colocando em variaveis!
    if (count($params) > 0){
        foreach($params as $key => $value){
            if (strlen($key) > 0){
                //variavel variavel
                ${$key} = $value;
            }
        }
    }

    //carregando view login com variaveis tratadas !
    require_once(VIEW_PATH . "/{$viewName}.php");
}

//loader View encapsuladas, carregar varias views para montar um pagina completa
function loadTemplateView($viewName, $params = array()){

    if (count($params) > 0){
        foreach($params as $key => $value){
            if (strlen($key) > 0){
                //variavel variavel
                ${$key} = $value;
            }
        }
    }
    
    require_once(TEMPLATE_PATH . "/header.php");
    require_once(TEMPLATE_PATH . "/leftMenu.php");
    require_once(VIEW_PATH . "/{$viewName}.php");
    require_once(TEMPLATE_PATH . "/footer.php");
}

// render titles
function renderTitle($title, $subtitle, $icon = null){
    require_once(TEMPLATE_PATH . "/title.php");
}