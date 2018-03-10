@extends('layouts.app')

$section('title')
<title>Site map</title>
$endsection

@section('content')
<div class="container">

<div class="row">
  <div class="col-lg-4">
<h3>Laravel</h3>
    <ul>
      <li><a href="{{ url('/') }}/laravel">Laravel code generators</a></li>

    </ul>
  </div>
    <div class="col-lg-4">
      <h3>Android</h3>
      <ul>
        <li><a href="{{ url('/') }}/java">Android code generators</a></li>
      </ul>
    </div>
      <div class="col-lg-4">
        <h3>Mater code</h3>
        <ul>
          <li><a href="{{ url('/') }}/mastercodegenerator">Master code genetaror</a></li>
        </ul>
      </div>

</div>
<br>
<div class="row">
  <div class="col-lg-4">
    <h3>Laravel android</h3>
    <ul>
      <li><a href="{{ url('/') }}/androidlaravel">Laravel android CG</a></li>
    </ul>
  </div>
  <div class="col-lg-4">
<h3>Php string code function tester</h3>
    <ul>
      <li><a href="{{ url('/') }}/laravel/test_php">Tester</a></li>

    </ul>
  </div>
  <div class="col-lg-4">
<h3>Json api backtrack</h3>
    <ul>
      <li><a href="{{ url('/') }}/jsonapibacktrack">Json API backtrack</a></li>

    </ul>
  </div>

</div>

<br>
<div class="row">
  <div class="col-lg-4">
    <h3>Opencart code gen</h3>
    <ul>
      <li><a href="{{ url('/') }}/opencart">Opencart CG</a></li>
    </ul>
  </div>
  <div class="col-lg-4">
    <h3>Add database structure</h3>
    <ul>
      <li><a href="{{ url('/') }}/json_database/add-form">Add new database structure</a></li>
    </ul>
  </div>
  <div class="col-lg-4">

  </div>

</div>
</div>
@endsection
