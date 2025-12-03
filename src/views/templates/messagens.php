<?php
    //variavel variavel vindo do tratamento do load, transforma qualquer array chave/valor em 
    //variavel!!!

    $errors = [];

    //success or erro clock in, clock out
    if (isset($_SESSION['message'])){
        $message = $_SESSION['message'];
        unset($_SESSION['message']);

        //demais exceptions!!!!
    } elseif (isset($exception)){
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
            $alertType = 'alert-success';
        }
    }

?>

<!-- show in screen -->
<?php if(isset($message)): ?>
    <div class="my-3 alert <?=$alertType?>" role="alert">
        <?=$message['message']?>
    </div>
<?php endif?>
