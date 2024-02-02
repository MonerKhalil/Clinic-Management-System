<tr class="nk-tb-item nk-tb-head">
    <th class="nk-tb-col nk-tb-col-check">
        <div class="custom-control custom-control-sm custom-checkbox notext">
            <input type="checkbox" class="custom-control-input" id="CheckboxHeaderTable">
            <label class="custom-control-label" for="CheckboxHeaderTable"></label>
        </div>
    </th>
    <th class="nk-tb-col">
        <span class="sub-text">#</span>
    </th>
    @foreach(ignoreFieldsShow($fields) as $field => $type)
        <th class="nk-tb-col">
            <span class="sub-text">
                @if(!is_array($type) || !isset($type['table']))
                    {{__("messages.$field")}}
                @endif
            </span>
        </th>
    @endforeach
    <th class="nk-tb-col">
        <span>{{__('messages.edited_by')}}</span>
    </th>
    <th class="nk-tb-col nk-tb-col-tools text-end"></th>
</tr>
