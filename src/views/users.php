<main class="content">
    
    <?php 
        renderTitle(
            'Cadastro de Usuários',
            'Mantenha os dados dos usuários',
            'icofont-users'
        );

        include(TEMPLATE_PATH . "/messagens.php");
    ?>

    <!-- CADATRAR NOVO USUÁRIO -->
    <a href="save_users.php" class="btn btn-lg btn-primary mb-4">Novo Usuário</a>

    <table class="table table-striped table-hover">
        <thead>
            <th>Nome</th>
            <th>Email</th>
            <th>Data de admissão</th>
            <th>Date de demissão</th>
            <th>Ações</th>
        </thead>
        <tbody>
            <?php foreach(isset($users) ? $users : [] as $user): ?>
                <tr>
                    <td><?=$user->name?></td>
                    <td><?=$user->email?></td>
                    <td><?=$user->start_date?></td>
                    <td><?=$user->end_date?></td>
                    <td>
                        <a href="save_users?update=<?=$user->id?>" class="btn btn-warning rounded-circle mr-2">
                            <i class="icofont-edit"></i>
                        </a>
                        <!-- <a href="?delete=" class="btn btn-danger rounded-circle">
                            <i class="icofont-trash"></i>
                        </a> -->
                        <button 
                            class="button-delete btn btn-danger rounded-circle"
                            data-id="<?= $user->id ?>"
                            data-nome="<?= $user->name ?>">
                                <i class="icofont-trash"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <!-- Modal DELETE -->         
    <dialog class="modal-delete">
        <p>Deseja excluir <strong id="name-delete"></strong>?</p>
        <button class="button-confirm ">
            <a id="link-get" href="#">Confirmar</a>
        </button>
        <button class="button-cancel">Cancelar</button>
    </dialog>

   <script src="assets/js/buttonDelete.js"></script>
</main>