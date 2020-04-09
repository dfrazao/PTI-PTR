@extends('layout.base')
@section('content')
<div class="container full-height">
    <h1 class="pt-5 text-center">Login - ADMIN</h1>



    <div class="container" style="width: 35%;">
        <hr style="border-top: 1px solid black; width: 100%;">
        <div action="/action_page.php">
            <div class="form-group">
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd">
            </div>
            <div class="form-group form-check text-center" style="font-size: 13px;">
                <label class="pr-3 form-check-label" style="border-right: 1px solid black;">
                    <input class="form-check-input" type="checkbox" name="remember"> Memorizar Login
                </label>
                <label class="pl-3" style="text-decoration: underline; font-weight: bold; color: #2c3fb1">
                    <p>Recuperar palavra-passe</p>
                </label>
            </div>

            <hr style="border-top: 1px solid black; width: 100%;">
            <div class="text-center">
                <button type="submit" class="btn btn-primary"  style="background:#2c3fb1; width: 47.5%;">Submit</button>
                <button type="submit" class="btn btn-primary" style="background:white; color: black; width: 47.5%;">Limpar</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
