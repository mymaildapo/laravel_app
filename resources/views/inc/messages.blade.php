@if(count($errors) > 0) <!--i think count errors, count($errors) errors is reserved word so must be call errors ---->
    @foreach($errors->all() as $errorAnyname)
        <div class="alart alert-danger">
            {{$errorAnyname}}
        </div>
    @endforeach
@endif

<!-- this is just to show the div when it succesful-->
@if(session('success'))<!--success its a reserved words -->
        <div class="alert alert-success">
            {{session('success')}} ,<!--This will amke it show the div --->
        </div>
@endif

@if(session('error')) <!--error i think its a reserved words -->
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
@endif

