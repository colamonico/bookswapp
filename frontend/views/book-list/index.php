<?php
	use kartik\grid\GridView;
	use kartik\widgets\Select2;
    use yii\helpers\Html;

	$this->title = 'Book List';
    $this->params['breadcrumbs'][] = $this->title;
?>

<?=
	GridView::widget ([
		'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
        	
        	'book.title',
        	[
        		'attribute' => 'owned',
        		'value' => function ($model)
        		{
        			return $model->owned==0 ? 'False' : 'True';
        		},
        		'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'owned',
                    'data' => ['False', 'True'],
                    'options' => [
                        'placeholder' => ' ',
                        'multiple' => false,
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
        	],
        	[
        		'attribute' => 'to_buy',
        		'value' => function ($model)
        		{
        			return $model->to_buy==0 ? 'False' : 'True';
        		},
        		'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'to_buy',
                    'data' => ['False', 'True'],
                    'options' => [
                        'placeholder' => ' ',
                        'multiple' => false,
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
        	],
        	[
        		'attribute' => 'advised',
        		'value' => function ($model)
        		{
        			return $model->advised==0 ? 'False' : 'True';
        		},
        		'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'advised',
                    'data' => ['False', 'True'],
                    'options' => [
                        'placeholder' => ' ',
                        'multiple' => false,
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
        	],
        	'classroom.class',
        	'classroom.section_class',
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{favourite} {sell} {buy}',
                'buttons' => [
                    'favourite' => function ($url, $model)
                    {
                        return Html::a( '<span class="glyphicon glyphicon-star"></span>', $url, ['title' => 'Aggiungi ai preferiti']);
                    },

                    'buy' => function ($url, $model)
                    {
                        return Html::a( '<span class="glyphicon glyphicon-shopping-cart"></span>', $url, ['title' => 'Compra']);
                    },

                    'sell' => function ($url, $model)
                    {
                        return Html::a( '<span class="glyphicon glyphicon-usd"></span>', $url, ['title' => 'Vendi'] );
                    },                    
                ],
            ]
        ]
	]);
?>