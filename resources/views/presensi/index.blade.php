@extends('layouts.app')

@section('pageName')
Setting
@endsection

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Daftar hadir Pemeriksa</h3>
    </div>
    <div class="panel-body">
    <div class="table-responsive">
    <p>*Daftar ini tidak ada hubunganya dengan presensi ceisa</p>
        <table class="table table-bordered table-small mt-4" style="margin-top: 10px;">
            <thead>
                <th>Nama</th>
                <th>Cek In</th>
                <th>Mulai</th>
                <th>Selesai</th>
            </thead>
            <tbody>
                @foreach($hadir as $data)
                <tr class="{{$data->end->isToday() ? 'success' : 'danger'}}">
                    <td class="text-center">{{$data->user->name}}</td>
                    <td class="text-center">{{$data->check_in->format('d-m-Y H:i:s')}}</td>
                    <td class="text-center">{{$data->start->format('d-m-Y H:i:s')}}</td>
                    <td class="text-center">{{$data->end->format('d-m-Y H:i:s')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $hadir->links() }}
        </div>
    </div>
</div> {{-- end-panel --}}
@endsection