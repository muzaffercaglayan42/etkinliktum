

@section('content')
@extends('layouts.app')
            <!-- Liste -->
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Dersler
                         <div class="pull-right">    
                            <form class="navbar-form navbar-left"  action="{{ url('/derslistele')}}" method="POST"  role="search">
                             {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="text" class="form-control" name="search" placeholder="Ara">
                                </div>
                                <button type="submit" class="btn btn-default">Bul</button>
                            </form>
                        </div>
                    </div>
                        @if (count($ders) > 0)
                        <div class="panel-body">
                            <table class="table table-striped drs-table">
                                <thead>
                                    <th>Ders Adı</th>
                                    <th>Ders Yeri</th>
                                    <th>Ders Tarihi</th>
                                    <th>Başlama Saati</th>
                                    <th>Bitiş Saati</th>
                                    <th>Minimum Süre</th>
                                    <th>&nbsp;</th>
                                </thead>
                                <tbody>
                                    @foreach ($ders as $drs)
                                        <tr>
                                            <td class="table-text"><div>{{ $drs->ad }}</div></td>
                                            <td class="table-text"><div>{{ $drs->yer }}</div></td>
                                            <td class="table-text"><div>{{ $drs->tarih }}</div></td>
                                            <td class="table-text"><div>{{ $drs->baslama }}</div></td>
                                            <td class="table-text"><div>{{ $drs->bitis }}</div></td>
                                            <td class="table-text"><div>{{ $drs->etkinlikte_ne_kadar_kalinmali }}</div></td>

                                            <!-- Düzelt -->
                                            <td>
                                                <form action="{{ url('drs/duzelt/'.$drs->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <button 
                                                       type="button" 
                                                       class="btn btn-primary pull-right" 
                                                       data-toggle="modal"
                                                       data-target="#duzeltModal{{$drs->id}}">
                                                      <i class="fa fa-btn fa-edit " ></i>Düzelt
                                                 </button>
                                                </form>
                                            </td>
                                            <!-- Sil -->
                                             <td>
                                                <form action="{{ url('drs/sil/'.$drs->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button 
                                                       type="button" 
                                                       class="btn btn btn-danger pull-right" 
                                                       data-toggle="modal"
                                                       data-target="#silModal{{$drs->id}}">
                                                      <i class="fa fa-btn fa-trash pull-right " ></i>Sil
                                                 </button>
                                                </form>
                                            </td>
                                            <!-- Düzelt Modal -->
                                        </tr>
                                    <div class="modal fade" id="duzeltModal{{$drs->id}}" 
                                         tabindex="-1" role="dialog" 
                                         aria-labelledby="favoritesModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" 
                                                      data-dismiss="modal" 
                                                      aria-label="Close">
                                                      <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="favoritesModalLabel">Düzeltme</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ url('drs/duzelt/'.$drs->id)}}" method="POST" >
                                                        {{ csrf_field() }}
                                                        <!-- drs adı -->
                                                        <div class="form-group">
                                                            <label for="drs-ad" class="col-sm-3 control-label">Ders Adı</label>
                                                                <input type="text" name="ad" id="drs-ad" class="form-control" value="@if(count(@$drs)>0){{$drs->ad}}@else{{old('ad')}}@endif">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="drs-yer" class="col-sm-3 control-label">Ders Yeri</label>
                                                                <input type="text" name="yer" id="drs-yer" class="form-control" value="@if(count(@$drs)>0){{$drs->yer}}@else{{old('yer')}}@endif">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="drs-tarih" class="col-sm-3 control-label">İlk Ders Tarih</label>
                                                                <input type="text" name="tarih" id="drs-tarih" class="form-control" value="@if(count(@$drs)>0){{$drs->tarih}}@else{{old('tarih')}}@endif">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="drs-tarih" class="col-sm-3 control-label">Son Ders Tarihi</label>
                                                                <input type="text" name="tarih" id="drs-tarih" class="form-control" value="@if(count(@$drs)>0){{$drs->tarih}}@else{{old('tarih')}}@endif">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="drs-baslama" class="col-sm-3 control-label">Başlama Saati</label>
                                                                <input type="text" name="baslama" id="drs-baslama" class="form-control" value="@if(count(@$drs)>0){{$drs->baslama}}@else{{old('baslama')}}@endif">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="drs-bitis" class="col-sm-3 control-label">Bitiş Saati</label>
                                                                <input type="text" name="bitis" id="drs-bitis" class="form-control" value="@if(count(@$drs)>0){{$drs->bitis}}@else{{old('bitis')}}@endif">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="drs-etkinlikte_ne_kadar_kalinmali" class="col-sm-3 control-label">Minimum Süre</label>
                                                                <input type="text" name="etkinlikte_ne_kadar_kalinmali" id="drs-etkinlikte_ne_kadar_kalinmali" class="form-control" value="@if(count(@$drs)>0){{$drs->etkinlikte_ne_kadar_kalinmali}}@else{{old('etkinlikte_ne_kadar_kalinmali')}}@endif">
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
                                                        <div class="modal-footer">
                                                            <div class="col-sm-offset-3 col-sm-6">
                                                                <button type="submit" class="btn btn-default">
                                                                    <i class="fa fa-btn fa-edit"></i>Düzelt
                                                                </button>
                                                                <button type="button" 
                                                               class="btn btn-danger" 
                                                               data-dismiss="modal">Kapat</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Sil Modal -->
                                    <div class="modal fade" id="silModal{{$drs->id}}" 
                                         tabindex="-1" role="dialog" 
                                         aria-labelledby="favoritesModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" 
                                                      data-dismiss="modal" 
                                                      aria-label="Close">
                                                      <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="favoritesModalLabel">Sil</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ url('drs/sil/'.$drs->id) }}" method="POST" >
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <!-- etkn adı -->
                                                        <div class="form-group">
                                                            <label >Silmek İstediğinizden Emin misiniz?</label>
                                                        </div>
                                                        <!-- ekle Button -->
                                                        <div class="modal-footer">
                                                            <div class="col-sm-offset-3 col-sm-6">
                                                                <button type="submit" class="btn btn-default">
                                                                    <i class="fa fa-btn fa-trash"></i>Evet
                                                                </button>
                                                                <button type="button" 
                                                               class="btn btn-danger" 
                                                               data-dismiss="modal">Kapat</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="container">
                        @else <br><br><div> <div class="alert alert-info" href="#">Gösterilecek Kayıt Bulunamadı. </div></div>
                        @endif
                        </div>
                    <center><?php echo $ders->render(); ?></center>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>


@endsection
