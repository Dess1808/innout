<aside class="sidebar" >
    <!-- sidebar menu -->
    <nav class="menu mt3">
        <ul class="nav-list">
            <li class="nav-item">
                <a href="dayRecords.php">
                    <i class="icofont-ui-check mr-2"></i>
                    Registrar Ponto
                </a>
            </li>
            <li class="nav-item">
                <a href="monthlyReport.php">
                    <i class="icofont-ui-calendar mr-2"></i>
                    Registro Mensal
                </a>
            </li>
            <li class="nav-item">
                <a href="managerReport.php">
                    <i class="icofont-chart-histogram mr-2"></i>
                    Relatorio Gerencial
                </a>
            </li>
            <li class="nav-item">
                <a href=".php">
                    <i class="icofont-ui-user mr-2"></i>
                    Usuarios
                </a>
            </li>
            <li><a href="test.php">test page</a></li>
            <li><a href="dataGenerator.php">Data Generator</a></li>
        </ul>
    </nav>

    <!-- widgets hour -->
     <div class="sidebar-widgets">
        <div class="sidebar-widget">
            <i class="icon icofont-hour-glass text-primary"></i>
            <!--work Clock-->
            <div class="info">
                <span class="main text-primary" 
                <?= $activeClock === 'workedInterval' ? 'active-clock' : '' ?>>
                <?= $workedInterval ?>
                </span>
                <span class="label text-muted">
                    Horas trabalhadas
                </span>
            </div>
        </div>
        <div class="division my-3">
            <div class="sidebar-widget">
                <i class="icon icofont-ui-alarm text-danger"></i>
                <!--exit Clock-->
                <div class="info">
                    <span class="main text-danger"
                        <?= $activeClock === 'exitTime' ? 'active-clock' : '' ?>>
                        <?= $workedExit ?>
                    </span>
                    <span class="label text-muted">
                        Hora de saida
                    </span>
                </div>
            </div>
        </div>
     </div>
</aside>
