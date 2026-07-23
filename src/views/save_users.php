<main class="content">
    <?php
        renderTitle(
            'Cadastro de Usuários',
            'Crie e atualize um usuários',
            'icofont-user'
        );

        include(TEMPLATE_PATH . "/messagens.php");
    ?>

    <form action="#" method="post">
        <!-- NAME AND EMAIL -->
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Nome</label>
                <input type="text" name="name" id="name"
                placeholder="Informe seu nome"
                value="<?= isset($user->name) ? $user->name : '' ?>"
                class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>">
                <div class="invalid-feedback">
                    <?= isset($errors['name']) ? $errors['name'] : '' ?>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" name="email" id="email"
                placeholder="Informe seu email"
                value="<?= isset($user->email) ? $user->email : '' ?>"
                class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>">
                <div class="invalid-feedback">
                    <?= isset($errors['email']) ? $errors['email'] : '' ?>
                </div>
            </div>
        </div>

        <!-- PASSWORD AND CONFIRM PASSWORD -->
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="password">Senha</label>
                <input type="password" name="password" id="password"
                value="<?= isset($user->password) ? $user->password : '' ?>"
                class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>">
                <div class="invalid-feedback">
                    <?= isset($errors['password']) ? $errors['password'] : '' ?>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="confirm_password">Confirme a senha</label>
                <input type="password" name="confirm_password" id="confirm_password"
                value="<?= isset($user->password) ? $user->password : '' ?>"
                class="form-control <?= isset($errors['confirm_password']) ? 'is-invalid' : '' ?>">
                <div class="invalid-feedback">
                    <?= isset($errors['confirm_password']) ? $errors['confirm_password'] : '' ?>
                </div>
            </div>
        </div>

        <!-- START_DATE AND END_DATE -->
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="start_date">Data de admissão</label>
                <input type="date" name="start_date" id="start_date"
                value="<?= isset($user->start_date) ? $user->start_date : '' ?>"
                class="form-control <?= isset($errors['start_date']) ? 'is-invalid' : '' ?>">
                <div class="invalid-feedback">
                    <?= isset($errors['start_date']) ? $errors['start_date'] : '' ?>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="end_date">Data do desligamento</label>
                <input type="date" name="end_date" id="end_date"
                value="<?= isset($user->end_date) ? $user->end_date : '' ?>"
                class="form-control <?= isset($errors['end_date']) ? 'is-invalid' : '' ?>">
                <div class="invalid-feedback">
                    <?= isset($errors['end_date']) ? $errors['end_date'] : '' ?>
                </div>
            </div>
        </div>

        <!-- checkbox is_admin -->
        <div class="form-row">
            <div class="form-group col-md-1">
                <label for="is_admin">Administrador?</label>
                <input type="checkbox" name="is_admin" id="is_admin"
                class="<?= isset($errors['is_admin']) ? 'is-invalid' : '' ?>"
                <?= isset($is_admin) ? 'checked' : '' ?> >
                <div class="invalid-feedeback">
                    <?= isset($errors['is_admin']) ? $errors['is_admin'] : '' ?>
                </div>
            </div>
        </div>

        <!-- SUBMIT OR CANCEL -->
        <div>
            <button class="btn btn-primary btn-lg">Salvar</button>
            <a href="/users.php" class="btn btn-secondary btn-lg">Cancelar</a>
        </div> 
    </form>    
</main>