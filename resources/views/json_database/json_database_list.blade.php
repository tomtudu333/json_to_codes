@extends('layouts.app')
$section('title')
<title>Laravel code gen</title>
$endsection

@section('content')

<br><br><br><br>
<div class="container">
<table class="table table-striped" style="">
  <thead  style="">
    <tr>
     <td style="position: relative;left:0px; ">S.NO.</td>
     <td style="position: relative;left:0px; ">Name</td>
      <td style="font-size:15px;font-weight:bold;">Edit</td>
      <td style="font-size:15px;font-weight:bold;">Delete</td>      
    </tr>
  </thead>
  <tbody>

    @foreach($json_table_list as $table_data)

          <tr>
            <th scope="row">{{ $table_data->id }}</th>
            <th scope="row">{{ $table_data->database_name }}</th>
            <td><a href="{{ url('/') }}/json_database/edit/{{ $table_data->id }}" type="button" class="btn btn-primary">Edit</a></td>
          <td><a href="{{ url('/') }}/json_database/delete/{{ $table_data->id }}" type="button" class="btn btn-danger">Delete</a></td>
          </tr>

    @endforeach
    

  </tbody>
</table>


</div>
<br><br>

@endsection
