@extends('layouts.new')

@section('layout')

            <div class="content container">

                  <ul class="nav nav-pills sub_header">
            <li class="active " ><a data-toggle="pill" href="#all">ALL</a></li>
            <li><a data-toggle="pill" href="#players">PLAYERS</a></li>
            <li><a data-toggle="pill" href="#nonplayers">NON PLAYERS</a></li>

          </ul>

          <div class="tab-content">

            <div id="all" class="tab-pane  active card tablehead">

                        <ul class="nav nav-pills">

                  <li class="active"><a data-toggle="pill" href="#playingteam">PLAYING TEAM</a></li>
                  <li><a data-toggle="pill" href="#injured">INJURED</a></li>
                  <li><a data-toggle="pill" href="#topstar">TOP STAR</a></li>

              </ul>

                <div class="tab-content">

                  <div id="playingteam" class="tab-pane active">
                    <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Firstname</th>
                              <th>Lastname</th>
                              <th>Email</th>
                            </tr>

                          </thead>
                          <tbody>

                            <tr>
                              <td>87</td>
                              <td>Anna</td>
                              <td>Pitt</td>
                              <td>35</td>

                            </tr>
                          </tbody>
                        </table>
                  </div>
                  </div>
                  <div id="injured" class="tab-pane">
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Firstname</th>
                              <th>Lastname</th>
                              <th>Email</th>
                            </tr>

                          </thead>
                          <tbody>

                            <tr>
                              <td>84</td>
                              <td>Anna</td>
                              <td>Pitt</td>
                              <td>35</td>

                            </tr>
                          </tbody>
                        </table>
                  </div>
                  </div>
                  <div id="topstar" class="tab-pane">
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Firstname</th>
                              <th>Lastname</th>
                              <th>Email</th>
                            </tr>

                          </thead>
                          <tbody>

                            <tr>
                              <td>70</td>
                              <td>Anna</td>
                              <td>Pitt</td>
                              <td>35</td>

                            </tr>
                          </tbody>
                        </table>
                  </div>

                   </div>

                </div>
                   </div>
            <div id="players" class="tab-pane  card tablehead">

                        <ul class="nav nav-pills">
                    <li class="active"><a data-toggle="pill" href="#playingteam1">PLAYING TEAM</a></li>
                  <li><a data-toggle="pill" href="#injured1">INJURED</a></li>
                  <li><a data-toggle="pill" href="#topstar1">TOP STAR</a></li>
            </ul>

                <div class="tab-content">

                  <div id="playingteam1" class="tab-pane  active">
                    <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Firstname</th>
                              <th>Lastname</th>
                              <th>Email</th>
                            </tr>

                          </thead>
                          <tbody>

                            <tr>
                              <td>68</td>
                              <td>Anna</td>
                              <td>Pitt</td>
                              <td>35</td>

                            </tr>
                          </tbody>
                        </table>
                  </div>
                  </div>
                  <div id="injured1" class="tab-pane">
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Firstname</th>
                              <th>Lastname</th>
                              <th>Email</th>
                            </tr>

                          </thead>
                          <tbody>

                            <tr>
                              <td>58</td>
                              <td>Anna</td>
                              <td>Pitt</td>
                              <td>35</td>

                            </tr>
                            <tr>
                              <td>58</td>
                              <td>Anna</td>
                              <td>Pitt</td>
                              <td>35</td>

                            </tr>
                          </tbody>
                        </table>
                  </div>
                  </div>
                  <div id="topstar1" class="tab-pane">
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Firstname</th>
                              <th>Lastname</th>
                              <th>Email</th>
                            </tr>

                          </thead>
                          <tbody>

                            <tr>
                              <td>49</td>
                              <td>Anna</td>
                              <td>Pitt</td>
                              <td>35</td>

                            </tr>
                          </tbody>
                        </table>
                  </div>

                   </div>

                </div>
            </div>
            <div id="nonplayers" class="tab-pane card tablehead">

                        <ul class="nav nav-pills">
                  <li class="active"><a data-toggle="pill" href="#playingteam2">PLAYING TEAM</a></li>
                  <li><a data-toggle="pill" href="#injured2">INJURED</a></li>
                  <li><a data-toggle="pill" href="#topstar2">TOP STAR</a></li>

              </ul>

                <div class="tab-content">

                  <div id="playingteam2" class="tab-pane active">
                    <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Firstname</th>
                              <th>Lastname</th>
                              <th>Email</th>
                            </tr>

                          </thead>
                          <tbody>

                            <tr>
                              <td>31</td>
                              <td>Anna</td>
                              <td>Pitt</td>
                              <td>35</td>

                            </tr>
                          </tbody>
                        </table>
                  </div>
                  </div>
                  <div id="injured2" class="tab-pane">

                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>

                            <tr>
                              <th>#</th>
                              <th>Firstname</th>
                              <th>Lastname</th>
                              <th>Email</th>
                            </tr>

                          </thead>
                          <tbody>

                            <tr>

                              <td>22</td>
                              <td>Anffffffna</td>
                              <td>Pitefwet</td>
                              <td>3efe5</td>

                            </tr>
                          </tbody>
                        </table>
                  </div>
                  </div>
                  <div id="topstar2" class="tab-pane">
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Firstname</th>
                              <th>Lastname</th>
                              <th>Email</th>
                            </tr>

                          </thead>
                          <tbody>

                            <tr>
                              <td>18</td>
                              <td>Annaefw</td>
                              <td>Pitewfwfwet</td>
                              <td>35ewfw</td>

                            </tr>
                          </tbody>
                        </table>
                  </div>

                   </div>

                </div>
            </div>

          </div>

        </div>

@endsection
