<?php
/**
 * Контроллер AdminController
 * Главная страница для преподавателя
 */
class AdminController extends AdminBase
{
    /**
     * Action для стартовой страницы
     */
    public function actionIndex()
    {
        // Проверка доступа
        if(!self::checkAdmin()) {
            header("Location: /cabinet/");
        }

        $coursesList = Course::getCoursesList();
        
        // Подключаем вид
        require_once(ROOT . '/views/admin/index.php');
        return true;
    }
}