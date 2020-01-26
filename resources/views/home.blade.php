@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{$s}}

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    axios.get('/api/user').then(function (response) {
        // handle success
        console.log(response);
    }).catch(function (error) {
        // handle error
        console.log(error);
    })
</script>
