

@section('content')
@extends('layouts.app')
        <div class="col-md-10">
            <div class="profile-content">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Yeni Etkinlik
                    </div>
                    <div class="panel-body">
                        @include('common.errors')
                        <!-- Form -->
                        <form action="{{ url('/etkn')}}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            <!-- etkn adı -->
                            <div class="form-group">
                                <label for="etkn-ad" class="col-sm-3 control-label" >Etkinlik Adı</label>
                                <div class="col-sm-6">
                                    <input type="text" name="ad" id="etkn-ad" placeholder="Etkinlik Adı" class="form-control" value="{{ old('etkn') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="etkn-yer" class="col-sm-3 control-label" >Etkinlik Yeri</label>
                                <div class="col-sm-6">
                                    <input type="text" name="yer" id="etkn-yer" placeholder="Etkinlik Yeri" class="form-control" value="{{ old('etkn') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="etkn-tarih" class="col-sm-3 control-label" >Tarih</label>
                                <div class="col-sm-6">
                                    <input type="text" name="tarih" id="etkn-tarih" class="form-control" data-format="99/99/9999" data-placeholder="_" placeholder="gg/aa/yyyy" value="{{ old('etkn') }}">
                                </div>
                            </div>
                           <div class="form-group">
                                <label for="etkn-baslama" class="col-sm-3 control-label" >Başlama Saati</label>
                                <div class="col-sm-6">
                                    <input type="text" name="baslama" id="etkn-baslama" class="form-control" data-format="99:99" data-placeholder="_" placeholder="00:00" value="{{ old('etkn') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="etkn-bitis" class="col-sm-3 control-label" >Bitiş Saati</label>
                                <div class="col-sm-6">
                                    <input type="text" name="bitis" id="etkn-bitis" class="form-control" data-format="99:99" data-placeholder="_" placeholder="00:00" value="{{ old('etkn') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="etkn-etkinlikte_ne_kadar_kalinmali" class="col-sm-3 control-label" >Minimum Süre</label>
                                <div class="col-sm-6">
                                    <input type="text" name="etkinlikte_ne_kadar_kalinmali" id="etkn-etkinlikte_ne_kadar_kalinmali" class="form-control"  placeholder="Minimum Süre" value="{{ old('etkn') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="etkn-etkinlik_oncesi_okutma_suresi" class="col-sm-3 control-label" >Etkinlik Öncesi Okutma Süresi</label>
                                <div class="col-sm-6">
                                    <input type="text" name="etkinlik_oncesi_okutma_suresi" id="etkn-etkinlik_oncesi_okutma_suresi" class="form-control"  placeholder="Etkinlik Öncesi Okutma Süresi" value="{{ old('etkn') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="etkn-etkinlik_sonrasi_okutma_suresi" class="col-sm-3 control-label" >Etkinlik Sonrası Okutma Süresi</label>
                                <div class="col-sm-6">
                                    <input type="text" name="etkinlik_sonrasi_okutma_suresi" id="etkn-etkinlik_sonrasi_okutma_suresi" class="form-control"  placeholder="Etkinlik Sonrası Okutma Süresi" value="{{ old('etkn') }}">
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
