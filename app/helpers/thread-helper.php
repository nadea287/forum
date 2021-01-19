<?php

use Illuminate\Support\Facades\DB;

function setActiveTag($tag)
{
    return request()->tag == $tag ? 'active_link' : '';
}
function tagCount($tag)
{
    return DB::table('tag_thread')->where('tag_id', $tag)->count();
}

