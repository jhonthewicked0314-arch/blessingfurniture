<?php

header('Content-Type: application/json');

// ========== Read Input ==========
$input = json_decode(file_get_contents('php://input'), true);

if (!$input || empty($input['message'])) {
    echo json_encode(['reply' => 'Please send a valid message.']);
    exit;
}

$userMessage = trim($input['message']);
$messageLower = strtolower($userMessage);

// ========== FAQ Shortcut Logic ==========
$faqResponses = [
    'courses' => 'We offer a wide range of undergraduate and postgraduate courses including B.Tech, BBA, BCA, MBA, MCA, B.Sc, M.Sc, and more. Please visit our website or contact the admissions office for a complete list of programs.',
    'fees' => 'Our fee structure varies by program. Generally, undergraduate programs range from ₹50,000 to ₹1,50,000 per year. For detailed fee information, please contact our accounts department or visit the admissions office.',
    'admission' => 'Admissions are open for the current academic year. You can apply online through our website or visit the campus for direct admission. Required documents include mark sheets, ID proof, and passport-size photographs.'
];

foreach ($faqResponses as $keyword => $response) {
    if (strpos($messageLower, $keyword) !== false) {
        echo json_encode(['reply' => $response]);
        exit;
    }
}

// ========== Load College Data ==========
$collegeDataPath = __DIR__ . '/college.json';

if (!file_exists($collegeDataPath)) {
    echo json_encode(['reply' => 'College data is not available at the moment. Please contact the college office.']);
    exit;
}

$collegeData = file_get_contents($collegeDataPath);

if (empty($collegeData)) {
    echo json_encode(['reply' => 'College data is not available at the moment. Please contact the college office.']);
    exit;
}

// ========== Prepare Gemini API Request ==========
$apiKey = 'AIzaSyCipn8UR70AzwXF6_Qs3ZalcFmiFCUyV-M';
$apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-latest:generateContent?key=' . $apiKey;

$systemInstruction = "You are a casual, friendly chatbot for Kovai Kalaimagal College of Arts and Science (KKCAS).

RULES:
1. NEVER use markdown formatting. No asterisks, no bold, no bullet points with *, no hashtags for headings. Write plain text only. Use line breaks to separate points. Use dashes (-) for lists if needed.
2. Keep replies SHORT and natural. Talk like a real person, not a robot.
3. For greetings like 'hi', 'hello', 'hey' — just reply casually like 'Hey! 👋 What would you like to know about our college?' Do NOT introduce yourself with a long sentence.
4. For unrelated topics (weather, jokes, random stuff) — reply naturally to what they said, then gently steer back. Example: 'Haha nice! But hey, I am best at answering college stuff. Got any questions about courses, fees, or admissions?'
5. Answer ONLY from the provided JSON data. Do NOT make up information.
6. If you genuinely cannot find an answer, say something like 'Hmm I do not have that info right now. You can reach the college office at +91 422 297 0132 or check kkcas.edu.in for more details!'
7. Be conversational. Use emojis sparingly. No walls of text.";

$prompt = $systemInstruction . "\n\nCollege Data:\n" . $collegeData . "\n\nStudent Question: " . $userMessage;

$requestBody = [
    'contents' => [
        [
            'parts' => [
                ['text' => $prompt]
            ]
        ]
    ]
];

// ========== Send Request to Gemini ==========
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestBody));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

// ========== Handle Errors (DEBUG VERSION) ==========
if ($curlError) {
    echo json_encode(['reply' => 'CURL Error: ' . $curlError]);
    exit;
}
if ($httpCode !== 200) {
    // This will show you exactly what Google is complaining about
    $errorDetails = json_decode($response, true);
    $errorMessage = isset($errorDetails['error']['message']) ? $errorDetails['error']['message'] : 'Unknown API Error';
    echo json_encode(['reply' => 'AI Error (' . $httpCode . '): ' . $errorMessage]);
    exit;
}

// ========== Parse Response ==========
$responseData = json_decode($response, true);

if (
    isset($responseData['candidates'][0]['content']['parts'][0]['text'])
) {
    $reply = $responseData['candidates'][0]['content']['parts'][0]['text'];
    echo json_encode(['reply' => trim($reply)]);
} else {
    echo json_encode(['reply' => 'I could not find an answer. Please contact the college office.']);
}
