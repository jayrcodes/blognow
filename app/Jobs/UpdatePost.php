<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdatePost extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $post;
    protected $user_id;
    protected $title;
    protected $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($post, $user_id, $title, $message)
    {
        $this->post = $post;
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
        if ($this->user_id)
            $this->post->user_id = $this->user_id;
        
        if ($this->title)
            $this->post->title = $this->title;

        if ($this->message)
            $this->post->message = $this->message;
        
        $this->post->save();
    }
}
