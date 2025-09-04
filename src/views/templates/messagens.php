<?php
    $errors = [];

    //variavel variavel vindo do tratamento do load, transforma qualquer array chave/valor em 
    //variavel!!!
    if (isset($exception)){
        $message = [
            'type' => 'error',
            'message' => $exception->getMessage()
        ];

        //type verification exceptions errors
        if (get_class($exception) === 'ValidationException'){
            $errors = $exception->getErrors();
        }
    }


    //alert type
    $alertType = '';

    if (isset($message)){
        if ($message['type'] === 'error'){
            $alertType = 'alert-danger';
        } else {
            $alertType = 'sucess';
        }
    }

?>

<?php if(isset($message)): ?>
    <div class="my-3 alert <?=$alertType?>" role="alert">
        <?=$message['message']?>
    </div>
<?php endif?>


