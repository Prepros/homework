<form method="POST" enctype="multipart/form-data">
    <div class="box">
        <label>
            <h3>Логин: *</h3>
            <input type="text" name="login" placeholder="Введите логин" value="prepros" required>
        </label>
        <label>
            <h3>Пароль: *</h3>
            <input type="password" name="password" placeholder="Введите пароль" value="123456" required>
        </label>
        <label>
            <h3>Имя:</h3>
            <input type="text" name="name" placeholder="Введите имя" value="Сергей">
        </label>
        <label>
            <h3>Возраст:</h3>
            <input type="text" name="age" placeholder="Введите возраст" value="25">
        </label>
        <label>
            <h3>Описание о себе:</h3>
            <textarea name="about" rows="10" placeholder="Введите описание о себе">Некоторая инфа о мне</textarea>
        </label>
        <label>
            <h3>Фото:</h3>
            <input type="file" name="photo" placeholder="Загрузите свое фото">
        </label>
        <div class="g-recaptcha" data-sitekey="6LctwQwUAAAAANj6g6gwdodQRFVhc8SQsdbM5Esa"></div>
        <input type="submit" name="registration" value="Зарегистрироваться">
    </div>
</form>