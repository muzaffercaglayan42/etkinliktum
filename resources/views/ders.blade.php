

@section('content')
@extends('layouts.app')
        <div class="col-md-10">
            <div class="profile-content">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Yeni Ders Ekle
                    </div>
                    <div class="panel-body">
                        @include('common.errors')
                        <!-- Form -->
                        <form action="{{ url('/drs')}}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            <!-- drs adı -->
                            <div class="form-group">
                                <label for="drs-ad" class="col-sm-3 control-label" >Ders Adı</label>
                                <div class="col-sm-6">
                                    <input type="text" name="ad" id="drs-ad" placeholder="Etkinlik Adı" class="form-control" value="{{ old('drs') }}">
                                </div>
                            </div>
                            <div class="form-group">
                            <label for="email" class="col-md-3 control-label">Sınıf</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="sel1" name="sinif" value="{{ old('sinif') }}">
                                <option value="1" >1</option>
                                <option value="2" >2</option>
                                <option value="3" >3</option>
                                <option value="4" >4</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group">
                            <label for="email" class="col-md-3 control-label">Şube</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="sel1" name="sube" value="{{ old('sube') }}">
                                <option value="A" >A</option>
                                <option value="B" >B</option>
                                <option value="C" >C</option>
                                <option value="D" >D</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group">
                            <label for="drs-ogr_elemani" class="col-sm-3 control-label">Ders Öğretim Elemanı</label>
                            <div class="col-sm-6">
                                 <select class="selectpicker form-control"  data-live-search="true" name="ogr_elemani" >
	                     @foreach($ogrelemani as $person)                        	
	                              <option value="{{ $person->id }}">{{$person->adsoyad}}</option>
	                        @endforeach
	                        
                    	</select>
                    	  </div>
                        </div>
                            <!-- ekle Button -->
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6 pull-right">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-btn fa-plus"></i>Ekle
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection