<div class="MultiSelector" id="{{$SelectID}}" aria-label="{{$Label}}">
    <div class="MultiSelector__Main">
        <div class="MultiSelector__WordLabel">{{$Label}}</div>
        <div class="MultiSelector__WordChoose"></div>
        <i class="fa-solid fa-caret-down MultiSelector__Arrow"></i>
    </div>
    @php
        $Counter = 0 ;
    @endphp
    <ul class="MultiSelector__Options">
        <li class="MultiSelector__Option MultiSelector__Option--SelectAll">
            <input id="AllSelect_{{$SelectID}}" name="_"
                   class="MultiSelector__InputCheckBox"
                   type="checkbox" value="" hidden>
            <label for="AllSelect_{{$SelectID}}" class="MultiSelector__Label">
                    <span class="MultiSelector__CheckBox">
                        <i class="fa-solid fa-check"></i>
                    </span>
                <span class="MultiSelector__Title">تحديد الكل</span>
            </label>
        </li>
        @if(isset($Options))
            @foreach($Options as $Option)
                <li class="MultiSelector__Option">
                    <input id="Option{{$Counter}}" name="{{$Option['Name']}}"
                           class="MultiSelector__InputCheckBox"
                           type="checkbox" value="{{$Option['Value']}}"
                           {{isset($Option['IsChecked']) && $Option['IsChecked'] ? "checked" : ""}}
                           hidden>
                    <label for="Option{{$Counter}}" class="MultiSelector__Label">
                    <span class="MultiSelector__CheckBox">
                        <i class="fa-solid fa-check"></i>
                    </span>
                        <span class="MultiSelector__Title">{{$Option['Label']}}</span>
                    </label>
                </li>
                @php
                    $Counter++ ;
                @endphp
            @endforeach
        @endif
    </ul>
</div>
