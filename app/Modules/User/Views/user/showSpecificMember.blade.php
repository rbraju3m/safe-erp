<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm border-0 rounded">
                    <div class="card-header d-flex align-items-center" style=" color: #fff;">
                        <img src="{{ asset('uploads/member/'.$member->image_link) }}" class="rounded-circle me-2 border border-light" width="50" height="50" alt="{{ $member->name }}">
                        <h5 class="mb-0" style="color: black">Deposit Summary for {{ $member->name }}</h5>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table table-bordered text-center align-middle">
                            <thead style="background-color: #1E293B; color: #fff;">
                            <tr>
                                <th>Year</th>
                                @foreach($years as $year)
                                    <th>{{ $year }}</th>
                                @endforeach
                                <th>Total</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr>
                                <td><strong>Total</strong></td>
                                @foreach($years as $year)
                                    <td style="background-color:#059669; color:white; font-weight:bold;">
                                        {{ number_format($yearlyTotals[$year]) }}
                                    </td>
                                @endforeach
                                <td style="background-color:#0F172A; color:white; font-weight:bold;">
                                    {{ number_format($total) }}
                                </td>
                            </tr>

                            <tr>
                                <td><strong>Due</strong></td>
                                @foreach($years as $year)
                                    <td style="background-color:#DC2626; color:white; font-weight:bold;">
                                        {{ number_format($expected[$year] - $yearlyTotals[$year]) }}
                                    </td>
                                @endforeach
                                <td style="background-color:#7F1D1D; color:white; font-weight:bold;">
                                    {{ number_format($totalDue) }}
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="mt-4" style="text-align: left;">
                            <div class="d-flex align-items-center mb-1">
                                <span style="background-color:#0F172A; width:20px; height:20px; display:inline-block; border-radius:3px; margin-right:6px;"></span>
                                <b>Total Deposit / Total Due</b>
                            </div>
                            <div class="d-flex align-items-center mb-1">
                                <span style="background-color:#059669; width:20px; height:20px; display:inline-block; border-radius:3px; margin-right:6px;"></span>
                                <b>Yearly Total Deposit</b>
                            </div>
                            <div class="d-flex align-items-center">
                                <span style="background-color:#DC2626; width:20px; height:20px; display:inline-block; border-radius:3px; margin-right:6px;"></span>
                                <b>Yearly Total Due</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

