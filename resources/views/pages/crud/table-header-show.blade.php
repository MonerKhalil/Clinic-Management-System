<tr class="Item Item__Header">
    <th class="th-sticky Item__Col">#</th>
    @foreach(ignoreFieldsShow($fields) as $field => $type)
        <th class="{{$field}} th-sticky Item__Col">
            <div class="Item__Content">
                <div class="Item__Top">
                    <div class="Item__Title" >
                        <label>
                            @if(!is_array($type) || !isset($type['table']))
                                {{__($field)}}
                            @endif
                        </label>
                    </div>
                </div>
            </div>
        </th>
    @endforeach
    <th class="th-sticky Item__Col">{{__('edited_by')}}</th>
</tr>
