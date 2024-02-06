<?php

namespace App\Http\Controllers\Admin;
use App\Models\Track;


class TrackController extends TemplateController
{
    public function __construct(Track $track)
    {
        parent::__construct($track, 'Admin/Track/IndexTracks', 'name');
    }
}
