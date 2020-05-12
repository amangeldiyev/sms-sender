<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsSender
{

    /**
     * Send single message.
     *
     * @param  string $message
     * @param  string $phone
     * @return string
     */
    public function send($text, $phone)
    {
        try {
            $response = Http::withBasicAuth(env('SMS_LOGIN'), env('SMS_PASSWORD'))
                ->post('https://msg.kcell.kz/api/v3/messages', [
                    "client_message_id" => time(),
                    "recipient" => $this->normalizePhone($phone),
                    "sender" => env('SMS_SENDER'),
                    "message_text" => $text,
                    "priority" => 2,
                    "tag" => "test_clnt_msg_id_1",
                    "expire_time" => null,
                    "schedule_time" => null,
                    "callback_url" => null
                ]);

            Log::info($response->json());

        } catch (\Exception $e) {
            Log::error('Error while seding sms');
            Log::info($e);
        }
    }

    /**
     * Log to file.
     *
     * @param  string $message
     * @param  string $phone
     * @return void
     */
    public function log($text, $phone)
    {
        Log::info($text . ' - Sent to: ' . $this->normalizePhone($phone));
    }

    /**
     * Normalize phone format.
     *
     * @param  string $phone
     * @return string
     */
    private function normalizePhone($phone)
    {
        return '7'.substr(preg_replace('/[^0-9.]+/', '', $phone), -10);
    }
}