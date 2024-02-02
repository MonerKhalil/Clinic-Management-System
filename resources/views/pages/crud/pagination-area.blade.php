@php
    $PaginationData = $data ;
@endphp
<div class="g">
    <ul class="pagination justify-content-center justify-content-md-start">
        @php
            $ArrayPaging = [] ;
            foreach ($PaginationData->withQueryString()->links()->elements as $Value_1)
                if(is_array($Value_1))
                    foreach ($Value_1 as $index_2=>$Value_2)
                        $ArrayPaging[$index_2] = $Value_2 ;
            $PartsViewNum = 5 ;
            $PartDir = ($PartsViewNum - 1) / 2 ;
        @endphp
        @if($PaginationData->currentPage() > 1)
            <li class="page-item">
                <a href="{{ $ArrayPaging[$PaginationData->currentPage()-1] }}"
                   class="page-link">
                    Prev
                </a>
            </li>
        @endif
        @if($PaginationData->currentPage() - $PartDir > 1)
            <li class="page-item">
                <a href="{{ $ArrayPaging[1] }}"
                   class="page-link">1</a>
            </li>
            <li class="page-item disabled">
                    <span class="page-link">
                        <em class="icon ni ni-more-h"></em>
                    </span>
            </li>
        @endif
        @for($i = $PartDir ; $i >= 1 ; $i--)
            @if($PaginationData->currentPage() - $i >= 1)
                <li class="page-item">
                    <a href="{{ $ArrayPaging[$PaginationData->currentPage() - $i] }}"
                       class="ButtonOptionInput page-link">
                        {{$PaginationData->currentPage() - $i}}
                    </a>
                </li>
            @endif
        @endfor
        <li class="page-item active">
            <a href="{{ $ArrayPaging[$PaginationData->currentPage()] }}"
               class="page-link">
                {{$PaginationData->currentPage()}}
            </a>
        </li>
        @for($i = 1 ; $i <= $PartDir ; $i++)
            @if($PaginationData->currentPage() + $i <= $PaginationData->lastPage())
                <li class="page-item">
                    <a href="{{ $ArrayPaging[$PaginationData->currentPage() + $i] }}"
                       class="page-link">
                        {{$PaginationData->currentPage() + $i}}
                    </a>
                </li>
            @endif
        @endfor
        @if($PaginationData->currentPage() + $PartDir < $PaginationData->lastPage())
            <li class="page-item disabled">
                    <span class="page-link">
                        <em class="icon ni ni-more-h"></em>
                    </span>
            </li>
            <li class="page-item">
                <a href="{{$ArrayPaging[$PaginationData->lastPage()]}}"
                   class="page-link">
                    {{$PaginationData->lastPage()}}
                </a>
            </li>
        @endif
        @if($PaginationData->currentPage() < $PaginationData->lastPage())
            <li class="page-item">
                <a href="{{ $ArrayPaging[$PaginationData->currentPage() + 1] }}"
                   class="page-link">
                    Next
                </a>
            </li>
        @endif
    </ul>
</div>
<div class="g">
    <div class="pagination-goto d-flex justify-content-center justify-content-md-start gx-3">
        <div>
            <label for="SelectPagination">
                Page
            </label>
        </div>
        <div>
            <form action="{{ getRequestUri() }}" method="get">
                @foreach($_GET as $key => $value)
                    @if(is_array($value))
                        @foreach($value as $k => $v)
                            <input type='hidden' name='{{ $key }}[{{$k}}]' value='{{ $v }}' />
                        @endforeach
                    @else
                        <input type='hidden' name='{{ $key }}' value='{{ $value }}' />
                    @endif
                @endforeach
                <select class="FieldsSubmit form-select js-select2" data-search="on"
                        id="SelectPagination" name="page"
                        data-dropdown="xs center" data-placeholder="{{ $PaginationData->currentPage() }}">
                    @for($i = 1 ; $i <= $PaginationData->lastPage() ; $i++)
                        <option value="{{ $i }}"
                            {{ ($PaginationData->currentPage() === $i) ? "selected" : "" }}>
                            {{ $i }}
                        </option>
                    @endfor
                </select>
            </form>
        </div>
        <div>
            OF {{ $PaginationData->lastPage() }}
        </div>
    </div>
</div>
