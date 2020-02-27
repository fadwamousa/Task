@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">


                    <form method="POST" action="{{route('noteall')}}">
                        @csrf

                        <div class="from-group">
                            <select class="form-control" id="usersDropdown" 
                                    name="users[]" multiple>
                                <option value=""></option> 
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">
                                              {{$user->name}}
                                        </option>
                                    @endforeach
                            </select>
                        </div>

                        


                    <button class="btn btn-primary">Send</button>
                        
                    </form>
                   
                </div>
                <br>
                <br>
                <div class="card-body">
                    <form method="POST" action="{{route('note_to_device')}}">
                        @csrf
                          <div class="from-group">
                            <select class="form-control" id="usersDropdown" 
                                    name="users[]">
                                <option value=""></option> 
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">
                                              {{$user->name}}
                                        </option>
                                    @endforeach
                            </select>
                        </div>

                        <button class="btn btn-danger">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
