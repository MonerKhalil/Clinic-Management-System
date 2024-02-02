@extends("pages.notification.index")

@section("headerInformation")
    <h4 class="nk-block-title">
        @lang("messages.notification-print")
    </h4>
    <div class="nk-block-des">
        <p>
            @lang("messages.notification-print-description")
        </p>
    </div>
@endsection

@section("contentNotifications")
    <div class="nk-notification">
        @if(count($notifications) > 0)
            @foreach($notifications as $notification)
                @if($notification->data['type'] == "print")
                    <a href="{{url()->to($notification->data['data']['route_name'])}}"
                       class="nk-notification-item dropdown-inner {{!is_null($notification->read_at) ? 'been-read' : 'unread'}}">
                        <div class="nk-notification-icon">
                            <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                        </div>
                        <div class="nk-notification-content">
                            <div class="nk-notification-text">
                                @lang("messages.type") : @lang("messages.print")
                                @lang("messages.from") {{ $notification->data['data']['user_name'] }}
                                <br>
                                @lang("messages".$notification->data['data']['table_name'])
                            </div>
                            <div class="nk-notification-time">
                                {{$notification->data['data']['date']}}
                            </div>
                        </div>
                    </a>
                @endif
            @endforeach
        @else
            <div class="nk-notification-noData">
                <span class="noData-icon">
                    <em class="icon ni ni-sad"></em>
                </span>
                <br>
                <span class="noData-text">
                    @lang("messages.No Data")
                </span>
            </div>
        @endif
    </div>
@endsection

@section("external-form-filter")
    <form class="form-validate"
          action="#" method="get">
        <div class="modal-body">
            @csrf
            <div class="row gy-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="start-date-filter">
                            @lang("messages.start-date-notification")
                        </label>
                        <div class="form-control-wrap">
                            <div class="form-icon form-icon-left">
                                <em class="icon ni ni-calendar"></em>
                            </div>
                            <input name="filter[start_date]" type="date"
                                   id="start-date-filter" readonly
                                   data-DateName="start-date-notification"
                                   class="form-control date-picker startDateCustom"
                                   data-date-format="yyyy-mm-dd"
                                   value="{{ filterDataRequest()["start_date"] ?? "" }}"
                                   placeholder="{{ __('messages.start-date-notification') }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="end-date-filter">
                            @lang("messages.end-date-notification")
                        </label>
                        <div class="form-control-wrap">
                            <div class="form-icon form-icon-left">
                                <em class="icon ni ni-calendar"></em>
                            </div>
                            <input name="filter[end_date]" type="date"
                                   id="end-date-filter" readonly
                                   class="form-control date-picker endDateCustom"
                                   data-date-format="yyyy-mm-dd"
                                   data-DateName="start-date-notification"
                                   value="{{ filterDataRequest()["end_date"] ?? "" }}"
                                   placeholder="{{ __('messages.end-date-notification') }}">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label" for="userName-filter">
                            @lang("messages.username-notification")
                        </label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control"
                                   value="{{ filterDataRequest()["user_name"] ?? "" }}"
                                   placeholder="{{ __("messages.username-notification") }}"
                                   name="filter[user_name]" id="userName-filter">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label" for="tableName-filter">
                            @lang("messages.table-name-notification")
                        </label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control"
                                   value="{{ filterDataRequest()["table_name"] ?? "" }}"
                                   placeholder="{{ __("messages.table-name-notification") }}"
                                   name="filter[table_name]" id="tableName-filter">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label" for="event-filter">
                            @lang("messages.event-notification")
                        </label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control"
                                   value="{{ filterDataRequest()["event"] ?? "" }}"
                                   placeholder="{{ __("messages.event-notification") }}"
                                   name="filter[event]" id="event-filter">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer bg-light">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    @lang("messages.updateData")
                </button>
                <button type="button" class="btn btn-secondary RestFormButton">
                    @lang("messages.Clear Filter")
                </button>
            </div>
        </div>
    </form>
@endsection
