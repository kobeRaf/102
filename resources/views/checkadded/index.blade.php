@extends('layouts.app')

@section('content')

{{-- <style>
    /* Primary Theme Color */
    :root {
        --primary: #2b4b7b;
        --primary-hover: #ffffff;
        --primary-active: #1e3557;
    }

    /* Card header */
    .card-header.bg-primary {
        background-color: var(--primary) !important;
        border-color: var(--primary);
    }


    /* Form control focus border */
    .form-control:focus,
    .form-select:focus {
        border-color: var(--primary) !important;
        box-shadow: 0 0 0 0.15rem rgba(43, 75, 123, 0.35) !important;
    }
    tr[style*="cursor:pointer"]:hover {
        background-color: #f8f9fa !important;
    }
    
</style> --}}

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top">
                <h5 class="mb-0">{{ __('All Cheques') }}</h5>
            </div>

            <div class="card-body">
                <!-- 🔎 Filter Form -->
                <form method="GET" action="{{ route('checkadded.index') }}" class="row g-3 mb-4">
                    <div class="col-md-2">
                        <input type="text" name="name" value="{{ request('name') }}" class="form-control" placeholder="🔎 Payee Name">
                    </div>
                    <div class="col-md-2">
                        <select name="cheque_type" class="form-select">
                            <option value="">Cheque Type</option>
                            <option value="LBP" {{ request('cheque_type') == 'LBP' ? 'selected' : '' }}>LBP</option>
                            <option value="DBP" {{ request('cheque_type') == 'DBP' ? 'selected' : '' }}>DBP</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="fund_type" class="form-select">
                            <option value="">Fund Type</option>
                            <option value="General fund" {{ request('fund_type') == 'General fund' ? 'selected' : '' }}>General Fund</option>
                            <option value="Trust Fund" {{ request('fund_type') == 'Trust Fund' ? 'selected' : '' }}>Trust Fund</option>
                            <option value="SEF" {{ request('fund_type') == 'SEF' ? 'selected' : '' }}>School Educational Fund</option>
                            <option value="Hospital Fund" {{ request('fund_type') == 'Hospital Fund' ? 'selected' : '' }}>Hospital Fund</option>
                            <option value="20%" {{ request('fund_type') == '20%' ? 'selected' : '' }}>20%</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="status" class="form-select">
                            <option value="">Status</option>
                            <option value="for release" {{ request('status') == 'for release' ? 'selected' : '' }}>For Release</option>
                            <option value="claimed" {{ request('status') == 'claimed' ? 'selected' : '' }}>Claimed</option>
                            <option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>Returned</option>  
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="date" name="date_from" value="{{ request('date_from') }}" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <input type="date" name="date_to" value="{{ request('date_to') }}" class="form-control">
                    </div>
                    <div class="col-md-12 d-flex gap-2">
                        <button type="submit" class="btn btn-primary btn-sm px-4">Search</button>
                        <a href="{{ route('checkadded.index') }}" class="btn btn-primary btn-sm px-4">Reset</a>
                    </div>
                </form>

                <!-- 📋 Cheques Table -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Date Issued</th>
                                <th>Payee</th>
                                <th>Amount</th>
                                <th>Cheque Type</th>
                                <th>Fund Type</th>
                                <th>Account Code</th>
                                <th>Status</th>
                                <th>RespoCenter</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cheques as $cheque)
                                <tr>
                                    <td><strong>{{ $cheque->no }}</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($cheque->date_issued)->format('M d, Y') }}</td>
                                    <td>{{ $cheque->payee->name ?? 'N/A' }}</td>
                                    <td class="text-end"><strong>₱ {{ number_format($cheque->amount, 2) }}</strong></td>
                                    <td>
                                        @if($cheque->cheque_type === 'LBP')
                                            <span class="badge text-white" style="background-color:#0d6efd; width: 100%;">{{ $cheque->cheque_type }}</span>
                                        @elseif($cheque->cheque_type === 'DBP')
                                            <span class="badge text-dark" style="background-color:#90ee90; width: 100%;">{{ $cheque->cheque_type }}</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $cheque->cheque_type }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $cheque->fund_type }}</td>
                                    <td>{{ $cheque->accountcode->accountcode_name ?? ''}}</td>
                                    <td>
                                        @if($cheque->status == 'claimed')
                                            <span class="badge bg-success">Claimed</span>
                                        @elseif($cheque->status == 'cancelled')
                                            <span class="badge bg-danger">Cancelled</span>
                                        @elseif($cheque->status == 'for release')
                                            <span class="badge bg-warning" style="color: black;">For Release</span>
                                        @elseif($cheque->status == 'returned')
                                            <span class="badge bg-info text-dark">Returned</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($cheque->status) }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $cheque->respocenter->code ?? '' }} - {{ $cheque->respocenter->name ?? '' }}</td>

                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                Action
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">

                                                {{-- ✅ FOR RELEASE --}}
                                                @if($cheque->status === 'for release')
                                                <li>
                                                    <button type="button" class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#releaseModal{{ $cheque->id }}">
                                                        Release
                                                    </button>
                                                </li>
                                                @endif

                                                {{-- ✅ RETURNED --}}
                                                @if(in_array($cheque->status, ['claimed', 'returned', 'cancelled']))
                                                <li>
                                                    <button type="button" class="dropdown-item text-primary" data-bs-toggle="modal" data-bs-target="#viewSignatureModal{{ $cheque->id }}">
                                                        View Signature
                                                    </button>
                                                </li>
                                                @endif

                                                {{-- ✅ CLAIMED --}}
                                                @if($cheque->status === 'claimed')
                                                <li>
                                                    <form action="{{ route('cheques.return', $cheque->id) }}" method="POST" class="return-form">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item text-warning">
                                                            Mark as Returned
                                                        </button>
                                                    </form>
                                                </li>
                                                @endif
                                                {{-- ✅ CANCELLED --}}
                                                 @if(in_array($cheque->status, ['claimed', 'for release']))
                                                <li>
                                                    <form action="{{ route('cheques.cancel', $cheque->id) }}" method="POST" class="return-form">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            Cancel
                                                        </button>
                                                    </form>
                                                </li>
                                                @endif

                                               

                                                {{-- ✅ DEFAULT (NO ACTION) --}}
                                                @if(!in_array($cheque->status, ['for release', 'claimed', 'returned', 'cancelled']))
                                                <li>
                                                    <span class="dropdown-item text-muted">No actions available</span>
                                                </li>
                                                @endif
                                            </ul>
                                        </div>

                                        {{-- ✅ Release Modal --}}
                                        @if($cheque->status === 'for release')
                                        <div class="modal fade" id="releaseModal{{ $cheque->id }}" tabindex="-1" aria-labelledby="releaseModalLabel{{ $cheque->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('cheques.release', $cheque->id) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title" id="releaseModalLabel{{ $cheque->id }}">Release Cheque</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p><strong>Cheque No:</strong> {{ $cheque->no }}</p>
                                                            <p><strong>Payee:</strong> {{ $cheque->payee->name ?? 'N/A' }}</p>

                                                            <div class="mb-3">
                                                                <label for="receiverName{{ $cheque->id }}" class="form-label">Receiver Name</label>
                                                                <input type="text" name="name" id="receiverName{{ $cheque->id }}" class="form-control" placeholder="Enter receiver name" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="contactno{{ $cheque->id }}" class="form-label">Contact No</label>
                                                                <input type="text" name="contactno" id="contactno{{ $cheque->id }}" class="form-control" placeholder="09xxxxxxxxx" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Receiver Signature</label>
                                                                <canvas id="signaturePad{{ $cheque->id }}" class="border rounded w-100" width="600" height="200"></canvas>
                                                                <input type="hidden" name="signature" id="signatureInput{{ $cheque->id }}">
                                                                <div class="mt-2">
                                                                    <button type="button" class="btn btn-sm btn-warning" id="clearSignature{{ $cheque->id }}">Clear</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-success">Confirm Release</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                      @if(in_array($cheque->status, ['claimed', 'returned', 'cancelled']))
                                        <div class="modal fade" id="viewSignatureModal{{ $cheque->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body text-center">
                                                        @if($cheque->receiver)
                                                            <img src="{{ asset('signatureimages/' . $cheque->receiver->signature) }}" 
                                                                alt="Full Signature" 
                                                                class="img-fluid rounded">
                                                            <p class="mt-3 mb-0">
                                                                <strong>Receiver: </strong> {{ $cheque->receiver->name }} <br>
                                                                <strong>Contact: </strong> {{ $cheque->receiver->contactno }} <br>
                                                                <strong>Date: </strong>{{$cheque->receiver->created_at}}
                                                            </p>
                                                        @else
                                                            <p class="text-muted">No signature available for this cheque.</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" class="text-center text-muted">No cheques found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- 📌 Pagination -->
                <div class="d-flex justify-content-center mt-3">
                    {{ $cheques->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>

{{---POP UP CARD--}}
    @if(session('success'))
    <div id="successPopup" 
        class="position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
        style="background: rgba(0,0,0,0.5); z-index: 1055; display: none;">
        <div style="
            width: 400px;
            height: 200px;
            background: rgb(255, 255, 255);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000000;
            text-align: center;
            font-weight: 500;
            font-size: 1rem;
        ">
            {{ session('success') }}
        </div>
    </div>
    @endif
{{---POP UP CARD--}}

<script src="{{ asset('js/signature_pad.umd.min.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        // Initialize SignaturePad whenever a release modal is shown
        document.body.addEventListener("shown.bs.modal", function (event) {
            const modal = event.target;
            if (!modal.id.startsWith("releaseModal")) return;

            const canvas = modal.querySelector("canvas[id^='signaturePad']");
            const input = modal.querySelector("input[id^='signatureInput']");
            const clearBtn = modal.querySelector("button[id^='clearSignature']");

            // Only initialize if not already
            if (!canvas.dataset.initialized) {
                const signaturePad = new SignaturePad(canvas);

                function resizeCanvas() {
                    const ratio = Math.max(window.devicePixelRatio || 1, 1);
                    canvas.width = canvas.offsetWidth * ratio;
                    canvas.height = canvas.offsetHeight * ratio;
                    canvas.getContext("2d").scale(ratio, ratio);
                    signaturePad.clear();
                }

                resizeCanvas();
                window.addEventListener("resize", resizeCanvas);

                clearBtn.addEventListener("click", function () {
                    signaturePad.clear();
                    input.value = "";
                });

                modal.querySelector("form").addEventListener("submit", function (e) {
                    if (signaturePad.isEmpty()) {
                        e.preventDefault();
                        alert("Please provide a signature before confirming.");
                    } else {
                        input.value = signaturePad.toDataURL("image/png");
                    }
                });

                canvas.dataset.initialized = "true";
            }
        });
    });

    // Auto-dismiss alert
    document.addEventListener("DOMContentLoaded", function () {
        const popup = document.getElementById('successPopup');
        if (popup) {
            popup.style.display = 'block';

            // Auto-dismiss after 3 seconds
            setTimeout(() => {
                popup.style.transition = "opacity 0.5s";
                popup.style.opacity = "0";
                setTimeout(() => popup.remove(), 200);
            }, 2000);
        }
    });

        const actionForms = document.querySelectorAll(".return-form");

    actionForms.forEach(form => {
        form.addEventListener("submit", function (e) {
            const actionText = this.querySelector("button").innerText.trim();

            if (!confirm("Are you sure you want to '" + actionText + "' this cheque?")) {
                e.preventDefault();
            }
        });
    });
</script>

@endsection
