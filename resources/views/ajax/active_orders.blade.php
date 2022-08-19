<ol>
    @foreach ($active_orders as $item)
        <li><a href="{{ route('user.order', $item->order_no) }}" target="_blank">#{{ $item->order_no }}</a></li>
    @endforeach
</ol>
