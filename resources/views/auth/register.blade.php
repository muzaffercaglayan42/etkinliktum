@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    <div class="col-md-2">
            <div class="profile-sidebar">
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li class="active">
                            <a href="#">
                            <i class="glyphicon glyphicon-home"></i>
                            Anasayfa </a>
                        </li>
                        <li>
                            <a href="{{ url('/userlistele') }}">
                            <i class="glyphicon glyphicon-list"></i>
                            Kullanıcı Listele </a>
                        </li>
                        <li>
                            <a href="{{ url('/etkinlikekle') }}">
                            <i class="glyphicon glyphicon-ok"></i>
                            Etkinlik Ekle </a>

                        </li>
                         <li>
                            <a href="{{ url('/etkinliklistele') }}">
                            <i class="glyphicon glyphicon-list"></i>
                            Etkinlik Listele </a>

                        </li>
                        <li>
                            <a href="#">
                            <i class="glyphicon glyphicon-flag"></i>
                            Etkinlik Durum </a>
                        </li>
                    </ul>
                </div>
                <!-- END MENU -->
            </div>
        </div>
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Yeni Kayıt</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('adsoyad') ? ' has-error' : '' }}">
                            <label for="adsoyad" class="col-md-4 control-label">Ad/Soyad</label>

                            <div class="col-md-6">
                                <input id="adsoyad" type="text" class="form-control" name="adsoyad" value="{{ old('adsoyad') }}">

                                @if ($errors->has('adsoyad'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('adsoyad') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('kartno') ? ' has-error' : '' }}">
                            <label for="kartno" class="col-md-4 control-label">Kart No</label>

                            <div class="col-md-6">
                                <input id="kartno" type="text" class="form-control" name="kartno" value="{{ old('kartno') }}">

                                @if ($errors->has('kartno'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kartno') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Şifre</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label" >Tekrar Şifre</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                        <label for="email" class="col-md-4 control-label">Kayıt Tipi</label>
                        <div class="col-md-6">
                            <select class="form-control col-md-4" id="sel1" name="tip" value="{{ old('tip') }}">
                            <option value="1">Öğrenci</option>
                            <option value="2">AkademikPersonel</option>
                            <option value="3">İdari Personel</option>
                            </select>
                           
                        </div>

                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Kayıt Ol
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
