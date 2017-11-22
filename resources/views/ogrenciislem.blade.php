@section('content')
@extends('layouts.app')
            <!-- Liste -->
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Kullanıcılar
                         <div class="pull-right">    
                            <form class="navbar-form navbar-left"  action="{{ url('/ogrencilistele')}}" method="POST"  role="search">
                             {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="text" class="form-control" name="search" placeholder="Ara">
                                </div>
                                <button type="submit" class="btn btn-default">Bul</button>
                            </form>
                        </div>
                    </div>
                        @if (count($users) > 0)
                        <div class="panel-body">
                            <table class="table table-striped usr-table">
                                <thead>
                                    <th>Ad/Soyad</th>
                                    <th>Kart No</th>
                                    <th>E-Mail</th>
                                    <th>Kullanıcı Tipi</th>
                                </thead>
                                <tbody>
                                    @foreach ($users as $usr)
                                        <tr>
                                            <td class="table-text"><div>{{ $usr->adsoyad }}</div></td>
                                            <td class="table-text"><div>{{ $usr->kartno }}</div></td>
                                            <td class="table-text"><div>{{ $usr->email }}</div></td>
                                            <td class="table-text">@if($usr->tip==1)<div>  Öğrenci</div>  @elseif($usr->tip==2)<div>  Akademik Personel</div>  @elseif($usr->tip==3)<div>İdari Personel</div> @endif</td>
                                            <!-- Düzelt -->
                                            <td>
                                                <form action="{{ url('ogr/duzelt/'.$usr->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <button 
                                                       type="button" 
                                                       class="btn btn-primary pull-right" 
                                                       data-toggle="modal"
                                                       data-target="#duzeltModal{{$usr->id}}">
                                                      <i class="fa fa-btn fa-edit " ></i>Düzelt
                                                 </button>
                                                </form>
                                            </td>
                                            <!-- Sil -->
                                             <td>
                                                <form action="{{ url('ogr/sil/'.$usr->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button 
                                                       type="button" 
                                                       class="btn btn btn-danger pull-right" 
                                                       data-toggle="modal"
                                                       data-target="#silModal{{$usr->id}}">
                                                      <i class="fa fa-btn fa-trash pull-right " ></i>Sil
                                                 </button>
                                                </form>
                                            </td>
                                            <!-- Düzelt Modal -->
                                        </tr>
                                    <div class="modal fade" id="duzeltModal{{$usr->id}}" 
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
                                                    <form action="{{ url('ogr/duzelt/'.$usr->id)}}" method="POST" >
                                                        {{ csrf_field() }}
                                                        <!-- usr adı -->
                                                        <div class="form-group">
                                                            <label for="usr-adsoyad" class="col-sm-3 control-label">Ad/Soyadsoyad</label>
                                                                <input type="text" name="adsoyad" id="usr-adsoyad" class="form-control" value="@if(count(@$usr)>0){{$usr->adsoyad}}@else{{old('adsoyad')}}@endif">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="usr-kartno" class="col-sm-3 control-label">Kart No</label>
                                                                <input type="text" name="kartno" id="usr-kartno" class="form-control" value="@if(count(@$usr)>0){{$usr->kartno}}@else{{old('kartno')}}@endif">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="usr-email" class="col-sm-3 control-label">E-Mail</label>
                                                                <input type="text" name="email" id="usr-email" class="form-control" value="@if(count(@$usr)>0){{$usr->email}}@else{{old('email')}}@endif">
                                                        </div>
                                                        <div class="form-group">
                                                        <label for="email" class="col-md-4 control-label">Sınıf</label>
                                                            <select class="form-control" id="sel1" name="sinif" value="{{ old('sinif') }}">
                                                            <option value="1" <?php if ($usr->sinif=='1') echo "selected"?>>1</option>
                                                            <option value="2" <?php if ($usr->sinif=='2') echo "selected"?>>2</option>
                                                            <option value="3" <?php if ($usr->sinif=='3') echo "selected"?>>3</option>
                                                            <option value="4" <?php if ($usr->sinif=='4') echo "selected"?>>4</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                        <label for="email" class="col-md-4 control-label">Şube</label>
                                                            <select class="form-control" id="sel1" name="sube" value="{{ old('sube') }}">
                                                            <option value="A" <?php if ($usr->sube=='A') echo "selected"?>>A</option>
                                                            <option value="B" <?php if ($usr->sube=='B') echo "selected"?>>B</option>
                                                            <option value="C" <?php if ($usr->sube=='C') echo "selected"?>>C</option>
                                                            <option value="D" <?php if ($usr->sube=='D') echo "selected"?>>D</option>
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
                                    <div class="modal fade" id="silModal{{$usr->id}}" 
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
                                                    <form action="{{ url('ogr/sil/'.$usr->id) }}" method="POST" >
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <!-- usr adı -->
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
                    <center><?php echo $users->render(); ?></center>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>


@endsection
