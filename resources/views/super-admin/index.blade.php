<x-app-layout>

    <div class="row padding-30px">    
        <div class="row padding-15px" style="background: #fff;margin: 0 20px;">
            
            <!-- Dashboard Information Block Start -->
            <div class="row padding-30px">
                <div class="col-lg-4">
                    <a href="">
                        <button type="button" style="width: 301px; height: 106px; background-color: #08AF73; color: white; border-radius: 10px; display: flex; align-items: center; justify-content: center;" class="btn">
                            <div style="width: 47px; height: 47px;line-height: 47px; background-color: #DEF9E7; display: inline-block; border-radius: 10px;">
                                <img src="{{ asset('assets/theme/image/List View green.png') }}" alt="">
                            </div>
                            <span style="text-align: center; margin-left: 10px;" class="text-start"> Total Users<br> {{$totalRecords}}</span>
                        </button>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="">
                        <button type="button"
                            style="width: 301px; height: 106px; background-color: #db5585; color: white; border-radius: 10px;display: flex; align-items: center; justify-content: center;"
                            class="btn">
                            <div style="width: 47px; height: 47px;line-height: 47px; background-color: #FFD2D2; display: inline-block; border-radius: 10px;">
                                <img src="{{ asset('assets/theme/image/list view red.png') }}" alt="">
                            </div><span style="text-align: center; margin-left: 10px;" class="text-start">Total Nodal Users<br> {{ $nodalUserCount }}</span>
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
                            </div><span style="text-align: center; margin-left: 10px;" class="text-start">Total FCO Users<br> {{ $fcoUserCount }}</span>
                        </button></a>
                </div>
            </div>
            <!-- Dashboard Information Block End -->

            <!-- Error Section Start Here 'message-block' -->
            @include('includes/message-block')
            <!-- Error Section Ends Here -->

            <!-- File Section Start Here 'message-block' -->
            @include('filters.role_filter', ['route' => 'user.roles.list', 'roles' => $roles])
            <!-- File Section Start Here 'message-block' -->

            <div class="col-lg-12">
                
                <table class="table table-striped complainant-table">
                    <thead>
                        <tr>
                            <th style="border-top-left-radius: 11px;border-bottom-left-radius: 11px;" scope="col">ID</th>
                            <th scope="col" >CPF Number</th>
                            <th scope="col">Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Role</th>
                            <th scope="col">Joined On</th>
                            <th style="border-top-right-radius: 11px;border-bottom-right-radius: 11px;" scope="col">Action</th>
                        </tr>
                        <tr style="height: 15px;"></tr>
                    </thead>
                    <tbody>
                    
                        @foreach($lists as $index => $list)
                            <tr onclick="window.location.href='javascript:void(0)'" 
                                @if(($index + 1) % 2 != 0) style="cursor: pointer;background: #08AE72;color: #fff;" @else style="background: #FFC700;color:#000;" @endif >
                                <td scope="row" style="border-top-left-radius: 11px;border-bottom-left-radius: 11px;">#{{ ($lists->currentPage() - 1) * $lists->perPage() + $loop->iteration }}</td>
                                <td>{{ $list->cpfNo }}</td>
                                <td>{{ $list->name }}</td>
                                <td>{{ $list->username }}</td>
                                <td>{{ ucfirst($list->roles[0]['name']) }}</td>
                                <td>{{ \Carbon\Carbon::parse($list->created_at)->format('d F Y') }}</td>
                                <td style="border-top-right-radius: 11px;border-bottom-right-radius: 11px;">
                                    <a  href="{{ route('user.edit', $list->id) }}">
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