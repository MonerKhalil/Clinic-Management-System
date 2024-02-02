@php
    $success = Success();
@endphp
@if (!is_null($success))
    <div class="card-preview">
        <div class="card-inner px-0">
            <div class="gy-4">
                <div class="alert alert-success alert-icon alert-dismissible">
                    <em class="icon ni ni-check-circle"></em>
                    <strong>Success Operation</strong> ! {{ $success }}.
                    <button class="close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        </div>
    </div>
@endif
