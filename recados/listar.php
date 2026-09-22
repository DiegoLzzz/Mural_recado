<?php

require_once __DIR__ . "/../conexao/conexao.php";

$sql = "
    SELECT 
        recados.id,
        recados.mensagem,
        recados.curtidas,
        recados.data_recado,
        recados.usuario_id,
        usuarios.nome
    FROM recados
    INNER JOIN usuarios
        ON recados.usuario_id = usuarios.id
    ORDER BY recados.data_recado DESC
";

$resultado = $conn->query($sql);

if ($resultado === false) {
    die("Erro ao listar recados: " . $conn->error);
}

while ($recado = $resultado->fetch_assoc()):

?>

<div class="recado">

    <h3>
        <?= htmlspecialchars($recado["nome"]) ?>
    </h3>

    <p>
        <?= nl2br(htmlspecialchars($recado["mensagem"])) ?>
    </p>

    <small>
        <?= htmlspecialchars($recado["data_recado"]) ?>
    </small>

    <p>
        ❤️ <?= $recado["curtidas"] ?> curtidas
    </p>

    <form action="recados/curtir.php" method="post">
        <input
            type="hidden"
            name="id"
            value="<?= $recado["id"] ?>"
        >

        <button type="submit">
            Curtir
        </button>
    </form>

    <?php if (isset($_SESSION["usuario_id"]) && $_SESSION["usuario_id"] == $recado["usuario_id"]): ?>

        <form action="recados/deletar.php" method="post">
            <input
                type="hidden"
                name="id"
                value="<?= $recado["id"] ?>"
            >

            <button type="submit">
                Excluir
            </button>
        </form>

    <?php endif; ?>

</div>

<hr>

<?php endwhile; ?>