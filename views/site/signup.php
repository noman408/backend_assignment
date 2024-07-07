<?php 
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$form = ActiveForm::begin(['id' => 'signup-form']); ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    </div>

<?php ActiveForm::end(); ?>

<?php
$this->registerJs("
    $('#signup-form').on('beforeSubmit', function (e) {
        var form = $(this);

        $.ajax({
            url: '" . yii\helpers\Url::to(['site/validate-email']) . "',
            method: 'POST',
            dataType: 'json',
            data: form.serialize(),
            success: function(response) {
                if(response.success === true)
                {
                    form.off('beforeSubmit');
                    form.submit();
                }else{
                    var errors = response.email;
                    var errorMessage = errors[0];
                    alert(errorMessage);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            }
        });

        return false;
    });
");
?>



