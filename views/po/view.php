<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Po */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Purchase List'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>

<div class="po-view">
    <div class="ibox-title text-right">
        <a href="<?= Url::toRoute(['/po/create']) ?>" class="btn btn-white"><i class="fa fa-pencil"></i> New Purchase </a>
        <a href="<?= Url::toRoute(['/po/print', 'id' => $model->id]) ?>" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print Invoice </a>
    </div>
    <div class="ibox-content p-xl">
        <div class="row">
            <div class="col-sm-6">
                <h5>From:</h5>
                <address>
                    <strong>Spring Water Falls, Inc.</strong><br>
                    Sepe Timpom, Opposite ..<br>
                    Kumasi, Ghana<br>
                    <abbr title="Phone">P:</abbr> (0244) 000-0000
                </address>
            </div>

            <div class="col-sm-6 text-right">
                <h4>Purchase No.</h4>
                <h4 class="text-navy"><?= $model->number ?></h4>
                <span>To:</span>
                <address>
                    <strong><?= $model->vendor->name ?></strong><br>
                    <?= $model->vendor->contact ?><br>
                    <?= $model->vendor->address ?><br>
                    <abbr title="Phone">P:</abbr> <?= $model->vendor->phone ?>
                </address>
                <p>
                    <span><strong>Purchase Date:</strong> <?= $model->date ?></span><br/>
                    <span><strong>Due Date:</strong> <?= $model->due_date ?></span>
                </p>
            </div>
        </div>

        <div class="table-responsive m-t">
            <div class="table-responsive m-t">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'layout' => '{items}{pager}',
                    'columns' => [
                        [
                            'label' => 'Item Name',
                            'value' => 'item_name'
                        ],
                        [
                            'label' => 'Quantity',
                            'value' => 'quantity'
                        ],
                        [
                            'label' => 'Unit Price',
                            'value' => 'unit_price'
                        ],
                        [
                            'label' => 'Total',
                            'value' => 'sub_total'
                        ],
                   ],
               ]); ?>
        </div><!-- /table-responsive -->

        <table class="table invoice-total">
            <tbody>
                <tr>
                    <td><strong>Total :</strong></td>
                    <td>GH₵<?= $model->total ?></td>
                </tr>
                <tr>
                    <td><strong>Paid :</strong></td>
                    <td>GH₵<?= $model->paid ?></td>
                </tr>
                <tr>
                    <td><strong>Balance :</strong></td>
                    <td>GH₵<?= $model->balance ?></td>
                </tr>
            </tbody>
        </table>
        <div class="well m-t"><strong>Comments</strong>
            Spring Water Falls. The water that gives life
        </div>
    </div>

</div>

