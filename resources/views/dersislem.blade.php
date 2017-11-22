<?php Use App\Etkinlikler;?>

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
                                    <th>Ders Sınıfı</th>
                                    <th>Ders Şubesi</th>
                                    <th>Ders Öğretim Görevlisi</th>
                                </thead>
                                <tbody>
                                    @foreach ($ders as $drs)
                                        <tr>
                                            <td class="table-text"><div>{{ $drs->ders_adi }}</div></td>
                                            <td class="table-text"><div>{{ $drs->ders_sinif }}</div></td>
                                            <td class="table-text"><div>{{ $drs->ders_sube }}</div></td>
                                            <td class="table-text"><div>{{Etkinlikler::PersonelBilgi($drs->ogr_elemani)}}</div></td>
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
                                                            <label for="drs-ders_adi" class="col-sm-3 control-label">Ders Adı</label>
                                                                <input type="text" name="ders_adi" id="drs-ders_adi" class="form-control" value="@if(count(@$drs)>0){{$drs->ders_adi}}@else{{old('ders_adi')}}@endif">
                                                        </div>
                                                        <div class="form-group">
                                                        <label for="email" class="col-md-4 control-label">Sınıf</label>
                                                            <select class="form-control" id="sel1" name="ders_sinif" value="{{ old('ders_sinif') }}">
                                                            <option value="1" <?php if ($drs->ders_sinif=='1') echo "selected"?>>1</option>
                                                            <option value="2" <?php if ($drs->ders_sinif=='2') echo "selected"?>>2</option>
                                                            <option value="3" <?php if ($drs->ders_sinif=='3') echo "selected"?>>3</option>
                                                            <option value="4" <?php if ($drs->ders_sinif=='4') echo "selected"?>>4</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                        <label for="email" class="col-md-4 control-label">Şube</label>
                                                            <select class="form-control" id="sel1" name="ders_sube" value="{{ old('ders_sube') }}">
                                                            <option value="A" <?php if ($drs->ders_sube=='A') echo "selected"?>>A</option>
                                                            <option value="B" <?php if ($drs->ders_sube=='B') echo "selected"?>>B</option>
                                                            <option value="C" <?php if ($drs->ders_sube=='C') echo "selected"?>>C</option>
                                                            <option value="D" <?php if ($drs->ders_sube=='D') echo "selected"?>>D</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="drs-ogr_elemani" class="col-sm-4 control-label">Ders Öğretim Elemanı</label>
                                                                 <select class="selectpicker form-control"  data-live-search="true" name="ogr_elemani" data-container="body">
									                     @foreach(@$ogrelemani as $person)                        	
									                              <option value="{{ $person->id }}" <?php if ($drs->ogr_elemani==$person->id) echo "selected"?>>{{$person->adsoyad}}</option>
									                        @endforeach
									                        
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
