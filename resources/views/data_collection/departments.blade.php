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

    <h2>Departments</h2>

    <!-- breadcrumbs -->
    <ul class="breadcrumbs mb-5" style="--breadcrumbs-background: #f0f0f0; --breadcrumbs-color: #333333;">
        <li class="active" data-divider="›"><a href="#"><span class="icon mif-home"></span>Departments</a></li>
        {{-- <li data-divider="›"><a href="#">Library</a></li>
    <li class="active"><a href="#">Data</a></li> --}}
    </ul>
    <div class="grid">
        <div class="row flex-justify-center">
            <div class=" cell-md-12 flex-align-center">
                <div class="mt-10">
                    <div class="w-50">
                        <button class="info outline" type="button" id="showDepartmentForm">Add New Department</button>
                        <button class="secondary outline" type="button" id="cancelShowDepartmentForm">Cancel</button>
                    </div>
                    <div id="departmentForm">
                        <form action="{{ route('departments.store') }}" method="POST" id="departmentAdd">
                            @csrf
                            <div class="row my-5">
                                <div class="cell-sm-12 cell-md-6">
                                    <div class="form-group mb-4">
                                        <label class="form-label" for="departmentName">Department Name</label>
                                        <input class="form-control" id="departmentName" name="departmentName"
                                            type="text" />
                                    </div>
                                </div>
                                {{-- <div class="cell-sm-12 cell-md-4">
                                <div class="form-group mb-4">
                                    <label class="form-label" for="complaintSubType">Complaint Sub-Type</label>
                                    <select name="" id="ageRange" name="complaintSubType">
                                        <option value="select">Select Complaint Sub-Type</option>
                                        <option value="Activation">Activation</option>
                                        <option value="Re-Issue">Re-Issue</option>
                                        <option value="Deactivate">Deactivate</option>
                                        <option value="Modify">Modify</option>
                                    </select>
                                </div>
                            </div> --}}
                            </div>


                            <!-- Submit button -->
                            <div class="w-20">
                                <button type="submit" class="info outline" id="submitBtn">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="w-100">
                        <div class="w-20 float-right">
                            <button class="button primary outline" id="bulkDeleteBtn">Delete</button>
                        </div>
                    </div>
                </div>
                <div id="" class="mt-15">
                    <div class="card shadow-medium">
                        <table id="departmentsTable" class="table striped">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAll"></th>
                                    <th>Department Name</th>
                                    <th>Date Created</th>
                                    <th>Date Updated</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @forelse($departments as $department)
                                    <tr>
                                        <td><input type="checkbox" class="rowCheckBox"></td>
                                        <td>{{ $department->departmentName }}</td>
                                        <td>{{ $department->created_at->format('d/m/Y g:ia') }}</td>
                                        <td>{{ $department->updated_at->format('d/m/Y g:ia') }}</td>
                                        <td>
                                            <button data-id="{{ $department->id }}"
                                                data-name="{{ $department->departmentName }}"
                                                class="button info outline editBtn">Edit</button>
                                            <button data-id="{{ $department->id }}"
                                                class="button primary outline deleteBtn">Delete</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr id="emptyRow">
                                        <td colspan="4">No departments found.</td>
                                    </tr>
                                @endforelse --}}
                            </tbody>
                        </table>
                        {{-- <div class="mt-3 pagination">
                {{ $users -> links() }}
            </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modals --}}
    {{-- Edit --}}
    <div class="dialog" id="editDialog" data-role="dialog">
        <div class="dialog-title">Edit Department</div>
        <div class="dialog-content">
            <input type="text" id="editDepartmentName" class="form-control" placeholder="Department Name">
        </div>
        <div class="dialog-actions">
            <button class="button js-dialog-close">Cancel</button>
            <button id="confirmEdit" class="button info">Update</button>
        </div>
    </div>

    {{-- Delete --}}
    <div class="dialog" id="deleteDialog" data-role="dialog">
        <div class="dialog-title">Delete Department?</div>
        <div class="dialog-content">Are you sure you want to delete this Department?</div>
        <div class="dialog-actions">
            <button class="button js-dialog-close">Cancel</button>
            <button id="confirmDelete" class="button alert">Delete</button>
        </div>
    </div>

    {{-- Bulk Delete --}}
    <div class="dialog" id="bulkDeleteDialog" data-role="dialog">
        <div class="dialog-title">Delete Departments?</div>
        <div class="dialog-content">Are you sure you want to delete these Departments?</div>
        <div class="dialog-actions">
            <button class="button js-dialog-close">Cancel</button>
            <button id="confirmBulkDelete" class="button alert">Delete</button>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/self/departments.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
    <script>
        $(function() {
            $('#departmentForm').hide();
            $('#cancelShowDepartmentForm').hide();

            $('#showDepartmentForm').on('click', function() {
                $(this).fadeOut(200, function() { //  fade out Add button first
                    $('#departmentForm').slideDown(300); //  then slide form down
                    $('#cancelShowDepartmentForm').fadeIn(200); //  then fade in Cancel
                });
            });

            $('#cancelShowDepartmentForm').on('click', function() {
                $('#departmentForm').slideUp(300, function() { //  slide form up first
                    $('#cancelShowDepartmentForm').fadeOut(100); //  then fade out Cancel
                    $('#showDepartmentForm').fadeIn(200); //  then fade in Add button
                });
            });
        });
    </script>
@endsection
