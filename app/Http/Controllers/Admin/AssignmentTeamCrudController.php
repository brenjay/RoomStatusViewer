<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Http\RedirectResponse;
use App\User;
use App\Models\Room;
use App\Models\Team;
use DB;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\Assignment_teamRequest as StoreRequest;
use App\Http\Requests\Assignment_teamRequest as UpdateRequest;

/**
 * Class AssignmentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class AssignmentTeamCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Team');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/assignment_team');
        $this->crud->setEntityNameStrings('team assignment', 'team assignments');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
       // $this->crud->setFromDb();
       
       $this->crud->addColumn(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
        //$this->crud->addColumn(['name' => 'number', 'type' => 'text', 'label' => 'building']);
        
        
        $this->crud->addColumn([  // Select
       'label' => "Assigned",
       'type' => 'select',
       'name' => 'team_id', // the db column for the foreign key
       'entity' => 'user', // the method that defines the relationship in your Model
       'attribute' => 'name', // foreign key attribute that is shown to user
       'model' => "App\Models\Team"
       ]);
       
       
       // ['number', 'cleaned', 'passing', 'assigned_to', 'last_cleaned', 'last_checked', 'building'];
        // Fields
       //$this->crud->addField(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
       
     $this->crud->addField([   // SelectMultiple = n-n relationship (with pivot table)
    'label' => "Tags",
    'type' => 'select2_multiple',
    'name' => 'test', // the method that defines the relationship in your Model
    'entity' => 'test', // the method that defines the relationship in your Model
    'attribute' => 'name', // foreign key attribute that is shown to user
    'model' => "App\User", // foreign key model
    'pivot' => false, // on create&update, do you need to add/delete pivot table entries?
    ]);
       
       

        // add asterisk for fields that are required in AssignmentRequest
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
        $this->crud->removeButton('create');
        $this->crud->removeButton('delete');
        $this->crud->enableExportButtons();
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        
        $team = Team::find($request->input('id'));
        if(($request->input('test')) != ''){
            foreach($team->user as $user){
                if(!in_array($team->user,$request->input('test'))){   
                    $user->team_id = NULL;
                    $user->save();
                }
            }
            foreach( $request->input('test') as $user_id){
                $user = User::find($user_id);
                $user->team_id = $team->id;
                $user->save();
            }
        }else{
            $users = DB::table('users')->whereIn('team_id', array($team->id))->get();
                foreach($users as $u){
                   $user = User::find($u->id);
                   $user->team_id = NULL;
                   $user->save();
                }
        }
        
        return redirect('/admin/assignment_team/');
        //$redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        //return $redirect_location;
    }
}
