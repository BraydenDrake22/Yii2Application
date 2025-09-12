<?php
namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;

class HomeCest
{
    public function indexLoads(AcceptanceTester $I)
    {
        $I->amOnPage('/site/index');
        $I->seeResponseCodeIs(200);
        $I->see('Congratulations'); // change if your landing text differs
    }
}
