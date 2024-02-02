@if(!(isset($hiddenSection) && in_array("sectionBodyTable" , $hiddenSection)))
    @php
        $checkCanUpdate = userHasPermission("update_{$fields['config']['table']}") || userHasPermission("all_{$fields['config']['table']}");
        $checkCanForceDelete = userHasPermission("force_delete_{$fields['config']['table']}") || userHasPermission("all_{$fields['config']['table']}");
        $checkCanDelete = userHasPermission("delete_{$fields['config']['table']}") || userHasPermission("all_{$fields['config']['table']}");
    @endphp
    @if(isset($dataShow))
        <tr class="nk-tb-item">
            <td class="nk-tb-col nk-tb-col-check">
                <div class="custom-control custom-control-sm custom-checkbox notext">
                    <input type="checkbox" class="custom-control-input" value="{{ $dataShow["id"] }}"
                           name="ids[]" id="RowData{{ $dataShow["id"] }}">
                    <label class="custom-control-label" for="RowData{{ $dataShow["id"] }}"></label>
                </div>
            </td>
            <td class="nk-tb-col">
                1
            </td>
            @foreach (ignoreFieldsShow($fields) as $field => $type)
                @php
                    if (is_string($type)) {
                        $type = explode('|', $type);
                        $tempType = $type[0];
                        unset($type[0]);
                        $validation = isset($type[1]) ? implode(' ', $type) : '';
                        $type = $tempType;
                    } else {
                        $validation = '';
                    }
                @endphp
                @if ($type === 'image')
                    <td class="nk-tb-col">
                        @if (!is_null($dataShow->$field))
                            <a class="btn btn-round btn-icon btn-sm btn-info btn-dim popup-image"
                               href="{{ pathStorage(checkObjectInstanceofTranslation($dataShow,$field)) }}">
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
                        @if (!is_null($dataShow->$field))
                            <a href="{{ route("download.file") }}?path={{ checkObjectInstanceofTranslation($dataShow,$field) }}"
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
                    <span class="badge badge-dot {{ ($dataShow->{$field})? "bg-success" : "bg-danger" }}">
                        {{ ($dataShow->{$field})? __("messages.active") : __("messages.deActivate") }}
                    </span>
                    </td>
                @elseif (is_array($type) && isset($type['relation']))
                    <td class="nk-tb-col">
                        @if (isset($dataShow->{$type['relation']['relationFunc']}))
                            <span>
                            {{ checkObjectInstanceofTranslation($dataShow->{$type['relation']['relationFunc']},$type['relation']['value']) }}
                        </span>
                        @else
                            <span>
                            {{ checkObjectInstanceofTranslation($dataShow,$field) }}
                        </span>
                        @endif
                    </td>
                @elseif (is_array($type) && isset($type['select']))
                    <td class="nk-tb-col">
                        @if(checkObjectInstanceofTranslation($dataShow,$field) !== null)
                            @lang("messages." . (checkObjectInstanceofTranslation($dataShow,$field)))
                        @else
                            -
                        @endif
                    </td>
                @elseif ($type == 'editor')
                    <td class="nk-tb-col">
                        <a href="#" class="btn btn-round btn-icon btn-sm btn-info btn-dim"
                           data-bs-target="#show-text-modal"
                           data-bs-toggle="modal"
                           data-header-modal="{{ __($field) }}"
                           data-body-modal="{{ checkObjectInstanceofTranslation($dataShow,$field) }}">
                            <span class="px-2">{{ __("messages.$field") }}</span>
                        </a>
                    </td>
                @elseif(!is_array($type))
                    <td class="nk-tb-col">
                        {{ checkObjectInstanceofTranslation($dataShow,$field) }}
                    </td>
                @endif
            @endforeach
            <td class="nk-tb-col">
                <span>{{ $dataShow->userUpdatedBy->name ?? '-' }}</span>
            </td>
            <td class="nk-tb-col nk-tb-col-tools">
                <ul class="nk-tb-actions gx-1">
                    <li>
                        <div class="drodown">
                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                               data-bs-target=""
                               data-bs-toggle="dropdown">
                                <em class="icon ni ni-more-h"></em>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <ul class="link-list-opt no-bdr">
                                    @if($checkCanUpdate)
                                        <li>
                                            <a href="{{ route($route['edit'], $dataShow->id) }}">
                                                <em class="icon ni ni-pen"></em>
                                                <span>{{ __('messages.EditInfo') }}</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if($checkCanDelete)
                                        <li>
                                            <a href="#" data-bs-toggle="modal"
                                               data-bs-target="#show-delete-modal"
                                               data-formAction-modal="{{ route($route['destroy'], $dataShow->id) }}">
                                                <em class="icon ni ni-trash"></em>
                                                <span>{{ __('messages.DeleteInfo_Soft') }}</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if($checkCanForceDelete)
                                        <li>
                                            <a href="#" data-bs-toggle="modal"
                                               data-bs-target="#show-forceDelete-modal"
                                               data-formAction-modal="{{ route($route['force_delete'], $dataShow->id) }}">
                                                <em class="icon ni ni-trash"></em>
                                                <span>{{ __('messages.DeleteInfo_Force') }}</span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </td>
        </tr>
    @else
        @foreach ($data as $key => $item)
            <tr class="nk-tb-item">
                <td class="nk-tb-col nk-tb-col-check">
                    <div class="custom-control custom-control-sm custom-checkbox notext">
                        <input type="checkbox" class="custom-control-input" value="{{ $item["id"] }}"
                               name="ids[]" id="RowData{{ $item["id"] }}">
                        <label class="custom-control-label" for="RowData{{ $item["id"] }}"></label>
                    </div>
                </td>
                <td class="nk-tb-col">
                    <span>{{$loop->iteration}}</span>
                </td>
                @foreach (ignoreFieldsShow($fields) as $field => $type)
                    @php
                        if (is_string($type)) {
                            $type = explode('|', $type);
                            $tempType = $type[0];
                            unset($type[0]);
                            $validation = isset($type[1]) ? implode(' ', $type) : '';
                            $type = $tempType;
                        } else {
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
                            @if(checkObjectInstanceofTranslation($item,$field) !== null)
                                @lang("messages." . (checkObjectInstanceofTranslation($item,$field)))
                            @else
                                -
                            @endif
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
                <td class="nk-tb-col nk-tb-col-tools">
                    <ul class="nk-tb-actions gx-1">
                        <li>
                            <div class="drodown">
                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                                   data-bs-target=""
                                   data-bs-toggle="dropdown">
                                    <em class="icon ni ni-more-h"></em>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <ul class="link-list-opt no-bdr">
                                        @if($checkCanUpdate)
                                            <li>
                                                <a href="{{ route($route['edit'], $item->id) }}">
                                                    <em class="icon ni ni-pen"></em>
                                                    <span>{{ __('messages.EditInfo') }}</span>
                                                </a>
                                            </li>
                                        @endif
                                        @if($checkCanDelete)
                                            <li>
                                                <a href="#" data-bs-toggle="modal"
                                                   data-bs-target="#show-delete-modal"
                                                   data-formAction-modal="{{ route($route['destroy'], $item->id) }}">
                                                    <em class="icon ni ni-trash"></em>
                                                    <span>{{ __('messages.DeleteInfo_Soft') }}</span>
                                                </a>
                                            </li>
                                        @endif
                                        @if($checkCanForceDelete)
                                            <li>
                                                <a href="#" data-bs-toggle="modal"
                                                   data-bs-target="#show-forceDelete-modal"
                                                   data-formAction-modal="{{ route($route['force_delete'], $item->id) }}"
                                                >
                                                    <em class="icon ni ni-trash"></em>
                                                    <span>{{ __('messages.DeleteInfo_Force') }}</span>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </td>
            </tr>
        @endforeach
    @endif
@else
    @yield("custom-body-table")
@endif
