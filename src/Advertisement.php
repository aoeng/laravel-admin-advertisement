<?php


namespace Aoeng\Laravel\Admin\Advertisement;


use Encore\Admin\Extension;

class Advertisement extends Extension
{
    public $name = 'advertisement';


    public function __construct()
    {
        self::routes(__DIR__ . '/../routes/admin.php');
    }

    /**
     * {@inheritdoc}
     */
    public static function import()
    {
        parent::import();

        parent::createMenu('广告管理', '/', 'fa-buysellads', 0, [
            ['title' => '广告分类', 'path' => 'advertisement-types', 'icon' => 'fa-bookmark'],
            ['title' => '广告列表', 'path' => 'advertisements', 'icon' => 'fa-align-justify'],
        ]);
    }
}
