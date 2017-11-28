<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    // validation
    public static $rules = [
        'category_id' => 'sometimes|exists:categories,id',
        'severity' => 'required|in:M,N,A',
        'control_number' => 'required|unique:incidents',
        'title' => 'required|min:4'
    ];

    public static $messages = [
        'category_id.exists' => 'La categoría seleccionada no existe en nuestra base de datos.',
        'control_number.required' => 'Es necesario ingresar un número de control.',
        'control_number.unique' => 'El número de control ingresado ya se encuentra en uso.',
        'title.required' => 'Es necesario ingresar un nombre para la incidencia.',
        'title.min' => 'El nombre debe presentar al menos 4 caracteres.'
    ];

    protected $appends = ['state'];

    // relationships

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function level()
    {
        return $this->belongsTo('App\Level');
    }

    public function support()
    {
        return $this->belongsTo('App\User', 'support_id');
    }

    public function client()
    {
        return $this->belongsTo('App\User', 'client_id');
    }

    public function messages()
    {
        return $this->hasMany('App\Message');   
    }

    public function attachments()
    {
        return $this->hasMany('App\Attachment');
    }

    public function openedBy()
    {
        return $this->belongsTo(User::class, 'opened_by');
    }

    public function closedBy()
    {
        return $this->belongsTo(User::class, 'closed_by');
    }

    // accessors

    public function getSeverityFullAttribute()
    {
    	switch ($this->severity) {
    		case 'M':
    			return 'Menor';

    		case 'N':
    			return 'Normal';
    		
    		default:
    			return 'Alta';
    	}
    }

    public function getTitleShortAttribute()
    {
    	return mb_strimwidth($this->title, 0, 20, '...');
    }

    // category_name
    public function getCategoryNameAttribute()
    {
        if ($this->category)
            return $this->category->name;

        return 'General';
    }

    // support_name
    public function getSupportNameAttribute()
    {
        if ($this->support)
            return $this->support->name;

        return 'Sin asignar';
    }

    public function getStateAttribute()
    {
        if ($this->active == 0)
            return 'Resuelto';

        if ($this->support_id)
            return 'Asignado';

        return 'Pendiente';
    }
}
