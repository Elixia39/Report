<?php

namespace App\Admin\Controllers;

use App\Report;
use App\User;
use App\Folder;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;


class ReportController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Report';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Report());

        $grid->column('id', __('Id'));
        $grid->column('folder_id', __('User id'))->display(function ($folder_id) {
            return Folder::find($folder_id)->user_id;
        });
        $grid->column('report_date', __('日付'));
        $grid->column('temperature', __('体温'));
        $grid->column('am_condition', __('午前の体調'));
        $grid->column('pm_condition', __('午後の体調'));
        $grid->column('medicines', __('服薬状況'));
        $grid->column('condition_report', __('体調メモ'));
        $grid->column('curricilum1', __('カリキュラム1'));
        $grid->column('contant1', __('内容1'));
        $grid->column('curricilum2', __('カリキュラム2'));
        $grid->column('contant2', __('内容2'));
        $grid->column('impressions', __('感想'));
        $grid->column('interview', __('面談日時'));
        $grid->column('contact_information', __('連絡事項'));
        $grid->column('created_at', __('Created at'))->date('Y-m-d');
        $grid->column('updated_at', __('Updated at'))->date('Y-m-d');

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
        $show = new Show(Report::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('folder_id', __('Folder id'));
        $show->field('report_date', __('日付'));
        $show->field('temperature', __('体温'));
        $show->field('am_condition', __('午前の体調'))->using([
            '1' => 'とても良い',
            '2' => '良い',
            '3' => '普通',
            '4' => '悪い',
            '5' => 'とても悪い',
        ]);
        $show->field('pm_condition', __('午後の体調'))->using([
            '1' => 'とても良い',
            '2' => '良い',
            '3' => '普通',
            '4' => '悪い',
            '5' => 'とても悪い',
        ]);
        $show->field('medicines', __('服薬状況'));
        $show->field('condition_report', __('体調メモ'));
        $show->field('curricilum1', __('カリキュラム1'));
        $show->field('contant1', __('内容1'));
        $show->field('curricilum2', __('カリキュラム2'));
        $show->field('contant2', __('内容2'));
        $show->field('impressions', __('感想'));
        $show->field('interview', __('面談日時'));
        $show->field('contact_information', __('連絡事項'));
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
        $form = new Form(new Report());

        $form->number('folder_id', __('Folder id'));
        $form->date('report_date', __('Report date'))->default(date('Y-m-d'));
        $form->number('temperature', __('Temperature'));
        $form->number('am_condition', __('Am condition'));
        $form->number('pm_condition', __('Pm condition'));
        $form->text('medicines', __('Medicines'));
        $form->textarea('condition_report', __('Condition report'));
        $form->text('curricilum1', __('Curricilum1'));
        $form->text('contant1', __('Contant1'));
        $form->text('curricilum2', __('Curricilum2'));
        $form->text('contant2', __('Contant2'));
        $form->textarea('impressions', __('Impressions'));
        $form->datetime('interview', __('Interview'))->default(date('Y-m-d H:i:s'));
        $form->textarea('contact_information', __('Contact information'));

        return $form;
    }
}
