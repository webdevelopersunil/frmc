
<div class="row padding-30px">
        <!-- <div class="col-lg-2 d-flex align-items-center" style="gap: 10px;">
            <span>show</span>
            <select class="form-select" aria-label="Default select example" style="width: auto !important;">
                <option selected>21</option>
                <option value="1">2</option>
                <option value="2">3</option>
                <option value="3">4</option>
            </select>
            <span>entries</span>
        </div> -->

        <div class="col-lg-3 d-flex align-items-center" style="gap: 10px;">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <select class="form-select filter-select-css radius-border" name="work_centre" onchange="updateUrl('work_centre', this.value)">
                    <option selected disabled value="">Select Work Centre</option>
                    <option {{'Delhi' == request()->query('work_centre') ? 'selected' : ''}} value="Delhi">Delhi</option>
                    <option {{'Dehradun' == request()->query('work_centre') ? 'selected' : ''}} value="Dehradun">Dehradun</option>
                    <option {{'Mumbai' == request()->query('work_centre') ? 'selected' : ''}} value="Mumbai">Mumbai</option>
                    <option {{'Ahmedabad' == request()->query('work_centre') ? 'selected' : ''}} value="Ahmedabad">Ahmedabad</option>
                </select>
            </div>
        </div>

        <div class="col-lg-3 d-flex align-items-center" style="gap: 10px;">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <select class="form-select filter-select-css radius-border" name="department_section" onchange="updateUrl('department_section', this.value)" >
                <!-- style="background-color: #08AE72; border-radius:9px; color: white;" -->
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
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="input-container-new">
                <form class="d-flex" action="{{ route($route) }}" method="get" id="search-form" >
                    <input class="form-control ph-no"  type="text" id="exampleFormControlInput1"  name="text"  placeholder="Search"  aria-label="Search" value="{{ request()->filled('text') ? request()->input('text') : '' }}">
                    <a href=""><img src="{{ asset('assets/theme/image/Search.png') }}" alt="" class="img-fluid search-icon"></a>
                </form>
            </div>
        </div>

        <div class="col-lg-2">
            <button type="button" onclick="submitForm()" class="btn btn-success">Search</button>
            <button type="button" onclick="redirectToDashboard()" class="btn btn-success">Clear</button>
        </div>
    </div>



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