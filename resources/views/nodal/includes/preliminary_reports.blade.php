<div class="accordion col-lg-12" id="accordionExample">
    <div class="accordion-item mb-3">
        <h2 class="accordion-header">
        <button class="accordion-button" type="button" data-bs-toggle="collapse"
            style="background: #02AC6F; color: #fff;" data-bs-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            Preliminary Report
        </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            
            <div class="col-lg-12">
            <table class="table complainant-view-table">
            <thead>
                <tr>
                    <th>&nbsp</th>
                    <th>Preliminary Report</th>
                    <th>Upload Date & Time</th>
                </tr>
            </thead>

            <tbody>
            
            @if(isset($complain->nodalPreliminaryReports))
                @foreach ( $complain->nodalPreliminaryReports as $index => $row )
                    
                    <tr>
                        <td></td>
                        <td style="border-top-left-radius: 10px;border-bottom-left-radius: 10px;">
                            <span> <a href="{{ route('preview.file',$row->file->id) }}" target="_blank" style="color: #02AC6F;" > 
                                <img src="{{ asset('assets/theme/image/Document.png') }}" alt="">
                                    View Preliminary Reports Report
                            </a> </span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d F Y, h:i A') }}</td>
                    </tr>
                    <tr style="height: 15px;"></tr>

                @endforeach
            @else
                <tr>
                    <td colspan="3" style="text-align:center;" >No Record Found</td>
                </tr>
                <tr style="height: 15px;"></tr>
            @endif
            </tbody>
        </table>
            </div>
        </div>
        </div>
    </div>
</div>