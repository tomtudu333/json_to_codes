@extends('layouts.app')
$section('title')
<title>Laravel code gen</title>
$endsection

@section('content')

<br><br><br><br>
<div class="container">

        <form action="{{ url('/') }}/json_database/add" method="post" >
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
              <div >
              	<b> Database Structure : </b> 
              	<textarea name="json_table_data" id="json_table_data_field" style="width:700px; height:700px;">
              		{{old('json_table_data') }}
              	</textarea>

              </div>
              <br>
              <div ><b> Database Name : </b> <input type="text" name="database_name" id="database_name_field" value="{{old('database_name') }}"></div>
              <br>
              <button type="submit" class="btn btn-primary" id="add_btn">ADD</button>
            </div>
        </form >

</div>
<br><br>
Here the line ends !
@endsection
