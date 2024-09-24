<?php

namespace App\Outputs;

use App\Outputs\ProfileFormatter;

class TextFormat implements ProfileFormatter
{
    private $response;

    public function setData($profile)
    {
        $output = "Full Name: " . $profile->getFullName() . PHP_EOL;
        $output .= "Email: " . $profile->getContactDetails()['email'] . PHP_EOL;
        $output .= "Phone: " . $profile->getContactDetails()['phone_number'] . PHP_EOL;
        $output .= "Address: " . implode(", ", $profile->getContactDetails()['address']) . PHP_EOL;
        $output .= "Education: " . $profile->getEducation()['degree'] . " at " . $profile->getEducation()['university'] . PHP_EOL;
        $output .= "Skills: " . implode(", ", $profile->getSkills()) . PHP_EOL;
        

        // Add experience, certifications, etc.
        $output .= "Experience:\n";
        foreach ($profile->getExperience() as $job) {
            $output .= "- " . $job['job_title'] . " at " . $job['company'] . " (" . $job['start_date'] . " to " . $job['end_date'] . ")\n";
        }
        $output .= "Certifications: \n";
        foreach ($profile->getCertifications() as $cert) {
            $output .= $cert['name'] . ", Date Earned: " . $cert['date_earned'] . "\n";
        }
        $output .= "Extra-Curricular Activities: \n";
        foreach ($profile->getExtracurricularActivities() as $extra) {
            $output .= $extra['role'] . " at " . $extra['organization'] . " (" . $extra['start_date'] . " to " . $extra['end_date'] . ") " . "\n - " . $extra['description'] . "\n";
        }
        $output .= "Languages: \n";
        foreach ($profile->getLanguages() as $lang) {
            $output .= $lang['language'] . " (" . $lang['proficiency'] . ") \n";
        }
        $output .= "References: \n";
        foreach ($profile->getReferences() as $refe) {
            $output .= "- " . $refe['name'] . ", " . $refe['position'] . " at " . $refe['company'] . "\nEmail: " . $refe['email'] . "\nPhone Number: " . $refe['phone_number'] . "\n";
        }

        $this->response = $output;
    }

    public function render()
    {
        header('Content-Type: text');
        return $this->response;
    }
}
