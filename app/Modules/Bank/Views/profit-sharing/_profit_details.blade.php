


                           <table class="table">
                               <tr>
                                   <th colspan="2"></th>
                                   <th>Member</th>
                                   <th>Deposit</th>
                                   <th>Profit</th>
                               </tr>
                               @foreach($memberProfitDetails as $dis)
                                   @php
                                    $userName = \App\Modules\User\Models\Member::find($dis->member_id);
                                   @endphp
                                   <tr>
                                       <td colspan="2"></td>
                                       <td>{{$userName->name}}
                                       </td>
                                       <td>{{number_format($dis->deposit_amount,2)}}</td>
                                       <td>{{number_format($dis->profit_amount,2)}}</td>
                                   </tr>
                               @endforeach
                           </table>
