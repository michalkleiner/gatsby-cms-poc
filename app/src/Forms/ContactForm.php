<?php


namespace GatsbyTest\MyProject\Forms;


use GatsbyTest\MyProject\Models\FormSubmission;
use SilverStripe\Control\HTTPResponse;
use SilverStripe\Control\RequestHandler;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\Validator;

class ContactForm extends Form
{
    public function __construct(
        RequestHandler $controller = null,
        string $name = self::DEFAULT_NAME
    ) {
        $fields = FieldList::create(
            TextField::create('Name', 'Your name'),
            EmailField::create('Email', 'Your email'),
            TextareaField::create('Message')
        );
        $actions = FieldList::create(
            FormAction::create('doSubmit', 'Submit')
        );
        $validator = RequiredFields::create('Email');
        parent::__construct($controller, $name, $fields, $actions, $validator);
    }

    public function doSubmit($data, Form $form)
    {
        $form->saveInto($submission = FormSubmission::create($data));
        $submission->write();

        return new HTTPResponse('Submitted', 200);
    }
}
