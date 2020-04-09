@extends('layouts.adminbase')
@section('content')



  <div class="container" >


                      <form style="margin-left: 10%; margin-right:auto; margin-bottom: 5%;margin-top: 5%;">
                        <h4>Import Data (CSV, XLS, XLSX, XML, SQL)</h4>
                        <div class="form-group">
                          <input type="file" class="form-control-file" id="exampleFormControlFile1" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel, .sql, .xml">
                          <br>
                          <button type="submit" class="btn btn-primary">Import Data</button>

                        </div>
                      </form>
                    </div>

@endsection