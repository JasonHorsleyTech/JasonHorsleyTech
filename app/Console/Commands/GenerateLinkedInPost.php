<?php

namespace App\Console\Commands;

use App\Mail\LinkedinPostAlert;
use App\Models\LinkedinPost;
use Illuminate\Console\Command;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Mail;

class GenerateLinkedinPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-linkedin-post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a CE team friendly linked in post.';

    public static array $postSubjects = [
        'team', 'project', 'business', 'strategy', 'growth', 'development', 'market', 'analysis', 'planning', 'performance', 'investment', 'technology', 'innovation', 'management', 'leadership', 'success', 'vision', 'goal', 'customer', 'service', 'quality', 'value', 'solution', 'improvement', 'efficiency', 'effectiveness', 'resource', 'process', 'product', 'industry', 'trend', 'research', 'opportunity', 'challenge', 'commitment', 'partnership', 'collaboration', 'communication', 'information', 'data', 'analytics', 'insight', 'knowledge', 'skill', 'ability', 'talent', 'experience', 'expertise', 'professional', 'organization', 'corporate', 'enterprise', 'entity', 'operation', 'execution', 'achievement', 'result', 'outcome', 'impact', 'contribution', 'role', 'responsibility', 'authority', 'decision', 'policy', 'standard', 'guideline', 'procedure', 'practice', 'approach', 'method', 'technique', 'tool', 'application', 'system', 'platform', 'network', 'security', 'compliance', 'regulation', 'law', 'ethics', 'culture', 'diversity', 'inclusion', 'environment', 'sustainability', 'health', 'safety', 'welfare', 'community', 'relationship', 'engagement', 'satisfaction', 'loyalty', 'reputation', 'brand', 'awareness', 'promotion', 'campaign', 'advertisement', 'content', 'media', 'digital', 'social', 'mobile', 'web', 'cloud', 'data', 'automation', 'innovation', 'Synergy', 'Pivot', 'Golf', 'Frugality', 'Motivation', 'Productivity', 'Mindfulness', 'Networking', 'Optimization', 'Grind', 'Hustle', 'Innovation', 'Sushi', 'Yoga', 'Leadership', 'Efficiency', 'Sustainability', 'Empowerment', 'Engagement', 'Balance', 'Wellness', 'Self-care', 'Disruption', 'Mindset', 'Agile', 'Organic', 'Holistic', 'Mentorship', 'Collaboration', 'Veganism', 'Craftsmanship', 'Aesthetic', 'Authenticity', 'Branding', 'Caffeine', 'Analytics', 'Biohacking', 'Digital nomad', 'Entrepreneurship', 'Gamification', 'Growth hacking', 'Influence', 'Kombucha', 'Legacy', 'Minimalism', 'Outsourcing', 'Passion', 'Ecosystem', 'Quota', 'Grit', 'Resilience', 'Ideation', 'Scale', 'Keto', 'Thought leadership', 'Marathon', 'Unicorn', 'Omnichannel', 'Virtual reality', 'Quality', 'Work-life balance', 'Startup', 'Zen', 'User experience', 'Accountability', 'Webinar', 'Benchmarking', 'Yield', 'Cold brew', 'Adaptability', 'Data-driven', 'Co-working', 'Fintech', 'Experiential', 'Hackathon', 'Green', 'Journey', 'Integration', 'Lean', 'Knowledge base', 'Niche', 'Mobility', 'Podcast', 'Optimization strategy', 'Retreat', 'Quantum leap', 'Telecommute', 'Sustainability goals', 'Visionary', 'X-factor', 'Zest', 'Blockchain', 'Disruptor', 'Flexibility', 'Hyperlocal', 'Jet-set', 'Luxury', 'Networking event', 'Personal brand', 'Remote work',
    ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $then = now()->addHour();
        $faker = \Faker\Factory::create();
        $wordOfTheDay = $faker->randomElement($this::$postSubjects);

        $result = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a LinkedIn parody post generator. You return random daily posts that parody the bland corporate lifeless nothing self promotional stuff you find on the platform, base on what you know about me.'],
                ['role' => 'system', 'content' => 'Every response is “played with a completely straight face”. Every post is dripping with positivity, is excruciatingly safe, and completely devoid of interesting content or ideas.'],
                ['role' => 'system', 'content' => 'Never mention things that happen or code/company specifics. Never mention that you are a "parody" account; All posts must be played COMPLETELY STRAIGHT FACED.'],

                ['role' => 'user', 'content' => 'Its ' . $then->format('l') . ', ' . $then->format('g:ia')],
                ['role' => 'user', 'content' => 'Please generate a post about ' . $wordOfTheDay],
            ],
        ]);

        $post = LinkedinPost::create([
            'content' => $result->choices[0]->message->content,
            'generated_at' => now(),
        ]);

        Mail::to(env('LINKEDIN_EMAIL'))->send(new LinkedinPostAlert($post));
    }
}
