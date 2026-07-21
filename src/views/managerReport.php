<main class="content">
    <?php
        renderTitle(
            'Relatório Gerencial',
            'Resumo da horas trabalhadas dos funcionários',
            'icofont-chart-histogram'
        )
    ?>

    <div class="summary-boxes">
        <!-- ACTIVE USERS -->
        <div class="summary-box bg-primary">
            <i class="icofont-users"></i>
            <p class="title">Qtd de funcionários</p>
            <h3 class="value"><?=$activeUsers?></h3>
        </div>
        <!-- ABSENT USERS -->
        <div class="summary-box bg-danger">
            <i class="icofont-patient-bed"></i>
            <p class="title">Faltas</p>
            <h3 class="value"><?=count($absentUsers)?></h3>
        </div>
        <!-- HOURS IN MONTH -->
         <div class="summary-box bg-success">
            <i class="icofont-sand-clock"></i>
            <p class="title">Horas no mês</p>
            <h3 class="value"><?=$hoursInMonth?></h3>
        </div>
    </div>

    <!-- Card absent users -->
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="card-title">Faltosos do dia</h4>
            <div class="card-category">Relação de funcionários que não bateram o ponto</div>
        </div>
        <div class="card-body">
            <table class="table table-bodered table-striped table-hover">
                <thead>
                    <th>Nome</th>
                </thead>
                <tbody>
                    <?php foreach($absentUsers as $name):?>
                        <tr>
                            <td><?=$name?></td>
                        </tr>
                    <?php endforeach ?>    
                </tbody>
            </table>
        </div>
    </div>
</main> 

