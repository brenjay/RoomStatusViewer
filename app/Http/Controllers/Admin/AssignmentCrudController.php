<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Http\RedirectResponse;
use App\User;
use App\Models\Room;
use DB;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\AssignmentRequest as StoreRequest;
use App\Http\Requests\AssignmentRequest as UpdateRequest;

/**
 * Class AssignmentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class AssignmentCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\User');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/assignment');
        $this->crud->setEntityNameStrings('assignment', 'assignments');

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
       'name' => 'assigned_to', // the db column for the foreign key
       'entity' => 'room', // the method that defines the relationship in your Model
       'attribute' => 'full_name', // foreign key attribute that is shown to user
       'model' => "App\Models\Room"
       ]);
       
       
       // ['number', 'cleaned', 'passing', 'assigned_to', 'last_cleaned', 'last_checked', 'building'];
        // Fields
       //$this->crud->addField(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
       
     $this->crud->addField([       // Select2Multiple = n-n relationship (with pivot table)
    'label' => "Tags",
    'type' => 'select2_multiple',
    'name' => 'user', // the method that defines the relationship in your Model
    'entity' => 'user', // the method that defines the relationship in your Model
    'attribute' => 'full_name', // foreign key attribute that is shown to user
    'model' => "App\Models\Room", // foreign key model
    'pivot' => false, // on create&update, do you need to add/delete pivot table entries?
    // 'select_all' => true, // show Select All and Clear buttons?
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
        $user = User::find($request->input('id'));
        if(($request->input('user')) != ''){
            foreach($user->room as $room){
                if(!in_array($room->id,$request->input('user'))){   
                    $room->assigned_to = NULL;
                    $room->save();
                }
            }
            foreach( $request->input('user') as $room_id){
                $room = Room::find($room_id);
                $room->assigned_to = $user->id;
                $room->save();
            }
        }else{
            $rooms = DB::table('rooms')->whereIn('assigned_to', array($user->id))->get();
                foreach($rooms as $r){
                   $room = Room::find($r->id);
                   $room->assigned_to = NULL;
                   $room->save();
                }
        }
        return redirect('/admin/assignment/');
        //$redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        //return $redirect_location;
    }
}
