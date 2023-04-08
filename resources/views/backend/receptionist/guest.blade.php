@extends('backend.layout.main')
@push('style-alt')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    <!-- End plugin css for this page -->
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Receptionist</a></li>
            <li class="breadcrumb-item active" aria-current="page">Booking</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Kamar List</h6>
                    <div class="table-responsive">
                        <table id="dataTable" class="table">
                            @php
                                $g = request()
                                    ->session()
                                    ->get('gus');
                            @endphp
                            <tbody>
                                <tr>
                                    <td><strong>Nama</strong></td>
                                    <td>{{ $g['name'] }}</td>
                                </tr>
                                <tr>
                                   <td><strong>NIK</strong></td>
                                    <td>{{ $g['nik'] }}</td>
                                </tr>
                                <tr>
                                    <td><strong>status</strong></td>
                                    <td>{{ $g['ttl'] }}</td>
                                </tr>
                                <tr>
                                  <td><strong>Jenis Kelamin</strong></td>
                                    <td>{{ $g['jk'] }}</td>
                                </tr>
                                <tr>
                                   <td><strong>No-TLP</strong></td>
                                    <td>{{ $g['no_tlp'] }}</td>
                                </tr>
                                <tr>
                                   <td><strong>Kamar</strong></td>
                                    <td>{{ $g['name_room']->room }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Alamat</strong></td>
                                    <td>{{ $g['address'] }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Check-in</strong></td>
                                    <td>{{ $g['check_in'] }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Check-out</strong></td>
                                    <td>{{ $g['check_out'] }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Fasilitas Tambahan</strong></td>
                                    <td>
                                        @foreach ($g['fasilitas_id'] as $item)
                                            @foreach ($item['data'] as $key)
                                                {{ $key['fasilitas'] }}
                                            @endforeach
                                        @endforeach
                                    </td>
                                </tr>
                                {{-- <tr>
                                    <td><strong>Status</strong></td>
                                    <td>{{ $g['status'] }}</td>
                                </tr> --}}
                                <tr>
                                    <td><strong>Total Harga</strong></td>
                                    <td>{{'Rp.  ' . number_format($g['total']) }}</td>
                                </tr>
                                {{-- @endforeach --}}
                            </tbody>
                        </table>
                        <form action="{{route('booking.store')}}" method="POST">
                            @csrf
                            <button type="submit" id="saveBtn" value="create" class="btn btn-primary"
                            style="float: right">Add Booking</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
@push('script-alt')
    <!-- Plugin js for this page -->
    <script src="{{ asset('backend/assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- End plugin js for this page -->

    <!-- Plugin js for this page -->
    <script src="{{ asset('backend/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
    <!-- End plugin js for this page -->

    <!-- Custom js for this page -->
    <script src="{{ asset('backend/assets/js/data-table.js') }}"></script>
    <!-- End custom js for this page -->

    <!-- Custom js for this page -->
    <script src="{{ asset('backend/assets/js/sweet-alert.js') }}"></script>
    <!-- End custom js for this page -->
@endpush
