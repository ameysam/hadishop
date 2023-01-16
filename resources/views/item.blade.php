@foreach ($charts as $item)
    <div>
        {{$item->id}}-{{ $item->post->name }} ({{ $item->user->full_name }})
    </div>

    @if ($item->children->count() > 0)
        {{-- @dd($item->children) --}}
        @include('item', ['charts' => $item->children])
    @endif
@endforeach