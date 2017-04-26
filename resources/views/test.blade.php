@extends('layouts.app')

@section('content')
<div class="container">
    <form method = 'POST' id='testform'>
        {{ csrf_field() }}
        <label for='fname'>First Name</label>
        <input type = 'text' id = 'fname' name = 'fname' class = 'form-group'>
        <label for='lname'>Last Name</label>
        <input type = 'text' id = 'lname' name = 'lname' class = 'form-group'>
        <input type ='submit' value = 'Submit'>
    </form>
        
    <div id="postFormData">
        @if ($users != null)
            @foreach ($users as $user)
            <button id="{{$user['fname']}}" >{{$user['lname']}}</button>
            @endforeach
        @endif
        
    </div>
</div>
@endsection
