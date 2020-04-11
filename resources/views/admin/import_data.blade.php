@extends('layouts.adminbase')
@section('content')



  <div class="container" >


      <form action="/admin/import/" method="POST">
          {{ csrf_field() }}
          <p>File type accepted (CSV, XML, SQL)</p>
          <div class="form-group">
              <input type="file" class="form-control-file" name="upload-file" id="upload-file" accept=".csv, .sql, .xml">
              <br>

          </div>
      </form>
                    </div>

@endsection