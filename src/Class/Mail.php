<?php

namespace App\Class;

use Mailjet\Client;
use Mailjet\Resources;

Class Mail
{
    private string $api_key = '412adfe7d059f5c578675abe496080ae';
    private string $api_key_secret = '14899d2048a954be64f046919d02bab0';

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
                    'Variables' => json_decode('content',
                        $content,
                        true)
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() && dd($response->getData());
    }
}