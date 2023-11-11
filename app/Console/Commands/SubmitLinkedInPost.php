<?php

namespace App\Console\Commands;

use App\Models\LinkedinPost;
use Illuminate\Console\Command;

class SubmitLinkedinPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:submit-linkedin-post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Grab the first post created an hour ago, post to linked in, mark it as posted.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $toPost = LinkedinPost::where('posted_at', null)->where('generated_at', '<', now()->subHour())->first();

        if ($toPost) {
            // TODO: Linked in API call
            $toPost->update([
                'posted_at' => now(),
            ]);

            $this->info('Posted: ' . $toPost->content);
        } else {
            $this->info('Nothing to post.');
        }
    }
}
