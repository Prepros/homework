<?php
class Products
{
    // Показываем все продукты
    public function index()
    {
        // GET /products
        $data = Product::all();

        $result = $this->dataChecking($data);
        echo $result;
//        echo $result;
    }

    // Показываем продукт по id
    public function show($id)
    {
        // GET /products/1
        // Вытаскиваем все данные из таблицы products где id = $id
        $data = Product::find($id);

        // Проверяем были ли найдены данные
        $result = $this->dataChecking($data);
        echo $result;
    }

    public function edit($data)
    {
        // PUT /products/1
        // Изменяет продукт с id = $id
        $data = urldecode($data);
        parse_str($data, $data);
        $result = $this->dataChecking($data);
        echo "Запись изменена <br>";
        echo $result;

        $product = Product::find($data['id']);
        if (!empty($product)) {
            $product->name = $data['name'];
            $product->about = $data['about'];
            $product->price = $data['price'];
            $product->category_id = $data['category_id'];
            $product->save();
        }
        exit;
    }

    // Добавляем новый продукт
    public function store()
    {
        // POST /products
        // Парсим строку в массив (name=tjtj&about=rtjrtj&price=45&category_id=3)
        parse_str($_REQUEST['form_data'], $form_data);
        $result = $this->dataChecking($form_data);
        echo "Добавлена новая запись <br>";
        echo $result;

        // Добавляем в БД
        $product = new Product();
        $product->name = $form_data['name'];
        $product->about = $form_data['about'];
        $product->price = $form_data['price'];
        $product->category_id = $form_data['category_id'];
        $product->save();
        exit;
    }

    public function destroy($data)
    {
        // DELETE /products/1
        $data = urldecode($data);
        parse_str($data, $data);
        $result = $this->dataChecking($data);
        echo "Запись удалена <br>";
        echo $result;

        $product = Product::find($data['id']);
        if (!empty($product)) {
            $product->delete();
        }
        exit;
    }

    // Проверяем были ли найдены данные
    protected function dataChecking($data, $code = 200)
    {
        $status = array(
            200 => '200 OK',
            400 => '400 Bad Request',
            422 => 'Unprocessable Entity',
            500 => '500 Internal Server Error'
        );
        if (!empty($data)) {
            header_remove();
            http_response_code($code);
//            header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
//            header('Content-Type: application/json');
            header('Status: '.$status[$code]);
            $result = json_encode(array(
                'status' => $code,
                'data' => $data
            ));
        } else {
            header_remove();
            http_response_code(400);
            header('Status: '.$status['400']);
            $result = json_encode(array(
                'status' => 400,
                'data' => array('error' => 'not found')
            ));
        }
        return html_entity_decode(str_replace('\u','&#x',$result), ENT_NOQUOTES,'UTF-8');
    }
}