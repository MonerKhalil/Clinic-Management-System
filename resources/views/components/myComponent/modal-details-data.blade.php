{{--
    $RowsData => [
        [
            custom-type => string ,
            details-name => string ,
            key-details-name => string
        ]
    ]
--}}

<div class="modal fade" tabindex="-1" role="dialog"
     id="show-details-modal">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header align-center">
                <a href="#" class="close" data-bs-dismiss="modal">
                    <em class="icon ni ni-cross-sm"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-file-details">
                    <div class="row">
                        @foreach($RowsData as $Row)
                            <div class="col-md-6">
                                <div class="nk-file-details-row"
                                     @if(isset($Row["custom-type"]))
                                        data-type-custom="{{ $Row["custom-type"] }}"
                                     @endif
                                     data-details="{{ $Row["key-details-name"] }}">
                                    <div class="nk-file-details-col width-fit-content">{{ $Row["details-name"] }} : </div>
                                    <div class="nk-file-details-col">
                                        @if(isset($Row["custom-type"]))
                                            @switch($Row["custom-type"])
                                                @case("image")
                                                    <a href="#" class="popup-image">
                                                        @lang("messages.view-image")
                                                    </a>
                                                @break
                                            @endswitch
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-stretch bg-light">
                <div class="modal-footer-between">
                    <div class="g">
                        <ul class="btn-toolbar g-3">
                            <li>
                                <div class="btn btn-secondary" data-bs-dismiss="modal">
                                    @lang("messages.close")
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
