<div class="accordion accordion-flush" id="accordionFlushExample">
    <?php session_start(); ?>
    <?php foreach ($_POST['totales'] as $mes => $totales) : ?>
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $mes ?>" aria-expanded="false" aria-controls="collapse<?= $mes ?>">
                    <?= $mes ?>
                </button>
            </h2>
            <div id="collapse<?= $mes ?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th>USUARIO</th>
                            <th>GESTIONES</th>
                            <th>PROMESAS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($totales as $usuario => $total) : ?>
                            <?php if ($_SESSION['nombreCartera'] !== $usuario) : ?>
                                <tr>
                                    <td><?= $usuario; ?></td>
                                    <td><?= $total['TOTAL']; ?></td>
                                    <td><?= $total['EXITOSO']; ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endforeach; ?>
</div>