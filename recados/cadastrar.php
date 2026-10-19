<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../index.php");
    exit;
}

?>

<form action="recados/salvar.php" method="POST" class="form-recado">
    <textarea
        name="mensagem"
        id="mensagem"
        rows="3"
        placeholder="Deixe seu recado..."
        required
    ></textarea>

    <div class="composer-actions">
        <button type="submit" class="btn-publicar">
            Publicar
        </button>
    </div>
</form>