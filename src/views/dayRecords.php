
<main class="content">
    <!-- call function renderTitle -->
    <?php 
        renderTitle(
            'Registrar Ponto',
            'Mantenha seu ponto consistente!',
            'icofont-check-alt'
        );

        // add messages!!
    ?>

    <!-- card css bootstrap -->
    <div class="card">
        <div class="card-header">
            <h3><?=$today?></h3>
            <p class="mb-0">Os batimentos efeturados hoje</p>
        </div>
        <div class="card-body">
            <div class="d-flex m-2 justify-content-around">
                <span class="record-text">Entrada 1: ---</span>
                <span class="record-text">Saida 1: ---</span>
            </div>
            <div class="d-flex m-2 justify-content-around">
                <span class="record-text">Entrada 2: ---</span>
                <span class="record-text">Saida 2: ---</span>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-center">
            <a href="" class="btn btn-success btn-lg">
                <i class="icofont-check mr-1"></i>
                Bater ponto
            </a>
        </div>
    </div>
</main>