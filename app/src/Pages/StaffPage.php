<?php


namespace GatsbyTest\MyProject\Pages;

use GatsbyTest\MyProject\Models\StaffMember;

use Page;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;

class StaffPage extends Page
{
    private static $db = [

    ];

    private static $has_many = [
        'StaffMembers' => StaffMember::class,
    ];

    private static $table_name = 'StaffPage';

    private static $singular_name = 'StaffPage';

    private static $plural_name = 'StaffPages';

    private static $owns = [
        'StaffMembers',
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Staff', GridField::create(
            'StaffMembers',
            'Staff members',
            $this->StaffMembers(),
            GridFieldConfig_RecordEditor::create()
        ));
        return $fields;
    }
}
