<?php


namespace GatsbyTest\MyProject\Pages;


use GatsbyTest\MyProject\Models\FormSubmission;
use Page;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\TextField;

class ContactPage extends Page
{
    private static $db = [
        'SuccessMessage' => 'HTMLText',
        'SendEmailTo' => 'Varchar',
    ];

    private static $table_name = 'ContactPage';

    private static $singular_name = 'ContactPage';

    private static $plural_name = 'ContactPages';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldsToTab('Root.Form', [
            HTMLEditorField::create('SuccessMessage', 'Success message'),
            TextField::create('SendEmailTo', 'Send email to'),
            GridField::create('Submissions', 'Submissions', FormSubmission::get(), GridFieldConfig_RecordEditor::create())
        ]);
        return $fields;
    }
}
