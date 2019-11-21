<?php

namespace App\Listeners;

use App\Events\CreatePost;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use App\Language;
use Illuminate\Support\Str;

class CreatePostMultipleLanguage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CreatePost  $event
     * @return void
     */
    public function handle(CreatePost $event)
    {
        $locale = 'en';
        $languages = Language::all();
        foreach ($languages as $lang) {
            $language = Language::find($lang->id);
            $data = [
                'title' => $event->request->input('title-' . $lang->code_language),
                'content' => $event->request->input('content-' . $lang->code_language),
            ];
            $event->post->languages()->attach($language, $data);
        }

    }
}
