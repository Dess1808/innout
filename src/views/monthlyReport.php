<main class="content">
    <?php 
        renderTitle(
            'Relatorio Mensal',
            'Acompanhe seu saldo de horas',
            'icofont-ui-calendar'
        );
    ?>

    <div>
        <!-- Filters -->
        <form action="#" class="mb-4" method="POST">
             <div class="input-group">
                <!-- USERS -->
                <?php if ($user->is_admin) :?>
                    <select name="user" class="form-control mr-2" placeholder="select the user...">
                        <?php
                            foreach($users as $user){
                                $selected = $user->id === $selectedUserId ? 'selected' : '';
                                echo "<option value='{$user->id}' {$selected}>$user->name</option>";
                            }
                        ?>
                    </select>
                <?php endif?>
                <!-- PERIODS -->
                <select name="period" class="form-control" placeholder="select the period...">
                    <?php
                        foreach($period as $key => $value){
                            $selected = $key === $selectedPeriodPost ? 'selected' : '';
                            echo "<option value='{$key}' {$selected}>$value</option>";
                        }
                    ?>
                </select>
                <button class="btn btn-primary ml-2">
                    <i class="icofont-search"></i>
                </button>
             </div>
        </form>

        <table class="table table-bordered table-striped table-hover">
            <thead>
                <th>Dia</th>
                <th>Entrada 1</th>
                <th>Saída 1</th>
                <th>Entrada 2</th>
                <th>Saída 2</th>
                <th>Saldo</th>
            </thead>

            <tbody>
                <?php foreach($report as $registry):?>
                    <tr>
                        <td><?=dateFormettedWithLocal($registry->work_date, "eee, d 'de' MMM 'de' YYYY")?></td>
                        <td><?=$registry->time1?></td>
                        <td><?=$registry->time2?></td>
                        <td><?=$registry->time3?></td>
                        <td><?=$registry->time4?></td>
                        <td><?=$registry->getBalance()?></td> 
                    </tr>
                <?php endforeach;?>
                <tr class="bg-primary text-white">
                    <td>Horas Trabalhadas</td>
                    <td colspan="3"><?=$sumWorkedOfTime?></td>
                    <td>Saldo Mensal</td>
                    <td><?=$balance?></td>
                </tr>
            </tbody>
        </table>
    </div>
</main>