<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Models\Building;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\RoomRequest as StoreRequest;
use App\Http\Requests\RoomRequest as UpdateRequest;

/**
 * Class RoomCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class RoomCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Room');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/room');
        $this->crud->setEntityNameStrings('room', 'rooms');
        $this->crud->enableBulkActions();
        $this->crud->addBulkDeleteButton();
        //$this->crud->with('building');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        
        //$this->crud->setFromDb();
        
        // Columns
        
         $this->crud->addColumn([  // Select
       'label' => "Building",
       'type' => 'select',
       'name' => 'building', // the db column for the foreign key
       'entity' => 'location', // the method that defines the relationship in your Model
       'attribute' => 'name', // foreign key attribute that is shown to user
       'model' => "App\Models\Room"
       ]);
       
        $this->crud->addColumn(['name' => 'number', 'type' => 'text', 'label' => 'Number']);
        //$this->crud->addColumn(['name' => 'building', 'type' => 'number', 'label' => 'building']);
       
        $this->crud->addColumn(['name' => 'full_name', 'type' => 'text', 'label' => 'Name']);
        
          $this->crud->addColumn(['name' => 'last_cleaned', 'type' => 'text', 'label' => 'Last Cleaned']);
       
        $this->crud->addColumn([  // Select
       'label' => "Assigned",
       'type' => 'select',
       'name' => 'assigned_to', // the db column for the foreign key
       'entity' => 'user', // the method that defines the relationship in your Model
       'attribute' => 'name', // foreign key attribute that is shown to user
       'model' => "App\Users"
       ]);
       
       $this->crud->addColumn([
        'name'        => 'cleaned',
        'label'       => 'Cleaned',
        'type'        => 'check',
        ]);
       
           $this->crud->addColumn([
        'name'        => 'passing',
        'label'       => 'Passing',
        'type'        => 'check',
        ]);
       
        
       // ['number', 'cleaned', 'passing', 'assigned_to', 'last_cleaned', 'last_checked', 'building'];
        // Fields
        $this->crud->addField(['name' => 'number', 'type' => 'text', 'label' => 'Room Number']);
        
        $this->crud->addField([  // Select
       'label' => "Building",
       'type' => 'select',
       'name' => 'building', // the db column for the foreign key
       'entity' => 'building', // the method that defines the relationship in your Model
       'attribute' => 'name', // foreign key attribute that is shown to user
       'model' => "App\Models\Building",
        ]);
        
        $this->crud->addField([  // Select
       'label' => "Assigned",
       'type' => 'select',
       'name' => 'assigned_to', // the db column for the foreign key
       'entity' => 'user', // the method that defines the relationship in your Model
       'attribute' => 'name', // foreign key attribute that is shown to user
       'model' => "App\User"
       ]);
       
            
        $this->crud->addField([  // Select
       'label' => "Last Cleaned By",
       'type' => 'select',
       'name' => 'cleaned_by', // the db column for the foreign key
       'entity' => 'user', // the method that defines the relationship in your Model
       'attribute' => 'name', // foreign key attribute that is shown to user
       'model' => "App\User"
       ]);
       
           
       $this->crud->addField([
        'name'        => 'cleaned',
        'label'       => 'Cleaned',
        'type'        => 'checkbox',
        ]);
       
           $this->crud->addField([
        'name'        => 'passing',
        'label'       => 'Passing',
        'type'        => 'checkbox',
        ]);
        
          $this->crud->addField([   // date_picker
            'name' => 'last_cleaned',
            'type' => 'date_picker',
            'label' => 'Cleaned Date',
            // optional:
            'date_picker_options' => [
                'todayBtn' => false,
                'format' => 'mm-dd-yyyy',
                'language' => 'en'
            ],
        ]);

    
            

        // add asterisk for fields that are required in RoomRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
        $this->crud->enableExportButtons();
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $building = Building::find($request->input('building'));
        $request->merge(array("full_name"=>$building->abbreviation . " " . $request->input('number')));
        
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $building = Building::find($request->input('building'));
        $request->merge(array("full_name"=>$building->abbreviation . " " . $request->input('number')));
        
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
