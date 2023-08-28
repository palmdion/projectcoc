@extends('admin.index')

@section('title', 'Dashboard')

@section('content')

<div class="container  row row-cols-1 row-cols-xl-3">

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            จำนวนศิษย์เก่าทั้งหมด (คน)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countAllAlumni }}</div>

                        <div class="row no-gutters align-items-center">
                            <div class="mt-2 text-xs font-weight-bold text-primary text-uppercase mb-1">
                                จำนวนศิษย์เก่าที่ยืนยันตัวตนแล้ว (คน)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count }}</div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            ข่าวสารทั้งหมด (ข่าวสาร)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countPost }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">กิจกรรมทั้งหมด (กิจกรรม)
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $countEvent }}</div>
                            </div>

                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container  row row-cols-1 row-cols-xl-3">

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            บัญชีผู้ใช้งานทั้งหมด (บัญชี)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countAllUser }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')

@endsection


