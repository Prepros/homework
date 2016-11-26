<?php
namespace app\core;

class MigrationsController extends Controller
{
    // Задаем параметры передаваемые в страницу по умолчанию
    protected $params = array(
        'title' => 'Домашняя работа №5',
        'desc' => 'Миграция таблиц:'
    );

    public function actionIndex()
    {
        $this->loadModel('CreateUsersTable');
        $this->model->up(); // создает таблицу в БД
//        $this->model->down(); //удаляет таблицу в БД

        $this->loadModel('CreateUploadsTable');
        $this->model->up(); // создает таблицу в БД
//        $this->model->down(); //удаляет таблицу в БД

        $this->set($this->params);
        $this->renderTwig('migrations.twig', $this->params);
    }

    public function actionDelete()
    {
        $this->loadModel('CreateUsersTable');
        $this->model->down(); //удаляет таблицу в БД

        $this->loadModel('CreateUploadsTable');
        $this->model->down(); //удаляет таблицу в БД

        $this->set($this->params);
        $this->renderTwig('migrations.twig', $this->params);
    }
}