<?php
require 'vendor/autoload.php';

$mail = new PHPMailer;

$mail->isMail();                                      // Авторизация через SMTP сервера для отправки почты

$mail->setFrom('erofaa@yandex.ru', 'Serg');         // От кого почта приходит
$mail->addAddress('erofaa@yandex.ru', 'Serg');     // Кому почта отправляется

$mail->Subject = 'Here is the subject';               // Тема письма
$mail->Body    = 'This is the HTML message body <b>in bold!</b>'; // Текст письма

// Отправка
if($mail->send()) {
    echo 'Сообщение успешно доставлено';
} else {
    echo 'Сообщение не отправлено! ' . $mail->ErrorInfo;
}