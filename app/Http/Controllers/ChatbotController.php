<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $apiKey = env('GEMINI_API_KEY');
        
        if (!$apiKey) { # Kita ambil API satria ❤️❤️❤️❤️
            return response()->json([
                'error' => 'TINUNTUNUTUNTUTU ERROR ERROR #cintagemini2025, api nya ga ke load btw.'
            ], 500);
        }

        try {
            $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}";
            
            $payload = [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => "Kamu adalah asisten AI untuk website berita. Jawab pertanyaan pengguna dengan ramah dan informatif dalam Bahasa Indonesia, dan dengan respon yang pendek saja, jangan berikan respon yang panjang. Dalam website ini, ada 6 berita yaitu: 1. Laravel, admin jatuh cinta dengan laravel. 2. Evolusi windows, ketika AI jadi jantung OS. 3. Keberhasilan linux dalam mengubah dunia server. 4. Rehan baru saja menginstall arch. 5. Fabian ternyata pernah install Ubuntu. 6. Cara jalankan AI lokal dengan Ollama. | Pertanyaan: " . $request->message
                            ]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.7,
                    // 'maxOutputTokens' => 8000,
                ]
            ];

            Log::info('Sending request to Gemini', ['url' => $url, 'payload' => $payload]);

            $response = Http::timeout(30)->post($url, $payload);

            Log::info('Gemini response', ['status' => $response->status(), 'body' => $response->body()]);

            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                    $reply = $data['candidates'][0]['content']['parts'][0]['text'];
                    return response()->json(['reply' => $reply]);
                }
                
                if (isset($data['candidates'][0]['finishReason'])) {
                    $reason = $data['candidates'][0]['finishReason'];
                    
                    if ($reason === 'MAX_TOKENS') {
                        return response()->json([
                            'error' => 'Maaf, respons terlalu panjang. Coba pertanyaan yang lebih singkat, haha hihi hehe.'
                        ], 500);
                    }
                    
                    if ($reason === 'SAFETY') {
                        return response()->json([
                            'error' => 'Maaf, konten tidak dapat ditampilkan karena alasan keamanan 😛.'
                        ], 500);
                    }
                }
                
                return response()->json([
                    'error' => 'Maaf, AI tidak dapat memberikan respons, karena malas sekali. Coba lagi dengan pertanyaan berbeda.'
                ], 500);
            }

            return response()->json([
                'error' => 'HTTP Error ' . $response->status() . ': ' . $response->body()
            ], 500);

        } catch (\Exception $e) {
            Log::error('Chatbot error', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            
            return response()->json([
                'error' => 'TINUTUTUNNTININTTU Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
