<?php

namespace App\Services;

use App\Mail\MarketingMail;
use App\Models\Campaign;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public static function mailCampaign(Campaign $campaign)
    {
        $subject = $campaign->template->subject;
        $body = $campaign->template->body;
        $tStrings = ['{first_name}' => 'first_name', '{last_name}' => 'last_name'];

        foreach ($campaign->customerGroup->customers as $customer) {
            $tStrings['{title}'] = $customer->sex === 'male' ? 'Mr.' : ($customer->sex === 'female' ? 'Ms.' : '');

            foreach ($tStrings as $template => $value) {
                $subject = str_replace($template, $customer[$value], $subject);
                $body = str_replace($template, $customer[$value], $body);
            }

            MailService::sendEmail($subject, $body, $customer->email);
        }

        $campaign->update(['sent' => true]);
    }

    /**
     * @param string $subject
     * @param string $body
     * @param string $email
     */
    public static function sendEmail(string $subject, string $body, string $email)
    {
        Mail::to($email)->queue(new MarketingMail($subject, $body));
    }
}
