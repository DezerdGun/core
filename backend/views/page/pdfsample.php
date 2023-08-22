<?php
use yii\helpers\Html;
use kartik\mpdf\Pdf;

/**
 * @var common\models\page $model
 */
?>

<table border="0" width="50%">
    <tr>
        <td align="right">
<!--           --><?php //if($model->status==\app\models\Invoice::STATUS_PAID):?>
                <?= Html::img('@frontend/web/image/121.png',['width="212px"']);?>
<!--            --><?php //else:?>
<!--                --><?//= Html::img('@web/img/unpaid.jpg');?>
<!--            --><?php //endif;?>
        </td>
    </tr>
</table>

<table border="0" width="100%" cellpadding="5" cellspacing="5">
    <tr>
        <td align="right">
            Muzaffarov Mirsaid<br>
            Uzbekistan -  Tashkent
        </td>
    </tr>
</table>
<br><br>
<table width="100%" cellpadding="5" cellspacing="5">
    <tr>
        <td>
            <br><br>
            <table width="100%" cellpadding="5" cellspacing="0" border="1">
                <tr bgcolor="#eee">
                    <th align="center">Page</th>
                    <th align="center">Block</th>
                    <th align="center">Text</th>
                </tr>
                <?php foreach($model as $m):?>
                    <tr>
                        <td><?= $m->page;?></td>
                        <td><?= $m->block;?></td>
                        <td><?= $m->text;?></td>
                    </tr>
                <?php endforeach;?>
            </table>
        </td>
    </tr>
</table>

<br>

<h3>Load Modes{Example}</h3>
<table width="100%" cellpadding="5" cellspacing="0" border="1">
    <tr bgcolor="#eee">
        <th align="center">Transaction Date{Example}</th>
        <th align="center">Payment Method{Example}</th>
        <th align="center">Transaction ID{Example}</th>
        <th align="center">Amount{Example}</th>
    </tr>
<!--    --><?php //if($model->status=='UNPAID'):?>
        <tr>
            <td colspan="4" align="center">No Related Transactions Found{Example}</td>
        </tr>
<!--    --><?php //else:?>
        <tr>
        <tr bgcolor="#eee">
            <td colspan="3" align="right"><b>Balance{Example}</b></td>
            <td align="center"><b>$</b></td>
        </tr>

<!--    --><?php //endif;?>
</table>




