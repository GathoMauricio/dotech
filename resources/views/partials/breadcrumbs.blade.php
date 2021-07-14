@if (count($breadcrumbs))

    <ol class="breadcrumb">
        @foreach ($breadcrumbs as $breadcrumb)
            @if ($breadcrumb->url && !$loop->last)
                 @if($breadcrumb->title == '')
                <li class="breadcrumb-item" ><a href="{{ $breadcrumb->url }}"><img src="{{ env('ICON_BREADCUM','') }}/img/{{ $breadcrumb->icon }}" width="16" height="16">{{ $breadcrumb->title }}</a></li>
                @else
                <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                 @endif
            @else
                @if($breadcrumb->title == '')
                <li class="breadcrumb-item active" ><img src="{{ env('ICON_BREADCUM','') }}/img/{{ $breadcrumb->icon }}" width="16" height="16">{{ $breadcrumb->title }}</li>
                @else
                <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
                @endif
            @endif

        @endforeach
    </ol>

@endif