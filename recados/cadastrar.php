```php
<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../index.php");
    exit;
}
?>

<form action="salvar.php" method="post">

    <textarea
        name="mensagem"
        placeholder="Escreva seu recado..."
        required
    ></textarea>

    <br>

    <button type="submit">Publicar recado</button>

</form>