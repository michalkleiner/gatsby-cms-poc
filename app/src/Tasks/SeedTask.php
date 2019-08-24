<?php


namespace GatsbyTest\MyProject\Tasks;


use GatsbyTest\MyProject\Models\FormSubmission;
use GatsbyTest\MyProject\Models\StaffMember;
use GatsbyTest\MyProject\Pages\ContactPage;
use GatsbyTest\MyProject\Pages\HomePage;
use GatsbyTest\MyProject\Pages\StaffPage;
use function GuzzleHttp\Psr7\stream_for;
use SilverStripe\Assets\Image;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Dev\BuildTask;
use Page;

class SeedTask extends BuildTask
{
    private static $segment = 'seed';

    public function run($request)
    {
        echo "Cleaning up site tree...\n";
        foreach (SiteTree::get() as $page) {
            $page->doArchive();
        }
        foreach (StaffMember::get() as $staff) {
            $staff->doArchive();
        }
        FormSubmission::get()->removeAll();

        echo "Done\n";
        echo "Creating pages\n";
        echo "Home...\n";
        $home = HomePage::create([
            'Title' => 'Home',
            'ValueStatement' => 'This is the home page for the Gatsby test',
        ]);
        $home->write();
        $home->publishRecursive();
        echo "About...\n";
        $about = Page::create(['Title' => 'About Us']);
        $about->write();
        $about->publishRecursive();
        echo "Staff...\n";
        $staff = StaffPage::create([
            'Title' => 'Our Staff',
        ]);
        $staff->write();
        $staff->publishRecursive();

        $max = 20;
        for ($i = 0; $i < 20; $i++) {
            echo "\t staff member.. ($i / $max) \n";
            $staffMember = StaffMember::create([
                'Name' => 'Staff Member #' . $i,
                'JobTitle' => 'Staff Member ' . $i . ' job title',
                'ParentID' => $staff->ID,
            ]);
            $photo = Image::create();
            $ch = curl_init('http://lorempixel.com/400/400/people/');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            $photo->setFromString($response, 'photo-' . $i . '.jpeg');
            $photo->write();
            $staffMember->PhotoID = $photo->ID;
            $staffMember->write();
            $staffMember->publishRecursive();
        }

        echo "Contact...\n";

        $contact = ContactPage::create([
            'Title' => 'Contact us',
            'SuccessMessage' => 'Thanks for contacting us',
            'SendEmailTo' => 'test@example.com',
        ]);
        $contact->write();
        $contact->publishRecursive();

        echo "done!\n";
    }
}
