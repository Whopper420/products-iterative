@props(['message' => null])

@if ($message = $message ?? session('success'))
    <div class="flash flash-success" role="status">
        <p>{{ $message }}</p>
    </div>
@endif
