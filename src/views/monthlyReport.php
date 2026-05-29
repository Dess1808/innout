<main class="content">
    <?php 
        renderTitle(
            'Relatorio Mensal',
            'Acompanhe seu saldo de horas',
            'icofont-ui-calendar'
        );
    ?>

    <table>
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
                    <td><?=$registry->work_date?></td>
                    <td><?=$registry->time1?></td>
                    <td><?=$registry->time2?></td>
                    <td><?=$registry->time3?></td>
                    <td><?=$registry->time4?></td>
                    <td><?="saldo"?></td> 
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</main>