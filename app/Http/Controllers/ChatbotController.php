<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OpenAIService;
use Illuminate\Support\Facades\Validator;

class ChatbotController extends Controller
{
    protected $openAI;

    public function __construct(OpenAIService $openAI)
    {
        $this->openAI = $openAI;
    }

    /**
     * Handle incoming chat messages
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMessage(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'message' => 'required|string|max:1000',
            'conversation_history' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Pesan tidak valid',
                'errors' => $validator->errors()
            ], 422);
        }

        $message = $request->input('message');
        $conversationHistory = $request->input('conversation_history', []);

        // Get response from OpenAI
        $response = $this->openAI->chat($message, $conversationHistory);

        return response()->json($response);
    }

    /**
     * Test OpenAI connection
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function testConnection()
    {
        $result = $this->openAI->testConnection();
        return response()->json($result);
    }
}
