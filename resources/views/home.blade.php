@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h2>Home </h2> <a href="{{ url('notification') }}">Sent email/notification</a>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                        <form action="{{ route('file.upload') }}" method="POST" enctype="multipart/form-data">
                          @csrf

                            <div class="d-flex align-items-center">
                                <div class="mb-3">
                                    <img height="100px" width="100px" id="pic" />
                                    <label for="avatar" class="form-label"> File Upload</label>
                                    <input type="file" name="avatar" id="avatar" class="form-control form-control-sm" oninput="pic.src=window.URL.createObjectURL(this.files[0])" >
                                </div>

                                <button class="btn btn-primary btn-sm mt-5 ms-3" type="submit"> Upload </button>

                            </div>


                        </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
