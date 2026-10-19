<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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

if ($resultado->num_rows === 0):
    echo '<div class="mensagem-vazia">Ainda não há recados publicados.</div>';
else:
    while ($recado = $resultado->fetch_assoc()):
        $usuarioLogado = $_SESSION["usuario_id"] ?? null;
        $ehDono = ($usuarioLogado !== null && (int) $usuarioLogado === (int) $recado["usuario_id"]);
?>

        <article class="recado-item">
            <div class="recado-header">
                <strong><?= htmlspecialchars($recado["nome"]) ?></strong>
                <span class="recado-data"><?= htmlspecialchars($recado["data_recado"]) ?></span>
            </div>

            <p class="recado-texto"><?= nl2br(htmlspecialchars($recado["mensagem"])) ?></p>

            <div class="recado-footer">
                <form action="recados/curtir.php" method="post" class="form-curtir">
                    <input type="hidden" name="id" value="<?= (int) $recado["id"] ?>">
                    <button type="submit" class="btn-curtir">♡ <?= (int) $recado["curtidas"] ?></button>
                </form>

                <?php if ($ehDono): ?>
                    <form action="recados/deletar.php" method="post" class="form-deletar">
                        <input type="hidden" name="id" value="<?= (int) $recado["id"] ?>">
                        <button type="submit" class="btn-excluir">Excluir</button>
                    </form>
                <?php endif; ?>
            </div>
        </article>

<?php
    endwhile;
endif;
?>