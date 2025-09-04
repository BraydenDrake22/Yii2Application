<?php
/** @var \yii\web\View $this */
/** @var \common\models\User $user */
use yii\helpers\Html;

$this->title = 'My Profile';
?>
<h1><?= Html::encode($this->title) ?></h1>

<p><b>Username:</b> <?= Html::encode($user->username) ?></p>
<p><b>Email:</b> <?= Html::encode($user->email) ?></p>
<?php if ($user->first_name): ?><p><b>First name:</b> <?= Html::encode($user->first_name) ?></p><?php endif; ?>
<?php if ($user->last_name):  ?><p><b>Last name:</b> <?= Html::encode($user->last_name)  ?></p><?php endif; ?>
<?php if ($user->phone):      ?><p><b>Phone:</b> <?= Html::encode($user->phone) ?></p><?php endif; ?>

<p><?= Html::a('Edit profile', ['update'], ['class' => 'btn btn-primary']) ?></p>
