<?php


namespace GatsbyTest\MyProject\Models;


use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Permission;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TabSet;

class FormSubmission extends DataObject
{
    private static $db = [
        'Name' => 'Varchar',
        'Email' => 'Varchar',
        'Message' => 'Text',
    ];

    private static $summary_fields = [
        'Name' => 'Name',
        'Email' => 'Email',
    ];

    private static $table_name = 'FormSubmission';

    private static $singular_name = 'FormSubmission';

    private static $plural_name = 'FormSubmissions';

    private static $default_sort = 'ID ASC';

    public function canCreate($member = null, $context = [])
    {
        return Permission::checkMember($member, 'CMS_ACCESS_CMSMain');
    }

    public function canEdit($member = null, $context = [])
    {
        return Permission::checkMember($member, 'CMS_ACCESS_CMSMain');
    }

    public function canDelete($member = null, $context = [])
    {
        return Permission::checkMember($member, 'CMS_ACCESS_CMSMain');
    }

    public function canView($member = null, $context = [])
    {
        return true;
    }

}
