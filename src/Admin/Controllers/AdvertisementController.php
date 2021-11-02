<?php

namespace Aoeng\Laravel\Admin\Advertisement\Admin\Controllers;

use Aoeng\Laravel\Admin\Advertisement\Models\Advertisement;
use Aoeng\Laravel\Admin\Advertisement\Models\AdvertisementType;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AdvertisementController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '广告图片管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Advertisement());

        $grid->column('id', __('Id'));
        $grid->column('type', __('Type'))->using(Advertisement::$typeMap)->label([2 => 'warning']);
        $grid->column('types')->display(function ($types) {
            $types = array_map(function ($type) {
                return "<span class='label label-success'>{$type['name']}</span>";
            }, $types);

            return join('&nbsp;', $types);
        });
        $grid->column('title', __('Title'))->filter('like');
        $grid->picture('picture', __('Picture'))->lightbox();
        $grid->column('path', __('Path'));
        $grid->column('sort', __('Sort'))->sortable()->editable();
        $grid->column('is_display', __('Is display'))->switch();
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableView();
        });

        $grid->filter(function (Grid\Filter $filter) {
            $filter->disableIdFilter();
            $filter->where(function ($query) {
                $query->whereHas('types', function ($query) {
                    $query->whereIn('flag', $this->input);
                });
            }, '类型', 'flag')->multipleSelect(AdvertisementType::query()->pluck('name', 'flag'));
            $filter->equal('is_display', __('Is display'))->radio([0 => '隐藏', 1 => '显示',]);
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Advertisement::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('type', __('Type'));
        $show->field('title', __('Title'));
        $show->field('picture', __('Picture'));
        $show->field('path', __('Path'));
        $show->field('sort', __('Sort'));
        $show->field('is_display', __('Is display'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Advertisement());

        $form->radio('type', __('Jump type'))->options(Advertisement::$typeMap)->default(1)->required();
        $form->multipleSelect('types', __('Types'))->options(AdvertisementType::query()->pluck('name', 'id'))->required();
        $form->text('title', __('Title'))->required();
        $form->image('picture', __('Picture'))->required();
        $form->text('path', __('Path'));
        $form->number('sort', __('Sort'))->default(0);
        $form->switch('is_display', __('Is display'))->default(1);

        return $form;
    }
}
