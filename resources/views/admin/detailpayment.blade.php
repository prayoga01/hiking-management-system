@extends('layouts.admin')

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Mountain List</h6>
        </div>
        <div class="card-body">
            <div class="container">
                <form action="{{ route('admin.updatepayment', $payment->id) }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="control-group after-add-more">
                        <div class="row mb-3">
                            <label for="name" class="col-sm-4 col-form-label">Mountain name</label>
                            <div class="col-sm-8">
                                {{-- <input type="text" value="{{ $payment->mountain->nm_mountain }}"
                                    class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                    readonly> --}}
                                <input type="text" value="{{ $payment->group->mountain->nm_mountain }}"
                                    class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                    readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-sm-4 col-form-label">Group name</label>
                            <div class="col-sm-8">
                                <input type="text" value="{{ $payment->group->group_name }}"
                                    class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                    readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="total" class="col-sm-4 col-form-label">Total payment</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-text">RM</span>
                                    <input type="number" value="{{ $payment->total }}"
                                        class="form-control @error('total') is-invalid @enderror" id="total"
                                        name="total" readonly>
                                </div>
                                @error('total')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pay_date" class="col-sm-4 col-form-label">Transaction date</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control @error('pay_date') is-invalid @enderror"
                                    id="pay_date" name="pay_date" value="{{ $payment->pay_date }}">
                                @error('pay_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="ref_id" class="col-sm-4 col-form-label">Reference number</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('ref_id') is-invalid @enderror"
                                    id="ref_id" name="ref_id" value="{{ $payment->ref_id }}">
                                @error('ref_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="proof_pay" class="col-sm-4 col-form-label">Proof of payment</label>
                            <div class="col-sm-8">
                                <a class="btn btn-success" target="_blank"
                                    href="{{ asset('storage/' . $payment->proof_pay) }}">View receive</a>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="no_tlp" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-8">
                                <div class="form-floating">
                                    <textarea name="note" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                                        style="height: 100px"></textarea>
                                    <label for="floatingTextarea2">{{ $payment->note }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <button type="submit" class="btn btn-primary">Edit data</button> --}}
                    @if (!strcmp($payment->status_pay, '0'))
                        <button class="btn btn-success" type='submit' name="status_pay" value="1">Accept</button>
                        <button class="btn btn-danger" type='submit' name="status_pay" value="2">Decline</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
