<!-- This view is shown when you click forgot my password. Filling your email address and 
hitting submit will trigger a POST. A link will be sent to your email with a token and clicking link will
bring up reset.blade form with new password and confirm password-->


@extends('main')

@section('title', '| Forgot my Password')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Reset Password
                </div>
                <div class="panel-body">
                    {!! Form::open (['url' => 'password/email', 'method' => "POST"]) !!}

                    {{ Form::label ('email', 'Email Address: ') }}
                    {{ Form::email ('email', null, ['class' => 'form-control']) }}

                    {{ Form::submit('Reset Password', ['class' => 'form-spacing-top btn btn-primary']) }}

                    {!! Form::close() !!}

                </div>
        </div>




    </div>






@endsection