<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\TrixAttachment;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('remove-unused-trix-attachments', function () {
    $unconnected = TrixAttachment::whereNull('place_id')
        ->where('created_at', '<=', now()->subMonth())
        ->take(10)
        ->get();
    foreach ($unconnected as $key => $value) {
        if (!Storage::delete('public/' . $value->path) || ($key < 4)) {
            $unconnected->forget($key);
        }
    }
    $idsToDelete = $unconnected->pluck('id')->all();
    TrixAttachment::whereIn('id', $idsToDelete)->delete();
    $this->comment(implode(' ', $idsToDelete));
})->purpose('Remove unused trix attachments');
