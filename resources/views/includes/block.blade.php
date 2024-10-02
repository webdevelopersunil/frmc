<div class="row padding-30px">

    <div class="col-lg-4">
        @php
            if (auth()->user()->hasRole('nodal')) {
                $route = "nodal.complaints";
            } elseif (auth()->user()->hasRole('fco')) {
                $route = "fco.complaints";
            } elseif (auth()->user()->hasRole('frmc_user')) {
                $route = "frmc.complaints";
            }
        @endphp
        <a href="{{ route($route) }}">
            <button type="button" style="width: 301px; height: 106px; background-color: #08AF73; color: white; border-radius: 10px; display: flex; align-items: center; justify-content: center;" class="btn">
                <div style="width: 47px; height: 47px;line-height: 47px; background-color: #DEF9E7; display: inline-block; border-radius: 10px;">
                    <img src="{{ asset('assets/theme/image/List View green.png') }}" alt="">
                </div>
                <span style="text-align: center; margin-left: 10px;" class="text-start"> Total Complaints <br> {{ $total }}</span>
            </button>
        </a>
    </div>

    <div class="col-lg-4">
        <a href="{{ route($route) }}?status=closed">
            <button type="button"
                style="width: 301px; height: 106px; background-color: #db5585; color: white; border-radius: 10px;display: flex; align-items: center; justify-content: center;"
                class="btn">
                <div style="width: 47px; height: 47px;line-height: 47px; background-color: #FFD2D2; display: inline-block; border-radius: 10px;">
                    <img src="{{ asset('assets/theme/image/list view red.png') }}" alt="">
                </div><span style="text-align: center; margin-left: 10px;" class="text-start">
                    Closed Complaints<br> {{ isset($closed) ? $closed : 0 }}</span>
            </button></a>
    </div>

    <div class="col-lg-4">
        <a href="{{ route($route) }}?status=in_progress">
            <button type="button"
                style="width: 301px; height: 106px; background-color: #08AF73; color: white; border-radius: 10px;display: flex; align-items: center; justify-content: center;"
                class="btn">
                <div
                    style="width: 47px; height: 47px;line-height: 47px; background-color: #DEF9E7; display: inline-block; border-radius: 10px;">
                    <img src="{{ asset('assets/theme/image/In Progress.png') }}" alt="">
                </div><span style="text-align: center; margin-left: 10px;" class="text-start">In
                    Progress Complaints<br> {{ $progress > 0 ? $progress : 0 }}</span>
            </button></a>
    </div>

</div>