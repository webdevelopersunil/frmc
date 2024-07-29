<x-app-layout>

    <div class="row padding-30px">
        <div class="col-lg-3 d-flex align-items-center" style="gap: 10px;">
            <span>show</span>
            <select class="form-select" aria-label="Default select example" style="width: auto !important;">
                <option selected>21</option>
                <option value="1">2</option>
                <option value="2">3</option>
                <option value="3">4</option>
            </select>
            <span>entries</span>
        </div>
        
        <div class="col-lg-7">
            <div class="input-container-new">
                <input type="text" class="form-control ph-no" id="exampleFormControlInput1" placeholder="Search...">
                <a href=""><img src="{{ asset('assets/theme/image/Search.png') }}" alt="" class="img-fluid search-icon"></a>
            </div>
        </div>

        <div class="col-lg-2">
            <select class="form-select" aria-label="Default select example"
                style="width: auto !important;background-color: #9C3132;border-radius: 12px;color: #fff;background-image: url('./image/down\ arrow\ white.png');background-size: 16px 16px;">
                <option selected>Filter</option>
                <option value="1">Filter1</option>
                <option value="2">Filter2</option>
                <option value="3">Filter3</option>
            </select>
        </div>
    </div>

    <div class="row padding-15px" style="background: #fff;margin: 0 20px;">

        <div class="col-lg-12 d-flex justify-content-between align-items-center" style="margin: 20px 0;">
            <h3 class="profile-name">Complaint List</h3>
            <div class="add-complaint-button">
                <a  href="{{ route('user.complaint.create') }}" >+ Add Complaints</a>
                <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Launch demo modal
                </button> -->
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
                        <th scope="col">Department/<br>Section</th>
                        <th scope="col">ONGC Work Centre</th>
                        <th scope="col">Complaint Status</th>
                        <th scope="col">Public Detailed Status</th>
                        <th style="border-top-right-radius: 11px;border-bottom-right-radius: 11px;" scope="col">Action</th>
                    </tr>
                    <tr style="height: 15px;"></tr>
                </thead>
                <tbody>

                    @foreach($lists as $index => $list)
                        <tr onclick="window.location.href='viewcomplainant.html'" 
                            @if(($index + 1) % 2 != 0) style="cursor: pointer;background: #08AE72;color: #fff;" @else style="background: #FFC700;color:#000;" @endif >
                            <td scope="row" style="border-top-left-radius: 11px;border-bottom-left-radius: 11px;">#{{ ($lists->currentPage() - 1) * $lists->perPage() + $loop->iteration }}</td>
                            <td>{{ $list->complain_no }}</td>
                            <td>{{ \Carbon\Carbon::parse($list->created_at)->format('d F Y') }}</td>
                            <td>{{ $list->against_persons }}</td>
                            <td>{{ $list->department_section }}</td>
                            <td>{{ $list->work_centre }}</td>
                            <td>{{ $list->complaint_status }}</td>
                            <td>{{ $list->public_status ? $list->public_status : '---' }}</td>
                            <td style="border-top-right-radius: 11px;border-bottom-right-radius: 11px;">
                                <a  href="{{ route('user.complaint.view', $list->id) }}">
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


    <div class="row justify-content-center" style="background: #fff;margin: 0 20px;padding-bottom: 20px;">
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
    </div>    
</div>

</x-app-layout>
