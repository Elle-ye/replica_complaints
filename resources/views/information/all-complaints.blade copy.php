@extends('layouts.app')

{{-- @section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/self/graphs.css') }}">
@endsection --}}

@section('content')
    <h2>All Compliant Tickets</h2>

    <!-- breadcrumbs -->
    <ul class="breadcrumbs" style="--breadcrumbs-background: #f0f0f0; --breadcrumbs-color: #333333;">
        <li class="active" data-divider="›"><a href="#"><span class="icon mif-home"></span>All Complaint Tickets</a></li>
        {{-- <li data-divider="›"><a href="#">Library</a></li>
    <li class="active"><a href="#">Data</a></li> --}}
    </ul>

    {{-- filters --}}
    <div class="card">
        <div class="card-content">
            <div class="cell-md-4">
                <!-- With label -->
                <input data-role="calendar-picker" data-label="Select date:" value="DD/MM/YYYY">
            </div>
        </div>
        <button type="submit" id="downloadBtn">Download csv</button>
    </div>

    {{-- Table Content --}}
    <div class="mt-6">

        <div class="card shadow-medium">
            <table class="table striped">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll"></th>
                        <th>Ticket ID</th>
                        <th>Complaint Type</th>
                        <th>Complaint Sub-Type</th>
                        <th>Complaint Subject</th>
                        <th>Ticket Status</th>
                        <th>Customer Name</th>
                        <th>Account Number</th>
                        <th>Card Number</th>
                        <th>Contact Number</th>
                        <th>Origin</th>
                        <th>Contact Number</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($complaints as $complaint)
                        <tr>
                            <td><input type="checkbox" class="rowCheckBox"></td>
                            <td>{{ $user->fname }}</td>
                            <td>{{ $user->lname }}</td>
                            <td>{{ $user->companyName }}</td>
                            <td>{{ $user->address }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->telNumber }}</td>
                            <td>{{ $user->additionalInfo }}</td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
            {{-- <div class="mt-3 pagination">
                {{ $users -> links() }}
            </div> --}}
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/self/all-complaints.js') }}"></script>
    {{-- <script>
        $('#selectAll').on('change', function() {
            $('.rowCheckBox').prop('checked', this.checked)
        });

        $('.rowCheckBox').on('change', function() {
            if ($('.rowCheckBox:checked').length === $('.rowCheckBox').length) {
                $('#selectAll').prop('checked', true)
            } else {
                $('#selectAll').prop('checked', false)
            }
        })
    </script> --}}
@endsection
