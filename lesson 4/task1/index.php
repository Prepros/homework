<?php
function xml_attribute($object, $attribute)
{
    if (isset($object[$attribute])) {
        return (string)$object[$attribute];
    }
}

$xml = simplexml_load_file('data.xml');

echo "<table align='center' border='1' cellpadding='10'>";
echo "<tr><td>Номер заказа на поставку: <strong> " .
    xml_attribute($xml, 'PurchaseOrderNumber') . "</strong></td>";
echo "<td>Дата заказа: <strong> " . xml_attribute($xml, 'OrderDate') . "</strong></td>";
echo "<tr><td align='center' colspan='2'>{$xml->DeliveryNotes}</td></tr>";

foreach ($xml->Address as $addres) {
        echo "<tr><td>Осуществлять доставку</td>";
        echo "<td>{$addres['Type']}</td></tr>";
        echo "<tr><td colspan='2'><table><tr>";
        echo "<td>Имя: <strong>$addres->Name</strong></td></tr>";
        echo "<tr><td>Адрес: <strong>$addres->Street</strong></td></tr>";
        echo "<tr><td>Город: <strong>$addres->City</strong></td></tr>";
        echo "<tr><td>Штат: <strong>$addres->State</strong></td></tr>";
        echo "<tr><td>Упаковка: <strong>$addres->Zip</strong></td></tr>";
        echo "<tr><td>Страна: <strong>$addres->Country</strong></td></tr>";
        echo "</tr>";
        echo "</table>";
        echo "</td>";
        echo "</tr>";
}

foreach ($xml->Items->Item as $item) {
    echo "<tr><td>Паспортный номер</td>";
    echo "<td>{$item['PartNumber']}</td></tr>";
    echo "<tr><td colspan='2'><table><tr>";
    echo "<td>Продукция: <strong>$item->ProductName</strong></td></tr>";
    echo "<tr><td>Количество: <strong>$item->Quantity</strong></td></tr>";
    echo "<tr><td>Цена: <strong>$item->USPrice</strong></td></tr>";
    echo "<tr><td>Комментарий: <strong>$item->Comment</strong></td></tr>";
    echo "<tr><td>Дата доставки: <strong>$item->ShipDate</strong></td></tr>";
    echo "</tr>";
    echo "</table>";
    echo "</td>";
    echo "</tr>";
}

echo "</table>";
