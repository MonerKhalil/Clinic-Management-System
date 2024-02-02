@php
    $errors = Error();
@endphp
@if (!is_null($errors))
    <div class="card-preview">
        <div class="card-inner px-0">
            <div class="example-alerts">
                <div class="gy-4">
                    <div class="alert alert-danger alert-icon alert-dismissible">
                        <em class="icon ni ni-cross-circle"></em>
                        <strong>Errors Server</strong>
                        @if(is_array($errors))
                            @foreach ($errors as $key => $error)
                                @if(is_array($error))
                                    @foreach($error as $value)
                                        {{$key}} => {{ $value }} <br>
                                    @endforeach
                                @else
                                    {{ $error }} <br>
                                @endif
                            @endforeach
                        @else
                            {{ $errors }} <br>
                        @endif
                        <button class="close" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
