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
     
</main>

