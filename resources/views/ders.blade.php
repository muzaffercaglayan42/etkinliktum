

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
                                <label for="drs-yer" class="col-sm-3 control-label" >Ders Yeri</label>
                                <div class="col-sm-6">
                                    <input type="text" name="yer" id="drs-yer" placeholder="Ders Yeri" class="form-control" value="{{ old('drs') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="drs-tarih" class="col-sm-3 control-label" >İlk Ders Tarihi</label>
                                <div class="col-sm-6">
                                    <input type="text" name="ilktarih" id="drs-tarih" class="form-control" data-format="99/99/9999" data-placeholder="_" placeholder="gg/aa/yyyy" value="{{ old('drs') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="drs-tarih" class="col-sm-3 control-label" >Son Ders Tarihi</label>
                                <div class="col-sm-6">
                                    <input type="text" name="sontarih" id="drs-tarih" class="form-control" data-format="99/99/9999" data-placeholder="_" placeholder="gg/aa/yyyy" value="{{ old('drs') }}">
                                </div>
                            </div>
                           <div class="form-group">
                                <label for="drs-baslama" class="col-sm-3 control-label" >Başlama Saati</label>
                                <div class="col-sm-6">
                                    <input type="text" name="baslama" id="drs-baslama" class="form-control" data-format="99:99" data-placeholder="_" placeholder="00:00" value="{{ old('drs') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="drs-bitis" class="col-sm-3 control-label" >Bitiş Saati</label>
                                <div class="col-sm-6">
                                    <input type="text" name="bitis" id="drs-bitis" class="form-control" data-format="99:99" data-placeholder="_" placeholder="00:00" value="{{ old('drs') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="drs-etkinlikte_ne_kadar_kalinmali" class="col-sm-3 control-label" >Minimum Süre</label>
                                <div class="col-sm-6">
                                    <input type="text" name="etkinlikte_ne_kadar_kalinmali" id="drs-etkinlikte_ne_kadar_kalinmali" class="form-control"  placeholder="Minimum Süre" value="{{ old('drs') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="drs-etkinlik_oncesi_okutma_suresi" class="col-sm-3 control-label" >Ders Öncesi Okutma Süresi</label>
                                <div class="col-sm-6">
                                    <input type="text" name="etkinlik_oncesi_okutma_suresi" id="drs-etkinlik_oncesi_okutma_suresi" class="form-control"  placeholder="Ders Öncesi Okutma Süresi" value="{{ old('drs') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="drs-etkinlik_sonrasi_okutma_suresi" class="col-sm-3 control-label" >Ders Sonrası Okutma Süresi</label>
                                <div class="col-sm-6">
                                    <input type="text" name="etkinlik_sonrasi_okutma_suresi" id="drs-etkinlik_sonrasi_okutma_suresi" class="form-control"  placeholder="Ders Sonrası Okutma Süresi" value="{{ old('drs') }}">
                                </div>
                            </div>
                            <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Sınıf</label>
                                <select class="form-control" id="sel1" name="sube" value="{{ old('sube') }}">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                </select>
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
