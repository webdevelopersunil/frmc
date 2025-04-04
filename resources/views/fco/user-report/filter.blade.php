<div style="margin-top: 10px;" ></div>
<nav class="navbar navbar-expand-lg bg-white" data-bs-theme="dark">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarColor01">

            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <select class="form-select filter-select-css radius-border" name="role" onchange="updateUrl('role', this.value)">
                            <option selected disabled value="">Select User Role</option>
                            <option {{"user" == request()->query('role') ? 'selected' : ''}} value="user">USER</option>
                            <option {{"nodal" == request()->query('role') ? 'selected' : ''}} value="nodal">NODAL OFFICER</option>
                            <option {{"fco" == request()->query('role') ? 'selected' : ''}} value="fco">FCO OFFICER</option>
                            <option {{"frmc_user" == request()->query('role') ? 'selected' : ''}} value="frmc_user">FRMC OFFICER</option>
                        </select>
                    </div>
                </li>

                <div>&nbsp </div>

            </ul>

            <form class="d-flex" id="search-form" >

                <div class="input-container-new">
                    <form class="d-flex" action="{{ route($route) }}" method="get" id="search-form" >
                        <input class="form-control ph-no"  type="text" id="exampleFormControlInput1"  name="text"  placeholder="Search"  aria-label="Search" value="{{ request()->filled('text') ? request()->input('text') : '' }}">
                        <a href=""><img src="{{ asset('assets/theme/image/Search.png') }}" alt="" class="img-fluid search-icon"></a>
                    </form>
                </div>

                <div>&nbsp </div>
                <button type="button" onclick="submitForm()" style="background-color: #08AE72;" class="btn btn-success">Search</button>

                <div>&nbsp </div>
                <button type="button" onclick="redirectToDashboard()" class="btn btn-success">Clear</button>

            </form>

            @if(auth()->user()->hasRole('fco'))
                <div>&nbsp </div>
                <form action="{{ route('user.report.export') }}" method="GET" class="d-flex">
                    <input type="hidden" name="role" value="{{ request('role') }}">
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