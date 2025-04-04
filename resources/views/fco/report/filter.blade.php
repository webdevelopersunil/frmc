<div style="margin-top: 10px;" ></div>
<nav class="navbar navbar-expand-lg bg-white" data-bs-theme="dark">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarColor01">

            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <select class="form-select filter-select-css radius-border" name="work_centre" onchange="updateUrl('work_centre', this.value)">
                            <option selected disabled value="">Select Work Centre</option>
                            @foreach ($workCenters as $workCenter )
                                <option {{$workCenter->id == request()->query('work_centre') ? 'selected' : ''}} value="{{ $workCenter->id }}">{{ $workCenter->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </li>

                <div>&nbsp </div>

                <li class="nav-item">
                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <select class="form-select filter-select-css radius-border" name="complaint_status_id" onchange="updateUrl('complaint_status_id', this.value)" >
                            <option selected disabled value="">Select Status</option>
                            @if($complaintStatus)
                                @foreach ($complaintStatus as $status)
                                    <option {{ $status->id == request()->query('complaint_status_id') ? 'selected' : ''}} value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </li>


                <div>&nbsp </div>

                <li class="nav-item">
                    <div class="btn-group" role="group" aria-label="Date range filter">
                        <input type="date" class="form-control radius-border" value="{{request()->query('start_date')}}" id="start_date" name="start_date" placeholder="Start Date" onchange="updateUrl('start_date', this.value)" />
                    </div>
                </li>

                <div>&nbsp </div>

                <li class="nav-item">
                    <div class="btn-group" role="group" aria-label="Date range filter">
                    <button type="button" 
                        onclick="window.location.href='{{ route('fco.report') }}'" 
                        style="background-color: #08AE72;" 
                        class="btn btn-success">
                        Clear
                    </button>                                
                    </div>
                </li>

            </ul>

            @if(auth()->user()->hasRole('fco'))
                <div>&nbsp </div>
                <form action="{{ route('complains.export') }}" method="GET" class="d-flex">
                    <input type="hidden" name="work_centre" value="{{ request('work_centre') }}">
                    <input type="hidden" name="department_section" value="{{ request('department_section') }}">
                    <input type="hidden" name="text" value="{{ request('text') }}">

                    <button type="submit" class="btn btn-outline-success">Export</button>
                </form>
            @endif

        </div>
    </div>
</nav>


<script>

    function submitForm() {
        document.getElementById('search-form').submit();
    }
    
    function redirectToDashboard() {
        window.location.href = "{{ route($route) }}";
    }

    function updateUrl(param, value) {
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.delete(param); // Remove any existing occurrences of the parameter
        urlParams.append(param, value); // Append the updated parameter
        const textInput = document.querySelector('input[name="text"]').value; // Get the value of the text input
        urlParams.set('text', textInput); // Set the text input value in the query string
        window.location.href = window.location.pathname + '?' + urlParams.toString(); // Update the URL
    }

</script>