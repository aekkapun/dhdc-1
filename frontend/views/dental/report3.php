<?php
use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Dental', 'url' => ['dental/index']];
$this->params['breadcrumbs'][] = 'เด็กต่ำกว่า 3 ปี ที่จำเป็นต้องได้รับการทาFluolideได้รับบริการทาFluolide';
?>

<div class='well'>
    <form method="POST">
        ระหว่าง:
        <?php
        echo yii\jui\DatePicker::widget([
            'name' => 'date1',
            'value' => $date1,
            'language' => 'th',
            'dateFormat' => 'yyyy-MM-dd',
            'clientOptions' => [
                'changeMonth' => true,
                'changeYear' => true,
            ],
            
        ]);
        ?>
        ถึง:
        <?php
        echo yii\jui\DatePicker::widget([
            'name' => 'date2',
            'value' => $date2,
            'language' => 'th',
            'dateFormat' => 'yyyy-MM-dd',
            'clientOptions' => [
                'changeMonth' => true,
                'changeYear' => true,
            ]
        ]);
        ?>
        <button class='btn btn-danger'>ประมวลผล</button>
    </form>
</div>

<a href="#" id="btn_sql">ชุดคำสั่ง</a>
<div id="sql" style="display: none"><?= $sql ?></div>

    <?php
if (isset($dataProvider))
    $dev = \yii\helpers\Html::a('คุณสุพัฒนา ปิงเมือง', 'https://fb.com/kukks205', ['target' => '_blank']);
    
    
//echo yii\grid\GridView::widget([//
echo \kartik\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'responsive' => TRUE,
    'hover' => true,
    'floatHeader' => true,
    'panel' => [
        'before' => '',
        'type' => \kartik\grid\GridView::TYPE_SUCCESS,
        'after' => 'โดย ' . $dev
    ],
    
    'columns' => [
        [
            'attribute' => 'hoscode',
            'header' => 'รหัสหน่วยบริการ'
        ],
        [
            'attribute' => 'hosname',
            'header' => 'ชื่อหน่วยบริการ'
        ],
        [
            'attribute' => 'numA',
            'header' => 'เด็กต่ำกว่า 3 ปีที่จำเป็นต้องทาFluolide(คน)'
        ],
        [
            'attribute' => 'Fluolide',
            'header' => 'ได้รับการทาFluolide(คน)'
        ],
        [
            'class' => '\kartik\grid\FormulaColumn',
            'header' => 'ร้อยละ',
            'value' => function ($model, $key, $index, $widget) {
                $p = compact('model', 'key', 'index');
                // เขียนสูตร  dd
                if ($widget->col(2, $p) > 0) {
                    $persent = $widget->col(3, $p) / $widget->col(2, $p) * 100;
                    $persent = number_format($persent, 2);
                    return $persent;
                }
            }
        ]
    ]
]);
?>

<?php
$script = <<< JS
$(function(){
    $("label[title='Show all data']").hide();
});
        
$('#btn_sql').on('click', function(e) {
    
   $('#sql').toggle();
});
JS;
$this->registerJs($script);
?>



