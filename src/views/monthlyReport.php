<main class="content">
    <?php 
        renderTitle(
            'Relatorio Mensal',
            'Acompanhe seu saldo de horas',
            'icofont-ui-calendar'
        );
    ?>

    <div>
        <form action="#" class="mb-4" method="POST">
            <select name="period" class="form-control" placeholder="select the period...">
                <?php
                    foreach($period as $key => $value){
                        echo "<option value='{$key}'>$value</option>";
                    }
                ?>
            </select>
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