'components' => [
    'urlManager' => [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'rules' => [
            'bugs' => 'bug-report/index',
            'bugs/create' => 'bug-report/create',
            'bugs/<id:\\d+>' => 'bug-report/view',
            'bugs/<id:\\d+>/update' => 'bug-report/update',
        ],
    ],
],