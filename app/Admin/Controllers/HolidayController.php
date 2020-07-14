<?php

namespace App\Admin\Controllers;

use App\Holiday;
use App\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class HolidayController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Holiday';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Holiday());

        $grid->column('id', __('Id'));
        $grid->column('day', __('Day'));
        $grid->column('description', __('Description'));
        $grid->column('created_at', __('Created at'))->date('Y-m-d');
        $grid->column('updated_at', __('Updated at'))->date('Y-m-d');
        $grid->column('user_id', __('User name'))->display(function ($user_id) {
            return User::find($user_id)->name;
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
        $show = new Show(Holiday::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('day', __('Day'));
        $show->field('description', __('Description'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('user_id', __('User id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Holiday());

        $form->date('day', __('Day'))->default(date('Y-m-d'));
        $form->text('description', __('Description'));
        $form->number('user_id', __('User id'));

        return $form;
    }
}
