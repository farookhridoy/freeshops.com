@foreach($thread->messages as $item)

    @if( Str::contains($item->body,'uploads/chat') )
        <div class="row">
            <div class="col-lg-12">
                <div style="float: right; width: 150px; height: 150px;">
                    <img src="{{ asset($item->body) }}" style="height:100%; width:100%; object-fit:cover; border-radius: 10px">
                </div>

            </div>
        </div>
    @else
    <div class="bubble {{ $item->user_id == $user->id ? 'me' : 'you'}}">
        <span style="font-weight:bold;">{{ $item->user_id == $user->id ? 'Me' : 'Anonymous'}}</span><br>
        {{ $item->body }}
    </div>
    @endif

@endforeach
