<?php

namespace App\Services;

use App\Models\ChatLog;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AiService
{
    protected array $faq = [
        'pergola vs gazebo' => 'A pergola is an open-roof shade structure—great for patios and attached living. A gazebo is a freestanding pavilion with a solid or louvered roof for all-weather seating. Ashwick designs both in cedar, pressure-treated pine, and aluminum.',
        'how long timeline' => 'Most residential pergola installs take 2–5 days on site after permits and shop fabrication. Freestanding gazebos typically run 3–7 days depending on size, foundation, and roof complexity.',
        'cost price estimate' => 'Ashwick projects typically range from $6,500–$28,000 for custom pergolas and $12,000–$45,000 for gazebos. Pricing depends on footprint, timber grade, roof type, lighting, and site access in the Charlotte metro.',
        'materials wood aluminum' => 'We build with select cedar, southern yellow pine (treated), and powder-coated aluminum. Cedar ages beautifully; aluminum needs less maintenance; pine is the value workhorse with proper staining.',
        'warranty' => 'Every Ashwick structure includes a 5-year workmanship warranty on framing and hardware. Finish warranties follow the stain or powder-coat manufacturer guidelines.',
        'process steps' => 'Our process: 1) Site measure & shade consult, 2) 3D design & permit packet, 3) Shop fabrication, 4) Footings / ledger attach, 5) Frame & roof install, 6) Stain/seal & lighting punch-list.',
        'permits hoa' => 'We prepare permit drawings for Mecklenburg County and common Charlotte HOAs. Setbacks, height, and attachment details are checked before we pour footings.',
        'contact book' => 'Call or text Ashwick Outdoor Structures at (704) 555-0147, email hello@ashwickoutdoor.com, or use the contact form. Serving Charlotte, Concord, Matthews, Huntersville, and surrounding Carolinas communities.',
        'admin login' => 'Staff access the ERP at /admin. Contact your manager if you need credentials reset—never share passwords in chat.',
        'inventory lumber' => 'We stock cedar posts, beams, rafters, galvanized hardware, post bases, and exterior stains. Low-stock lumber SKUs appear on the Inventory screen in admin.',
    ];

    public function chat(string $question, ?string $sessionId = null): array
    {
        $answer = null;
        $source = 'faq';

        if ($key = config('services.openai.key')) {
            try {
                $answer = $this->callOpenAi($question, $key);
                $source = 'openai';
            } catch (\Throwable) {
                $answer = null;
            }
        }

        if (! $answer && ($gemini = config('services.gemini.key'))) {
            try {
                $answer = $this->callGemini($question, $gemini);
                $source = 'gemini';
            } catch (\Throwable) {
                $answer = null;
            }
        }

        if (! $answer) {
            $answer = $this->faqAnswer($question);
            $source = 'faq';
        }

        ChatLog::query()->create([
            'session_id' => $sessionId,
            'question' => $question,
            'answer' => $answer,
            'source' => $source,
        ]);

        return ['answer' => $answer, 'source' => $source];
    }

    public function generate(string $type, string $prompt): string
    {
        $system = match ($type) {
            'blog' => 'Write an SEO blog post for Ashwick Outdoor Structures about custom pergolas and gazebos. Use clear headings and practical tips.',
            'description' => 'Write a compelling service description for Ashwick Outdoor Structures.',
            'suggestion' => 'Suggest operational automations for a US pergola and gazebo builder SME ERP.',
            'troubleshoot' => 'Help an Ashwick admin troubleshoot a pergola/gazebo operations issue.',
            default => 'You are a helpful assistant for Ashwick Outdoor Structures.',
        };

        if ($key = config('services.openai.key')) {
            try {
                return $this->callOpenAi($prompt, $key, $system);
            } catch (\Throwable) {
                // fall through
            }
        }

        return $this->demoGenerate($type, $prompt);
    }

    protected function faqAnswer(string $question): string
    {
        $q = Str::lower($question);
        $best = null;
        $bestScore = 0;

        foreach ($this->faq as $keys => $answer) {
            $score = 0;
            foreach (explode(' ', $keys) as $word) {
                if (str_contains($q, $word)) {
                    $score++;
                }
            }
            if ($score > $bestScore) {
                $bestScore = $score;
                $best = $answer;
            }
        }

        return $best ?? 'Thanks for reaching out to Ashwick Outdoor Structures! We design and build custom pergolas and gazebos across the Charlotte metro. Call (704) 555-0147 or leave details on our contact form for a free shade consult and estimate.';
    }

    protected function demoGenerate(string $type, string $prompt): string
    {
        return match ($type) {
            'blog' => "# Pergola Design Trends for {$prompt}\n\nCharlotte homeowners are expanding outdoor living with cedar pergolas, louvered roofs, and freestanding gazebos that turn patios into four-season rooms. At Ashwick Outdoor Structures we engineer footings for Carolina clay, match HOA guidelines, and finish timber so shade structures age with dignity.\n\nKey takeaways: size the structure to furniture zones, plan power for fans and lighting early, and choose cedar or aluminum based on maintenance appetite.",
            'description' => "Ashwick Outdoor Structures crafts custom pergolas and gazebos with precise joinery, code-ready footings, and exterior finishes built for Carolina weather. Ideal for homeowners who want shade, entertaining space, and curb appeal without a full patio enclosure. Prompt focus: {$prompt}",
            'suggestion' => "Automation ideas for Ashwick ERP:\n1. Auto-create site-measure appointments when a contact form mentions 'pergola' or 'gazebo'.\n2. Low-stock alerts when cedar posts or post bases drop below reorder points.\n3. Invoice drafts generated when a job moves to 'completed'.\n4. WhatsApp follow-up 48 hours after design consults.\n5. AI draft blog posts from completed install photo tags.\nContext: {$prompt}",
            'troubleshoot' => "Troubleshooting guide for: {$prompt}\n\n1. Confirm the job status and assigned lead carpenter in Jobs.\n2. Check appointment conflicts on the calendar (site measure vs install).\n3. Verify invoice payment status before scheduling final stain day.\n4. Review inventory for the lumber SKU reserved on that job.\n5. If AI chat is offline, FAQ fallback still answers common pergola/gazebo questions.",
            default => "Ashwick demo response for: {$prompt}",
        };
    }

    protected function callOpenAi(string $prompt, string $key, ?string $system = null): string
    {
        $system ??= 'You are the helpful AI for Ashwick Outdoor Structures, a US pergola and gazebo builder in Charlotte, NC. Be concise and practical.';

        $response = Http::withToken($key)
            ->timeout(30)
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => config('services.openai.model', 'gpt-4o-mini'),
                'messages' => [
                    ['role' => 'system', 'content' => $system],
                    ['role' => 'user', 'content' => $prompt],
                ],
            ]);

        $response->throw();

        return (string) data_get($response->json(), 'choices.0.message.content', '');
    }

    protected function callGemini(string $prompt, string $key): string
    {
        $model = config('services.gemini.model', 'gemini-1.5-flash');
        $response = Http::timeout(30)
            ->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$key}", [
                'contents' => [[
                    'parts' => [[
                        'text' => "You are Ashwick Outdoor Structures AI. Answer helpfully about custom pergolas and gazebos.\n\nUser: {$prompt}",
                    ]],
                ]],
            ]);

        $response->throw();

        return (string) data_get($response->json(), 'candidates.0.content.parts.0.text', '');
    }
}
