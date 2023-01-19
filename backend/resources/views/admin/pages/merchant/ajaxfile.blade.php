<div class="modal-content" style="width:700px;">
    <form method="POST" action="{{ route('merchant.hubassign') }}" enctype="multipart/form-data">
        @csrf


        <div class="modal-header">
            <input type="submit" name="submitbtn" value="Save" class="btn btn-success" />
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style=" height: auto; max-height:400px; overflow:auto; overflow-x:hidden">

            @foreach($response->data->merchant as $res)
            <div class="row">
                <input type="hidden"  class="form-control" name="merchant_id[]" value="{{ $res->id }}"/>
                <div class="col-sm-12">Merchant Name: {{ $res->name }}</div>
                <div class="col-sm-12" style="padding:5px; border:1px solid #ccc; margin:20px 5px; border-radius:10px;">
                   <div class="row">

                    <div class="col-sm-3">
                        <label>Hub</label>
                        <select class="form-control" name="hub_id[{{ $res->id }}]">
                            <option value="{{ $res->hub ? $res->hub->id:''}}">{{ $res->hub ? $res->hub->name:'Select'}}</option>
                            @foreach($hubinfo as $hub)
                                <option value="{{ $hub->id }}">{{ $hub->name }}</option>
                            @endforeach
                        </select>

                        <label>COD</label>
                        <select class="form-control" name="cod[{{ $res->id }}]">
                            <option value="{{ $res->cod ? $res->cod:''}}">{{ $res->cod ? 'COD Charge '.$res->cod.'%':''}}</option>
                            @foreach($codinfo as $cod)
                                <option value="{{ $cod->percentage }}">COD Charge {{ $cod->percentage }}%</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-9">
                       <div class="row">
                            <label for="deliveryplan">Delivery Plan</label>
                            <div class="col-sm-12" style="padding: 0; margin: 0">
                                @foreach($res->deliveryplan as $dplan)
                                    <div style="width: auto; float: left; padding: 3px">
                                        <input type="checkbox" name="deliveryplan[{{ $res->id }}][]" checked value="{{ $dplan->plan->id }}"
                                        style="width: 20px; height: 20px;position: absolute;">
                                        <label style=" margin-left: 25px; font-weight: normal; color:#000">{{ $dplan->plan->name }}</label>
                                    </div>
                                @endforeach
                                @foreach($newDeliveryPlan[$res->id] as $ndplan)
                                    <div style="width: auto; float: left; padding: 3px">
                                        <input type="checkbox" name="deliveryplan[{{ $res->id }}][]" value="{{ $ndplan->id }}"
                                        style="width: 20px; height: 20px;position: absolute;">
                                        <label style=" margin-left: 25px; font-weight: normal; color:#000">{{ $ndplan->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                         <div class="row">
                            <label for="deliveryplan">Return Plan</label>
                            <div class="col-sm-12" style="padding: 0; margin: 0">
                                @foreach($res->returnplan as $rplan)
                                    <div style="width: auto; float: left; padding: 3px">
                                        <input type="checkbox" name="returnplan[{{ $res->id }}][]" checked value="{{ $rplan->plan->id }}"
                                        style="width: 20px; height: 20px;position: absolute;">
                                        <label style=" margin-left: 25px; font-weight: normal; color:#000">{{ $rplan->plan->name }}</label>
                                    </div>
                                @endforeach
                                @foreach($newReturnPlan[$res->id] as $nrplan)
                                    <div style="width: auto; float: left; padding: 3px">
                                        <input type="checkbox" name="returnplan[{{ $res->id }}][]" value="{{ $nrplan->id }}"
                                        style="width: 20px; height: 20px;position: absolute;">
                                        <label style=" margin-left: 25px; font-weight: normal; color:#000">{{ $nrplan->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                   </div>
                </div>
            </div>
            @endforeach
            </div>
    </form>
</div>



