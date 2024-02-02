<tr class="nk-tb-item">
    <td class="nk-tb-col nk-tb-col-check">
        <div class="custom-control custom-control-sm custom-checkbox notext">
            <input type="checkbox" class="custom-control-input" value="{{ $dataShow->id }}"
                   name="[ids]" id="RowData{{ $dataShow->id }}">
            <label class="custom-control-label" for="RowData{{ $dataShow->id }}"></label>
        </div>
    </td>
    <td class="nk-tb-col">
        <span>{{ $dataShow->id }}</span>
    </td>
    @foreach (ignoreFieldsShow($fields) as $field => $type)
        @php
            if (is_string($type)){
                 $type = explode('|' , $type);
                 $validation = $type[1] ?? '';
                 $type = $type[0];
             } else{
                 $validation = '';
             }
        @endphp
        @if ($type === 'image')
            <td class="nk-tb-col">
                @if (!is_null($item->$field))
                    <a class="btn btn-round btn-icon btn-sm btn-info btn-dim popup-image"
                       href="{{ pathStorage(checkObjectInstanceofTranslation($item,$field)) }}">
                            <span class="px-1">
                                {{ __("messages.open_image") }}
                            </span>
                    </a>
                @else
                    <span class="badge badge-dim bg-danger p-1">
                            <em class="icon ni ni-alert-circle"></em>
                            <span>{{ __("messages.no_image") }}</span>
                        </span>
                @endif
            </td>
        @elseif($type === 'file')
            <td class="nk-tb-col">
                @if (!is_null($item->$field))
                    <a href="{{ route("download.file") }}?path={{ checkObjectInstanceofTranslation($item,$field) }}"
                       target="_blank"
                       class="btn btn-round btn-icon btn-sm btn-primary btn-dim">
                        <em class="icon ni ni-download"></em>
                    </a>
                @else
                    <span class="badge badge-dim bg-danger p-1">
                            <em class="icon ni ni-alert-circle"></em>
                            <span>{{ __("messages.no_file") }}</span>
                        </span>
                @endif
            </td>
        @elseif($field == 'is_active')
            <td class="nk-tb-col">
                    <span class="badge badge-dot {{ ($item->{$field})? "bg-success" : "bg-danger" }}">
                        {{ ($item->{$field})? __("messages.active") : __("messages.deActivate") }}
                    </span>
            </td>
        @elseif (is_array($type) && isset($type['relation']))
            <td class="nk-tb-col">
                @if (isset($item->{$type['relation']['relationFunc']}))
                    <span>
                            {{ checkObjectInstanceofTranslation($item->{$type['relation']['relationFunc']},$type['relation']['value']) }}
                        </span>
                @else
                    <span>
                            {{ checkObjectInstanceofTranslation($item,$field) }}
                        </span>
                @endif
            </td>
        @elseif (is_array($type) && isset($type['select']))
            <td class="nk-tb-col">
                {{ checkObjectInstanceofTranslation($item,$field) ?? "-" }}
            </td>
        @elseif ($type == 'editor')
            <td class="nk-tb-col">
                <a href="#" class="btn btn-round btn-icon btn-sm btn-info btn-dim"
                   data-bs-target="#show-text-modal"
                   data-bs-toggle="modal"
                   data-header-modal="{{ __($field) }}"
                   data-body-modal="{{ checkObjectInstanceofTranslation($item,$field) }}">
                    <span class="px-2">{{ __("messages.$field") }}</span>
                </a>
            </td>
        @elseif(!is_array($type))
            <td class="nk-tb-col">
                {{ checkObjectInstanceofTranslation($item,$field) }}
            </td>
        @endif
    @endforeach
    <td class="nk-tb-col">
        <span>{{ $item->userUpdatedBy->name ?? '-' }}</span>
    </td>
</tr>
