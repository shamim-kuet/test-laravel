<div class="modal-content" style="width:700px;">

    <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body" style="max-height:600px; overflow:auto; overflow-x:hidden">
        <form method="POST" action="{{ route('delivery.update') }}" enctype="multipart/form-data">
            @csrf

            <div class="row">
                @foreach ($response->data as $res)
                @php
                $allCharges =[$res->collectable_amount, $res->delivery_charge,
                $res->weight_charge, $res->cod_charge, $res->total_charge, $res->total_return_cost];
                $implodeCharge = json_encode($allCharges);
                @endphp

                <input type="hidden" class="form-control" name="deliveryid[]" value="{{ $res->id }}" />
                <input type="hidden" class="form-control" name="orderid[]" value="{{ $res->order->id }}" />
                <div class="col-sm-6" style="margin:0; padding:0 3px;">
                    <div class="col-sm-12">
                        <span class="backbtn"></span>Consignment ID: {{ $res->order->consignment_id }}
                        <br>
                        <span class="totalAmount{{ $res->id }}" style="font-weight:bold">
                            Total Amount: {{ number_format($res->collectable_amount + $res->total_charge,'2') }}
                        </span>
                    </div>
                    
                    <div class="row" style="padding:5px; border:1px solid #ccc; margin:20px 5px; border-radius:10px;">
                        <div class="col-sm-12">
                            <div class="row" style="margin-bottom:5px;">
                                <div class="col-sm-5" style="margin:0; padding:0"><label>Status</label></div>
                                <div class="col-sm-7">
                                    <select name="order_status[{{ $res->id }}]" class="form-control" onchange="changeReturnCharge({{ $implodeCharge }}, {{ $res->id }}, this.value)">
                                        @foreach ($statuses->data as $s)
                                        <option value="{{ $s->id }}" {{ $actions==$s->id ? 'selected' : '' }}>{{
                                            $s->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="row" style="margin-bottom:5px;">
                                <div class="col-sm-5" style="margin:0; padding:0"><label>Received Amount</label>
                                </div>
                                <div class="col-sm-7"><input type="number" value="{{ $res->collectable_amount }}"
                                        readonly class="form-control receivedAmount{{ $res->id }}" name="received_amount[{{ $res->id }}]"
                                        placeholder="Received Amount" /></div>
                            </div>
                            <div class="row" style="margin-bottom:5px;">
                                <div class="col-sm-5" style="margin:0; padding:0"><label>Delivery Charge</label>
                                </div>
                                <div class="col-sm-7"><input type="number" value="{{ $res->delivery_charge }}" readonly
                                        class="form-control deliveryCharge{{ $res->id }}" name="delivery_charge[{{ $res->id }}]"
                                        placeholder="Received Amount" />
                                </div>
                            </div>
                            <div class="row" style="margin-bottom:5px;">
                                <div class="col-sm-5" style="margin:0; padding:0"><label>Weight Charge</label></div>
                                <div class="col-sm-7"><input type="number" value="{{ $res->weight_charge }}" readonly
                                        class="form-control weightCharge{{ $res->id }}" name="weight_charge[{{ $res->id }}]"
                                        placeholder="Received Amount" />
                                </div>
                            </div>
                            <div class="row" style="margin-bottom:5px;">
                                <div class="col-sm-5" style="margin:0; padding:0"><label>COD Charge</label></div>
                                <div class="col-sm-7"><input type="number" value="{{ $res->cod_charge }}" readonly
                                        class="form-control codCharge{{ $res->id }}" name="cod_charge[{{ $res->id }}]"
                                        placeholder="Received Amount" /></div>
                            </div>

                            <div class="row" style="margin-bottom:5px;">
                                <div class="col-sm-5" style="margin:0; padding:0"><label id="return_label{{ $res->id }}">Return Charge</label></div>
                                <div class="col-sm-7"><input type="number" value="{{ $res->total_return_cost }}"
                                         class="form-control returnCharge{{ $res->id }}" readonly
                                        name="total_return_cost[{{ $res->id }}]" /></div>
                            </div>

                            <div class="row" style="margin-bottom:5px;">
                                <div class="col-sm-5" style="margin:0; padding:0"><label>Total Charge</label></div>
                                <div class="col-sm-7"><input type="number" value="{{ $res->total_charge }}" readonly
                                        class="form-control totalCharge{{ $res->id }}" name="total_charge[{{ $res->id }}]"
                                        /></div>
                            </div>



                        </div>
                        <div class="col-sm-12">
                            <div class="row" style="margin-bottom:5px;">
                                <div class="col-sm-5" style="margin:0; padding:0"><label>Delivery Date</label></div>
                                <div class="col-sm-7"><input type="text" class="form-control datepicker"
                                        value=" {{ $res->order->delivery_date }}" name="delivery_date[{{ $res->id }}]"
                                        id="delivery_date" /></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-sm-12"><input type="submit" name="submitbtn" value="Submit" class="btn btn-success" />
            </div>
        </form>
    </div>
</div>


<script type="text/javascript">
    function changeReturnCharge(crg, oid, sts){
        var ra  = $(".receivedAmount"+oid);
        var cc  = $(".codCharge"+oid);
        var dc  = $(".deliveryCharge"+oid);
        var tc  = $(".totalCharge"+oid);
        var wc  = $(".weightCharge"+oid);
        var rc  = $(".returnCharge"+oid);
        var ta  = $(".totalAmount"+oid);

        if(sts==17){
            rc.val(crg[5]);
            ra.val(0);
            cc.val(0);
            dc.val(0);
            tc.val(parseFloat(crg[5]) + parseFloat(crg[2]));
            let totalAmount = parseFloat(crg[5]) + parseFloat(crg[2]);
            ta.html("Total Amount: " + totalAmount.toFixed(2));
        }
        else{
            rc.val(0);
            ra.val(crg[0]);
            cc.val(crg[3]);
            dc.val(crg[1]);
            tc.val(parseFloat(crg[0]) + parseFloat(crg[1]) + parseFloat(crg[2]) + parseFloat(crg[3]));
            let totalAmount = parseFloat(crg[0]) + parseFloat(crg[5]) + parseFloat(crg[2]);
            ta.html("Total Amount: " + totalAmount.toFixed(2));
        }
    }
</script>
