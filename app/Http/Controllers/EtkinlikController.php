<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Etkinlik;
use App\User;
use App\Dersler;
use App\Etkinlikler;
use App\KulturelEtkinlikTakip;
use Auth; 
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class EtkinlikController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index()
    {
        if (Auth::user()->tip==3) 
    {
        return view('etkinlik');
    } else return redirect('/etkinlikdurumlistele');
    }

    function EtkinlikEkle(Request $request) 
    {
      //  echo Auth::user()->name; 
        $etkinlik = new Etkinlikler;
        $etkinlik->ad = $request->ad;
        $etkinlik->yer = $request->yer;
        $etkinlik->tarih = $request->tarih;
        $etkinlik->baslama = $request->baslama;
        $etkinlik->bitis = $request->bitis;
        $etkinlik->etkinlikte_ne_kadar_kalinmali = $request->etkinlikte_ne_kadar_kalinmali;
        $etkinlik->etkinlik_oncesi_okutma_suresi = $request->etkinlik_oncesi_okutma_suresi;
        $etkinlik->etkinlik_sonrasi_okutma_suresi = $request->etkinlik_sonrasi_okutma_suresi;
        $etkinlik->save();
        return redirect('/etkinlikekle');
    }

    function EtkinlikSil($id)
    {
        Etkinlikler::findOrFail($id)->delete();
        return redirect('/etkinliklistele');
    }
    function EtkinlikDuzelt($id, Request $request)
    {
        $etkinlik=Etkinlikler::findOrFail($id);
        $etkinlik->ad = $request->ad;
        $etkinlik->yer = $request->yer;
        $etkinlik->tarih = $request->tarih;
        $etkinlik->baslama = $request->baslama;
        $etkinlik->bitis = $request->bitis;
        $etkinlik->etkinlikte_ne_kadar_kalinmali = $request->etkinlikte_ne_kadar_kalinmali;
        $etkinlik->save();
        return redirect('/etkinliklistele');
    }
    function EtkinlikListe(Request $request) 
    {  $status='etkinliklist';

     if ($request->search!='') {
        $etkinlik= Etkinlikler::where('ders_mi','=','0')->whereRaw("ad ILIKE '%".$request->search."%' or yer ILIKE '%".$request->search."%'")->orderBy('created_at', 'asc')->paginate(5);
       return view('etkinlikislem',compact("etkinlik","status"));
    }else { 
            $etkinlik = Etkinlikler::where('ders_mi','=','0')->orderBy('created_at', 'asc')->paginate(5);
            $status='etkinliklist';
            return view('etkinlikislem',compact("etkinlik","status"));
        }
    }
    function EtkinlikDersIndex()
    {
        $dersler=Dersler::where('durum', 1)->get();
       /// echo "<pre>"; print_r($dersler); exit();
        if (Auth::user()->tip==3) 
        {
            ///return view('etknders');
             return view('etknders',compact("dersler"));
        } else return redirect('/etkinlikdurumlistele');
    }
    function EtkinlikDersListe(Request $request) 
    {   if ($request->search!='') {
        $ders= Etkinlikler::where('ders_mi','!=','0')->whereRaw("ad ILIKE '%".$request->search."%' or yer ILIKE '%".$request->search."%'")->orderBy('id', 'asc')->paginate(5);
       return view('etkndersislem',compact("ders"));
    }else return view('etkndersislem', [
            'ders' => Etkinlikler::where('ders_mi','!=','0')->orderBy('id', 'asc')->paginate(5)
        ]);
    }
    function EtkinlikDersEkle(Request $request) 
    {//return $request->ilktarih;
        $dersler=Dersler::where('durum', 1)->where('id',$request->ad)->first();
        $baslangicZamani = strtotime( $request->ilktarih );
        $bitisZamani = strtotime( $request->sontarih );
        for ( $i = $baslangicZamani; $i <= $bitisZamani; $i = $i + 86400*7 ) {
            $ders = new Etkinlikler;
            $ders->ders_mi=$request->ad; 
            $ders->ad = $dersler->ders_adi;
            $ders->yer = $request->yer;
            $ders->tarih = date( 'Y-m-d', $i );
            $ders->baslama = $request->baslama;
            $ders->bitis = $request->bitis;
            $ders->etkinlikte_ne_kadar_kalinmali = $request->etkinlikte_ne_kadar_kalinmali;
            $ders->etkinlik_oncesi_okutma_suresi = $request->etkinlik_oncesi_okutma_suresi;
            $ders->etkinlik_sonrasi_okutma_suresi = $request->etkinlik_sonrasi_okutma_suresi;
           // $ders->ders_mi=$request->sube;
            $ders->save();
        } 
        
        return redirect('/etkinlikdersekle');
    }

    function EtkinlikDersDuzelt($id, Request $request)
    {
        $ders=Etkinlikler::findOrFail($id);
        //echo "<pre>"; print_r($request->ad); exit();
        $ders->ad = $request->ad;
        $ders->yer = $request->yer;
        $ders->tarih = $request->tarih;
        $ders->baslama = $request->baslama;
        $ders->bitis = $request->bitis;
        $ders->etkinlikte_ne_kadar_kalinmali = $request->etkinlikte_ne_kadar_kalinmali;
        $ders->ders_mi=$request->sube;
        $ders->save();
        return redirect('/etkinlikderslistele');
    }
    function EtkinlikDersSil($id)
    {
        Etkinlikler::findOrFail($id)->delete();
        return redirect('/etkinlikderslistele');
    }
    function UserIndex()
    {
        if (Auth::user()->tip==3) 
    {
        return view('user');
    } else return redirect('/etkinlikdurumlistele');
    }
    function UserEkle(Request $request) 
    {
      //  echo Auth::user()->name; 
        $user = new User;
        $user->adsoyad = $request->adsoyad;
        $user->kartno = $request->kartno;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->tip = $request->tip;
        $user->sube = $request->sube;
        $user->save();
        return redirect('/userekle');
    }
    function UserSil($id)
    {
        User::findOrFail($id)->delete();
        return redirect('/userlistele');
    }
    function UserDuzelt($id, Request $request)
    {
        $user=User::findOrFail($id);
        //echo "<pre>"; print_r($request); exit();
        $user->adsoyad = $request->adsoyad;
        $user->kartno = $request->kartno;
        $user->email = $request->email;
        $user->tip = $request->tip;
        $user->save();
        return redirect('/userlistele');
    }
    function UserListe(Request $request) 
    {   if ($request->search!='') {
        $users= User::whereRaw("adsoyad ILIKE '%".$request->search."%' ")->where('tip','!=','1')->orderBy('created_at', 'asc')->paginate(5);
//echo "<pre>"; print_r($etkinlik); exit();
//whereRaw("ilisik_kesme.sicil_ogr_no ILIKE '%".$request->string."%' or ilisik_kesme.tc ILIKE '%".$request->string."%'".$filter1.$filter);
       return view('userislem',compact("users"));
    }else  return view('userislem', [
            'users' => User::orderBy('created_at', 'asc')->where('tip','!=','1')->paginate(5)
        ]);
    }
    function OgrenciIndex()
    {
        if (Auth::user()->tip==3) 
    {
        return view('ogrenci');
    } else return redirect('/etkinlikdurumlistele');
    }
    function OgrenciEkle(Request $request) 
    {
      //  echo Auth::user()->name; 
        $user = new User;
        $user->adsoyad = $request->adsoyad;
        $user->kartno = $request->kartno;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->tip = 1;
        $user->sinif = $request->sinif;
        $user->sube = $request->sube;
        $user->save();
        return redirect('/ogrenciekle');
    }

    function OgrenciSil($id)
    {
        User::findOrFail($id)->delete();
        return redirect('/ogrencilistele');
    }
    function OgrenciDuzelt($id, Request $request)
    {
        $user=User::findOrFail($id);
        //echo "<pre>"; print_r($request); exit();
        $user->adsoyad = $request->adsoyad;
        $user->kartno = $request->kartno;
        $user->email = $request->email;
        $user->tip = 1;
        $user->sinif = $request->sinif;
        $user->sube = $request->sube;
        $user->save();
        return redirect('/ogrencilistele');
    }

    function OgrenciListe(Request $request) 
    {   if ($request->search!='') {
        $users= User::whereRaw("adsoyad ILIKE '%".$request->search."%' ")->where('tip',1)->orderBy('created_at', 'asc')->paginate(5);
//echo "<pre>"; print_r($etkinlik); exit();
//whereRaw("ilisik_kesme.sicil_ogr_no ILIKE '%".$request->string."%' or ilisik_kesme.tc ILIKE '%".$request->string."%'".$filter1.$filter);


       return view('ogrenciislem',compact("users"));
    }else  return view('ogrenciislem', [
            'users' => User::orderBy('created_at', 'asc')->where('tip',1)->paginate(5)
        ]);
    }

    public function etkinlikBilgi($kartno)
    {   date_default_timezone_set("Europe/Istanbul");
        $bugun= date('Y-m-d');
        $saat=date('H:i:s');
        //echo $saat;
       // Functions::GetEtkinlikConnect(Functions::KapiAdiGetir($cihaz_id)->cihaz_ip);
        $bugunetkinlik=DB::connection('pgsql')->select("Select *  FROM etkinlik where tarih='".$bugun."'");
        //echo "<pre>"; print_r($bugunetkinlik); exit();
        if (@$bugunetkinlik) //Veri Tabanına Yazdırma İşlemleri
        {
            
        $aktifetkinlik=DB::connection('pgsql')->select("Select *  FROM etkinlik where tarih='".$bugun."' and bitis>='".$saat."' and baslama<='".$saat."' ORDER BY tarih+baslama ");
        //echo "<pre>"; print_r($aktifetkinlik); exit();

        $bironcekietkinlik=DB::connection('pgsql')->select("Select *  FROM etkinlik where tarih<='".$bugun."' ORDER BY tarih+bitis  DESC");

        $birsonrakietkinlik=DB::connection('pgsql')->select("Select *  FROM etkinlik where tarih>='".$bugun."'  ORDER BY tarih+baslama ");

            for ($i=0; $i < count($birsonrakietkinlik); $i++) 
            {
                if ($birsonrakietkinlik[$i]->baslama>=$saat and $birsonrakietkinlik[$i]->tarih==$bugun) 
                {
                    $birsonrakietkinlik=DB::connection('pgsql')->select("Select *  FROM etkinlik where tarih='".$bugun."' and baslama>'".$saat."' ORDER BY baslama");
                }
            }
            if ($bironcekietkinlik) 
            {
                for ($i=0; $i < count($bironcekietkinlik); $i++) 
                { 
                    if ($bironcekietkinlik[$i]->bitis>=$saat and $bironcekietkinlik[$i]->tarih==$bugun) 
                    {
                        $bironcekietkinlik=DB::connection('pgsql')->select("Select *  FROM etkinlik where tarih='".$bugun."' and bitis<='".$saat."'  ORDER BY bitis DESC"); 
                    }
                } 
            }
            $ogr_bilgi=DB::connection('pgsql')->select("Select *  FROM users where tip='1' and kartno = :kartno",["kartno" => $kartno]);
            @$ogr_no=$ogr_bilgi[0]->id;
            $ogr_elemani=DB::connection('pgsql')->select("Select id  FROM users where tip='2' and sube = :sube",["sube" => @$ogr_bilgi[0]->sube]);
            //echo "<pre>"; print_r($q); exit();
//$ogr_bilgi = DB::connection('ubs')->select("select * from vw_kulturel_etkinlik where \"oNo\"='".$ogr_no."'");
            if (count($ogr_bilgi)>0) {
            if (@$aktifetkinlik) //aktifetkinlik
            {   //die('aktif');
                $varmi=KulturelEtkinlikTakip::select()->where('ogr_no', $ogr_no)->where('etkinlik_id', @$aktifetkinlik[0]->id)->get();
                if (count($varmi)>0)
                {   $sure =round((strtotime(date('H:i:s'))-strtotime($varmi[0]->giris))/60);
                   // echo $sure;
                    if ($sure>=$aktifetkinlik[0]->etkinlikte_ne_kadar_kalinmali) 
                    {
                        $model = KulturelEtkinlikTakip::findOrFail($varmi[0]->id);
                        $model->sure=$sure;
                        $model->cikis=date('Y-m-d H:i:s');
                        $model->save();
                        $uyari= "Etkinliği İçin ÇIKIŞ Kaydınız Alındı. Etkinlikte ".$sure." dakikakaldınız.(Aktif).";
                    }else $uyari="Etkinliğinde en az  ".$aktifetkinlik[0]->etkinlikte_ne_kadar_kalinmali." Dakika Kalmalısınız. Etkinlikte ".$sure." dakikakaldınız. (Aktif).";

                    

                }else
                {
                $model = New KulturelEtkinlikTakip;
                $model->ogr_no = $ogr_no;
                $model->kart_no = $kartno; 
                $model->adsoyad= @$ogr_bilgi[0]->adsoyad;
                $model->birim='';
                $model->bolum='';
                $model->sube= @$ogr_bilgi[0]->sube;
                $model->etkinlik_id=$aktifetkinlik[0]->id;
                $model->etkinlik_adi=$aktifetkinlik[0]->ad;
                $model->giris=date('H:i:s');
                $model->cikis=date('H:i:s');
                $model->ogr_elemani=@$ogr_elemani[0]->id;
                $model->save();
                $uyari="Etkinliği İçin Kaydınız Alındı Çıkışta Kartınızı Okutmayı Unutmayınız(Aktif).";
                }

                $dizi = array('adi' =>@$ogr_bilgi[0]->adsoyad
                        ,'no'       =>$ogr_no
                        ,'etkinlik' =>@$aktifetkinlik[0]->ad
                        ,'uyari'    =>$uyari);
                    return json_encode($dizi);
               // echo @$uyari; exit();
            } 
            elseif (@$birsonrakietkinlik[0]->tarih==$bugun) //birsonrakietkinlik
            {
                date_default_timezone_set("UTC");
                $etkinlikbaslamasaati=  gmdate("H:i:s",strtotime('-'.$birsonrakietkinlik[0]->etkinlik_oncesi_okutma_suresi.' minutes',strtotime($birsonrakietkinlik[0]->baslama)));
                $etkinlikbitissaati =  gmdate("H:i:s",strtotime('+'.$birsonrakietkinlik[0]->etkinlik_sonrasi_okutma_suresi.' minutes',strtotime($birsonrakietkinlik[0]->bitis)));
                date_default_timezone_set("Europe/Istanbul");
               // echo date('H:i:s');
                if ($etkinlikbaslamasaati<=$saat and $etkinlikbitissaati>=$saat) 
                {
                    $varmis=KulturelEtkinlikTakip::select()->where('ogr_no', $ogr_no)->where('etkinlik_id', @$birsonrakietkinlik[0]->id)->get();
                if (count($varmis)>0)
                {   $sure =round((strtotime(date('Y-m-d H:i:s'))-strtotime($varmis[0]->giris))/60);
                   // echo $sure;
                    if ($sure>=$birsonrakietkinlik[0]->etkinlikte_ne_kadar_kalinmali) 
                    {
                        $model = New KulturelEtkinlikTakip;
                        $model->ogr_no = $ogr_no;
                        $model->kart_no = $kartno; 
                        $model->adsoyad= @$ogr_bilgi[0]->adsoyad;
                        $model->birim='';
                        $model->bolum='';
                        $model->sube= @$ogr_bilgi[0]->sube;
                        $model->etkinlik_id=$birsonrakietkinlik[0]->id;
                        $model->etkinlik_adi=$birsonrakietkinlik[0]->ad;
                        $model->giris=date('H:i:s');
                        $model->cikis=date('H:i:s');
                        $model->ogr_elemani=@$ogr_elemani[0]->id;
                        $model->save();
                        $uyari=" Etkinliği İçin ÇIKIŞ Kaydınız Alındı. Etkinlikte ".$sure." dakika kaldınız.(Sonraki).";
                    }else $uyari=" Etkinliğinde en az  ".$birsonrakietkinlik[0]->etkinlikte_ne_kadar_kalinmali." Dakika Kalmalısınız. Etkinlikte ".$sure." dakika kaldınız. (Sonraki).";
                    $dizi = array('adi' =>@$ogr_bilgi[0]->adsoyad
                        ,'no'       =>$ogr_no
                        ,'etkinlik' =>@$birsonrakietkinlik[0]->ad
                        ,'uyari'    =>$uyari);
                    return json_encode($dizi);
                }else
                {
                    $model = New KulturelEtkinlikTakip;
                    $model->ogr_no = $ogr_no;
                    $model->kart_no = $kartno; 
                    $model->adsoyad= @$ogr_bilgi[0]->adsoyad;
                    $model->birim='';
                    $model->bolum='';
                    $model->sube= @$ogr_bilgi[0]->sube;
                    $model->etkinlik_id=$birsonrakietkinlik[0]->id;
                    $model->etkinlik_adi=$birsonrakietkinlik[0]->ad;
                    $model->giris=date('H:i:s');
                    $model->cikis=date('H:i:s');
                    $model->ogr_elemani=@$ogr_elemani[0]->id;
                    $model->save();
                $uyari=" Etkinliği İçin Kaydınız Alındı Çıkışta Kartınızı Okutmayı Unutmayınız(Sonraki).";
                $dizi = array('adi' =>@$ogr_bilgi[0]->adsoyad
                        ,'no'       =>$ogr_no
                        ,'etkinlik' =>@$birsonrakietkinlik[0]->ad
                        ,'uyari'    =>$uyari);
                    return json_encode($dizi);
                }
                //echo @$uyari; exit();
                }elseif ($etkinlikbaslamasaati>$saat) 
                {
                    $uyari=" Etkinliği için kayıtlar: ".$etkinlikbaslamasaati." - ".$etkinlikbitissaati." Saatleri arasında alınacaktır(Sonra)."; echo @$uyari; exit();
                

                $dizi = array('adi' =>@$ogr_bilgi[0]->adsoyad
                        ,'no'       =>$ogr_no
                        ,'etkinlik' =>@$birsonrakietkinlik[0]->ad
                        ,'uyari'    =>$uyari);
                    return json_encode($dizi);}
            }
            if (@$bironcekietkinlik[0]->tarih==$bugun) //bironcekietkinlik
            {
                date_default_timezone_set("UTC");
                $etkinlikbaslamasaati=  gmdate("H:i",strtotime('-'.$bironcekietkinlik[0]->etkinlik_oncesi_okutma_suresi.' minutes',strtotime($bironcekietkinlik[0]->baslama)));
                $etkinlikbitissaati =  gmdate("H:i",strtotime('+'.$bironcekietkinlik[0]->etkinlik_sonrasi_okutma_suresi.' minutes',strtotime($bironcekietkinlik[0]->bitis)));
                date_default_timezone_set("Europe/Istanbul");
                if ($etkinlikbaslamasaati<=$saat and $etkinlikbitissaati>=$saat) 
                {
                   $varmi=KulturelEtkinlikTakip::select()->where('ogr_no', $ogr_no)->where('etkinlik_id', @$bironcekietkinlik[0]->id)->get();
                if (count($varmi)>0)
                {   $sure =round((strtotime(date('Y-m-d H:i:s'))-strtotime($varmi[0]->giris))/60);
                   // echo $sure;
                    if ($sure>=$bironcekietkinlik[0]->etkinlikte_ne_kadar_kalinmali) 
                    {
                        $model = KulturelEtkinlikTakip::findOrFail($varmi[0]->id);
                        $model->sure=$sure;
                        $model->cikis=date('Y-m-d H:i:s');
                        $model->save();
                        $uyari=" Etkinliği İçin ÇIKIŞ Kaydınız Alındı. Etkinlikte ".$sure." dakikakaldınız.(Önceki).";
                    }else $uyari=" Etkinliğinde en az  ".$bironcekietkinlik[0]->etkinlikte_ne_kadar_kalinmali." Dakika Kalmalısınız. Etkinlikte ".$sure." dakika kaldınız. (Önceki).";
                
                }else
                {
                $model = New KulturelEtkinlikTakip;
                    $model->ogr_no = $ogr_no;
                    $model->kart_no = $kartno; 
                    $model->adsoyad= @$ogr_bilgi[0]->adsoyad;
                    $model->birim='';
                    $model->bolum='';
                    $model->sube= @$ogr_bilgi[0]->sube;
                    $model->etkinlik_id=$bironcekietkinlik[0]->id;
                    $model->etkinlik_adi=$bironcekietkinlik[0]->ad;
                    $model->giris=date('H:i:s');
                    $model->cikis=date('H:i:s');
                    $model->ogr_elemani=@$ogr_elemani[0]->id;
                    $model->save();
                $uyari=" Etkinliği İçin Kaydınız Alındı Çıkışta Kartınızı Okutmayı Unutmayınız(Önceki).";
                }
               // echo @$uyari; exit();
                } elseif ($etkinlikbitissaati<$saat) {
                    $uyari=" Etkinliği için kayıtlar: ".$etkinlikbaslamasaati." - ".$etkinlikbitissaati." Saatleri arasında aldındı(Önce)."; echo @$uyari; exit();
                }
                $dizi = array('adi' =>@$ogr_bilgi[0]->adsoyad
                        ,'no'       =>$ogr_no
                        ,'etkinlik' =>@$bironcekietkinlik[0]->ad
                        ,'uyari'    =>$uyari);
                    return json_encode($dizi);
            }
            }else {$uyari= "<b>Bilimsel Kültürel Etkinlikler Dersini Almadığınızdan Dolayı Kaydınız Alınmadı.</b>";
            $dizi = array('adi' =>''
                        ,'no'       =>''
                        ,'etkinlik' =>@''
                        ,'uyari'    =>$uyari);
                    return json_encode($dizi);}
        }else $uyari="Şuan Aktif Etkinlik Bulunmamaktadır.";
                $dizi = array('adi' =>''
                        ,'no'       =>''
                        ,'etkinlik' =>@''
                        ,'uyari'    =>$uyari);
                    return json_encode($dizi);
    }

    function EtkinlikDurumListe(Request $request) 
    {   
        $ogrelmanimi=User::where('id',Auth::user()->id)->where('tip', 2)->first();
        //echo "<pre>"; print_r($ogrelmanimi); exit();
        if (count($ogrelmanimi)>0) {
            $status="durumlist";
            $etkinlik= KulturelEtkinlikTakip::select('ogr_no','ogr_elemani','adsoyad', DB::raw('sum(sure) as sure'))->orWhere('ogr_elemani',Auth::user()->id)->groupBy('ogr_no','ogr_elemani','adsoyad')->orderBy('sure','DESC')->paginate(20);
            return view('etkinlikislem',compact("etkinlik","status","total","ogrelmanimi"));
        }
        elseif ($request->search!='') 
        {$ogrelmanimi='0';
            $status="durumlist";
            $etkinlik= KulturelEtkinlikTakip::where('ders_mi','=','0')->whereRaw("ad ILIKE '%".$request->search."%' or yer ILIKE '%".$request->search."%'")->orderBy('created_at', 'asc')->where('ogr_no',Auth::user()->id)->paginate(5);
           return view('etkinlikislem',compact("etkinlik","status","ogrelmanimi"));
        }else 
        { 
            $total = DB::table('kulturel_etkinlik_takip')->where('ogr_no',Auth::user()->id)->sum('sure');
            $status="durumlist";
            $ogrelmanimi='0';
            $etkinlik= KulturelEtkinlikTakip::orderBy('created_at', 'asc')->where('ogr_no',Auth::user()->id)->paginate(5);
            return view('etkinlikislem',compact("etkinlik","status","total","ogrelmanimi"));
        }
    }
    function DersIndex()
    {
        if (Auth::user()->tip==3) 
    {
        $ogrelemani=User::where('tip', 2)->get();
        //return $ogrelemani;
        return view('ders',compact("ogrelemani"));
    } else return redirect('/etkinlikdurumlistele');
    }
    function DersEkle(Request $request) 
    {//return $request->ilktarih;
            $ders = new Dersler;
            $ders->ders_adi = $request->ad;
            $ders->ders_sinif = $request->sinif;
            $ders->ders_sube = $request->sube;
            $ders->ogr_elemani = $request->ogr_elemani;
            $ders->durum = 1;
            
            $ders->save();
        return redirect('/dersekle');
    }
    function DersListe(Request $request) 

    {   $ogrelemani=User::where('tip', 2)->get();
        if ($request->search!='') {
        $ders= Dersler::where('durum','=','1')->whereRaw("ders_adi ILIKE '%".$request->search."%'")->orderBy('id', 'asc')->paginate(5);
       return view('dersislem',compact("ders","ogrelemani"));
    }else { 
        $ders = Dersler::where('durum','=','1')->orderBy('id', 'asc')->paginate(5);
    return view('dersislem',compact("ogrelemani","ders"));
    }
    
    
    }
    function DersDuzelt($id, Request $request)
    {   
        $ders=Dersler::findOrFail($id);
        $ders->ders_adi = $request->ders_adi;
        $ders->ders_sinif = $request->ders_sinif;
        $ders->ders_sube = $request->ders_sube;
        $ders->ogr_elemani = $request->ogr_elemani;
        $ders->durum = 1;
        $ders->save();
        return redirect('/derslistele');
    }
    function DersSil($id)
    {
        Dersler::findOrFail($id)->delete();
        return redirect('/derslistele');
    }
    
}
