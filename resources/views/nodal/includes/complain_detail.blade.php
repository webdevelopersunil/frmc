<!-- Preliminary Report By Nodal -->


<div class="accordion col-lg-12" id="accordionExample">
    <div class="accordion-item mb-3">
        <h2 class="accordion-header">
        <button class="accordion-button" type="button" data-bs-toggle="collapse"
            style="background: #02AC6F; color: #fff;" data-bs-target="#collapseOne" aria-expanded="true"
            aria-controls="collapseOne">
            Document Uploaded By Nodal
        </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <div class="col-lg-12">
            <table class="table complainant-view-table">
            <thead>
                <tr>
                    <th>Documents Uploaded by Nodal</th>
                    <th>Upload Date & Time</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
            @if( count($complain->nodalAdditionalDetails) >= 1 )
                @foreach($complain->nodalAdditionalDetails as $index => $detail)
                        <tr>
                            <td style="border-top-left-radius: 10px;border-bottom-left-radius: 10px;">
                                <span> <a href="{{ route('preview.file',$detail->file->id) }}" target="_blank" style="color: #02AC6F;" > 
                                    <img src="{{ asset('assets/theme/image/Document.png') }}" alt="">
                                        {{ $complain->complain_no }}
                                </a> </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($complain->created_at)->format('d F Y') }}</td>
                            <td style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;">
                                {{ Str::limit(ucfirst($detail->description), 800) }}
                            </td>
                        </tr>
                        <tr style="height: 15px;"></tr>

                    @endforeach
                @else
                    <tr>
                        <td colspan="3" style="text-align:center;" >No Record Found</td>
                    </tr> <tr style="height: 15px;"></tr>
                @endif
            </tbody>
        </table>
            </div>

            
        </div>
        </div>
    </div>
</div>