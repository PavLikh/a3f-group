<nav>
    <ul>
        @foreach($menu as $item)
        <li class="@if($item['active']) active @endif">
            <a href="{{ route($item['route']) }}">{{ $item['title'] }}</a>
        </li>
        @endforeach
    </ul>

</nav>
