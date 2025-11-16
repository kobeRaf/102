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
    /* --- Ticker Styles --- */
    .ticker-wrap {
        width: 100%;
        overflow: hidden;
        position: relative;
        background: #f8f9fa;
        padding: 5px 0;
        border-radius: 8px;
    }

    .ticker {
        display: inline-block;
        white-space: nowrap;
        padding-left: 100%;
        animation: tickerMove 25s linear infinite;
    }

    .ticker-item {
        display: inline-block;
        margin-right: 3rem;
        font-size: 0.95rem;
    }

    @keyframes tickerMove {
        0% { transform: translateX(0); }
        100% { transform: translateX(-100%); }
    }

    /* --- Form field custom style --- */
    .fieldcustom {
        border-radius: 3px;
        background: #ededed;
        box-shadow: inset 10px 10px 8px #dadada,
                    inset -10px -10px 8px #ffffff;
    }
    .fieldcustom.active {
        border-color: #28a745 !important; 
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    }

</style> --}}

    {{-- Recently Added Cheques --}}
    <div class="row justify-content-center mb-4">
        <div class="col-md-12">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-light fw-bold">
                    Recently Added Cheques
                </div>
                <div class="card-body p-2 overflow-hidden">
                    <div class="ticker-wrap fieldcustom">
                        <div class="ticker">
                            @forelse($recentCheques as $cheque)
                                <span class="ticker-item">
                                    <strong>No:</strong> {{ $cheque->no }} | 
                                    <strong>Payee:</strong> {{ $cheque->payee->name ?? 'N/A' }} | 
                                    <strong>₱ {{ number_format($cheque->amount, 2) }}</strong> | 
                                    <strong>{{ $cheque->cheque_type }}</strong> | 
                                    Fund: {{ $cheque->fund_type }} | 
                                    Respo: {{ $cheque->respocenter->code ?? '' }} |
                                    DV no: {{ $cheque->dvno ?? '' }} | 
                                    {{ \Carbon\Carbon::parse($cheque->date_issued)->format('M d, Y') }}
                                </span>
                            @empty
                                <span class="ticker-item text-muted">No cheques yet.</span>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Cheque Form --}}
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm border-0 rounded-3 hover-card">
                <div class="card-header bg-primary text-white rounded-top">
                    <h5 class="mb-0">Add Cheque</h5>
                </div>
                <div class="card-body">
                    <form id="addChequeForm" action="{{ route('addcheck.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Cheque No</label>
                                <input type="number" name="no" class="form-control" value="{{ old('no') }}" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Payee</label>
                                <div class="d-flex gap-2">
                                    <select name="payee_id" class="form-select" required>
                                        <option value="">-- Select Payee --</option>
                                        @foreach($payees as $payee)
                                            <option value="{{ $payee->id }}">{{ $payee->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addPayeeModal">+</button>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Amount</label>
                                <input type="text" id="amount" name="amount" class="form-control" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">DV No</label>
                                <input type="text" name="dvno" class="form-control" value="{{ old('dvno') }}" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Cheque Type</label>
                                <select name="cheque_type" class="form-select" required>
                                    <option value="">-- Select --</option>
                                    <option value="LBP">LBP</option>
                                    <option value="DBP">DBP</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Fund</label>
                                <div class="d-flex gap-2">
                                    <select name="fund_type" class="form-select" required>
                                        <option value="">-- Select Fund --</option>
                                        @foreach($funds as $fund)
                                            <option value="{{ $fund->name }}">{{ $fund->code }} {{ $fund->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addFundModal">+</button>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Respo Center</label>
                                <div class="d-flex gap-2">
                                    <select name="respocenter_id" class="form-select" >
                                        <option value="">-- Select --</option>
                                        @foreach($respocenters as $respo)
                                            <option value="{{ $respo->id }}">{{ $respo->code }} - {{ $respo->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addRespoCenterModal">+</button>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Nature of Payment</label>
                                <input type="text" name="nop" class="form-control" value="{{ old('nop') }}" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Account Code</label>
                                <div class="d-flex gap-2">
                                    <select name="accountcode_id" class="form-select" required>
                                        <option value="">-- Select Account Code --</option>
                                        @foreach($accountcodes as $accountcode)
                                            <option value="{{ $accountcode->id }}">{{ $accountcode->accountcode_name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addAccountCodeModal">+</button>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Date Issued</label>
                                <input type="date" name="date_issued" class="form-control" required>
                            </div>
                        </div>

                        <input type="hidden" name="status" value="for release">

                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary">Add Cheque</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Include your existing modals here (Payee, Fund, Respo, Account Code) --}}

    {{-- MODALS START --}}
    <!-- Add Payee Modal -->
        <div class="modal fade" id="addPayeeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content rounded-3 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Add New Payee</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="addPayeeForm" method="POST" action="{{ route('payees.store') }}">
                @csrf
                <div class="modal-body">
                    <input type="text" name="name" class="form-control" placeholder="Enter payee name" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>

            </div>
        </div>
        </div>

        <!-- Add Fund Modal -->
        <div class="modal fade" id="addFundModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content rounded-3 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Add New Fund</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="addFundForm" method="POST" action="{{ route('funds.store') }}">
                @csrf
                <div class="modal-body">
                <input type="text" name="name" class="form-control mb-2" placeholder="Fund name" required>
                <input type="text" name="code" class="form-control" placeholder="Fund code (optional)">
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
        </div>
        </div>

        <!-- Add RespoCenter Modal -->
        <div class="modal fade" id="addRespoCenterModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content rounded-3 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Add New Respo Center</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="addRespoForm" method="POST" action="{{ route('respocenters.store') }}">
                @csrf
                <div class="modal-body">
                <input type="text" name="code" class="form-control mb-2" placeholder="Respo center code" required>
                <input type="text" name="name" class="form-control" placeholder="Respo center name" required>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
        </div>
        </div>

        <!-- Add Account Code Modal -->
        <div class="modal fade" id="addAccountCodeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content rounded-3 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Add New Account Code</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="addAccountCodeForm" method="POST" action="{{ route('accountcodes.store') }}">
                @csrf
                <div class="modal-body">
                <input type="text" name="accountcode_name" class="form-control" placeholder="Enter account code name" required>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
        </div>
        </div>
        
    {{-- MODALS END --}}
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

<script>
    // Format amount input
    const amountInput = document.getElementById('amount');
    if(amountInput){
        amountInput.addEventListener('blur', function(e){
            let value = e.target.value.replace(/,/g,'');
            if(!isNaN(value) && value !== ''){
                e.target.value = parseFloat(value).toLocaleString('en-US', {minimumFractionDigits:2, maximumFractionDigits:2});
            }
        });
    }

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
</script>

@endsection
