<x-app-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title" style="display:flex;" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="vertical-align: middle; margin-right: 8px;">
                                <path fill="currentColor" d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"/>
                            </svg>Assigned Complaints
                        </p>
                        <br>
                        
                        @include('includes/message-block')<!-- Error Section Start Here 'message-block' -->
                        
                        @include('filters.filter', ['route' => 'nodal.complaints'])
                        <!-- File Section Start Here 'message-block' -->

                        <br>
                        
                        <div class="table-responsive">
                            <table id="example" class="display expandable-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th> #Index </th>
                                        <th> Complaint No. </th>
                                        <th> Date of Complaint </th>
                                        <th> Complaint Against </th>
                                        <th> Department/Section </th>
                                        <th> ONGC Work Centre </th>
                                        <th> complaint Status </th>
                                        <th> Preliminary Report</th>
                                        <th> Public Detailed Status </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if( count($lists) == 0 )
                                        <tr>
                                            <td colspan="10" >
                                                <div class="alert alert-danger text-center" role="alert">
                                                    No data found
                                                </div>
                                            </td>
                                        </tr>
                                    @endif

                                    @foreach($lists as $index => $list)
                                    <tr>
                                        <td> {{ $index + 1 }} </td>
                                        <td> {{ $list->complain_no }} </td>
                                        <td> {{ \Carbon\Carbon::parse($list->created_at)->format('d F Y') }}</td>
                                        <td> {{ $list->against_persons }} </td>
                                        <td> {{ $list->department_section }} </td>
                                        <td> {{ $list->work_centre }} </td>
                                        <td> {{ $list->complaint_status }} </td>
                                        <td>
                                            @if( isset($list->preliminaryReport->id) )
                                                <a href="{{ route('preview.file',$list->preliminaryReport->id) }}" target="_blank" class="text-color d-block text-truncate">
                                                    View Report
                                                </a>
                                            @else
                                                <a href="#" class="text-danger d-block text-truncate">
                                                    No Report Found
                                                </a>
                                            @endif
                                        </td>
                                        <td>{{ $list->public_status ? $list->public_status : '---' }}</td>
                                        <td>
                                            <a href="{{ route('user.nodal.view', $list->id) }}" class="btn btn-sm link-with-icon"> <i class="ti-eye "></i> </a>
                                            <a href="{{ route('nodal.complaint.edit', $list->id) }}" class="btn btn-sm link-with-icon"> <i class="ti-pencil "></i> </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $lists->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>