<!-- resources/views/user/list.blade.php -->

<div class="container">
    <div class="row">
        <div class="col-12">
            <p>Total Records: {{ $totalRecords }}</p>
        </div>
    </div>

    <div class="row justify-content-center" style="background: #fff; margin: 0 20px; padding-bottom: 20px;">
        <div class="col-lg-6 a-color-white d-flex justify-content-between align-items-center" style="background: #00744A; color: #fff; padding: 10px 15px;">

            {{-- Previous Page Link --}}
            @if ($lists->onFirstPage())
                <span><img src="{{ asset('assets/theme/image/left arrow.png') }}" alt=""></span>
            @else
                <a href="{{ $lists->previousPageUrl() }}"><img src="{{ asset('assets/theme/image/left arrow.png') }}" alt=""></a>
            @endif

            {{-- Pagination Elements --}}
            @for ($i = 1; $i <= $totalPages; $i++)
                @if ($i == $lists->currentPage())
                    <span class="pagination active" style="padding: 5px 10px; border-radius: 5px; background-color: #fff; color: #00744A;">{{ $i }}</span>
                @else
                    <a href="{{ $lists->url($i) }}" style="padding: 5px 10px; border-radius: 5px; background-color: #00744A; color: #fff; margin: 0 2px;">{{ $i }}</a>
                @endif
            @endfor

            {{-- Next Page Link --}}
            @if ($lists->hasMorePages())
                <a href="{{ $lists->nextPageUrl() }}"><img src="{{ asset('assets/theme/image/right arrow.png') }}" alt=""></a>
            @else
                <span><img src="{{ asset('assets/theme/image/right arrow.png') }}" alt=""></span>
            @endif

            <span style="font-weight: bold;" >Go to page</span>
                <input type="text" class="form-control" id="page-input" style="width: 9%; padding: 0 5px; margin: 0 5px;" placeholder="Page no.">
                <a href="javascript:void(0);" onclick="goToPage()" >
                    <span style="font-weight: bold;" > Go</span>
                    <img src="{{ asset('assets/theme/image/right arrow only.png') }}" alt="">
                </a>
        </div>
    </div>

    <!-- @foreach($lists as $list) -->
        <!-- Display your list items here -->
    <!-- @endforeach -->

    <!-- {!! $lists->links() !!} -->
</div>

<script>
    function goToPage() {
        const page = document.getElementById('page-input').value;
        const totalPages = {{ $totalPages }};
        if (page && !isNaN(page) && page >= 1 && page <= totalPages) {
            const url = `{{ $lists->url(1) }}`.replace(/page=\d+/, `page=${page}`);
            window.location.href = url;
        } else {
            const url = `{{ $lists->url(1) }}`.replace(/page=\d+/, `page=${totalPages}`);
            window.location.href = url;
        }
    }
</script>
