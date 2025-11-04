<?php
namespace frontend\tests\Helper;

use Codeception\Module;
use yii\helpers\Url;

class Functional extends Module
{
    public function amOnRoute($route, array $params = []): void
    {
        $url = Url::toRoute($route, true);
        /** @var \Codeception\Module\Yii2 $yii2 */
        $yii2 = $this->getModule('Yii2');
        $yii2->amOnPage($url);
    }

    public function sendAjaxPostRequestToRoute($route, array $params = []): void
    {
        $url = Url::toRoute($route, true);
        /** @var \Codeception\Module\Yii2 $yii2 */
        $yii2 = $this->getModule('Yii2');

        if (method_exists($yii2, 'sendAjaxPostRequest')) {
            $yii2->sendAjaxPostRequest($url, $params);
            return;
        }
        $yii2->haveHttpHeader('X-Requested-With', 'XMLHttpRequest');
        $yii2->sendPost($url, $params);
    }
}
