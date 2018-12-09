<?php

return [

    /**
     * Middleware
     */
    'middleware' => ['web', 'admin'],

    /* Кол-во записей на страницу */
    'countPage' => 30,

    /**
     * List of models and observers
     * Sample instructions:
     *
     * App\Model::class => \App\Observers\ModelObserver::class
     */
    'observers' => [
      App\Models\Sections::class  => \Avl\Logger\Observers\SectionsObserver::class,
      App\Models\Pages::class     => \Avl\Logger\Observers\PagesObserver::class,
      App\Models\Links::class     => \Avl\Logger\Observers\LinksObserver::class,

      App\Models\Roles::class     => \Avl\Logger\Observers\RolesObserver::class,
      App\Models\User::class      => \Avl\Logger\Observers\UserObserver::class,
      App\Models\Langs::class     => \Avl\Logger\Observers\LangsObserver::class,
      App\Models\Templates::class => \Avl\Logger\Observers\TemplatesObserver::class,
      App\Models\Settings::class  => \Avl\Logger\Observers\SettingsObserver::class,
      App\Models\Rubrics::class   => \Avl\Logger\Observers\RubricsObserver::class,
    ],

    /**
     * Badge
     */
    'events' => [
      'creating' => '<span class="badge badge-success">creating</span>',
      'updating' => '<span class="badge badge-warning">updating</span>',
      'deleting' => '<span class="badge badge-danger">deleting</span>',
    ],

    'modelsNames' => [
      'App\Models\Sections' => 'Структура',

      'App\Models\Roles' => 'Роли',
      'App\Models\User' => 'Пользователи',
      'App\Models\Langs' => 'Настройка языков',
      'App\Models\Templates' => 'Настройка шаблонов',

      'App\Models\Settings' => 'Настройки сайта',
      'App\Models\Rubrics' => 'Настройка рубрик',
    ]

];
