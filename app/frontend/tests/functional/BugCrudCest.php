<?php
namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;
use frontend\tests\_support\Fixtures\BugReportFixture;

class BugCrudCest
{
    public function _fixtures()
    {
        return ['bug' => BugReportFixture::class];
    }

    public function indexListsBugs(FunctionalTester $I)
    {
        $I->amOnRoute('bug-report/index');
        $I->see('Bug Reports');
        $I->see('Cannot submit checkout'); 
    }

    public function createNewBug(FunctionalTester $I)
    {
        $I->amOnRoute('bug-report/create');
        $I->submitForm('form', [
            'BugReport[title]' => 'Login fails',
            'BugReport[description]' => 'Error 500 when logging in',
            'BugReport[severity]' => 'Critical',
            'BugReport[status]' => 'Open',
            'BugReport[category]' => 'Auth',
            'BugReport[environment]' => 'Ubuntu/Firefox',
            'BugReport[steps_to_reproduce]' => "1) Open /login\n2) Submit",
            'BugReport[reporter_name]' => 'QA Two',
            'BugReport[reporter_email]' => 'qa2@example.com',
            'BugReport[assignee]' => 'Dev B',
        ]);
        $I->seeResponseCodeIs(200);
        $I->see('Login fails');        
        $I->see('Critical');
        $I->see('qa2@example.com');
    }

    public function updateBug(FunctionalTester $I)
    {
        $I->amOnRoute('bug-report/update', ['id' => 1]);
        $I->submitForm('form', [
            'BugReport[status]' => 'In Progress',
            'BugReport[assignee]' => 'Dev Z',
        ]);
        $I->see('Bug updated');
        $I->see('In Progress');
        $I->see('Dev Z');
    }

    public function deleteBug(FunctionalTester $I)
    {
        $I->sendAjaxPostRequest(['bug-report/delete', 'id' => 1]);
        $I->seeResponseCodeIs(200); 
        $I->amOnRoute('bug-report/index');
        $I->dontSee('Cannot submit checkout');
    }
}
