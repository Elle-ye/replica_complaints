@extends('layouts.app')

@section('styles')
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/self/graphs.css') }}"> --}}
@endsection

@section('content')
    {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

    <h2>Branches</h2>

    <!-- breadcrumbs -->
    <ul class="breadcrumbs mb-5" style="--breadcrumbs-background: #f0f0f0; --breadcrumbs-color: #333333;">
        <li class="active" data-divider="›"><a href="#"><span class="icon mif-home"></span>Branches</a></li>
        {{-- <li data-divider="›"><a href="#">Library</a></li>
    <li class="active"><a href="#">Data</a></li> --}}
    </ul>
    <div class="grid">
        <div class="row flex-justify-center">
            <div class=" cell-md-12 flex-align-center">
                <div class="mt-10">
                    <div class="w-50">
                        <button class="info outline" type="button" id="showBranchForm">Add New Branch</button>
                        <button class="secondary outline" type="button" id="cancelShowBranchForm">Cancel</button>
                    </div>
                    
                    <div class="w-100">
                        <div class="w-20 float-right">
                            <button class="button primary outline" id="bulkDeleteBtn">Delete</button>
                        </div>
                    </div>
                </div>
                <div id="" class="mt-15">
                    <div class="card shadow-medium">
                        <table id="allComplaintsTable" class="table striped">
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
                                    <th>Date Submitted</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modals --}}
    {{-- Edit --}}
    {{-- <div class="dialog" id="editDialog" data-role="dialog">
        <div class="dialog-title">Edit Branch</div>
        <div class="dialog-content">
            <div class="cell-sm-12 cell-md-6">
                <div class="form-group mb-4">
                    <label class="form-label">Branch Name</label>
                    <input type="text" id="editBranchName" class="form-control" placeholder="Branch Name">
                </div>

            </div>
            <div class="cell-sm-12 cell-md-6">
                <div class="form-group mb-4">
                    <label class="form-label">Region</label>
                    <input type="text" id="editRegion" class="form-control" placeholder="Region">
                </div>
            </div>
        </div>
        <div class="dialog-actions">
            <button class="button js-dialog-close">Cancel</button>
            <button id="confirmEdit" class="button info">Update</button>
        </div>
    </div> --}}

    {{-- Delete --}}
    {{-- <div class="dialog" id="deleteDialog" data-role="dialog">
        <div class="dialog-title">Delete Branch?</div>
        <div class="dialog-content">Are you sure you want to delete this Branch?</div>
        <div class="dialog-actions">
            <button class="button js-dialog-close">Cancel</button>
            <button id="confirmDelete" class="button alert">Delete</button>
        </div>
    </div> --}}

    {{-- Bulk Delete --}}
    {{-- <div class="dialog" id="bulkDeleteDialog" data-role="dialog">
        <div class="dialog-title">Delete Branches?</div>
        <div class="dialog-content">Are you sure you want to delete these Branches?</div>
        <div class="dialog-actions">
            <button class="button js-dialog-close">Cancel</button>
            <button id="confirmBulkDelete" class="button alert">Delete</button>
        </div>
    </div> --}}
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/self/all-complaints.js') }}"></script>
@endsection
