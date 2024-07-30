<x-app-layout>

    <!-- File Section Start Here 'message-block' -->
    <div class="row padding-30px">
    <!-- File Section Start Here 'message-block' -->
    

    <div class="row padding-15px" style="background: #fff;margin: 0 20px;">

        <!-- <div class="col-lg-12 d-flex justify-content-between align-items-center" style="margin: 20px 0;">
            <h3 class="profile-name">Complaint List</h3>
            <div class="add-complaint-button">
                <a  href="{{ route('user.complaint.create') }}" >+ Add Complaints</a>
            </div>
        </div> -->

        <div class="row padding-30px">
            <div class="col-lg-4">
                <a href="">
                    <button type="button" style="width: 301px; height: 106px; background-color: #08AF73; color: white; border-radius: 10px; display: flex; align-items: center; justify-content: center;" class="btn">
                        <div style="width: 47px; height: 47px;line-height: 47px; background-color: #DEF9E7; display: inline-block; border-radius: 10px;">
                            <img src="{{ asset('assets/theme/image/List View green.png') }}" alt="">
                        </div>
                        <span style="text-align: center; margin-left: 10px;" class="text-start"> Total Complaints <br> {{ $total }}</span>
                    </button>
                </a>
            </div>
            <div class="col-lg-4">
                <a href="">
                    <button type="button"
                        style="width: 301px; height: 106px; background-color: #db5585; color: white; border-radius: 10px;display: flex; align-items: center; justify-content: center;"
                        class="btn">
                        <div
                            style="width: 47px; height: 47px;line-height: 47px; background-color: #FFD2D2; display: inline-block; border-radius: 10px;">
                            <img src="{{ asset('assets/theme/image/list view red.png') }}" alt="">
                        </div><span style="text-align: center; margin-left: 10px;" class="text-start">Closed
                            Complaints<br> 34</span>
                    </button></a>
            </div>
            <div class="col-lg-4">
                <a href="">
                    <button type="button"
                        style="width: 301px; height: 106px; background-color: #08AF73; color: white; border-radius: 10px;display: flex; align-items: center; justify-content: center;"
                        class="btn">
                        <div
                            style="width: 47px; height: 47px;line-height: 47px; background-color: #DEF9E7; display: inline-block; border-radius: 10px;">
                            <img src="{{ asset('assets/theme/image/In Progress.png') }}" alt="">
                        </div><span style="text-align: center; margin-left: 10px;" class="text-start">In
                            Progress Complaints<br> 34</span>
                    </button></a>
            </div>
        </div>


        <!-- Error Section Start Here 'message-block' -->
            @include('includes/message-block')
        <!-- Error Section Ends Here -->


        <div class="col-lg-12">
            <table class="table table-striped complainant-table">
                <thead>
                    <tr>
                        <th style="border-top-left-radius: 11px;border-bottom-left-radius: 11px;" scope="col">ID</th>
                        <th scope="col" >complain_no</th>
                        <th scope="col">Date of Complaint</th>
                        <th scope="col">Complaint Against</th>
                        <!-- <th scope="col">Department/<br>Section</th> -->
                        <th scope="col">ONGC Work Centre</th>
                        <th scope="col">Complaint Status</th>
                        <th> Preliminary Report</th>
                        <th scope="col">Public Detailed Status</th>
                        <th style="border-top-right-radius: 11px;border-bottom-right-radius: 11px;" scope="col">Action</th>
                    </tr>
                    <tr style="height: 15px;"></tr>
                </thead>
                <tbody>

                    @foreach($lists as $index => $list)
                        <tr onclick="window.location.href='{{ route('user.nodal.view', $list->id) }}'" 
                            @if(($index + 1) % 2 != 0) style="cursor: pointer;background: #08AE72;color: #fff;" @else style="background: #FFC700;color:#000;" @endif >
                            <td scope="row" style="border-top-left-radius: 11px;border-bottom-left-radius: 11px;">#{{ ($lists->currentPage() - 1) * $lists->perPage() + $loop->iteration }}</td>
                            <td>{{ $list->complain_no }}</td>
                            <td>{{ \Carbon\Carbon::parse($list->created_at)->format('d F Y') }}</td>
                            <td>{{ $list->against_persons }}</td>
                            <!-- <td>{{ $list->department_section }}</td> -->
                            <td>{{ $list->work_centre }}</td>
                            <td>{{ $list->complaint_status }}</td>
                            <td>
                                @if( isset($list->preliminaryReport->id) )
                                    <a href="{{ route('preview.file',$list->preliminaryReport->id) }}" target="_blank" class="d-block text-truncate text-color">
                                        View Report
                                    </a>
                                @else
                                    <a href="javascript:void(0)" class="text-white d-block text-truncate">
                                        No Report Found
                                    </a>
                                @endif
                            </td>
                            <td>{{ $list->public_status ? $list->public_status : '---' }}</td>
                            <td style="border-top-right-radius: 11px;border-bottom-right-radius: 11px;">
                                <a  href="{{ route('user.nodal.view', $list->id) }}">
                                    <img src="{{ asset('assets/theme/image/white view.png') }}" alt="">
                                </a>
                            </td>
                        </tr>
                        <tr style="height: 15px;"></tr>
                    @endforeach

                </tbody>
                
            </table>
        </div>
        
    </div>

    {{ $lists->links() }}

    <!-- <div class="row justify-content-center" style="background: #fff;margin: 0 20px;padding-bottom: 20px;">
        <div class="col-lg-6 a-color-white d-flex justify-content-between align-items-center" style="background: #00744A;color: #fff;padding: 10px 15px;">
            <a href=""><img src="{{ asset('assets/theme/image/left arrow.png') }}" alt=""></a>
            <a href="">1</a>
            <a href="" class="pegination active">2</a>
            <a href="">3</a>
            <a href="">...</a>
            <a href="">11</a>
            <a href="">12</a>
            <a href="">13</a>
            <a href=""><img src="{{ asset('assets/theme/image/logo.png') }}./image/right arrow.png" alt=""></a>
            <span>Go to page</span>

            <input type="text" class="form-control" id="exampleFormControlInput1" style="width: 9%;padding: 0 5px;">

            <a href=""><span>Go</span>
                <img src="{{ asset('assets/theme/image/right arrow only.png') }}" alt="">
            </a>
        </div>
    </div> -->
    

</div>

</x-app-layout>
