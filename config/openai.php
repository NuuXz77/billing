<?php

return [
    /*
    |--------------------------------------------------------------------------
    | OpenAI API Key
    |--------------------------------------------------------------------------
    |
    | Your OpenAI API key from https://platform.openai.com/api-keys
    |
    */
    'api_key' => env('OPENAI_API_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | OpenAI Organization ID (Optional)
    |--------------------------------------------------------------------------
    |
    | Your OpenAI organization ID if you have one
    |
    */
    'organization' => env('OPENAI_ORGANIZATION', null),

    /*
    |--------------------------------------------------------------------------
    | OpenAI Model
    |--------------------------------------------------------------------------
    |
    | The model to use for chat completions
    | Options: gpt-4, gpt-4-turbo-preview, gpt-3.5-turbo, etc.
    |
    */
    'model' => env('OPENAI_MODEL', 'gpt-3.5-turbo'),

    /*
    |--------------------------------------------------------------------------
    | Temperature
    |--------------------------------------------------------------------------
    |
    | Controls randomness. Lower = more focused, Higher = more creative
    | Range: 0.0 to 2.0
    |
    */
    'temperature' => env('OPENAI_TEMPERATURE', 0.7),

    /*
    |--------------------------------------------------------------------------
    | Max Tokens
    |--------------------------------------------------------------------------
    |
    | Maximum number of tokens to generate
    |
    */
    'max_tokens' => env('OPENAI_MAX_TOKENS', 500),

    /*
    |--------------------------------------------------------------------------
    | System Prompt
    |--------------------------------------------------------------------------
    |
    | The system message that defines the AI's behavior
    |
    */
    'system_prompt' => env('OPENAI_SYSTEM_PROMPT', 'Kamu adalah BillHostifyAI, asisten virtual yang membantu pelanggan BillHostify. BillHostify adalah penyedia layanan hosting terpercaya. Kamu harus ramah, profesional, dan membantu menjawab pertanyaan tentang layanan hosting, domain, VPS, cloud hosting, dan dukungan teknis. Jawab dalam bahasa Indonesia dengan sopan dan jelas.'),

    /*
    |--------------------------------------------------------------------------
    | Request Timeout
    |--------------------------------------------------------------------------
    |
    | Timeout for API requests in seconds
    |
    */
    'timeout' => env('OPENAI_TIMEOUT', 30),

    /*
    |--------------------------------------------------------------------------
    | Base URL
    |--------------------------------------------------------------------------
    |
    | OpenAI API base URL
    |
    */
    'base_url' => env('OPENAI_BASE_URL', 'https://api.openai.com/v1'),
];
