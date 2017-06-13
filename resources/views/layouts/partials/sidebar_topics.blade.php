
<ul class="list">
    @foreach ($sidebarTopics as $index => $sidebarTopic)
        <li>
            <a href="{{ $sidebarTopic->link() }}" title="{{{ $sidebarTopic->title }}}">

                @if (isset($numbered))
                    {{ $index }}.
                @endif

                 {{{ $sidebarTopic->title }}}
            </a>
        </li>
    @endforeach
</ul>
