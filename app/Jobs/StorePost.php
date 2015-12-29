<?php

namespace App\Jobs;

use App\Post;
use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class StorePost extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $user_id;
    protected $title;
    protected $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user_id, $title, $message)
    {   
        $this->user_id = $user_id;
        $this->title = $title;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $post = new Post;
        $post->user_id = $this->user_id;
        $post->title = $this->title;
        $post->message = $this->message;
        $post->save(); 
    }
}
