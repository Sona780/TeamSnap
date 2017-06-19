<?php

namespace Org4Leagues\Http\Controllers;

use Illuminate\Http\Request;
use Org4Leagues\Team;
use Org4Leagues\TeamCtg;
use Org4Leagues\Category;

class CategoryController extends Controller
{
    public function store($id, Request $request)
    {
      //inputed category
      $ctg = $request->ctg_name;

      //check if category already exists
      $cat = Category::where('category_name', $ctg)->first();

      // if category doesn't exists
      if( is_null($cat) )
      {
        $c = new Category();
        $c->category_name = $ctg;
        $c->save();
        $cid = $c->id;
      }

      // if already exists
      else
        $cid = $cat->id;

      // save categoy for team
      $tctg = new TeamCtg();
      $tctg->teams_id = $id;
      $tctg->categories_id = $cid;
      $tctg->save();

      return redirect($id.'/members');
    }
}
