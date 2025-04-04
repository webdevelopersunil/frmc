<x-app-layout>

<div class="row padding-15px" style="background: #fff;margin: 0 20px;">

    <div class="col-lg-12 d-flex justify-content-between align-items-center" style="margin: 20px 0;">
        <h3 class="profile-name">Report's</h3>
    </div>

    <!-- Error Section Start Here 'message-block' -->
        @include('includes/message-block')
    <!-- Error Section Ends Here -->

    <!-- File Section Start Here 'message-block' -->
    @include('fco.user-report.filter', ['route' => 'fco.user.report'])
    <!-- File Section Start Here 'message-block' -->

    <div class="col-lg-12">
        <table class="table table-striped complainant-table">
            <thead>
                <tr>
                    <th style="border-top-left-radius: 11px;border-bottom-left-radius: 11px;" scope="col">ID</th>
                    <th scope="col" >Name</th>
                    <th scope="col" >Role</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Email</th>
                    <th scope="col">Username</th>
                    <th scope="col">Phone</th>
                    <th scope="col">State</th>
                    <th style="border-top-right-radius: 11px;border-bottom-right-radius: 11px;" scope="col">Action</th>
                </tr>
                <tr style="height: 15px;"></tr>
            </thead>
            <tbody>

                @foreach($lists as $index => $list)
                    <tr @if(($index + 1) % 2 != 0) style="cursor: pointer;background: #08AE72;color: #fff;" @else style="background: #FFC700;color:#000;" @endif >

                        <td scope="row" style="border-top-left-radius: 11px;border-bottom-left-radius: 11px;">
                            #{{ ($lists->currentPage() - 1) * $lists->perPage() + $loop->iteration }}
                        </td>
                        <td>{{ $list->name }}</td>
                        <td>{{ ucfirst($list->roles->first()->name) ?? 'N/A' }}</td>
                        <td>{{ $list->cpfNo }}</td>
                        <td>{{ $list->email }}</td>
                        <td>{{ $list->username }}</td>
                        <td>{{ $list->phone }}</td>
                        <td>{{ $list->state }}</td>
                        
                        <td style="border-top-right-radius: 11px;border-bottom-right-radius: 11px;">
                            <a  href="{{ route('fco.user.profile', $list->id) }}">
                                <img src="{{ asset('assets/theme/image/white view.png') }}" alt="">
                            </a>
                        </td>
                    </tr>
                    <tr style="height: 15px;"></tr>
                @endforeach

            </tbody>
            
        </table>
    </div>

    <!-- Dashboard Information Block Start -->
    @include('includes/pagination')
    <!-- Dashboard Information Block End -->

</div>
</x-app-layout>
