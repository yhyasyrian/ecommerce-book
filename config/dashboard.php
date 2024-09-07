<?php

return [
    'prefix_route' => 'dashboard',
    'prefix_view' => 'dashboard',
    'route_sidebar' => [
        'الصفحة الرئيسية' => ['link'=>'home','icon'=>'fa-tachometer-alt'],
        'الكتب' => ['link'=>'books.index','icon'=>'fa-book'],
        'المؤلفون' => ['link'=>'authors.index','icon'=>'fa-users'],
        'الأقسام' => ['link'=>'categories.index','icon'=>'fa-tags'],
        'الناشرين' => ['link'=>'publishers.index','icon'=>'fa-tags'],
        'الأعضاء' => ['link'=>'users.index','icon'=>'fa-users'],
        'المشتريات' => ['link'=>'shoppings.index','icon'=>'fa-shopping-cart'],
    ],
];
