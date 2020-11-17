<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Flag;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class FlagController extends Controller
{
    public function setFlag($type, $target)
    {
        if (!Flag::isAllowed($type)) {
            return [];
        }

        $result = Flag::where([
           'author_id' => auth()->user()->id,
           'target_id' => $target,
           'type' => $type,
        ])->get();

        if ($result->isEmpty()) {
            Flag::create([
                'author_id' => auth()->user()->id,
                'target_id' => $target,
                'type' => $type,
            ]);
            $result = collect([
                'flagged' => true,
            ]);
        } else {
            $this->unsetFlag($type, $target);

            $result = collect([
                'flagged' => false,
            ]);
        }



        return response()->json($result);
    }

    public function getFlag(Comment $comment)
    {
//        $val = [];
//        $changeColour = Flag::where('author_id', auth()->user()->id)->get();
//        if ($changeColour->isEmpty()) {
//
//        return $val = 1;
//        }
//        $changeColour - object
//        if (array_map(auth()->user()->id, $changeColour)) {
//            return $val = [1];
//    }
        $result = collect([
            'solution_count' => $comment->hasSolution->count(),
//            'change_colour' => $val,
        ]);

        return response()->json($result);
    }

    public function unsetFlag($type, $target)
    {
        Flag::where([
           'author_id' => auth()->user()->id,
           'target_id' => $target,
           'type' => $type,
        ])->delete();
    }
}
