
<?php include('layouts/header.php'); ?>


<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <h1 class="text-center mb-4">
                Descubra seu signo
            </h1>

            <p class="text-center">
                Informe sua data de nascimento para descobrir seu signo!
            </p>

            <div class="text-center my-4">
                <img
                    src="/Project/assets/css/imgs/roda_zodiaco.png"
                    alt="Roda dos signos do zodíaco"
                    style="width: 450px; 
                    max-width: 100%; 
                    height: auto;">
            </div>

            <form id="signo-form" method="POST" action="show_zodiac_sign.php">

                <div class="mb-3">
                    <label for="data_nascimento" class="form-label">
                        Data de nascimento
                    </label>

                    <input
                        type="date"
                        class="form-control"
                        id="data_nascimento"
                        name="data_nascimento"
                        required>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Descobrir meu signo
                </button>

            </form>

        </div>
    </div>
</div>

</body>
</html>
