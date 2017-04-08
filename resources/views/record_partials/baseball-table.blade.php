<!-- start Head of player stats-->
            <thead>
              <tr>
                <th title='Rank'>RK</th>
                <th class="all">{{$stat_type}}</th>
                @if( $type != '' )
                  <th class="all" style="text-align: center">{{$type}}</th>
                @endif
                <th style="text-align: center" title="At Bats">AB</th>
                <th style="text-align: center" title="Runs">R</th>
                <th style="text-align: center" title="Hits">H</th>
                <th style="text-align: center" title="Singles">1B</th>
                <th style="text-align: center" title="Doubles">2B</th>
                <th style="text-align: center" title="Triples">3B</th>
                <th style="text-align: center" title="Home Runs">HR</th>
                <th style="text-align: center" title="Runs Batted In">RBI</th>
                <th style="text-align: center" title="Bases on Balls">BB</th>
                <th style="text-align: center" title="Strike Outs">SO</th>
                <th style="text-align: center" title="Stolen Bases">SB</th>
                <th style="text-align: center" title="Caught Stealing" class="none">CS</th>
                <th class="all" style="text-align: center; color: red" title="Average">AVG</th>
                <th style="text-align: center" title="On Base Percentage">OBP</th>
                <th style="text-align: center" title="Slugging Percentage">SLG</th>
                <th style="text-align: center" title="Hit by Pitch">HBP</th>
                <th style="text-align: center" title="Sacrifice Flies">SF</th>
              </tr>
            </thead>
          <!-- end Head of player stats-->

          <!-- start Body of player stats-->
            <tbody>
              <?php $i = 1; ?>
              @foreach($results as $result)
                <tr style="text-align: center">
                  <td>{{$i}}</td>
                  <td style="text-align: left">{{$result->name}}</td>
                  @if( $type != '' )
                    @if( $type == 'Games' )
                      <td>{{$result->games}}</td>
                    @elseif( $type == 'Result' )
                      <td>{{$result->result}}</td>
                    @endif
                  @endif
                  <td>{{$result->stat['at_bats']}}</td>
                  <td>{{$result->stat['runs']}}</td>
                  <td>{{$result->stat['hits']}}</td>
                  <td>{{$result->stat['singles']}}</td>
                  <td>{{$result->stat['doubles']}}</td>
                  <td>{{$result->stat['triples']}}</td>
                  <td>{{$result->stat['home_runs']}}</td>
                  <td>{{$result->stat['runs_batted_in']}}</td>
                  <td>{{$result->stat['bases_on_balls']}}</td>
                  <td>{{$result->stat['strike_outs']}}</td>
                  <td>{{$result->stat['stolen_bases']}}</td>
                  <td>{{$result->stat['caught_stealing']}}</td>
                  <td style="color: red">{{$result->stat['average']}}</td>
                  <td>{{$result->stat['obp']}}</td>
                  <td>{{$result->stat['slg']}}</td>
                  <td>{{$result->stat['hit_by_pitch']}}</td>
                  <td>{{$result->stat['sacrifice_flies']}}</td>
                </tr>
                <?php $i++ ?>
              @endforeach
            </tbody>
          <!-- end Body of player stats-->
