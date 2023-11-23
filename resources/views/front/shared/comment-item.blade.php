<div class="rounded-2xl bg-white p-4 shadow-md mb-5">
    <div class="flex pb-3">
        <span class="rounded-[100%] w-7 h-7 bg-primary-950 text-white me-2 flex justify-center items-center">
            {{ $comment->profile_name }}
        </span>
	    <strong>
		    {{ $comment->full_name }}
	    </strong>
    </div>
	<p class="text-gray-400 mb-3">{{ $comment->body }}</p>
	<span class="opacity-60">{{ $comment->created_at_ago }}</span>
</div>