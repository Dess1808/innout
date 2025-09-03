<?php
    //variavel variavel vindo do tratamento do load, transforma qualquer array chave/valor em 
    //variavel!!!
    if (isset($exception)){
        $message = [
            'type' => 'error',
            'message' => $exception->getMessage()
        ];
    }
?>

<?php if(isset($message)): ?>
    <div class="my-3 alert alert-danger" role="alert">
        <?=$message['message']?>
    </div>
<?php endif?>

