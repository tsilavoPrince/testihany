<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ChatController extends Controller
{
    // public function chat(Request $request)
    // {
    //     $message = $request->input('message');

    //     if (!$message) {
    //         return response()->json(['error' => 'Message is required'], 400);
    //     }

    //     $client = new Client();

    //     try {
    //         $response = $client->post('https://api.openai.com/v1/chat/completions', [
    //             'headers' => [
    //                 'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
    //                 'Content-Type' => 'application/json',
    //             ],
    //             'json' => [
    //                 'model' => 'gpt-3.5-turbo',
    //                 'messages' => [
    //                     ['role' => 'user', 'content' => $message],
    //                 ],
    //             ],
    //         ]);

    //         dd($response);

    //         $body = json_decode($response->getBody(), true);

    //         return response()->json([
    //             'reply' => $body['choices'][0]['message']['content'],
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'Something went wrong'], 500);
    //     }
    // }

    public function chat(Request $request)
{
    $client = new \GuzzleHttp\Client();

    try {
        $response = $client->post('https://api.openai.com/v1/chat/completions*', [
            'headers' => [
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => 'Bonjour, ChatGPT !'],
                ],
            ],
        ]);

        $body = json_decode($response->getBody(), true);

        return response()->json([
            'reply' => $body['choices'][0]['message']['content'],
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

}
