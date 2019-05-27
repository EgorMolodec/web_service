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
    
    /**
     * Action для страницы настроек
     */
    public function actionSettings()
    {
        // Проверка доступа
        if(!self::checkAdmin()) {
            header("Location: /cabinet/");
        }
        
        
                // Подключаем вид
        require_once(ROOT . '/views/admin/settings.php');
        return true;
    }
}