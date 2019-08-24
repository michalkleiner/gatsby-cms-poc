<?php

namespace GatsbyTest\MyProject\Models;

use GatsbyTest\MyProject\Pages\StaffPage;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Permission;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TabSet;
use SilverStripe\Versioned\Versioned;

class StaffMember extends DataObject
{
    private static $db = [
        'Name' => 'Varchar',
        'JobTitle' => 'Varchar',
    ];

    private static $has_one = [
        'Photo' => Image::class,
        'Parent' => StaffPage::class,
    ];

    private static $summary_fields = [
        'Name' => 'Name',
        'JobTitle' => 'Job title',
    ];

    private static $owns = [
        'Photo',
    ];

    private static $extensions = [
        Versioned::class,
    ];

    private static $table_name = 'StaffMember';

    private static $singular_name = 'StaffMember';

    private static $plural_name = 'StaffMembers';

    private static $default_sort = 'ID ASC';

    public function getCMSFields()
    {
        $fields = FieldList::create(TabSet::create('Root'));
        $fields->addFieldToTab('Root.Main', TextField::create('Name'));
        $fields->addFieldToTab('Root.Main', TextField::create('JobTitle', 'Job title'));
        $fields->addFieldToTab('Root.Main', UploadField::create('Photo')->setAllowedFileCategories('image'));
        $this->extend('updateCMSFields', $fields);

        return $fields;
    }

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
