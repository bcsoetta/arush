@extends('layouts.app')

@section('pageName')
DashBoard
@endsection

@section('styles')

@endsection

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Dashboard</h3>
    </div>
    <div class="panel-body">
        <div class="row">

            <div class="col-md-3">
                <h2>Dokumen Status : Tahun {{date('Y')}}</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($status as $sts)
                        <tr>
                            <td>{{$sts->label}}</td>
                            <td class="text-right">{{$sts->jumlah}}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <th class="text-center">TOTAL</th>
                            <th class="text-right">{{$sumStatus}}</th>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="col-md-3">
                <h2>Rata-rata Waktu Penyelesaian :</h2>
                <span>Dari Penerimaan dokumen sampai SPPB: Tahun {{date('Y')}}</span>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tahun</th>
                            <th>Bulan</th>
                            <th>Waktu/Jam</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($waktu as $wkt)
                        <tr>
                            <td class="text-center">{{$wkt->tahun}}</td>
                            <td>{{$wkt->nama_bulan}}</td>
                            <td class="text-center"><b>{{number_format($wkt->ratarata,2)}}</b></td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
            <!-- <div class="col-md-3">
                <h2>Dokumen Belum Rekam PIB/PIBK :</h2>
                <h1>123123</h1>
            </div> -->
        </div>
        <div class="row">
            <div class="col-md-6">
                <h2>Dokumen RH Perbulan : {{date('Y')}}</h2>
                <span>status dokumen SPPB + Keluar + Terima Definitif </span>

                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#chartRhPerbulan">Chart</a></li>
                    <li><a data-toggle="tab" href="#TableRhPerbulan">Table</a></li>
                </ul>
                <div class="tab-content">
                    <div id="chartRhPerbulan" class="tab-pane fade in active">
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                {!! $dokumenChart->container() !!}
                            </div>
                        </div>
                    </div>
                    <div id="TableRhPerbulan" class="tab-pane fade table-responsive">
                        <br>
                        <table class="table table-condensed">
                            <thead>
                                <tr>

                                    <th>Bulan</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dokumen as $doc)
                                <tr>
                                    <td>{{$doc->name}}</td>
                                    <td class="text-center">{{$doc->jumlah}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">{{$sumDokumen}}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h2>LHP Pemeriksa : {{date('M')}}</h2>
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#chartLhpPerbulan">Chart</a></li>
                    <li><a data-toggle="tab" href="#TableLhpPerbulan">Table</a></li>
                </ul>
                <div class="tab-content">
                    <div id="chartLhpPerbulan" class="tab-pane fade in active">
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                {!! $lhpChart->container() !!}
                            </div>
                        </div>
                    </div>
                    <div id="TableLhpPerbulan" class="tab-pane fade table-responsive">
                        <br>
                        <table class="table table-condensed">
                            <thead>
                                <tr>

                                    <th>Nama</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lhp as $doc)
                                <tr>
                                    <td>{{$doc->pemeriksa_nama}}</td>
                                    <td class="text-center">{{$doc->jumlah}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">{{$sumLhp}}</th>
                                </tr>


                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <h2>10 Importir RH Terbanyak : {{date('Y')}}</h2>
                <div id="" class="table-responsive">
                    <br>
                    <table class="table table-striped table-hover table-condensed table-bordered">
                        <thead>
                            <tr>

                                <th>Importir</th>
                                <th>NPWP</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($importirTerbanyak as $iter)
                            <tr>
                                <td>{{$iter->nama}}</td>
                                <td>{{$iter->npwp}}</td>
                                <td class="text-center">{{$iter->jumlah}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <h2>10 HS dokumen RH Terbanyak : {{date('Y')}}</h2>
                <div id="" class="table-responsive">
                    <br>
                    <table class="table table-striped table-hover table-condensed table-bordered">
                        <thead>
                            <tr>

                                <th>HS</th>
                                <th>Uraian Barang</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hsTerbanyak as $hs)
                            <tr>
                                <td>{{$hs->hs_code}}</td>
                                <td>{{strtoupper($hs->uraian_barang)}}</td>
                                <td class="text-center">{{$hs->jumlah}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div> {{-- end-panel --}}
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
{!! $dokumenChart->script() !!}
{!! $lhpChart->script() !!}
<script>
    $(document).ready(function() {

        // dokumen status

        let tahun = new Date().getFullYear();

        const urlStatusDokumen = '/api/status-dokumen/' + tahun;

        $.ajax({
            url: urlStatusDokumen,
            type: 'GET',
            success: function(response) {
                console.log(response)
            }
        });

    });
</script>

@endsection