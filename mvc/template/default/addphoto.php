<form method="POST" enctype="multipart/form-data">
    <div class="box">
        <label>
            <h3>Добавить фото:</h3>
            <input type="file" name="photo[]" placeholder="Загрузите фото" multiple="true">
        </label>
        <input type="submit" name="addphoto" value="Добавить фото">
    </div>
</form>
<br>
<a href="<?=$web;?>profile/photos">Просмотреть все загруженные файлы</a>