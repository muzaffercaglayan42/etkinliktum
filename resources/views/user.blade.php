

@section('content')
@extends('layouts.app')
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Yeni Kayıt</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/usr') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('adsoyad') ? ' has-error' : '' }}">
                            <label for="adsoyad" class="col-md-4 control-label">Ad/Soyad</label>

                            <div class="col-md-6">
                                <input id="adsoyad" type="text" class="form-control" name="adsoyad" placeholder="Ad Soyad" value="{{ old('adsoyad') }}">

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
                                <input id="kartno" type="text" class="form-control" name="kartno" placeholder="Kart No"  value="{{ old('kartno') }}">

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
                                <input id="email" type="email" class="form-control" placeholder="E-Mail" name="email" value="{{ old('email') }}">

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
                                <input id="password" type="password" class="form-control" placeholder="Şifre" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                        <label for="email" class="col-md-4 control-label">Kayıt Tipi</label>
                        <div class="col-md-6">
                            <select class="form-control col-md-4" id="sel1" name="tip" value="{{ old('tip') }}">
                            <option value="1">Öğrenci</option>
                            <option value="2">Akademik Personel</option>
                            <option value="3">İdari Personel</option>
                            </select>
                           
                        </div>

                        </div>
                        <div class="form-group">
                        <label for="email" class="col-md-4 control-label" title="Okuduğu Sınıf">Sınıf</label>
                        <div class="col-md-6">
                            <select class="form-control col-md-4" id="sel1" name="sube" value="{{ old('sube') }}">
                            <option value="0">İdari Personel</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            </select>
                           
                        </div>

                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Kaydet
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
