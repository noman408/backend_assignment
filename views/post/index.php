<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Like; // Ensure this line is included

/** @var yii\web\View $this */
/** @var app\models\Post[] $posts */

$this->title = 'My Blog Posts';
?>

<div class="site-index">
    <div class="row">
        <div class="col-md-12 text-right mb-3">
            <?= Html::a('Create Post', ['post/create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php if (!empty($posts)): ?>
        <div class="row">
            <?php foreach ($posts as $post): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><?= Html::encode($post->title) ?></h5>
                            <p class="card-text"><?= Html::encode($post->description) ?></p>
                            <div class="text-right">
                                <?= Html::a('Edit', ['post/update', 'id' => $post->id], ['class' => 'btn btn-primary']) ?>
                                <?php if (Like::isLiked(Yii::$app->user->id, $post->id)): ?>
                                    <?= Html::a('Unlike', '#', [
                                        'class' => 'btn btn-danger unlike-btn',
                                        'data-id' => $post->id,
                                    ]) ?>
                                <?php else: ?>
                                    <?= Html::a('Like', '#', [
                                        'class' => 'btn btn-success like-btn',
                                        'data-id' => $post->id,
                                    ]) ?>
                                <?php endif; ?>
                                <span id="likes-count-<?= $post->id ?>"><?= $post->getLikesCount() ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No posts found.</p>
    <?php endif; ?>
</div>

<?php
$this->registerJs("
    $('.like-btn').on('click', function(e) {
        e.preventDefault();
        var postId = $(this).data('id');
        var url = '" . \yii\helpers\Url::to(['post/like']) . "' + '&id=' + postId;
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    location.reload();
                    $('#likes-count-' + postId).text(response.likesCount);
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            }
        });
    });

    $('.unlike-btn').on('click', function(e) {
        e.preventDefault();
        var postId = $(this).data('id');
        var url = '" . \yii\helpers\Url::to(['post/unlike']) . "' + '&id=' + postId;
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    location.reload();
                    $('#likes-count-' + postId).text(response.likesCount);
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert('An error occurred.');
            }
        });
    });
");
?>
