<x-app-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                    
                        <h4 class="card-title">Complaints List</h4>
                        <p class="card-description">
                            <!-- Add class <code>.table-striped</code> -->
                        </p>

                        <div class="d-flex justify-content-end mb-3">
                            <a class="btn btn-primary" href="{{ route('audit') }}">Go  Back</a>
                        </div>

                        <!-- Error Section Start Here 'message-block' -->
                            @include('includes/message-block')
                        <!-- Error Section Ends Here -->


                        <div class="table-responsive">
                            <table id="example" class="display expandable-table" style="width:100%">
                                <thead>
                                    <tr>
                                    <th> #Index </th>
                                    <th> User </th>
                                    <th> Event </th>
                                    <th> Old Changes </th>
                                    <th> New Changes </th>
                                    <th> created At </th>
                                    <th> Ip Address </th>
                                    <!-- <th> Action </th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @if( count($lists) == 0 )
                                        <tr>
                                            <td colspan="9" >
                                                <div class="alert alert-primary text-center" role="alert">
                                                    No data found
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                    @foreach($lists as $index => $list)
                                        <tr>
                                            <td> {{ $index + 1 }} </td>
                                            <td> {{ json_encode($list->user_id) }} </td>
                                            <td> {{ json_encode(ucfirst($list->event)) }} </td>
                                            <td> {{ json_encode($list->old_values) }} </td>
                                            <td> {{ json_encode($list->new_values) }} </td>
                                            <!-- <td> {{ $list }} </td> -->
                                            <td> {{ json_encode(\Carbon\Carbon::parse($list->created_at)->format('d F Y')) }}</td>
                                            <td> {{ json_encode($list->ip_address) }} </td>
                                            <!-- <td>
                                                <a href="" class="btn btn-sm">
                                                    <i class="ti-eye "></i>
                                                </a>
                                            </td> -->
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
<!-- content-wrapper ends -->

</x-app-layout>