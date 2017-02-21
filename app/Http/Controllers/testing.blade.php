<ul class="tab-nav" role="tablist">
                   <?php $i=0 ?>
                   @foreach($ctgs as $ctg)
                     
                      @if($i == 0)
                        <li class="active">
                          <a href="#all1{{$ctg->id}}" aria-controls="all{{$ctg->id}}" role="tab" data-toggle="tab">{{$ctg->name}} </a>
                        </li>
                        @else
                        <li>
                          <a href="#all1{{$ctg->id}}" aria-controls="all{{$ctg->id}}" role="tab" data-toggle="tab">{{$ctg->name}}</a>
                        </li>
                        @endif
                        <?php $i += 1  ?>
                    @endforeach
              </ul>
                 
                <div class="tab-content">
                   @if($ctgs !='')
                   @foreach($ctgs as $ctg)
                   <div role="tabpanel" class="tab-pane active" id="all1{{$ctg->id}}">
                     <div class="card">
                       <div class="table-responsive ">
                        <table class="table table-striped data-table-basic">
                            <thead>
                                <tr>
                                    <th data-column-id="id" data-type="numeric">ID</th>
                                    <th data-column-id="sender">Sender</th>
                                    <th data-column-id="received" data-order="desc">Received</th>
                                </tr>
                             </thead>
                             <tbody>
                                <tr>
                                    <td>10238</td>
                                    <td>{{$ctg->name}}1</td>
                                    <td>14.10.2013</td>
                                </tr>
                             </tbody>
                        </table>
                      </div>
                     </div>
                   </div>
                   
                   @endforeach
                  @endif
                </div>
///////////////////////////////////
//////////////////////////////////
<ul class="tab-nav" role="tablist">
                   @if($ctgs != '')
                   @foreach($ctgs as $ctg)
                        <li >
                          <a href="#player{{$ctg->id}}" aria-controls="player{{$ctg->id}}" role="tab" data-toggle="tab">{{$ctg->name}}</a>
                        </li>
                    @endforeach
                    @endif
                 </ul>
                 
                <div class="tab-content">
                  @if($ctgs != '')
                    @foreach($ctgs as $ctg)
                  <div role="tabpanel" class="tab-pane active" id="player{{$ctg->id}}">
                     <div class="card">
                       <div class="table-responsive ">
                         <table class="table table-striped data-table-basic">
                            <thead>
                                <tr>
                                    <th data-column-id="id" data-type="numeric">ID</th>
                                    <th data-column-id="sender">Sender</th>
                                    <th data-column-id="received" data-order="desc">Received</th>
                                </tr>
                             </thead>
                             <tbody>
                                <tr>
                                    <td>10238</td>
                                    <td>{{$ctg->name}}</td>
                                    <td>14.10.2013</td>
                                </tr>
                             </tbody>
                        </table>
                      </div>
                     </div>
                   </div>
                   @endforeach
                   @endif
                
                  
                </div>                