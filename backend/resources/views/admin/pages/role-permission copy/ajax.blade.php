<div class="col-sm-12">                        	
                            	<table class="table table-striped table-bordered table-responsive common-datatables" style="width:100%; padding: 10px">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th><input name="checkbox" onclick='checkedAll();' type="checkbox" readonly="readonly" /></th>
                                    <th>Action</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Present Address</th>
                                    <th>Permanent Address</th>
                                    <th>User Type</th>
                                    <th>Status</th>
                                    <th>Social Links</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($getResponse!="")
                                    @foreach($getResponse as $response)
                                        <tr id="tablerow{{ $response->id }}">
                                        <td>{{ $response->id }}</td>
                                        <td><input type="checkbox"  name="summe_code[]" id="summe_code" value="{{ $response->id }}" /></td>
                                        <td class="text-nowrap">
                                            <a href="{{ route('user.show',$response->id) }}"><i data-feather='eye'></i></a>
                                            <a href="{{ route('user.edit',$response->id) }}"><i data-feather='edit'></i></a>
                                            <!--<a href="{{ route('user.destroy',$response->id) }}"><i data-feather='trash-2'></i></a>
                                            <a href="{{ url('common/delete/') }}?id={{ $response->id }}&&api=users&&type=single"><i data-feather='trash-2'></i></a>-->
                                            <a href="#" onclick="singleDelete({{ $response->id }},'admin');"><i data-feather='trash-2'></i></a>
                                        </td>
                                        <td>{{ $response->name }}</td>
                                        <td>{{ $response->email }}</td>
                                        <td>{{ $response->phone }}</td>
                                        <td>{{ $response->present_address }}</td>
                                        <td>{{ $response->permanent_address }}</td>
                                        <td><button class="btn btn-sm btn-primary">df</button></td>
                                        <td><button class="btn btn-sm btn-success">Active</button></td>
                                        <td><span><i data-feather='facebook'></i></span></td>
                                    </tr>
                                    @endforeach
                                @endif
                                
                                </tbody>

                            </table>
                        </div>