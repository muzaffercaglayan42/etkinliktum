

@section('content')
@extends('layouts.app')
            <!-- Liste -->
            @if($status=='durumlist')
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Etkinlikler
                         <div class="pull-right">    
                            <form class="navbar-form navbar-left"  action="{{ url('/etkinlikdurumlistele')}}" method="POST"  role="search">
                             {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="text" class="form-control" name="search" placeholder="Ara">
                                </div>
                                <button type="submit" class="btn btn-default">Bul</button>
                            </form>
                        </div>
                    </div>
                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                    <div class="container">
                      <h3></h3>
                      <a href="#" ><spon style="margin-left: 10px; color: black;"><i class="ion ion-ios-help-outline"  data-toggle="popover" data-html="true" title="<b>Değerlendirme</b>" data-content="• 00:00 – 05:59 arası <b>FF </b></br>• 06:00 – 06:59 arası <b>FD</b></br>• 07:00 – 07:59 arası <b>DD</b></br>• 08:00 – 08:59 arası <b>DC</b></br>• 09:00 – 09:59 arası <b>CC</b></br>• 10:00 – 10:59 arası <b>CB</b></br>• 11:00 – 11:59 arası <b>BB</b></br>• 12:00 – 12:59 arası <b>BA</b></br>• 13:00 ve sonrası <b>AA</b>">Değerlendirme Kriterleri</i></spon></a>
                    </div> 
                    @if($ogrelmanimi=='0')
                    @if ($total>0)
                    <div class="alert alert-info" href="#">Etkinliklerde Toplam: <?php if (floor($total/60)!=0) { echo floor($total/60)." Saat"; }?> {{fmod($total,60)}} Dakika Kaldınız. Notunuz: <?php if(($total/60)<6) echo " <b><u>FF</u></b>"; elseif(($total/60)>=6 and ($total/60)<7)echo " <b><u>FD</u></b>"; elseif(($total/60)>=7 and ($total/60)<8)echo " <b><u>DD</u></b>"; elseif(($total/60)>=8 and ($total/60)<9)echo " <b><u>DC</u></b>"; elseif(($total/60)>=9 and ($total/60)<10)echo " <b><u>CC</u></b>"; elseif(($total/60)>=10 and ($total/60)<11)echo " <b><u>CB</u></b>"; elseif(($total/60)>=11 and ($total/60)<12)echo " <b><u>BB</u></b>"; elseif(($total/60)>=12 and ($total/60)<13)echo " <b><u>BA</u></b>"; elseif(($total/60)>=13) echo " <b><u>AA </u></b>";?></div>
                    @endif
                    @else
                    <div class="alert alert-info" href="#">Toplam {{$etkinlik->total()}} Kayıt getirildi. Toplam {{$etkinlik->lastPage()}} sayfa. Bu sayfada({{$etkinlik->currentPage()}}) {{$etkinlik->count()}} kayıt bulunmaktadır.</div>
                    @endif
                    <script>
                    $(document).ready(function(){
                        $('[data-toggle="popover"]').popover();   
                    });
                    </script>
                        @if (count($etkinlik) > 0)
                        <div class="panel-body">
                            <table class="table table-striped etkn-table">
                                <thead>
                                    <th>Öğrenci No</th>
                                    <th>Ad/Soyad</th>
                                    @if($ogrelmanimi=='0')
                                    <th>Etkinlik Adı</th>
                                    <th>Giriş Saati</th>
                                    <th>Çıkış Saati</th>
                                    @endif
                                    <th>Süre</th>
                                    @if($ogrelmanimi!='0')
                                    <th>Harf Notu</th>
                                    @endif
                                    <th>&nbsp;</th>
                                </thead>
                                <tbody>
                                    @foreach ($etkinlik as $etkn)
                                        <tr>
                                        <th class="table-text"><div>{{ $etkn->ogr_no }}</div></th>
                                            <th class="table-text"><div>{{ $etkn->adsoyad }}</div></th>
                                            @if($ogrelmanimi=='0')
                                            <td class="table-text"><div>{{ $etkn->etkinlik_adi }}</div></td>
                                            <td class="table-text"><div>{{ $etkn->giris }}</div></td>
                                            <td class="table-text"><div>{{ $etkn->cikis }}</div></td>
                                            @endif
                                            
                                            <th>
                                            <span><b><?php if (floor($etkn->sure/60)!=0) { echo floor($etkn->sure/60)." Saat"; }?> {{fmod($etkn->sure,60)}} Dakika</b></span>
                                            </th>
                                            
                                            @if($ogrelmanimi!='0')
                                            <th align="center"><?php if(($etkn->sure/60)<6) echo " <b><u>FF</u></b>"; elseif(($etkn->sure/60)>=6 and ($etkn->sure/60)<7)echo " <b><u>FD</u></b>"; elseif(($etkn->sure/60)>=7 and ($etkn->sure/60)<8)echo " <b><u>DD</u></b>"; elseif(($etkn->sure/60)>=8 and ($etkn->sure/60)<9)echo " <b><u>DC</u></b>"; elseif(($etkn->sure/60)>=9 and ($etkn->sure/60)<10)echo " <b><u>CC</u></b>"; elseif(($etkn->sure/60)>=10 and ($etkn->sure/60)<11)echo " <b><u>CB</u></b>"; elseif(($etkn->sure/60)>=11 and ($etkn->sure/60)<12)echo " <b><u>BB</u></b>"; elseif(($etkn->sure/60)>=12 and ($etkn->sure/60)<13)echo " <b><u>BA</u></b>"; elseif(($etkn->sure/60)>=13) echo " <b><u>AA </u></b>";?></th>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="container">
                        @else <br><br><div> <div class="alert alert-info" href="#">Gösterilecek Kayıt Bulunamadı. </div></div>
                        @endif
                        </div>
                    <center><?php echo $etkinlik->render(); ?></center>
                </div>
            </div>
            @else
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Etkinlikler
                         <div class="pull-right">    
                            <form class="navbar-form navbar-left"  action="{{ url('/etkinliklistele')}}" method="POST"  role="search">
                             {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="text" class="form-control" name="search" placeholder="Ara">
                                </div>
                                <button type="submit" class="btn btn-default">Bul</button>
                            </form>
                        </div>
                    </div>
                        @if (count($etkinlik) > 0)
                        <div class="panel-body">
                            <table class="table table-striped etkn-table">
                                <thead>
                                    <th>Etkinlik Adı</th>
                                    <th>Etkinlik Yeri</th>
                                    <th>Etkinlik Tarihi</th>
                                    <th>Başlama Saati</th>
                                    <th>Bitiş Saati</th>
                                    <th>Minimum Süre</th>
                                    <th>&nbsp;</th>
                                </thead>
                                <tbody>
                                    @foreach ($etkinlik as $etkn)
                                        <tr>
                                            <td class="table-text"><div>{{ $etkn->ad }}</div></td>
                                            <td class="table-text"><div>{{ $etkn->yer }}</div></td>
                                            <td class="table-text"><div>{{ $etkn->tarih }}</div></td>
                                            <td class="table-text"><div>{{ $etkn->baslama }}</div></td>
                                            <td class="table-text"><div>{{ $etkn->bitis }}</div></td>
                                            <td class="table-text"><div>{{ $etkn->etkinlikte_ne_kadar_kalinmali }}</div></td>

                                            <!-- Düzelt -->
                                            <td>
                                                <form action="{{ url('etkn/duzelt/'.$etkn->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <button 
                                                       type="button" 
                                                       class="btn btn-primary pull-right" 
                                                       data-toggle="modal"
                                                       data-target="#duzeltModal{{$etkn->id}}">
                                                      <i class="fa fa-btn fa-edit " ></i>Düzelt
                                                 </button>
                                                </form>
                                            </td>
                                            <!-- Sil -->
                                             <td>
                                                <form action="{{ url('etkn/sil/'.$etkn->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button 
                                                       type="button" 
                                                       class="btn btn btn-danger pull-right" 
                                                       data-toggle="modal"
                                                       data-target="#silModal{{$etkn->id}}">
                                                      <i class="fa fa-btn fa-trash pull-right " ></i>Sil
                                                 </button>
                                                </form>
                                            </td>
                                            <!-- Düzelt Modal -->
                                        </tr>
                                    <div class="modal fade" id="duzeltModal{{$etkn->id}}" 
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
                                                    <form action="{{ url('etkn/duzelt/'.$etkn->id)}}" method="POST" >
                                                        {{ csrf_field() }}
                                                        <!-- etkn adı -->
                                                        <div class="form-group">
                                                            <label for="etkn-ad" class="col-sm-3 control-label">Ad</label>
                                                                <input type="text" name="ad" id="etkn-ad" class="form-control" value="@if(count(@$etkn)>0){{$etkn->ad}}@else{{old('ad')}}@endif">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="etkn-yer" class="col-sm-3 control-label">Yer</label>
                                                                <input type="text" name="yer" id="etkn-yer" class="form-control" value="@if(count(@$etkn)>0){{$etkn->yer}}@else{{old('yer')}}@endif">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="etkn-tarih" class="col-sm-3 control-label">Tarih</label>
                                                                <input type="text" name="tarih" id="etkn-tarih" class="form-control" value="@if(count(@$etkn)>0){{$etkn->tarih}}@else{{old('tarih')}}@endif">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="etkn-baslama" class="col-sm-3 control-label">Başlama Saati</label>
                                                                <input type="text" name="baslama" id="etkn-baslama" class="form-control" value="@if(count(@$etkn)>0){{$etkn->baslama}}@else{{old('baslama')}}@endif">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="etkn-bitis" class="col-sm-3 control-label">Bitiş Saati</label>
                                                                <input type="text" name="bitis" id="etkn-bitis" class="form-control" value="@if(count(@$etkn)>0){{$etkn->bitis}}@else{{old('bitis')}}@endif">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="etkn-etkinlikte_ne_kadar_kalinmali" class="col-sm-3 control-label">Minimum Süre</label>
                                                                <input type="text" name="etkinlikte_ne_kadar_kalinmali" id="etkn-etkinlikte_ne_kadar_kalinmali" class="form-control" value="@if(count(@$etkn)>0){{$etkn->etkinlikte_ne_kadar_kalinmali}}@else{{old('etkinlikte_ne_kadar_kalinmali')}}@endif">
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
                                    <div class="modal fade" id="silModal{{$etkn->id}}" 
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
                                                    <form action="{{ url('etkn/sil/'.$etkn->id) }}" method="POST" >
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
                    <center><?php echo $etkinlik->render(); ?></center>
                </div>
            </div>
            @endif
            </div>
        </div>
    </div>
</div>


@endsection
