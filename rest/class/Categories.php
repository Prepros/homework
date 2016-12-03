<?php
class Categories
{
    public function index()
    {
        // GET /products
        $data = Category::all();

        $result = $this->dataChecking($data);
        echo $result;
    }

    public function show($id)
    {
        // GET /products/1
        // Вытаскиваем все данные из таблицы products где id = $id
        $data = Category::find($id);

        // Проверяем были ли найдены данные
        $result = $this->dataChecking($data);
        echo $result;
    }

    public function edit($id)
    {
        // PUT /products/1
    }

    public function store()
    {
        // POST /products
    }

    public function destroy($id)
    {
        // DELETE /products/1
    }

    // Проверяем были ли найдены данные
    protected function dataChecking($data)
    {
        if (!empty($data)) {
            http_response_code(200);
            return json_encode($data);
        } else {
            http_response_code(404);
            return json_encode(['error' => 'not found']);
        }
    }
}