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

    <h2>Categories</h2>

    <!-- breadcrumbs -->
    <ul class="breadcrumbs mb-5" style="--breadcrumbs-background: #f0f0f0; --breadcrumbs-color: #333333;">
        <li class="active" data-divider="›"><a href="#"><span class="icon mif-home"></span>Categories</a></li>
        {{-- <li data-divider="›"><a href="#">Library</a></li>
    <li class="active"><a href="#">Data</a></li> --}}
    </ul>
    <div class="grid">
        <div class="row flex-justify-center">
            <div class=" cell-md-12 flex-align-center">
                <div class="mt-10">
                    <div class="w-50">
                        <button class="info outline" type="button" id="showCategoryForm">Add New Category</button>
                        <button class="secondary outline" type="button" id="cancelShowCategoryForm">Cancel</button>
                    </div>
                    <div id="branchForm">
                        <form method="POST" id="categoryAdd">
                            @csrf
                            <div class="row my-5">
                                <div class="cell-sm-12 cell-md-6">
                                    <div class="form-group mb-4">
                                        <label class="form-label" for="category">Category</label>
                                        <input class="form-control" id="category" name="categoryName"
                                            type="text" />
                                    </div>
                                </div>
                                <div class="cell-sm-12 cell-md-6">
                                    <div class="form-group mb-4">
                                        <label class="form-label" for="subCategory">Sub Category</label>
                                        <input class="form-control" id="subCategory" name="subCategoryName"
                                            type="text" />
                                    </div>
                                </div>
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
                        <table id="categoriesTable" class="table striped">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAll"></th>
                                    <th>Category</th>
                                    <th>Sub-Category</th>
                                    <th>Date Created</th>
                                    <th>Action</th>
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
    <div class="dialog" id="addSubCategoryDialog" data-role="dialog">
    <div class="dialog-title">Add Sub-Category</div>
    <div class="dialog-content">
        <input type="hidden" id="subCategoryParentId"> {{-- ✅ stores category id --}}
        <div class="form-group">
            <label>Sub-Category Name</label>
            <input type="text" id="newSubCategoryName" class="form-control" placeholder="Sub-Category Name">
        </div>
    </div>
    <div class="dialog-actions">
        <button class="button js-dialog-close">Cancel</button>
        <button id="confirmAddSubCategory" class="button info">Add</button>
    </div>
</div>
    {{-- Edit --}}
    <div class="dialog" id="editDialog" data-role="dialog">
        <div class="dialog-title">Edit Branch</div>
        <div class="dialog-content">
            <input type="text" id="editCategoryName" class="form-control" placeholder="Category Name">
        </div>
        <div class="dialog-actions">
            <button class="button js-dialog-close">Cancel</button>
            <button id="confirmEdit" class="button info">Update</button>
        </div>
    </div>

    {{-- Delete --}}
    <div class="dialog" id="deleteDialog" data-role="dialog">
        <div class="dialog-title">Delete Category?</div>
        <div class="dialog-content">Are you sure you want to delete this Category?</div>
        <div class="dialog-actions">
            <button class="button js-dialog-close">Cancel</button>
            <button id="confirmDelete" class="button alert">Delete</button>
        </div>
    </div>

    {{-- Bulk Delete --}}
    <div class="dialog" id="bulkDeleteDialog" data-role="dialog">
        <div class="dialog-title">Delete Categories?</div>
        <div class="dialog-content">Are you sure you want to delete these Categories?</div>
        <div class="dialog-actions">
            <button class="button js-dialog-close">Cancel</button>
            <button id="confirmBulkDelete" class="button alert">Delete</button>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/self/categories.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
    <script>
        $(function() {
            $('#branchForm').hide();
            $('#cancelShowCategoryForm').hide();

            $('#showCategoryForm').on('click', function() {
                $(this).fadeOut(200, function() { //  fade out Add button first
                    $('#branchForm').slideDown(300); //  then slide form down
                    $('#cancelShowCategoryForm').fadeIn(200); //  then fade in Cancel
                });
            });

            $('#cancelShowCategoryForm').on('click', function() {
                $('#branchForm').slideUp(300, function() { //  slide form up first
                    $('#cancelShowCategoryForm').fadeOut(100); //  then fade out Cancel
                    $('#showCategoryForm').fadeIn(200); //  then fade in Add button
                });
            });
        });
    </script>
@endsection
