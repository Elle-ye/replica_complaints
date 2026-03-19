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

    <h2>New Ticket</h2>

    <!-- breadcrumbs -->
    <ul class="breadcrumbs mb-5" style="--breadcrumbs-background: #f0f0f0; --breadcrumbs-color: #333333;">
        <li class="active" data-divider="›"><a href="#"><span class="icon mif-home"></span>New Ticket</a></li>
        {{-- <li data-divider="›"><a href="#">Library</a></li>
    <li class="active"><a href="#">Data</a></li> --}}
    </ul>
    <div class="grid">
        <div class="row flex-justify-center">
            <div class=" cell-md-12 flex-align-center">
                {{-- <div class="card shadow-large p-5"> --}}
                <form action="{{ route('new.ticket') }}" method="POST" id="newTicket">
                    @csrf
                    <div class="row">
                        <div class="cell-12 cell-md-4">
                            <div class="form-group">
                                <label class="" for="ticketID">Ticket ID</label>
                                <input type="text" id="ticketID" class="" name="ticketID" value="{{ $ticketID }}"
                                    readonly />
                            </div>
                        </div>
                        <div class="cell-sm-12 cell-md-4">
                            <div class="form-group">
                                <label class="" for="date">Date</label>
                                <input type="date" id="date" class="" name="date" required />
                            </div>
                        </div>
                        <div class="cell-12 cell-md-4">
                            <div class="form-group mb-4">
                                <label class="" for="ticketStatus">Ticket Status</label>
                                {{-- <input type="text" id="ticketStatus" class="" name="ticketStatus" /> --}}
                                <select id="ticketStatus" name="ticketStatus" disabled>
                                    {{-- <option value="select">Select Age Range</option> --}}
                                    <option value="New">New</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Resolved">Resolved</option>
                                    <option value="Rejected">Rejected</option>
                                </select>
                                <input type="hidden" value="New" name="ticketStatus" />
                            </div>
                        </div>
                        <div class="cell-sm-12 cell-md-4">
                            <div class="form-group mb-4">
                                <label class="" for="staffEmail">Staff Email</label>
                                <input type="email" id="staffEmail" class="" name="staffEmail" value="{{ Auth::user()->email }}" readonly />
                            </div>
                        </div>

                        <div class="cell-sm-12 cell-md-4">
                            <div class="form-group mb-4">
                                <label class="" for="form6Example4">Account Number</label>
                                <input type="text" id="form6Example4" class="" name="acctNum"  minlength="13" maxlength="13" required />
                            </div>
                        </div>
                        {{-- <div class="cell-sm-12 cell-md-4">
                            <div class="form-group mb-4">
                                <label class="" for="form6Example5">Account Number</label>
                                <input type="number" id="form6Example5" class="" name="acctNum" required />
                            </div>
                        </div> --}}
                        <div class="cell-sm-12 cell-md-4">
                            <div class="form-group mb-4">
                                <label class="" for="cardNum">Card Number</label>
                                <input class="" id="cardNum" name="cardNum" type="text"  minlength="16" maxlength="16" required/>
                            </div>
                        </div>

                        <div class="cell-sm-12 cell-md-4">
                            <div class="form-group mb-4">
                                <label class="" for="custName">Customer Name</label>
                                <input type="text" id="custName" class="" name="custName" required />
                            </div>
                        </div>
                        <div class="cell-sm-12 cell-md-4">
                            <div class="form-group mb-4">
                                <label class="form-label" for="ageRange">Age Range</label>
                                {{-- <input class="form-control" id="ageRange" name="ageRange"/> --}}
                                <select  id="ageRange" name="ageRange">
                                    <option value="select">Select Age Range</option>
                                    <option value="20-30">20-30</option>
                                    <option value="30-40">30-40</option>
                                    <option value="40-50">40-50</option>
                                    <option value="50-60">50-60</option>
                                </select>
                            </div>
                        </div>
                        <div class="cell-sm-12 cell-md-4">
                            <div class="form-group mb-4">
                                <label class="form-label" for="custEmail">Customer Email (Optional)</label>
                                <input class="form-control" id="custEmail" name="custEmail" type="email" />
                            </div>
                        </div>
                        <div class="cell-sm-12 cell-md-4">
                            <div class="form-group mb-4">
                                <label class="form-label" for="contactNum">Contact</label>
                                <input class="form-control" id="contactNum" name="contactNum" type="tel" />
                            </div>
                        </div>
                        <div class="cell-sm-12 cell-md-4">
                            <div class="form-group mb-4">
                                <label class="form-label" for="channel">Channel</label>
                                {{-- <input class="form-control" id="channel" name="channel" /> --}}
                                <select  id="channel" name="channel">
                                    <option value="select">Select Channel</option>
                                    <option value="Phone Call">Phone Call</option>
                                    <option value="Handwritten - Post delivered">Handwritten - Post delivered</option>
                                    <option value="Text Message">Text Message</option>
                                    <option value="Email">Email</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    {{-- Location Details --}}
                    <div class="row my-5">
                        <div class="cell-sm-12 cell-md-6">
                            <div class="form-group mb-4">
                                <label class="form-label" for="origin">Origination</label>
                                {{-- <input class="form-control" id="origin" name="origin" type="text" /> --}}
                                {{-- <select id="origin" name="origin"> --}}
                                <select name="origin" id="origin" class="form-control">
                                    <option value="">Select Department/Branch</option>

                                    <optgroup label="Departments">
                                        @foreach ($departments as $department)
                                            <option value="dept_{{ $department->id }}">{{ $department->departmentName }}
                                            </option>
                                        @endforeach
                                    </optgroup>

                                    <optgroup label="Branches">
                                        @foreach ($branches as $branch)
                                            <option value="branch_{{ $branch->id }}">{{ $branch->branchName }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                                {{-- <select name="department_id" id="department_id" class="form-control">
                                        <option value="">Select Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->departmentName }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <select name="branch_id" id="branch_id" class="form-control">
                                        <option value="">Select Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->departmentName }}
                                            </option>
                                        @endforeach
                                    </select> --}}

                                {{-- <option value="Ablekuma">Ablekuma</option>
                                    <option value="Tema">Tema</option>
                                    <option value="Accra">Accra</option>
                                    <option value="Navrongo">Navrongo</option>
                                </select> --}}
                            </div>
                        </div>
                        <div class="cell-sm-12 cell-md-6">
                            <div class="form-group mb-4">
                                <label class="form-label" for="destination">Destination Branch/Department</label>
                                    <select name="destination" id="destination" class="form-control">
                                    <option value="">Select Department/Branch</option>

                                    <optgroup label="Departments">
                                        @foreach ($departments as $department)
                                            <option value="dept_{{ $department->id }}">{{ $department->departmentName }}
                                            </option>
                                        @endforeach
                                    </optgroup>

                                    <optgroup label="Branches">
                                        @foreach ($branches as $branch)
                                            <option value="branch_{{ $branch->id }}">{{ $branch->branchName }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="row my-5">
                        <div class="cell-sm-12 cell-md-4">
                            <div class="form-group mb-4">
                                <label class="form-label" for="complaintSubject">Complaint Subject</label>
                                <input class="form-control" id="complaintSubject" name="complaintSubject"
                                    type="text" />
                            </div>
                        </div>
                        <div class="cell-sm-12 cell-md-4">
                            <div class="form-group mb-4">
                                <label class="form-label" for="complaintType">Complaint Type</label>
                                {{-- <input class="form-control" id="complaintType" name="complaintType" /> --}}
                                <select  id="ageRange" name="complaintType">
                                    <option value="select">Select Complaint Type</option>
                                    <option value="GH-Link">GH-Link</option>
                                    <option value="MasterCard">MasterCard</option>
                                    <option value="WebLink">WebLink</option>
                                    <option value="FastLink">FastLink</option>
                                </select>
                            </div>
                        </div>
                        <div class="cell-sm-12 cell-md-4">
                            <div class="form-group mb-4">
                                <label class="form-label" for="complaintSubType">Complaint Sub-Type</label>
                                {{-- <input class="form-control" id="complaintSubType" name="complaintSubType" /> --}}
                                <select  id="complaintSubType" name="complaintSubType">
                                    <option value="select">Select Complaint Sub-Type</option>
                                    <option value="Activation">Activation</option>
                                    <option value="Re-Issue">Re-Issue</option>
                                    <option value="Deactivate">Deactivate</option>
                                    <option value="Modify">Modify</option>
                                </select>
                            </div>
                        </div>
                        <div class="cell-sm-12 cell-md-6">
                            <div class="form-group mb-4">
                                <label class="form-label" for="complaintDescription">Complaint Description</label>
                                <textarea class="form-control" id="complaintDescription" name="complaintDescription" rows="4"></textarea>
                            </div>
                        </div>
                    </div>


                    <!-- Submit button -->
                    <button type="submit" name="submit" class="primary outline" id="submitBtn">Submit</button>
                </form>
                {{-- </div> --}}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/self/new-ticket.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
@endsection
