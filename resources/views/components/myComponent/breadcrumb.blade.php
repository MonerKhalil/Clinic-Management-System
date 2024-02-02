<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between header-breadcrumb">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title page-title">
                {{ $TitleBreadcrumb }}
            </h4>
            <div class="nk-block-des text-soft">
                <p>{{ $DescriptionBreadcrumb }}</p>
            </div>
        </div>
        <div class="nk-block-head-content">
            <nav>
                <ul class="breadcrumb">
                    @foreach($Pages as $Index => $Page)
                        @if(isset($Page["Route"]))
                            <li class="breadcrumb-item">
                                <a href="{{ $Page["Route"] }}">{{ $Page["Title"] }}</a>
                            </li>
                        @else
                            <li class="breadcrumb-item active">
                                {{ $Page["Title"] }}
                            </li>
                        @endif
                    @endforeach
                </ul>
            </nav>
        </div>
    </div>
</div>
