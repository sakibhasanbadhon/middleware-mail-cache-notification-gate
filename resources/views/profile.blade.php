@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        <h4 class="mb-0">Profile</h4>
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th scope="col">Sl</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Roll</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Address</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($student as $item)
                                    <tr>
                                        <th scope="row"> {{ $loop->index+1 }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->roll }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ $item->address }}</td>
                                    </tr>
                                @endforeach


                            </tbody>

                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
