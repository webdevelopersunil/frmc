<div class="card-header pb-0" style="background-color: white;" >
    <div class="d-flex flex-row justify-content-between align-items-center">

        <div>
            <!-- <div style="padding-bottom:10px;">
                <h4 class="mb-0">Work Centre</h4>
            </div> -->
            <select class="form-select filter-select-css radius-border" name="work_centre" onchange="updateUrl('work_centre', this.value)">
                <option selected disabled value="">Select Work Centre</option>
                <option {{'Delhi' == request()->query('work_centre') ? 'selected' : ''}} value="Delhi">Delhi</option>
                <option {{'Dehradun' == request()->query('work_centre') ? 'selected' : ''}} value="Dehradun">Dehradun</option>
                <option {{'Mumbai' == request()->query('work_centre') ? 'selected' : ''}} value="Mumbai">Mumbai</option>
                <option {{'Ahmedabad' == request()->query('work_centre') ? 'selected' : ''}} value="Ahmedabad">Ahmedabad</option>
            </select>
        </div>
        &nbsp
        <div>
            <!-- <div style="padding-bottom:10px;">
                <h4 class="mb-0">Department Section</h4>
            </div> -->
            <select class="form-select filter-select-css radius-border" name="department_section" onchange="updateUrl('department_section', this.value)">
                <option selected disabled value="">Select Department Section</option>
                <option {{'Delhi Department 1' == request()->query('department_section') ? 'selected' : ''}} value="Delhi Department 1">Delhi Department 1</option>
                <option {{'Delhi Department 2' == request()->query('department_section') ? 'selected' : ''}} value="Delhi Department 2">Delhi Department 2</option>
                <option {{'Dehradun Department 1' == request()->query('department_section') ? 'selected' : ''}} value="Dehradun Department 1">Dehradun Department 1</option>
                <option {{'Dehradun Department 2' == request()->query('department_section') ? 'selected' : ''}} value="Dehradun Department 2">Dehradun Department 2</option>
                <option {{'Mumbai Department 1' == request()->query('department_section') ? 'selected' : ''}} value="Mumbai Department 1">Mumbai Department 1</option>
                <option {{'Mumbai Department 2' == request()->query('department_section') ? 'selected' : ''}} value="Mumbai Department 2">Mumbai Department 2</option>
                <option {{'Ahmedabad Department 1' == request()->query('department_section') ? 'selected' : ''}} value="Ahmedabad Department 1">Ahmedabad Department 1</option>
                <option {{'Ahmedabad Department 2' == request()->query('department_section') ? 'selected' : ''}} value="Ahmedabad Department 2">Ahmedabad Department 2</option>
            </select>

            <button class="form-select filter-select-css radius-border" onclick="window.location.href = '{{ route('user.complaints') }}';">Clear Filter</button>

        </div>

        <div class="ml-auto">
            <form class="d-flex" action="{{ route($route) }}" method="get"> <!-- Change form method to GET -->
                
            <input class="form-control me-2 radius-border search-input" 
                type="text" 
                name="text" 
                placeholder="Search" 
                aria-label="Search"
                value="{{ request()->filled('text') ? request()->input('text') : '' }}">

                &nbsp;
                <button class="btn btn-outline-primary button-search" type="submit">Search</button>
            </form>
        </div>

    </div>
</div>


<script>
    function updateUrl(param, value) {
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.delete(param); // Remove any existing occurrences of the parameter
        urlParams.append(param, value); // Append the updated parameter
        const textInput = document.querySelector('input[name="text"]').value; // Get the value of the text input
        urlParams.set('text', textInput); // Set the text input value in the query string
        window.location.href = window.location.pathname + '?' + urlParams.toString(); // Update the URL
    }
</script>