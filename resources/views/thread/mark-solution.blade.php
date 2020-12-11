<i class="fa fa-heart-o" aria-hidden="true" id="solutionBth" onclick="markSolution(event)"
   data-comment-id="{{ $comment->id }}">
    <div class="solutions-count">{{ $comment->hasSolution->count() }}</div>
</i>
