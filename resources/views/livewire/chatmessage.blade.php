<div wire:poll.30s="refreshMessages">
    @foreach ($messages as $message)
       <x-message :message="$message" />
    @endforeach
</div>
