<form action="<?=base_url?>especialidad/anadir" method="POST">
    <p>Nombre</p>
    <input type="text" name="nombreEsp">
    <?php  if(isset($_SESSION['errEsp'])) echo($_SESSION['errEsp']);?>
    <input type="submit">
</form>