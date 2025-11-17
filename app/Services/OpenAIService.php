<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class OpenAIService
{
    protected $apiKey;
    protected $organization;
    protected $model;
    protected $temperature;
    protected $maxTokens;
    protected $systemPrompt;
    protected $timeout;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('openai.api_key');
        $this->organization = config('openai.organization');
        $this->model = config('openai.model');
        $this->temperature = (float) config('openai.temperature');
        $this->maxTokens = (int) config('openai.max_tokens');
        $this->systemPrompt = config('openai.system_prompt');
        $this->timeout = (int) config('openai.timeout');
        $this->baseUrl = config('openai.base_url');
    }

    /**
     * Send a chat message to OpenAI and get response
     *
     * @param string $message User's message
     * @param array $conversationHistory Optional conversation history
     * @return array
     */
    public function chat(string $message, array $conversationHistory = []): array
    {
        try {
            // Validate API key
            if (empty($this->apiKey)) {
                throw new Exception('OpenAI API key not configured');
            }

            // Get current date and time
            $currentDateTime = now()->timezone('Asia/Jakarta')->locale('id')->isoFormat('dddd, D MMMM YYYY, HH:mm:ss');
            $timezone = 'Asia/Jakarta (WIB)';
            
            // Build messages array with enhanced system prompt including current time
            $messages = [
                [
                    'role' => 'system',
                    'content' => $this->systemPrompt . "\n\nINFORMASI WAKTU REAL-TIME: Sekarang adalah " . $currentDateTime . " (" . $timezone . "). Gunakan informasi waktu ini untuk menjawab pertanyaan tentang hari, tanggal, bulan, tahun, atau waktu saat ini dengan akurat."
                ]
            ];

            // Add conversation history if provided
            if (!empty($conversationHistory)) {
                $messages = array_merge($messages, $conversationHistory);
            }

            // Add current user message
            $messages[] = [
                'role' => 'user',
                'content' => $message
            ];

            // Prepare headers
            $headers = [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ];

            if ($this->organization) {
                $headers['OpenAI-Organization'] = $this->organization;
            }

            // Make API request
            $response = Http::withHeaders($headers)
                ->timeout($this->timeout)
                ->withOptions([
                    'verify' => false, // Disable SSL verification for development
                ])
                ->post($this->baseUrl . '/chat/completions', [
                    'model' => $this->model,
                    'messages' => $messages,
                    'temperature' => $this->temperature,
                    'max_tokens' => $this->maxTokens,
                ]);

            // Check if request was successful
            if (!$response->successful()) {
                Log::error('OpenAI API Error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return [
                    'success' => false,
                    'message' => 'Maaf, terjadi kesalahan saat menghubungi AI. Silakan coba lagi.',
                    'error' => $response->json()['error']['message'] ?? 'Unknown error'
                ];
            }

            $data = $response->json();

            // Extract the assistant's reply
            $assistantMessage = $data['choices'][0]['message']['content'] ?? '';

            // Clean up markdown formatting
            $assistantMessage = $this->cleanMarkdown($assistantMessage);

            return [
                'success' => true,
                'message' => $assistantMessage,
                'usage' => $data['usage'] ?? null,
                'model' => $data['model'] ?? $this->model,
            ];

        } catch (Exception $e) {
            Log::error('OpenAI Service Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Maaf, terjadi kesalahan. Silakan coba lagi nanti.',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Test OpenAI connection
     *
     * @return array
     */
    public function testConnection(): array
    {
        try {
            $response = $this->chat('Halo, test koneksi');
            
            if ($response['success']) {
                return [
                    'success' => true,
                    'message' => 'Koneksi OpenAI berhasil!',
                    'model' => $response['model']
                ];
            }

            return $response;

        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Koneksi OpenAI gagal!',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Get available models (requires API key)
     *
     * @return array
     */
    public function getModels(): array
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
            ])->withOptions([
                'verify' => false, // Disable SSL verification for development
            ])->get($this->baseUrl . '/models');

            if ($response->successful()) {
                return [
                    'success' => true,
                    'models' => $response->json()['data']
                ];
            }

            return [
                'success' => false,
                'message' => 'Gagal mendapatkan daftar model'
            ];

        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Clean markdown formatting from text
     *
     * @param string $text
     * @return string
     */
    private function cleanMarkdown(string $text): string
    {
        // Remove bold markdown (**text** or __text__)
        $text = preg_replace('/\*\*(.*?)\*\*/', '$1', $text);
        $text = preg_replace('/__(.*?)__/', '$1', $text);
        
        // Remove italic markdown (*text* or _text_)
        $text = preg_replace('/\*(.*?)\*/', '$1', $text);
        $text = preg_replace('/_(.*?)_/', '$1', $text);
        
        // Remove headers (# ## ###)
        $text = preg_replace('/^#+\s+/m', '', $text);
        
        // Remove bullet points (- or * at start of line)
        $text = preg_replace('/^[\*\-]\s+/m', '', $text);
        
        // Remove numbered lists (1. 2. 3.)
        $text = preg_replace('/^\d+\.\s+/m', '', $text);
        
        // Remove code blocks (```)
        $text = preg_replace('/```.*?```/s', '', $text);
        
        // Remove inline code (`text`)
        $text = preg_replace('/`(.*?)`/', '$1', $text);
        
        return trim($text);
    }
}
