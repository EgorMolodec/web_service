<?php

return array(
            
//    Управление курсами
    
    'course/([0-9]+)' => 'course/view/$1',
    'course/view/([0-9]+)' => 'course/view/$1',
    'course/create' => 'course/create',
    'course/update/([0-9]+)' => 'course/update/$1',
    'course/delete/([0-9]+)' => 'course/delete/$1',
    
//      Управление заданиями
    
    'task/([0-9]+)' => 'task/view/$1',
    'task/view/([0-9]+)' => 'task/view/$1',
    'task/create' => 'task/create',
    'task/update/([0-9]+)' => 'task/update/$1',
    'task/delete/([0-9]+)' => 'task/delete/$1',
    'task/create/([0-9]+)' => 'task/create/$1',
    
    '/course/view/([0-9]+)/task/create' => 'task/create/$1',

//      Управление отчётами
    
    'report/course' => 'report/course',
    'report/course/([0-9]+)' => 'report/course/$1',
    'report/task' => 'report/task',
    'report/task/([0-9]+)' => 'report/task/$1',
    'report/student' => 'report/student',
    'report/student/([0-9]+)' => 'report/student/$1',
    'report/student/([0-9]+)/([0-9]+)' => 'report/student/$1/$2',
    'report/student/([0-9]+)/([0-9]+)/([0-9]+)' => 'report/student/$1/$2/$3',
    
//      
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    
//    Страница студента
    
    'cabinet/edit' => 'cabinet/edit',
    'cabinet' => 'cabinet/index',
    
//    Главная страница преподавателя
    
    'admin' => 'admin/index',
    'admin/settings' => 'admin/settings',

    'index' => 'user/login',
    '' => 'user/login',
);