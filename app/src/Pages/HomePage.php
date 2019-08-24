<?php


namespace GatsbyTest\MyProject\Pages;


use Page;
use SilverStripe\Forms\TextField;

class HomePage extends Page
{
    private static $db = [
        'ValueStatement' => 'Text',
    ];

    private static $table_name = 'HomePage';

    private static $singular_name = 'HomePage';

    private static $plural_name = 'HomePages';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldsToTab('Root.Main', [
            TextField::create('ValueStatement', 'Value statement')
        ], 'Content');
        return $fields;
    }
}
