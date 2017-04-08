{!! csrf_field() !!}
<div class="modal-body">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="team">Select player</label>
                <select class="selectpicker show-menu-arrow" data-live-search="true" data-style="grey" name="team_user_id" id="player" title='Choose Player..'>
                    @foreach($players as $player)
                        <option value="{{$player->id}}">{{$player->firstname}} {{$player->lastname}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="team">Select Opponent</label>
                <select class="selectpicker show-menu-arrow" data-live-search="true" data-style="grey" name="game_id" id="opponent" title='Choose Opponent..'>
                </select>
            </div>
        </div>
    </div>

    <br><br>

    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label for="at_bat">At Bat</label>
                <input type="text" id="f-ip" class="form-control input-sm" name="at_bats">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="runs">Runs</label>
                <input type="text" id="f-ip" class="form-control input-sm" name="runs">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="hits">Hits</label>
                <input type="text" id="f-ip" class="form-control input-sm" name="hits">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label for="singles">Singles</label>
                <input type="text" id="f-ip" class="form-control input-sm" name="singles">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="doubles">Doubles</label>
                <input type="text" id="f-ip" class="form-control input-sm" name="doubles">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="triples">Triples</label>
                <input type="text" id="f-ip" class="form-control input-sm" name="triples">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label for="home_runs">Home Runs</label>
                <input type="text" id="f-ip" class="form-control input-sm" name="home_runs">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="runs_batted_in">Runs Batted In</label>
                <input type="text" id="f-ip" class="form-control input-sm" name="runs_batted_in">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="bases_on_balls">Bases on Balls (Walks)</label>
                <input type="text" id="f-ip" class="form-control input-sm" name="bases_on_balls">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label for="strike_outs">Strike Outs</label>
                <input type="text" id="f-ip" class="form-control input-sm" name="strike_outs">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="stolen_bases">Stolen Bases</label>
                <input type="text" id="f-ip" class="form-control input-sm" name="stolen_bases">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="caught_stealing">Caught Stealing</label>
                <input type="text" id="f-ip" class="form-control input-sm" name="caught_stealing">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label for="hit_by_pitch">Hit by Pitch</label>
                <input type="text" id="f-ip" class="form-control input-sm" name="hit_by_pitch">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="sacrifice_flies">Sacrifice Flies</label>
                <input type="text" id="f-ip" class="form-control input-sm" name="sacrifice_flies">
            </div>
        </div>
    </div>

</div>

<div class="modal-footer">
    <button type="submit" class="btn btn-info">Save</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
