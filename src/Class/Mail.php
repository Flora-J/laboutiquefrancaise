<?php

namespace App\Class;

use Mailjet\Client;
use Mailjet\Resources;

Class Mail
{
    private string $api_key = '09e1ca6b8a530c06e860880475e3d64d';
    private string $api_key_secret = '3fa3961c7626a12c50b9613676043b12';

    public function send($to_email, $to_name, $subject, $content): void
    {
        $mj = new Client($this->api_key, $this->api_key_secret, true,['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "flora.julie88@gmail.com",
                        'Name' => "La Boutique Française"
                    ],
                    'To' => [
                        [
                            'Email' => $to_email,
                            'Name' => $to_name
                        ]
                    ],
                    'TemplateID' => 4602826,
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                    'Variables' => [
                        'content' => $content,
                        true
                    ]
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() && dd($response->getData());
    }
}