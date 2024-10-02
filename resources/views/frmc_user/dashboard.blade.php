<x-app-layout>
    
    <div class="row padding-30px">

        <div class="row padding-15px" style="background: #fff;margin: 0 20px;">

            <!-- Dashboard Information Block Start -->
            @include('includes/block')
            <!-- Dashboard Information Block End -->

            <!-- Error Messages Block Start -->
            @include('includes/message-block')
            <!-- Error Messages Block End -->

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
                            <tr onclick="window.location.href='javascript:void(0)'" 
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
                                    <a  href="{{ route('frmc.complaint.view', $list->id) }}">
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
    </div>

</x-app-layout>
